<?php
require '../../class/function/config.php';
include '../../../database/db.php';

if (isset($_POST['po_notification_id'])) {
    $po_notification_id = $_POST['po_notification_id'];

    $sql = "DELETE FROM po_notifications WHERE po_notification_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$po_notification_id])) {
        echo json_encode([
            'success' => true,
            'message' => 'Notification successfully deleted.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database error.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request.'
    ]);
}
?>
