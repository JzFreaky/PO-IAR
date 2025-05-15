<?php
//////////////////////////////////////ACCOUNT CONFIG
include '../../../database/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}


//-------------------------------------------------------------------ACCOUNT TYPE
// Fetch user data from the database
$user_id = $_SESSION['user_id']; // Get user ID from session
$stmt = $conn->prepare("SELECT * FROM so_users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle profile update submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profile_update'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Validate input (add more validation as needed)
    if (empty($name) ||  empty($email) || empty($username)) {
        echo "<script>alert('Please fill in all fields!');</script>";
    } else {
        $stmt = $conn->prepare("UPDATE so_users SET name = :name, email = :email, username = :username WHERE id = :user_id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            echo "<script>alert('Profile updated successfully!');</script>";
            // Refresh the page to show the updated data
            header("Location: account_settings.php");
            exit();
        } else {
            echo "<script>alert('Error updating profile!');</script>";
        }
    }
}

//---------------------------------------------------------------------------DISPLAY USERS
$user_id = $_SESSION['user_id']; // Get user ID from session
$stmt = $conn->prepare("SELECT * FROM so_users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//---------------------------------------------------------------------------CHANGE PASSWORD
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_pass'])) {
    $userId = $_SESSION['user_id']; // Assumes the user is logged in and their ID is stored in session
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM so_users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($current_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            if (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $new_password)) {
                $message = "<div class='alert alert-danger'>New password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one number, and one special character. Example: Password123!</div>";
            } else {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("UPDATE so_users SET password = :password WHERE id = :id");
                $stmt->bindParam(':password', $hashed_new_password);
                $stmt->bindParam(':id', $userId);
                $stmt->execute();

                $message = "<div class='alert alert-success'>Password changed successfully.</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>New passwords do not match.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Current password is incorrect.</div>";
    }
}


//---------------------------------------------------------------------------UPLOAD PROFILE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_photo'])) { // Check for update_photo button
    // Check if a file has been uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Get file information
        $file_name = $_FILES['photo']['name'];
        $file_tmp_name = $_FILES['photo']['tmp_name'];
        $file_type = $_FILES['photo']['type'];
        $file_size = $_FILES['photo']['size'];

        // Validate file type and size (adjust as needed)
        if (in_array($file_type, ['image/jpeg', 'image/png', 'image/gif']) && $file_size <= 1048576) { 
            // Move the uploaded file to a secure directory
            $upload_dir = '../../../../uploads/'; 
            $target_file = $upload_dir . uniqid() . '_' . basename($file_name); // Add a unique ID to the filename

            if (move_uploaded_file($file_tmp_name, $target_file)) {
                $user_id = $_SESSION['user_id']; // Assuming you have user ID in session
                
                $db_path = substr($target_file, 3);

                $stmt = $conn->prepare("UPDATE so_users SET profile_picture = :profile_picture WHERE id = :user_id");
                $stmt->bindParam(':profile_picture', $db_path);
                $stmt->bindParam(':user_id', $user_id);

                if ($stmt->execute()) {
                    $_SESSION['profile_picture'] = $target_file;

                    $_SESSION['success_message'] = "Profile picture updated successfully!";
                    header("Location: ../profile/update_photo.php"); 
                    exit; 
                } else {
                    $_SESSION['error_message'] = "Error updating profile picture!!";
                    header("Location: ../profile/update_photo.php"); 
                    exit; 
                }
            } else {
                $_SESSION['error_message'] = "Error uploading file!";
                header("Location: ../profile/update_photo.php"); 
                exit; 
            }
        } else {
            $_SESSION['error_message'] = "Invalid file type or size!";
            header("Location: ../profile/update_photo.php"); 
            exit; 
        }
    }
}
?>

