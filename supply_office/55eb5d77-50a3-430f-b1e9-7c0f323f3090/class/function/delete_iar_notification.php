<?php
require '../../class/function/config.php';
include '../../../database/db.php';

if (isset($_POST['iar_notification_id'])) {
    $iar_notification_id = $_POST['iar_notification_id'];

    $sql = "DELETE FROM iar_notifications WHERE iar_notification_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$iar_notification_id])) {
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
