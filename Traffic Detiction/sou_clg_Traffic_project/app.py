import os
import sqlite3
import json
import numpy as np

from flask import Flask, render_template, request, redirect, session, send_file
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image

from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Table
from reportlab.lib.styles import getSampleStyleSheet
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib import colors
from reportlab.lib.pagesizes import A4
from reportlab.lib.units import inch
from datetime import datetime
import sqlite3
from flask import send_file


# =========================
# Flask Setup
# =========================
app = Flask(__name__)
app.secret_key = "major_project_secret"

UPLOAD_FOLDER = os.path.join("static", "uploads")
os.makedirs(UPLOAD_FOLDER, exist_ok=True)
app.config["UPLOAD_FOLDER"] = UPLOAD_FOLDER


# =========================
# Database Setup
# =========================
def init_db():
    conn = sqlite3.connect("database.db")
    c = conn.cursor()

    c.execute("""
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT,
            password TEXT
        )
    """)

    c.execute("""
        CREATE TABLE IF NOT EXISTS history (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            image TEXT,
            prediction TEXT,
            confidence REAL
        )
    """)

    conn.commit()
    conn.close()


init_db()


# Insert default admin (only once)
def create_admin():
    conn = sqlite3.connect("database.db")
    c = conn.cursor()
    c.execute("SELECT * FROM users WHERE username=?", ("admin",))
    if not c.fetchone():
        c.execute("INSERT INTO users (username, password) VALUES (?,?)",
                  ("admin", "admin123"))
    conn.commit()
    conn.close()


create_admin()


# =========================
# Load Model
# =========================
MODEL_PATH = os.path.join("traffic_detection_model", "efficientnet_best_model.keras")
model = load_model(MODEL_PATH, compile=False)

IMG_SIZE = (224, 224)

with open("class_indices.json", "r") as f:
    class_indices = json.load(f)

class_labels = { 
    
    0: "Speed Limit: Maximum 20 km/h — Drive Slowly",
    1: "Speed Limit: Maximum 30 km/h — Drive Slowly",
    2: "Speed Limit: Maximum 50 km/h",
    3: "Speed Limit: Maximum 60 km/h",
    4: "Speed Limit: Maximum 70 km/h",
    5: "Speed Limit: Maximum 80 km/h",
    6: "End of Speed Limit 80 km/h — Restrictions Removed",
    7: "Speed Limit: Maximum 100 km/h",
    8: "Speed Limit: Maximum 120 km/h",
    9: "No Passing — Overtaking Not Allowed",
    10: "No Passing for Heavy Vehicles (>3.5 Tons)",
    11: "Right of Way at Intersection — You Have Priority",
    12: "Priority Road — Vehicles on This Road Have Priority",
    13: "Yield — Give Way to Other Vehicles",
    14: "STOP — Come to a Complete Halt",
    15: "No Vehicles Allowed — Entry Restricted",
    16: "Heavy Vehicles Prohibited (>3.5 Tons)",
    17: "No Entry — Do Not Enter",
    18: "General Warning — Proceed with Caution",
    19: "Dangerous Curve Ahead — Left Turn",
    20: "Dangerous Curve Ahead — Right Turn",
    21: "Double Curve Ahead — Drive Carefully",
    22: "Bumpy Road Ahead — Reduce Speed",
    23: "Slippery Road Ahead — Drive Carefully",
    24: "Road Narrows on the Right Side",
    25: "Road Work Ahead — Construction Zone",
    26: "Traffic Signals Ahead — Be Prepared to Stop",
    27: "Pedestrian Crossing Ahead",
    28: "Children Crossing — School Zone",
    29: "Bicycle Crossing Ahead",
    30: "Beware of Ice or Snow — Slippery Conditions",
    31: "Wild Animals Crossing Area",
    32: "End of All Speed and Passing Restrictions",
    33: "Turn Right Ahead",
    34: "Turn Left Ahead",
    35: "Ahead Only — Straight Direction Mandatory",
    36: "Go Straight or Turn Right",
    37: "Go Straight or Turn Left",
    38: "Keep Right — Pass on Right Side",
    39: "Keep Left — Pass on Left Side",
    40: "Roundabout Ahead — Mandatory Direction",
    41: "End of No Passing Restriction",
    42: "End of No Passing Restriction for Heavy Vehicles" }   # 🔥 Keep your existing 43 label dictionary here exactly same

keras_to_label = {}
for folder_name, keras_index in class_indices.items():
    keras_to_label[keras_index] = class_labels[int(folder_name)]


# =========================
# Prediction Function
# =========================
def predict_image(img_path):

    img = image.load_img(img_path, target_size=IMG_SIZE)
    img = image.img_to_array(img) / 255.0
    img = np.expand_dims(img, axis=0)

    predictions = model.predict(img)

    predicted_class = np.argmax(predictions)
    label = keras_to_label.get(predicted_class, "Unknown")
    confidence = float(np.max(predictions) * 100)

    return label, confidence


# =========================
# Login Protection
# =========================
@app.before_request
def require_login():
    allowed_routes = ["login", "static"]
    if request.endpoint not in allowed_routes and "user" not in session:
        return redirect("/login")


# =========================
# Routes
# =========================
@app.route("/", methods=["GET", "POST"])
def index():

    prediction = None
    img_path = None
    confidence = None

    if request.method == "POST":

        file = request.files.get("file")

        if file and file.filename != "":

            filename = file.filename.replace("\\", "/")
            filepath = os.path.join(app.config["UPLOAD_FOLDER"], filename)

            file.save(filepath)

            label, confidence = predict_image(filepath)

            prediction = label
            img_path = filepath

            # Save to history
            conn = sqlite3.connect("database.db")
            c = conn.cursor()
            c.execute(
                "INSERT INTO history (image, prediction, confidence) VALUES (?, ?, ?)",
                (img_path, prediction, confidence)
            )
            conn.commit()
            conn.close()

    return render_template(
        "index.html",
        prediction=prediction,
        img_path=img_path,
        confidence=confidence
    )


@app.route("/analytics")
def analytics():
    return render_template("analytics.html")


@app.route("/about")
def about():
    return render_template("about.html")


@app.route("/login", methods=["GET", "POST"])
def login():
    if request.method == "POST":

        username = request.form["username"]
        password = request.form["password"]

        conn = sqlite3.connect("database.db")
        c = conn.cursor()
        c.execute(
            "SELECT * FROM users WHERE username=? AND password=?",
            (username, password)
        )
        user = c.fetchone()
        conn.close()

        if user:
            session["user"] = username
            return redirect("/")

    return render_template("login.html")

@app.route("/logout")
def logout():
    session.clear()
    return redirect("/login")


@app.route("/history")
def history():
    conn = sqlite3.connect("database.db")
    c = conn.cursor()
    c.execute("SELECT * FROM history ORDER BY id DESC")
    data = c.fetchall()
    conn.close()
    return render_template("history.html", data=data)


@app.route("/download_report/<int:id>")
def download_report(id):

    conn = sqlite3.connect("database.db")
    c = conn.cursor()
    c.execute("SELECT * FROM history WHERE id=?", (id,))
    row = c.fetchone()
    conn.close()

    if not row:
        return "Report not found"

    file_path = f"report_{id}.pdf"
    doc = SimpleDocTemplate(file_path, pagesize=A4)
    elements = []
    styles = getSampleStyleSheet()

    # ===== Title =====
    elements.append(Paragraph("AI Driver Assistance System", styles["Title"]))
    elements.append(Spacer(1, 12))
    elements.append(Paragraph("Traffic Sign Detection Report", styles["Heading2"]))
    elements.append(Spacer(1, 20))

    # ===== Detection Details Table =====
    data = [
        ["Detection ID", str(row[0])],
        ["Detected Sign", row[2]],
        ["Confidence", f"{row[3]:.2f} %"],
        ["Generated On", datetime.now().strftime("%d-%m-%Y %H:%M:%S")]
    ]

    table = Table(data, colWidths=[2.5 * inch, 3 * inch])

    table.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, 0), colors.lightgrey),
        ('GRID', (0, 0), (-1, -1), 1, colors.grey),
        ('FONTNAME', (0, 0), (-1, -1), 'Helvetica'),
        ('FONTSIZE', (0, 0), (-1, -1), 11),
        ('LEFTPADDING', (0, 0), (-1, -1), 8),
        ('RIGHTPADDING', (0, 0), (-1, -1), 8),
        ('TOPPADDING', (0, 0), (-1, -1), 6),
        ('BOTTOMPADDING', (0, 0), (-1, -1), 6),
    ]))

    elements.append(table)
    elements.append(Spacer(1, 40))

    # ===== Footer =====
    elements.append(Paragraph(
        "This report is generated automatically by the AI Driver Assistance System.",
        styles["Normal"]
    ))

    doc.build(elements)

    return send_file(file_path, as_attachment=True)
# =========================
# Run App
# =========================
if __name__ == "__main__":
    app.run(debug=True)