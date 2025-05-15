<?php
require '../../class/function/config.php';
require '../../class/function/inspector_config.php';
include '../../../database/db.php'; 
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/property_custodian.php';

$query = "SELECT * FROM iar_item_specifications WHERE iar_id = :iar_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':iar_id', $iar['id'], PDO::PARAM_INT);
$stmt->execute();
$iarItemSpecifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<title>Inspection and Acceptance Report Form</title>
    <main class="container mt-5 custom-container ">
        <h2>Inspection and Acceptance Report</h2>
        <form id="inspectionForm" method="POST">
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
                    <th>View</th>
                </tr>
            </thead>
            <tbody id="item-rows">
                <?php if (!empty($iaritemDetails)): ?>
                    <?php
                    $counter = 1;  
                    foreach ($iaritemDetails as $key => $item): 
                        // Fetch the item specifications for the current item
                        $itemSpecifications = [];
                        if (isset($iarItemSpecifications) && is_array($iarItemSpecifications)) {
                            foreach ($iarItemSpecifications as $spec) {
                                if ($spec['item_no'] == $item['stock_no']) {
                                    $itemSpecifications[] = $spec['item_specification'];
                                }
                            }
                        }

                        $matchingLabel = null;
                        foreach ($labels as $label) {
                            if ($label['label_no'] == $item['stock_no']) {
                                $matchingLabel = $label;
                                break;
                            }
                        }

                        if ($matchingLabel): ?>
                            <tr>
                                <td colspan="6" style="text-align: center;"><strong><?php echo htmlspecialchars($matchingLabel['label_text']); ?></strong></td> 
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo htmlspecialchars($item['description']); ?></td>
                            <td><?php echo htmlspecialchars($item['unit']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td class="item-status" id="status-<?php echo htmlspecialchars($item['stock_no']); ?>">
                                <?php 
                                if ($item['status'] === 'verified') {
                                    echo '<i class="fas fa-check" style="color: green;"></i>';
                                } elseif ($item['status'] === 'not verified') {
                                    echo '<i class="fas fa-times" style="color: red;"></i>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="#" class="propinspect-icon" data-toggle="modal" 
                                    data-stock-no="<?php echo htmlspecialchars($item['stock_no']); ?>" 
                                    data-description="<?php echo htmlspecialchars($item['description']); ?>" 
                                    data-unit="<?php echo htmlspecialchars($item['unit']); ?>" 
                                    data-quantity="<?php echo htmlspecialchars($item['quantity']); ?>" 
                                    data-is-complete="<?php echo htmlspecialchars($item['is_complete']); ?>"
                                    data-original-description="<?php echo htmlspecialchars($item['original_description']); ?>"
                                    data-original-quantity="<?php echo htmlspecialchars($item['original_quantity']); ?>"
                                    title="View">
                                    <i class="fas fa-eye" style="font-size: 20px;"></i>
                                </a>        
                            </td>
                        </tr>

                        <!-- Display each item specification in a new row -->
                        <?php if (!empty($itemSpecifications)): ?>
                            <?php foreach ($itemSpecifications as $spec): ?>
                                <tr>
                                <td></td>
                                    <td colspan="1">
                                        <?php echo htmlspecialchars($spec); ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

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

    <section class="form-section" id="section3" style="display:none;">
        <h3>Acceptance Conforme</h3>
            <input type="hidden" name="property_custodian_status" id="property_custodian_status">
                <div class="grid-2">
                    <div class="input-group">
                        <label for="date_received">Date Received</label>
                        <input type="date" id="pdate_received" name="date_received" value="<?php echo htmlspecialchars($iar['date_received']); ?>" required>
                    </div>

                    <div class="input-group" style="display: none;" >
                        <label for="insp_status">Inspection Status</label>
                        <input type="text" id="insp_status" name="insp_status" value="<?php echo htmlspecialchars($iar['insp_status']); ?>" readonly>
                    </div>

                    <div class="input-group">
                        <label for="head_procurement">Supply and/or Property Custodian</label>
                        <input type="text" id="head_procurement" name="head_procurement" value="<?php echo htmlspecialchars($iar['head_procurement']); ?>" readonly>
                    </div>
                </div>
                <div class="input-group" id="insp_incomplete_details" <?php if ($iarData['insp_status'] !== 'partial'): ?> style="display: none;" <?php endif; ?>>
                    <textarea id="incomplete_details" name="incomplete_details" placeholder="Specify which items are incomplete or the nature of the issue..." rows="5"></textarea>
                </div>
                    <div class="modal2" id="incompleteModal" tabindex="-1" role="dialog" aria-labelledby="incompleteModalLabel" aria-hidden="true">
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
                <input type="hidden" name="unit[]" id="hidden-unit">
                <input type="hidden" name="status[]" id="hidden-status">
                <input type="hidden" name="is_complete[]" id="hidden-is-complete">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($iar_id); ?>"> 
</section>

<section class="form-section">
    <div class="button-container d-flex justify-content-between align-items-center">
        <button type="button" onclick="showPreviousSection()" class="badge badge-light badge-pill" id="backButton" style="display:none;"> Previous</button>
    
        <div class="d-flex align-items-center">
            <button type="button" onclick="showNextSection()" class="badge badge-light badge-pill" id="nextButton">Next </button> 
            <button type="button" onclick="confirmStatus()" class="badge badge-primary badge-pill badge-pill-accept" id="confirmButton" style="display: none;">Confirm</button>
        </div>
    </div>
</section>
<input type="hidden" name="submit_iar" id="submit_iar" value="1"> 
    </form>
</main>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirm this Inspection and Acceptance Report?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Confirm</button>
            </div>
        </div>
    </div>
</div>

    <div class="modal-overlay" id="modalOverlay" style="display: none;"></div>
        <div class="modal" id="propModal" tabindex="-1" role="dialog" aria-labelledby="propModalLabel" >
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="itemDetailModalLabel">Expected Items to Receive</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="propcloseModal()">
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
                                <label><strong>Original Description:</strong></label>
                                <input type="text" name="original_description" class="modal-input" id="input-original-description" required readonly>
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
                            <label><strong>Original Quantity:</strong></label>
                            <input type="text" name="original_quantity" class="modal-input" id="input-original-quantity" required readonly>
                        </div>
                    </div>
            <div class="button-container">
                <button type="button" class="pdone-button" data-dismiss="modal" aria-label="Close" onclick="propcloseModal()"><i class="fas fa-check-circle"></i> Done</button>
            </div>           
<?php include '../../../sclasses/footer.php'; ?>
<script src="../../class/js/prop.js"></script>  
<script>
</script>
 
