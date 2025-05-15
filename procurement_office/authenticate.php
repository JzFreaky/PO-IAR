<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'database/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Sanitize input
    $password = trim($_POST['password']); // Sanitize input

    $stmt = $conn->prepare("SELECT * FROM po_users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['profile_picture'] = '../uploads/' . $user['profile_picture'];
            $_SESSION['email'] = $user['email']; 

            $user_id = filter_var($user['id'], FILTER_SANITIZE_NUMBER_INT);
            $account_type = filter_var($user['account_type'], FILTER_SANITIZE_STRING);
            $name = filter_var($user['name'], FILTER_SANITIZE_STRING); // Sanitize the name
            $login_time = date('Y-m-d H:i:s');  

            $insert_log_stmt = $conn->prepare("INSERT INTO po_login_logs (user_id, account_type, name, login_time) VALUES (:user_id, :account_type, :name, :login_time)");
            $insert_log_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $insert_log_stmt->bindParam(':account_type', $account_type, PDO::PARAM_STR);
            $insert_log_stmt->bindParam(':name', $name, PDO::PARAM_STR); // Bind the name parameter
            $insert_log_stmt->bindParam(':login_time', $login_time, PDO::PARAM_STR);
            $insert_log_stmt->execute();


            header("Location: b7d4c9e8-3a12-4f7b-98c5-2e9f60d1a3b4/dashboard");
            exit();
        } else {
            $message = "Invalid Username or Password";
        }
    } else {
        $message = "Invalid Username or Password";
    }
}
?>