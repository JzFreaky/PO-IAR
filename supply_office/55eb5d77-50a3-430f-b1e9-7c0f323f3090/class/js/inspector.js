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

//-------------------------------------------------GENERATE IAR TABLE JS
let receivedDescriptions = {};

function openModal(stockNo, description, unit, quantity) {

    const storedDescription = receivedDescriptions[stockNo + '_description'] || description; 
    const storedQuantity = receivedDescriptions[stockNo + '_quantity'] || quantity; 

    if (!receivedDescriptions[stockNo]) {
        $('#input-received-description').val(''); 
        $('#input-received-quantity').val('');
    } else {
        $('#input-received-description').val(receivedDescriptions[stockNo]);
        $('#input-received-quantity').val('');
    }

    $('#input-stock-no').val(stockNo);
    $('#input-description').val(storedDescription); 
    $('#input-unit').val(unit);
    $('#input-quantity').val(storedQuantity); 

    $('#input-original-description').val(description);
    $('#input-original-quantity').val(quantity);
    


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

    let isComplete = 0; 
    let status = 'verified'; 

    if (newQuantity >= remainingQuantity && newDescription === originalDescription) { 
        isComplete = 1; 
    } else {
        status = 'not verified'; 
        $('#items_incomplete').prop('checked', true); 
        $('#inspection_verified').prop('checked', false);
        allItemsVerified = false; 
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

    $('#row-' + stockNo + ' .quantity-cell').text(newQuantity); 
    $('#row-' + stockNo + ' .description-cell').text(newDescription); 

    // Create the hidden input fields if they don't exist
    if (!$('input[name="stock_no[]"][value="' + stockNo + '"]').length) {
        $('#hidden-stock-no').append(`<input type="hidden" name="stock_no[]" value="${stockNo}">`);
        $('#hidden-description').append(`<input type="hidden" name="description[]" value="${newDescription}">`);
        $('#hidden-unit').append(`<input type="hidden" name="unit[]" value="${unit}">`);
        $('#hidden-quantity').append(`<input type="hidden" name="quantity[]" value="${newQuantity}">`);  
        $('#hidden-status').append(`<input type="hidden" name="status[]" value="${status}">`);
        $('#hidden-is-complete').append(`<input type="hidden" name="is_complete[]" value="${isComplete}">`);
        $('#hidden-original-description').append(`<input type="hidden" name="original_description[]" value="${oDescription}">`);
        $('#hidden-original-quantity').append(`<input type="hidden" name="original_quantity[]" value="${oQuantity}">`);
    } else {
        // Update existing hidden input values
        $('input[name="stock_no[]"][value="' + stockNo + '"]').val(stockNo); 
        $('input[name="description[]"][value="' + newDescription + '"]').val(newDescription); 
        $('input[name="unit[]"][value="' + unit + '"]').val(unit); 
        $('input[name="quantity[]"][value="' + newQuantity + '"]').val(newQuantity); 
        $('input[name="status[]"][value="' + status + '"]').val(status); 
        $('input[name="is_complete[]"][value="' + isComplete + '"]').val(isComplete); 
        $('input[name="original_description[]"][value="' + originalDescription + '"]').val(oDescription);
        $('input[name="original_quantity[]"][value="' + originalQuantity + '"]').val(oQuantity);
    }

    if (status === 'verified') {
        $('#status-' + stockNo).html('<i class="fas fa-check" style="color: green;"></i>');
    } else {
        $('#status-' + stockNo).html('<i class="fas fa-times" style="color: red;"></i>'); 
    }

    if (allItemsVerified && $('#inspection_verified').prop('checked') === false) { 
        $('#inspection_verified').prop('checked', true);
    } 

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
        const text = item.textContent.toLowerCase();
        if (text.includes(filter)) {
            item.style.display = '';
            found = true;
        } else {
            item.style.display = 'none';
        }
    });

    selectItems.style.display = found ? 'block' : 'none';
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


function showNextSection() {
    var section1 = document.getElementById("section1");
    var section2 = document.getElementById("section2");
    var section3 = document.getElementById("section3");
    var nextButton = document.getElementById("nextButton");
    var submitButton = document.getElementById("submitButton");
    var backButton = document.getElementById("backButton");
  
    if (section1.style.display !== "none") {
      section1.style.display = "none";
      section2.style.display = "block";
      nextButton.style.display = "block";
      submitButton.style.display = "none";
      backButton.style.display = "block";
    } else if (section2.style.display !== "none") {
      section2.style.display = "none";
      section3.style.display = "block";
      nextButton.style.display = "none";
      submitButton.style.display = "block";
      backButton.style.display = "block";
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
  }




