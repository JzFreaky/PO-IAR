<?php
require '../../class/function/config.php';
include '../../../database/db.php';

// Check if data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $stockNo = isset($_POST['stockNo']) ? $_POST['stockNo'] : '';
    $itemName = isset($_POST['itemName']) ? $_POST['itemName'] : '';
    $deliveryDate = isset($_POST['deliveryDate']) ? $_POST['deliveryDate'] : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0; // Ensure quantity is an integer
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : ''; // Get type value
    $poId = isset($_POST['poId']) ? $_POST['poId'] : ''; // Get po_id value

    // Validate the inputs
    if (!empty($stockNo) && !empty($itemName) && !empty($deliveryDate) && $quantity > 0 && !empty($type) && !empty($poId)) {
        try {
            // Prepare the SQL statement to insert data
            $stmt = $conn->prepare("
                INSERT INTO item_delivery (po_id, stock_no, item_name, delivery_date, quantity, remarks, type) 
                VALUES (:po_id, :stock_no, :item_name, :delivery_date, :quantity, :remarks, :type)
            ");

            // Bind parameters
            $stmt->bindParam(':po_id', $poId, PDO::PARAM_INT);
            $stmt->bindParam(':stock_no', $stockNo, PDO::PARAM_STR);
            $stmt->bindParam(':item_name', $itemName, PDO::PARAM_STR);
            $stmt->bindParam(':delivery_date', $deliveryDate, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR); // Bind the type parameter

            // Execute the query
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Delivery data saved successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to save delivery data.']);
            }
            
        } catch (PDOException $e) {
            // Return error response in case of an exception
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        // Return validation error response
        echo json_encode(['success' => false, 'error' => 'All fields are required']);
    }
}
?>
