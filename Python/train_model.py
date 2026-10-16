"""
train_model.py  –  Train a CNN on the GTSRB dataset and save it.

Dataset: https://benchmark.ini.rub.de/gtsrb_dataset.html
         OR download via: pip install gdown
         gdown --id 1XHtJYFuRHMBa-oYvzgk-KcFp5AiAtaOy -O gtsrb.zip

Usage:
    pip install -r requirements.txt tensorflow scikit-learn
    python train_model.py
"""

import os
import numpy as np
import cv2
from sklearn.model_selection import train_test_split
import tensorflow as tf
from tensorflow import keras
from tensorflow.keras import layers
import matplotlib.pyplot as plt

# ── Config ──────────────────────────────────────────────────────────────────
IMG_SIZE    = 32          # Resize all images to 32×32
NUM_CLASSES = 43          # GTSRB has 43 sign classes
BATCH_SIZE  = 64
EPOCHS      = 20
DATA_DIR    = "data/gtsrb" # Path to extracted GTSRB dataset
MODEL_PATH  = "model/traffic_sign_model.h5"

# ── Data loading ─────────────────────────────────────────────────────────────
def load_gtsrb(data_dir):
    """Load images from GTSRB folder structure: data_dir/<class_id>/*.png"""
    images, labels = [], []
    for class_id in range(NUM_CLASSES):
        class_dir = os.path.join(data_dir, str(class_id))
        if not os.path.isdir(class_dir):
            print(f"  [warn] class {class_id} folder not found, skipping.")
            continue
        for fname in os.listdir(class_dir):
            if not fname.lower().endswith(('.png', '.jpg', '.ppm')):
                continue
            img = cv2.imread(os.path.join(class_dir, fname))
            if img is None:
                continue
            img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
            img = cv2.resize(img, (IMG_SIZE, IMG_SIZE))
            images.append(img)
            labels.append(class_id)
    return np.array(images, dtype=np.float32) / 255.0, np.array(labels)

# ── Model architecture ───────────────────────────────────────────────────────
def build_model():
    model = keras.Sequential([
        layers.Input(shape=(IMG_SIZE, IMG_SIZE, 3)),

        # Block 1
        layers.Conv2D(32, 3, padding='same', activation='relu'),
        layers.BatchNormalization(),
        layers.Conv2D(32, 3, padding='same', activation='relu'),
        layers.MaxPooling2D(2),
        layers.Dropout(0.25),

        # Block 2
        layers.Conv2D(64, 3, padding='same', activation='relu'),
        layers.BatchNormalization(),
        layers.Conv2D(64, 3, padding='same', activation='relu'),
        layers.MaxPooling2D(2),
        layers.Dropout(0.25),

        # Block 3
        layers.Conv2D(128, 3, padding='same', activation='relu'),
        layers.BatchNormalization(),
        layers.MaxPooling2D(2),
        layers.Dropout(0.25),

        # Classifier head
        layers.Flatten(),
        layers.Dense(512, activation='relu'),
        layers.BatchNormalization(),
        layers.Dropout(0.5),
        layers.Dense(NUM_CLASSES, activation='softmax'),
    ], name="TrafficSignCNN")

    model.compile(
        optimizer=keras.optimizers.Adam(1e-3),
        loss='sparse_categorical_crossentropy',
        metrics=['accuracy']
    )
    return model

# ── Data augmentation ────────────────────────────────────────────────────────
def get_augmentation():
    return keras.Sequential([
        layers.RandomFlip("horizontal"),
        layers.RandomRotation(0.1),
        layers.RandomZoom(0.1),
        layers.RandomBrightness(0.15),
        layers.RandomContrast(0.15),
    ])

# ── Training ─────────────────────────────────────────────────────────────────
def main():
    print("Loading dataset...")
    X, y = load_gtsrb(DATA_DIR)
    print(f"  Loaded {len(X)} images across {NUM_CLASSES} classes.")

    X_train, X_val, y_train, y_val = train_test_split(
        X, y, test_size=0.2, random_state=42, stratify=y
    )
    print(f"  Train: {len(X_train)}  |  Val: {len(X_val)}")

    augment = get_augmentation()
    train_ds = (
        tf.data.Dataset.from_tensor_slices((X_train, y_train))
        .shuffle(10_000)
        .batch(BATCH_SIZE)
        .map(lambda x, y: (augment(x, training=True), y))
        .prefetch(tf.data.AUTOTUNE)
    )
    val_ds = (
        tf.data.Dataset.from_tensor_slices((X_val, y_val))
        .batch(BATCH_SIZE)
        .prefetch(tf.data.AUTOTUNE)
    )

    model = build_model()
    model.summary()

    callbacks = [
        keras.callbacks.EarlyStopping(patience=5, restore_best_weights=True),
        keras.callbacks.ReduceLROnPlateau(factor=0.5, patience=3, min_lr=1e-6),
        keras.callbacks.ModelCheckpoint(MODEL_PATH, save_best_only=True),
    ]

    print("\nTraining...")
    history = model.fit(
        train_ds, validation_data=val_ds,
        epochs=EPOCHS, callbacks=callbacks
    )

    # ── Plot training curves ─────────────────────────────────────────────────
    fig, axes = plt.subplots(1, 2, figsize=(12, 4))
    axes[0].plot(history.history['accuracy'],     label='Train')
    axes[0].plot(history.history['val_accuracy'], label='Val')
    axes[0].set_title('Accuracy'); axes[0].legend()
    axes[1].plot(history.history['loss'],         label='Train')
    axes[1].plot(history.history['val_loss'],     label='Val')
    axes[1].set_title('Loss'); axes[1].legend()
    plt.tight_layout()
    plt.savefig('model/training_curves.png', dpi=150)
    print("Saved training_curves.png")

    val_loss, val_acc = model.evaluate(val_ds)
    print(f"\nFinal val accuracy: {val_acc*100:.2f}%")
    print(f"Model saved to: {MODEL_PATH}")

    # ── Swap mock_predict in app.py for real inference ───────────────────────
    print("""
─────────────────────────────────────────────────
To use the trained model, update app.py:

    from tensorflow.keras.models import load_model
    MODEL = load_model('model/traffic_sign_model.h5')

    def mock_predict(image_array):
        probs = MODEL.predict(image_array[np.newaxis, ...])[0]
        return probs
─────────────────────────────────────────────────
""")

if __name__ == "__main__":
    os.makedirs("model", exist_ok=True)
    main()
