<div class="mobile-logo-container"></div>
<div class="navbar">
    <div class="navbar-left">
        <img src="../../css/image/logo-v3.png" alt="EVSU Logo" class="logo">
        <span></span>
        <div class="burger-menu" id="burgerMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="navbar-right">
        <div class="profile-container" id="profileContainer">
            <?php if (isset($_SESSION['profile_picture'])): ?>
                <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" alt="Profile Picture" class="profile-picture">
            <?php else: ?>
                <img src="default_profile_picture.png" alt="Default Profile Picture" class="profile-picture">
            <?php endif; ?>
            <span><?php echo $_SESSION['name']; ?></span>
            <div class="dropdown-content" id="dropdownContent">
                <img src="<?php echo isset($_SESSION['profile_picture']) ? htmlspecialchars($_SESSION['profile_picture']) : 'default_profile_picture.png'; ?>" alt="Profile Picture">
                <h4><?php echo $_SESSION['username']; ?></h4>
                <a href="../classes/update_photo.php"><i class="fas fa-camera"></i> Update Photo</a>
                <a href="../classes/account_settings.php"><i class="fas fa-cog"></i> Account Settings</a>
                <a href="../classes/change_password.php"><i class="fas fa-key"></i> Change Password</a>
                <a href="../classes/navbar/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="sidebar" id="sidebar">
<div class="account-type">
        <i class="fas fa-user-tag"></i> 
        <span><?php echo htmlspecialchars($_SESSION['account_type']); ?></span>
    </div>
    <a href="../dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="../procurement_office"><i class="fas fa-file-alt"></i> Procurement Office</a>
    <a href="../supply_office"><i class="fas fa-receipt"></i> Supply Office</a>
    <a href="../manage_accounts"><i class="fas fa-user-check"></i> Manage Accounts</a>
    <a href="../account_trail"><i class="fas fa-eye"></i> Account Trail</a>
    <a href="../manage_uacs"><i class="fas fa-user-tie"></i> Manage UACS</a>
    <a href="../end_users"><i class="fas fa-users"></i> End-Users</a>
</div>
