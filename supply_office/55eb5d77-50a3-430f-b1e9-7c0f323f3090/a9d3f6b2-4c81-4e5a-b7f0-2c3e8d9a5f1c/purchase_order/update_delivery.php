<?php
require '../../class/function/config.php';
include '../../../database/db.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Begin transaction
        $conn->beginTransaction();

        // Loop through the submitted data
        for ($i = 0; $i < count($_POST['item_id']); $i++) {
            $item_id = $_POST['item_id'][$i];
            $stock_no = $_POST['stock_no'][$i];
            $description = $_POST['description'][$i];
            $delivery_date = $_POST['delivery_date'][$i];
            $quantity = $_POST['quantity'][$i];
            $remarks = $_POST['remarks'][$i];
            $type = $_POST['type'][$i];

            // Update the delivery data
            $stmt = $conn->prepare("UPDATE item_delivery SET stock_no = :stock_no, description = :description, delivery_date = :delivery_date, quantity = :quantity, remarks = :remarks, type = :type WHERE id = :id");
            $stmt->bindParam(':stock_no', $stock_no, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':delivery_date', $delivery_date, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':id', $item_id, PDO::PARAM_INT);
            $stmt->execute();
        }

        // Commit the transaction
        $conn->commit();

        // Redirect back to the PO page or show success message
        header('Location: ../purchase_order');
    } catch (Exception $e) {
        // Rollback the transaction if any error occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>
