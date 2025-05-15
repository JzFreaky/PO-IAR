<?php
require '../../classes/config.php';
require '../../classes/procurement_config.php';
include '../../../aclasses/pheader.php';
include '../../../aclasses/pnavbar.php';
?>
<title>All Purchase Orders</title>
<main class="container mt-5 custom-container">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
        <h2>All Purchase Order's</h2>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="purchaseOrdersTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 100px;">PO No.</th>
                <th style="width: 100px;">Requestor</th>
                <th style="width: 100px;">Requisitioning Office</th>
                <th style="width: 100px;">Date</th>
                <th style="width: 100px;">Status</th>
                <th style="width: 100px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($allpurchase_orders)): ?>
                <?php foreach ($allpurchase_orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($order['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($order['requisitioning_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($order['date'])); ?></td>
                        <td>
                            <?php 
                                if ($order['status'] === 'Complete') {
                                    echo '<span class="badge badge-success">Done</span>';
                                } elseif ($order['status'] === 'approved') {
                                    echo '<span class="badge badge-primary">Approved</span>';
                                } elseif ($order['status'] === 'Incomplete') {
                                    echo '<span class="badge badge-success">Done</span>';
                                } elseif ($order['status'] === 'pending') {
                                    echo '<span class="badge badge-warning">Pending</span>';
                                } elseif ($order['status'] === 'canceled') {
                                    echo '<span class="badge badge-danger">Canceled</span>';
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
                                    <a class="dropdown-item ai-dropdown-item" href="view_po.php?id=<?php echo $order['id']; ?>"><i class="fas fa-eye view-icon"></i> View </a>
                                    <a class="dropdown-item ai-dropdown-item" href="?delete_po_id=<?php echo $order['id']; ?>" onclick="return confirm('Are you sure you want to delete this purchase order?');"><i class="fas fa-trash delete-icon"></i> Delete </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="row mt-4 mb-1"> <div class="col-md-12">
            <a href="../../procurement_office" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a> </div>
    </div>
    
</main>

<?php include '../../../aclasses/pfooter.php'; ?>