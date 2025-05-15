<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>

<title>Dashboard</title>
<div class="dashboard-container">
    <div class="container mt-5">
        <h2>Dashboard</h2>
        <div class="card-container mt-4">
            <div class="card blue">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-user-edit"></i></i></span> 
            </div>
                <h3><?php echo $totalAccounts; ?></h3>
                <p>Accounts</p>
                <a href="../manage_accounts/">View Details</a>
            </div>
            <div class="card green">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-key"></i></span> 
            </div>
                <h3><?php echo $totalUACS; ?></h3>
                <p>UACS</p>
                <a href="../manage_uacs/">View Details</a>
            </div>
            <div class="card red">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-fingerprint"></i></span> 
            </div>
                <h3>2</h3>
                <p>Accounts Trail</p>
                <a href="../account_trail">View Details</a>
            </div>
            
            <div class="card bg">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-users"></i></span> 
            </div>
                <h3><?php echo $totalEndUsers; ?></h3>
                <p>End-Users</p>
                <a href="../end_users">View Details</a>
            </div>
        </div>
    </div>
</div>

<?php include '../../aclasses/footer.php'; ?>
