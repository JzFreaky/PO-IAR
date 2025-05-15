<?php
require '../../class/function/config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';
?>
<title>Pending IAR</title>
<main class="container mt-5 custom-container">
    <h2>Pending Inspection and Acceptance Reports</h2>
    <div class="table-responsive">
    <table id="iarTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>IAR No.</th>
                <th>P.O. No./Date</th>
                <th>Requestor</th>
                <th>Requisitioning Office</th>
                <th>Date</th>
                <th class="d-none">Item Descriptions</th> 
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php if (!empty($pendingIARs)): ?>
                <?php foreach ($pendingIARs as $iar): ?>
                    <tr>
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
                                    <a class="dropdown-item ai-dropdown-item" href="view_iar.php?id=<?php echo $iar['id']; ?>"><i class="fas fa-eye view-icon"></i> View </a>
                                    <a class="dropdown-item ai-dropdown-item" href="edit_iar.php?id=<?php echo $iar['id']; ?>"><i class="fas fa-edit edit-icon"></i> Edit </a>
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
<script>
  // Start animation when the page loads
  window.onload = function() {
    const loadingRows = document.querySelectorAll('.table-loading');

    loadingRows.forEach(row => {
      row.addEventListener('click', function() {
        // Remove animation class when clicked 
        this.classList.remove('table-loading'); 
      });
    });
  };
</script>
<?php include '../../../sclasses/footer.php'; ?>