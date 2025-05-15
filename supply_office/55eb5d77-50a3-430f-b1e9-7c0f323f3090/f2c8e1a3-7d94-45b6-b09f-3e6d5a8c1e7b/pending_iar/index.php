<?php
require '../../class/function/config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/supply_office_staff.php';
?>
<title>Pending IAR</title>
<main class="container mt-5 custom-container">
    <h2>Pending Inspection and Acceptance Reports</h2>
    <div class="table-responsive">
    <table id="iarTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 70px;">IAR No.</th>
                <th style="width: 200px;">P.O. No./Date</th>
                <th style="width: 150px;">Requestor</th>
                <th style="width: 200px;">Requisitioning Office</th>
                <th style="width: 80px;">Date</th>
                <th style="width: 70px;">Type</th>
                <th style="width: 50px;">Action</th>
                <th class="d-none">Item Descriptions</th> 
            </tr>
        </thead>
        <?php if (!empty($pendingIARs)): ?>
                <?php foreach ($pendingIARs as $iar): ?>
                    <tr <?php if ($iar['spiar_new'] == 1) { echo 'class="pulsing-color"'; } ?>>
                        <td><?php echo htmlspecialchars($iar['iar_no']); ?></td>
                        <td><?php echo htmlspecialchars($iar['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($iar['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($iar['req_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($iar['date'])); ?></td>
                        <td>
                        <?php 
                            if ($iar['insp_status'] === 'complete') {
                                echo '<span class="badge badge-success">Complete</span>';
                            } elseif ($iar['insp_status'] === 'partial') {
                                echo '<span class="badge badge-warning">Partial</span>';
                            } else {
                                echo '<span class="badge badge-secondary">N/A</span>';
                            }
                            ?>
                        </td>
                        <td class="d-none"><?php echo htmlspecialchars($iar['item_descriptions']); ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary" type="button" id="dropdownMenuButton<?php echo $iar['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $iar['id']; ?>">
                                    <a class="dropdown-item ai-dropdown-item" href="view_iar.php?id=<?php echo $iar['id']; ?>&update_spiar=1"><i class="fas fa-eye view-icon"></i> View </a>
                                    <a class="dropdown-item ai-dropdown-item" data-toggle="modal" data-target="#notifyModal" data-iar-no="<?php echo $iar['iar_no']; ?>"><i class="far fa-bell notify-icon"></i> Notify Property Custodian </a>
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
<!-- IAR Notification Modal -->
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
        <p>The IAR No. <span id="iar_no_display"></span> is ready for acceptance check.</p>
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
      var iarNo = button.data('iar-no'); 
      $('#iar_no_display').text(iarNo); 
    });

    $('#sendNotification').click(function() {
      var iarNo = $('#iar_no_display').text(); 

      $.ajax({
        url: 'notify_iar.php', 
        type: 'POST',
        data: { iar_no: iarNo },
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