<?php
require '../classes/config.php';
include '../../database/db.php'; 
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>
<title>End-Users</title>
<div class="container mt-5 custom-container">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
        <h2>End-Users</h2>
            <div class="button-container float-right"> 
            <button class="btn btn-primary mt-3" onclick="window.location.href='add_end_user.php'"><i class="fas fa-plus"></i> Add End-User</button>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="endUsersTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 100px;">ID</th>
                <th style="width: 100px;">End User Name</th>
                <th style="width: 100px;">Requisitioning Office</th>
                <th style="width: 100px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['end_user_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['requisitioning_office']); ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary" type="button" id="dropdownMenuButton<?php echo $order['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $order['id']; ?>">
                                <a class="dropdown-item ai-dropdown-item" href="edit_end_users.php?id=<?php echo $order['id']; ?>"onclick="window.location.href='edit_end_users.php?id=<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>'"><i class="fas fa-pen-to-square edit-icon"></i> Edit </a>
                                <a class="dropdown-item ai-dropdown-item" href="#" data-toggle="modal" data-target="#deleteEndUserModal" data-delete-id="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>"><i class="fas fa-trash delete-icon"></i> Delete </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>


<div class="modal fade" id="deleteEndUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteEndUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteEndUserModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this End-User? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="#" class="btn btn-danger" id="confirmEndUserDelete">Delete</a>
      </div>
    </div>
  </div>
</div>

<?php include '../../aclasses/footer.php'; ?>
<script>
</script>