<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>

<title>Procurement Office Account Trail</title>
<main class="container mt-5 custom-container">
    <h2>Procurement Office Account Trails</h2>
    <div class="card-container mt-4">
            <div class="card blue">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-sign-in"></i></span> 
            </div>
                <h3><?php echo $pologinCount; ?></h3>
                <p>Login Logs</p>
                <a href="po_login_logs.php">View Details</a>
            </div>
            <div class="card bg">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-book"></i>
                </span> 
            </div>
                <h3><?php echo $poCreationCount; ?></h3>
                <p>PO Creation Logs</p>
                <a href="po_creation_logs.php">View Details</a>
            </div>
            <div class="card green">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-pencil-alt"></i>
                </span> 
            </div>
                <h3><?php echo $poUpdateCount; ?></h3>
                <p>PO Update Logs</p>
                <a href="po_update_logs.php">View Details</a>
            </div>
        </div>

        <div class="row mt-4 mb-3"> <div class="col-md-12">
            <a href="../account_trail" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a> </div>
    </div>
</main>

<?php include '../../aclasses/footer.php'; ?>
