<?php
require '../../classes/config.php';
require '../../classes/procurement_config.php';
include '../../../aclasses/pheader.php';
include '../../../aclasses/pnavbar.php';
?>
<title>Canceled Purchase Orders</title>
<main class="container mt-5 custom-container">
    <h2>Canceled Purchase Orders</h2>
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
            <?php if (!empty($cpurchase_orders)): ?>
                <?php foreach ($cpurchase_orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($order['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($order['requisitioning_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($order['date'])); ?></td>
                        <td>
                        <?php 
                            if ($order['status'] === 'complete') {
                                echo '<span class="badge badge-success">Approved</span>';
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
    </div>

    <div class="row mt-4 mb-1"> <div class="col-md-12">
            <a href="../../procurement_office" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a> </div>
    </div>

</main>

<?php include '../../../aclasses/pfooter.php'; ?>