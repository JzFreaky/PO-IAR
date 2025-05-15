<?php
require '../classes/config.php';
include '../../database/db.php'; 
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';

?>
<title>UACS Codes</title>
<div class="container mt-5 custom-container">
  <div class="row mb-3">
    <div class="col-md-12"> 
      <div class="report-header"> 
        <h2>UACS Codes</h2>
        <div class="button-container float-right"> 
          <button class="btn btn-primary mt-3" onclick="window.location.href='add_uacs_code.php'"><i class="fas fa-plus"></i> Add UACS Code</button>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table id="uacsTable" class="table table-striped table-bordered" style="table-layout: fixed;">
      <thead>
        <tr>
          <th style="width: 100px;">ID</th>
          <th style="width: 100px;">Classification</th>
          <th style="width: 100px;">Sub Class</th>
          <th style="width: 100px;">Group Name</th>
          <th style="width: 100px;">Object Code</th>
          <th style="width: 100px;">Sub Object Code</th>
          <th style="width: 100px;">UACS</th>
          <th style="width: 100px;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($result as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['classification'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['sub_class'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['group_name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['object_code'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['sub_object_code'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['uacs'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>
              <div class="dropdown">
                <button class="btn btn-secondary" type="button" id="dropdownMenuButton<?php echo $row['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $row['id']; ?>">
                  <a class="dropdown-item ai-dropdown-item" href="edit_uacs_code.php?id=<?php echo $row['id']; ?>"onclick="window.location.href='edit_uacs_code.php?id=<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>'"><i class="fas fa-pen-to-square edit-icon"></i> Edit </a>
                  <a class="dropdown-item ai-dropdown-item" href="#" data-toggle="modal" data-target="#deleteUACSModal" data-delete-id="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="fas fa-trash delete-icon"></i> Delete </a>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="deleteUACSModal" tabindex="-1" role="dialog" aria-labelledby="deleteUACSModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUACSModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this UACS code? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="#" class="btn btn-danger" id="confirmUACSDelete">Delete</a>
      </div>
    </div>
  </div>
</div>

<?php include '../../aclasses/footer.php'; ?>
