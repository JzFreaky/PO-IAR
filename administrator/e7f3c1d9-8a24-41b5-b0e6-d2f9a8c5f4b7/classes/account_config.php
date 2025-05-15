<?php
//////////////////////////////////////ACCOUNT CONFIG
include '../../database/db.php';


//-------------------------------------------------------------------ACCOUNT TYPE
// Fetch user data from the database
$user_id = $_SESSION['user_id']; // Get user ID from session
$stmt = $conn->prepare("SELECT * FROM admin_users WHERE id = :user_id");
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
        $stmt = $conn->prepare("UPDATE admin_users SET name = :name, email = :email, username = :username WHERE id = :user_id");
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
$stmt = $conn->prepare("SELECT * FROM admin_users WHERE id = :user_id");
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
    $stmt = $conn->prepare("SELECT password FROM admin_users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($current_password, $user['password'])) {
        // Check if new password matches confirmation
        if ($new_password === $confirm_password) {
            // Password Complexity Validation (Client-side and Server-side)
            if (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $new_password)) {
                $message = "<div class='alert alert-danger'>New password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one number, and one special character. Example: Password123!</div>";
            } else {
                // Hash the new password
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update password in the database
                $stmt = $conn->prepare("UPDATE admin_users SET password = :password WHERE id = :id");
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
            $upload_dir = '../../../uploads/'; 
            $target_file = $upload_dir . basename($file_name);

            if (move_uploaded_file($file_tmp_name, $target_file)) {
                // Update the user's profile picture in the database using PDO
                $user_id = $_SESSION['user_id']; // Assuming you have user ID in session
                $stmt = $conn->prepare("UPDATE admin_users SET profile_picture = :profile_picture WHERE id = :user_id");
                $stmt->bindParam(':profile_picture', $target_file);
                $stmt->bindParam(':user_id', $user_id);

                if ($stmt->execute()) {
                    // Update the session variable
                    $_SESSION['profile_picture'] = $target_file;

                    // Display success message
                    echo "<script>alert('Profile picture updated successfully!');</script>";
                } else {
                    // Display error message
                    echo "<script>alert('Error updating profile picture!');</script>";
                    // Optionally, you could log the error for debugging purposes
                    error_log($stmt->errorInfo()[2]);
                }
            } else {
                // Display error message
                echo "<script>alert('Error uploading file!');</script>";
            }
        } else {
            // Display error message
            echo "<script>alert('Invalid file type or size!');</script>";
        }
    }
}
?>

