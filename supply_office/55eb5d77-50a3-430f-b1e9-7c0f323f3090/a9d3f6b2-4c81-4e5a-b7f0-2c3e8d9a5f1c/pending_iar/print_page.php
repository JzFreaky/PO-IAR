<?php
require '../../class/function/config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';

?>
<title>Partial Inspection and Acceptance Report</title>
<main class="container mt-5 form-container">
    <div class="appendix">Appendix 62</div>
        <div class="po-header-container">
            <div class="image-container">
                <img src="../../../css/image/system-logo.png" alt="Purchase Order Image" class="po-image">
        </div>
        <?php if ($iarData): ?>
        <div class="header">
            <h2 class="text-center" >INSPECTION AND ACCEPTANCE REPORT</h2>
        </div>
    </div>
</div>
    <div class="iar-details">
        <div class="po-row">
            <div class="po-left">
                <p><strong>Entity Name:</strong> 
                    <span><u><?php echo htmlspecialchars($iarData['entity_name']); ?></u></span>
                </p>
            </div>
            <div class="po-right">
                <p><strong>Fund Cluster:</strong> 
                    <span class="underline-word"><?php echo htmlspecialchars($iarData['fund_cluster']); ?></span>
                </p>
            </div>
        </div>
        <table class="info-table">
        <tr>
            <td><strong>Supplier:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['supplier']); ?></span>
            </td>
            <td><strong>IAR No.:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['iar_no']); ?></span>
            </td>
        </tr>
        <tr>
            <td><strong>P.O No./Date:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['po_no']); ?></span>
            </td>
            <td><strong>Date:</strong> 
                <span class="underline-word"><?php 
                    if (!empty($iarData['iar_date'])) {
                        try {
                            $date = new DateTime($iarData['iar_date']);
                            echo htmlspecialchars($date->format('F j, Y')); 
                        } catch (Exception $e) {
                            echo 'Invalid date';
                        }
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </span>
            </td>
        </tr>
        <tr>
            <td><strong>Requisitioning Office/Dept.:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['req_office']); ?> </span>
            </td>
            <td><strong>Invoice No.:</strong> 
                <span class="underline-word"><?php echo htmlspecialchars($iarData['invoice_no']); ?></span>
            </td>
        </tr>
        <tr>
        <td><strong>Responsibility Center Code:</strong> 
            <span class="underline-word">
                <?php echo htmlspecialchars($iarData['resp_code']); ?> 
                - <?php echo htmlspecialchars(substr($iarData['sub_object_code'], 0, 25)) . (strlen($iarData['sub_object_code']) > 30 ? '...' : ''); ?>
            </span>
        </td>
            <td><strong>Date:</strong> 
                <span class="underline-word"><?php 
                    if (!empty($iarData['invoice_date'])) {
                        try {
                            $date = new DateTime($iarData['invoice_date']);
                            echo htmlspecialchars($date->format('F j, Y')); 
                        } catch (Exception $e) {
                            echo 'Invalid date';
                        }
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </span>
            </td>
        </tr>
    </table>
</div>
<?php if (!empty($iaritemDetails)): ?>
    <div class="table-responsive">
        <table class="item-table">
            <thead>
                <tr>
                    <th>Stock/Property No.</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    </tr>
            </thead>
        <tbody>
            <?php 
                foreach ($iaritemDetails as $key => $item): 
                    $matchingLabel = null;
                    foreach ($labels as $label) {
                        if ($label['label_no'] == $item['stock_no']) {
                            $matchingLabel = $label;
                            break;
                        }
                    }
                        
                    if ($matchingLabel): ?>
                            <tr>
                                <td colspan="4" style="text-align: center;"><?php echo htmlspecialchars($matchingLabel['label_text']); ?></td> 
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td><?php echo htmlspecialchars($item['stock_no']); ?></td>
                            <td><?php echo htmlspecialchars($item['description']); ?></td>
                            <td><?php echo htmlspecialchars($item['unit']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <tr>
            <td>&nbsp;</td> 
            <td>**************** Nothing Follows ********************</td> 
            <td>&nbsp;</td> 
            <td>&nbsp;</td> 
        </tr>

        <?php for ($i = 0; $i < 2; $i++): ?>
            <tr>
                <td>&nbsp;</td> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td> 
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>

    <table class="table table-borderediar">
        <thead>
            <tr>
                <th style="text-align: center; width: 50%;">INSPECTION</th>
                <th style="text-align: center; width: 50%;">ACCEPTANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-group flex-container">
                        <p><strong>Date Inspected:</strong> 
                            <span class="line"><?php echo htmlspecialchars($iarData['date_inspected']); ?></span>
                        </p>
                        <p>
                            <input type="checkbox" id="inspection_verified" name="inspection_verified" value="1"
                            <?php echo isset($iarData['insp_status']) && $iarData['insp_status'] == 'complete' ? 'checked' : ''; ?>> 
                            Inspected, verified, and found in order as to quantity and specifications
                        </p>
                    </div>
                    <div class="form-group flex-footer">
                        <div class="text-center">
                            <span class="line2"><?php echo htmlspecialchars($iarData['inspection_officer']); ?></span>
                        </div>
                        <p style="text-align: center;">Inspection Officer/Inspection Committee</p>
                    </div>
                </td>
                <td>
        <div class="form-group flex-container">
            <p><strong>Date Received:</strong> 
                <span class="line"><?php echo htmlspecialchars($iarData['date_received']); ?></span>
            </p>
            <p>
                <input type="checkbox" id="property_custodian_status" name="property_custodian_status" value="1"
                <?php echo isset($iarData['property_custodian_status']) && $iarData['property_custodian_status'] == 'complete' ? 'checked' : ''; ?>> 
                Complete
            </p>
            <p>
            <input type="checkbox" id="property_custodian_status_partial" name="property_custodian_status" value="1"
            <?php if (isset($iarData['property_custodian_status']) && $iarData['property_custodian_status'] == 'partial') { echo 'checked'; } ?>> 
            Partial (pls. specify quantity): 
            <?php 
                if (isset($iarData['property_custodian_status']) && $iarData['property_custodian_status'] == 'partial' && isset($iarData['incomplete_details'])) {
                    echo '<span style="text-decoration: underline;">"printer"</span>';
                } else {
                }
            ?>
        </p>
        </div>
    <div class="form-group flex-footer">
        <div class="text-center">
            <span class="prop-line"><?php echo htmlspecialchars($iarData['head_procurement']); ?></span>
        </div>
        <p style="text-align: center;">Supply and/or Property Custodian</p>
    </div>
</td>
</tr>
    </tbody>
    </table>

        
    <?php else: ?>
            <p>No items found for this IAR.</p>
        <?php endif; ?>
        <a href="../all_iar/" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i></a>
        
    <?php else: ?>
        <p class="text-center">No Inspection and Acceptance Report found.</p>
    <?php endif; ?>
</main>
<script>
        window.print();
    </script>
<?php include '../../../sclasses/footer.php'; ?>