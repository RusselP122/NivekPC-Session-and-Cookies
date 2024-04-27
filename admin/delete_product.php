<?php
// Include your database connection file
include_once "../include/conn.php";

// Check if product_id is set in the POST request
if (isset($_POST['product_id'])) {
    // Sanitize the input to prevent SQL injection
    $productId = htmlspecialchars($_POST['product_id']);

    // Prepare and execute the SQL query to delete the product
    try {
        $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->execute([$productId]);

        // Return success message
        echo "Product deleted successfully.";
    } catch (PDOException $e) {
        // Return error message if deletion fails
        echo "Error: " . $e->getMessage();
    }
} else {
    // Return error message if product_id is not provided
    echo "Error: Product ID not provided.";
}
?>
