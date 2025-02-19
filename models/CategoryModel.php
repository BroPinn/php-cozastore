
<?php
function getCategories() {
    try {
        global $pdo;
        
        // If $pdo is not set, establish database connection
        if (!isset($pdo)) {
            $pdo = connectToDatabase();
        }
        
        // Prefer stored procedure if available
        $stmt = $pdo->query("CALL GetCategories()");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $categories;
    } catch (PDOException $e) {
        // Fallback to direct SQL query
        try {
            $stmt = $pdo->query('SELECT * FROM tbl_category');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $fallbackError) {
            error_log("Category fetch error: " . $fallbackError->getMessage());
            return [];
        }
    }
}


function addCategory($name, $description) {
    global $pdo;
    $slug = strtolower(str_replace(' ', '-', $name)); // Generate slug

    try {
        $stmt = $pdo->prepare("CALL AddCategory(?, ?, ?)");
        $stmt->execute([$name, $slug, $description]);
        echo "Category added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function updateCategory($id, $name, $description) {
    global $pdo;
    $slug = strtolower(str_replace(' ', '-', $name)); // Generate slug

    try {
        $stmt = $pdo->prepare("CALL UpdateCategory(?, ?, ?, ?)");
        $stmt->execute([$id, $name, $slug, $description]);
        echo "Category updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function deleteCategory($id) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("CALL DeleteCategory(?)");
        $stmt->execute([$id]);
        echo "Category deleted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

