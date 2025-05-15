<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
?>
<title>View Purchase Order</title>
<main class="container mt-5 form-container">
<div class="appendix">Appendix 61</div>
    <h2 class="text-center">Purchase Order</h2>
    <div class="po-header">
        <div class="text-center">
            <strong><?php echo htmlspecialchars($order['entity_name']); ?></strong>
            <p>Entity Name</p>
        </div>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Supplier:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['supplier']); ?></span>
            </td>
            <td><strong>P.O. No.:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['po_no']); ?></span>
            </td>
        </tr>
        <tr>
            <td><strong>Address:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($order['address']); ?></span>
            </td>
            <td><strong>Date:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['date']); ?></span>
            </td>
        </tr>
        <tr>
            <td><strong>TIN:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['tin']); ?></span>
            </td>
            <td><strong>Mode of Procurement:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['mode_procurement']); ?></span>
            </td>
        </tr>
    </table>
</div>
    <div class="po-details">
        <p><strong>Gentleman:</strong><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please furnish this office the following articles subject to the terms and conditions contained herein:</p>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Place of Delivery:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['address']); ?></span>
            </td>
            <td><strong>Delivery Term:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['date']); ?></span>
            </td>
        </tr>
        <tr>
            <td><strong>Date of Delivery:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['delivery_term']); ?></span>
            </td>
            <td><strong>Payment Term:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['payment_term']); ?></span>
            </td>
        </tr>
    </table>
</div>

    <div class="table-responsive">    
    <table class="item-table">
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
            <tbody>
            <?php echo displayItemsAndLabels($items, $labels); ?>
            </tbody>
        </table>
    </div>
    <div class="po-details">
        <p><strong>Total Amount (In Words):</strong> <?php echo htmlspecialchars($order['total_amount_words']); ?></p>
    </div>

    <table class="sign-table">
    <div class="po-details po-signature">
    <div class="row">
    <div class="col-12">
        <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for
        every day of delay shall be imposed on the undelivered items/s.
        </p>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <p style="margin-left: 40px;"><strong>Conforme:</strong></p>
        <p class="text-center">
                <?php if (!empty($order['signature_supplier'])): ?>
                    <span class="underline-word"><?php echo htmlspecialchars($order['signature_supplier']); ?></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Signature over Printed Name of Supplier</p>
        <p class="text-center">
                <?php if (!empty($order['supplier_date'])): ?>
                    <span class="underline-word"><?php echo htmlspecialchars($order['supplier_date']); ?></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Date</p>
    </div>

    <div class="col-6">
        <p><strong>Very truly yours,</strong></p>
        <p class="text-center">
                <?php if (!empty($order['signature_official'])): ?>
                    <span class="underline-word"><?php echo htmlspecialchars($order['signature_official']); ?></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Signature over Printed Name of Authorized Official</p>
        <p class="text-center">
                <?php if (!empty($order['designation'])): ?>
                    <span class="underline-word"><?php echo htmlspecialchars($order['designation']); ?></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Designation</p>
    </div>
</div>

    </table>

<table class="info-table">
        <tr>
            <td><strong>Fund Cluster:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['fund_cluster']); ?></span>
            </td>
            <td><strong>ORS/BURS No.:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['ors_burs_no']); ?></span>
            </td>
        </tr>
        <tr>
            <td><strong>Funds Available:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['funds_available']); ?></span>
            </td>
            <td><strong>Date of the ORS/BURS:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['ors_burs_date']); ?></span>
            </td>
        </tr>
        <tr>
        <td>
            <p class="text-center">
                <?php if (!empty($order['signature_accountant'])): ?>
                    <span class="underline-word"><?php echo htmlspecialchars($order['signature_accountant']); ?></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
            <p class="text-center">
                Signature over Printed Name of Chief Accountant/Head of Accounting Division/Unit
            </p>
        </td>
            <td><strong>Amount:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['ors_burs_amount']); ?></span>
            </td>
        </tr>
    </table>
</div>
<a href="../approved_purchase_order/" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i></a>
<button onclick="window.print();" class="btn btn-primary mt-3"> <i class="fas fa-print"></i> Print</button>

<?php if ($order['status'] === 'pending'): ?>
<form method="POST" action="../classes/config.php">
    <input type="hidden" name="po_id" value="<?php echo $order['id']; ?>">
    <button type="submit" name="approve_po" class="btn btn-success mt-3">Approve Purchase Order</button>
</form>
<?php endif; ?>
</main>

<?php include '../../pclasses/footer.php'; ?>