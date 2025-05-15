<?php
require '../../class/function/config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/supply_office_staff.php';

?>
<title>Delivered Item's</title>
<main class="container mt-5 custom-container">
<div class="table-responsive">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
            <h2>Delivered Item's</h2>
            <div class="button-container float-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deliveryHistoryModal">
                    <i class="fas fa-plus"></i> Add Item's
                </button>
            </div>
        </div>
    </div>
</div>
<table id="Itemstable" class="table table-striped table-bordered" style="table-layout: fixed;">
    <thead>
        <tr>
            <th style="width: 80px;">PO No</th>
            <th style="width: 100px;">Item</th>
            <th style="width: 60px;">Date Delivered</th>
            <th style="width: 90px;">Quantity</th>
            <th style="width: 50px;">Status</th>
            <th style="width: 20px;">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($arrivedItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['po_no']) ?></td>
                <td><?= htmlspecialchars($item['description']) ?></td>
                <td><?= htmlspecialchars($item['delivery_date']) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td>
                <?php 
                    $status = htmlspecialchars($item['status']);
                    $badgeClass = ($status === 'Inspected') ? 'badge badge-success rounded-pill' : 'badge bg-danger rounded-pill';
                ?>
                <span class="<?= $badgeClass ?>"><?= $status ?></span>
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-secondary" type="button" id="dropdownMenuButton<?php echo $item['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $item['id']; ?>">
                        <a class="dropdown-item ai-dropdown-item" href="#" onclick="editItem(
                            '<?= $item['id'] ?>',
                            '<?= htmlspecialchars($item['po_no']) ?>',
                            '<?= htmlspecialchars($item['description']) ?>',
                            '<?= htmlspecialchars($item['delivery_date']) ?>',
                            '<?= htmlspecialchars($item['invoice_no']) ?>',
                        )">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a class="dropdown-item ai-dropdown-item text-danger" href="#" onclick="openDeleteModal('<?= $item['id'] ?>')">
    <i class="fas fa-trash-alt"></i> Delete
</a>

                    </div>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Delivered Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                    <input type="hidden" id="editItemId" name="id">
                    
                    <div class="form-group">
                        <label for="editPoNo">P.O No.</label>
                        <input type="text" class="form-control" id="editPoNo" name="po_no" readonly>
                    </div>

                    <div class="form-group">
                        <label for="editDescription">Item</label>
                        <input type="text" class="form-control" id="editDescription" name="description" readonly>
                    </div>

                    <div class="form-group">
                        <label for="editDeliveryDate">Date Delivered</label>
                        <input type="date" class="form-control" id="editDeliveryDate" name="delivery_date">
                    </div>

                    <div class="form-group">
                        <label for="editInvoiceNo">Invoice No.</label>
                        <input type="number" class="form-control" id="editInvoiceNo" name="invoice_no">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="saveEditedItem()">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteItemModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
                <input type="hidden" id="deleteItemId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- ADD DELIVERED ITEM -->
<div class="modal fade" id="deliveryHistoryModal" tabindex="-1" role="dialog" aria-labelledby="deliveryHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deliveryHistoryModalLabel">Add Item's Arrived</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

        <div id="itemsDeliveryDateSection">
        <form id="itemsDeliveryForm">

        <div class="form-row">
        <div class="form-group col-md-12">
            <label for="poNo">P.O No.</label>
            <select class="form-control" id="poNo" name="poNo" onchange="fetchStockNumbers(this.value)">
                <option value="" disabled selected>Select PO No.</option>
                <?php
                try {
                    $stmt = $conn->prepare("SELECT DISTINCT po_no FROM purchase_orders WHERE status IN ('approved', 'Incomplete') ORDER BY po_no DESC");
                    $stmt->execute();
                    $po_numbers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($po_numbers as $row) {
                        echo '<option value="' . htmlspecialchars($row['po_no']) . '">' . htmlspecialchars($row['po_no']) . '</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option value="">Error loading POs</option>';
                }
                ?>
            </select>
        </div>
    </div>
        <div class="form-group col-md-12">
            <label for="stockNoDropdown">Stock/Property No.</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="stockNoDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Stock No.
                </button>
                <div class="dropdown-menu w-100 p-2" aria-labelledby="stockNoDropdown" id="stockNoMenu">
                    <!-- Checkboxes will be inserted here dynamically -->
                </div>
            </div>
            <input type="hidden" id="selectedStockNos" name="selectedStockNos">
            <input type="hidden" id="selectedQuantities" name="selectedQuantities">
            <input type="hidden" id="selectedUnits" name="selectedUnits">
            <input type="hidden" id="selectedUnitCosts" name="selectedUnitCosts">
            <input type="hidden" id="selectedAmounts" name="selectedAmounts">
            <input type="hidden" id="selectedPoIds" name="selectedPoIds">
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="deliveryDate">Date Delivered</label>
                <input type="text" class="form-control flatpickr-input" id="deliveryDate" name="deliveryDate" placeholder="Select Date">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="invoice_no">Invoice No.</label>
                <input type="number" class="form-control" id="invoice_no" name="invoice_no" min="1" placeholder="Enter Invoice No.">
            </div>
        </div>
    </form>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-success" id="saveDeliveryBtn">Save</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</main>

<script src="../../class/js/delivery_date.js"></script>
<script src="../../class/js/save_arrived.js"></script>
<?php include '../../../sclasses/footer.php'; ?>
