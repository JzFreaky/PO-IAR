<?php
require '../../classes/config.php';
require '../../classes/supply_config.php';
include '../../../database/db.php'; 
require_once('../../../../TCPDF-main/tcpdf.php');

ob_start();

$iarId = $_GET['id'];

try {
    $stmt = $conn->prepare("SELECT * FROM inspection_acceptance_report WHERE id = :id");
    $stmt->bindParam(':id', $iarId);
    $stmt->execute();
    $iar = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Inspection and Acceptance Report');
    $pdf->SetSubject('IAR');
    $pdf->SetKeywords('IAR, Inspection, Acceptance, Report');

    $pdf->SetMargins(15, 27, 15); // Left, Top, Right
    $pdf->SetHeaderMargin(0); 
    $pdf->SetFooterMargin(0); 

    $pdf->setPrintHeader(false); 
    $pdf->setPrintFooter(false); 

    $pdf->SetAutoPageBreak(TRUE, 25);

    $pdf->AddPage();

    //$pdf->Image('../../../css/image/system-logo.png', 25, 10, 15, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $pdf->SetXY(170, 5); // Position near the upper right corner (adjust the X value as needed)
    $pdf->SetFont('helvetica', 'B', 9); // Font: Helvetica, Style: Bold, Size: 12
    $pdf->Cell(0, 0, 'Appendix 62', 0, 1, 'R'); 
    
    $pdf->SetFont('helvetica', 'B', 14); // Font: Helvetica, Style: Bold, Size: 14
    $pdf->SetXY(25, 15); // Set position to center vertically with the logo
    $pdf->Cell(0, 0, 'INSPECTION AND ACCEPTANCE REPORT', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

    $pdf->Ln(15); 

    // Set font for the table content (smaller font)
    $pdf->SetFont('helvetica', '', 10); // Font: Helvetica, Style: Regular, Size: 10

    $headerHtml = '
    <table cellpadding="1" cellspacing="0" border="0" style="width: 100%; margin-bottom: 15px;">
        <tr>
            <td style="width: 75%; text-align: left;"><strong>Entity Name:</strong> <u>' . htmlspecialchars($iar['entity_name']) . '</u></td>
            <td style="width: 23%; text-align: right;"><strong>Fund Cluster:</strong> <u>' . htmlspecialchars($iar['fund_cluster']) . '</u></td>
        </tr>
    </table>';

    $pdf->writeHTML($headerHtml, true, false, true, false, '');
    $pdf->Ln(-2);

    // HTML content for main table with specific width for right-side cells
    $html = '
    <style>
        .left-cell { width: 74%; }
        .right-cell { width: 26%; }
        td {
            width: auto; 
            overflow-wrap: break-word; 
        }
    </style>
    <table cellpadding="2" cellspacing="0" border="0.9" style="width: 100%;">
        <tr>
            <td class="left-cell"><strong>Supplier:</strong> <u>' . htmlspecialchars($iarData['supplier']) . '</u></td>
            <td class="right-cell"><strong>IAR No.:</strong> <u>' . htmlspecialchars($iarData['iar_no']) . '</u></td>
        </tr>
        <tr>
            <td class="left-cell"><strong>P.O No./Date:</strong> <u>' . htmlspecialchars($iarData['po_no']) . '</u></td>
            <td class="right-cell"><strong>IAR Date:</strong> <u>' . date('M d, Y', strtotime($iarData['iar_date'])) . '</u></td>
        </tr>
        <tr>
            <td class="left-cell"><strong>Requisitioning Office/Dept.:</strong> <u>' . htmlspecialchars($iarData['req_office']) . '</u></td>
            <td class="right-cell"><strong>Invoice No.:</strong> <u>' . htmlspecialchars($iarData['invoice_no']) . '</u></td>
        </tr>
        <tr>
            <td class="left-cell"><strong>Responsibility Center Code:</strong> <u>' . 
                (isset($iarData['resp_code']) ? htmlspecialchars($iarData['resp_code']) . ' - ' . htmlspecialchars(substr($iarData['sub_object_code'], 0, 25)) . (strlen($iarData['sub_object_code']) > 30 ? '...' : '') : 'N/A') . '</u></td>
            <td class="right-cell"><strong>Invoice Date:</strong> <u>' . date('M d, Y', strtotime($iarData['invoice_date'])) . '</u></td>
        </tr>
    </table>';
    
    $pdf->writeHTML($html, true, false, true, false, '');

    $stmt_items = $conn->prepare("SELECT * FROM iar_item_details WHERE iar_id = :id ORDER BY stock_no ASC");
    $stmt_items->bindParam(':id', $iarId);
    $stmt_items->execute();
    $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

    $stmt_labels = $conn->prepare("SELECT * FROM iar_item_labels WHERE iar_id = :id ORDER BY label_no");
    $stmt_labels->bindParam(':id', $iarId);
    $stmt_labels->execute();
    $labels = $stmt_labels->fetchAll(PDO::FETCH_ASSOC);

    $labelsByStockNo = [];
    foreach ($labels as $label) {
        $labelsByStockNo[$label['label_no']][] = $label['label_text'];
    }

    $stmt_specifications = $conn->prepare("SELECT * FROM iar_item_specifications WHERE iar_id = :id");
    $stmt_specifications->bindParam(':id', $iarId);
    $stmt_specifications->execute();
    $specifications = $stmt_specifications->fetchAll(PDO::FETCH_ASSOC);

    // Group specifications by item number
    $specificationsByItemNo = [];
    foreach ($specifications as $spec) {
        $specificationsByItemNo[$spec['item_no']][] = $spec['item_specification'];
    }


    $pdf->Ln(-5.9);

    $html = '
    <table border="0.9" cellpadding="2" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th style="text-align: center; width: 20%;">Stock/Property No.</th>
                <th style="text-align: center; width: 54%;">Description</th>
                <th style="text-align: center; width: 15%;">Unit</th>
                <th style="text-align: center; width: 11%;">Quantity</th>
            </tr>
        </thead>
        <tbody>';

    $counter = 1;

    foreach ($items as $item) {
        // Display labels first, if any
        if (isset($labelsByStockNo[$item['stock_no']])) {
            foreach ($labelsByStockNo[$item['stock_no']] as $label) {
                $html .= '<tr>';
                $html .= '<td style="text-align: center; width: 20%;">&nbsp;</td>';
                $html .= '<td style="width: 54%; text-align: center;"><strong>' . htmlspecialchars($label) . '</strong></td>';
                $html .= '<td style="text-align: center; width: 15%;">&nbsp;</td>';
                $html .= '<td style="text-align: center; width: 11%;">&nbsp;</td>';
                $html .= '</tr>';
            }
        }

        // Display item details
        $html .= '<tr>';
        $html .= '<td style="text-align: center; width: 20%;">' . $counter++ . '</td>';
        $html .= '<td style="width: 54%;">' . htmlspecialchars($item['description']) . '</td>';
        $html .= '<td style="text-align: center; width: 15%;">' . htmlspecialchars($item['unit']) . '</td>';
        $html .= '<td style="text-align: center; width: 11%;">' . htmlspecialchars($item['quantity']) . '</td>';
        $html .= '</tr>';

        // Display specifications for this item
        if (isset($specificationsByItemNo[$item['stock_no']])) {  // Use stock_no here
            foreach ($specificationsByItemNo[$item['stock_no']] as $spec) {
                $html .= '<tr>';
                $html .= '<td style="text-align: center; width: 20%;">&nbsp;</td>';  // Empty cell for specifications
                $html .= '<td style="width: 54%;">' . htmlspecialchars($spec) . '</td>';  // Display specification in italic
                $html .= '<td style="text-align: center; width: 15%;">&nbsp;</td>';
                $html .= '<td style="text-align: center; width: 11%;">&nbsp;</td>';
                $html .= '</tr>';
            }
        }
    }
            
    $html .= '<tr>
                <td>&nbsp;</td> 
                <td style="text-align: center;">**************** Nothing Follows ********************</td> 
                <td>&nbsp;</td> 
                <td>&nbsp;</td> 
            </tr>';

    for ($i = 0; $i < 4; $i++): 
        $html .= '<tr>
                    <td>&nbsp;</td> 
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                </tr>';
    endfor;

    $html .= '</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Ln(-5.9);

    $inspectionCheckbox = isset($iarData['insp_status']) && $iarData['insp_status'] == 'complete' ? '☑' : '☐';
    $completeCheckbox = isset($iarData['property_custodian_status']) && 
    ($iarData['insp_status'] == 'complete') ? '☑' : '☐';
    $partialCheckbox = isset($iarData['insp_status']) && $iarData['insp_status'] == 'partial' ? '☑' : '☐';

    
    $html = '
    <table border="0.9" cellpadding="5" cellspacing="0" style="width: 100%;">
        <tbody>
        <tr>
            <td>
                <p style="line-height: 0.2;"><strong>Date Inspected:</strong> 
                    <span style="text-decoration:underline; text-decoration-thickness: 2px;">' . date('M d, Y', strtotime($iarData['date_inspected'])) . '</span>
                </p>
                <p>
                    Inspected, verified, and found in order as to quantity and specifications
                </p>
                <div style="text-align: center;">
                    <span style="line-height: 5.5;"> <u></u></span>
                </div>
            </td>
            <td style="vertical-align: top;">
                <p style="line-height: 0.2;"><strong>Date Received:</strong> 
                    <span><u>' . date('M d, Y', strtotime($iarData['date_received'])) . '</u></span>
                </p>
                <p>
                    <span style="font-family: dejavusans;">' . $completeCheckbox . '</span> Complete
                </p>
                 <p style="line-height: 0.2;">
                    <span style="font-family: dejavusans;">' . $partialCheckbox . '</span> Partial (pls. specify quantity): 
                </p>
                ' . (isset($iarData['insp_status']) && $iarData['insp_status'] == 'partial' && isset($iarData['incomplete_details']) ? 
                '<p style="margin-top: -10px; margin-left: 30px; line-height: .9; font-size: 8pt;">"' . htmlspecialchars($iarData['incomplete_details']) . '"</p>' : '') . '
                
            </td>
        </tr>
    </tbody>
    </table>';

    
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(-7.9);

    $html = '
    <table border="0.9" cellspacing="0" cellpadding="2" style="width: 100%;">
    <tbody>
    <tr>
        <td style="width: 50%; text-align: center; vertical-align: middle;">
            <span style="line-height: 1; text-transform: uppercase;"><u>' . htmlspecialchars($iar['inspection_officer']) . '</u></span>
        </td>
        <td style="width: 50%; text-align: center; vertical-align: middle;">
            <span style="line-height: 1; text-transform: uppercase;"><u>' . htmlspecialchars($iar['head_procurement']) . '</u></span>
        </td>
    </tr>
    <tr>
        <td style="width: 50%; text-align: center; padding-top: 5px;">
            Inspection Officer/Inspection Committee
        </td>
        <td style="width: 50%; text-align: center; padding-top: 5px;">
            Head, Procurement and Property Management Office
        </td>
    </tr>
    </tbody>
</table>';
    
    
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output('IAR No. ' . htmlspecialchars($iarData['iar_no']) . '.pdf', 'I');

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
