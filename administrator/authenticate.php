<?php
session_start();
require 'database/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); 
    $password = trim($_POST['password']); 

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = :username");
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

            header("Location: e7f3c1d9-8a24-41b5-b0e6-d2f9a8c5f4b7/dashboard");
            exit();
        } else {
            $message = "Invalid Username or Password";
        }
    } else {
        $message = "Invalid Username or Password";
    }
}
?>
