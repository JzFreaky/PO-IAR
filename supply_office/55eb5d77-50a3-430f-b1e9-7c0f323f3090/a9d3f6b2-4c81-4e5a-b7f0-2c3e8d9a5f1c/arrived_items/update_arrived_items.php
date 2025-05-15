<?php
require '../../class/function/config.php';
include '../../../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'] ?? null;
    $remarks = $_POST['remarks'] ?? '';
    $action = $_POST['action']; // 'inspect' or 'reject'

    try {
        if ($action === "inspect") {
            if (empty($quantity) || $quantity <= 0) {
                exit;
            }
            
            // Update the item as inspected
            $sql = "UPDATE arrived_items 
                    SET quantity = :quantity, remarks = :remarks, status = 'Inspected', iai_new = 0 
                    WHERE id = :id";
        } elseif ($action === "reject") {

            if (empty($remarks)) {
                echo "error: Remarks required for rejection.";
                exit;
            }
            // Update the item as rejected
            $sql = "UPDATE arrived_items 
                    SET status = 'Rejected', remarks = :remarks, iai_new = 0 
                    WHERE id = :id";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);

        if ($action === "inspect") {
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        }

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}
?>
