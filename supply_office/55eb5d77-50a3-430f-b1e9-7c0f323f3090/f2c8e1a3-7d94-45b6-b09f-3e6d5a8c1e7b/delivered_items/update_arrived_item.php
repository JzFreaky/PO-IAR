<?php
require '../../../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $delivery_date = $_POST['delivery_date'];
    $invoice_no = $_POST['invoice_no'];

    try {
        $stmt = $conn->prepare("UPDATE arrived_items SET delivery_date=?, invoice_no=? WHERE id=?");
        $stmt->execute([$delivery_date, $invoice_no, $id]);

        echo json_encode(["success" => true, "message" => "Item updated successfully."]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error updating item: " . $e->getMessage()]);
    }
}
?>
