<?php
require '../../class/function/config.php';
include '../../../database/db.php'; 
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/supply_office_staff.php';
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
        <?php if (!empty($ppurchase_orders)): ?>
            <?php
                foreach ($ppurchase_orders as $order): 
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
                            // Get all IARs for this PO
                            $iar_sql = "SELECT * FROM inspection_acceptance_report WHERE po_no LIKE ?";
                            $iar_stmt = $conn->prepare($iar_sql);
                            $iar_stmt->execute([$po_no_like]);
                            $iars = $iar_stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Initialize variables for tracking items
                            $originalItemsFulfilled = true;
                            $additionalItemsAccepted = false;

                            // Check if original items are fully received
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
                                        break; // No need to continue if an item is missing
                                    }
                                } else {
                                    $originalItemsFulfilled = false;
                                    break; // No need to continue if an item is missing
                                }
                            }

                            // Check if any additional items (not in the original order) are accepted
                            foreach ($iars as $iar) {
                                // Check if the property_custodian_status is "accept/not correct specs"
                                if ($iar['property_custodian_status'] == 'accept/not correct specs') {
                                    $additionalItemsAccepted = true;
                                    break; 
                                }
                            }

                            // Determine final status
                            if ($originalItemsFulfilled || $additionalItemsAccepted) {
                                $status = 'Complete';
                            } else {
                                $status = 'Incomplete';
                            }
                        }

                        // Update the status in the database
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

                    // Display the purchase order details
                    ?>
                    <tr <?php if ($order['spo_new'] == 1) { echo 'class="pulsing-color"'; } ?>>
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
                                    <a class="dropdown-item ai-dropdown-item" href="view_po.php?id=<?php echo $order['id']; ?>&update_spo=1"><i class="fas fa-eye view-icon"></i> View </a>
                                    <a class="dropdown-item ai-dropdown-item" data-toggle="modal" data-target="#notifyModal" data-po-no="<?php echo $po_no_plain; ?>"><i class="far fa-bell notify-icon"></i> Notify Inspector </a>  
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
<!-- Notification Modal -->
<div class="modal fade" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="notifyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notifyModalLabel">Send Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>The Items/Supplies from the Purchase Order <span id="po_no_display"></span> has arrived in the Supply Office.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="sendNotification">Send</button>
      </div>
    </div>
  </div>
</div>
<?php include '../../../sclasses/footer.php'; ?>
<script>
  $(document).ready(function() {
    $('#notifyModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); 
      var poNo = button.data('po-no'); 
      $('#po_no_display').text(poNo); 
    });

    $('#sendNotification').click(function() {
      var poNo = $('#po_no_display').text(); 

      $.ajax({
        url: 'notify_po.php', 
        type: 'POST',
        data: { po_no: poNo },
        success: function(response) {
          $('#notifyModal').modal('hide');
          
          var successMessage = $('<div class="success-message alert alert-success"></div>');
          successMessage.text('Notification sent successfully!');
          $('body').prepend(successMessage); 

          setTimeout(function() {
            successMessage.fadeOut();
          }, 3000);
        },
        error: function() {
          var errorMessage = $('<div class="error-message alert alert-danger"></div>');
          errorMessage.text('Error sending notification!');
          $('body').prepend(errorMessage); 

          setTimeout(function() {
            errorMessage.fadeOut();
          }, 3000);
        }
      });
    });
  });
</script>