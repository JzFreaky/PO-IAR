<?php
require '../classes/config.php';
require '../classes/account_config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>

<title>Account Settings</title>
<main class="container mt-5 custom-container">
    <h2>Account Settings</h2>
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($user['profile_picture'])): ?>
                <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" alt="Profile Picture" width="300" height="200">
            <?php else: ?>
                <img src="default_profile_picture.png" alt="Default Profile Picture" width="260" height="200">
            <?php endif; ?>
        </div>
        <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Name:</th>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Username:</th>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Account Type:</th>
                        <td><?php echo htmlspecialchars($user['account_type']); ?></td>
                    </tr>
                </tbody>
            </table>
            
            <span></span>
            <a href="change_password.php" class="btn btn-primary mt-3">Change Password</a>
            <a href="update_profile.php" class="btn btn-secondary mt-3">Update Profile</a>
        </div>
    </div>
</main>

<?php include '../../aclasses/footer.php'; ?>