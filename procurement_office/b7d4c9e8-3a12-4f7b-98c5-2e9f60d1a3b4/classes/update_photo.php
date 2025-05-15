<?php
require '../classes/config.php'; 
require '../classes/account_config.php';
include '../../database/db.php'; 
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';
?>

<title>Update Photo</title>
<main class="container mt-5 custom-container">
    <h2>Update Photo</h2>
    <?php if (isset($_SESSION['profile_picture'])): ?>
        <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" alt="Profile Picture" class="profile-image">
    <?php else: ?>
        <img src="default_profile_picture.png" alt="Default Profile Picture" width="260" height="200">
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data"> 
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        <button type="submit" name="update_photo" class="btn btn-primary">Update</button>
    </form>
</main>

<?php include '../../pclasses/footer.php'; ?>