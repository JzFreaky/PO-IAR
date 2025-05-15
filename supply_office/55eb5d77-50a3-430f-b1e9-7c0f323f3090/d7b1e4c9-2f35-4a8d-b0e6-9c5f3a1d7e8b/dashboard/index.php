<?php
require "../../class/function/config.php";
include "../../../sclasses/header.php";
include "../../../sclasses/navbar.php";
require '../../class/function/property_custodian.php';

?>
<title>Dashboard</title>
<div class="dashboard-container">
    <div class="container mt-5">
        <h2>Dashboard</h2>
        <div class="card-container mt-4">
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
