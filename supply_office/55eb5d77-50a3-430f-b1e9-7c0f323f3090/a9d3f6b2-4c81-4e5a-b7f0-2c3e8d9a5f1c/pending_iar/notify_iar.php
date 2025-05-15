<?php
require '../../class/function/config.php';
include '../../../database/db.php';

$iar_no = $_POST['iar_no']; 

$sql = "SELECT id FROM inspection_acceptance_report WHERE iar_no = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$iar_no]);
$iar = $stmt->fetch(PDO::FETCH_ASSOC);

if ($iar) {
    $iar_id = $iar['id']; 
    $message = "The IAR No. $iar_no is ready for acceptance check.";

    $sql = "SELECT id, account_type FROM so_users WHERE account_type = 'Supply Office Staff'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_id = $row['id']; 
    $account_type = $row['account_type']; 

    $sql = "INSERT INTO iar_notifications (user_id, message, forwarded_by, iar_no, iar_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $message, $account_type, $iar_no, $iar_id]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'IAR not found']);
}
?>
