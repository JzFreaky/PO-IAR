<?php
require '../../class/function/config.php';
require '../../class/function/inspector_config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';
?>
<title>Edit Inspection and Acceptance Report</title>
<main class="container mt-5 custom-container ">
    <h2>Edit Inspection and Acceptance Report</h2>
    <form method="POST" action="">
    <section class="form-section" id="section1">
                <h3><?php echo htmlspecialchars($iar['entity_name']); ?></h3>
                <div class="grid-2">
                <div class="input-group">
                        <label for="requestor">Requestor</label>
                        <input type="text" id="requestor" name="requestor" value="<?php echo htmlspecialchars($iar['requestor']); ?>" required readonly>
                    </div>
                    <div class="input-group">
                        <label for="fund_cluster">Fund Cluster</label>
                        <input type="text" id="fund_cluster" name="fund_cluster" value="<?php echo htmlspecialchars($iar['fund_cluster']); ?>" required readonly>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" id="supplier" name="supplier" value="<?php echo htmlspecialchars($iar['supplier']); ?>" required readonly>
                    </div>
                    <div class="input-group">
                        <label for="iar_no">IAR No.</label>
                        <input type="text" id="iar_no" name="iar_no" value="<?php echo htmlspecialchars($iar['iar_no']); ?>" required readonly>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="po_no">P.O. No./Date</label>
                        <input type="text" id="po_no" name="po_no" 
                            value="<?php echo htmlspecialchars($iar['po_no']); ?>" 
                            required readonly>
                    </div>
                    <div class="input-group">
                        <label for="iar_date">IAR Date</label>
                        <input type="date" id="piar_date" name="iar_date" value="<?php echo htmlspecialchars($iar['iar_date']); ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="req_office">Requisitioning Office/Dept.</label>
                        <input type="text" id="req_office" name="req_office" value="<?php echo htmlspecialchars($iar['req_office']); ?>" required readonly>
                    </div>
                    <div class="input-group">
                        <label for="invoice_no">Invoice No.</label>
                        <input type="text" id="invoice_no" name="invoice_no" value="<?php echo htmlspecialchars($iar['invoice_no']); ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                <div class="input-group">
                <label for="resp_code">
                    Responsibility Center Code 
                    <a href="https://uacs.gov.ph/resources/uacs/object-code/chart-of-accounts" target="_blank" title="The Responsibility Center Code in the IAR is the UACS code that corresponds to the relevant department, unit, or activity in government accounting.">
                        <i class="fas fa-question-circle" style="font-size: 16px; margin-left: 2px;"></i>
                    </a>
                </label>
                <div class="searchable-select" id="customSelect">
                    <input type="text" class="search-box" placeholder="Select or Search..." id="searchBox" 
                        onkeyup="filterItems()" onclick="toggleDropdown()" autocomplete="off" required 
                        value="<?php 
                            $respCodeDescription = '';
                            foreach ($uacsCodes as $code) {
                                if ($code['uacs'] == $iar['resp_code']) {
                                    $respCodeDescription = $code['sub_object_code'];
                                    break;
                                }
                            }
                            echo htmlspecialchars($iar['resp_code'] . ' (' . substr($respCodeDescription, 0, 30) . (strlen($respCodeDescription) > 30 ? '...' : '') . ')'); 
                        ?>"> 
                    <div class="select-items" id="selectItems">
                        <?php foreach ($uacsCodes as $code): ?>
                            <div data-value="<?php echo htmlspecialchars($code['uacs']); ?>"><?php echo htmlspecialchars($code['uacs']); ?> (<?php echo htmlspecialchars(substr($code['sub_object_code'], 0, 30)) . (strlen($code['sub_object_code']) > 30 ? '...' : ''); ?>)</div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <select id="resp_code" name="resp_code" required style="display:none;">
                    <option value="">Select Code</option>
                    <?php foreach ($uacsCodes as $code): ?>
                        <option value="<?php echo htmlspecialchars($code['uacs']); ?>" <?php if ($iar['resp_code'] == $code['uacs']) echo 'selected'; ?>><?php echo htmlspecialchars($code['uacs']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
                    <div class="input-group">
                        <label for="invoice_date">Invoice Date</label>
                        <input type="date" id="pinvoice_date" name="invoice_date"  value="<?php echo htmlspecialchars($iar['invoice_date']); ?>" required>
                    </div>
                </div>
            </section>

    <!-- Item Details Table -->
    <section class="form-section" id="section2" style="display:none;">
        <div class="table-responsive">
            <h3>Item Details</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Stock/Property No.</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="item-rows">
                    <?php if (!empty($iaritemDetails)): ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($iaritemDetails as $item): ?>
                            <tr>
                                <td><?php echo $counter++;?></td>
                                <td id="desc-<?= $item['stock_no']; ?>"><?= htmlspecialchars($item['description']); ?></td>
                                <td id="unit-<?= $item['stock_no']; ?>"><?= htmlspecialchars($item['unit']); ?></td>
                                <td id="qty-<?= $item['stock_no']; ?>"><?= htmlspecialchars($item['quantity']); ?></td>
                                <td id="status-<?= $item['stock_no']; ?>">
                                    <?= $item['quantity'] == $item['original_quantity'] 
                                        ? '<i class="fas fa-check text-success"></i>' 
                                        : '<i class="fas fa-times text-danger"></i>'; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="editItem(<?= $item['stock_no']; ?>, '<?= $item['description']; ?>', '<?= $item['unit']; ?>', <?= $item['quantity']; ?>, <?= $item['original_quantity']; ?>, '<?= $item['status']; ?>', '<?= addslashes($item['remarks']); ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>

                                <!-- Hidden inputs -->
                                <input type="hidden" name="items[<?= $item['stock_no']; ?>][description]" value="<?= htmlspecialchars($item['description']); ?>" id="input-desc-<?= $item['stock_no']; ?>">
                                <input type="hidden" name="items[<?= $item['stock_no']; ?>][unit]" value="<?= htmlspecialchars($item['unit']); ?>" id="input-unit-<?= $item['stock_no']; ?>">
                                <input type="hidden" name="items[<?= $item['stock_no']; ?>][quantity]" value="<?= htmlspecialchars($item['quantity']); ?>" id="input-qty-<?= $item['stock_no']; ?>">
                                <input type="hidden" name="items[<?= $item['stock_no']; ?>][status]" value="<?= htmlspecialchars($item['status']); ?>" id="input-status-<?= $item['stock_no']; ?>">
                                <input type="hidden" name="items[<?= $item['stock_no']; ?>][remarks]" value="<?= htmlspecialchars($item['remarks']); ?>" id="input-remarks-<?= $item['stock_no']; ?>">
                            </tr>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No items found for this Purchase Order.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <input type="hidden" name="stock_no" id="stockNoInput">
    <input type="hidden" name="description" id="descriptionInput">
    <input type="hidden" name="unit" id="unitInput">
    <input type="hidden" name="quantity" id="quantityInput">
    <input type="hidden" name="status" id="statusInput">
    <input type="hidden" name="remarks" id="remarksInput">
    <input type="hidden" name="iar_id" value="<?= $iar_id ?>">


    <!-- Modal for editing -->
    <div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <input type="hidden" id="originalQuantity" />
                    <div class="form-group" style="display: none;">
                        <label for="editStockNo">Stock/Property No.</label>
                        <input type="text" class="form-control" id="editStockNo" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <input type="text" class="form-control" id="editDescription">
                    </div>
                    <div class="form-group">
                        <label for="editUnit">Unit</label>
                        <input type="text" class="form-control" id="editUnit" >
                    </div>
                    <div class="form-group">
                        <label for="editQuantity">Quantity</label>
                        <input type="number" class="form-control" id="editQuantity">
                    </div>
                    
                    <div class="form-group">
                        <label for="editRemarks">Remarks</label>
                        <textarea class="form-control" id="editRemarks"></textarea>
                    </div>
                    
                    <div class="form-group" style="display: none;">
                        <label for="editStatus">Status</label>
                        <select class="form-control" id="editStatus">
                            <option value="verified">Verified</option>
                            <option value="not verified">Not Verified</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveItemChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inspection Conforme -->
    <section class="form-section" id="section3" style="display:none;">
                <h3>Inspection Conforme</h3>
                    <div class="grid-2">
                        <div class="input-group">
                            <label for="date_inspected">Date Inspected</label>
                            <input type="date" id="date_inspected" name="date_inspected" value="<?php echo htmlspecialchars($iar['date_inspected']); ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="inspection_officer">Inspection Officer/Inspection Committee</label>
                            <input type="text" id="inspection_officer" name="inspection_officer" value="<?php echo htmlspecialchars($iar['inspection_officer']); ?>" required>
                        </div>
                    </div>
            </section>

            <section class="form-section">
                <div class="button-container d-flex justify-content-between align-items-center">
                    <button type="button" onclick="showPreviousSection()" class="badge badge-light badge-pill" id="backButton" style="display:none;"> Previous</button>
                    <button type="button" onclick="showNextSection()" class="badge badge-light badge-pill" id="nextButton">Next </button>
                        <button type="submit" class="badge badge-primary badge-pill badge-pill-submit" id="submitButton" name="save_edit" style="display: none;"><i class="fas fa-check"></i> Save Changes </button>
                    </div>
                </section>

                <!-- Confirmation Modal -->
            <div class="modal fade" id="confirmSubmitModal" tabindex="-1" role="dialog" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmSubmitModalLabel">Confirm Submission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to submit this Inspection and Acceptance Report? Please double-check that all details are correct.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="save_edit" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            
            </form>
        </main>

<script>
function editItem(stockNo, description, unit, quantity, originalQuantity, status, remarks) {
    // Make sure the modal elements exist before interacting with them
    const stockNoInput = document.getElementById('editStockNo');
    const descriptionInput = document.getElementById('editDescription');
    const unitInput = document.getElementById('editUnit');
    const quantityInput = document.getElementById('editQuantity');
    const statusInput = document.getElementById('editStatus');
    const originalQuantityInput = document.getElementById('originalQuantity');
    const remarksInput = document.getElementById('editRemarks');

    // Check if all modal elements are found
    if (!stockNoInput || !descriptionInput || !unitInput || !quantityInput || !statusInput || !originalQuantityInput || !remarksInput) {
        console.error('Modal elements not found!');
        return;
    }

    // Populate the modal fields with the item data
    stockNoInput.value = stockNo;
    descriptionInput.value = description;
    unitInput.value = unit;
    quantityInput.value = quantity;
    statusInput.value = status;
    remarksInput.value = remarks;
    
    originalQuantityInput.value = originalQuantity;

    if (parseFloat(quantity) >= parseFloat(originalQuantity)) {
        statusInput.value = "verified"; 
    } else {
        statusInput.value = "not verified"; 
    }
    // Open the modal (if it's not already open)
    $('#editItemModal').modal('show');
}


function saveItemChanges() {
    var stockNo = document.getElementById('editStockNo').value;
    var description = document.getElementById('editDescription').value;
    var unit = document.getElementById('editUnit').value;
    var quantity = document.getElementById('editQuantity').value;
    var originalQuantity = document.getElementById('originalQuantity').value;
    var status = document.getElementById('editStatus').value;
    var remarks = document.getElementById('editRemarks').value;

    if (parseFloat(quantity) >= parseFloat(originalQuantity)) {
        status = "verified";
    } else {
        status = "not verified";
    }

    // Update the table cells
    document.getElementById('desc-' + stockNo).innerText = description;
    document.getElementById('unit-' + stockNo).innerText = unit;
    document.getElementById('qty-' + stockNo).innerText = quantity;
    document.getElementById('status-' + stockNo).innerHTML = status === 'verified'
        ? '<i class="fas fa-check text-success"></i>'
        : '<i class="fas fa-times text-danger"></i>';

    // Update the hidden inputs
    document.getElementById('input-desc-' + stockNo).value = description;
    document.getElementById('input-unit-' + stockNo).value = unit;
    document.getElementById('input-qty-' + stockNo).value = quantity;
    document.getElementById('input-status-' + stockNo).value = status;
    document.getElementById('input-remarks-' + stockNo).value = remarks;

    // Close the modal
    $('#editItemModal').modal('hide');
}

</script>
 <?php include '../../../sclasses/footer.php'; ?>
 <script src="../../class/js/inspector.js"></script>  
 <script src="../../class/js/jsdates.js"></script>
