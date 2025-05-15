<?php
//////////////////////////////////////INSPECTOR CONFIG
include '../../../database/db.php';

$iar_id = $_GET['id'] ?? null;
$iarData = null;
$iaritemDetails = [];
$labels = [];

if ($iar_id) {
    try {
        $stmt = $conn->prepare("
            SELECT iar.*, uacs.sub_object_code
            FROM inspection_acceptance_report iar
            LEFT JOIN uacs_codes uacs ON iar.resp_code = uacs.uacs
            WHERE iar.id = :id
        ");
        $stmt->bindParam(':id', $iar_id, PDO::PARAM_INT);
        $stmt->execute();
        $iarData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($iarData) {
            $stmt_items = $conn->prepare("SELECT * FROM iar_item_details WHERE iar_id = :iar_id ORDER BY stock_no ASC");
            $stmt_items->bindParam(':iar_id', $iar_id, PDO::PARAM_INT);
            $stmt_items->execute();
            $iaritemDetails = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

            $stmt_labels = $conn->prepare("SELECT label_no, label_text FROM iar_item_labels WHERE iar_id = :iar_id");
            $stmt_labels->bindParam(':iar_id', $iar_id, PDO::PARAM_INT);
            $stmt_labels->execute();
            $labels = $stmt_labels->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
        }
    } catch (PDOException $e) {
  }
}


?>

