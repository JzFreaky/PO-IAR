<?php
require '../../class/function/config.php';
require '../../class/function/inspector_config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';

?>
<title>Inspection and Acceptance Report Form</title>
    <main class="container mt-5 custom-container">
        <h2>Inspection and Acceptance Report</h2>
        <form action="" method="POST">
        <section class="form-section" id="section1">
            <h3><?php echo htmlspecialchars($poData['entity_name'] ?? ''); ?></h3>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="requestor">Requestor</label>
                        <input type="text" id="requestor" name="requestor" value="<?php echo htmlspecialchars($iar['requestor'] ?? ''); ?>" required readonly>
                    </div>
                    <div class="input-group">
                        <label for="fund_cluster">Fund Cluster</label>
                        <input type="text" id="fund_cluster" name="fund_cluster" value="<?php echo htmlspecialchars($iar['fund_cluster']); ?>" readonly>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" id="supplier" name="supplier" value="<?php echo htmlspecialchars($iar['supplier']); ?>" required readonly>
                    </div>
                    <div class="input-group">
                        <label for="iar_no">IAR No.</label>
                        <input type="text" id="iar_no" name="iar_no" value="<?php echo htmlspecialchars($iar_no); ?>" readonly required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="po_no">P.O. No./Date</label>
                        <input type="text" id="po_no" name="po_no" value="<?php echo htmlspecialchars($iar['po_no']); ?>" required readonly>
                    </div>
                    <div class="input-group">
                        <label for="iar_date">IAR Date</label>
                        <input type="date" id="iar_date" name="iar_date" required>
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
                            <input 
                                type="text" 
                                class="search-box" 
                                placeholder="Select or Search..." 
                                id="searchBox" 
                                onkeyup="filterItems()" 
                                onclick="toggleDropdown()" 
                                autocomplete="off" 
                                required
                                value="<?php 
                                    $respCodeDescription = '';
                                    foreach ($uacsCodes as $code) {
                                        if ($code['uacs'] == $iar['resp_code']) {
                                            $respCodeDescription = $code['sub_object_code'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($iar['resp_code'] . ' (' . substr($respCodeDescription, 0, 30) . (strlen($respCodeDescription) > 30 ? '...' : '') . ')'); 
                                ?>"
                            >
                            <div class="select-items" id="selectItems">
                                <?php foreach ($uacsCodes as $code): ?>
                                    <div 
                                        data-value="<?php echo htmlspecialchars($code['uacs']); ?>" 
                                        data-full-text="<?php echo htmlspecialchars($code['sub_object_code']); ?>" 
                                        title="<?php echo htmlspecialchars($code['sub_object_code']); ?>"><?php echo htmlspecialchars($code['uacs']); ?> (<?php echo htmlspecialchars(substr($code['sub_object_code'], 0, 30)) . (strlen($code['sub_object_code']) > 30 ? '...' : ''); ?>)</div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <select id="resp_code" name="resp_code" required style="display:none;">
                            <option value="">Select Code</option>
                            <?php foreach ($uacsCodes as $code): ?>
                                <option 
                                    value="<?php echo htmlspecialchars($code['uacs']); ?>" 
                                    <?php if ($iar['resp_code'] == $code['uacs']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($code['uacs']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="invoice_date">Date</label>
                        <input type="date" id="invoice_date" name="invoice_date" required>
                    </div>
                </div>
            </section>

            <section class="form-section" id="section2" style="display: none;">
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
                    <tbody>
                    <?php 
                    $newStockCount = 1; 
                    $displayedLabels = []; 

                    foreach ($remainingItems_2 as $item): 
                        $newStockNo = $item['stock_no']; 
                        
                        if (isset($labelsByNo[$newStockNo])): 
                            $label = $labelsByNo[$newStockNo][0]; 
                            
                            if (!in_array($newStockNo, $displayedLabels)): ?>
                                <tr>
                                    <td colspan="6"><?php echo htmlspecialchars($label); ?></td>
                                    <input type="hidden" name="label_no[]" value="<?php echo htmlspecialchars($newStockCount); ?>">
                                    <input type="hidden" name="labels[]" value="<?php echo htmlspecialchars($label); ?>"> 
                                </tr>
                                <?php
                                $displayedLabels[] = $newStockNo;
                            endif;
                        endif; 
                    ?>
                        
                        <tr id="row-<?php echo htmlspecialchars($newStockCount); ?>">
                            <td><?php echo htmlspecialchars($newStockCount);?></td> 
                            <td class="description-cell"><?php echo htmlspecialchars($item['description']); ?></td>
                            <td><?php echo htmlspecialchars($item['unit']); ?></td>
                            <td class="quantity-cell"><?php echo htmlspecialchars($item['quantity']); ?></td>  
                            <td class="item-status" id="status-<?php echo htmlspecialchars($newStockCount); ?>"></td>
                            <td>
                            <?php if ($item['is_inspectable']): ?>
                                <a href="#" class="inspect-icon" data-toggle="modal" 
                                data-stock-no="<?php echo htmlspecialchars($newStockCount); ?>" 
                                data-description="<?php echo htmlspecialchars($item['description']); ?>" 
                                data-unit="<?php echo htmlspecialchars($item['unit']); ?>" 
                                data-quantity="<?php echo htmlspecialchars($item['arrived_quantity']); ?>" 
                                title="Inspect">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                </a>
                                <?php else: ?>
                                <span class="text-muted" title="Item not arrived">
                                    <i class="fas fa-ban" style="font-size: 20px;"></i>
                                </span>
                            <?php endif; ?>
                            </td>
                        </tr>
                        
                        <?php 
                            $po_id = $_GET['po_id'] ?? null;
                            $stmtSpecs = $conn->prepare("SELECT item_specification FROM po_item_specifications WHERE po_id = ? AND item_no = ?");
                            $stmtSpecs->execute([$po_id, $newStockNo]);
                            $specifications = $stmtSpecs->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($specifications as $spec): ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo htmlspecialchars($spec['item_specification']); ?></td>
                                    <td></td> 
                                    <td></td> 
                                    <td></td> 
                                    <td></td> 
                                </tr>
                                <input type="hidden" name="item_no[]" value="<?php echo htmlspecialchars($newStockCount); ?>">
                                <input type="hidden" name="item_specification[]" value="<?php echo htmlspecialchars($spec['item_specification']); ?>">
                            <?php endforeach; ?>
                        
                        <?php 
                        $newStockCount++; 
                        endforeach; ?>

                </tbody>
            </table>
            </div>
        </section>

        <section class="form-section" id="section3" style="display: none;">
            <h3>Inspection Conforme</h3>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="date_inspected">Date Inspected</label>
                        <input type="date" id="date_inspected" name="date_inspected" required>
                    </div>
                    
                    <?php
                            $sql = "SELECT name FROM office WHERE role = 'Inspector'";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();

                            $inspectorName = ""; 
                            if ($stmt->rowCount() > 0) {
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $inspectorName = $row['name'];
                                $inspectorName = htmlspecialchars($inspectorName, ENT_QUOTES, 'UTF-8');
                            }
                        ?>
                    
                    <div class="input-group">
                        <label for="inspection_officer">Inspection Officer/Inspection Committee</label>
                        <input type="text" id="inspection_officer" name="inspection_officer" value="<?php echo htmlspecialchars($inspectorName, ENT_QUOTES, 'UTF-8'); ?>" readonly required>
                    </div>
                </div>
                   <div class="grid-2">
                    <div class="input-group">
                        <label for="head_procurement" class="hide">Head of Procurement</label>
                        <input type="hidden" id="head_procurement" name="head_procurement" value="<?php echo htmlspecialchars($iar['head_procurement']); ?>" readonly> 
                    </div>
                </div>
                <p class="hide">
                    <input type="checkbox" id="inspection_verified" name="inspection_verified" value="1" onchange="checkItems()"> 
                    Inspected, verified, and found in order as to quantity and specifications
                </p>
                <p class="hide">
                    <input type="checkbox" id="items_incomplete" name="items_incomplete" value="1" onchange="checkItems()"> 
                    Items Not Complete
                </p>
                

                <div class="modal2" id="incompleteModal" tabindex="-1" role="dialog" aria-labelledby="incompleteModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content2">
                            <div class="modal-header2">
                                <h2 class="modal-title2" id="incompleteModalLabel">Incomplete Items</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderedmodal">
                                    <thead>
                                        <tr>
                                            <th>Stock/Property No.</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody id="incompleteItemsList">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="stock_no[]" id="hidden-stock-no">
                <input type="hidden" name="description[]" id="hidden-description">
                <input type="hidden" name="unit[]" id="hidden-unit">
                <input type="hidden" name="quantity[]" id="hidden-quantity">
                <input type="hidden" name="status[]" id="hidden-status">
                <input type="hidden" name="is_complete[]" id="hidden-is-complete">
                <input type="hidden" name="original_description[]" id="hidden-original-description">
                <input type="hidden" name="original_quantity[]" id="hidden-original-quantity">
                <input type="hidden" name="remarks[]" id="hidden-remarks">
                <input type="hidden" id="input-po-id" value="<?php echo $po_id; ?>">
            </section>

            <section class="form-section">
                <div class="button-container d-flex justify-content-between align-items-center">
                    <button type="button" onclick="showPreviousSection()" class="badge badge-light badge-pill" id="backButton" style="display:none;"> Previous</button>
                        <button type="button" onclick="showNextSection()" class="badge badge-light badge-pill" id="nextButton">Next </button>
                        <button type="button" class="badge badge-primary badge-pill badge-pill-submit" id="submitButton" data-toggle="modal" data-target="#confirmSubmitModal" style="display: none;"><i class="fas fa-check"></i> Submit</button>
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
                            <button type="submit" name="submit_iar" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

<div class="modal-overlay" id="modalOverlay" style="display: none;"></div>
<div class="modal" id="itemDetailModal" tabindex="-1" role="dialog" aria-labelledby="itemDetailModalLabel">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="itemDetailModalLabel">Item Details</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="grid-1">
                <div class="input-group">
                <label><strong>Stock/Property No:</strong></span></label>
                <input type="text" name="stock_no" class="modal-input" id="input-stock-no" required readonly>
                </div>
                </div>
                <div class="grid-1">
                <div class="input-group">
                    <label><strong>Description:</strong></label>
                    <div class="input-group">
                    <input type="text" name="description[]" class="modal-input description-input" id="input-description" required readonly>
                    </div>
                </div>
            </div>
                <div class="grid-1">
                <div class="input-group">
                    <label><strong>Unit:</strong></label>
                    <input type="text" name="unit[]" class="modal-input" id="input-unit" required readonly>
                </div>
                </div>
                <div class="grid-1">
                <div class="input-group">
                    <label><strong>Quantity:</strong></label>
                    <p style="text-align: center; color: gray; font-size: 13px;">Note: <span style="color: red;">*</span>The quantity input is only based on the arrived items.</p>
                    <div class="input-group">
                        <input type="text" name="quantity[]" class="modal-input quantity-input" id="input-quantity" oninput="validateTextQuantity(this)" required readonly>
                    </div>
                </div>
            <div class="grid-1" style="display: none;">
                    <div class="input-group">
                        <label><strong>Original Description:</strong></label>
                        <input type="text" name="original_description" class="modal-input" id="input-original-description" required readonly>
                    </div>
                </div>
                <div class="grid-1">
                    <div class="input-group" style="display: none;">
                        <label><strong>Original Quantity:</strong></label>
                        <input type="text" name="original_quantity" class="modal-input" id="input-original-quantity" required readonly>
                    </div>
                </div>
                
                <div class="grid-1">
                        <div class="input-group">
                            <label> Remarks(optional):
                            <i class="fas fa-comment-dots icon-button" style="color: #ff5c5c;" onclick="toggleRemarks()" title="Add Remarks if you are accepting the item/s that is not the correct specs."></i>
                            </label>
                        </div>
                    </div>

                <div class="grid-1" id="remarks-section" style="display: none;">
                    <div class="input-group">
                        <label><strong>Remarks:</strong></label>
                        <textarea name="remarks" class="modal-input" id="input-remarks" rows="3"></textarea>
                    </div>
                </div>
                
                </div>
    <section class="form-section">
        <div class="button-container">
            <button type="button" class="done-button" onclick="closeModal()"><i class="fas fa-check-circle"></i> Done</button>
        </div>
    </section>
    
    <!-- Reject Confirmation Modal -->
    <div class="modal fade" id="rejectConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="rejectConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectConfirmationLabel">Confirm Rejection</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to reject this item? Please provide a valid reason in the remarks field before proceeding.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmReject()">Reject Item</button>
                </div>
            </div>
        </div>
    </div>

<?php include '../../../sclasses/footer.php'; ?>
<script src="../../class/js/jsdates.js"></script> 
<script>

</script>
