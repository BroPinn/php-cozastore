<?php
$heading="Slider";
require_once __DIR__ . '/../../models/SliderModel.php';

define('UPLOAD_DIR', '../uploads/images/slider/');
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

$heading = "Product";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sliderModel = new SliderModel();
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Validate file type
        if (!in_array($_FILES['image']['type'], ALLOWED_TYPES)) {
            $error = "Invalid file type. Please upload JPG, PNG or GIF images only.";
        } else {
            if (!file_exists(UPLOAD_DIR)) {
                if (!@mkdir(UPLOAD_DIR, 0777, true)) {
                    $error = "Failed to create upload directory";
                }
            }

            if (!isset($error)) {
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = UPLOAD_DIR . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $imagePath = 'uploads/images/slider/' . $fileName;
                    
                    $result = $sliderModel->createSlider(
                        $_POST['slider_title'],
                        $_POST['slider_status'],
                        $imagePath,
                        $_POST['slider_link'],
                        $_POST['slider_subtitle'],
                    );

                    if ($result) {
                        header('Location: index.php?page=slider&success=1');
                        exit;
                    } else {
                        $error = "Failed to create slider";
                    }
                } else {
                    $error = "Failed to upload image";
                }
            }
        }
    } else {
        $error = "Please select an image";
    }
}
require "view/slider.view.php";