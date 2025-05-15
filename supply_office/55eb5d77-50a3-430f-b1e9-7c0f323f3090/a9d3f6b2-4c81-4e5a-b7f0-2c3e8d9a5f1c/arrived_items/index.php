<?php
require '../../class/function/config.php';
require '../../class/function/inspector_config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';
require '../../class/function/inspector.php';

?>
<title>Item's for Inspection</title>
<main class="container mt-5 custom-container">
<div class="table-responsive">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
            <h2>Item's for Inspection</h2>
        </div>
    </div>
</div>
<table id="itemsInspectedtable" class="table table-striped table-bordered" style="table-layout: fixed;">
<thead>
        <tr>
            <th style="width: 80px;">PO No</th>
            <th style="width: 120px;">Item</th>
            <th style="width: 50px;">Date Delivered</th>
            <th style="width: 90px;">Quantity</th>
            <th style="width: 50px;">Status</th>
            <th style="width: 50px;">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($arrivedItems)): ?>
    <?php foreach ($arrivedItems as $item): ?>
            <tr <?php if ($item['iai_new'] == 1) { echo 'class="pulsing-color"'; } ?>>
                <td><?= htmlspecialchars($item['po_no']) ?></td>
                <td><?= htmlspecialchars($item['description']) ?></td>
                <td><?= htmlspecialchars($item['delivery_date']) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td>
                    <?php 
                        $status = htmlspecialchars($item['status']);
                        $badgeClass = ($status === 'Inspected') ? 'badge badge-success' : 'badge bg-danger rounded-pill';
                    ?>
                    <span class="<?= $badgeClass ?>"><?= $status ?></span>
                </td>


                <td>
                    <button class="btn btn-primary btn-inspect" 
                        data-id="<?= $item['id'] ?>" 
                        data-po-no="<?= htmlspecialchars($item['po_no']) ?>"
                        data-description="<?= htmlspecialchars($item['description']) ?>"
                        data-delivery-date="<?= htmlspecialchars($item['delivery_date']) ?>"
                        data-quantity="<?= htmlspecialchars($item['quantity']) ?>"
                        data-status="<?= htmlspecialchars($item['status']) ?>"
                        data-remarks="<?= htmlspecialchars($item['remarks'] ?? '') ?>"
                        data-toggle="modal" data-target="#inspectModal" title="Inspect">
                        <i class="fas fa-search"></i>
                    </button>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <?php endif; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="inspectModal" tabindex="-1" role="dialog" aria-labelledby="inspectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inspectModalLabel">Inspect Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="inspectionForm">
                    <input type="hidden" id="itemId" name="id">
                    <div class="form-group">
                        <label>PO No:</label>
                        <input type="text" class="form-control" id="modalPoNo" readonly>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" class="form-control" id="modalDescription" readonly>
                    </div>
                    <div class="form-group">
                        <label>Delivery Date:</label>
                        <input type="text" class="form-control" id="modalDeliveryDate" readonly>
                    </div>
                    <div class="form-group">
                    <label>Quantity:</label>
                    <input type="number" class="form-control" id="modalQuantity" min="1" oninput="validateQuantity(this)" placeholder="Put the exact quantity">
                    <small id="quantityError" style="color: red; display: none;">Quantity must be greater than 0</small>
                </div>
                    <div class="form-group">
                    <label> Remarks(optional):
                            <i class="fas fa-comment-dots icon-button" style="color: #ff5c5c;" onclick="forRemarks()" title="Add Remarks if you are accepting the item/s that is not the correct specs."></i>
                            </label>
                        <textarea class="form-control" id="modalRemarks" rows="3" placeholder="Enter remarks here..." style="display: none;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="rejectItem">Reject</button>
                <button type="button" class="btn btn-success" id="saveInspection">Mark as Inspected</button>
            </div>
        </div>
    </div>
</div>

</div>
</main>

<script>
// When the Inspect button is clicked, populate the modal with item details
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-inspect").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("itemId").value = this.getAttribute("data-id");
            document.getElementById("modalPoNo").value = this.getAttribute("data-po-no");
            document.getElementById("modalDescription").value = this.getAttribute("data-description");
            document.getElementById("modalDeliveryDate").value = this.getAttribute("data-delivery-date");
            document.getElementById("modalQuantity").value = this.getAttribute("data-quantity");
            document.getElementById("modalRemarks").value = this.getAttribute("data-remarks");
            
            let status = this.getAttribute("data-status").trim();
            let inspectButton = document.getElementById("saveInspection");

            if (status === "Inspected") {
                inspectButton.disabled = true;  // Disable the button
            } else {
                inspectButton.disabled = false; // Enable the button for other statuses
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let messageContainer = document.getElementById("messageContainer");
    let successMessage = sessionStorage.getItem("inspectionSuccess");

    if (successMessage) {
        let successDiv = document.createElement("div");
        successDiv.className = "alert alert-success";
        successDiv.textContent = successMessage;

        messageContainer.innerHTML = "";
        messageContainer.appendChild(successDiv);

        // Remove message after 3 seconds
        setTimeout(() => {
            successDiv.remove();
            sessionStorage.removeItem("inspectionSuccess");
        }, 3000);
    }
});

document.getElementById("saveInspection").addEventListener("click", function() {
    let formData = new FormData();
    formData.append("id", document.getElementById("itemId").value);
    formData.append("quantity", document.getElementById("modalQuantity").value);
    formData.append("remarks", document.getElementById("modalRemarks").value);
    formData.append("action", "inspect");

    fetch("update_arrived_items.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            sessionStorage.setItem("inspectionSuccess", "Item successfully inspected!");
            $("#inspectModal").modal("hide");
            location.reload();
        } else {
            showError("Please put the quantity of the item.");
        }
    });
});

document.getElementById("rejectItem").addEventListener("click", function() {
    let formData = new FormData();
    formData.append("id", document.getElementById("itemId").value);
    formData.append("remarks", document.getElementById("modalRemarks").value);
    formData.append("action", "reject");

    fetch("update_arrived_items.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            sessionStorage.setItem("inspectionSuccess", "Item has been rejected.");
            $("#inspectModal").modal("hide");
            location.reload();
        } else {
            showError("Remarks required for rejection.");
        }
    });
});

function showError(message) {
    let messageContainer = document.getElementById("messageContainer");
    let errorMessage = document.createElement("div");
    errorMessage.className = "error-message alert alert-danger";
    errorMessage.textContent = message;

    messageContainer.innerHTML = "";
    messageContainer.appendChild(errorMessage);

    setTimeout(() => {
        errorMessage.remove();
    }, 3000);
}

// Display success message after reload
window.addEventListener("load", function() {
    let messageContainer = document.getElementById("messageContainer");
    let successMessage = sessionStorage.getItem("inspectionSuccess");

    if (successMessage) {
        let alertBox = document.createElement("div");
        alertBox.className = "success-message alert alert-success";
        alertBox.textContent = successMessage;

        messageContainer.innerHTML = "";
        messageContainer.appendChild(alertBox);

        // Remove message from sessionStorage after displaying it
        sessionStorage.removeItem("inspectionSuccess");

        // Hide after 2 seconds
        setTimeout(() => {
            alertBox.remove();
        }, 3000);
    }
});


function forRemarks() {
    let remarksField = document.getElementById("modalRemarks");
    
    // Toggle visibility
    if (remarksField.style.display === "none" || remarksField.style.display === "") {
        remarksField.style.display = "block"; // Show textarea
    } else {
        remarksField.style.display = "none"; // Hide textarea
    }
}

function validateQuantity(input) {
    if (input.value < 1) {
        input.value = "";
        document.getElementById("quantityError").style.display = "block";
    } else {
        document.getElementById("quantityError").style.display = "none";
    }
}
</script>
<script src="../../class/js/delivery_date.js"></script>
<?php include '../../../sclasses/footer.php'; ?>