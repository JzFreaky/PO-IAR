<?php
require '../../classes/config.php';
require '../../classes/supply_config.php';
include '../../../aclasses/sheader.php';
include '../../../aclasses/snavbar.php';
function fetchitemInspected($conn) {
    try {
        $stmt = $conn->prepare(
            "SELECT iins.id, iins.stock_no, iins.description, iins.date_inspected, iins.quantity, iins.type, iins.po_id, po.po_no
             FROM inspected_items iins
             LEFT JOIN purchase_orders po ON iins.po_id = po.id
             ORDER BY iins.date_inspected DESC"  // Correct alias used here
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching inspected item data: " . $e->getMessage();
        return [];  // Return an empty array in case of error
    }
}



$itemInspected = fetchitemInspected($conn);

?>
<title>Inspected Items</title>
<main class="container mt-5 custom-container">
<div class="table-responsive">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
            <h2>Inspected Item's</h2>
        </div>
    </div>
</div>
<table id="itemsInspectedtable" class="table table-striped table-bordered" style="table-layout: fixed;">
    <thead>
        <tr>
            <th style="width: 100px;">PO No</th>
            <th style="width: 100px;">Item</th>
            <th style="width: 100px;">Date Inspected</th>
            <th style="width: 100px;">Quantity</th>
            <th style="width: 100px;">Type</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($itemInspected)): ?>
            <?php foreach ($itemInspected as $items_inspected): ?>
                <tr>
                    <td><?php echo htmlspecialchars($items_inspected['po_no']); ?></td>  <!-- Display PO No -->
                    <td><?php echo htmlspecialchars($items_inspected['description']); ?></td>
                    <td><?php echo date('M j, Y', strtotime($items_inspected['date_inspected'])); ?></td>
                    <td><?php echo htmlspecialchars($items_inspected['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($items_inspected['type']); ?></td>
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