<?php
header('Content-Type: application/json');

try {
    // Database connection
    $pdo = new PDO("mysql:host=localhost;dbname=system_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the stock_no and po_id from the AJAX request
    $data = json_decode(file_get_contents('php://input'), true);
    $stockNo = $data['stock_no'];
    $poId = $data['po_id'];

    // Delete the row with the given stock_no and po_id
    $stmt = $pdo->prepare("DELETE FROM purchase_order_items WHERE stock_no = ? AND po_id = ?");
    $stmt->execute([$stockNo, $poId]);

    // Renumber the remaining rows for the specific po_id
    $stmt = $pdo->query("SET @new_stock_no = 0");
    $stmt = $pdo->prepare("UPDATE purchase_order_items 
                           SET stock_no = (@new_stock_no := @new_stock_no + 1) 
                           WHERE po_id = ? 
                           ORDER BY stock_no");
    $stmt->execute([$poId]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
