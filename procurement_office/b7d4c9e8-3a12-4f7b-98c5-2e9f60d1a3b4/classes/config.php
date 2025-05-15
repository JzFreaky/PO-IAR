<?php
session_start();
date_default_timezone_set('Asia/Manila');
//////////////////////////////////////// P.O CONFIG
include '../../database/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

//---------------------------DISPLAYING THE IN DASHBOARD, PO DATA APPROVED AND PENDING 
function getPOCounts($conn) {
    $pendingQuery = "SELECT COUNT(*) as pending_count FROM purchase_orders WHERE status = 'Pending'";
    $stmtPending = $conn->prepare($pendingQuery);
    $stmtPending->execute();
    $pendingResult = $stmtPending->fetch(PDO::FETCH_ASSOC);
    $pendingPO = $pendingResult['pending_count'];

    $approvedQuery = "SELECT COUNT(*) as approved_count FROM purchase_orders WHERE status IN ('Approved', 'Complete', 'Incomplete')";
    $stmtApproved = $conn->prepare($approvedQuery);
    $stmtApproved->execute();
    $approvedResult = $stmtApproved->fetch(PDO::FETCH_ASSOC);
    $approvedPO = $approvedResult['approved_count'];

    $canceledQuery = "SELECT COUNT(*) as canceled_count FROM purchase_orders WHERE status = 'canceled'";
    $stmtCanceled = $conn->prepare($canceledQuery);
    $stmtCanceled->execute();
    $canceledResult = $stmtCanceled->fetch(PDO::FETCH_ASSOC);
    $canceledPO = $canceledResult['canceled_count'];

    $allQuery = "SELECT COUNT(*) as all_count FROM purchase_orders WHERE status  IN ('Approved', 'Complete', 'Incomplete', 'approved', 'canceled', 'pending')";
    $stmtall = $conn->prepare($allQuery);
    $stmtall->execute();
    $allResult = $stmtall->fetch(PDO::FETCH_ASSOC);
    $allPO = $allResult['all_count'];

    return [$pendingPO, $approvedPO, $canceledPO, $allPO]; 
}
list($pendingPO, $approvedPO, $canceledPO, $allPO) = getPOCounts($conn);

//---------------------------DISPLAYING THE DATA APPROVED AND PENDING STATUS
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

//------------------------------------------------CHECK IF WE ARE UPDATING OR CREATING A P.O
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['po_form'])) {
    if ($po_id) {
        try {
            $conn->beginTransaction();

            if (isset($_POST['requestor']) && is_array($_POST['requestor'])) {
                $requestors = $_POST['requestor'];
            } else {
                $requestors = [];
            }
        
            $cleanedRequestors = array_filter($requestors, function($item) {
                return !empty($item) && trim($item) !== 'null';
            });
        
            $finalRequestors = implode('/', $cleanedRequestors);
        
            $finalRequestors = array_filter(explode('/', $finalRequestors), function($item) {
                return !empty($item) && trim($item) !== 'null';
            });
            $finalRequestors = implode('/', $finalRequestors);
            
            $supplier = strtoupper($_POST['supplier']);
            $signature_accountant = strtoupper($_POST['signature_accountant']);

            $Date = new DateTime($_POST['date']);
            $Date = $Date->format('Y-m-d');

            $deliveryDate = new DateTime($_POST['date_delivery']);
            $deliveryDate = $deliveryDate->format('Y-m-d');

            $ors_burs_Date = new DateTime($_POST['ors_burs_date']);
            $ors_burs_Date = $ors_burs_Date->format('Y-m-d');

            $supplier_Date = new DateTime($_POST['supplier_date']);
            $supplier_Date = $supplier_Date->format('Y-m-d');

            // Prepare to update the purchase order
            $stmt = $conn->prepare("
                UPDATE purchase_orders SET
                    requestor = :requestor,
                    supplier = :supplier,
                    po_no = :po_no,
                    address = :address,
                    date = :date,
                    tin = :tin,
                    mode_procurement = :mode_procurement,
                    place_delivery = :place_delivery,
                    delivery_term = :delivery_term,
                    date_delivery = :date_delivery,
                    payment_term = :payment_term,
                    total_amount_words = :total_amount_words,
                    signature_supplier = :signature_supplier,
                    signature_official = :signature_official,
                    supplier_date = :supplier_date,
                    designation = :designation,
                    fund_cluster = :fund_cluster,
                    ors_burs_no = :ors_burs_no,
                    ors_burs_date = :ors_burs_date,
                    funds_available = :funds_available,
                    ors_burs_amount = :ors_burs_amount,
                    signature_accountant = :signature_accountant,
                    requisitioning_office = :requisitioning_office
                WHERE id = :id
            ");

            $stmt->execute([
                ':requestor' => $finalRequestors, 
                ':supplier' => $supplier,
                ':po_no' => $_POST['po_no'],
                ':address' => $_POST['address'],
                ':date' => $Date,
                ':tin' => $_POST['tin'],
                ':mode_procurement' => $_POST['mode_procurement'],
                ':place_delivery' => $_POST['place_delivery'],
                ':delivery_term' => $_POST['delivery_term'],
                ':date_delivery' => $deliveryDate,
                ':payment_term' => $_POST['payment_term'],
                ':total_amount_words' => $_POST['total_amount_words'],
                ':signature_supplier' => $_POST['signature_supplier'],
                ':signature_official' => $_POST['signature_official'],
                ':supplier_date' => $supplier_Date,
                ':designation' => $_POST['designation'],
                ':fund_cluster' => $_POST['fund_cluster'],
                ':ors_burs_no' => $_POST['ors_burs_no'],
                ':ors_burs_date' => $ors_burs_Date,
                ':funds_available' => $_POST['funds_available'],
                ':ors_burs_amount' => $_POST['ors_burs_amount'],
                ':signature_accountant' => $signature_accountant,
                ':requisitioning_office' => $_POST['requisitioning_office'],
                ':id' => $po_id
            ]);

            $conn->commit();

            $sql_item_insert = "INSERT INTO purchase_order_items (po_id, stock_no, unit, description, quantity, unit_cost, amount) 
                                VALUES (:po_id, :stock_no, :unit, :description, :quantity, :unit_cost, :amount)";

            $sql_item_update = "UPDATE purchase_order_items SET 
                                unit = :unit, 
                                description = :description, 
                                quantity = :quantity, 
                                unit_cost = :unit_cost, 
                                amount = :amount 
                                WHERE po_id = :po_id AND stock_no = :stock_no";

            $stmt_item_insert = $conn->prepare($sql_item_insert);
            $stmt_item_update = $conn->prepare($sql_item_update);

            if (isset($_POST['item_details'])) {
                foreach ($_POST['item_details']['stock_no'] as $key => $value) {
                    $stockNo = $_POST['item_details']['stock_no'][$key];
                    $unit = $_POST['item_details']['unit'][$key];
                    $description = $_POST['item_details']['description'][$key];
                    $quantity = $_POST['item_details']['quantity'][$key];
                    $unitCost = $_POST['item_details']['unit_cost'][$key];
                    $amount = $_POST['item_details']['amount'][$key];

                    if (!empty($stockNo) && !empty($unit) && !empty($description) && !empty($quantity) && !empty($unitCost) && !empty($amount)) {
                        // Check if the item already exists
                        $check_item_sql = "SELECT COUNT(*) FROM purchase_order_items WHERE po_id = :po_id AND stock_no = :stock_no";
                        $stmt_check_item = $conn->prepare($check_item_sql);
                        $stmt_check_item->execute([':po_id' => $po_id, ':stock_no' => $stockNo]);

                        if ($stmt_check_item->fetchColumn() > 0) {
                            $stmt_item_update->execute([
                                ':po_id' => $po_id,
                                ':stock_no' => $stockNo,
                                ':unit' => $unit,
                                ':description' => $description,
                                ':quantity' => $quantity,
                                ':unit_cost' => $unitCost,
                                ':amount' => $amount
                            ]);
                        } else {
                            $stmt_item_insert->execute([
                                ':po_id' => $po_id,
                                ':stock_no' => $stockNo,
                                ':unit' => $unit,
                                ':description' => $description,
                                ':quantity' => $quantity,
                                ':unit_cost' => $unitCost,
                                ':amount' => $amount
                            ]);
                        }
                    }
                }
            }

            if (isset($_POST['label_no']) && isset($_POST['label_text'])) {
                $labelNos = $_POST['label_no'];
                $labelTexts = $_POST['label_text'];
                $poId = $po_id; 
            
                foreach ($labelNos as $index => $labelNo) {
                    $labelText = $labelTexts[$index];
            
                    $sql = "INSERT INTO purchase_order_labels (po_id, label_no, label_text) 
                            VALUES (:po_id, :label_no, :label_text)";
                    $stmt = $conn->prepare($sql);
            
                    $stmt->bindParam(':po_id', $poId, PDO::PARAM_INT);
                    $stmt->bindParam(':label_no', $labelNo, PDO::PARAM_INT);
                    $stmt->bindParam(':label_text', $labelText, PDO::PARAM_STR);
            
                    try {
                        $stmt->execute();
                    } catch (PDOException $e) {
                    }
                }
            }
            
            if (isset($_POST['edited_label_text']) && isset($_POST['edited_label_no'])) {
                foreach ($_POST['edited_label_text'] as $key => $editedLabel) {
                    $labelNo = $_POST['edited_label_no'][$key];
            
                    if (!empty($editedLabel)) {
                        $sql = "
                            UPDATE purchase_order_labels 
                            SET label_text = CASE 
                                WHEN label_no = :label_no THEN :label_text 
                                ELSE label_text 
                            END
                            WHERE po_id = :po_id AND label_no = :label_no;
                        ";
            
                        $stmt = $conn->prepare($sql);
            
                        $stmt->bindParam(':po_id', $poId, PDO::PARAM_INT);
                        $stmt->bindParam(':label_no', $labelNo, PDO::PARAM_INT);
                        $stmt->bindParam(':label_text', $editedLabel, PDO::PARAM_STR);
            
                        try {
                            $stmt->execute();
        
                            echo "Label updated successfully!";
                        } catch (PDOException $e) {
                            echo "Error updating label: " . $e->getMessage();
                        }
                    }
                }
            }

            if (isset($_POST['item_details']['item_specification'])) {
                $itemSpecifications = $_POST['item_details']['item_specification'];
                $itemNumbers = $_POST['item_details']['item_no']; // Assuming you have item numbers
        
                // Loop through each item specification and insert into the table
                for ($i = 0; $i < count($itemSpecifications); $i++) {
                    $itemSpecification = trim($itemSpecifications[$i]); // Trim whitespace for safety
                    $itemNumber = $itemNumbers[$i];
        
                    if (!empty($itemSpecification)) { // Only insert if the specification is not empty
                        $sql_spec = "INSERT INTO po_item_specifications (po_id, item_no, item_specification) 
                                     VALUES (:po_id, :item_no, :item_specification)";
                        $stmt_spec = $conn->prepare($sql_spec);
                        $stmt_spec->bindParam(':po_id', $po_id);
                        $stmt_spec->bindParam(':item_no', $itemNumber);
                        $stmt_spec->bindParam(':item_specification', $itemSpecification);
                        $stmt_spec->execute();
                    }
                }
            }

            $po_id = filter_var($po_id, FILTER_SANITIZE_NUMBER_INT);
            $updated_by = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
            $updated_at = date('Y-m-d H:i:s'); 
            $name = filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); // Sanitize the name
            $account_type = filter_var($_SESSION['account_type'], FILTER_SANITIZE_STRING); // Sanitize the account type

            $insert_trail_stmt = $conn->prepare("INSERT INTO po_update_trail (po_id, updated_by, updated_at, name, account_type) VALUES (:po_id, :updated_by, :updated_at, :name, :account_type)"); // Add account_type to the query
            $insert_trail_stmt->bindParam(':po_id', $po_id, PDO::PARAM_INT);
            $insert_trail_stmt->bindParam(':updated_by', $updated_by, PDO::PARAM_INT);
            $insert_trail_stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR); 
            $insert_trail_stmt->bindParam(':name', $name, PDO::PARAM_STR); // Bind the name parameter
            $insert_trail_stmt->bindParam(':account_type', $account_type, PDO::PARAM_STR); // Bind the account_type parameter
            $insert_trail_stmt->execute();

            $_SESSION['success_message'] = "Purchase order successfully updated";
            header("Location: ../purchase_order/");
            exit();

        } catch (Exception $e) {
            $conn->rollBack();
            echo "Failed to update purchase order: " . $e->getMessage();
        }
    
    } else {
        try {
            if (isset($_POST['requestor']) && is_array($_POST['requestor'])) {
                $requestors = $_POST['requestor'];
            } else {
                $requestors = [];
            }
        
            $cleanedRequestors = array_filter($requestors, function($item) {
                return !empty($item) && trim($item) !== 'null';
            });
        
            $finalRequestors = implode('/', $cleanedRequestors);
        
            $finalRequestors = array_filter(explode('/', $finalRequestors), function($item) {
                return !empty($item) && trim($item) !== 'null';
            });
            $finalRequestors = implode('/', $finalRequestors);
            
            $sql = "INSERT INTO purchase_orders (entity_name, requestor, supplier, po_no, address, date, tin, mode_procurement, place_delivery, delivery_term, date_delivery, payment_term, total_amount_words, signature_supplier, signature_official, supplier_date, designation, fund_cluster, ors_burs_no, ors_burs_date, funds_available, ors_burs_amount, signature_accountant, requisitioning_office, ipo_new, ppo_new, spo_new, status)
                    VALUES (:entity_name, :requestor, :supplier, :po_no, :address, :date, :tin, :mode_procurement, :place_delivery, :delivery_term, :date_delivery, :payment_term, :total_amount_words, :signature_supplier, :signature_official, :supplier_date, :designation, :fund_cluster, :ors_burs_no, :ors_burs_date, :funds_available, :ors_burs_amount, :signature_accountant, :requisitioning_office, 1, 1, 1, 'pending')";
            
            $supplier = strtoupper($_POST['supplier']);

            $Date = new DateTime($_POST['date']);
            $Date = $Date->format('Y-m-d');

            $deliveryDate = empty($_POST['date_delivery']) ? null : (new DateTime($_POST['date_delivery']))->format('Y-m-d');
            $ors_burs_Date = empty($_POST['ors_burs_date']) ? null : (new DateTime($_POST['ors_burs_date']))->format('Y-m-d');
            $supplier_Date = empty($_POST['supplier_date']) ? null : (new DateTime($_POST['supplier_date']))->format('Y-m-d');
            $ors_burs_amount = empty($_POST['ors_burs_amount']) ? null : $_POST['ors_burs_amount'];

            $entityName = 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS';

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':entity_name', $entityName);
            $stmt->bindParam(':requestor', $finalRequestors);
            $stmt->bindParam(':supplier', $supplier);
            $stmt->bindParam(':po_no', $_POST['po_no']);
            $stmt->bindParam(':address', $_POST['address']);
            $stmt->bindParam(':date', $Date);
            $stmt->bindParam(':tin', $_POST['tin']);
            $stmt->bindParam(':mode_procurement', $_POST['mode_procurement']);
            $stmt->bindParam(':place_delivery', $_POST['place_delivery']);
            $stmt->bindParam(':delivery_term', $_POST['delivery_term']);
            $stmt->bindParam(':date_delivery', $deliveryDate, $deliveryDate ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $stmt->bindParam(':payment_term', $_POST['payment_term']);
            $stmt->bindParam(':total_amount_words', $_POST['total_amount_words']);
            $stmt->bindParam(':signature_supplier', $_POST['signature_supplier']);
            $stmt->bindParam(':signature_official', $_POST['signature_official']);
            $stmt->bindParam(':supplier_date', $supplier_Date, $supplier_Date ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $stmt->bindParam(':designation', $_POST['designation']);
            $stmt->bindParam(':fund_cluster', $_POST['fund_cluster']);
            $stmt->bindParam(':ors_burs_no', $_POST['ors_burs_no']);
            $stmt->bindParam(':ors_burs_date', $ors_burs_Date, $ors_burs_Date ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $stmt->bindParam(':funds_available', $_POST['funds_available']);
            $stmt->bindParam(':ors_burs_amount', $ors_burs_amount, $ors_burs_amount === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':signature_accountant', $_POST['signature_accountant']);
            $stmt->bindParam(':requisitioning_office', $_POST['requisitioning_office']);
            $stmt->execute();

            $po_id = $conn->lastInsertId();

            $sql_item = "INSERT INTO purchase_order_items (po_id, stock_no, unit, description, quantity, unit_cost, amount) 
            VALUES (:po_id, :stock_no, :unit, :description, :quantity, :unit_cost, :amount)";
                $stmt_item = $conn->prepare($sql_item);

                if (isset($_POST['item_details'])) {
                    foreach ($_POST['item_details']['stock_no'] as $key => $value) {
                        $stockNo = $_POST['item_details']['stock_no'][$key];
                        $unit = $_POST['item_details']['unit'][$key];
                        $description = $_POST['item_details']['description'][$key];
                        $quantity = $_POST['item_details']['quantity'][$key];
                        $unitCost = $_POST['item_details']['unit_cost'][$key];
                        $amount = $_POST['item_details']['amount'][$key];
                
                        if (!empty($stockNo) && !empty($unit) && !empty($description) && !empty($quantity) && !empty($unitCost) && !empty($amount)) {
                            $stmt_item->bindParam(':po_id', $po_id);
                            $stmt_item->bindParam(':stock_no', $stockNo);
                            $stmt_item->bindParam(':unit', $unit);
                            $stmt_item->bindParam(':description', $description);
                            $stmt_item->bindParam(':quantity', $quantity);
                            $stmt_item->bindParam(':unit_cost', $unitCost);
                            $stmt_item->bindParam(':amount', $amount);
                            $stmt_item->execute();
                        }
                    }
                }
                if (isset($_POST['label_text']) && isset($_POST['label_no'])) {
                    foreach ($_POST['label_text'] as $key => $labelText) {
                        $labelNo = $_POST['label_no'][$key];

                        if (!empty($labelText)) {
                            $sql_label = "INSERT INTO purchase_order_labels (po_id, label_no, label_text) 
                                          VALUES (:po_id, :label_no, :label_text)";
                            $stmt_label = $conn->prepare($sql_label);
                            $stmt_label->bindParam(':po_id', $po_id);
                            $stmt_label->bindParam(':label_no', $labelNo);
                            $stmt_label->bindParam(':label_text', $labelText);
                            $stmt_label->execute();
                        }
                    }
                }

                if (isset($_POST['item_details']['item_specification'])) {
                    $itemSpecifications = $_POST['item_details']['item_specification'];
                    $itemNumbers = $_POST['item_details']['item_no']; // Assuming you have item numbers
            
                    // Loop through each item specification and insert into the table
                    for ($i = 0; $i < count($itemSpecifications); $i++) {
                        $itemSpecification = trim($itemSpecifications[$i]); // Trim whitespace for safety
                        $itemNumber = $itemNumbers[$i];
            
                        if (!empty($itemSpecification)) { // Only insert if the specification is not empty
                            $sql_spec = "INSERT INTO po_item_specifications (po_id, item_no, item_specification) 
                                         VALUES (:po_id, :item_no, :item_specification)";
                            $stmt_spec = $conn->prepare($sql_spec);
                            $stmt_spec->bindParam(':po_id', $po_id);
                            $stmt_spec->bindParam(':item_no', $itemNumber);
                            $stmt_spec->bindParam(':item_specification', $itemSpecification);
                            $stmt_spec->execute();
                        }
                    }
                }

                $po_id = filter_var($po_id, FILTER_SANITIZE_NUMBER_INT);
                $created_by = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
                $created_at = date('Y-m-d H:i:s'); 
                $name = filter_var($_SESSION['name'], FILTER_SANITIZE_STRING); // Sanitize the name
                $account_type = filter_var($_SESSION['account_type'], FILTER_SANITIZE_STRING); // Sanitize the account type

                $insert_trail_stmt = $conn->prepare("INSERT INTO po_creation_trail (po_id, created_by, created_at, name, account_type) VALUES (:po_id, :created_by, :created_at, :name, :account_type)"); // Add account_type to the query
                $insert_trail_stmt->bindParam(':po_id', $po_id, PDO::PARAM_INT);
                $insert_trail_stmt->bindParam(':created_by', $created_by, PDO::PARAM_INT);
                $insert_trail_stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR); 
                $insert_trail_stmt->bindParam(':name', $name, PDO::PARAM_STR); // Bind the name parameter
                $insert_trail_stmt->bindParam(':account_type', $account_type, PDO::PARAM_STR); // Bind the account_type parameter
                $insert_trail_stmt->execute();


            $_SESSION['success_message'] = "Purchase order successfully created";
            header("Location: ../purchase_order/");
            exit();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

//-----------------------------------------------APPROVING THE PURCHASE ORDER
function approve_purchase_order($conn, $po_id) {
    try {
        // Fetch the PO details to validate the fields
        $stmt = $conn->prepare("SELECT * FROM purchase_orders WHERE id = :id");
        $stmt->bindParam(':id', $po_id, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $required_fields = [
            'supplier', 
            'address', 
            'delivery_term', 
            'payment_term', 
            'date_delivery', 
            'signature_supplier',
            'supplier_date',
            'fund_cluster',
            'ors_burs_amount',
            'signature_accountant',
        ];

        // Define user-friendly labels for the fields
        $field_labels = [
            'supplier' => 'Supplier',
            'address' => 'Address',
            'delivery_term' => 'Delivery Term',
            'payment_term' => 'Payment Term',
            'date_delivery' => 'Delivery Date',
            'signature_supplier' => 'Supplier Signature',
            'supplier_date' => 'Supplier Date',
            'fund_cluster' => 'Fund Cluster',
            'ors_burs_amount' => 'ORS/BURS Amount',
            'signature_accountant' => 'Accountantant Signature',
        ];

        // Loop through the required fields and check if any are empty
        foreach ($required_fields as $field) {
            if (empty($order[$field])) {
                // Use the user-friendly label for the error message
                $field_label = $field_labels[$field];
                $_SESSION['error_message'] = "Cannot approve PO. The field '$field_label' is missing or empty.";
                header("Location: ../purchase_order/view_po.php?id=$po_id");
                exit();
            }
        }

        // If validation passes, update the status to 'approved'
        $stmt = $conn->prepare("UPDATE purchase_orders SET status = 'approved' WHERE id = :id");
        $stmt->bindParam(':id', $po_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Insert a notification into the po_notifications table
        $user_id = $_SESSION['user_id'];  // Assuming the user ID is stored in the session
        $forwarded_by = $_SESSION['account_type']; // Assuming the account type is stored in the session

        // Construct the notification message
        $message = "New Approved Purchase Order PO No. " . htmlspecialchars($order['po_no']);

        $stmt = $conn->prepare("INSERT INTO po_notifications (user_id, message, forwarded_by, po_no, po_id, is_read) 
                       VALUES (:user_id, :message, :forwarded_by, :po_no, :po_id, :is_read)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->bindParam(':forwarded_by', $forwarded_by, PDO::PARAM_STR);
        $stmt->bindParam(':po_no', $order['po_no'], PDO::PARAM_STR);
        $stmt->bindParam(':po_id', $po_id, PDO::PARAM_INT);

        // Default is_read to 0 (unread) when inserting the notification
        $is_read = 0;
        $stmt->bindParam(':is_read', $is_read, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['success_message'] = "Purchase order successfully forwarded to Supply Office.";
        header("Location: ../purchase_order/");
        exit();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['approve_po'])) {
    $po_id = $_POST['po_id'];
    approve_purchase_order($conn, $po_id);
}

//-----------------------------------------------DISAPPROVING THE PURCHASE ORDER
function disapprove_purchase_order($conn, $po_id) {
    try {
        $stmt = $conn->prepare("UPDATE purchase_orders SET status = 'canceled' WHERE id = :id");
        $stmt->bindParam(':id', $po_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $_SESSION['success_message'] = "Purchase order successfully canceled.";
        header("Location: ../approved_purchase_order/");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['disapprove_po'])) {
    $po_id = $_POST['po_id'];
    disapprove_purchase_order($conn, $po_id);
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
//-------------------------------------------------------------------GENERATE PO NUMBER
function generatePONumber($conn) {
    $year = date("Y");

    // Query to get the last PO number for the current year
    $query = "SELECT po_no FROM purchase_orders WHERE po_no LIKE :po_no ORDER BY po_no DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $like_po_no = "$year-%"; // Filter only by the current year
    $stmt->bindParam(':po_no', $like_po_no);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $last_po_no = $row['po_no'];
        $last_serial = (int)substr($last_po_no, -4); 
        $new_serial = str_pad($last_serial + 1, 4, '0', STR_PAD_LEFT); 
    } else {
        $new_serial = '0001'; // Start from 0001 for a new year
    }

    // Include year, month, and the new serial number
    $month = date("m");
    $new_po_no = "$year-$month-$new_serial";

    return $new_po_no;
}

$po_no = generatePONumber($conn);

//-------------------------------------------------------------------REQUESTOR INPUT
try {
    $query = "SELECT id, end_user_name, requisitioning_office FROM end_users";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $requestors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
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

// --------------------------------------------------------------------------FETCH PURCHASE ORDERS LABELS
$queryLabels = "SELECT * FROM purchase_order_labels WHERE po_id = ?";
$stmtLabels = $conn->prepare($queryLabels);
$stmtLabels->execute([$po_id]);
$labels = $stmtLabels->fetchAll(PDO::FETCH_ASSOC);

$labelMap = [];
foreach ($labels as $label) {
    $labelMap[$label['label_no']][] = [
        'id' => $label['id'],           // Include the 'id' here
        'label_no' => $label['label_no'],
        'label_text' => $label['label_text']
    ];
}


?>