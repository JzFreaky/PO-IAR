<?php
require '../../class/function/config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';
?>
<title>View Purchase Order</title>
<style>
.reject-row {
    background-color: red;
    color: white;
}
.centered-heading {
    text-align: center;
    font-weight: bold;
    margin-top: 20px; /* Optional: Adds space below the heading */
}


    .item-details-container {
    padding: 15px;
    border-radius: 5px;
    max-width: 600px;
    margin: 0 auto;
}

.detail-field {
    margin-bottom: 15px;
}

.detail-field strong {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

textarea.form-control {
    height: 100px;
    resize: vertical;
}

button.btn-success {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button.btn-success:hover {
    background-color: #218838;
}
</style>
<main class="container mt-5 form-container">
<div class="appendix">Appendix 61</div>
<div class="po-header-container">
  <div class="image-container">
    <img src="../../../css/image/system-logo.png" alt="Purchase Order Image" class="po-image">
  </div>
  <h2 class="text-center">Purchase Order</h2>
</div>
    <div class="po-header">
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
        <p><strong>Gentleman:</strong><br>
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
                    <span class="underline-word"><strong><?php echo htmlspecialchars($order['signature_supplier']); ?></strong></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Signature over Printed Name of Supplier</p>
        <p class="text-center">
                <?php if (!empty($order['supplier_date'])): ?>
                    <span class="underline-word"><strong><?php echo htmlspecialchars(date('M d, Y', strtotime($order['supplier_date']))); ?></strong></span>
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
                    <span class="underline-word"><strong><?php echo htmlspecialchars($order['signature_official']); ?></strong></span>
                <?php else: ?>
                    __________________________________
                <?php endif; ?>
            </p>
        <p class="text-center">Signature over Printed Name of Authorized Official</p>
        <p class="text-center">
                <?php if (!empty($order['designation'])): ?>
                    <span class="underline-word"><strong><?php echo htmlspecialchars($order['designation']); ?></strong></span>
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
                <span class="underline-word"><?php echo !empty($order['ors_burs_date']) ? htmlspecialchars(date('M d, Y', strtotime($order['ors_burs_date']))) : ''; ?></span>
            </td>
        </tr>
        <tr>
        <td>
            <p class="text-center">
                <?php if (!empty($order['signature_accountant'])): ?>
                    <span class="underline-word"><strong><?php echo htmlspecialchars($order['signature_accountant']); ?></strong></span>
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
</div>
<div class="d-flex justify-content-between align-items-center">
    <a href="../purchase_order/" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i></a>
    <div>
        <a href="#" class="btn btn-secondary mt-3" data-toggle="modal" data-target="#deliveryHistoryModal">
        <i class="fas fa-history"></i> Delivery History
    </a>
    <?php if (!$iarExists && $status !== 'canceled'): ?>
    <a class="btn btn-primary mt-3" href="../generate_iar/index.php?po_id=<?php echo $order['id']; ?>"><i class="fas fa-file-alt"></i> Generate IAR</a>
<?php elseif ($status === 'Incomplete' && $status !== 'Canceled'): ?>
    <a class="btn btn-warning mt-3" href="../generate_complete_iar/index.php?po_id=<?php echo $order['id']; ?>"><i class="fas fa-cogs"></i> Generate IAR</a>
<?php endif; ?>
    </div>
</div>

<div class="modal fade" id="deliveryHistoryModal" tabindex="-1" role="dialog" aria-labelledby="deliveryHistoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deliveryHistoryModalLabel">Delivery Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Section Toggle Buttons -->
        <div class="d-flex justify-content-start mb-3">
          <button type="button" class="btn btn-secondary mx-1" id="showDeliveryHistoryBtn">Delivery History</button>
        </div>

<?php
    $po_id = isset($_GET['id']) ? $_GET['id'] : ''; 

    if (!empty($po_id)) {
        $stmt = $conn->prepare("SELECT stock_no, description, delivery_date, quantity, status FROM arrived_items WHERE po_id = :po_id");
        $stmt->bindParam(':po_id', $po_id, PDO::PARAM_INT);
        $stmt->execute();
        $itemDeliveryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<div id="deliveryHistorySection" >
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Stock/Property No.</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Date Delivered</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($itemDeliveryData)) {
            foreach ($itemDeliveryData as $delivery) {
                $formattedDate = date('M. j, Y', strtotime($delivery['delivery_date']));

                $status = htmlspecialchars($delivery['status']);
                if ($status === 'Inspected') {
                    $badgeClass = 'badge badge-success';
                } elseif ($status === 'Rejected') {
                    $badgeClass = 'badge bg-danger rounded-pill text-dark';
                } else {
                    $badgeClass = 'badge badge-secondary'; 
                }

                echo '<tr>';
                echo '<td>' . htmlspecialchars($delivery['stock_no']) . '</td>';
                echo '<td>' . htmlspecialchars($delivery['description']) . '</td>';
                echo '<td>' . htmlspecialchars($delivery['quantity']) . '</td>';
                echo '<td>' . htmlspecialchars($formattedDate) . '</td>';
                echo '<td><span class="' . $badgeClass . '">' . $status . '</span></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">No items is delivered yet.</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</main>
<script src="../../class/js/delivery_date.js"></script>
<?php include '../../../sclasses/footer.php'; ?>