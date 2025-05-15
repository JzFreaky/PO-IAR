<?php
require '../../class/function/config.php';
include '../../../database/db.php';

if (isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];

    $sql = "DELETE FROM notifications WHERE notification_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$notification_id])) {
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
