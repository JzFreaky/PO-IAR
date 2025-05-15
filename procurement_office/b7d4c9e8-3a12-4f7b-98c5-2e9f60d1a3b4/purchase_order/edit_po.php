<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';
?>
<title>Edit Purchase Order Form</title>
    <main class="container mt-5 custom-container">
        <h2>Update Purchase Order</h2>
        <form action="" method="POST">
        <section class="form-section" id="edit_section1">
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
                        <div class="selected-requestors" id="selectedRequestors">
                            <?php if (!empty($requestorName)): 
                                $requestorsArray = explode("/", $requestorName);

                                foreach ($requestorsArray as $requestor) { 
                                    $parts = explode("\n", trim($requestor));
                                    $name = trim($parts[0]);
                                    $title = isset($parts[1]) ? trim($parts[1]) : '';

                                    echo '<div class="selected-requestor" data-requestor="' . htmlspecialchars($name) . '">';
                                    echo htmlspecialchars($name) . '<br>' . htmlspecialchars($title);
                                    echo '<span class="remove-requestor" onclick="editremoveRequestor(this)"><i class="fas fa-times"></i></span>';
                                    echo '</div>'; 
                                }
                            endif; ?>
                        </div>
                    </div>
                        <input type="text" class="search-box" placeholder="Select or Search..." id="searchBox" onkeyup="filterItems()" onclick="toggleDropdown()" autocomplete="off"value="<?= htmlspecialchars($order['requestor']) ?>">
                        <div class="select-items" id="selectItems">
                            <?php foreach ($requestors as $requestor): ?>
                                <div class="selectable-item" onclick="selectRequestor('<?php echo htmlspecialchars($requestor['end_user_name']); ?>')"><?php echo htmlspecialchars($requestor['end_user_name']); ?> - <?php echo htmlspecialchars($requestor['requisitioning_office']); ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <input type="hidden" id="requestor" name="requestor[]" value="<?php echo htmlspecialchars($requestorName); ?>">
                </div>
                <div class="input-group" >
                        <label for="requisitioning_office">Requisitioning Office</label>
                        <input type="text" id="requisitioning_office" name="requisitioning_office" value="<?= htmlspecialchars($order['requisitioning_office']) ?>" readonly required>
                    </div>
                    </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="supplier">Supplier</label>
                        <input style="text-transform: uppercase;" type="text" id="supplier" name="supplier" value="<?= htmlspecialchars($order['supplier']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="po_no">P.O. No.</label>
                        <input type="text" id="po_no" name="po_no" value="<?= htmlspecialchars($order['po_no']) ?>"  required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="<?= htmlspecialchars($order['address']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" placeholder="Select PO Date" value="<?= htmlspecialchars($order['date']) ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="tin">TIN</label>
                        <input 
                        type="text" 
                        id="tin" 
                        placeholder="TIN of the Supplier" 
                        name="tin" 
                        maxlength="15" 
                        oninput="formatTIN(this)" 
                        pattern="^\d{3}-\d{3}-\d{3}(-\d{3})?$" 
                        title="TIN must be in the format 123-456-789 or 123-456-789-000"
                        value="<?= htmlspecialchars($order['tin']) ?>" 
                        >
                    </div>
                    <div class="input-group">
                    <label for="mode_procurement">
                        Mode of Procurement 
                        <a href="https://rgao.upm.edu.ph/2020/12/10/modes-of-procurement/?fbclid=IwY2xjawHkJPNleHRuA2FlbQIxMAABHUmpRVigoqML4qc9K7Iy5_VDMalIxoRb2mrD8wWwfdanstzUAMQ_iJwHYg_aem_y4XHAkhCL41MwVL2mDwdFQ" target="_blank">
                        <i class="fas fa-question-circle" style="font-size: 16px; margin-left: 2px;" data-toggle="tooltip" title="The Mode of Procurement refers to the way an organization buys goods, and services. This methods are used to make sure the buying process is fair, clear, and follows the rules and regulations. These methods are usually set by laws or policies that guide how purchases should be made."></i>
                        </a>
                    </label>
                    <input list="modes" id="mode_procurement" name="mode_procurement" placeholder="Select or type..." value="<?php echo htmlspecialchars($order['mode_procurement']) ?>" required>
                    <datalist id="modes">
                            <?php 
                                $modesQuery = $conn->query("SELECT * FROM mode_procurement");
                                while ($row = $modesQuery->fetch(PDO::FETCH_ASSOC)): 
                            ?>
                                <option value="<?php echo htmlspecialchars($row['mode_name']); ?>"><?php echo htmlspecialchars($row['mode_name']); ?></option>
                            <?php endwhile; ?>
                        </datalist>
                </div>
                </div>
            </section>

            <!-- Delivery and Payment Terms -->
            <section class="form-section" id="edit_section2" style="display:none;" >
                <h3>Delivery and Payment Terms</h3>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="place_delivery">Place of Delivery</label>
                        <input type="text" id="place_delivery" name="place_delivery" value="<?= htmlspecialchars($order['place_delivery']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="delivery_term">
                        Delivery Term 
                        <a href="https://coaregion12.ph/phocadownloadpap/Bidding/Procurement-of-Information-and-Communication-Technology-Equipment-ICTE-Batch-2-Bid-No.-COA-RO12-2023-006.pdf" target="_blank">
                        <i class="fas fa-question-circle" style="font-size: 16px; margin-left: 2px;" data-toggle="tooltip" title="The Delivery Term is the agreement between the buyer and the supplier on how and when the goods or services will be delivered. It covers details like where the goods will be delivered, who will pay for shipping, and when the delivery will happen."></i>
                        </a>
                    </label>
                        <input list="deliveryTerms" id="delivery_term" name="delivery_term" value="<?= htmlspecialchars($order['delivery_term']) ?>" placeholder="Select or type..." required>
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
                        <input type="date" id="date_delivery" name="date_delivery" placeholder="Select Date" value="<?= htmlspecialchars($order['date_delivery']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="payment_term">
                        Payment Term 
                        <a href="https://www.coa.gov.ph/wp-content/uploads/ABC-Help/Updated_Guidelines_in_the_Audit_of_Procurement/annex%203/Section4-4.htm" target="_blank">
                        <i class="fas fa-question-circle" style="font-size: 16px; margin-left: 2px;" data-toggle="tooltip" title="The Payment Term is the agreement between the buyer and the supplier on how and when the payment for the goods or services will be made. It explains the payment amount, how the payment will be made, and when it is due."></i>
                        </a>
                    </label>
                        <input type="text" id="payment_term" name="payment_term" value="<?= htmlspecialchars($order['payment_term']) ?>" required>
                    </div>
                </div>
            </section>

            <!-- Item Details -->
    <section class="form-section" id="edit_section3" style="display:none;">
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
            <?php 
                // Sort items and labels
                ksort($labelMap);
                $currentLabelIndex = 0;
                $itemIndex = 0;
                
                // Fetch item specifications from the database
                $itemSpecifications = [];
                $query = "SELECT id, po_id, item_no, item_specification FROM po_item_specifications WHERE po_id = ?"; // Added 'id' to SELECT
                $stmt = $conn->prepare($query);
                $stmt->execute([$po_id]);
                $organizedSpecifications = []; //Create an array to organize the data

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //Organize the array to match the previous structure
                    $organizedSpecifications[$row['item_no']][] = $row; //Store the entire row, including 'id'
                }

                // Loop through all items
                foreach ($items as $item):
                    // Check if there are labels for the current stock_no
                    if (isset($labelMap[$item['stock_no']])): 
                        foreach ($labelMap[$item['stock_no']] as $label): ?>
                            <tr class="label-row" data-label-id="<?php echo $label['id']; ?>">
                                <td colspan="6">
                                    <?php echo htmlspecialchars($label['label_text']); ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="editLabelRow(this)" title="Edit" data-label-no="<?php echo $item['stock_no']; ?>"> 
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeLabelRow(this)" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; 
                    endif; ?>

                    <!-- Display the item row -->
                    <tr class="item-row">
                        <td><?php echo htmlspecialchars($item['stock_no']); ?></td>
                        <td><?php echo htmlspecialchars($item['unit']); ?></td>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($item['unit_cost']); ?></td>
                        <td><?php echo htmlspecialchars($item['amount']); ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" onclick="editRow(this)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, '<?php echo htmlspecialchars($item['stock_no']); ?>', '<?php echo htmlspecialchars($item['po_id']); ?>')">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
            
            <?php 
                $specifications = isset($organizedSpecifications[$item['stock_no']]) ? $organizedSpecifications[$item['stock_no']] : [];
                foreach ($specifications as $spec): ?>
                    <tr class="specification-row" 
                        data-poid="<?php echo htmlspecialchars($item['po_id']); ?>" 
                        data-itemno="<?php echo htmlspecialchars($item['stock_no']); ?>"
                        data-id="<?php echo htmlspecialchars($spec['id']); ?>"> 
                        <td></td> 
                        <td></td> 
                        <td colspan="1"><?php echo htmlspecialchars($spec['item_specification']); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" onclick="editSpecification(this)" title="Edit Specification">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeSpecification(this)" title="Remove Specification">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php foreach ($labelMap as $labelNo => $labels): ?>
                <?php 
                // Check if this label_no is not already displayed
                if (!in_array($labelNo, array_column($items, 'stock_no'))): 
                    foreach ($labels as $label): ?>
                        <tr class="label-row" data-label-id="<?php echo htmlspecialchars($label['id']); ?>">
                            <td colspan="6">
                                <?php echo htmlspecialchars($label['label_text']); ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="editLabelRow(this)" title="Edit" data-label-no="<?php echo $labelNo; ?>"> 
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeLabelRow(this)" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; 
                endif; 
            endforeach; ?>
        </tbody>
    </table>
</div>

    <!-- Add item Modal -->
    <div class="modal fade" id="additemModal" tabindex="-1" aria-labelledby="additemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="additemModalLabel">Add Item</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                    <input type="hidden" name="label_text[]" id="label_text_1" value=""> 
            <div class="modal-body">
            <div class="grid-1">
                <div class="input-group">
                    <label for="stock_no">Stock/Property No.</label>
                    <input type="text" class="modal-input" id="stock_no2" name="item_details[stock_no][]" readonly> 
                </div>
            </div>
                <div class="grid-1">
                   <div class="input-group">
                    <label for="unit">Unit</label>
                    <input type="text" class="modal-input-units" id="unit" list="units" name="item_details[unit][]">
                    <datalist id="units">
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
                           <label for="description">Description</label>
                           <input class="modal-input description-input" id="description" name="item_details[description][]"></input>
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
                    <button type="button" class="button-modal" onclick="additemtotable()"><i class="fas fa-check-circle"></i> Done</button>
                   </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary add-button" data-toggle="modal" data-target="#addlabelModal"><i class="fas fa-tag"></i> Add Project Description</button>
                <button type="button" class="btn btn-primary add-button" data-toggle="modal" data-target="#additemModal"><i class="fas fa-plus-circle"></i> Add Item/Product</button>
                <button type="button" class="btn btn-primary add-button" onclick="setItemNo('<?php echo $item['stock_no']; ?>')" data-toggle="modal" data-target="#addItemSpecificationModal"><i class="fas fa-cogs"></i> Item Specification</button>
                <div class="input-group">
                    <label for="total_amount_words">Total Amount (In Words)</label>
                    <input type="text" id="total_amount_words" name="total_amount_words" value="<?= htmlspecialchars($order['total_amount_words']) ?>" readonly required>
                </div>
            </section>

            <!--  add label Modal -->
        <div class="modal fade" id="addlabelModal" tabindex="-1" role="dialog" aria-labelledby="addlabelModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="addlabelModalLabel">Add Project Description</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="labelNoGroup" style="display: none;">
                            <label for="labelNo">Label No</label>
                            <?php
                            $nextLabelNo = 1; 
                            foreach ($items as $item) {
                                $stockNo = $item['stock_no'];
                                if ($stockNo > $nextLabelNo) {
                                    $nextLabelNo = $stockNo;
                                }
                            }
                            $nextLabelNo++;
                            ?>
                            <input type="number" id="labelNo" name="label_no" class="form-control" placeholder="Enter label number" value="<?php echo $nextLabelNo; ?>" readonly>
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
                        <button type="button" class="btn btn-primary" onclick="addLabel()">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit item Modal -->
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
                                <input class="modal-input description-input" id="edit_description" name="edit_item_details[description]"></input>
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
                        <button type="button" class="button-modal" onclick="updateitem()"><i class="fas fa-check-circle"></i> Update</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Label Modal -->
        <div class="modal fade" id="editlabelModal" tabindex="-1" role="dialog" aria-labelledby="editlabelModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editlabelModalLabel">Edit Label</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="display: none;">
                        <input type="number" id="edit_label_no" class="form-control" placeholder="Enter new label no" />
                        <input type="hidden" id="edited_label_no" name="edited_label_no[]" value="">
                    </div>
                    <div class="modal-body">
                        <input type="text" id="edit_label" class="form-control" placeholder="Enter new label text" />
                        <input type="hidden" id="edited_label_text" name="edited_label_text[]" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="seditlabel">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Specification Modal -->
        <div class="modal fade" id="editSpecificationModal" tabindex="-1" role="dialog" aria-labelledby="editSpecificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSpecificationModalLabel">Edit Specification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="specificationText">Item Specification</label>
                    <input type="text" class="form-control" id="specificationText">

                    <input type="hidden" id="specificationIdHidden">

                    <input type="hidden" id="poIdHidden">  <!-- Inside the modal body -->
                    <input type="hidden" id="itemNoHidden"> <!-- Inside the modal body -->
                    <input type="hidden" id="updatedSpecification">
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSpecificationBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>


        <!--Add Item Specification Input -->
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
                            <div class="form-group">
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
            
            <!-- Edit Added Item Specification Input -->
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


            <!-- Conforme -->
            <section class="form-section" id="edit_section4" style="display:none;">
            <h3>Conforme</h3>
            <div class="grid-2">
                    <div class="input-group">
                        <label for="signature_supplier">Name of Supplier</label>
                        <input type="text" id="signature_supplier" name="signature_supplier" placeholder="Supplier in-charge" value="<?= htmlspecialchars($order['signature_supplier']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="signature_official">Name of Authorized Official</label>
                        <input style="text-transform: uppercase;" type="text" id="signature_official" name="signature_official" value="<?= htmlspecialchars($order['signature_official']) ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="supplier_date">Date</label>
                        <input type="date" id="supplier_date" name="supplier_date" placeholder="Select Supplier Date" value="<?= htmlspecialchars($order['supplier_date']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="designation">Designation</label>
                        <input style="text-transform: uppercase;" type="text" id="designation" name="designation" value="<?= htmlspecialchars($order['designation']) ?>" required>
                    </div>
                </div>
                </section>

            <!--Fund Details -->
            <section class="form-section" id="edit_section5" style="display:none;">
                <h3>Fund Details</h3>
                <p style="text-align: center; color: gray; font-size: 13px;">Note: <span style="color: red;">*</span>The Fund Details section is for the Budget Allocation and Accounting and this is not part of the Procurement Office so please leave it blank.</p>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="fund_cluster">Fund Cluster</label>
                        <input type="text" id="fund_cluster" name="fund_cluster" placeholder="e.g IGF" value="<?= htmlspecialchars($order['fund_cluster']) ?>" >
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_no">ORS/BURS No.</label>
                        <input type="text" id="ors_burs_no" name="ors_burs_no" placeholder="BURS no." value="<?= htmlspecialchars($order['ors_burs_no']) ?>" >
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="funds_available">Funds Available</label>
                        <input type="text" id="funds_available" name="funds_available" placeholder="Leave this blank" value="<?= htmlspecialchars($order['funds_available']) ?>" >
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_date">Date of the ORS/BURS</label>
                        <input type="date" id="ors_burs_date" name="ors_burs_date" placeholder="Leave this blank" value="<?= htmlspecialchars($order['ors_burs_date']) ?>" >
                    </div>
                    </div>
                    <div class="grid-2">
                    <div class="input-group">
                        <label for="signature_accountant">Name of Head of Accountant</label>
                        <input type="text" id="signature_accountant" name="signature_accountant" placeholder="Leave this blank" value="<?= htmlspecialchars($order['signature_accountant']) ?>">
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_amount">Amount</label>
                        <input type="number" id="ors_burs_amount" name="ors_burs_amount" placeholder="Amount" value="<?= htmlspecialchars($order['ors_burs_amount']) ?>">
                    </div>
                    
                </div>
            </section>

            <section class="form-section">
            <div class="d-flex justify-content-between align-items-center">
                    <button type="button" onclick="showPreviousEditSection()" class="badge badge-light badge-pill" id="backButton" style="display:none;"> Back </button>
                    <button type="button" onclick="showNextEditSection()" class="badge badge-light badge-pill" id="nextButton"> Next </button>
                    <button type="button" class="badge badge-primary badge-pill badge-pill-submit" id="submitButton" data-toggle="modal" data-target="#confirmSubmitModal" style="display: none;"><i class="fas fa-check"></i> Update</button>
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
                            <button type="update" name="po_form" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <script src="../js/edit_po.js"></script>
<script>
function updateProjectDescriptions() {
        const fundType = document.getElementById('fundType').value;
        const projectDescriptionsDataList = document.getElementById('projectDescriptions');
        projectDescriptionsDataList.innerHTML = '<option value="">Select Project Description</option>'; 

        if (fundType === 'IGF') {
            <?php 
                $igfOptions = ''; 
                $igfQuery = $conn->query("SELECT * FROM igf");
                while ($row = $igfQuery->fetch(PDO::FETCH_ASSOC)):
                    $igfOptions .= '<option value="' . htmlspecialchars($row['project_description']) . '">' . htmlspecialchars($row['project_description']) . '</option>';
                endwhile; 
            ?>
            projectDescriptionsDataList.innerHTML += '<?php echo $igfOptions; ?>';
        } else if (fundType === 'RAF') {
            <?php 
                $rafOptions = ''; 
                $rafQuery = $conn->query("SELECT * FROM raf");
                while ($row = $rafQuery->fetch(PDO::FETCH_ASSOC)):
                    $rafOptions .= '<option value="' . htmlspecialchars($row['project_description']) . '">' . htmlspecialchars($row['project_description']) . '</option>';
                endwhile; 
            ?>
            projectDescriptionsDataList.innerHTML += '<?php echo $rafOptions; ?>';
        }
    }
    document.getElementById('fundType').addEventListener('change', updateProjectDescriptions);



function editSpecification(button) {
    const row = button.closest('tr');
    const specText = row.querySelector('td[colspan="1"]').textContent;
    const specId = row.dataset.id; // Fetch the unique ID

    document.getElementById('specificationText').value = specText;
    document.getElementById('specificationIdHidden').value = specId; // Store the unique ID
    $('#editSpecificationModal').modal('show');
}


document.getElementById('saveSpecificationBtn').addEventListener('click', function () {
    const updatedSpecText = document.getElementById('specificationText').value;
    const specId = document.getElementById('specificationIdHidden').value;

    $.ajax({
        url: 'update_specification.php',
        type: 'POST',
        data: {
            action: 'update_specification',
            id: specId,
            updated_specification: updatedSpecText,
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                $(`tr[data-id="${specId}"] td[colspan="1"]`).text(updatedSpecText);
                $('#editSpecificationModal').modal('hide');

            } else {
                alert(response.message); // Or handle failure cases differently
            }
        },
        error: function (xhr, status, error) {
            alert('Error: ' + error);
        },
    });
});



// Function to handle removing the specification
function removeSpecification(button) {
        const row = button.closest('tr');
        const specId = row.dataset.id; // Retrieve specId from the row's data-id attribute

        $.ajax({
            url: 'update_specification.php',
            type: 'POST',
            data: {
                action: 'delete_specification',
                id: specId // Pass the specId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Remove the row from the table
                    row.remove();
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
    
function formatToTwoDecimals(input) {
    if (input.value) {
        input.value = parseFloat(input.value).toFixed(2);
    }
}

</script>

<?php include '../../pclasses/footer.php'; ?>   