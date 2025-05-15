<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'database/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM so_users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['profile_picture'] = '../../uploads/' . $user['profile_picture'];
            $_SESSION['email'] = $user['email']; 
            $_SESSION['account_type'] = $user['account_type']; // Store account type in session

            $user_id = filter_var($user['id'], FILTER_SANITIZE_NUMBER_INT);
            $account_type = filter_var($user['account_type'], FILTER_SANITIZE_STRING);
            $name = filter_var($user['name'], FILTER_SANITIZE_STRING);
            $login_time = date('Y-m-d H:i:s'); 

            $insert_log_stmt = $conn->prepare("INSERT INTO so_login_logs (user_id, account_type, name, login_time) VALUES (:user_id, :account_type, :name, :login_time)");
            $insert_log_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $insert_log_stmt->bindParam(':account_type', $account_type, PDO::PARAM_STR);
            $insert_log_stmt->bindParam(':name', $name, PDO::PARAM_STR); 
            $insert_log_stmt->bindParam(':login_time', $login_time, PDO::PARAM_STR);
            $insert_log_stmt->execute();

            switch ($user['account_type']) {
                case 'Property Custodian':
                    header("Location: 55eb5d77-50a3-430f-b1e9-7c0f323f3090/d7b1e4c9-2f35-4a8d-b0e6-9c5f3a1d7e8b/dashboard");
                    break;
                case 'Supply Office Staff':
                    header("Location: 55eb5d77-50a3-430f-b1e9-7c0f323f3090/f2c8e1a3-7d94-45b6-b09f-3e6d5a8c1e7b/dashboard");
                    break;
                case 'Inspector':
                    header("Location: 55eb5d77-50a3-430f-b1e9-7c0f323f3090/a9d3f6b2-4c81-4e5a-b7f0-2c3e8d9a5f1c/dashboard");
                    break;
                default:
                    header("Location: ../index.php/");
            }
            exit(); 
        } else {
            $message = "Invalid Username or Password";
        }
    } else {
        $message = "Invalid Username or Password";
    }
}

?>

<!-- Rest of your HTML code remains the same -->