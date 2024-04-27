<?php

include_once "../include/conn.php";


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Prepare and execute the SQL insert query
    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO users (username, email, phone, address) VALUES (:username, :email, :phone, :address)");
        
        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        
        // Execute the query
        $stmt->execute();
        
        // Redirect back to the page with a success message
        header("Location: users.php?status=success");
        exit();
    } catch (PDOException $e) {
        // Redirect back to the page with an error message if the insertion fails
        header("Location: users.php?status=error");
        exit();
    }
}
?>