<?php
require '../../class/function/config.php';
include '../../../database/db.php'; 
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';
?>
<title>Purchase Orders</title>
<main class="container mt-5 custom-container">
    <h2>Purchase Orders</h2>
    <div class="table-responsive">
    <table id="purchaseOrdersTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
        <tr>
                <th style="width: 100px;">PO No.</th>
                <th style="width: 150px;">Requestor</th>
                <th style="width: 200px;">Requisitioning Office</th>
                <th style="width: 100px;">Date</th>
                <th style="width: 70px;">Status</th>
                <th style="width: 70px;">Action</th>
                <th class="d-none">Item Descriptions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($purchase_orders)): ?>
            <?php
                foreach ($purchase_orders as $order): 
                    $po_no = $order['po_no']; 
                    $po_no_plain = explode(" |", $po_no)[0]; 

                    $sql = "SELECT * FROM inspection_acceptance_report WHERE po_no LIKE ?";
                    $stmt = $conn->prepare($sql);
                    $po_no_like = '%' . $po_no_plain . '%'; 
                    $stmt->execute([$po_no_like]); 
                    $iarExists = $stmt->rowCount() > 0; 
                    $status = $order['status']; 
                    
                    if ($status != 'canceled') { 
                        if (!$iarExists) {
                            $status = 'approved';
                        } else {
                            $iar_sql = "SELECT * FROM inspection_acceptance_report WHERE po_no LIKE ?";
                            $iar_stmt = $conn->prepare($iar_sql);
                            $iar_stmt->execute([$po_no_like]);
                            $iars = $iar_stmt->fetchAll(PDO::FETCH_ASSOC);

                            $originalItemsFulfilled = true;
                            $additionalItemsAccepted = false;

                            $item_sql = "SELECT * FROM iar_item_details WHERE iar_id IN (SELECT id FROM inspection_acceptance_report WHERE po_no LIKE ?)";
                            $item_stmt = $conn->prepare($item_sql);
                            $item_stmt->execute([$po_no_like]); 
                            $iar_items = $item_stmt->fetchAll(PDO::FETCH_ASSOC);

                            $po_items_sql = "SELECT * FROM purchase_order_items WHERE po_id = ?";
                            $po_items_stmt = $conn->prepare($po_items_sql);
                            $po_items_stmt->execute([$order['id']]); 
                            $po_items = $po_items_stmt->fetchAll(PDO::FETCH_ASSOC); 

                            $received_quantities = [];
                            foreach ($iar_items as $iar_item) {
                                $description = $iar_item['description'];
                                if (!isset($received_quantities[$description])) {
                                    $received_quantities[$description] = [
                                        'total_quantity' => 0
                                    ];
                                }
                                $received_quantities[$description]['total_quantity'] += (int)$iar_item['quantity'];
                            }

                            foreach ($po_items as $po_item) {
                                $description = $po_item['description'];
                                $ordered_quantity = (int)$po_item['quantity'];
                                if (isset($received_quantities[$description])) {
                                    $received_quantity = $received_quantities[$description]['total_quantity'];
                                    if ($received_quantity < $ordered_quantity) {
                                        $originalItemsFulfilled = false;
                                        break; 
                                    }
                                } else {
                                    $originalItemsFulfilled = false;
                                    break; 
                                }
                            }

                            foreach ($iars as $iar) {
                                if ($iar['property_custodian_status'] == 'accept/not correct specs') {
                                    $additionalItemsAccepted = true;
                                    break; 
                                }
                            }

                            if ($originalItemsFulfilled || $additionalItemsAccepted) {
                                $status = 'Complete';
                            } else {
                                $status = 'Incomplete';
                            }
                        }

                        if ($status != 'Complete') {
                            $update_sql = "UPDATE purchase_orders SET status = ? WHERE po_no = ?";
                            $update_stmt = $conn->prepare($update_sql);
                            $update_stmt->execute([$status, $po_no_plain]);
                        } else {
                            $check_status_sql = "SELECT status FROM purchase_orders WHERE po_no = ?";
                            $check_stmt = $conn->prepare($check_status_sql);
                            $check_stmt->execute([$po_no_plain]);
                            $current_status = $check_stmt->fetchColumn();

                            if ($current_status != 'Complete') {
                                $update_sql = "UPDATE purchase_orders SET status = ? WHERE po_no = ?";
                                $update_stmt = $conn->prepare($update_sql);
                                $update_stmt->execute(['Complete', $po_no_plain]);
                            }
                        }
                    }

                    ?>
                    <tr <?php if ($order['ipo_new'] == 1) { echo 'class="pulsing-color"'; } ?>>
                        <td><?php echo htmlspecialchars($order['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($order['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($order['requisitioning_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($order['date'])); ?></td>
                        <td class="d-none"><?php echo htmlspecialchars($order['item_descriptions']); ?></td>
                        <td>
                            <?php if ($status == 'Incomplete'): ?>
                                <span class="badge badge-danger">Incomplete</span>
                            <?php elseif ($status == 'Complete'): ?>
                                <span class="badge badge-success">Complete</span>
                            <?php elseif ($status == 'approved'): ?>
                                <span class="badge badge-primary">Pending</span>
                            <?php elseif ($status == 'canceled'): ?>
                                <span class="badge badge-secondary">Canceled</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary" type="button" id="dropdownMenuButton<?php echo $order['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $order['id']; ?>">
                                    <a class="dropdown-item ai-dropdown-item" href="view_po.php?id=<?php echo $order['id']; ?>&update_ipo=1"><i class="fas fa-eye view-icon"></i> View </a>
                                </div>
                            </div>          
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</main>
<?php include '../../../sclasses/footer.php'; ?>