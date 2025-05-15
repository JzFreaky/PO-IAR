<?php
require '../../class/function/config.php';
include '../../../database/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../../PHPMailer/src/PHPMailer.php';
require '../../../../PHPMailer/src/Exception.php';
require '../../../../PHPMailer/src/SMTP.php';

$po_no = $_POST['po_no']; 

// Fetch the purchase order details
$sql = "SELECT id FROM purchase_orders WHERE po_no = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$po_no]);
$po = $stmt->fetch(PDO::FETCH_ASSOC);

if ($po) {
    $po_id = $po['id']; 
    $notification_message = "The Items/Supplies from the Purchase Order $po_no have arrived in the Supply Office.";
    $email_message = "Inspector, The Items/Supplies from the Purchase Order $po_no have arrived in the Supply Office and need inspection. Visit the website https://po-iar.com and log in using your inspector account in the Supply Office Portal.";

    // Fetch the sender's details (assuming 'Supply Office Staff' is the sender's role)
    $sql = "SELECT email, name FROM so_users WHERE account_type = 'Supply Office Staff' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sender = $stmt->fetch(PDO::FETCH_ASSOC);

    $sender_email = $sender['email'];
    $sender_name = $sender['name'];

    // Fetch all inspectors
    $sql = "SELECT id, name, email FROM so_users WHERE account_type = 'Inspector'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $inspectors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Insert notifications into the database
    foreach ($inspectors as $inspector) {
        $user_id = $inspector['id'];
        $sql = "INSERT INTO notifications (user_id, message, forwarded_by, po_no, po_id) VALUES (?, ?, 'Supply Office', ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id, $notification_message, $po_no, $po_id]);
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jomareydacuyan430@gmail.com'; 
        $mail->Password = 'kqxpkuicskwskidq'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($sender_email, $sender_name); 
        $mail->Subject = 'Purchase Order Notification';

        // Add recipients and send emails
        foreach ($inspectors as $inspector) {
            $mail->addAddress($inspector['email'], $inspector['name']);
            $mail->Body = $email_message;
            $mail->send();
            $mail->clearAddresses(); 
        }

        echo json_encode(['success' => true, 'message' => 'Notification sent and emails delivered']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Purchase order not found']);
}
?>
