<?php
session_start();

include '../../database/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $po_id = $_GET['id'];

    try {
        $conn->beginTransaction();

        $stmt_items = $conn->prepare("DELETE FROM purchase_order_items WHERE po_id = :po_id");
        $stmt_items->bindParam(':po_id', $po_id, PDO::PARAM_INT);
        $stmt_items->execute();

        $stmt_po = $conn->prepare("DELETE FROM purchase_orders WHERE id = :id");
        $stmt_po->bindParam(':id', $po_id, PDO::PARAM_INT);
        $stmt_po->execute();

        $conn->commit();

        $_SESSION['success_message'] = "Purchase Order deleted successfully.";
        header("Location: ../approved_purchase_order/");
        exit();

    } catch (Exception $e) {
        $conn->rollBack();
        echo "Failed to delete purchase order: " . $e->getMessage();
    }
} else {
    header("Location: ../approved_purchase_order/");
    exit();
}
