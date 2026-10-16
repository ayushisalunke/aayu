import os
import numpy as np
from flask import Flask, request, jsonify, render_template
from PIL import Image
import io
import base64
import random

app = Flask(__name__)
app.config['MAX_CONTENT_LENGTH'] = 16 * 1024 * 1024  # 16MB max upload

# ── Traffic Sign Classes (German Traffic Sign Recognition Benchmark - GTSRB) ──
SIGN_CLASSES = {
    0:  {"name": "Speed limit (20km/h)",      "category": "speed",    "color": "#E53935", "icon": "🔴"},
    1:  {"name": "Speed limit (30km/h)",      "category": "speed",    "color": "#E53935", "icon": "🔴"},
    2:  {"name": "Speed limit (50km/h)",      "category": "speed",    "color": "#E53935", "icon": "🔴"},
    3:  {"name": "Speed limit (60km/h)",      "category": "speed",    "color": "#E53935", "icon": "🔴"},
    4:  {"name": "Speed limit (70km/h)",      "category": "speed",    "color": "#E53935", "icon": "🔴"},
    5:  {"name": "Speed limit (80km/h)",      "category": "speed",    "color": "#E53935", "icon": "🔴"},
    6:  {"name": "End of speed limit (80km/h)","category": "speed",   "color": "#757575", "icon": "⚪"},
    7:  {"name": "Speed limit (100km/h)",     "category": "speed",    "color": "#E53935", "icon": "🔴"},
    8:  {"name": "Speed limit (120km/h)",     "category": "speed",    "color": "#E53935", "icon": "🔴"},
    9:  {"name": "No passing",                "category": "prohibit", "color": "#E53935", "icon": "🚫"},
    10: {"name": "No passing (trucks)",       "category": "prohibit", "color": "#E53935", "icon": "🚫"},
    11: {"name": "Right-of-way",              "category": "priority", "color": "#FB8C00", "icon": "⚠️"},
    12: {"name": "Priority road",             "category": "priority", "color": "#FB8C00", "icon": "⚠️"},
    13: {"name": "Yield",                     "category": "priority", "color": "#FB8C00", "icon": "⚠️"},
    14: {"name": "Stop",                      "category": "prohibit", "color": "#E53935", "icon": "🛑"},
    15: {"name": "No vehicles",               "category": "prohibit", "color": "#E53935", "icon": "🚫"},
    16: {"name": "No trucks",                 "category": "prohibit", "color": "#E53935", "icon": "🚫"},
    17: {"name": "No entry",                  "category": "prohibit", "color": "#E53935", "icon": "⛔"},
    18: {"name": "General caution",           "category": "warning",  "color": "#FDD835", "icon": "⚠️"},
    19: {"name": "Curve left ahead",          "category": "warning",  "color": "#FDD835", "icon": "⚠️"},
    20: {"name": "Curve right ahead",         "category": "warning",  "color": "#FDD835", "icon": "⚠️"},
    21: {"name": "Double curve",              "category": "warning",  "color": "#FDD835", "icon": "⚠️"},
    22: {"name": "Bumpy road",                "category": "warning",  "color": "#FDD835", "icon": "⚠️"},
    23: {"name": "Slippery road",             "category": "warning",  "color": "#FDD835", "icon": "⚠️"},
    24: {"name": "Road narrows right",        "category": "warning",  "color": "#FDD835", "icon": "⚠️"},
    25: {"name": "Road work",                 "category": "warning",  "color": "#FDD835", "icon": "⚠️"},
    26: {"name": "Traffic signals",           "category": "warning",  "color": "#FDD835", "icon": "🚦"},
    27: {"name": "Pedestrians",               "category": "warning",  "color": "#FDD835", "icon": "🚶"},
    28: {"name": "Children crossing",         "category": "warning",  "color": "#FDD835", "icon": "🧒"},
    29: {"name": "Bicycles crossing",         "category": "warning",  "color": "#FDD835", "icon": "🚲"},
    30: {"name": "Beware of ice/snow",        "category": "warning",  "color": "#FDD835", "icon": "❄️"},
    31: {"name": "Wild animals crossing",     "category": "warning",  "color": "#FDD835", "icon": "🦌"},
    32: {"name": "End of all restrictions",   "category": "speed",    "color": "#757575", "icon": "⚪"},
    33: {"name": "Turn right ahead",          "category": "mandatory","color": "#1E88E5", "icon": "➡️"},
    34: {"name": "Turn left ahead",           "category": "mandatory","color": "#1E88E5", "icon": "⬅️"},
    35: {"name": "Ahead only",                "category": "mandatory","color": "#1E88E5", "icon": "⬆️"},
    36: {"name": "Go straight or right",      "category": "mandatory","color": "#1E88E5", "icon": "↗️"},
    37: {"name": "Go straight or left",       "category": "mandatory","color": "#1E88E5", "icon": "↖️"},
    38: {"name": "Keep right",                "category": "mandatory","color": "#1E88E5", "icon": "➡️"},
    39: {"name": "Keep left",                 "category": "mandatory","color": "#1E88E5", "icon": "⬅️"},
    40: {"name": "Roundabout mandatory",      "category": "mandatory","color": "#1E88E5", "icon": "🔄"},
    41: {"name": "End of no passing",         "category": "prohibit", "color": "#757575", "icon": "⚪"},
    42: {"name": "End no passing (trucks)",   "category": "prohibit", "color": "#757575", "icon": "⚪"},
}

CATEGORY_COLORS = {
    "speed":    "#E53935",
    "prohibit": "#C62828",
    "warning":  "#F9A825",
    "priority": "#FB8C00",
    "mandatory":"#1565C0",
}

def preprocess_image(img):
    """Resize and normalize image for model input."""
    img = img.convert("RGB")
    img = img.resize((32, 32))
    arr = np.array(img, dtype=np.float32) / 255.0
    return arr

def mock_predict(image_array):
    """
    Mock prediction — replace this function body with your real model:
        model = load_model('model/traffic_sign_model.h5')
        pred = model.predict(image_array[np.newaxis, ...])[0]
    """
    # Simulate a realistic softmax-like distribution
    num_classes = len(SIGN_CLASSES)
    raw = np.random.exponential(scale=0.3, size=num_classes)
    # Bias toward a "winning" class
    winner = random.randint(0, num_classes - 1)
    raw[winner] += random.uniform(2.5, 5.0)
    probs = raw / raw.sum()
    return probs

@app.route("/")
def index():
    return render_template("index.html")

@app.route("/predict", methods=["POST"])
def predict():
    if "image" not in request.files:
        return jsonify({"error": "No image uploaded"}), 400

    file = request.files["image"]
    if file.filename == "":
        return jsonify({"error": "Empty filename"}), 400

    try:
        img_bytes = file.read()
        img = Image.open(io.BytesIO(img_bytes))
        arr = preprocess_image(img)
        probs = mock_predict(arr)

        top5_idx = np.argsort(probs)[::-1][:5]
        predictions = []
        for idx in top5_idx:
            sign = SIGN_CLASSES[int(idx)]
            predictions.append({
                "class_id":   int(idx),
                "name":       sign["name"],
                "category":   sign["category"],
                "color":      sign["color"],
                "icon":       sign["icon"],
                "confidence": round(float(probs[idx]) * 100, 2),
            })

        # Encode thumbnail for display
        img_thumb = img.copy()
        img_thumb.thumbnail((300, 300))
        buf = io.BytesIO()
        img_thumb.save(buf, format="JPEG", quality=85)
        thumb_b64 = base64.b64encode(buf.getvalue()).decode()

        return jsonify({
            "predictions": predictions,
            "top":         predictions[0],
            "thumbnail":   f"data:image/jpeg;base64,{thumb_b64}",
        })

    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(debug=True, port=5000)
