<?php
require '../../classes/config.php';
require '../../classes/procurement_config.php';
include '../../../aclasses/pheader.php';
include '../../../aclasses/pnavbar.php';

?>
<title>View Purchase Order</title>
<main class="container mt-5 form-container">
    <div class="appendix">Appendix 61</div>
    <div class="po-header-container">
        <div class="image-container">
            <img src="../../../css/image/system-logo.png" alt="Purchase Order Image" class="po-image">
        </div>
        <h2 class="text-center">Purchase Order</h2>
    </div>
    <div class="text-center">
            <strong class="entity-underline-word"><?php echo htmlspecialchars($order['entity_name']); ?></strong>
            <p>Ormoc City, Leyte, 6541</p>
        </div>
    </div>

    <div class="table-responsive">
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
                <span class="underline-word"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['date']))); ?></span>
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
</div>
<div class="po-details">
    <p><strong>Gentlemen:</strong><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please furnish this office the following articles subject to the terms and conditions contained herein:</p>
    </div>
<div class="table-responsive">
    <table class="info-table">
        <tr>
            <td><strong>Place of Delivery:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['address']); ?></span>
            </td>
            <td><strong>Delivery Term:</strong> 
            <span class="underline-word"> <?php echo htmlspecialchars($order['delivery_term']); ?></span>
                
            </td>
        </tr>
        <tr>
            <td><strong>Date of Delivery:</strong> 
            <span class="underline-word">
                <?php echo !empty($order['date_delivery']) ? htmlspecialchars(date('M d, Y', strtotime($order['date_delivery']))) : ''; ?>
            </span>
            </td>
            <td><strong>Payment Term:</strong> 
                <span class="underline-word"> <?php echo htmlspecialchars($order['payment_term']); ?></span>
            </td>
        </tr>
    </table>
</div>
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
            <?php echo displayItemsAndLabels($items, $labels, $conn); ?>

            <tr>
                <td colspan="6" style="text-align: center;">**************** Nothing Follows ********************</td> 
            </tr>

        <?php
        for ($i = 0; $i < 2; $i++): ?>
            <tr>
                <td>&nbsp;</td> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>  
                <td>&nbsp;</td> 
            </tr>
        <?php endfor; ?>
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
                    <span class="underline-word"><strong><?php echo htmlspecialchars(strtoupper($order['signature_supplier'])); ?></strong></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Signature over Printed Name of Supplier</p>
        <p class="text-center">
                <?php if (!empty($order['supplier_date'])): ?>
                    <span class="underline-sdate"><strong><?php echo htmlspecialchars(date('M d, Y', strtotime($order['supplier_date']))); ?></strong></span>
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
                    <span class="underline-word"><strong><?php echo htmlspecialchars(strtoupper($order['signature_official'])); ?></strong></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Signature over Printed Name of Authorized Official</p>
        <p class="text-center">
                <?php if (!empty($order['designation'])): ?>
                    <span class="underline-word"><strong><?php echo htmlspecialchars(strtoupper($order['designation'])); ?></strong></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Designation</p>
    </div>
</div>
</table>
<div class="table-responsive">
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
                <span class="underline-ors"><?php echo !empty($order['ors_burs_date']) ? htmlspecialchars(date('M d, Y', strtotime($order['ors_burs_date']))) : ''; ?></span>
            </td>
        </tr>
        <tr>
        <td>
            <p class="text-center">
                <?php if (!empty($order['signature_accountant'])): ?>
                    <span class="underline-word"><strong><?php echo htmlspecialchars(strtoupper($order['signature_accountant'])); ?></strong></span>
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
<div class="d-flex justify-content-between align-items-center">
    <a href="../canceled_po/" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i></a>
    <div>
    <a href="view_pdfpo.php?id=<?php echo $order['id']; ?>" class="btn btn-secondary mt-3" download="<?php echo htmlspecialchars($order['po_no']) . '.pdf'; ?>">Download <i class="fas fa-file-pdf" style="color: #e77268;"></i></a>
    <a href="view_pdfpo.php?id=<?php echo $order['id']; ?>" class="btn btn-primary mt-3"><i class="fas fa-print"></i> Print</a>
    </div>
</div>
</main>
<?php include '../../../aclasses/pfooter.php'; ?>
