<?php
require '../../class/function/config.php';
include '../../../database/db.php';

if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    // Fetch item details based on the id
    $stmt = $conn->prepare("SELECT id, stock_no, description, delivery_date, quantity, remarks, type FROM item_delivery WHERE id = :id");
    $stmt->bindParam(':id', $itemId, PDO::PARAM_INT);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        // Return item details as JSON
        echo json_encode($item);
    } else {
        // Return empty response if item not found
        echo json_encode([]);
    }
}
?>
