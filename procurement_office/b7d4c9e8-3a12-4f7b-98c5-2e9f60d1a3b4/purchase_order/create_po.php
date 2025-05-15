<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';

// --------------------------------------------------------------------------PROJECT DESCRIPTION
$igfOptions = ''; 
$igfQuery = $conn->query("SELECT * FROM igf");
while ($row = $igfQuery->fetch(PDO::FETCH_ASSOC)):
    $igfOptions .= '<option value="' . htmlspecialchars($row['project_description']) . '">' . htmlspecialchars($row['project_description']) . '</option>';
endwhile; 

$rafOptions = ''; 
$rafQuery = $conn->query("SELECT * FROM raf");
while ($row = $rafQuery->fetch(PDO::FETCH_ASSOC)):
    $rafOptions .= '<option value="' . htmlspecialchars($row['project_description']) . '">' . htmlspecialchars($row['project_description']) . '</option>';
endwhile;

$igfOptionsJSON = json_encode($igfOptions);
$rafOptionsJSON = json_encode($rafOptions);

echo "<script>
        var igfOptionsJSON = '$igfOptionsJSON';
        var rafOptionsJSON = '$rafOptionsJSON';
      </script>";
?>
<title>Purchase Order Form</title>
<style>
    /* Ensure table cells wrap long content */
table td {
    word-wrap: break-word;
    white-space: normal; /* Forces text to break into multiple lines */
    vertical-align: top; /* Align text to the top of the cell for better readability */
}

</style>
    <main class="container mt-5 custom-container">
        <h2>Create Purchase Order</h2>
        <form action="" method="POST">
            <section class="form-section" id="section1">
                <h3>Entity and Supplier Information</h3>
                <div class="grid-2">
                <div class="input-group">
                    <label for="requestor">Requestor</label>
                    <div class="searchable-select" id="customSelect">
                    <span class="dot-icon" onclick="toggleSmallBox()" aria-label="Toggle requestor selection">
                    <i class="fas fa-users"></i>
                    <span class="requestor-count"></span> </span> 
                        <div class="small-box" id="smallBox" style="display: none;">
                            <div class="pointer"></div>
                            <div class="selected-requestors" id="selectedRequestors"></div>
                        </div>
                        <input type="text" class="search-box" placeholder="Select or Search..." id="searchBox" onkeyup="filterItems()" onclick="toggleDropdown()" autocomplete="off">
                        <div class="select-items" id="selectItems">
                            <?php foreach ($requestors as $requestor): ?>
                                <div class="selectable-item" onclick="selectRequestor('<?php echo htmlspecialchars($requestor['end_user_name']); ?>')"><?php echo htmlspecialchars($requestor['end_user_name']); ?> - <?php echo htmlspecialchars($requestor['requisitioning_office']); ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <input type="hidden" id="requestor" name="requestor[]" required>
                </div>
                <div class="input-group" >
                        <label for="requisitioning_office">Requisitioning Office</label>
                        <input type="text" id="requisitioning_office" name="requisitioning_office" placeholder="Requisitioning Office" required readonly>
                    </div>
                    </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="supplier">Supplier</label>
                        <input style="text-transform: uppercase;" type="text" id="supplier" name="supplier" placeholder="Supplier's establishment name" required>
                    </div>
                    <div class="input-group">
                        <label for="po_no">P.O. No.</label>
                        <input type="text" id="po_no" name="po_no" value="<?php echo $po_no; ?>" readonly required >
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Supplier's Address" required>
                    </div>
                    <div class="input-group">
                        <label for="date">P.O. Date</label>
                        <input type="date" id="date1" name="date" placeholder="Select PO Date" required>
                    </div>
                </div>
                <div class="grid-2">
                <div class="input-group">
                    <label for="tin">TIN</label>
                    <input 
                        type="text" 
                        id="tin" 
                        placeholder="Leave this blank" 
                        name="tin" 
                        maxlength="15" 
                        oninput="formatTIN(this)" 
                        pattern="^\d{3}-\d{3}-\d{3}(-\d{3})?$" 
                        title="TIN must be in the format 123-456-789 or 123-456-789-000" >
                    </div>
                    <div class="input-group">
                        <label for="mode_procurement">
                        Mode of Procurement 
                        <a href="https://rgao.upm.edu.ph/2020/12/10/modes-of-procurement/?fbclid=IwY2xjawHkJPNleHRuA2FlbQIxMAABHUmpRVigoqML4qc9K7Iy5_VDMalIxoRb2mrD8wWwfdanstzUAMQ_iJwHYg_aem_y4XHAkhCL41MwVL2mDwdFQ" target="_blank">
                        <i class="fas fa-question-circle" style="font-size: 16px; margin-left: 2px;" data-toggle="tooltip" title="The Mode of Procurement refers to the way an organization buys goods, and services. This methods are used to make sure the buying process is fair, clear, and follows the rules and regulations. These methods are usually set by laws or policies that guide how purchases should be made."></i>
                        </a>
                    </label>
                        <input list="modes" id="mode_procurement" name="mode_procurement" placeholder="Select or type..." required>
                        <datalist id="modes">
                            <?php 
                                $modesQuery = $conn->query("SELECT * FROM mode_procurement");
                                while ($row = $modesQuery->fetch(PDO::FETCH_ASSOC)): 
                            ?>
                                <option value="<?php echo htmlspecialchars($row['mode_name']); ?>"><?php echo htmlspecialchars($row['mode_name']); ?></option>
                            <?php endwhile; ?>
                        </datalist>
                    </div>
            </section>

            <!-- Delivery and Payment Terms -->
            <section class="form-section" id="section2" style="display:none;" >
                <h3>Delivery and Payment Terms</h3>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="place_delivery">Place of Delivery</label>
                        <input type="text" id="place_delivery" name="place_delivery" value="EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City" placeholder="Delivery Place" required>
                    </div>
                    <div class="input-group">
                        <label for="delivery_term">
                        Delivery Term 
                        <a href="https://coaregion12.ph/phocadownloadpap/Bidding/Procurement-of-Information-and-Communication-Technology-Equipment-ICTE-Batch-2-Bid-No.-COA-RO12-2023-006.pdf" target="_blank">
                        <i class="fas fa-question-circle" style="font-size: 16px; margin-left: 2px;" data-toggle="tooltip" title="The Delivery Term is the agreement between the buyer and the supplier on how and when the goods or services will be delivered. It covers details like where the goods will be delivered, who will pay for shipping, and when the delivery will happen."></i>
                        </a>
                    </label>
                        <input list="deliveryTerms" id="delivery_term" name="delivery_term" placeholder="Select or type..." required>
                        <datalist id="deliveryTerms">
                            <?php 
                                $termsQuery = $conn->query("SELECT * FROM delivery_term");
                                while ($row = $termsQuery->fetch(PDO::FETCH_ASSOC)): 
                            ?>
                                <option value="<?php echo htmlspecialchars($row['term_name']); ?>"><?php echo htmlspecialchars($row['term_name']); ?></option>
                            <?php endwhile; ?>
                        </datalist>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="date_delivery">Date of Delivery</label>
                        <input type="date" id="date_delivery" name="date_delivery" placeholder="Leave this blank" >
                    </div>
                    <div class="input-group">
                        <label for="payment_term">
                        Payment Term 
                        <a href="https://www.coa.gov.ph/wp-content/uploads/ABC-Help/Updated_Guidelines_in_the_Audit_of_Procurement/annex%203/Section4-4.htm" target="_blank">
                        <i class="fas fa-question-circle" style="font-size: 16px; margin-left: 2px;" data-toggle="tooltip" title="The Payment Term is the agreement between the buyer and the supplier on how and when the payment for the goods or services will be made. It explains the payment amount, how the payment will be made, and when it is due."></i>
                        </a>
                    </label>
                        <input type="text" id="payment_term" name="payment_term" placeholder="e.g Check" required>
                    </div>
                </div>
            </section>

            <!-- Item Details -->
            <section class="form-section" id="section3" style="display:none;">
                <h3>Item Details</h3>
                <div class="table-responsive">
                    <table class="table" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style="width: 130px;">Stock/Property No.</th>
                                <th style="width: 100px;">Unit</th>
                                <th style="width: 150px;">Description</th>
                                <th style="width: 100px;">Quantity</th>
                                <th style="width: 100px;">Unit Cost</th>
                                <th style="width: 100px;">Amount</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="item-rows">
                        </tbody>
                    </table>
                </div>
                
                <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="addItemModalLabel">Add Item</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <input type="hidden" name="label_text[]" id="label_text_1" value=""> 
                            <div class="modal-body">
                            <div class="grid-1">
                            <div class="input-group">
                           <label for="stock_no">Stock/Property No.</label>
                           <input type="text" class="modal-input" id="stock_no" name="item_details[stock_no][]" readonly> 
                       </div>
                   </div>
                   <div class="grid-1">
                    <div class="input-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="modal-input-units" id="unit" list="units" name="item_details[unit][]" placeholder="Select Unit">
                        <datalist id="units">
                            <option value="">Select Unit</option>
                            <?php 
                            $units = $conn->query("SELECT * FROM units");
                            while ($row = $units->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo $row['unit_code']; ?>">
                                    <?php echo $row['unit_name']; ?> (<?php echo $row['unit_code']; ?>)
                                </option>
                            <?php endwhile; ?>
                        </datalist>
                    </div>
                </div>
                   <div class="grid-1">
                       <div class="input-group">
                           <label for="description">Description</label>
                           <input class="modal-input description-input" id="description" name="item_details[description][]" placeholder="Item/Product Description"></input>
                       </div>
                   </div>
                   <div class="grid-1">
                       <div class="input-group">
                           <label for="quantity">Quantity</label>
                           <input type="number" class="modal-input quantity-input" id="quantity" name="item_details[quantity][]" oninput="validateInput(this)">
                       </div>
                   </div>
                   <div class="grid-1">
                       <div class="input-group">
                           <label for="unit_cost">Unit Cost</label>
                           <input type="number" class="modal-input" id="unit_cost" name="item_details[unit_cost][]" oninput="validateInput(this)" onblur="formatToTwoDecimals(this)">
                       </div>
                   </div>
                   <div class="grid-1">
                       <div class="input-group">
                           <label for="amount">Amount</label>
                           <input type="number" class="modal-input" id="amount" name="item_details[amount][]" onblur="formatToTwoDecimals(this)" readonly>
                       </div>
                   </div>
                    <button type="button" class="button-modal" onclick="addItemToTable()"><i class="fas fa-check-circle"></i> Done</button>
                   </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary add-button" data-toggle="modal" data-target="#addLabelModal"><i class="fas fa-tag"></i> Project Description</button>
                <button type="button" class="btn btn-primary add-button" data-toggle="modal" data-target="#addItemModal" onclick="checkProjectDescription()"> <i class="fas fa-plus-circle"></i> Add Item/Product</button>
                <button type="button" class="btn btn-primary add-button" data-toggle="modal" data-target="#addItemSpecificationModal" onclick="checkProjectDescription()"><i class="fas fa-cogs"></i> Item Specification</button>
                <div class="input-group">
                    <label for="total_amount_words">Total Amount (In Words)</label>
                    <input type="text" id="total_amount_words" name="total_amount_words" placeholder="Total Amount" readonly required>
                </div>
            </section>

            <!-- Item Specification Modal -->
            <div class="modal fade" id="addItemSpecificationModal" tabindex="-1" aria-labelledby="addItemSpecificationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addItemSpecificationModalLabel">Item Specification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Item No. Input -->
                            <div class="form-group" style="display: none;">
                                <label for="item_no">Item No.</label>
                                <input type="text" class="form-control" name="item_details[item_no][]" id="item_no" readonly>
                            </div>

                            <!-- Item Specification Input -->
                            <div class="form-group">
                                <label for="item_specification">Item Specification</label>
                                <textarea class="form-control" id="item_specification" name="item_details[item_specification][]" rows="3" placeholder="Enter Item Specifications"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveItemSpecification()">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Item Specification Modal -->
            <!-- Edit Item Specification Modal -->
            <div class="modal fade" id="editItemSpecificationModal" tabindex="-1" aria-labelledby="editItemSpecificationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editItemSpecificationModalLabel">Edit Item Specification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_item_specification">Item Specification</label>
                                <textarea class="form-control" id="edit_item_specification" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveEditItemSpecification()">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Label Modal -->
            <div class="modal fade" id="addLabelModal" tabindex="-1" role="dialog" aria-labelledby="addLabelModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="addLabelModalLabel">Add Project Description</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group" style="display: none;">
                            <label for="labelNo">Label No</label>
                            <input type="number" id="labelNo" name="label_no" class="form-control" placeholder="Enter label number" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fundType">Select Fund Type</label>
                            <select id="fundType" name="fund_type" class="form-control">
                                <option value="" disabled selected>Select Fund Type</option> <!-- Placeholder as the first option -->
                                <option value="IGF">Internally Generated Funds (IGF)</option>
                                <option value="RAF">Regular Agency Fund (RAF)</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="labelText">Project Description</label>
                        <input type="text" id="labelText" name="label_text" class="form-control" placeholder="Enter project" list="projectDescriptions">
                        <datalist id="projectDescriptions">
                            <option value="">Select Project Description</option> 
                        </datalist>
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="addLabelToTable()">Add</button>
                        </div>
                    </div>
                </div>
            </div>

        <div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="editItemModalLabel">Edit Item</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="grid-1">
                            <div class="input-group">
                                <label for="edit_stock_no">Stock/Property No.</label>
                                <input type="text" class="modal-input" id="edit_stock_no" name="edit_item_details[stock_no]" readonly>
                            </div>
                        </div>
                        <div class="grid-1">
                        <div class="input-group">
                        <label for="edit_unit">Unit</label>
                        <input type="text" class="modal-input-units" id="edit_unit" list="edit_units" name="edit_item_details[unit]">
                        <datalist id="edit_units">
                            <option value="">Select Unit</option>
                            <?php $units = $conn->query("SELECT * FROM units");?>
                            <?php while ($row = $units->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $row['unit_name']; ?> (<?php echo $row['unit_code']; ?>)"><?php echo $row['unit_name']; ?></option>
                            <?php endwhile; ?>
                        </datalist>
                        </div>
                        </div>
                        <div class="grid-1">
                            <div class="input-group">
                                <label for="edit_description">Description</label>
                                <input class="modal-input description-input" id="edit_description" placeholder="Item/Product Description" name="edit_item_details[description]"></input>
                            </div>
                        </div>
                        <div class="grid-1">
                            <div class="input-group">
                                <label for="edit_quantity">Quantity</label>
                                <input type="number" class="modal-input quantity-input" id="edit_quantity" name="edit_item_details[quantity]" oninput="validateInput(this)">
                            </div>
                        </div>
                        <div class="grid-1">
                            <div class="input-group">
                                <label for="edit_unit_cost">Unit Cost</label>
                                <input type="number" class="modal-input" id="edit_unit_cost" name="edit_item_details[unit_cost]" oninput="validateInput(this)" onblur="formatToTwoDecimals(this)">
                            </div>
                        </div>
                        <div class="grid-1">
                            <div class="input-group">
                                <label for="edit_amount">Amount</label>
                                <input type="number" class="modal-input" id="edit_amount" name="edit_item_details[amount]" onblur="formatToTwoDecimals(this)" readonly>
                            </div>
                        </div>
                        <button type="button" class="button-modal" onclick="updateItem()"><i class="fas fa-check-circle"></i> Update</button>
                    </div>
                </div>
            </div>
        </div>

<!-- Edit Label Modal -->
            <div class="modal fade" id="editLabelModal" tabindex="-1" role="dialog" aria-labelledby="editLabelModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLabelModalLabel">Edit Label</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="editLabelText" class="form-control" placeholder="Enter new label text" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveEditLabel">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conforme -->
            <section class="form-section" id="section4" style="display:none;">
                <h3>Conforme</h3>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="signature_supplier">Name of Supplier (Personnel)</label>
                        <input type="text" id="signature_supplier" name="signature_supplier" placeholder="Leave this blank" >
                    </div>
                    <div class="input-group">
                    <label for="signature_official">Name of Authorized Official</label>
                    <?php 
                        $official_name = '';
                        $query = $conn->query("SELECT end_user_name FROM end_users WHERE requisitioning_office = 'Campus Director'");
                        if ($query->rowCount() > 0) {
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $official_name = $row['end_user_name'];
                        } 
                    ?>
                    <input style="text-transform: uppercase;" type="text" id="signature_official" name="signature_official" placeholder="Authorized Official" value="<?php echo $official_name; ?>" required>
                </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="supplier_date">Supplier Date</label>
                        <input type="date" id="supplier_date" name="supplier_date" placeholder="Leave this blank" >
                    </div>
                    <div class="input-group">
                    <label for="designation">Designation</label>
                    <?php 
                        $designation = '';
                        $query = $conn->query("SELECT requisitioning_office FROM end_users WHERE requisitioning_office = 'Campus Director'");
                        if ($query->rowCount() > 0) {
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $designation = $row['requisitioning_office'];
                        } 
                    ?>
                    <input style="text-transform: uppercase;" type="text" id="designation" name="designation" placeholder="Designation" value="<?php echo $designation; ?>" required>
                </div>
                </div>
            </section>

            <!-- Fund Details -->
            <section class="form-section" id="section5" style="display:none;">
                <h3>Fund Details</h3>
                <p style="text-align: center; color: gray; font-size: 13px;">Note: <span style="color: red;">*</span>The Fund Details section is for the Budget Allocation and Accounting and this is not part of the Procurement Office so please leave it blank.</p>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="fund_cluster">Fund Cluster</label>
                        <input type="text" id="fund_cluster" placeholder="Leave this blank" name="fund_cluster" >
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_no">ORS/BURS No.</label>
                        <input type="text" id="ors_burs_no" placeholder="Leave this blank" name="ors_burs_no" >
                    </div>
                    </div>

                    <div class="grid-2">
                    <div class="input-group">
                        <label for="funds_available">Funds Available</label>
                        <input type="text" id="funds_available" placeholder="Leave this blank" name="funds_available" >
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_date">Date of the ORS/BURS</label>
                        <input type="date" id="ors_burs_date" name="ors_burs_date" placeholder="Leave this blank" >
                    </div>
                    </div>
                    
                    <?php 
                        $accountant_name = '';
                        $query = $conn->query("SELECT end_user_name FROM end_users WHERE requisitioning_office = 'Accountant Designate'");
                        if ($query->rowCount() > 0) {
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $accountant_name = $row['end_user_name'];
                        } 
                    ?>
                    
                    <div class="grid-2">
                    <div class="input-group">
                        <label for="signature_accountant">Name of Head of Accountant</label>
                        <input style="text-transform: uppercase;" type="text" id="signature_accountant" placeholder="Head of the Accountant" name="signature_accountant" value="<?php echo $accountant_name; ?>" >
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_amount">Amount</label>
                        <input type="number" id="ors_burs_amount" placeholder="Leave this blank" name="ors_burs_amount">
                    </div>
                    </div>
            </section>

            <section class="form-section">
            <div class="d-flex justify-content-between align-items-center">
                    <button type="button" onclick="showPreviousSection()" class="badge badge-light badge-pill" id="backButton" style="display:none;"> Previous </button>
                    <button type="button" onclick="showNextSection()" class="badge badge-light badge-pill" id="nextButton"> Next </button>
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
                            Are you sure you want to submit this Purchase Order? Please double-check that all details are correct.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="po_form" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </main>
<?php include '../../pclasses/footer.php'; ?>
<script>
function formatToTwoDecimals(input) {
        if (input.value) {
            input.value = parseFloat(input.value).toFixed(2);
        }
    }
</script>