<?php
require '../../class/function/config.php';
require '../../class/function/account_config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/supply_office_staff.php';
?>

<title>Update Profile</title>
<main class="container mt-5 custom-container">
    <h2>Update Profile</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
        </div>
        <button type="submit" name="profile_update" class="btn btn-primary">Update</button>
    </form>
</main>

<?php include '../../../sclasses/footer.php'; ?>