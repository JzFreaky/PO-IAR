<?php
require '../../class/function/config.php';
include '../../../database/db.php';

// Get the POST data from the request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];
    $stock_no = $data['stock_no'];
    $description = $data['description'];
    $delivery_date = $data['delivery_date'];
    $quantity = $data['quantity'];
    $remarks = $data['remarks'];
    $type = $data['type'];

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE item_delivery SET stock_no = :stock_no, description = :description, delivery_date = :delivery_date, quantity = :quantity, remarks = :remarks, type = :type WHERE id = :id");
    $stmt->bindParam(':stock_no', $stock_no);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':delivery_date', $delivery_date);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':remarks', $remarks);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the update query
    if ($stmt->execute()) {
        // Return success response
        echo json_encode(['success' => true, 'item' => $data]);
    } else {
        // Return failure response
        echo json_encode(['success' => false]);
    }
} else {
    // Return failure response if no ID is provided
    echo json_encode(['success' => false]);
}
?>
