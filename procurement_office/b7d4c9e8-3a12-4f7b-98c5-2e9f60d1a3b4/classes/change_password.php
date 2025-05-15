<?php
require '../classes/config.php'; 
require '../classes/account_config.php'; 
include '../../database/db.php'; 
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';
?>

<title>Change Password</title>
<main class="container mt-5 custom-container">
    <h2>Change Password</h2>
    <?php if ($message): ?>
        <?php echo $message; ?>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="current_password">Current Password:</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" name="change_pass" class="btn btn-primary">Change Password</button>
    </form>
</main>

<?php include '../../pclasses/footer.php'; ?>
