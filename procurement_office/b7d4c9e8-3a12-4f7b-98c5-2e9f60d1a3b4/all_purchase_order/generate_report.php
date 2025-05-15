<?php
require '../classes/config.php';
include '../../database/db.php';
require_once('../../../TCPDF-main/tcpdf.php');

ob_start();

// Get report parameters from the query string
$reportType = $_GET['reportType'];
$selectedMonth = $_GET['selectedMonth'];
$selectedYear = $_GET['selectedYear'];
$selectedYearMonthly = $_GET['selectedYearMonthly'];
$poType = $_GET['poType'];

try {
    $sql = "SELECT po_no, requestor, requisitioning_office, supplier, date, status FROM purchase_orders"; 

    $whereClauses = [];
    $params = [];

    if ($poType !== 'All') {
        if ($poType === 'Complete/Incomplete') {
            $whereClauses[] = "status IN ('Complete', 'Incomplete')";
        } else {
            $whereClauses[] = "status = :poType";
            $params[':poType'] = $poType;
        }
    }

    if ($reportType === 'Weekly') {
        $today = new DateTime();
        $weekStart = $today->modify('last monday')->format('Y-m-d');
        $weekEnd = $today->modify('next sunday')->format('Y-m-d');

        $whereClauses[] = "date BETWEEN :weekStart AND :weekEnd";
        $params[':weekStart'] = $weekStart;
        $params[':weekEnd'] = $weekEnd;

        // Format the date range for weekly reports
        $weekStartDate = date('F d, Y', strtotime($weekStart));
        $weekEndDate = date('F d, Y', strtotime($weekEnd));

    } elseif ($reportType === 'Monthly') {
        $whereClauses[] = "MONTH(date) = :selectedMonth AND YEAR(date) = :selectedYearMonthly";
        $params[':selectedMonth'] = $selectedMonth;
        $params[':selectedYearMonthly'] = $selectedYearMonthly;

        // Format the month and year for monthly reports
        $selectedMonthName = date('F', mktime(0, 0, 0, $selectedMonth, 10)); 
        $selectedYearForDisplay = $selectedYearMonthly; 

    } elseif ($reportType === 'Yearly') {
        $whereClauses[] = "YEAR(date) = :selectedYear";
        $params[':selectedYear'] = $selectedYear;

        $selectedYearForDisplay = $selectedYear;
    }

    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(" AND ", $whereClauses);
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $pos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Purchase Order Reports');
    $pdf->SetSubject('PO');
    $pdf->SetKeywords('PO, Purchase, Order, Report');

    // Set margins
    $pdf->SetMargins(15, 27, 15);
    $pdf->SetHeaderMargin(0); 
    $pdf->SetFooterMargin(0);

    $pdf->setPrintHeader(false); 
    $pdf->setPrintFooter(false); 

    $pdf->SetAutoPageBreak(TRUE, 25);

    $pdf->AddPage();

    // Add logo on the left
    $pdf->Image('../../../css/image/system-logo.png', 25, 10, 17, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $pageWidth = $pdf->getPageWidth();
    $imageWidth = 17; // Adjust image width as needed
    $xPosition = $pageWidth - $imageWidth - 25; // Adjust horizontal offset as needed
    
    $pdf->Image('../../../css/image/bagong-pilipinas.png', $xPosition, 10, $imageWidth, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Add the header information in the center
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetXY(20, 15); 
    $pdf->writeHTMLCell(0, 0, '', '', '
                <div style="text-align: center;">
                    Republic of the Philippines<br>
                    <span style="color: red;">EASTERN VISAYAS STATE UNIVERSITY</span><br>
                    <span style="color: red;">ORMOC CAMPUS</span><br>
                    Ormoc City, Leyte 6541
                </div>', 0, 1, 0, true, 'C', true); 

    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->SetXY(23, 40);
    $pdf->Cell(0, 0, 'Purchase Order', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

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
    $pdf->SetFont('helvetica', '', 10); 

    // Create the table header with sky blue color
    $headerHtml = '
    <table cellpadding="4" cellspacing="0" border="0.9" style="width: 100%; margin-bottom: 15px;">
        <tr style="background-color: #87CEEB;">
            <th style="width: 15%; text-align: center;">PO No.</th>
            <th style="width: 30%; text-align: center;">Requestor</th>
            <th style="width: 25%; text-align: center;">Requesitioning Office</th>
            <th style="width: 15%; text-align: center;">Date</th>
            <th style="width: 15%; text-align: center;">Status</th>
        </tr>
    </table>';
    $pdf->writeHTML($headerHtml, true, false, true, false, '');
    $pdf->Ln(-7.1);
    $html = '
    <table cellpadding="1.5" cellspacing="0" border="0.9" style="width: 100%;">
        ';


    foreach ($pos as $poData) {
        $poType = '';
        if ($poData['status'] === 'Complete') {
            $poType = 'Arrived';
        } elseif ($poData['status'] === 'Incomplete') {
            $poType = 'Arrived'; 
        } elseif ($poData['status'] === 'approved') {
            $poType = 'Approved';
        } elseif ($poData['status'] === 'pending') {
            $poType = 'Pending';
        } elseif ($poData['status'] === 'canceled') {
            $poType = 'Canceled';
        }
        $html .= '
        <tr>
            <td style="width: 15%; text-align: center;">' . htmlspecialchars($poData['po_no']) . '</td>
            <td style="width: 30%; text-align: left;">' . htmlspecialchars($poData['requestor']) . '</td>
            <td style="width: 25%; text-align: left;">' . htmlspecialchars($poData['requisitioning_office']) . '</td>
            <td style="width: 15%; text-align: center;">' . date('M d, Y', strtotime($poData['date'])) . '</td>
            <td style="width: 15%; text-align: center;">' . $poType . '</td>
        </tr>
        ';
    }

    $html .= '</table>';

    // Write the main table HTML content into the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Image('../../css/image/footer.png', ($pdf->getPageWidth() - $pdf->getPageWidth() * 0.8) / 2, $pdf->getPageHeight() - 48, $pdf->getPageWidth() * 0.8, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Add footer content
    $pdf->SetFont('helvetica', 'I', 10); // Set font to Helvetica, italic, size 9
    $pdf->SetY(-42); // Position the footer 20mm from the bottom
    $pdf->Ln(5);
    $pdf->Cell(0, 10, 'BRGY. DON FELIPE LARRAZABAL 6541 ORMOC CITY, PHILIPPINES', 0, 0, 'C');
    $pdf->Ln(6);
    $pdf->writeHTMLCell(0, 0, '', '', 'Email: <a href="mailto:evsu.ormoc@evsu.edu.ph">evsu.ormoc@evsu.edu.ph</a> | Website: <a href="https://ormoc.evsu.edu.ph/">https://ormoc.evsu.edu.ph/</a>', 0, 1, 0, true, 'C', true);

    
    $fileName = "PO ";
    if ($reportType === 'Weekly') {
        $fileName .= "Weekly Reports (" . $weekStartDate . " to " . $weekEndDate . ")";
    } elseif ($reportType === 'Monthly') {
        $fileName .= "Monthly Reports (" . $selectedMonthName . ", " . $selectedYearForDisplay . ")";
    } elseif ($reportType === 'Yearly') {
        $fileName .= "Yearly Reports (" . $selectedYearForDisplay . ")";
    } else {
        $fileName .= $reportType;
    }

    // Output the PDF with dynamic filename based on report type
    $pdf->Output($fileName . '.pdf', 'I');

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>