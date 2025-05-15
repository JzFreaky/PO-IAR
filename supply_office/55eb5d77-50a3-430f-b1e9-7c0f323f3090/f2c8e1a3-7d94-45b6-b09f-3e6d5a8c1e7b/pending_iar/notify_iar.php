<?php
require '../../class/function/config.php';
include '../../../database/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../../PHPMailer/src/PHPMailer.php';
require '../../../../PHPMailer/src/Exception.php';
require '../../../../PHPMailer/src/SMTP.php';

$iar_no = $_POST['iar_no']; 

$sql = "SELECT id FROM inspection_acceptance_report WHERE iar_no = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$iar_no]);
$iar = $stmt->fetch(PDO::FETCH_ASSOC);

if ($iar) {
    $iar_id = $iar['id']; 
    $notification_message = "The IAR No. $iar_no is ready for acceptance check.";
    $email_message = "Property Custodian, The IAR No. $iar_no is ready for acceptance check. Please log in to the Supply Office Portal at https://po-iar.com to complete the process of the Pending IAR.";
    
    $sql = "SELECT email, name FROM so_users WHERE account_type = 'Supply Office Staff' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sender = $stmt->fetch(PDO::FETCH_ASSOC);

    $sender_email = $sender['email'];
    $sender_name = $sender['name'];

    $sql = "SELECT id, name, email FROM so_users WHERE account_type = 'Property Custodian'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $custodians = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    // Insert notifications into the database
    foreach ($custodians as $custodian) {
        $user_id = $custodian['id'];
        $sql = "INSERT INTO iar_notifications (iar_user_id, message, forwarded_by, iar_no, iar_id) VALUES (?, ?, 'Supply Office Staff', ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id, $notification_message, $iar_no, $iar_id]);
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
        $mail->Subject = 'Inspection and Acceptance Report Notification';

        // Add recipients and send emails
        foreach ($custodians as $custodian) {
            $mail->addAddress($custodian['email'], $custodian['name']);
            $mail->Body = $email_message;
            $mail->send();
            $mail->clearAddresses(); 
        }

        echo json_encode(['success' => true, 'message' => 'Notification sent and emails delivered']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'IAR not found']);
}
?>
