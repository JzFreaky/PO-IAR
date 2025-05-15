<?php
require '../../class/function/config.php';
require '../../class/function/inspector_config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';

?>
<title>Pending Inspection and Acceptance Report</title>
<main class="container mt-5 form-container">
<div class="appendix">Appendix 62</div>
<div class="po-header-container">
            <div class="image-container">
                <img src="../../../css/image/system-logo.png" alt="Purchase Order Image" class="iar-image">
            </div>
        <?php if ($iarData): ?>
        <div class="header">
            <h2 class="text-center" >INSPECTION AND ACCEPTANCE REPORT</h2>
        </div>
    </div>
</div>
<div class="iar-details">
    <div class="po-row">
        <div class="po-left">
            <p><strong>Entity Name:</strong> 
            <span style="text-decoration: underline;"><?php echo htmlspecialchars($iarData['entity_name']); ?></span>
            </p>
        </div>
        <div class="po-right">
            <p><strong>Fund Cluster:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['fund_cluster']); ?></span>
            </p>
        </div>
    </div>
    <div class="table-responsive">
    <table class="info-table">
        <tr>
            <td><strong>Supplier:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['supplier']); ?></span>
            </td>
            <td><strong>IAR No.:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['iar_no']); ?></span>
            </td>
        </tr>
        <tr>
            <td><strong>P.O No./Date:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['po_no']); ?></span>
            </td>
            <td><strong>IAR Date:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars(date('M d, Y', strtotime($iarData['iar_date']))); ?></span>
            </td>
        </tr>
        <tr>
            <td><strong>Requisitioning Office/Dept.:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['req_office']); ?></span>
            </td>
            <td><strong>Invoice No.:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['invoice_no']); ?></span>
            </td>
        </tr>
        <tr>
        <td><strong>Responsibility Center Code:</strong> 
            <span class="underline-word">
                <?php echo htmlspecialchars($iarData['resp_code']); ?> 
                - <?php echo htmlspecialchars(substr($iarData['sub_object_code'], 0, 25)) . (strlen($iarData['sub_object_code']) > 30 ? '...' : ''); ?>
            </span>
        </td>
        <td><strong>Invoice Date:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars(date('M d, Y', strtotime($iarData['invoice_date']))); ?></span>
            </td>
        </tr>
    </table>
    </div>
</div>
<?php if (!empty($iaritemDetails)): ?>
    <div class="table-responsive">
    <table class="item-table">
        <thead>
            <tr>
                <th>Stock/Property No.</th>
                <th>Description</th>
                <th>Unit</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $counter = 1;
        $hasRemarks = false;
            foreach ($iaritemDetails as $key => $item): 
                $matchingLabel = null;
                foreach ($labels as $label) {
                    if ($label['label_no'] == $item['stock_no']) {
                        $matchingLabel = $label;
                        break;
                    }
                }

                $stmt_specifications = $conn->prepare("
                    SELECT item_specification 
                    FROM iar_item_specifications 
                    WHERE iar_id = :iar_id AND item_no = :item_no
                ");
                $stmt_specifications->bindParam(':iar_id', $iar_id, PDO::PARAM_INT);
                $stmt_specifications->bindParam(':item_no', $item['stock_no'], PDO::PARAM_INT);
                $stmt_specifications->execute();
                $specifications = $stmt_specifications->fetchAll(PDO::FETCH_COLUMN);
                
                if (!empty($item['remarks'])) {
                    $hasRemarks = true;
                }
                    
                if ($matchingLabel): ?>
                    <tr>
                        <td colspan="4" style="text-align: center;"><strong><?php echo htmlspecialchars($matchingLabel['label_text']); ?></strong></td> 
                    </tr>
                <?php endif; ?>

                <tr>
                    <td><?php echo $counter++;?></td>
                    <td style="text-align: left;"><?php echo htmlspecialchars($item['description']); ?></td>
                    <td><?php echo htmlspecialchars($item['unit']); ?></td>
                    <td style="color: <?php echo ($item['quantity'] < $item['original_quantity']) ? 'red' : 'black'; ?>;">
                    <?php echo htmlspecialchars($item['quantity']); ?>
                </td>
                </tr>
                    
                    <?php foreach ($specifications as $specification): ?>
                        <tr>
                            <td></td>
                            <td colspan="1" style="text-align: left; ">
                                <?php echo htmlspecialchars($specification); ?>
                            <td></td>
                            <td></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <tr>
            <td>&nbsp;</td> 
            <td>**************** Nothing Follows ********************</td> 
            <td>&nbsp;</td> 
            <td>&nbsp;</td> 
        </tr>

        <?php for ($i = 0; $i < 2; $i++): ?>
            <tr>
                <td>&nbsp;</td> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td> 
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>

<div class="table-responsive">
<table class="table table-borderediar">
        <thead>
            <tr>
                <th style="text-align: center; width: 50%;">INSPECTION</th>
                <th style="text-align: center; width: 50%;">ACCEPTANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-group flex-container">
                        <p><strong>Date Inspected:</strong> 
                            <span class="line"><?php echo htmlspecialchars(date('M d, Y', strtotime($iarData['date_inspected']))); ?></span>
                        </p>
                        <p>
                            <input type="checkbox" id="inspection_verified" name="inspection_verified" value="1"
                            <?php echo isset($iarData['insp_status']) && $iarData['insp_status'] == 'complete' ? 'checked' : ''; ?>> 
                            Inspected, verified, and found in order as to quantity and specifications
                        </p>
                    </div>
                    <div class="form-group flex-footer">
                        <div class="text-center">
                            <span class="line2"><?php echo htmlspecialchars(strtoupper($iarData['inspection_officer'])); ?></span>
                        </div>
                        <p style="text-align: center;">Inspection Officer/Inspection Committee</p>
                    </div>
                </td>
                <td>
        <div class="form-group flex-container">
            <p><strong>Date Received:</strong> 
                <span class="line"><?php echo htmlspecialchars(date('M d, Y', strtotime($iarData['date_received']))); ?></span>
            </p>
            <p>
                <input type="checkbox" id="property_custodian_status" name="property_custodian_status" value="1"
                <?php echo isset($iarData['insp_status']) && $iarData['insp_status'] == 'complete' ? 'checked' : ''; ?>> 
                Complete
            </p>
            <p>
            <p>
            <input type="checkbox" id="property_custodian_status_partial" name="property_custodian_status" value="1"
            <?php if (isset($iarData['insp_status']) && $iarData['insp_status'] == 'partial') { echo 'checked'; } ?>> 
            Partial (pls. specify quantity): 
            <?php 
                if (isset($iarData['property_custodian_status']) && $iarData['property_custodian_status'] == 'partial' && isset($iarData['incomplete_details'])) {
                    echo '<span style="text-decoration: underline;">"' . htmlspecialchars($iarData['incomplete_details']) . '"</span>';
                } else {
                }
            ?>
        </p>
        </div>
        <div class="form-group flex-footer">
            <div class="text-center">
                <span class="line2"><?php echo htmlspecialchars(strtoupper($iarData['head_procurement'])); ?></span>
            </div>
            <p style="text-align: center;">Head, Procurement and Property Management Office</p>
        </div>
            </div>
    </td>
</tr>
</tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="remarksModal" tabindex="-1" role="dialog" aria-labelledby="remarksModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="remarksModalLabel">Items with Remarks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Stock/Property No.</th>
                    <th>Description</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody id="remarksTableBody">
                <!-- Remarks items will be dynamically added here -->
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 

    <?php else: ?>
        <p>No items found for this IAR.</p>
        <?php endif; ?>
    <div class="d-flex justify-content-between align-items-center">
        <a href="../pending_iar/" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i></a>
    <div>
        <?php if ($hasRemarks): ?>
        <button type="button" class="btn btn-warning mt-3" data-toggle="modal" data-target="#remarksModal"> Remarks</button>
<?php endif; ?>
        <a href="view_pdfiar.php?id=<?php echo $iar['id']; ?>" class="btn btn-secondary mt-3" download="<?php echo htmlspecialchars($iar['iar_no']) . '.pdf'; ?>">Download <i class="fas fa-file-pdf" style="color: #e77268;"></i></a>
        <a href="view_pdfiar.php?id=<?php echo $iar['id']; ?>" class="btn btn-primary mt-3"><i class="fas fa-print"></i> Print</a>
    <?php else: ?>
        <p class="text-center">No Inspection and Acceptance Report found.</p>
    <?php endif; ?>
    </div>
</div>
</main>

<?php include '../../../sclasses/footer.php'; ?>
<script>
    // This function will run when the "Process Remarks" button is clicked
    $('#remarksModal').on('show.bs.modal', function () {
        var remarksData = <?php echo json_encode($iaritemDetails); ?>; // Get the PHP data into JavaScript
        var tableBody = $('#remarksTableBody');
        tableBody.empty(); // Clear the table body before appending new rows

        remarksData.forEach(function(item) {
            if (item.remarks && item.remarks.trim() !== "") { // Check if the item has remarks
                var row = `
                    <tr>
                        <td>${item.stock_no}</td>
                        <td>${item.description}</td>
                        <td>${item.remarks}</td>
                    </tr>
                `;
                tableBody.append(row); // Add the row to the table
            }
        });
    });
</script>
