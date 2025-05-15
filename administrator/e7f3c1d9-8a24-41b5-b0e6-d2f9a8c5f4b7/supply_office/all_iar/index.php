<?php
require '../../classes/config.php';
require '../../classes/supply_config.php';
include '../../../aclasses/sheader.php';
include '../../../aclasses/snavbar.php';
?>
<title>All IAR</title>
<main class="container mt-5 custom-container">
    <h2>All Inspection and Acceptance Report's</h2>
    <div class="table-responsive">
    <table id="iarTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
        <tr>
                <th style="width: 100px;">IAR No.</th>
                <th style="width: 100px;">P.O. No./Date</th>
                <th style="width: 100px;">Requestor</th>
                <th style="width: 100px;">Requisitioning Office</th>
                <th style="width: 100px;">Date</th>
                <th style="width: 100px;">Type</th>
                <th style="width: 100px;">Action</th>
                <th class="d-none">Item Descriptions</th> 
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($allIARs)): ?>
            <?php foreach ($allIARs as $iar): ?>
                <tr>
                        <td><?php echo htmlspecialchars($iar['iar_no']); ?></td>
                        <td><?php echo htmlspecialchars($iar['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($iar['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($iar['req_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($iar['date'])); ?></td>
                        <td>
                        <?php 
                            if ($iar['property_custodian_status'] === 'complete') {
                                echo '<span class="badge badge-success">Complete</span>';
                            } elseif ($iar['property_custodian_status'] === 'partial') {
                                echo '<span class="badge badge-warning">Partial</span>';
                            } elseif ($iar['property_custodian_status'] === 'accept/not correct specs') {
                                echo '<span class="badge badge-secondary">Accept/Not Correct Specs</span>';
                            } elseif ($iar['property_custodian_status'] === 'rejected') {
                                echo '<span class="badge badge-danger">Rejected</span>';
                            } elseif ($iar['property_custodian_status'] === 'pending') {
                                echo '<span class="badge badge-info">Pending</span>';
                            }
                            ?>
                        </td>
                        <td class="d-none"><?php echo htmlspecialchars($iar['item_descriptions']); ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary" type="button" id="dropdownMenuButton<?php echo $iar['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $iar['id']; ?>">
                                    <a class="dropdown-item ai-dropdown-item" href="view_iar.php?id=<?php echo $iar['id']; ?>"><i class="fas fa-eye view-icon"></i> View </a>
                                    <a class="dropdown-item ai-dropdown-item" href="?delete_iar_id=<?php echo $iar['id']; ?>" onclick="return confirm('Are you sure you want to delete this purchase order?');"><i class="fas fa-trash delete-icon"></i> Delete </a>
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
            <a href="../../supply_office" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a> </div>
    </div>
</main>
<?php include '../../../aclasses/sfooter.php'; ?>