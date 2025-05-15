<?php
require '../classes/config.php';
include '../../database/db.php'; // Include the database connection
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>
<title>Add End-User</title>
<div class="container mt-5 custom-container">
    <h1>Add End-User</h1>
    <form action="" method="post">
    <input type="hidden" name="action" value="add_end_user">
        <div class="form-group">
            <label for="end_user_name">End User Name</label>
            <input type="text" class="form-control" id="end_user_name" name="end_user_name" required>
        </div>
        <div class="form-group">
            <label for="requisitioning_office">Requisitioning Office</label>
            <input type="text" class="form-control" id="requisitioning_office" name="requisitioning_office" >
        </div>
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
    </form>
</div>

<?php include '../../aclasses/footer.php'; ?>