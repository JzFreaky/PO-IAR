<?php
require '../../class/function/config.php';
include '../../../database/db.php';

if (isset($_GET['po_no'])) {
    $po_no = $_GET['po_no'];

    try {
        $stmt = $conn->prepare("SELECT po_id, stock_no, unit, description, quantity, unit_cost, amount FROM purchase_order_items WHERE po_id = (SELECT id FROM purchase_orders WHERE po_no = ? AND status IN ('approved', 'Incomplete') LIMIT 1 )");
        $stmt->execute([$po_no]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($items);
    } catch (PDOException $e) {
        echo json_encode([]);
    }
}
?>
