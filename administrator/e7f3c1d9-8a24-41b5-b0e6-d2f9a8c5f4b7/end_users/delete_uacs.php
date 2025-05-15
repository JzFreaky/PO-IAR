<?php
require '../classes/config.php'; 
include '../../database/db.php'; 

// Check if the 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Prepare the DELETE statement
        $sql = "DELETE FROM uacs_codes WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Execute the statement
        $stmt->execute();

        // Redirect to the UACS Codes list page after deletion
        header("Location: manage_uacs.php");
        exit();
    } catch (PDOException $e) {
        // Handle any errors that occur during the delete process
        echo "Error deleting UACS code: " . $e->getMessage();
    }
} else {
    // If no 'id' is provided in the URL, redirect to the UACS Codes list page
    header("Location: manage_uacs.php");
    exit();
}
?>
