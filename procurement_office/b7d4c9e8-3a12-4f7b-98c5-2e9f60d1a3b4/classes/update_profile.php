<?php
require '../classes/config.php';
require '../classes/account_config.php';
include '../../database/db.php';
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';
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

<?php include '../../pclasses/footer.php'; ?>
