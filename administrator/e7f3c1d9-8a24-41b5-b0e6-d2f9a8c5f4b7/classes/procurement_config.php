<?php
//---------------------------PENDING 
function fetchPendingPurchaseOrders($conn) {
    try {
        $sql = "SELECT po.id, po.requestor, po.requisitioning_office, po.po_no, po.date, po.status 
                FROM purchase_orders po 
                WHERE po.status = 'pending' 
                ORDER BY po.date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
$ppurchase_orders = fetchPendingPurchaseOrders($conn);

//---------------------------APPROVED 
function fetchAllPurchaseOrders($conn) {
    try {
        $sql = "SELECT po.id, po.requestor, po.requisitioning_office, po.po_no, po.date, po.status 
                FROM purchase_orders po 
                 WHERE po.status IN ('Approved', 'Complete', 'Incomplete', 'approved', 'canceled', 'pending')
                ORDER BY po.date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
$allpurchase_orders = fetchAllPurchaseOrders($conn);


//---------------------------APPROVED PO
function fetchApprovedPurchaseOrders($conn) {
    try {
        $sql = "SELECT po.id, po.requestor, po.requisitioning_office, po.supplier, po.po_no, po.date, po.status 
                FROM purchase_orders po 
                WHERE po.status IN ('approved', 'incomplete', 'complete')  
                ORDER BY po.date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
$apurchase_orders = fetchApprovedPurchaseOrders($conn);

//---------------------------CANCELED PO
function fetchCanceledPurchaseOrders($conn) {
    try {
        $sql = "SELECT po.id, po.requestor, po.requisitioning_office, po.po_no, po.date, po.status 
                FROM purchase_orders po 
                WHERE po.status = 'canceled' 
                ORDER BY po.date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
$cpurchase_orders = fetchCanceledPurchaseOrders($conn);

//------------------------------------------ PROCUREMENT DASHBOARD
function getPOCounts($conn) {
    $pendingQuery = "SELECT COUNT(*) as pending_count FROM purchase_orders WHERE status = 'Pending'";
    $stmtPending = $conn->prepare($pendingQuery);
    $stmtPending->execute();
    $pendingResult = $stmtPending->fetch(PDO::FETCH_ASSOC);
    $pendingPO = $pendingResult['pending_count'];

    $canceledQuery = "SELECT COUNT(*) as canceled_count FROM purchase_orders WHERE status = 'canceled'";
    $stmtCanceled = $conn->prepare($canceledQuery);
    $stmtCanceled->execute();
    $canceledResult = $stmtCanceled->fetch(PDO::FETCH_ASSOC);
    $canceledPO = $canceledResult['canceled_count'];

    $approvedQuery = "SELECT COUNT(*) as approved_count FROM purchase_orders WHERE status IN ('Approved', 'Complete', 'Incomplete')";
    $stmtApproved = $conn->prepare($approvedQuery);
    $stmtApproved->execute();
    $approvedResult = $stmtApproved->fetch(PDO::FETCH_ASSOC);
    $approvedPO = $approvedResult['approved_count'];

    $allQuery = "SELECT COUNT(*) as all_count FROM purchase_orders WHERE status  IN ('Approved', 'Complete', 'Incomplete', 'approved', 'canceled', 'pending')";
    $stmtall = $conn->prepare($allQuery);
    $stmtall->execute();
    $allResult = $stmtall->fetch(PDO::FETCH_ASSOC);
    $allPO = $allResult['all_count'];

    return [$pendingPO,  $canceledPO, $approvedPO, $allPO]; 
}
list($pendingPO, $canceledPO, $approvedPO, $allPO) = getPOCounts($conn);


//---------------------------------------------------DISPLAY IN VIEW P.O
$po_id = $_GET['id'] ?? null;
$order = null;
$items = [];

if ($po_id) {
    try {
        $stmt = $conn->prepare("SELECT * FROM purchase_orders WHERE id = :id");
        $stmt->bindParam(':id', $po_id, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $requestorName = $order['requestor'];
        

        $stmt_items = $conn->prepare("SELECT * FROM purchase_order_items WHERE po_id = :po_id");
        $stmt_items->bindParam(':po_id', $po_id, PDO::PARAM_INT);
        $stmt_items->execute();
        $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//--------------------------------------------------------------------------------------------------VIEW PO
try {
    if (isset($order['id'])) {
        $labels = $conn->query("SELECT * FROM purchase_order_labels WHERE po_id = " . intval($order['id']) . " ORDER BY label_no")->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $labels = []; // Handle the case where order id is not set
    }
} catch (PDOException $e) {
}

if (isset($order['id']) && !empty($order['id'])) {
    $stmt = $conn->prepare("SELECT * FROM purchase_order_items WHERE po_id = :po_id");
    $stmt->bindParam(':po_id', $order['id'], PDO::PARAM_INT);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $items = []; 
}

function displayItemsAndLabels($items, $labels, $conn) {
    $output = '';
    $labelIndex = 0; 
    $numLabels = count($labels);

    foreach ($items as $item) { 
        while ($labelIndex < $numLabels && $labels[$labelIndex]['label_no'] <= $item['stock_no']) {
            $output .= '<tr><td colspan="6"><strong>' . htmlspecialchars($labels[$labelIndex]['label_text']) . '</strong></td></tr>';
            $labelIndex++;
        }

        $output .= '<tr>
            <td>' . htmlspecialchars($item['stock_no']) . '</td>
            <td>' . htmlspecialchars($item['unit']) . '</td>
            <td style="text-align: left;">' . htmlspecialchars($item['description']) . '</td>
            <td>' . htmlspecialchars($item['quantity']) . '</td>
            <td>' . htmlspecialchars($item['unit_cost']) . '</td>
            <td>' . htmlspecialchars($item['amount']) . '</td>
        </tr>';

        $specificationsStmt = $conn->prepare("SELECT * FROM po_item_specifications WHERE po_id = :po_id AND item_no = :item_no");
        $specificationsStmt->bindParam(':po_id', $item['po_id'], PDO::PARAM_INT);
        $specificationsStmt->bindParam(':item_no', $item['stock_no'], PDO::PARAM_INT);
        $specificationsStmt->execute();
        $specifications = $specificationsStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($specifications as $spec) {
            $specificationText = htmlspecialchars($spec['item_specification']);
            $specificationLines = wordwrap($specificationText, 30, "<br>", true);  
            
            $output .= '<tr>
                <td></td>
                <td></td>
                <td colspan="1" style="text-align: left;">' . $specificationLines . '</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>';
        }
    }
    return $output; 
}

//---------------------------------------------------------------------- DELETE PO
function deletePO($conn, $poId) {
    try {
        // Prepare the SQL statement to delete the purchase order
        $sql = "DELETE FROM purchase_orders WHERE id = :id";

        // Prepare the statement with the ID
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $poId, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    } catch (PDOException $e) {
        echo "Error deleting purchase order: " . $e->getMessage();
        return false;
    }
}

// Handle deletion request
if (isset($_GET['delete_po_id'])) {
    $poIdToDelete = $_GET['delete_po_id'];
    if (deletePO($conn, $poIdToDelete)) {
        // Set the success message in the session
        $_SESSION['success_message'] = "Purchase order deleted successfully!";
        header("Location: ../"); 
        exit;
    } else {
        echo "Error deleting purchase order.";
    }
}

// PO ANALYTICS
$yearlyQuery = "SELECT YEAR(date) AS year, COUNT(*) AS count 
                FROM purchase_orders 
                GROUP BY YEAR(date)";
$stmtYearly = $conn->prepare($yearlyQuery);
$stmtYearly->execute();
$yearlyData = $stmtYearly->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for the line chart
$years = [];
$yearlyCounts = [];
foreach ($yearlyData as $row) {
    $years[] = $row['year'];
    $yearlyCounts[] = $row['count'];
}

$monthlyQuery = "SELECT CONCAT(MONTHNAME(date), ' ', YEAR(date)) AS month_year, COUNT(*) AS count 
                 FROM purchase_orders 
                 GROUP BY YEAR(date), MONTH(date)";
$stmtMonthly = $conn->prepare($monthlyQuery);
$stmtMonthly->execute();
$monthlyData = $stmtMonthly->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for the chart
$monthsYears = [];
$counts = [];
foreach ($monthlyData as $row) {
    $monthsYears[] = $row['month_year']; // e.g., "January 2024"
    $counts[] = $row['count'];
}



?>