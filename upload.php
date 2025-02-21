<?php
// Include your PDO connection file.
require 'database.php'; // Adjust the path as needed

$pdo = connectToDatabase();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form fields
    $productName = $_POST['productName'];
    $price       = $_POST['price'];
    $description = $_POST['description'];
    $categoryID  = $_POST['categoryID'];
    
    // Define the upload folder relative to your project root
    $uploadDir = "upload/image/";
    
    // Create the upload directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Check if file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Create a unique file name to avoid conflicts
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetFilePath = $uploadDir . $imageName;
        
        // Validate file extension
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Attempt to move the uploaded file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                // Prepare the SQL to insert product data including image_path
                $sql = "INSERT INTO tbl_product (categoryID, productName, price, description, image_path)
                        VALUES (:categoryID, :productName, :price, :description, :image_path)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':categoryID'   => $categoryID,
                    ':productName'  => $productName,
                    ':price'        => $price,
                    ':description'  => $description,
                    ':image_path'   => $targetFilePath
                ]);
                
                echo "Product uploaded successfully!";
            } else {
                echo "Error: There was a problem moving the uploaded file.";
            }
        } else {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Error: " . $_FILES['image']['error'];
    }
} else {
    echo "Invalid request.";
}
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="productName">Product Name:</label>
    <input type="text" name="productName" id="productName" required>
    
    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" id="price" required>
    
    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea>
    
    <label for="categoryID">Category ID:</label>
    <input type="number" name="categoryID" id="categoryID" required>
    
    <label for="image">Product Image:</label>
    <input type="file" name="image" id="image" required>
    
    <input type="submit" value="Upload Product">
</form>

