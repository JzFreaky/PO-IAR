<?php
require '../../classes/config.php';
require '../../classes/procurement_config.php';
include '../../../aclasses/pheader.php';
include '../../../aclasses/pnavbar.php';
?>
<title>Approved Purchase Orders</title>
<main class="container mt-5 custom-container">
<h2>Approved Purchase Order's</h2>
    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Generate Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="reportType">Report Type:</label>
                    <select class="form-control" id="reportType">
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                </div>
                <div class="form-group" id="selectedMonthDiv"> 
                    <label for="selectedMonth">Select Month:</label>
                    <select class="form-control" id="selectedMonth"></select>
                </div> 
                <div class="form-group" id="selectedYearDiv"> 
                    <label for="selectedYear">Select Year:</label>
                    <select class="form-control" id="selectedYear"></select>
                </div> 
                <div class="form-group" id="selectedYearMonthlyDiv"> 
                    <label for="selectedYearMonthly">Select Year (Monthly):</label>
                    <select class="form-control" id="selectedYearMonthly"></select>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button onclick="window.print();" class="btn btn-primary" id="generateReportBtn">Generate</button>
            </div>
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
            <?php if (!empty($apurchase_orders)): ?>
                <?php foreach ($apurchase_orders as $order): ?>
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
