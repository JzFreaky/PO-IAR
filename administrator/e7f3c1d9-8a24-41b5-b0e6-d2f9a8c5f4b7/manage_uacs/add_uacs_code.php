<?php
require '../classes/config.php'; 
include '../../database/db.php'; 
include '../../aclasses/header.php'; 
include '../../aclasses/navbar.php';
?>
<title>Add UACS Code</title>
<div class="container mt-5 custom-container">
    <h1>Add UACS Code</h1>
    <form action="" method="post">
    <input type="hidden" name="action" value="add_uacs_code">
        <div class="form-group">
            <label for="classification">Classification:</label>
            <input type="text" class="form-control" id="classification" name="classification" required>
        </div>
        <div class="form-group">
            <label for="sub_class">Sub Class:</label>
            <input type="text" class="form-control" id="sub_class" name="sub_class" required>
        </div>
        <div class="form-group">
            <label for="group_name">Group Name:</label>
            <input type="text" class="form-control" id="group_name" name="group_name" required>
        </div>
        <div class="form-group">
            <label for="object_code">Object Code:</label>
            <input type="text" class="form-control" id="object_code" name="object_code" required>
        </div>
        <div class="form-group">
            <label for="sub_object_code">Sub Object Code:</label>
            <input type="text" class="form-control" id="sub_object_code" name="sub_object_code" required>
        </div>
        <div class="form-group">
            <label for="uacs">UACS:</label>
            <input type="text" class="form-control" id="uacs" name="uacs" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" required>
        </div>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='../manage_uacs'"><i class="fas fa-arrow-left"></i></button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
    </form>
</div>
<?php include '../../aclasses/footer.php'; ?>