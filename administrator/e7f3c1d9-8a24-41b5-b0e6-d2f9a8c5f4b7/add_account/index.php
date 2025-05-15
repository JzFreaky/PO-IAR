<?php
require '../classes/config.php';
include '../../database/db.php'; 
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>

<title>Accounts</title>
<main class="container mt-5 custom-container">
    <h2>Manage Accounts</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="form-vertical">
    <input type="hidden" name="action" value="add_account">
    <div class="form-group">
            <label for="username">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>

        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control" required>
        <span id="password-requirements" class="password-requirements">
            Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.
        </span>
    </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="account_type">Account Type:</label>
            <select id="account_type" name="account_type" class="form-control" required>
                <option value="BAC">BAC (Procurement Office)</option>
                <option value="Inspector">Inspector (Supply Office)</option>
                <option value="Property Custodian">Property Custodian (Supply Office)</option>
                <option value="Supply Office Staff">Supply Office Staff</option>
                <option value="Admin">Admin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" class="form-control-file">
        </div>

        <div class="form-group">
            <a href="../manage_accounts" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-primary">Create Account</button>
        </div>

    </form>
</main>

<?php include '../../aclasses/footer.php'; ?>
<script>
    document.getElementById('password').addEventListener('focus', function() {
        document.getElementById('password-requirements').style.display = 'block';
    });

    document.getElementById('password').addEventListener('blur', function() {
        document.getElementById('password-requirements').style.display = 'none';
    });
</script>