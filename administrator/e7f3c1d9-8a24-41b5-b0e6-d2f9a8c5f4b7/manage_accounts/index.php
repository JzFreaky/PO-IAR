<?php
require '../classes/config.php'; 
include '../../database/db.php'; 
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>
<title>Manage Accounts</title>
<main class="container mt-5 custom-container">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
        <h2>Manage Accounts</h2>
            <div class="button-container float-right"> 
            <a href="../add_account" class="btn btn-primary mt-3"><i class="fas fa-plus"></i> Create New Account</a>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="accountsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Account Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($allUsers)): ?>
                <?php foreach ($allUsers as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($user['account_type']); ?></td>
                        <td>
                            <!-- Settings Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $user['username']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $user['username']; ?>">
                                    <a class="dropdown-item ai-dropdown-item" href="view_user.php?username=<?php echo $user['username']; ?>"><i class="fas fa-eye view-icon"></i> View </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</main>

<?php include '../../aclasses/footer.php'; ?>
