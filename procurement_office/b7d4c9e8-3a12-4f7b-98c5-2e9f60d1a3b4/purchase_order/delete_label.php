<?php
require '../classes/config.php';
include '../../database/db.php';

// Get the label ID from the request
if (isset($_POST['label_id'])) {
    $labelId = $_POST['label_id'];

    // Prepare the DELETE statement
    $query = "DELETE FROM purchase_order_labels WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    // Execute the query
    if ($stmt->execute([$labelId])) {
        echo "Label deleted successfully";
    } else {
        echo "Failed to delete label";
    }
}
?>
