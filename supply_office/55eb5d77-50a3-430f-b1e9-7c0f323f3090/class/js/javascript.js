document.getElementById("profileContainer").addEventListener("click", function() {
    var dropdownContent = document.getElementById("dropdownContent");
    dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
});

window.onclick = function(event) {
    if (!event.target.matches('.profile-container') && !event.target.closest('.profile-container')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
};

/*----------------------------------------------- P.O DATABLE FUNC*/

$(document).ready(function() {
    $('#purchaseOrdersTable').DataTable({
        "order": [[0, "desc"]]  // Sort by the first column (PO No.) ascending
    });
});

/*----------------------------------------------- IAR DATABLE FUNC*/
$(document).ready(function() {
    $('#iarTable').DataTable({
        "order": [[0, "desc"]]  // Sort by the first column (PO No.) ascending
    });
});

$(document).ready(function() {
    $('#Itemstable').DataTable({
        "order": [[2, "desc"]],  // Sort by the third column (delivery_date) in descending order
        "columnDefs": [
            { 
                "type": "date",  // Ensure the column is treated as a date for sorting
                "targets": 2     // Apply the date type to the third column (index 2)
            }
        ]
    });
});

$(document).ready(function() {
    $('#itemsInspectedtable').DataTable({
        "order": [[2, "desc"]],  // Sort by the third column (delivery_date) in descending order
        "columnDefs": [
            { 
                "type": "date",  // Ensure the column is treated as a date for sorting
                "targets": 2     // Apply the date type to the third column (index 2)
            }
        ]
    });
});

//-------------------------------------------------BURGER MENU
document.getElementById('burgerMenu').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
});

/*----------------------------------------------- QUANTITY INPUT CANT TYPE -NUM*/
function validateTextQuantity(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}

//-------------------------------------------------GENERATE IAR TABLE JS
let receivedDescriptions = {};

function openModal(stockNo, description, unit, receivedQuanstity) {
    const storedDescription = receivedDescriptions[stockNo + '_description'] || description;
    const storedQuantity = receivedDescriptions[stockNo + '_quantity'] || receivedQuanstity; 
    const storedRemarks = receivedDescriptions[stockNo + '_remarks'] || '';

    if (!receivedDescriptions[stockNo]) {
        $('#input-received-description').val('');
        $('#input-received-quantity').val('');
        $('#input-remarks').val('');
    } else {
        $('#input-received-description').val(receivedDescriptions[stockNo]);
        $('#input-received-quantity').val('');
    }

    $('#input-stock-no').val(stockNo);
    $('#input-description').val(storedDescription);
    $('#input-unit').val(unit);
    $('#input-quantity').val(storedQuantity); // ✅ Displays received quantity (5)
    $('#input-remarks').val(storedRemarks);

    $('#input-original-description').val(description);
    $('#input-original-quantity').val(receivedQuanstity); // ✅ Store received quantity


    $('#modalOverlay').fadeIn();
    $('#itemDetailModal').fadeIn();
}

$('.inspect-icon').on('click', function() {
    var stockNo = $(this).data('stock-no');
    var description = $(this).data('description');
    var unit = $(this).data('unit');
    var quantity = $(this).data('quantity');

    openModal(stockNo, description, unit, quantity);
});

$('#modalOverlay').on('click', function() {
    closeModal();
});

let allItemsVerified = true;
$('.done-button').on('click', function() {
    const stockNo = $('#input-stock-no').val();
    const unit = $('#input-unit').val();
    const newDescription = $('#input-description').val();
    const newQuantity = $('#input-quantity').val();
    const remainingQuantity = parseInt($('#row-' + stockNo + ' .quantity-cell').text());
    const originalDescription = $('#row-' + stockNo + ' td:nth-child(2)').text();
    const oDescription = $('#input-original-description').val(); // Get from modal
    const oQuantity = $('#input-original-quantity').val(); // Get from modal
     const remarks = $('#input-remarks').val();

    let isComplete = 0;
    let status = 'verified';

    if (newQuantity >= remainingQuantity && newDescription === originalDescription) {
        isComplete = 1;
        status = 'verified'; // Set status to "verified" if complete
    } else {
        isComplete = 0;
        status = 'not verified'; // Set status to "not verified" if incomplete
    }

    if (newQuantity < remainingQuantity || newDescription !== originalDescription) { 
        $('#items_incomplete').prop('checked', true); 
        $('#inspection_verified').prop('checked', false);
        allItemsVerified = false; 
    } else if (newQuantity >= remainingQuantity && newDescription === originalDescription) { 

    } 

    receivedDescriptions[stockNo] = $('#input-description').val();
    receivedDescriptions[stockNo + '_quantity'] = newQuantity;
    receivedDescriptions[stockNo + '_description'] = newDescription;
    receivedDescriptions[stockNo + '_unit'] = unit;
    receivedDescriptions[stockNo + '_verified'] = $('#inspection_verified').is(':checked');
    receivedDescriptions[stockNo + '_incomplete'] = $('#items_incomplete').is(':checked');
    receivedDescriptions[stockNo + '_remarks'] = remarks;

    $('#row-' + stockNo + ' .quantity-cell').text(newQuantity);
    $('#row-' + stockNo + ' .description-cell').text(newDescription);
    if (status === 'verified') {
        $('#status-' + stockNo).html('<i class="fas fa-check" style="color: green;"></i>'); // Check icon for verified
    } else {
        $('#status-' + stockNo).html('<i class="fas fa-times" style="color: red;"></i>'); // X icon for not verified
    }

    // Find the existing hidden input fields for this stockNo, description, and quantity
    let existingInput = $('input[name="stock_no[]"][value="' + stockNo + '"]').filter(function() {
        return $(this).next('input[name="description[]"]').val() === newDescription &&
               $(this).nextAll('input[name="quantity[]"]').eq(0).val() === newQuantity;
    });

    if (existingInput.length > 0) {
        // Update existing hidden input values
        existingInput.val(stockNo);
        existingInput.next('input[name="description[]"]').val(newDescription);
        existingInput.nextAll('input[name="unit[]"]').eq(0).val(unit);
        existingInput.nextAll('input[name="quantity[]"]').eq(0).val(newQuantity);
        existingInput.nextAll('input[name="status[]"]').eq(0).val(status);
        existingInput.nextAll('input[name="is_complete[]"]').eq(0).val(isComplete);
        existingInput.nextAll('input[name="original_description[]"]').eq(0).val(oDescription);
        existingInput.nextAll('input[name="original_quantity[]"]').eq(0).val(oQuantity);
        existingInput.nextAll('input[name="remarks[]"]').eq(0).val(remarks);
    } else {
        // Create the hidden input fields if they don't exist
        $('#hidden-stock-no').append(`<input type="hidden" name="stock_no[]" value="${stockNo}">`);
        $('#hidden-description').append(`<input type="hidden" name="description[]" value="${newDescription}">`);
        $('#hidden-unit').append(`<input type="hidden" name="unit[]" value="${unit}">`);
        $('#hidden-quantity').append(`<input type="hidden" name="quantity[]" value="${newQuantity}">`);
        $('#hidden-status').append(`<input type="hidden" name="status[]" value="${status}">`);
        $('#hidden-is_complete').append(`<input type="hidden" name="is_complete[]" value="${isComplete}">`);
        $('#hidden-original-description').append(`<input type="hidden" name="original_description[]" value="${oDescription}">`);
        $('#hidden-original-quantity').append(`<input type="hidden" name="original_quantity[]" value="${oQuantity}">`);
        $('#hidden-remarks').append(`<input type="hidden" name="remarks[]" value="${remarks}">`);
    }

    // Update the checkboxes directly based on the status column
    updateCheckboxes();
    closeModal();
});

$('#incomplete-icon').on('click', function() {
    $('#incompleteItemsList').empty();

    for (const stockNo in receivedDescriptions) {
        if (receivedDescriptions[stockNo + '_incomplete']) {
            const description = receivedDescriptions[stockNo + '_description'];
            const unit = receivedDescriptions[stockNo + '_unit'];
            const quantity = receivedDescriptions[stockNo + '_quantity'];

            const row = $('<tr>');
            row.append($('<td>').text(stockNo));
            row.append($('<td>').text(description));
            row.append($('<td>').text(unit));
            row.append($('<td>').text(quantity));
            $('#incompleteItemsList').append(row);
        }
    }
    $('#incompleteModal').modal('show');
});

function closeModal() {
    $('#modalOverlay').fadeOut();
    $('#itemDetailModal').fadeOut();
}

$(document).ready(function() {
    $('#inspectionForm').on('submit', function(e) {
        let allChecked = true;
        let inspectionVerifiedChecked = $('#inspection_verified').is(':checked');

        $('.item-status').each(function() {
            if ($(this).is(':empty')) {
                allChecked = false;
                return false;
            }
        });

        if (inspectionVerifiedChecked && !allChecked) {
            e.preventDefault();
            $('#dialogMessage').text('Please ensure all items have been inspected before submitting the form.');
            $('#dialogBox').fadeIn();
        }
    });
});

function checkItems() {
    let allChecked = true;

    $('.item-status').each(function() {
        if ($(this).is(':empty')) {
            allChecked = false;
            return false;
        }
    });

    if (!allChecked) {
        $('#dialogMessage').text('Please ensure all items have been inspected before checking this box.');
        $('#dialogBox').fadeIn();
        $('#inspection_verified').prop('checked', false);
        $('#items_incomplete').prop('checked', false);
    }
}

function closeDialogBox() {
    $('#dialogBox').fadeOut();
}

// Function to update the checkboxes based on the status column
function updateCheckboxes() {
    let allVerified = true;
    $('.item-status').each(function() {
        // Check if the icon is NOT a check icon (verified)
        if ($(this).find('i.fas.fa-check').length === 0) { 
            allVerified = false;
            return false; // Stop iterating
        }
    });

    if (allVerified) {
        $('#inspection_verified').prop('checked', true);
        $('#items_incomplete').prop('checked', false);
    } else {
        $('#inspection_verified').prop('checked', false);
        $('#items_incomplete').prop('checked', true);
    }
}

//----------------------------------------------------------UACS CODE INPUT JS
const selectItems = document.getElementById('selectItems');
const searchBox = document.getElementById('searchBox');
const hiddenSelect = document.getElementById('resp_code'); 

function toggleDropdown() {
    selectItems.style.display = selectItems.style.display === 'block' ? 'none' : 'block';
}

function filterItems() {
    const filter = searchBox.value.toLowerCase();
    const items = selectItems.querySelectorAll('div');

    let found = false; 
    items.forEach(item => {
        const fullText = item.getAttribute('data-full-text').toLowerCase(); // Get full text from data attribute
        const displayedText = item.textContent.toLowerCase(); // Get displayed text

        if (fullText.includes(filter) || displayedText.includes(filter)) {
            item.style.display = ''; // Show the item if it matches
            found = true;
        } else {
            item.style.display = 'none'; // Hide the item if it doesn't match
        }
    });

    selectItems.style.display = found ? 'block' : 'none'; // Show dropdown only if results found
}

document.querySelectorAll('.select-items div').forEach(item => {
    item.addEventListener('click', function() {
        const value = this.getAttribute('data-value'); 
        searchBox.value = this.textContent; 
        hiddenSelect.value = value; 
        selectItems.style.display = 'none'; 
    });
});

document.addEventListener('click', function(event) {
    if (!event.target.closest('.searchable-select')) {
        selectItems.style.display = 'none';
    }
});


//----------------------------------------------------------NEXT SECTION BUTTON
function validateSection1() {
    var requestor = document.getElementById("requestor").value;
    var supplier = document.getElementById("supplier").value;
    var reqOffice = document.getElementById("req_office").value;
    var invoiceNo = document.getElementById("invoice_no").value;
    var respCode = document.getElementById("resp_code").value;

    if (requestor && reqOffice && supplier && invoiceNo && respCode) {
        return true; 
    } else {
        document.getElementById("section1Error").innerHTML = '<div class="alert alert-danger">Please fill in all required fields.</div>';
        return false; 
    }
}

let section1Validated = false;

function showNextSection() {
    if (section1.style.display !== "none" && (section1Validated || validateSection1())) {
        section1Validated = true;
        section1.style.display = "none";
        section2.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
        document.getElementById("section1Error").innerHTML = "";
    } else if (section2.style.display !== "none") {
        section2.style.display = "none";
        section3.style.display = "block";
        nextButton.style.display = "none";
        submitButton.style.display = "block";
        backButton.style.display = "block";
    } else {
        // Scroll to the top if validation fails
        window.scrollTo(0, 0);
    }
}

  function showPreviousSection() {
    var section1 = document.getElementById("section1");
    var section2 = document.getElementById("section2");
    var section3 = document.getElementById("section3");
    var nextButton = document.getElementById("nextButton");
    var submitButton = document.getElementById("submitButton");
    var backButton = document.getElementById("backButton");
  
    if (section3.style.display !== "none") {
      section3.style.display = "none";
      section2.style.display = "block";
      nextButton.style.display = "block";
      submitButton.style.display = "none";
      backButton.style.display = "block";
    } else if (section2.style.display !== "none") {
      section2.style.display = "none";
      section1.style.display = "block";
      nextButton.style.display = "block";
      submitButton.style.display = "none";
      backButton.style.display = "none";
    }
    if (section1.style.display !== "none") {
        section1Validated = false;
    }
}

//------------------------------------------------------PROPERTY CUSTODIAN
function openItemModal(stockNo,  unit,  oDescription, oQuantity) {
    $('#input-stock-no').val(stockNo);
    $('#input-unit').val(unit);
    $('#input-original-description').val(oDescription);
    $('#input-original-quantity').val(oQuantity);

    $('#modalOverlay').fadeIn();
    $('#propModal').fadeIn(); 
}

function propcloseModal() {
    $('#modalOverlay').fadeOut();
    $('#propModal').fadeOut(); 
}

$('.propinspect-icon').on('click', function() {
    var stockNo = $(this).data('stock-no');
    var oDescription = $(this).data('original-description');
    var unit = $(this).data('unit');
    var oQuantity = $(this).data('original-quantity');

    openItemModal(stockNo, unit, oDescription, oQuantity);
});

function propcloseModal() {
    $('#modalOverlay').fadeOut();
    $('#propModal').fadeOut(); 
}


function propcloseModal() {
    $('#modalOverlay').fadeOut();
    $('#propModal').fadeOut();
}
//----------------------------------Delete PO Notifications (INSPECTOR)
$(document).ready(function() {
    $('.delete-notification').click(function(e) {
        e.preventDefault(); 
        var notificationId = $(this).data('id'); 

        $.ajax({
            url: '../../class/function/delete_notification.php', 
            type: 'POST',
            data: { notification_id: notificationId }, 
            success: function(response) {
                var res = JSON.parse(response); 

                if (res.success) {
                    $('button[data-id="' + notificationId + '"]').closest('.dropdown-item').remove();
                    window.location.reload();  
                } else {
                    document.getElementById("notifError").innerHTML = '<div class="alert alert-danger">Error deleting notification.</div>';
                }
            },
            error: function() {
                document.getElementById("notifError").innerHTML = '<div class="alert alert-danger">Error deleting notification.</div>';
            }
        });
    });

//-----------------------------------------Delete IAR Notifications (for Property Custodian)
    $('.delete-iar-notification').click(function(e) {
        e.preventDefault();
        var IARnotificationId = $(this).data('id');

        $.ajax({
            url: '../../class/function/delete_iar_notification.php', // Update URL for IAR notifications
            type: 'POST',
            data: { iar_notification_id: IARnotificationId },
            success: function(response) {
                var res = JSON.parse(response);

                if (res.success) {
                    $('button[data-id="' + IARnotificationId + '"]').closest('.dropdown-item').remove();
                    window.location.reload();
                } else {
                    document.getElementById("IARnotifError").innerHTML = '<div class="alert alert-danger">Error deleting notification.</div>';
                }
            },
            error: function() {
                document.getElementById("IARnotifError").innerHTML = '<div class="alert alert-danger">Error deleting notification.</div>';
            }
        });
    });
    $('.delete-po-notification').click(function(e) {
        e.preventDefault(); 
        var POnotificationId = $(this).data('id'); 

        $.ajax({
            url: '../../class/function/delete_po_notification.php', 
            type: 'POST',
            data: { po_notification_id: POnotificationId }, 
            success: function(response) {
                var res = JSON.parse(response); 

                if (res.success) {
                    $('button[data-id="' + POnotificationId + '"]').closest('.dropdown-item').remove();
                    window.location.reload();  
                } else {
                    document.getElementById("notifError").innerHTML = '<div class="alert alert-danger">Error deleting notification.</div>';
                }
            },
            error: function() {
                document.getElementById("notifError").innerHTML = '<div class="alert alert-danger">Error deleting notification.</div>';
            }
        });
    });
});
  



