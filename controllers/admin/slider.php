<?php
require_once MODELS_DIR . '/SliderModel.php';

// Upload directory is defined in config.php
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

$heading = "Slider";
$sliderModel = new SliderModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $sliderId = $_GET['id'] ?? null;

        if ($action === 'delete' && $sliderId) {
            $result = $sliderModel->deleteSlider($sliderId);
            header('Location: index.php?page=slider&success=' . ($result ? '1' : '0'));
            exit;
        }

        if ($action === 'edit' && $sliderId) {
            // Fetch the slider details for editing
            $editSlider = $sliderModel->getSliderById($sliderId);
        }

        if ($action === 'update' && $sliderId) {
            $sliderTitle = $_POST['slider_title'];
            $sliderSubtitle = $_POST['slider_subtitle'];
            $sliderLink = $_POST['slider_link'];
            $sliderStatus = $_POST['slider_status'];
            $sliderImage = null;

            if (isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] === UPLOAD_ERR_OK) {
                // Validate file type
                if (!in_array($_FILES['slider_image']['type'], ALLOWED_TYPES)) {
                    $error = "Invalid file type. Please upload JPG, PNG or GIF images only.";
                } else {
                    if (!file_exists(SLIDER_UPLOADS_DIR)) {
                        if (!@mkdir(SLIDER_UPLOADS_DIR, 0777, true)) {
                            $error = "Failed to create upload directory";
                        }
                    }

                    if (!isset($error)) {
                        $fileName = time() . '_' . basename($_FILES['slider_image']['name']);
                        $uploadFile = SLIDER_UPLOADS_DIR . '/' . $fileName;

                        if (move_uploaded_file($_FILES['slider_image']['tmp_name'], $uploadFile)) {
                            $sliderImage = SLIDER_UPLOADS_URL . '/' . $fileName;
                        } else {
                            $error = "Failed to upload image";
                        }
                    }
                }
            }

            if (!isset($error)) {
                $result = $sliderModel->updateSlider(
                    $sliderId,
                    $sliderTitle,
                    $sliderSubtitle,
                    $sliderImage,
                    $sliderLink,
                    $sliderStatus
                );

                if ($result) {
                    header('Location: index.php?page=slider&success=1');
                    exit;
                } else {
                    $error = "Failed to update slider";
                }
            }
        }
    }

    if (isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] === UPLOAD_ERR_OK) {
        // Validate file type
        if (!in_array($_FILES['slider_image']['type'], ALLOWED_TYPES)) {
            $error = "Invalid file type. Please upload JPG, PNG or GIF images only.";
        } else {
            if (!file_exists(SLIDER_UPLOADS_DIR)) {
                if (!@mkdir(SLIDER_UPLOADS_DIR, 0777, true)) {
                    $error = "Failed to create upload directory";
                }
            }

            if (!isset($error)) {
                $fileName = time() . '_' . basename($_FILES['slider_image']['name']);
                $uploadFile = SLIDER_UPLOADS_DIR . '/' . $fileName;

                if (move_uploaded_file($_FILES['slider_image']['tmp_name'], $uploadFile)) {
                    $imagePath = SLIDER_UPLOADS_URL . '/' . $fileName;
                    
                    $result = $sliderModel->createSlider(
                        $_POST['slider_title'],
                        $_POST['slider_subtitle'],
                        $imagePath,
                        $_POST['slider_link'],
                        $_POST['slider_status']
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
require ADMIN_VIEWS_DIR . '/slider.view.php';