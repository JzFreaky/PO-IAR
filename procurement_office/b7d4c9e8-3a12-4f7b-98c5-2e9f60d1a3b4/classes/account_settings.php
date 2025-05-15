<?php
require '../classes/config.php'; 
require '../classes/account_config.php';
include '../../database/db.php'; 
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';
?>

<title>Account Settings</title>
<main class="container mt-5 custom-container">
    <h2>Account Settings</h2>
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($user['profile_picture'])): ?>
                <img src="<?php echo htmlspecialchars('../uploads/' . $user['profile_picture']); ?>" alt="Profile Picture" class="profile-image">
            <?php else: ?>
                <img src="default_profile_picture.png" alt="Default Profile Picture" width="260" height="200">
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Name:</th>
                        <td><?php echo $user['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Username:</th>
                        <td><?php echo $user['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $user['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Account Type:</th>
                        <td><?php echo $user['account_type']; ?></td>
                    </tr>
                </tbody>
            </table>
            
            <span></span>
            <a href="change_password.php" class="btn btn-primary mt-3">Change Password</a>
            <a href="update_profile.php" class="btn btn-secondary mt-3">Update Profile</a>
        </div>
    </div>
</main>

<?php include '../../pclasses/footer.php'; ?>