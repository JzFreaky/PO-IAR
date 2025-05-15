<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';
?>
<title>Dashboard</title>
<div class="dashboard-container">
    <div class="container mt-5">
        <h2>Dashboard</h2>
        <div class="card-container mt-4">
        <div class="card yellow">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-hourglass-half"></i></span> 
            </div>
            <h3><?php echo $pendingPO; ?></h3>
            <p>Pending Purchase Orders</p>
            <a href="../purchase_order">View Details</a>
        </div>
            <div class="card green">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-check-circle"></i></span> 
            </div>
                <h3><?php echo $approvedPO; ?></h3>
                <p>Approved Purchase Orders</p>
                <a href="../approved_purchase_order">View Details</a>
            </div>
            <div class="card red">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-times-circle"></i></span> 
            </div>
                <h3><?php echo $canceledPO; ?></h3>
                <p>Canceled Purchase Orders</p>
                <a href="../canceled_purchase_order">View Details</a>
            </div>
            <div class="card blue">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-file-alt"></i></span> 
            </div>
                <h3><?php echo $allPO; ?></h3>
                <p>All Purchase Orders</p>
                <a href="../all_purchase_order">View Details</a>
            </div>
        </div>
    </div>
</div>

<?php include '../../pclasses/footer.php'; ?>
