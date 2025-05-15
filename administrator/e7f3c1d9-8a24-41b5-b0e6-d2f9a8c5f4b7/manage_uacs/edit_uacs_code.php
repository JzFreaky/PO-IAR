<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>
<title>Edit UACS Code</title>
<div class="container mt-5 custom-container">
    <h1>Edit UACS Code</h1>
    <form action="" method="post">
    <input type="hidden" name="action" value="update_uacs_code">
        <div class="form-group">
            <label for="classification">Classification:</label>
            <input type="text" class="form-control" id="classification" name="classification" value="<?= htmlspecialchars($uacs_code['classification'], ENT_QUOTES, 'UTF-8') ?>" >
        </div>
        <div class="form-group">
            <label for="sub_class">Sub Class:</label>
            <input type="text" class="form-control" id="sub_class" name="sub_class" value="<?= htmlspecialchars($uacs_code['sub_class'], ENT_QUOTES, 'UTF-8') ?>" >
        </div>
        <div class="form-group">
            <label for="group_name">Group Name:</label>
            <input type="text" class="form-control" id="group_name" name="group_name" value="<?= htmlspecialchars($uacs_code['group_name'], ENT_QUOTES, 'UTF-8') ?>" >
        </div>
        <div class="form-group">
            <label for="object_code">Object Code:</label>
            <input type="text" class="form-control" id="object_code" name="object_code" value="<?= htmlspecialchars($uacs_code['object_code'], ENT_QUOTES, 'UTF-8') ?>" >
        </div>
        <div class="form-group">
            <label for="sub_object_code">Sub Object Code:</label>
            <input type="text" class="form-control" id="sub_object_code" name="sub_object_code" value="<?= htmlspecialchars($uacs_code['sub_object_code'], ENT_QUOTES, 'UTF-8') ?>" >
        </div>
        <div class="form-group">
            <label for="uacs">UACS:</label>
            <input type="text" class="form-control" id="uacs" name="uacs" value="<?= htmlspecialchars($uacs_code['uacs'], ENT_QUOTES, 'UTF-8') ?>" >
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" value="<?= htmlspecialchars($uacs_code['status'], ENT_QUOTES, 'UTF-8') ?>" >
        </div>
        <a href="../manage_uacs" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-sync"></i> Update</button>
    </form>
</div>

<?php include '../../aclasses/footer.php'; ?>