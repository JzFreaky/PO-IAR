<?php
//------------------------------------------ PENDING IAR
function fetchpendingIARs($conn) {
    try {
        $stmt = $conn->prepare("
           SELECT iar.id, iar.iar_no, iar.po_no, iar.requestor, iar.req_office, iar.iar_date AS date, iar.insp_status,
       GROUP_CONCAT(iad.description SEPARATOR ', ') AS item_descriptions
        FROM inspection_acceptance_report iar
        LEFT JOIN iar_item_details iad ON iar.id = iad.iar_id
        WHERE iar.property_custodian_status = 'pending'
        GROUP BY iar.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching IAR data: " . $e->getMessage();
        return [];
    }
}
$pendingIARs = fetchpendingIARs($conn);

//-------------------------------------------------------------------------------------------- NOT DELIVERED IAR
function fetchrejIARs($conn) {
    try {
        $stmt = $conn->prepare("SELECT iar.id, iar.iar_no, iar.po_no, iar.requestor, iar.req_office, iar.iar_date AS date, iar.property_custodian_status, 
                   GROUP_CONCAT(iad.description SEPARATOR ', ') AS item_descriptions
                                 FROM inspection_acceptance_report iar
                                 LEFT JOIN iar_item_details iad ON iar.id = iad.iar_id
                                WHERE iar.property_custodian_status = 'rejected'
                                GROUP BY iar.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching IAR data: " . $e->getMessage();
        return [];
    }
}
$rejIARs = fetchrejIARs($conn);


//------------------------------------------ DELIVERED IAR
function fetchdeliveredIARs($conn) {
    try {
        $stmt = $conn->prepare("SELECT iar.id, iar.iar_no, iar.po_no, iar.requestor, iar.req_office, iar.iar_date AS date, iar.property_custodian_status, 
                   GROUP_CONCAT(iad.description SEPARATOR ', ') AS item_descriptions
                                 FROM inspection_acceptance_report iar
                                 LEFT JOIN iar_item_details iad ON iar.id = iad.iar_id
                                WHERE iar.property_custodian_status IN ('complete','partial','accept/not correct specs')
                                GROUP BY iar.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching IAR data: " . $e->getMessage();
        return [];
    }
}
$deliveredIARs = fetchdeliveredIARs($conn);


//------------------------------------------ ALL IAR
function fetchallIARs($conn) {
    try {
        $stmt = $conn->prepare("SELECT iar.id, iar.iar_no, iar.po_no, iar.requestor, iar.req_office, iar.iar_date AS date, iar.property_custodian_status, 
                   GROUP_CONCAT(iad.description SEPARATOR ', ') AS item_descriptions
                                 FROM inspection_acceptance_report iar
                                 LEFT JOIN iar_item_details iad ON iar.id = iad.iar_id
                                WHERE iar.property_custodian_status IN ('complete','partial','accept/not correct specs','rejected','pending')
                                GROUP BY iar.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching IAR data: " . $e->getMessage();
        return [];
    }
}
$allIARs = fetchallIARs($conn);

function getIARCounts($conn) {
    $pendingQuery = "SELECT COUNT(*) as pending_count FROM inspection_acceptance_report WHERE property_custodian_status = 'pending'";
    $stmtPending = $conn->prepare($pendingQuery);
    $stmtPending->execute();
    $pendingResult = $stmtPending->fetch(PDO::FETCH_ASSOC);
    $pendingIAR = $pendingResult['pending_count'];

    $notdeliveredQuery = "SELECT COUNT(*) as canceled_count FROM inspection_acceptance_report WHERE property_custodian_status = 'rejected'";
    $stmtNotDelivered = $conn->prepare($notdeliveredQuery);
    $stmtNotDelivered->execute();
    $notdeliveredResult = $stmtNotDelivered->fetch(PDO::FETCH_ASSOC);
    $notdeliveredIAR = $notdeliveredResult['canceled_count'];

    $deliveredQuery = "SELECT COUNT(*) as approved_count FROM inspection_acceptance_report WHERE property_custodian_status IN ('complete','partial','accept/not correct specs')";
    $stmtDelivered = $conn->prepare($deliveredQuery);
    $stmtDelivered->execute();
    $deliveredResult = $stmtDelivered->fetch(PDO::FETCH_ASSOC);
    $deliveredIAR = $deliveredResult['approved_count'];

    $allQuery = "SELECT COUNT(*) as all_count FROM inspection_acceptance_report";
    $stmtall = $conn->prepare($allQuery);
    $stmtall->execute();
    $allResult = $stmtall->fetch(PDO::FETCH_ASSOC);
    $allIAR = $allResult['all_count'];
    
    $queryTotalDelivered = "SELECT COUNT(*) as total_delivery FROM arrived_items";
    $stmtTotalDelivered = $conn->query($queryTotalDelivered);
    $totalDelivered = $stmtTotalDelivered->fetch(PDO::FETCH_ASSOC)['total_delivery'];

    return [$pendingIAR,  $notdeliveredIAR, $deliveredIAR, $allIAR, $totalDelivered]; 
}
list($pendingIAR, $notdeliveredIAR, $deliveredIAR, $allIAR, $totalDelivered) = getIARCounts($conn);



//----------------------------------------------------------------VIEW IAR
$iar_id = $_GET['id'] ?? null;
$iarData = null;
$iaritemDetails = [];
$labels = [];

if ($iar_id) {
    try {
        $stmt = $conn->prepare("
            SELECT iar.*, uacs.sub_object_code
            FROM inspection_acceptance_report iar
            LEFT JOIN uacs_codes uacs ON iar.resp_code = uacs.uacs
            WHERE iar.id = :id
        ");
        $stmt->bindParam(':id', $iar_id, PDO::PARAM_INT);
        $stmt->execute();
        $iarData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($iarData) {
            // Fetch item details
            $stmt_items = $conn->prepare("SELECT * FROM iar_item_details WHERE iar_id = :iar_id");
            $stmt_items->bindParam(':iar_id', $iar_id, PDO::PARAM_INT);
            $stmt_items->execute();
            $iaritemDetails = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

            $stmt_labels = $conn->prepare("SELECT label_no, label_text FROM iar_item_labels WHERE iar_id = :iar_id");
            $stmt_labels->bindParam(':iar_id', $iar_id, PDO::PARAM_INT);
            $stmt_labels->execute();
            $labels = $stmt_labels->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
        }
    } catch (PDOException $e) {
  }
}

//-------------------------------------------------------------------------------LABELS
try {
    if (isset($order['id'])) {
        $labels = $conn->query("SELECT * FROM purchase_order_labels WHERE po_id = " . intval($order['id']) . " ORDER BY label_no")->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $labels = []; 
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

//----------------------------------------------------------------------DISPLAY IN VIEW P.O
$po_id = $_GET['id'] ?? null;
$order = null;
$poitems = [];

if ($po_id) {
    try {
        $stmt = $conn->prepare("SELECT * FROM purchase_orders WHERE id = :id");
        $stmt->bindParam(':id', $po_id, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt_poitems = $conn->prepare("SELECT * FROM purchase_order_items WHERE po_id = :po_id");
        $stmt_poitems->bindParam(':po_id', $po_id, PDO::PARAM_INT);
        $stmt_poitems->execute();
        $poitems = $stmt_poitems->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}




//--------------------------------------------------------------------------------------INSP VIEW PURCHASE ORDERS
if (isset($order) && isset($order['po_no'])) {
    $po_no = $order['po_no']; 
    $sql = "SELECT * FROM inspection_acceptance_report WHERE po_no LIKE ?";
    $stmt = $conn->prepare($sql);
    $po_no_like = '%' . $po_no . '%';
    $stmt->execute([$po_no_like]);

    $iarExists = $stmt->rowCount() > 0;
} else {
    $po_no = ''; 
    $iarExists = false;
}

$status = isset($order['status']) ? $order['status'] : ''; 
function fetchPurchaseOrders($conn) {
    try {
        $sql = "SELECT po.id, po.requestor, po.requisitioning_office, po.po_no, po.date, po.status, po.ipo_new, GROUP_CONCAT(poi.description SEPARATOR ', ') AS item_descriptions 
                FROM purchase_orders po 
                LEFT JOIN purchase_order_items poi ON po.id = poi.po_id
                WHERE po.status IN ('approved', 'incomplete', 'complete', 'canceled') 
                GROUP BY po.id 
                ORDER BY po.date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
$purchase_orders = fetchPurchaseOrders($conn);


//----------------------------------------------------------------IAR DISPLAY 
if (isset($_GET['id'])) {
    $iar_id = $_GET['id'];

    $sql = "SELECT * FROM inspection_acceptance_report WHERE id = :iar_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iar_id', $iar_id);
    $stmt->execute();
    $iar = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql_items = "SELECT * FROM iar_item_details WHERE iar_id = :iar_id";
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->bindParam(':iar_id', $iar_id);
    $stmt_items->execute();
    $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
}


//-------------------------------------------------------------------------------DELETE IAR
function deleteIAR($conn, $iarId) {
    try {
        // Prepare the SQL statement to delete the purchase order
        $sql = "DELETE FROM inspection_acceptance_report WHERE id = :id";

        // Prepare the statement with the ID
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $iarId, PDO::PARAM_INT);

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
if (isset($_GET['delete_iar_id'])) {
    $iarIdToDelete = $_GET['delete_iar_id'];
    if (deleteIAR($conn, $iarIdToDelete)) {
        $_SESSION['success_message'] = "IAR deleted successfully!";
        header("Location: ../"); 
        exit;
    } else {
        echo "Error deleting purchase order.";
    }
}

function getYearlyIARCounts($conn) {
    $currentYear = date("Y"); // Get the current year

    // Query to get IAR counts per month in the current year based on iar_date
    $query = "SELECT MONTH(iar_date) as month, COUNT(*) as iar_count 
              FROM inspection_acceptance_report 
              WHERE YEAR(iar_date) = :year 
              GROUP BY MONTH(iar_date)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
    $stmt->execute();

    // Initialize an array to store the monthly counts (12 months, initialized to 0)
    $monthlyCounts = array_fill(0, 12, 0); // Default to 0 for each month

    // Fetch the counts and assign them to the corresponding month
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $monthlyCounts[$row['month'] - 1] = $row['iar_count'];  // Map month to 0-11 index
    }

    return $monthlyCounts;
}

$monthlyIARCounts = getYearlyIARCounts($conn);


$monthlyQuery = "SELECT CONCAT(MONTHNAME(iar_date), ' ', YEAR(iar_date)) AS month_year, COUNT(*) AS count 
                 FROM inspection_acceptance_report 
                 GROUP BY YEAR(iar_date), MONTH(iar_date)";
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