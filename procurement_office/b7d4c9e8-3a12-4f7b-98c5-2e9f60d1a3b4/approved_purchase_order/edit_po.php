<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';
?>

<title>Edit Purchase Order</title>
<link rel="stylesheet" href="../css/p.o.css">
<body>
    <main class="container mt-5 custom-container">
        <h2>Edit Purchase Order</h2>
        <form action="" method="POST">
            <!-- Entity and Supplier Information -->
            <section class="form-section">
                <h3>Entity and Supplier Information</h3>
                <div class="grid-3">
                    <div class="input-group">
                        <label for="entity_name">Entity Name</label>
                        <input type="text" id="entity_name" name="entity_name" value="<?= htmlspecialchars($order['entity_name']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" id="supplier" name="supplier" value="<?= htmlspecialchars($order['supplier']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="po_no">P.O. No.</label>
                        <input type="text" id="po_no" name="po_no" value="<?= htmlspecialchars($order['po_no']) ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="<?= htmlspecialchars($order['address']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" value="<?= htmlspecialchars($order['date']) ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="tin">TIN</label>
                        <input type="text" id="tin" name="tin" value="<?= htmlspecialchars($order['tin']) ?>">
                    </div>
                    <div class="input-group">
                        <label for="mode_procurement">Mode of Procurement</label>
                        <select id="mode_procurement" name="mode_procurement" required>
                            <option value="">Select...</option>
                            <option value="Direct Purchase" <?= $order['mode_procurement'] == 'Direct Purchase' ? 'selected' : '' ?>>Direct Purchase</option>
                            <option value="Bidding" <?= $order['mode_procurement'] == 'Bidding' ? 'selected' : '' ?>>Bidding</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- Delivery and Payment Terms -->
            <section class="form-section">
                <h3>Delivery and Payment Terms</h3>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="place_delivery">Place of Delivery</label>
                        <input type="text" id="place_delivery" name="place_delivery" value="<?= htmlspecialchars($order['place_delivery']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="delivery_term">Delivery Term</label>
                        <input type="text" id="delivery_term" name="delivery_term" value="<?= htmlspecialchars($order['delivery_term']) ?>" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="input-group">
                        <label for="date_delivery">Date of Delivery</label>
                        <input type="date" id="date_delivery" name="date_delivery" value="<?= htmlspecialchars($order['date_delivery']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="payment_term">Payment Term</label>
                        <input type="text" id="payment_term" name="payment_term" value="<?= htmlspecialchars($order['payment_term']) ?>" required>
                    </div>
                </div>
            </section>

            <!-- Item Details -->
            <section class="form-section">
                <h3>Item Details</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Stock/Property No.</th>
                            <th>Unit</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit Cost</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="item-rows">
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><input type="text" name="stock_no[]" value="<?= htmlspecialchars($item['stock_no']) ?>" required></td>
                                <td><input type="text" name="unit[]" value="<?= htmlspecialchars($item['unit']) ?>" required></td>
                                <td><input type="text" name="description[]" value="<?= htmlspecialchars($item['description']) ?>" required></td>
                                <td><input type="number" name="quantity[]" value="<?= htmlspecialchars($item['quantity']) ?>" required></td>
                                <td><input type="number" name="unit_cost[]" value="<?= htmlspecialchars($item['unit_cost']) ?>" required></td>
                                <td><input type="number" name="amount[]" value="<?= htmlspecialchars($item['amount']) ?>" required></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" class="add-button" onclick="addItemRow()">Add Item</button>
            </section>

            <!-- Total Amount -->
            <div class="input-group">
                <label for="total_amount_words">Total Amount (In Words)</label>
                <input type="text" id="total_amount_words" name="total_amount_words" value="<?= htmlspecialchars($order['total_amount_words']) ?>" required>
            </div>

            <!-- Conforme -->
            <section class="form-section">
            <h3>Conforme</h3>
            <div class="grid-2">
                    <div class="input-group">
                        <label for="signature_supplier">Name of Supplier</label>
                        <input type="text" id="signature_supplier" name="signature_supplier" value="<?= htmlspecialchars($order['signature_supplier']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="signature_official">Name of Authorized Official</label>
                        <input type="text" id="signature_official" name="signature_official" value="<?= htmlspecialchars($order['signature_official']) ?>" required>
                    </div>
                </div>
                </section>

            <!--Fund Details -->
            <section class="form-section">
                <h3>Fund Details</h3>
                <div class="grid-3">
                    <div class="input-group">
                        <label for="fund_cluster">Fund Cluster</label>
                        <input type="text" id="fund_cluster" name="fund_cluster" value="<?= htmlspecialchars($order['fund_cluster']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_no">ORS/BURS No.</label>
                        <input type="text" id="ors_burs_no" name="ors_burs_no" value="<?= htmlspecialchars($order['ors_burs_no']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_date">Date of the ORS/BURS</label>
                        <input type="date" id="ors_burs_date" name="ors_burs_date" value="<?= htmlspecialchars($order['ors_burs_date']) ?>" required>
                    </div>
                </div>
                <div class="grid">
                    <div class="input-group">
                        <label for="funds_available">Funds Available</label>
                        <input type="text" id="funds_available" name="funds_available" value="<?= htmlspecialchars($order['funds_available']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="ors_burs_amount">Amount</label>
                        <input type="number" id="ors_burs_amount" name="ors_burs_amount" value="<?= htmlspecialchars($order['ors_burs_amount']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="signature_accountant">Name of Head of Accountant</label>
                        <input type="text" id="signature_accountant" name="signature_accountant" value="<?= htmlspecialchars($order['signature_accountant']) ?>" required>
                    </div>
                </div>
            </section>

            <!-- Submit Button -->
            <section class="form-section">
                <div class="button-container">
                    <a href="../purchase_order/" class="back-button">Back</a>
                    <button type="update" class="submit-button">Update Purchase Order</button>
                </div>
            </section>
        </form>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="../js/javascript.js"></script>
</body>
</html>
