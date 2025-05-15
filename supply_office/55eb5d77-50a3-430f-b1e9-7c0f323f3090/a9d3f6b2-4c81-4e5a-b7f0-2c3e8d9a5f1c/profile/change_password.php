<?php
require '../../class/function/config.php';
require '../../class/function/account_config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';
?>

<title>Change Password</title>
<main class="container mt-5 custom-container">
    <h2>Change Password</h2>
    <?php if ($message): ?>
        <?php echo $message; ?>
    <?php endif; ?>
    <form method="POST" action="">
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

<?php include '../../../sclasses/footer.php'; ?>
