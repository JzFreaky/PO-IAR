<?php
require '../../classes/config.php';
require '../../classes/supply_config.php';
include '../../../aclasses/sheader.php';
include '../../../aclasses/snavbar.php';
function fetchItemDeliveries($conn) {
    try {
        $stmt = $conn->prepare(
            "SELECT idel.id, idel.stock_no, idel.description, idel.delivery_date, idel.quantity, idel.status, idel.po_id, po.po_no
             FROM arrived_items idel
             LEFT JOIN purchase_orders po ON idel.po_id = po.id
             ORDER BY idel.delivery_date DESC" // Order by delivery_date in descending order
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching item delivery data: " . $e->getMessage();
        return [];  // Return an empty array in case of error
    }
}

$itemDeliveries = fetchItemDeliveries($conn);
?>
<title>Arrived Item's</title>
<main class="container mt-5 custom-container">
<div class="table-responsive">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
            <h2>Arrived Item's</h2>
        </div>
    </div>
</div>
<table id="Itemstable" class="table table-striped table-bordered" style="table-layout: fixed;">
    <thead>
        <tr>
            <th style="width: 100px;">PO No</th>
            <th style="width: 100px;">Item</th>
            <th style="width: 100px;">Date Delivered</th>
            <th style="width: 100px;">Quantity</th>
            <th style="width: 100px;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($itemDeliveries)): ?>
            <?php foreach ($itemDeliveries as $items_arrived): ?>
                <tr>
                    <td><?php echo htmlspecialchars($items_arrived['po_no']); ?></td>  <!-- Display PO No -->
                    <td><?php echo htmlspecialchars($items_arrived['description']); ?></td>
                    <td><?php echo date('M j, Y', strtotime($items_arrived['delivery_date'])); ?></td>
                    <td><?php echo htmlspecialchars($items_arrived['quantity']); ?></td>
                    <td>
                        <?php 
                            if ($items_arrived['status'] === 'Inspected') {
                                echo '<span class="badge badge-success">Inspected</span>';
                            } elseif ($items_arrived['status'] === 'Rejected') {
                                echo '<span class="badge bg-danger rounded-pill">Rejected</span>';
                            } else {
                                echo '<span class="badge badge-secondary">N/A</span>';
                            }
                            ?>
                        </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No item deliveries found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>


<div class="row mt-4 mb-1"> <div class="col-md-12">
            <a href="../../supply_office" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a> </div>
    </div>
</main>

<?php include '../../../aclasses/sfooter.php'; ?>
