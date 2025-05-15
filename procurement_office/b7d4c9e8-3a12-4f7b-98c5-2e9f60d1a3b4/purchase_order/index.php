<?php
require '../classes/config.php'; 
include '../../database/db.php'; 
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';
?>
<title>Pending Purchase Orders</title>
<style>
    
</style>
<main class="container mt-5 custom-container">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
        <h2>Pending Purchase Orders</h2>
            <div class="button-container float-right"> 
            <a href="create_po.php" class="btn btn-primary mt-3"><i class="fas fa-plus"></i> Create Purchase Order</a>
            </div>
        </div>
    </div>
</div>
    <div class="table-responsive">
    <table id="purchaseOrdersTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>PO No.</th>
                <th>Requestor</th>
                <th>Requisitioning Office</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ppurchase_orders)): ?>
                <?php foreach ($ppurchase_orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($order['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($order['requisitioning_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($order['date'])); ?></td>
                        <td>
                        <?php 
                            if ($order['status'] === 'complete') {
                                echo '<span class="badge badge-success">Approved</span>';
                            } elseif ($order['status'] === 'pending') {
                                echo '<span class="badge badge-warning">Pending</span>';
                            } else {
                                echo '<span class="badge badge-secondary">N/A</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $order['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $order['id']; ?>">
                                    <a class="dropdown-item ai-dropdown-item" href="view_po.php?id=<?php echo $order['id']; ?>">
                                        <i class="fas fa-eye view-icon"></i> View
                                    </a>
                                    <a class="dropdown-item ai-dropdown-item" href="edit_po.php?id=<?php echo $order['id']; ?>">
                                        <i class="fas fa-pen-to-square edit-icon"></i> Update
                                    </a>
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

<?php include '../../pclasses/footer.php'; ?>