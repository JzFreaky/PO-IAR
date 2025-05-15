<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>
<title>View User</title>
<style>
    
</style>
<main class="container mt-5 custom-container">
    <h2>View User</h2>
    <div class="row">
    <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Profile Picture
                </div>
                <div class="card-body">
                    <?php if (!empty($user['profile_picture'])): ?>
                        <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" class="img-fluid rounded" alt="Profile Picture">
                    <?php else: ?>
                        <p>No profile picture available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    User Details
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Username:</th>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                            </tr>
                            <tr>
                                <th>Date Created:</th>
                                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                            </tr>
                            <tr>
                                <th>Account Type:</th>
                                <td><?php echo htmlspecialchars($user['account_type']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        
    </div>

    <a href="../manage_accounts" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i></a>
    <a href="view_user.php?username=<?php echo $user['username']; ?>&delete_user=true" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</a>
</main>

<?php include '../../aclasses/footer.php'; ?>