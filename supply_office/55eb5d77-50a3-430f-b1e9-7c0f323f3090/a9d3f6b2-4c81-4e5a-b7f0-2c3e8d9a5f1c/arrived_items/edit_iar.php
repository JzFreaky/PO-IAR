<?php
require '../../class/function/config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';
require '../../class/function/inspector.php';
?>
<title>Edit Inspection and Acceptance Report</title>
<link rel="stylesheet" href="../../class/css/s.o.css">
<body>
    <main class="container mt-5 custom-container">
        <h2>Edit Inspection and Acceptance Report</h2>
        <form action="" method="POST">
            <section class="form-section">
                <h3>Entity and Supplier Information</h3>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="entity_name">Entity Name</label>
                        <input type="text" id="entity_name" name="entity_name" value="<?= htmlspecialchars($iar['entity_name']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="fund_cluster">Fund Cluster</label>
                        <input type="text" id="fund_cluster" name="fund_cluster" value="<?= htmlspecialchars($iar['fund_cluster']) ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" id="supplier" name="supplier" value="<?= htmlspecialchars($iar['supplier']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="iar_no">IAR No.</label>
                        <input type="text" id="iar_no" name="iar_no" value="<?= htmlspecialchars($iar['iar_no']) ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="po_no">P.O. No./Date</label>
                        <input type="text" id="po_no" name="po_no" value="<?= htmlspecialchars($iar['po_no']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="po_date">Date</label>
                        <input type="date" id="po_date" name="po_date" value="<?= htmlspecialchars($iar['po_date']) ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="req_office">Requisitioning Office/Dept.</label>
                        <input type="text" id="req_office" name="req_office" value="<?= htmlspecialchars($iar['req_office']) ?>"required>
                    </div>
                    <div class="input-group">
                        <label for="invoice_no">Invoice No.</label>
                        <input type="text" id="invoice_no" name="invoice_no" value="<?= htmlspecialchars($iar['invoice_no']) ?>"required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="resp_code">Responsibility Center Code</label>
                        <input type="text" id="resp_code" name="resp_code" value="<?= htmlspecialchars($iar['resp_code']) ?>">
                    </div>
                    <div class="input-group">
                        <label for="po_date">Date</label>
                        <input type="date" id="po_date" name="po_date" value="<?= htmlspecialchars($iar['po_date']) ?>" required>
                    </div>
                    
                </div>
            </section>

            <section class="form-section">
                <h3>Item Details</h3>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Stock/Property No.</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="item-rows">
                    <?php foreach ($items as $item): ?>
                            <tr>
                                <input type="hidden" name="item_id[]" value="<?= htmlspecialchars($item['id']) ?>">
                                <td><input type="text" name="stock_no[]" value="<?= htmlspecialchars($item['stock_no']) ?>" required></td>
                                <td><input type="text" name="description[]" value="<?= htmlspecialchars($item['description']) ?>" required></td>
                                <td><input type="text" name="unit[]" value="<?= htmlspecialchars($item['unit']) ?>" required></td>
                                <td><input type="number" name="quantity[]" value="<?= htmlspecialchars($item['quantity']) ?>" required></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <button type="button" class="add-button" onclick="addItemRow()">Add Item</button>
            </section>

            <section class="form-section">
            <h3>Conforme</h3>
            <div class="grid-2">
                <div class="input-group">
                        <label for="date_inspected">Date Inspected</label>
                        <input type="date" id="date_inspected" name="date_inspected" value="<?= htmlspecialchars($iar['date_inspected']) ?>"required>
                    </div>
                    <div class="input-group">
                        <label for="date_received">Date Received</label>
                        <input type="date" id="date_received" name="date_received" value="<?= htmlspecialchars($iar['date_received']) ?>" required>
                    </div>
                </div>
                </section>

            <section class="form-section">
                <h3>Fund Details</h3>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="inspection_officer">Inspection Officer/Inspection Committee</label>
                        <input type="text" id="inspection_officer" name="inspection_officer" value="<?= htmlspecialchars($iar['inspection_officer']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="head_procurement">Head, Procurement and Property Management Office</label>
                        <input type="text" id="head_procurement" name="head_procurement" value="<?= htmlspecialchars($iar['head_procurement']) ?>" required>
                    </div>
                </div>
                
                </div>
            </section>

            <section class="form-section">
                <div class="button-container">
                    <a href="../ins_acc_rep/" class="back-button">Back</a>
                    <button type="submit" class="submit-button">Submit</button>
                </div>
            </section>
        </form>
    </main>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="../../class/js/javascript.js"></script>
</body>
</html>
