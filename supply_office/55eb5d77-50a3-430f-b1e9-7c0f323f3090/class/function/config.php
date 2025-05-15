<?php
session_start();
date_default_timezone_set('Asia/Manila');
//////////////////////////////////////IAR CONFIG
include '../../../database/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}

//-------------------------------------------------------------------ACCOUNT TYPE
$username = $_SESSION['username'];
try {
    $query = "SELECT account_type FROM po_users WHERE username = :username
              UNION
              SELECT account_type FROM so_users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $fetchedAccountType = $result['account_type'] ?? null;
    $_SESSION['account_type'] = $fetchedAccountType;

} catch (PDOException $e) {
    echo "Error fetching account type: " . $e->getMessage();
    exit();
}

//--------------------------------------------------------------DASHBOARD
$queryApprovedPO = "SELECT COUNT(*) as approved_po FROM purchase_orders WHERE status IN ('approved','complete','incomplete')";
$stmtApprovedPO = $conn->query($queryApprovedPO);
$approvedPO = $stmtApprovedPO->fetch(PDO::FETCH_ASSOC)['approved_po'];

$queryTotalPIAR = "SELECT COUNT(*) as total_piar FROM inspection_acceptance_report WHERE property_custodian_status = 'pending'";
$stmtTotalPIAR = $conn->query($queryTotalPIAR);
$totalPIAR = $stmtTotalPIAR->fetch(PDO::FETCH_ASSOC)['total_piar'];

$queryTotalNDIAR = "SELECT COUNT(*) as total_ndiar FROM inspection_acceptance_report WHERE property_custodian_status = 'rejected'";
$stmtTotalNDIAR = $conn->query($queryTotalNDIAR);
$totalNDIAR = $stmtTotalNDIAR->fetch(PDO::FETCH_ASSOC)['total_ndiar'];

$queryTotalDIAR = "SELECT COUNT(*) as total_diar FROM inspection_acceptance_report WHERE property_custodian_status IN ('complete','partial','accept/not correct specs')";
$stmtTotalDIAR = $conn->query($queryTotalDIAR);
$totalDIAR = $stmtTotalDIAR->fetch(PDO::FETCH_ASSOC)['total_diar'];

$queryTotalIAR = "SELECT COUNT(*) as total_iar FROM inspection_acceptance_report";
$stmtTotalIAR = $conn->query($queryTotalIAR);
$totalIAR = $stmtTotalIAR->fetch(PDO::FETCH_ASSOC)['total_iar'];

$queryTotalInspected = "SELECT COUNT(*) as total_inspected FROM arrived_items";
$stmtTotalInspected = $conn->query($queryTotalInspected);
$totalInspected = $stmtTotalInspected->fetch(PDO::FETCH_ASSOC)['total_inspected'];


//----------------------------------------------------------------PURCHASE ORDER
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
function fetchpPurchaseOrders($conn) {
    try {
        $sql = "SELECT po.id, po.requestor, po.requisitioning_office, po.po_no, po.date, po.status, po.ppo_new, po.spo_new, GROUP_CONCAT(poi.description SEPARATOR ', ') AS item_descriptions 
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
$ppurchase_orders = fetchpPurchaseOrders($conn);

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
            $labels = $stmt_labels->fetchAll(PDO::FETCH_ASSOC); 
        }
    } catch (PDOException $e) {
  }
}
//----------------------------------------------------------------PENDING IAR   
function fetchpendingIARs($conn) {
    try {
        $stmt = $conn->prepare("
           SELECT iar.id, iar.iar_no, iar.po_no, iar.requestor, iar.req_office, iar.iar_date AS date, iar.insp_status, iar.ppiar_new, iar.spiar_new,
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

//-------------------------------------------------------------------------------------------- ALL IAR
function fetchallIARs($conn) {
    try {
        $stmt = $conn->prepare("SELECT iar.id, iar.iar_no, iar.po_no, iar.requestor, iar.req_office, iar.iar_date AS date, iar.property_custodian_status, iar.iaiar_new, iar.paiar_new, iar.saiar_new,  
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

//-----------------------------------------------------------------------------UACS CODE
try {
    $stmt = $conn->prepare("SELECT sub_object_code, uacs FROM uacs_codes");
    $stmt->execute();
    $uacsCodes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching UACS codes: " . $e->getMessage();
}

//-------------------------------------------------------------------------------GENERATE IAR NO
function generateIARNumber($conn) {
    try {
        $query = "SELECT COUNT(*) as total FROM inspection_acceptance_report";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['total'] + 1; 
        
        return $count; 
    } catch (PDOException $e) {
        error_log("Error generating IAR number: " . $e->getMessage());
        return false; 
    }
}

$iar_no = generateIARNumber($conn);

if (!$iar_no) {
    echo "Error generating IAR number.";
    exit;
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


//-------------------------------------------------------------------------------GENERATE IAR
$po_id = $_GET['po_id'] ?? null;
$poData = null;
$itemDetails = [];

if ($po_id) {
    try {
        $stmt = $conn->prepare("SELECT id, entity_name, requestor, requisitioning_office, supplier, po_no, fund_cluster, date FROM purchase_orders WHERE id = :po_id");
        $stmt->bindParam(':po_id', $po_id, PDO::PARAM_INT);
        $stmt->execute();
        $poData = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt_items = $conn->prepare("SELECT stock_no, description, unit, quantity FROM purchase_order_items WHERE po_id = :po_id");
        $stmt_items->bindParam(':po_id', $po_id, PDO::PARAM_INT);
        $stmt_items->execute();
        $itemDetails = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

        
    } catch (PDOException $e) {
        echo "Error fetching Purchase Order data: " . $e->getMessage();
    }
}

//----------------------------------------------------------------INSERT IAR FORM DATA IN THE DATABASE UPDATE AND GENERATE
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_iar'])) {
    try {
        $conn->beginTransaction();

        if (isset($iar_id) && !empty($iar_id)) {
            
            $inspStatus = trim($_POST['insp_status']); 
            $propertyCustodianStatus = ($inspStatus === 'partial') ? 'partial' : 'complete';
            
            $stmt = $conn->prepare("
                UPDATE inspection_acceptance_report 
                SET entity_name = :entity_name, fund_cluster = :fund_cluster, supplier = :supplier, 
                    iar_no = :iar_no, po_no = :po_no, iar_date = :iar_date, req_office = :req_office, 
                    invoice_no = :invoice_no, resp_code = :resp_code, invoice_date = :invoice_date,
                    date_received = :date_received,
                    head_procurement = :head_procurement, property_custodian_status = :property_custodian_status,
                    incomplete_details = :incomplete_details 
                WHERE id = :id
            ");
            
            $entityName = 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS'; 
            $fundCluster = trim($_POST['fund_cluster']);
            $supplier = trim($_POST['supplier']);
            $iarNo = trim($_POST['iar_no']);
            $poNo = trim($_POST['po_no']);
            $iarDate = trim($_POST['iar_date']);
            $reqOffice = trim($_POST['req_office']);
            $invoiceNo = trim($_POST['invoice_no']);
            $respCode = trim($_POST['resp_code']);
            $invoiceDate = trim($_POST['invoice_date']);
            $receivedDate = isset($_POST['date_received']) && !empty($_POST['date_received']) ? trim($_POST['date_received']) : null;
            $headProcurement = trim($_POST['head_procurement']);
            $propertyCustodianStatus = trim($_POST['property_custodian_status']);
            $incompleteDetails = trim($_POST['incomplete_details']);

            $iarDate = new DateTime($iarDate);
            $iarDate = $iarDate->format('Y-m-d');
    
            $invoiceDate = new DateTime($invoiceDate);
            $invoiceDate = $invoiceDate->format('Y-m-d');
    
            $receivedDate = new DateTime($receivedDate);
            $receivedDate = $receivedDate->format('Y-m-d');

            $stmt->execute([
                ':entity_name' => $entityName,
                ':fund_cluster' => $fundCluster,
                ':supplier' => $supplier,
                ':iar_no' => $iarNo,
                ':po_no' => $poNo,
                ':iar_date' => $iarDate,
                ':req_office' => $reqOffice,
                ':invoice_no' => $invoiceNo,
                ':resp_code' => $respCode,
                ':invoice_date' => $invoiceDate,
                ':date_received' => $receivedDate,
                ':head_procurement' => $headProcurement,
                ':property_custodian_status' => $propertyCustodianStatus,
                ':incomplete_details' => $incompleteDetails,
                ':id' => $iar_id
            ]);

            $iar_id = filter_var($iar_id, FILTER_SANITIZE_NUMBER_INT);
            $updated_by = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
            $updated_at = date('Y-m-d H:i:s'); 
            $name = filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); // Sanitize the name
            $account_type = filter_var($_SESSION['account_type'], FILTER_SANITIZE_STRING); // Sanitize the account type

            $insert_trail_stmt = $conn->prepare("INSERT INTO iar_update_trail (iar_id, updated_by, updated_at, name, account_type) VALUES (:iar_id, :updated_by, :updated_at, :name, :account_type)"); // Add account_type to the query
            $insert_trail_stmt->bindParam(':iar_id', $iar_id, PDO::PARAM_INT);
            $insert_trail_stmt->bindParam(':updated_by', $updated_by, PDO::PARAM_INT);
            $insert_trail_stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR); 
            $insert_trail_stmt->bindParam(':name', $name, PDO::PARAM_STR); // Bind the name parameter
            $insert_trail_stmt->bindParam(':account_type', $account_type, PDO::PARAM_STR); // Bind the account_type parameter
            $insert_trail_stmt->execute();
            
            $conn->commit();
            $_SESSION['success_message'] = "IAR successfully confirmed.";
            header("Location: ../pending_iar/");
            exit();

        } else {

        $insp_status = isset($_POST['inspection_verified']) ? 'complete' : (isset($_POST['items_incomplete']) ? 'partial' : null);
            if (!$insp_status) {
                throw new Exception("Please ensure all items have been inspected before submitting the form.");
            }
            $entityName = 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS'; 
            $fundCluster = trim($_POST['fund_cluster']);
            $supplier = trim($_POST['supplier']);
            $iarNo = trim($_POST['iar_no']);
            $poNo = trim($_POST['po_no']);
            $iarDate = trim($_POST['iar_date']);
            $requestor = trim($_POST['requestor']);
            $reqOffice = trim($_POST['req_office']);
            $invoiceNo = trim($_POST['invoice_no']);
            $respCode = trim($_POST['resp_code']);
            $invoiceDate = trim($_POST['invoice_date']);
            $inspectedDate = trim($_POST['date_inspected']);
            $inspectionOfficer = trim($_POST['inspection_officer']);
            $headProcurement = trim($_POST['head_procurement']);
            $dateReceived = isset($_POST['date_received']) && !empty($_POST['date_received']) 
            ? trim($_POST['date_received']) 
            : trim($_POST['date_inspected']);

            $stmt = $conn->prepare("
                INSERT INTO inspection_acceptance_report (entity_name, fund_cluster, supplier, iar_no, po_no, iar_date, requestor, req_office, invoice_no, resp_code, invoice_date, date_inspected, inspection_officer, date_received, head_procurement, insp_status, indiar_new, idiar_new, iaiar_new, ppiar_new, paiar_new, spiar_new, saiar_new)
                VALUES (:entity_name, :fund_cluster, :supplier, :iar_no, :po_no, :iar_date, :requestor, :req_office, :invoice_no, :resp_code, :invoice_date, :date_inspected, :inspection_officer, :date_received, :head_procurement, :insp_status, 1, 1, 1, 1, 1, 1, 1)
            ");

            $iarDate = new DateTime($iarDate);
            $iarDate = $iarDate->format('Y-m-d');
            $invoiceDate = new DateTime($invoiceDate);
            $invoiceDate = $invoiceDate->format('Y-m-d');
            $inspectedDate = new DateTime($inspectedDate);
            $inspectedDate = $inspectedDate->format('Y-m-d');

            if ($dateReceived) {
                $dateReceived = new DateTime($dateReceived);
                $dateReceived = $dateReceived->format('Y-m-d');
            }

            $stmt->execute([
                ':entity_name' => $entityName,
                ':fund_cluster' => $fundCluster,
                ':supplier' => $supplier,
                ':iar_no' => $iarNo,
                ':po_no' => $poNo,
                ':iar_date' => $iarDate,
                ':requestor' => $requestor,
                ':req_office' => $reqOffice,
                ':invoice_no' => $invoiceNo,
                ':resp_code' => $respCode,
                ':invoice_date' => $invoiceDate,
                ':date_inspected' => $inspectedDate,
                ':inspection_officer' => $inspectionOfficer,
                ':insp_status' => $insp_status,
                ':head_procurement' => $headProcurement,
                ':date_received' => $dateReceived 
            ]);
                $iar_id = $conn->lastInsertId();

                foreach ($_POST['stock_no'] as $index => $stock_no) {
                    $description = $_POST['description'][$index];
                    $unit = $_POST['unit'][$index];
                    $quantity = $_POST['quantity'][$index];
                    $is_complete = $_POST['is_complete'][$index];
                    $status = $_POST['status'][$index];
                    $original_description = $_POST['original_description'][$index]; 
                    $original_quantity = $_POST['original_quantity'][$index];
                    $remarks = isset($_POST['remarks'][$index]) ? $_POST['remarks'][$index] : null;
                
                    if (!empty($stock_no) && !empty($description) && !empty($unit) && !empty($quantity)) {
                        $stmt_check = $conn->prepare("SELECT id FROM iar_item_details WHERE iar_id = :iar_id AND stock_no = :stock_no");
                        $stmt_check->execute([
                            ':iar_id' => $iar_id,
                            ':stock_no' => $stock_no
                        ]);
                        $existing_item = $stmt_check->fetch(PDO::FETCH_ASSOC);
                
                        if ($existing_item) {
                            $stmt_update = $conn->prepare("
                                UPDATE iar_item_details 
                                SET description = :description, unit = :unit, quantity = :quantity, 
                                    is_complete = :is_complete, original_description = :original_description, 
                                    original_quantity = :original_quantity, status = :status, remarks = :remarks  
                                WHERE id = :id
                            ");
                            $stmt_update->execute([
                                ':description' => $description,
                                ':unit' => $unit,
                                ':quantity' => $quantity,
                                ':is_complete' => $is_complete,
                                ':original_description' => $original_description, 
                                ':original_quantity' => $original_quantity,
                                ':status' => $status,
                                ':remarks' => $remarks,
                                ':id' => $existing_item['id'] // Use the ID of the existing item
                            ]);
                        } else {
                            $stmt_items = $conn->prepare("
                                INSERT INTO iar_item_details (iar_id, stock_no, description, unit, quantity, is_complete, original_description, original_quantity, status, remarks, is_new) 
                                VALUES (:iar_id, :stock_no, :description, :unit, :quantity, :is_complete, :original_description, :original_quantity, :status, :remarks, 1)
                            ");
                            $stmt_items->execute([
                                ':iar_id' => $iar_id,
                                ':stock_no' => $stock_no,
                                ':description' => $description,
                                ':unit' => $unit,
                                ':quantity' => $quantity,
                                ':is_complete' => $is_complete,
                                ':original_description' => $original_description, 
                                ':original_quantity' => $original_quantity,
                                ':status' => $status,
                                ':remarks' => $remarks
                            ]);
                        }
                            $stmt_update_arrived = $conn->prepare("
                            UPDATE arrived_items 
                            SET item_status = 'ok' 
                            WHERE po_id = :po_id AND stock_no = :stock_no
                        ");
                        $stmt_update_arrived->execute([
                            ':po_id' => $po_id,
                            ':stock_no' => $stock_no
                        ]);
                    }
                }

                $labels = $_POST['labels'];
                $labelNos = $_POST['label_no'];

                if (!empty($labels)) {
                    for ($i = 0; $i < count($labels); $i++) {
                        $stmt = $conn->prepare("INSERT INTO iar_item_labels (iar_id, label_no, label_text) VALUES (:iar_id, :labelNo, :label)");
                        $stmt->bindParam(':iar_id', $iar_id); 
                        $stmt->bindParam(':labelNo', $labelNos[$i]); 
                        $stmt->bindParam(':label', $labels[$i]);
                        $stmt->execute();
                    }
                }

                if (isset($_POST['item_no']) && isset($_POST['item_specification'])) {
                    foreach ($_POST['item_no'] as $index => $item_no) {
                        $item_specification = $_POST['item_specification'][$index];
                
                        if (!empty($item_no) && !empty($item_specification)) {
                            $stmt_specs = $conn->prepare("
                                INSERT INTO iar_item_specifications (iar_id, item_no, item_specification) 
                                VALUES (:iar_id, :item_no, :item_specification)
                            ");
                            $stmt_specs->execute([
                                ':iar_id' => $iar_id,
                                ':item_no' => $item_no,
                                ':item_specification' => $item_specification
                            ]);
                        }
                    }
                }
                
                $iar_id = filter_var($iar_id, FILTER_SANITIZE_NUMBER_INT);
                $created_by = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
                $created_at = date('Y-m-d H:i:s'); 
                $name = filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); // Sanitize the name
                $account_type = filter_var($_SESSION['account_type'], FILTER_SANITIZE_STRING); // Sanitize the account type

                $insert_trail_stmt = $conn->prepare("INSERT INTO iar_creation_trail (iar_id, created_by, created_at, name, account_type) VALUES (:iar_id, :created_by, :created_at, :name, :account_type)"); // Add account_type to the query
                $insert_trail_stmt->bindParam(':iar_id', $iar_id, PDO::PARAM_INT);
                $insert_trail_stmt->bindParam(':created_by', $created_by, PDO::PARAM_INT);
                $insert_trail_stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR); 
                $insert_trail_stmt->bindParam(':name', $name, PDO::PARAM_STR); // Bind the name parameter
                $insert_trail_stmt->bindParam(':account_type', $account_type, PDO::PARAM_STR); // Bind the account_type parameter
                $insert_trail_stmt->execute();

                $conn->commit();
                $_SESSION['success_message'] = "IAR successfully created.";
                header("Location: ../purchase_order/");
                exit();
            }
    
        } catch (Exception $e) {
            $conn->rollBack();
            $_SESSION['error_message'] = "" . $e->getMessage();
        }
    }

//------------------------------------------------GENERATE COMPLETE IAR THAT CALCULATES THE QUANTITY FROM THE PARTIIAL IAR'S
$po_id = $_GET['po_id'] ?? null;
if ($po_id) {
    $stmtPO = $conn->prepare("SELECT po_no FROM purchase_orders WHERE id = ?");
    $stmtPO->execute([$po_id]);
    $purchaseOrder_2 = $stmtPO->fetch(PDO::FETCH_ASSOC);

    if ($purchaseOrder_2) {
        $po_no = $purchaseOrder_2['po_no'];

        $stmtIARs = $conn->prepare("SELECT * FROM inspection_acceptance_report WHERE SUBSTRING_INDEX(po_no, ' | ', 1) = ? AND insp_status = 'partial'");
        $stmtIARs->execute([$po_no]);
        $partialIARs_2 = $stmtIARs->fetchAll(PDO::FETCH_ASSOC);

        $totalReceived = [];
        $iarItemsList = []; 

        foreach ($partialIARs_2 as $iar) {
            $stmtItems = $conn->prepare("SELECT * FROM iar_item_details WHERE iar_id = ?");
            $stmtItems->execute([$iar['id']]);
            $iarItems_2 = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
            
            $iarItemsList[$iar['iar_no']] = $iarItems_2;

            foreach ($iarItems_2 as $item) {
                $key = $item['description']; 
                if (!isset($totalReceived[$key])) {
                    $totalReceived[$key] = 0;
                }
                $totalReceived[$key] += $item['quantity']; 
            }
        }

        function toReceivedQuantity($conn, $po_id, $stock_no) {
            $stmt = $conn->prepare("
                SELECT COALESCE(SUM(quantity), 0) AS total_received 
                FROM arrived_items 
                WHERE po_id = ? AND stock_no = ? AND item_status = 'not'
            ");
            $stmt->execute([$po_id, $stock_no]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            return $result['total_received'] ?? 0;
        }
        
        
        $stmtPOItems = $conn->prepare("
                SELECT poi.*, 
                    COALESCE(SUM(ai.quantity), 0) AS received_quantity,
                    MAX(ai.status) AS arrived_status, 
                    CASE 
                        WHEN MAX(ai.status) = 'Inspected' THEN 1 
                        ELSE 0 
                    END AS is_inspectable
                FROM purchase_order_items poi
                LEFT JOIN arrived_items ai 
                    ON poi.po_id = ai.po_id 
                    AND poi.stock_no = ai.stock_no
                    AND ai.item_status = 'not'  
                WHERE poi.po_id = ?
                GROUP BY poi.id
            ");
            $stmtPOItems->execute([$po_id]);
            $poItems_2 = $stmtPOItems->fetchAll(PDO::FETCH_ASSOC);

            $remainingItems_2 = [];
            $receivedItems_2 = []; 

            foreach ($poItems_2 as $poItem) {
                $receivedQuantity_2 = isset($totalReceived[$poItem['description']]) ? $totalReceived[$poItem['description']] : 0;
                $arrivedQuantity = toReceivedQuantity($conn, $po_id, $poItem['stock_no']);
                $poItem['is_inspectable'] = (bool) $poItem['is_inspectable']; 

                $receivedItems_2[] = [
                    'stock_no' => $poItem['stock_no'],
                    'description' => $poItem['description'],
                    'unit' => $poItem['unit'],
                    'arrived_quantity' => $arrivedQuantity, 
                    'arrived_status' => $poItem['arrived_status'],
                    'is_inspectable' => $poItem['is_inspectable']
                ];

                if ($receivedQuantity_2 < $poItem['quantity']) {
                    $remainingItems_2[] = [
                        'stock_no' => $poItem['stock_no'],
                        'description' => $poItem['description'],
                        'unit' => $poItem['unit'],
                        'arrived_quantity' => $arrivedQuantity,
                        'quantity' => $poItem['quantity'] - $receivedQuantity_2, 
                        'arrived_status' => $poItem['arrived_status'],
                        'is_inspectable' => $poItem['is_inspectable']
                    ];
                }
            }

        $stmtLabels = $conn->prepare("SELECT * FROM purchase_order_labels WHERE po_id = ? ORDER BY label_order");
        $stmtLabels->execute([$po_id]);
        $labels = $stmtLabels->fetchAll(PDO::FETCH_ASSOC);

        $labelsByNo = [];
        foreach ($labels as $label) {
            $labelsByNo[$label['label_no']][] = $label['label_text'];
        }
    
    }
}  

//-----------------------------------------------------------------VIEW PO
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

//-----------------------------------------------------------------------------------------INSP GENERATE IAR
$po_id = $_GET['po_id'] ?? null;
if ($po_id) {
    $stmtPO = $conn->prepare("SELECT po_no FROM purchase_orders WHERE id = ?");
    $stmtPO->execute([$po_id]);
    $purchaseOrder_1 = $stmtPO->fetch(PDO::FETCH_ASSOC);

    if ($purchaseOrder_1) {
        $po_no = $purchaseOrder_1['po_no'];

        $stmtIARs = $conn->prepare("SELECT * FROM inspection_acceptance_report WHERE SUBSTRING_INDEX(po_no, ' | ', 1) = ? AND insp_status = 'partial'");
        $stmtIARs->execute([$po_no]);
        $partialIARs_1 = $stmtIARs->fetchAll(PDO::FETCH_ASSOC);

        $totalReceived = [];
        $iarItemsList = []; 

        foreach ($partialIARs_1 as $iar) {
            $stmtItems = $conn->prepare("SELECT * FROM iar_item_details WHERE iar_id = ?");
            $stmtItems->execute([$iar['id']]);
            $iarItems_1 = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
            
            $iarItemsList[$iar['iar_no']] = $iarItems_1;

            foreach ($iarItems_1 as $item) {
                $key = $item['description']; 
                if (!isset($totalReceived[$key])) {
                    $totalReceived[$key] = 0;
                }
                $totalReceived[$key] += $item['quantity']; 
            }
        }

        $stmtPOItems = $conn->prepare("
            SELECT 
                poi.id,
                poi.po_id,
                poi.stock_no,
                poi.unit,
                poi.description,
                poi.quantity,  -- The original quantity from purchase_order_items
                COALESCE(SUM(ai.quantity), 0) AS received_quantity, -- Total received quantity
                CASE 
                    WHEN MAX(ai.description) IS NOT NULL THEN 1  
                    ELSE 0 
                END AS is_arrived
            FROM purchase_order_items poi
            LEFT JOIN arrived_items ai 
                ON poi.po_id = ai.po_id 
                AND poi.stock_no = ai.stock_no  
                AND ai.item_status = 'not' -- Ensure we're filtering only relevant received items
                AND ai.status = 'Inspected'
            WHERE poi.po_id = ?
            GROUP BY poi.id, poi.po_id, poi.stock_no, poi.unit, poi.description, poi.quantity
        ");
        $stmtPOItems->execute([$po_id]);
        $poItems_1 = $stmtPOItems->fetchAll(PDO::FETCH_ASSOC);


        $remainingItems_1 = [];
        foreach ($poItems_1 as $poItem) {
            $receivedQuantity_1 = isset($poItem['received_quantity']) ? $poItem['received_quantity'] : 0; // Avoid undefined key
            $poItem['is_arrived'] = (bool) ($poItem['is_arrived'] ?? 0); // Ensure boolean value

            $remainingItems_1[] = [
                'stock_no' => $poItem['stock_no'],
                'description' => $poItem['description'],
                'unit' => $poItem['unit'],
                'quantity' => $poItem['quantity'], // Keep the original quantity
                'received_quantity' => $receivedQuantity_1, // Display received quantity separately
                'is_arrived' => $poItem['is_arrived']
            ];
        }
             
                $stmtLabels = $conn->prepare("SELECT * FROM purchase_order_labels WHERE po_id = ? ORDER BY label_order");
                $stmtLabels->execute([$po_id]);
                $labels = $stmtLabels->fetchAll(PDO::FETCH_ASSOC);

                $labelsByNo = [];
                foreach ($labels as $label) {
                    $labelsByNo[$label['label_no']][] = $label['label_text'];
                }
            
            }
        }

//-----------------------------------------------------------------------------------------VIEW TO REMOVE PULSE
////////////////////////////////////////INSPECTOR SIDE 
if (isset($_GET['id']) && isset($_GET['update_ipo'])) {
    try {
        $updateIpoStmt = $conn->prepare("UPDATE purchase_orders SET ipo_new = 0 WHERE id = :id");
        $updateIpoStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updateIpoStmt->execute();

        if ($updateIpoStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['id']) && isset($_GET['update_indiar'])) {
    try {
        $updateIndiarStmt = $conn->prepare("UPDATE inspection_acceptance_report SET indiar_new = 0 WHERE id = :id");
        $updateIndiarStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updateIndiarStmt->execute();

        if ($updateIndiarStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['id']) && isset($_GET['update_idiar'])) {
    try {
        $updateIdiarStmt = $conn->prepare("UPDATE inspection_acceptance_report SET idiar_new = 0 WHERE id = :id");
        $updateIdiarStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updateIdiarStmt->execute();

        if ($updateIdiarStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['id']) && isset($_GET['update_iaiar'])) {
    try {
        $updateIaiarStmt = $conn->prepare("UPDATE inspection_acceptance_report SET iaiar_new = 0 WHERE id = :id");
        $updateIaiarStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updateIaiarStmt->execute();

        if ($updateIaiarStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//////////////////////////////////////// PROPERTY CUSTODIAN SIDE 
if (isset($_GET['id']) && isset($_GET['update_ppo'])) {
    try {
        $updatePpoStmt = $conn->prepare("UPDATE purchase_orders SET ppo_new = 0 WHERE id = :id");
        $updatePpoStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updatePpoStmt->execute();

        if ($updatePpoStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['id']) && isset($_GET['update_ppiar'])) {
    try {
        $updatePpiarStmt = $conn->prepare("UPDATE inspection_acceptance_report SET ppiar_new = 0 WHERE id = :id");
        $updatePpiarStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updatePpiarStmt->execute();

        if ($updatePpiarStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['id']) && isset($_GET['update_paiar'])) {
    try {
        $updatePaiarStmt = $conn->prepare("UPDATE inspection_acceptance_report SET paiar_new = 0 WHERE id = :id");
        $updatePaiarStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updatePaiarStmt->execute();

        if ($updatePaiarStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

////////////////////////////////////////SUPPLY OFFICE STAFF
if (isset($_GET['id']) && isset($_GET['update_spo'])) {
    try {
        $updateSpoStmt = $conn->prepare("UPDATE purchase_orders SET spo_new = 0 WHERE id = :id");
        $updateSpoStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updateSpoStmt->execute();

        if ($updateSpoStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['id']) && isset($_GET['update_spiar'])) {
    try {
        $updateSpiarStmt = $conn->prepare("UPDATE inspection_acceptance_report SET spiar_new = 0 WHERE id = :id");
        $updateSpiarStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updateSpiarStmt->execute();

        if ($updateSpiarStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['id']) && isset($_GET['update_saiar'])) {
    try {
        $updateSaiarStmt = $conn->prepare("UPDATE inspection_acceptance_report SET saiar_new = 0 WHERE id = :id");
        $updateSaiarStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $updateSaiarStmt->execute();

        if ($updateSaiarStmt->rowCount() > 0) {
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
//--------------------------------------PO NOTIF
if (isset($_GET['notification_id'])) {
    $notification_id = $_GET['notification_id'];

    $sql = "UPDATE notifications SET is_read = 1 WHERE notification_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$notification_id]);
}

//--------------------------------------IAR NOTIF
if (isset($_GET['iar_notification_id'])) {
    $iar_notification_id = $_GET['iar_notification_id'];

    $sql = "UPDATE iar_notifications SET is_read = 1 WHERE iar_notification_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$iar_notification_id]);
}

//--------------------------------------PO NOTIF SUPPLY OFFICE STAFF
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_edit'])) {
    try {
        // Get data from the form
        $iar_id = $_POST['iar_id']; 

            $stmt = $conn->prepare("
                UPDATE iar_item_details
                SET description = :description, unit = :unit, quantity = :quantity, status = :status, remarks = :remarks
                WHERE stock_no = :stock_no
            ");
            $stmt->bindParam(':description', $item['description']);
            $stmt->bindParam(':unit', $item['unit']);
            $stmt->bindParam(':quantity', $item['quantity']);
            $stmt->bindParam(':status', $item['status']);
            $stmt->bindParam(':remarks', $item['remarks']);  
            $stmt->bindParam(':stock_no', $stock_no);
            $stmt->execute();

        $stmt_update = $conn->prepare("
            UPDATE inspection_acceptance_report
            SET 
                resp_code = :resp_code,
                iar_date = :iar_date,
                invoice_no = :invoice_no,
                invoice_date = :invoice_date
            WHERE id = :id
        ");
        $stmt_update->bindParam(':resp_code', $_POST['resp_code'], PDO::PARAM_STR);
        $stmt_update->bindParam(':iar_date', $_POST['iar_date'], PDO::PARAM_STR);
        $stmt_update->bindParam(':invoice_no', $_POST['invoice_no'], PDO::PARAM_STR);
        $stmt_update->bindParam(':invoice_date', $_POST['invoice_date'], PDO::PARAM_STR);
        $stmt_update->bindParam(':id', $iar_id, PDO::PARAM_INT);
        $stmt_update->execute();

        $_SESSION['success_message'] = "IAR successfully updated.";

        header('Location: ../pending_iar/');
        exit; 

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//-----------DELIVERED ITEMS SUPPLY OFFICE STAFF
function getArrivedItems($conn) {
    try {
        $query = "SELECT * FROM arrived_items ORDER BY delivery_date DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return []; 
    }
}
$arrivedItems = getArrivedItems($conn);

?>

