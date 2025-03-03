<?php
class SliderModel {

    private $slider_id;
    private $slider_title;
    private $slider_subtitle;
    private $slider_image;
    private $slider_link;
    private $slider_status;

    public function __construct() {
        // Initialize any necessary properties
    }

    public function getSliders() {
        try {
            global $pdo;
        
            // If $pdo is not set, establish database connection
            if (!isset($pdo)) {
                $pdo = connectToDatabase();
            }
            
            $stmt = $pdo->query("CALL GetActiveSliders()");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Product Fetch Error: " . $e->getMessage());
            return [];
        } catch (Exception $e) {
            error_log("General Error: " . $e->getMessage());
            return [];
        }
    }

    public function getSliderById($slider_id) {
        try {
            $pdo = connectToDatabase();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("CALL GetSliderById(?)");
            $stmt->execute([$slider_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Slider Fetch Error: " . $e->getMessage());
            return null;
        }
    }

    public function createSlider($slider_title, $slider_subtitle, $slider_image, $slider_link, $slider_status) {
        try {
            $pdo = connectToDatabase();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }   

            $stmt = $pdo->prepare("CALL CreateSlider(?, ?, ?, ?, ?)");
            return $stmt->execute([
                $slider_title,
                $slider_subtitle,
                $slider_image,
                $slider_link,
                $slider_status
            ]);
        } catch (PDOException $e) {
            error_log("Slider Creation Error: " . $e->getMessage());
            return false;
        }
    }

    public function updateSlider($slider_id, $slider_title, $slider_subtitle, $slider_image, $slider_link, $slider_status) {
        try {
            $pdo = connectToDatabase();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("CALL UpdateSlider(?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $slider_id,
                $slider_title,
                $slider_subtitle,
                $slider_image,
                $slider_link,
                $slider_status
            ]);
        } catch (PDOException $e) {
            error_log("Slider Update Error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteSlider($slider_id) {
        try {
            $pdo = connectToDatabase();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("CALL DeleteSlider(?)");
            return $stmt->execute([$slider_id]);
        } catch (PDOException $e) {
            error_log("Slider Deletion Error: " . $e->getMessage());
            return false;
        }
    }
}