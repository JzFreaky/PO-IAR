<?php
require '../../class/function/config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/property_custodian.php';
?>
<title>Pending IAR</title>
<main class="container mt-5 custom-container">
    <h2>Pending Inspection and Acceptance Reports</h2>
    <div class="table-responsive"> 
    <table id="iarTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 70px;">IAR No.</th>
                <th style="width: 200px;">P.O. No./Date</th>
                <th style="width: 150px;">Requestor</th>
                <th style="width: 200px;">Requisitioning Office</th>
                <th style="width: 80px;">Date</th>
                <th style="width: 70px;">Type</th>
                <th style="width: 50px;">Action</th>
                <th class="d-none">Item Descriptions</th> 
            </tr>
        </thead>
        <?php if (!empty($pendingIARs)): ?>
                <?php foreach ($pendingIARs as $iar): ?>
                    <tr <?php if ($iar['ppiar_new'] == 1) { echo 'class="pulsing-color"'; } ?>>
                        <td><?php echo htmlspecialchars($iar['iar_no']); ?></td>
                        <td><?php echo htmlspecialchars($iar['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($iar['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($iar['req_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($iar['date'])); ?></td>
                        <td>
                        <?php 
                            if ($iar['insp_status'] === 'complete') {
                                echo '<span class="badge badge-success">Complete</span>';
                            } elseif ($iar['insp_status'] === 'partial') {
                                echo '<span class="badge badge-warning">Partial</span>';
                            } else {
                                echo '<span class="badge badge-secondary">N/A</span>';
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
                                <a class="dropdown-item ai-dropdown-item" href="view_iar.php?id=<?php echo $iar['id']; ?>&update_ppiar=1"><i class="fas fa-eye view-icon"></i> View </a>
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

<?php include '../../../sclasses/footer.php'; ?>