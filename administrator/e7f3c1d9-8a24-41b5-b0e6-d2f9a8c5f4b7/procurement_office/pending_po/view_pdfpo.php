<?php
require '../../classes/config.php';
require '../../classes/procurement_config.php';
include '../../../database/db.php'; 
require_once('../../../../TCPDF-main/tcpdf.php');

ob_start(); // Start output buffering to capture HTML

$poID = $_GET['id'];

try {
    // Fetch PO data from the database
    $stmt = $conn->prepare("SELECT * FROM purchase_orders WHERE id = :id");
    $stmt->bindParam(':id', $poID);
    $stmt->execute();
    $po = $stmt->fetch(PDO::FETCH_ASSOC);

    // Create a new TCPDF object
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Purchase Order');
    $pdf->SetSubject('PO');
    $pdf->SetKeywords('PO, Purchase Order');

    // Set margins
    $pdf->SetMargins(15, 27, 15); // Left, Top, Right
    $pdf->SetHeaderMargin(0); // Set to 0 to remove the header line
    $pdf->SetFooterMargin(0); // Set to 0 to remove the footer line

    // Disable header and footer drawing
    $pdf->setPrintHeader(false); // Disable the header
    $pdf->setPrintFooter(false); // Disable the footer

    $pdf->SetAutoPageBreak(TRUE, 25);

    $pdf->AddPage(); // Add a new page

    $pdf->Image('../../../css/image/system-logo.png', 25, 10, 15, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Set font for the title
    $pdf->SetFont('helvetica', 'B', 14); 
    $pdf->SetXY(25, 15); 
    $pdf->Cell(0, 0, 'PURCHASE ORDER', 0, 1, 'C', 0, '', 0, false, 'T', 'M'); 

    $pdf->Ln(15); 

    $pdf->SetFont('helvetica', 'BU', 10); 
    $pdf->SetXY(25, 25); 
    $pdf->Cell(0, 0, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 0, 1, 'C', 0, '', 0, false, 'T', 'M'); 
    $pdf->SetFont('helvetica', '', 10);  
    $pdf->SetXY(25, 30); 
    $pdf->Cell(0, 0, 'Ormoc City, Leyte, 6541', 0, 1, 'C', 0, '', 0, false, 'T', 'M'); 

    $pdf->Ln(6); 

    $pdf->SetFont('helvetica', '', 8); 

    $html = '
    <style>
        .left-cell { width: 67%; }
        .right-cell { width: 33%; }
        td {
            width: auto;
            overflow-wrap: break-word; 
        }
    </style>
    <table cellpadding="2" cellspacing="0" border="0.9" style="width: 100%;">
        <tr>
            <td class="left-cell"><strong>Supplier:</strong> <u><strong>' . htmlspecialchars($po['supplier']) . '</strong></u></td>
            <td class="right-cell"><strong>PO No.:</strong> <u><strong>' . htmlspecialchars($po['po_no']) . '</strong></u></td>
        </tr>
        <tr>
            <td class="left-cell"><strong>Address:</strong> <u><strong>' . htmlspecialchars($po['address']) . '</strong></u></td>
            <td class="right-cell"><strong>Date:</strong> <u><strong>' . date('M d, Y', strtotime($po['date'])) . '</strong></u></td>
        </tr>
        <tr>
            <td class="left-cell"><strong>TIN:</strong> <u>' . htmlspecialchars($po['tin']) . '</u></td>
            <td class="right-cell"><strong>Mode of Procurement:</strong> <u>' . htmlspecialchars($po['mode_procurement']) . '</u></td>
        </tr>
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(-4.9);

    $html = '
    <table border="0.9" cellpadding="5" cellspacing="0" style="width: 100%;">
        <tr>
            <td style="width: 100%; line-height: 0.5; ">
                <p style="line-height: 0.1;"><strong>Gentlemen:</strong></p>
                <p style="line-height: 0.9;">Please furnish this office the following articles subject to the terms and conditions contained herein:<br></p>
                <span></span>
            </td>
        </tr>
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    
    $stmt_items = $conn->prepare("SELECT * FROM purchase_order_items WHERE po_id = :id");
    $stmt_items->bindParam(':id', $poID);
    $stmt_items->execute();
    $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

    $stmt_labels = $conn->prepare("SELECT * FROM purchase_order_labels WHERE po_id = :id ORDER BY label_no");
    $stmt_labels->bindParam(':id', $poID);
    $stmt_labels->execute();
    $labels = $stmt_labels->fetchAll(PDO::FETCH_ASSOC);

    $labelsByStockNo = [];
    foreach ($labels as $label) {
        $labelsByStockNo[$label['label_no']][] = $label['label_text'];
    }

    $pdf->Ln(-7);

    $html = '
    <style>
        .left-cell { width: 67%; }
        .right-cell { width: 33%; }
        td {
            width: auto;
            overflow-wrap: break-word; 
        }
    </style>
    <table cellpadding="2" cellspacing="0" border="0.9" style="width: 100%;">
        <tr>
            <td class="left-cell"><strong>Place of Delivery:</strong> <u>' . htmlspecialchars($po['place_delivery']) . '</u></td>
            <td class="right-cell"><strong>Delivery Term.:</strong> <u>' . htmlspecialchars($po['delivery_term']) . '</u></td>
        </tr>
        <tr>
            <td class="left-cell"><strong>Date of Delivery:</strong> <u>' . 
                (empty($po['date_delivery']) ? '' : date('M d, Y', strtotime($po['date_delivery']))) . 
            '</u></td>
            <td class="right-cell"><strong>Payment Term:</strong> <u>' . htmlspecialchars($po['payment_term']) . '</u></td>
        </tr>
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(-5);

    $html = '
    <table border="0.9" cellpadding="2" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th style="text-align: center; width: 11%;">Stock/Property No.</th>
                <th style="text-align: center; width: 10%;">Unit</th>
                <th style="text-align: center; width: 46%;">Description</th>
                <th style="text-align: center; width: 10%;">Quantity</th>
                <th style="text-align: center; width: 11%;">Unit Cost</th>
                <th style="text-align: center; width: 12%;">Amount</th>
            </tr>
        </thead>
        <tbody>';

$stmt_labels = $conn->prepare("SELECT * FROM purchase_order_labels WHERE po_id = :id ORDER BY label_no, label_order");
$stmt_labels->bindParam(':id', $poID);
$stmt_labels->execute();
$labels = $stmt_labels->fetchAll(PDO::FETCH_ASSOC);

$stmt_specs = $conn->prepare("SELECT * FROM po_item_specifications WHERE po_id = :id ORDER BY item_no");
$stmt_specs->bindParam(':id', $poID);
$stmt_specs->execute();
$item_specs = $stmt_specs->fetchAll(PDO::FETCH_ASSOC);

// Map specifications to their corresponding item_no for easier lookup
$itemSpecifications = [];
foreach ($item_specs as $spec) {
    $itemSpecifications[$spec['item_no']][] = $spec['item_specification'];
}

$itemCount = count($items);  
$lastItemIndex = $itemCount - 1;

foreach ($items as $index => $item) {
    foreach ($labels as $label) {
        if ($label['label_no'] == $index + 1) { 
            $html .= '<tr>';
            $html .= '<td style="text-align: center; width: 11%;">&nbsp;</td>';
            $html .= '<td style="text-align: center; width: 10%;">&nbsp;</td>';
            $html .= '<td style="width: 46%; text-align: center;"><strong>' . htmlspecialchars($label['label_text']) . '</strong></td>';
            $html .= '<td style="text-align: center; width: 10%;">&nbsp;</td>';
            $html .= '<td style="text-align: center; width: 11%;">&nbsp;</td>';
            $html .= '<td style="text-align: center; width: 12%;">&nbsp;</td>';
            $html .= '</tr>';
        }
    }

    // Main item row
    $html .= '<tr>';
    $html .= '<td style="text-align: center; width: 11%;">' . htmlspecialchars($item['stock_no']) . '</td>';
    $html .= '<td style="text-align: center; width: 10%;">' . htmlspecialchars($item['unit']) . '</td>';
    $html .= '<td style="width: 46%;">' . htmlspecialchars($item['description']) . '</td>';
    $html .= '<td style="text-align: center; width: 10%;">' . htmlspecialchars($item['quantity']) . '</td>';
    $html .= '<td style="text-align: center; width: 11%;">' . htmlspecialchars($item['unit_cost']) . '</td>';
    $html .= '<td style="text-align: center; width: 12%;">' . htmlspecialchars($item['amount']) . '</td>';
    $html .= '</tr>';

    // Item specifications in separate rows
    if (!empty($itemSpecifications[$index + 1])) {
        foreach ($itemSpecifications[$index + 1] as $specification) {
            $html .= '<tr>';
            $html .= '<td style="text-align: center; width: 11%;">&nbsp;</td>';
            $html .= '<td style="text-align: center; width: 10%;">&nbsp;</td>';
            $html .= '<td colspan="1" style="text-align: center; ">' . htmlspecialchars($specification) . '</td>';
            $html .= '<td style="text-align: center; width: 10%;">&nbsp;</td>';
                $html .= '<td style="text-align: center; width: 11%;">&nbsp;</td>';
                $html .= '<td style="text-align: center; width: 12%;">&nbsp;</td>';
            $html .= '</tr>';
        }
    }

    // After the last item, ensure labels are added if applicable
    if ($index === $lastItemIndex) {
        foreach ($labels as $label) {
            if ($label['label_no'] > $itemCount) { 
                $html .= '<tr>';
                $html .= '<td style="text-align: center; width: 11%;">&nbsp;</td>';
                $html .= '<td style="text-align: center; width: 10%;">&nbsp;</td>';
                $html .= '<td style="width: 46%; text-align: center;"><strong>' . htmlspecialchars($label['label_text']) . '</strong></td>';
                $html .= '<td style="text-align: center; width: 10%;">&nbsp;</td>';
                $html .= '<td style="text-align: center; width: 11%;">&nbsp;</td>';
                $html .= '<td style="text-align: center; width: 12%;">&nbsp;</td>';
                $html .= '</tr>';
            }
        }
    }
}

    $html .= '<tr>
                <td colspan="6" style="text-align: center;">**************** Nothing Follows ********************</td> 
            </tr>';

    for ($i = 0; $i < 2; $i++): 
        $html .= '<tr>
                    <td>&nbsp;</td> 
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                    <td>&nbsp;</td> 
                    <td>&nbsp;</td> 
                </tr>';
    endfor;

    $html .= '</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Ln(-5);

    $totalAmount = 0;
    foreach ($items as $item) {
        $totalAmount += $item['amount'];
    }

    $html = '
    <table border="0.9" cellpadding="4" cellspacing="0" style="width: 100%;">
        <tr>
            <td style="width: 88%;">
                <p style="line-height: 0.2;"><strong>Total Amount (In Words):</strong> ' . htmlspecialchars($po['total_amount_words']) . '</p>
            </td>
            <td style="width: 12%;">
                <p style="line-height: 0.2; text-align: center;"><strong>' . number_format($totalAmount, 2) . '</strong></p>
            </td>
        </tr>
    </table>';

    

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Ln(-6.3);
    $html = '
    <style>
        .signature-placeholder {
        text-align: center;
        display: inline-block; 
        line-height: 0;
        border-bottom: 0.9px solid black; 
        font-size: 2 em; 
    }

    .signature-supplier {
        text-align: center;
        display: inline-block; 
        border-bottom: 0.9px solid black; 
        font-size: 2 em; 
        line-height: ' . (empty($po['supplier_date']) ? '1.5' : '0') . '; /* Adjust line-height if supplier_date is empty */
    }

    .signature-content {
        text-align: center;
        font-weight: bold; /* Optional: Make the name bold */
        display: block;
        line-height: 3;
    }
        
    .date-placeholder {
        text-align: center;
        display: inline-block; 
        line-height: 0;
        border-bottom: 0.9px solid black; 
        font-size: 2 em; 
    }
    .date-supplier {
        text-align: center;
        display: inline-block; 
        line-height: ' . (empty($po['supplier_date']) ? '0.5' : '0') . '; /* Change line-height if supplier_date is empty */
        border-bottom: 0.9px solid black; 
        font-size: 2 em; 
    }

    .date-content {
        text-align: center;
        font-weight: bold; /* Optional: Make the name bold */
        display: block; 
        line-height: 4;
    }

    </style>
    <table border="0.9" cellpadding="5" cellspacing="0" style="width: 100%;">
    <p style="line-height: 0.1; ">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for
        every day of delay shall be imposed on the undelivered items/s.
        </p>
        <tr>
           <td style="width: 50%; border-bottom: 0.9px solid black; border-left: 0.9px solid black; text-align: center;">
                <div style="text-align: left; line-height: 0.2 ;"><p><strong>Conforme:</strong></p></div>
                <p style="line-height: 0;">
                    <span class="signature-content">' . htmlspecialchars($po['signature_supplier']) . '</span><br>
                    <span class="signature-supplier">_________________</span>
                </p>
                <p style="line-height: ' . (empty($po['signature_supplier']) ? '-2.9' : '0') . ';">Signature over Printed Name of Supplier</p>

                <p style="line-height: 0;">
                    <span class="date-content">' . 
                    (empty($po['supplier_date']) ? '' : date('M d, Y', strtotime($po['supplier_date']))) . 
                '</span><br>

                    <span class="date-supplier">_________________</span>
                </p> 
                <p style="line-height: ' . (empty($po['supplier_date']) ? '0' : '1') . ';">Date</p>
            </td>


            <td style="width: 50%; border-bottom: 0.9px solid black; border-right: 0.9px solid black; text-align: center;">
                <div style="text-align: left; line-height: 0.2 ;"><p><strong>Very truly yours,</strong></p></div>
                <p style="line-height: 0;">
                <span class="signature-content">' . htmlspecialchars(strtoupper($po['signature_official'])) . '</span><br>
                    <span class="signature-placeholder">_________________</span>
                    
                </p> 
                <p style="line-height: 0;">Signature over Printed Name of Authorized Official</p>
                <p style="line-height: 0;">
                <span class="date-content">' . htmlspecialchars(strtoupper($po['designation'])) . '</span><br>
                    <span class="date-placeholder">_________________</span>
                    
                </p> 
                <p style="line-height: 1;">Designation</p>
            </td>
            
        </tr>
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(-7.1);

    $html = '
    <style>
        .left-cell { width: 67%; }
        .right-cell { width: 33%; }
        td {
            width: auto;
            overflow-wrap: break-word; 
        }
    </style>
    <table cellpadding="2" cellspacing="0" border="0.9" style="width: 100%;">
        <tr>
            <td class="left-cell"><strong>Fund Cluster:</strong> <u>' . htmlspecialchars($po['fund_cluster']) . '</u></td>
            <td class="right-cell"><strong>ORS/BURS No:</strong> <u>' . htmlspecialchars($po['ors_burs_no']) . '</u></td>
        </tr>
        <tr>
            <td class="left-cell"><strong>Funds Available:</strong> <u>' . htmlspecialchars($po['funds_available']) . '</u></td>
            <td class="right-cell"><strong>Date of the ORS/BURS:</strong> <u>' . 
    (empty($po['ors_burs_date']) ? '' : date('M d, Y', strtotime($po['ors_burs_date']))) . 
'</u></td>

    </tr>
        <tr>
            <td class="left-cell" style="text-align: center;">
            <p >
                <span style="line-height: 1; text-transform: uppercase;" ><strong>' . htmlspecialchars($po['signature_accountant']) . '</strong></span></p>
                <p style="line-height: -3.9;"><span >________________________________</span>
            </p>
           <p style="line-height: -4;"> Signature over Printed Name of Chief Accountant/Head of<br> </p>
         <p style="line-height: 2.1;"> of Accounting Division/Unit</p>
        </td>
        <td class="right-cell"><strong>Amount:</strong>
            <p style="line-height: 1; text-align: center;">Alobs/Bus No.</p>
            <p style="line-height: 1;"><strong>Amount:</strong>  ' . (!empty($po['ors_burs_amount']) ? number_format($po['ors_burs_amount'], 2) : '') . '
            </p>
            </td>
        </tr>
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output('PO No. ' . htmlspecialchars($order['po_no']) . '.pdf', 'I'); 

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>