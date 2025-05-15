<?php
require '../../class/function/config.php';
require '../../class/function/account_config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';

?>

<title>Update Photo</title>
<main class="container mt-5 custom-container">
    <h2>Update Photo</h2>
    <?php if (isset($_SESSION['profile_picture'])): ?>
        <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" alt="Profile Picture" class="profile-image">
    <?php else: ?>
        <img src="default_profile_picture.png" alt="Default Profile Picture" width="260" height="200">
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data"> 
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        <button type="submit" name="update_photo" class="btn btn-primary">Update</button>
    </form>
</main>

<?php include '../../../sclasses/footer.php'; ?>