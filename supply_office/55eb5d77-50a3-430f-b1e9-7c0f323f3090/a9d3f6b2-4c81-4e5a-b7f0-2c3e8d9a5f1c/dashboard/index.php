<?php
require "../../class/function/config.php";
require '../../class/function/inspector_config.php';
include "../../../sclasses/header.php";
include "../../../sclasses/navbar.php";
require '../../class/function/inspector.php';
?>
<title>Dashboard</title>
<div class="dashboard-container">
    <div class="container mt-5">
        <h2>Dashboard</h2>
        <div class="card-container mt-4">
            <div class="card bg">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-file-alt"></i></span> 
            </div>
                <h3><?php echo $approvedPO; ?></h3>
                <p>Purchase Order's</p>
                <a href="../purchase_order">View Details</a>
            </div>

            <div class="card red">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-search-plus"></i></span> 
            </div>
                <h3><?php echo $totalInspected; ?></h3>
                <p>Item's for Inspection</p>
                <a href="../arrived_items">View Details</a>
            </div>
            
            <div class="card yellow">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-clock"></i></span> 
            </div>
                <h3><?php echo $totalPIAR; ?></h3>
                <p>Pending IAR's</p>
                <a href="../pending_iar">View Details</a>
            </div>
            
            
            <div class="card blue">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-file-invoice"></i></span> 
            </div>
                <h3><?php echo $totalIAR; ?></h3>
                <p>All IAR's</p>
                <a href="../all_iar">View Details</a>
            </div>
        </div>
    </div>
</div>
<?php include '../../../sclasses/footer.php'; ?>
