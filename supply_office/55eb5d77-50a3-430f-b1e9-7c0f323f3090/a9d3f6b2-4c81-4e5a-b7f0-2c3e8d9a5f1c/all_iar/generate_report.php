<?php
require '../../class/function/config.php';
include '../../../database/db.php';
require_once('../../../../TCPDF-main/tcpdf.php');

ob_start();

// Get report parameters from the query string
$reportType = $_GET['reportType'];
$selectedMonth = $_GET['selectedMonth'];
$selectedYear = $_GET['selectedYear'];
$selectedYearMonthly = $_GET['selectedYearMonthly'];
$iarType = $_GET['iarType'];

try {
    // Prepare the SQL query based on the report parameters
    $sql = "SELECT iar_no, po_no, requestor, fund_cluster, iar_date, insp_status FROM inspection_acceptance_report"; 

    $whereClauses = [];
    $params = [];

    if ($iarType !== 'All') {
        $whereClauses[] = "insp_status = :iarType";
        $params[':iarType'] = $iarType;
    }

    if ($reportType === 'Weekly') {
        // Calculate the start and end dates of the current week
        $today = new DateTime();
        $weekStart = $today->modify('last monday')->format('Y-m-d');
        $weekEnd = $today->modify('next sunday')->format('Y-m-d');

        $whereClauses[] = "iar_date BETWEEN :weekStart AND :weekEnd";
        $params[':weekStart'] = $weekStart;
        $params[':weekEnd'] = $weekEnd;

        // Format the date range for weekly reports
        $weekStartDate = date('F d, Y', strtotime($weekStart));
        $weekEndDate = date('F d, Y', strtotime($weekEnd));

    } elseif ($reportType === 'Monthly') {
        $whereClauses[] = "MONTH(iar_date) = :selectedMonth AND YEAR(iar_date) = :selectedYearMonthly";
        $params[':selectedMonth'] = $selectedMonth;
        $params[':selectedYearMonthly'] = $selectedYearMonthly;

        // Format the month and year for monthly reports
        $selectedMonthName = date('F', mktime(0, 0, 0, $selectedMonth, 10)); 
        $selectedYearForDisplay = $selectedYearMonthly; 

    } elseif ($reportType === 'Yearly') {
        $whereClauses[] = "YEAR(iar_date) = :selectedYear";
        $params[':selectedYear'] = $selectedYear;

        // Format the year for yearly reports
        $selectedYearForDisplay = $selectedYear;
    }

    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(" AND ", $whereClauses);
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $iars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Inspection and Acceptance Reports');
    $pdf->SetSubject('IAR');
    $pdf->SetKeywords('IAR, Inspection, Acceptance, Report');

    // Set margins
    $pdf->SetMargins(15, 27, 15); // Left, Top, Right
    $pdf->SetHeaderMargin(0); // Remove header margin
    $pdf->SetFooterMargin(0); // Remove footer margin

    $pdf->setPrintHeader(false); // Disable header
    $pdf->setPrintFooter(false); // Disable footer

    $pdf->SetAutoPageBreak(TRUE, 25);

    $pdf->AddPage();

    // Add logo on the left
    $pdf->Image('../../../css/image/system-logo.png', 25, 10, 20, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $pageWidth = $pdf->getPageWidth();
    $imageWidth = 20; // Adjust image width as needed
    $xPosition = $pageWidth - $imageWidth - 25; // Adjust horizontal offset as needed
    
    // Add the image on the right
    $pdf->Image('../../../css/image/bagong-pilipinas.png', $xPosition, 10, $imageWidth, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Add the header information in the center
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetXY(20, 15); // Set X to 0 for center alignment
    $pdf->writeHTMLCell(0, 0, '', '', '
                <div style="text-align: center;">
                    Republic of the Philippines<br>
                    <span style="color: red;">EASTERN VISAYAS STATE UNIVERSITY</span><br>
                    <span style="color: red;">ORMOC CAMPUS</span><br>
                    Ormoc City, Leyte 6541
                </div>', 0, 1, 0, true, 'C', true); // 'C' for center alignment

    // Calculate the width to center the title "Inspection and Acceptance Report"
    $pdf->SetFont('helvetica', 'B', 14); // Font: Helvetica, Style: Bold, Size: 14
    $pdf->SetXY(23, 40); // Set position to center vertically with the logo
    $pdf->Cell(0, 0, 'Inspection and Acceptance Reports', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

    // Add the report type below the title
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetXY(25, 50);
    if ($reportType === 'Weekly') {
        $pdf->Cell(0, 0, ' Weekly Reports (' . $weekStartDate . ' to ' . $weekEndDate . ')', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    } elseif ($reportType === 'Monthly') {
        $pdf->Cell(0, 0, ' Monthly Reports (' . $selectedMonthName . ', ' . $selectedYearForDisplay . ')', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    } elseif ($reportType === 'Yearly') {
        $pdf->Cell(0, 0, ' Yearly Reports (' . $selectedYearForDisplay . ')', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    } else {
        $pdf->Cell(0, 0, ' ' . $reportType, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }

    $pdf->Ln(3); 

    // Set font for the table content (smaller font)
    $pdf->SetFont('helvetica', '', 10); // Font: Helvetica, Style: Regular, Size: 10

    // Create the table header with sky blue color
    $headerHtml = '
    <table cellpadding="3" cellspacing="0" border="0.9" style="width: 100%; margin-bottom: 15px;">
        <tr style="background-color: #87CEEB;">
            <th style="width: 10%; text-align: center;">IAR No.</th>
            <th style="width: 28%; text-align: center;">P.O. No./Date</th>
            <th style="width: 22%; text-align: center;">Requestor</th>
            <th style="width: 10%; text-align: center;">Fund Cluster</th>
            <th style="width: 15%; text-align: center;">IAR Date</th>
            <th style="width: 15%; text-align: center;">IAR Type</th>
        </tr>
    </table>';

    // Write the header HTML content into the PDF
    $pdf->writeHTML($headerHtml, true, false, true, false, '');
    $pdf->Ln(-6.5);
    $pdf->SetFont('helvetica', '', 8.5);
    $html = '
    <table cellpadding="2" cellspacing="0" border="0.9" style="width: 100%;">
        ';

    // Loop through each IAR
    foreach ($iars as $iarData) {
        $iarType = '';
        if ($iarData['insp_status'] === 'complete') {
            $iarType = 'Complete';
        } elseif ($iarData['insp_status'] === 'partial') {
            $iarType = 'Partial';
        } elseif ($iarData['property_custodian_status'] === 'accept/not correct specs') {
            $iarType = 'Accept/Not Correct Specs';
        } elseif ($iarData['property_custodian_status'] === 'rejected') {
            $iarType = 'Rejected';
        } elseif ($iarData['property_custodian_status'] === 'pending') {
            $iarType = 'Pending';
        }
        $html .= '
        <tr>
            <td style="width: 10%; text-align: center;">' . htmlspecialchars($iarData['iar_no']) . '</td>
            <td style="width: 28%; text-align: left;">' . htmlspecialchars($iarData['po_no']) . '</td>
            <td style="width: 22%; text-align: left;">' . htmlspecialchars($iarData['requestor']) . '</td>
            <td style="width: 10%; text-align: left;">' . htmlspecialchars($iarData['fund_cluster']) . '</td>
            <td style="width: 15%; text-align: center;">' . date('M d, Y', strtotime($iarData['iar_date'])) . '</td>
            <td style="width: 15%; text-align: center;">' . $iarType . '</td>
        </tr>
        ';
    }

    $html .= '</table>';

    // Write the main table HTML content into the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Image('../../../css/image/footer.png', ($pdf->getPageWidth() - $pdf->getPageWidth() * 0.8) / 2, $pdf->getPageHeight() - 48, $pdf->getPageWidth() * 0.8, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Add footer content
    $pdf->SetFont('helvetica', 'I', 10); // Set font to Helvetica, italic, size 9
    $pdf->SetY(-42); // Position the footer 20mm from the bottom
    $pdf->Ln(5);
    $pdf->Cell(0, 10, 'BRGY. DON FELIPE LARRAZABAL 6541 ORMOC CITY, PHILIPPINES', 0, 0, 'C');
    $pdf->Ln(6);
    $pdf->writeHTMLCell(0, 0, '', '', 'Email: <a href="mailto:evsu.ormoc@evsu.edu.ph">evsu.ormoc@evsu.edu.ph</a> | Website: <a href="https://ormoc.evsu.edu.ph/">https://ormoc.evsu.edu.ph/</a>', 0, 1, 0, true, 'C', true);
    
    // Output the PDF
    $fileName = "IAR " . $reportType . " Reports";
    if ($reportType === 'Monthly') {
        $selectedMonthName = date('F', mktime(0, 0, 0, $selectedMonth, 10)); 
        $fileName .= " (" . $selectedMonthName . ", " . $selectedYearMonthly . ")";
    } elseif ($reportType === 'Yearly') {
        $fileName .= " (" . $selectedYear . ")";
    }
    $pdf->Output($fileName . '.pdf', 'I');

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>