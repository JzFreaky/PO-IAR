
function validateEditSection1() {
    var requestor = document.getElementById("requestor").value;
    var requisitioningOffice = document.getElementById("requisitioning_office").value;
    var supplier = document.getElementById("supplier").value;
    var address = document.getElementById("address").value;
    var date = document.getElementById("date").value;
    var tin = document.getElementById("tin").value; // Optional, can be removed if not required
    var modeProcurement = document.getElementById("mode_procurement").value;
    
    var tinPattern = /^\d{3}-\d{3}-\d{3}(-\d{3})?$/;
    if (tin && !tinPattern.test(tin)) {
        document.getElementById("section1Error").innerHTML = '<div class="alert alert-danger">TIN must be in the format 123-456-789 or 123-456-789-000.</div>';
        return false;
    }

    if (requestor && requisitioningOffice && supplier && address && date && modeProcurement) {
        return true; 
    } else {
        document.getElementById("section1Error").innerHTML = '<div class="alert alert-danger">Please fill in all required fields.</div>';
        return false; 
    }
}

function validateEditSection2() {
    var placeDelivery = document.getElementById("place_delivery").value;
    var deliveryTerm = document.getElementById("delivery_term").value;
    var dateDelivery = document.getElementById("date_delivery").value;
    var paymentTerm = document.getElementById("payment_term").value;

    if (placeDelivery && deliveryTerm && dateDelivery && paymentTerm) {
        return true;
    } else {
        document.getElementById("section2Error").innerHTML = '<div class="alert alert-danger">Please fill in all required fields.</div>';
        return false;
    }
}

function validateEditSection4() {
    var signatureSupplier = document.getElementById("signature_supplier").value;
    var signatureOfficial = document.getElementById("signature_official").value;
    var supplierDate = document.getElementById("supplier_date").value;
    var designation = document.getElementById("designation").value;

    if (signatureSupplier && signatureOfficial && supplierDate && designation) {
        return true;
    } else {
        // Display error message in a div
        document.getElementById("section4Error").innerHTML = '<div class="alert alert-danger">Please fill in all required fields.</div>';
        return false;
    }
}
let Editsection1Validated = false;
let Editsection2Validated = false;
let Editsection4Validated = false;

function showNextEditSection() {
    if (edit_section1.style.display !== "none" && (Editsection1Validated || validateEditSection1())) {
        Editsection1Validated = true;
        edit_section1.style.display = "none";
        edit_section2.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
        // Clear error message for Section 1
        document.getElementById("section1Error").innerHTML = "";
    } else if (edit_section2.style.display !== "none" && (Editsection2Validated || validateEditSection2())) {
        Editsection2Validated = true;
        edit_section2.style.display = "none";
        edit_section3.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
        // Clear error message for Section 2
        document.getElementById("section2Error").innerHTML = "";
    } else if (edit_section3.style.display !== "none") {
        edit_section3.style.display = "none";
        edit_section4.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
    } else if (edit_section4.style.display !== "none" && (Editsection4Validated || validateEditSection4())) { 
        Editsection4Validated = true; 
        edit_section4.style.display = "none";
        edit_section5.style.display = "block";
        nextButton.style.display = "none";
        submitButton.style.display = "block";
        backButton.style.display = "block";
        // Clear error message for Section 4
        document.getElementById("section4Error").innerHTML = "";
    } else {
        // Scroll to the top if validation fails
        window.scrollTo(0, 0);
    }
}

function showPreviousEditSection() {
    var edit_section1 = document.getElementById("edit_section1");
    var edit_section2 = document.getElementById("edit_section2");
    var edit_section3 = document.getElementById("edit_section3");
    var edit_section4 = document.getElementById("edit_section4");
    var edit_section5 = document.getElementById("edit_section5");
    var nextButton = document.getElementById("nextButton");
    var submitButton = document.getElementById("submitButton");
    var backButton = document.getElementById("backButton");

    if (edit_section5.style.display !== "none") {
        edit_section5.style.display = "none";
        edit_section4.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
    } else if (edit_section4.style.display !== "none") {
        edit_section4.style.display = "none";
        edit_section3.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
    } else if (edit_section3.style.display !== "none") {
        edit_section3.style.display = "none";
        edit_section2.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
    } else if (edit_section2.style.display !== "none") {
        edit_section2.style.display = "none";
        edit_section1.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "none";
    }
    if (edit_section1.style.display !== "none") {
        Editsection1Validated = false;
    } else if (edit_section2.style.display !== "none") {
        Editsection2Validated = false; // Reset flag for Section 2 when going back
    } else if (edit_section4.style.display !== "none") { // Reset flag for Section 4 when going back
        Editsection4Validated = false;
    } 
}

let labelRow;
function editLabelRow(button) {
    labelRow = button.closest('tr');
    const labelText = labelRow.cells[0].innerText;
    const labelNo = button.dataset.labelNo;

    document.getElementById('edit_label').value = labelText;
    document.getElementById('edit_label_no').value = labelNo; 
    $('#editlabelModal').modal('show');
}

document.getElementById('seditlabel').addEventListener('click', function() {
    const editedLabel = document.getElementById('edit_label').value;
    const editedLabelNo = document.getElementById('edit_label_no').value;

    labelRow.cells[0].innerText = editedLabel;

    // Find existing hidden input for label_text or create a new one
    let hiddenInputText = document.querySelector(`input[name="edited_label_text[]"][value="${editedLabel}"]`);

    if (hiddenInputText) {
        hiddenInputText.previousElementSibling.value = editedLabelNo;
    } else {
        // Create new hidden inputs for label_no and label_text
        const newInputNo = document.createElement('input');
        newInputNo.type = 'hidden';
        newInputNo.name = 'edited_label_no[]';
        newInputNo.value = editedLabelNo;
        document.querySelector('form').appendChild(newInputNo);

        const newInputText = document.createElement('input');
        newInputText.type = 'hidden';
        newInputText.name = 'edited_label_text[]';
        newInputText.value = editedLabel;
        document.querySelector('form').appendChild(newInputText);
    }
    document.getElementById('edited_label_text').value = editedLabel;

    $('#editlabelModal').modal('hide');
});

function removeLabelRow(button) {
    const labelRow = button.closest('tr'); // Get the row to be removed
    const labelId = labelRow.getAttribute('data-label-id'); // Get the ID of the label to delete
    console.log("Label ID to delete: " + labelId);  // Debugging output to check if the ID is correct

    // Send an AJAX request to delete the label from the database
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_label.php', true); // Adjust the URL to your delete script
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Label deleted successfully');
            labelRow.remove();  // Remove the row from the table if deletion is successful
        } else {
            console.log('Failed to delete label');
        }
    };
    xhr.send('label_id=' + labelId); // Send the label ID to be deleted
}

function editRow(button) {
    var row = button.closest('tr');
    
    var stockNo = row.cells[0].innerText;
    var unit = row.cells[1].innerText;
    var description = row.cells[2].innerText;
    var quantity = row.cells[3].innerText;
    var unitCost = row.cells[4].innerText;
    var amount = row.cells[5].innerText;

    document.getElementById('edit_stock_no').value = stockNo;
    document.getElementById('edit_unit').value = unit; // You may want to set the correct option based on value
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_quantity').value = quantity;
    document.getElementById('edit_unit_cost').value = unitCost;
    document.getElementById('edit_amount').value = amount; // Optionally, calculate based on quantity and unit cost

    $('#editItemModal').modal('show');
}


// para ni sa item update x button
function removeRow(button, stockNo, poId) {
    if (confirm("Are you sure you want to remove this row?")) {
        // Send AJAX request to delete the item
        fetch('../purchase_order/remember.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ stock_no: stockNo, po_id: poId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the row from the table
                button.closest('tr').remove();
                
                // Renumber the rows in the frontend
                renumberRows();

                alert("Row successfully removed and renumbered.");
            } else {
                alert("Failed to remove the row. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Remove Successfully and renumbered.");
            location.reload();
        });
    }
}

function renumberRows() {
    const rows = document.querySelectorAll('.item-row');
    rows.forEach((row, index) => {
        row.querySelector('.stock-no').textContent = index + 1; 
    });
}

function getcurrentitemcount() {
    return document.getElementById('item-rows').querySelectorAll('.item-row').length;
}

let lastStockNo = 1; 
const itemRows = document.querySelectorAll('#item-rows .item-row');
if (itemRows.length > 0) {
    const lastRow = itemRows[itemRows.length - 1];
    const stockNoCell = lastRow.querySelector('td:first-child');
    lastStockNo = parseInt(stockNoCell.textContent); 
}
document.getElementById('stock_no2').value = lastStockNo + 1;

$('#additemModal').on('show.bs.modal', function() {
    document.getElementById('unit').value = '';
    document.getElementById('description').value = '';
    document.getElementById('quantity').value = '';
    document.getElementById('unit_cost').value = '';
    document.getElementById('amount').value = '';

    const nextStockNo = parseInt(document.getElementById('stock_no2').value) + 1;
    document.getElementById('stock_no2').value = nextStockNo;
  });

function additemtotable() {
    const unit = document.getElementById('unit').value;
    const description = document.getElementById('description').value;
    const quantity = document.getElementById('quantity').value;
    const unitCost = document.getElementById('unit_cost').value;

    if (unit.trim() === '' || description.trim() === '' || quantity.trim() === '' || unitCost.trim() === '') {
        alert("Please fill in all required fields.");
        return; 
    }

    const amount = (parseFloat(quantity) * parseFloat(unitCost)).toFixed(2);
    let lastStockNo = 1; 
    
    const itemRows = document.querySelectorAll('#item-rows .item-row');
    if (itemRows.length > 0) {
        const lastRow = itemRows[itemRows.length - 1];
        const stockNoCell = lastRow.querySelector('td:first-child');
        lastStockNo = parseInt(stockNoCell.textContent); 
    }

    const nextStockNo = lastStockNo + 1; 
    const newRow = document.createElement('tr');
    newRow.classList.add('item-row', 'new-item-row'); // Add the 'new-item-row' class for new items
    newRow.innerHTML = `
    <td>${nextStockNo} <input type="hidden" name="item_details[stock_no][]" value="${nextStockNo}"></td>
    <td>${unit} <input type="hidden" name="item_details[unit][]" value="${unit}"></td>
    <td>${description} <input type="hidden" name="item_details[description][]" value="${description}"></td>
    <td>${quantity} <input type="hidden" name="item_details[quantity][]" value="${quantity}"></td>
    <td>${unitCost} <input type="hidden" name="item_details[unit_cost][]" value="${unitCost}"></td>
    <td>${amount} <input type="hidden" name="item_details[amount][]" value="${amount}"></td>
    <td>
        <button type="button" class="btn btn-primary btn-sm" onclick="edititem(this)"><i class="far fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeitem(this)">X</button>
    </td>
    `;
    document.getElementById('item-rows').appendChild(newRow);

    updatetotalamount(); 
    document.getElementById('stock_no2').value = nextStockNo + 1; // Set the next stock number
    updatelabelno();

    $('#additemModal').on('hidden.bs.modal', function () {
        document.getElementById('unit').value = '';
        document.getElementById('description').value = '';
        document.getElementById('quantity').value = '';
        document.getElementById('unit_cost').value = '';
    });

    $('#additemModal').modal('hide');
}

function removeitem(button) {
    const row = button.closest('tr');

    // Check if the row is a newly added item
    if (row.classList.contains('new-item-row')) {
        row.remove();

        updateNextStockNo(); // Remove the row from the table
        updateNewItemsStockNumbers(); // Update only the stock numbers of new items
        updatetotalamount();

    } else {
        alert('This item is from the database and cannot be removed here.');
    }
}

function updateNewItemsStockNumbers() {
    const databaseItemsCount = document.querySelectorAll(".item-row:not(.new-item-row)").length; 
    let nextStockNo = databaseItemsCount + 1; // Start after the database items

    const newItemRows = document.querySelectorAll(".new-item-row");  

    newItemRows.forEach(row => {
        const stockNoCell = row.querySelector('td:first-child'); 
        const hiddenInput = stockNoCell.querySelector('input[type="hidden"]'); 

        if (stockNoCell && hiddenInput) {
            stockNoCell.childNodes[0].textContent = nextStockNo; // Update stock number in cell
            hiddenInput.value = nextStockNo; // Update hidden input value
            nextStockNo++;  
        }
    });
}

function updateNextStockNo() {
    const itemRows = document.querySelectorAll('#item-rows .item-row');
    const nextStockNo = itemRows.length > 0 ? itemRows.length + 1 : 1; // Calculate the next stock number based on remaining items
    document.getElementById('stock_no2').value = nextStockNo; // Update the next stock number in the modal input
}

function edititem (button) {
    const row = button.closest("tr"); 
    const stockNo = row.querySelector('td:first-child').textContent.trim();
    const unit = row.querySelector('td:nth-child(2)').textContent.trim();
    const description = row.querySelector('td:nth-child(3)').textContent.trim();
    const quantity = row.querySelector('td:nth-child(4)').textContent.trim();
    const unitCost = row.querySelector('td:nth-child(5)').textContent.trim();

    document.getElementById('edit_stock_no').value = stockNo;
    document.getElementById('edit_unit').value = unit;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_quantity').value = quantity;
    document.getElementById('edit_unit_cost').value = unitCost;

    const amount = (parseFloat(quantity) * parseFloat(unitCost)).toFixed(2);
    document.getElementById('edit_amount').value = amount;

    $('#editItemModal').modal('show');
}

function updateitem() {
    const stockNo = document.getElementById('edit_stock_no').value;
    const unit = document.getElementById('edit_unit').value;
    const description = document.getElementById('edit_description').value;
    const quantity = document.getElementById('edit_quantity').value;
    const unitCost = document.getElementById('edit_unit_cost').value;

    const amount = (parseFloat(quantity) * parseFloat(unitCost)).toFixed(2);

    // Find the corresponding row in the table
    const rows = document.querySelectorAll('#item-rows tr');
    let rowToUpdate = null;
    rows.forEach(row => {
        if (row.querySelector('td:first-child').textContent.trim() === stockNo) {
            rowToUpdate = row;
        }
    });

    if (rowToUpdate) {
        rowToUpdate.innerHTML = `
            <td>${stockNo} <input type="hidden" name="item_details[stock_no][]" value="${stockNo}"></td>
            <td>${unit} <input type="hidden" name="item_details[unit][]" value="${unit}"></td>
            <td>${description} <input type="hidden" name="item_details[description][]" value="${description}"></td>
            <td>${quantity} <input type="hidden" name="item_details[quantity][]" value="${quantity}"></td>
            <td>${unitCost} <input type="hidden" name="item_details[unit_cost][]" value="${unitCost}"></td>
            <td>${amount} <input type="hidden" name="item_details[amount][]" value="${amount}"></td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" onclick="editItem(this)"><i class="far fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">X</button>
            </td>
        `;
        // Update the total amount
        updatetotalamount();
    }

    // Close the Edit Item Modal
    $('#editItemModal').modal('hide');
}

// Call updatelabelno() on modal show (for the first time)
$(document).ready(function() {
  $('#addlabelModal').on('show.bs.modal', function() {
    updatelabelno(); 
  });

});

function updatelabelno() {
  const itemRows = document.querySelectorAll(".item-row"); 
  let nextStockNo = 1; 

  itemRows.forEach(row => {
    const stockNoCell = row.querySelector('td:first-child');
    const stockNo = parseInt(stockNoCell.textContent);
    if (stockNo > nextStockNo) {
      nextStockNo = stockNo; 
    }
  });

  document.getElementById("labelNo").value = nextStockNo + 1; 
}

function updatetotalamount() {
    const rows = document.querySelectorAll('#item-rows .item-row');
    let total = 0;

    rows.forEach(row => {
        const amountCell = row.querySelector('td:nth-child(6)'); 
        if (amountCell) {
            total += parseFloat(amountCell.textContent); 
        }
    });
    const totalInWords = numberToWords(Math.floor(total));
    document.getElementById('total_amount_words').value = totalInWords; 
}

function addLabel() {
    const labelText = document.getElementById("labelText").value;
    const labelNo = document.getElementById("labelNo").value;
    
    if (labelText.trim() === "") {
        alert("Please enter label text.");
        return;
    }

    const hiddenLabelNoInput = document.createElement("input");
    hiddenLabelNoInput.type = "hidden";
    hiddenLabelNoInput.name = "label_no[]"; // Use array notation for multiple labels
    hiddenLabelNoInput.value = labelNo;

    // Create a hidden input field for label_text
    const hiddenLabelTextInput = document.createElement("input");
    hiddenLabelTextInput.type = "hidden";
    hiddenLabelTextInput.name = "label_text[]"; // Use array notation for multiple labels
    hiddenLabelTextInput.value = labelText;

    const newRow = document.createElement('tr');
    newRow.classList.add('label-row');
    newRow.innerHTML = `
        <td colspan="6">${labelText} 
        <input type="hidden" name="label_text[]" value="${labelText}"> 
        <input type="hidden" name="label_no[]" value="${labelNo}"></td>
        <td>
            <button type="button" class="btn btn-primary btn-sm" onclick="editLabelRow(this)" title="Edit" data-label-no="${labelNo}">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeLabelRow(this)" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </td>
    `;

    document.querySelector('form').appendChild(hiddenLabelNoInput);
    document.querySelector('form').appendChild(hiddenLabelTextInput);   
    document.getElementById('item-rows').appendChild(newRow);
    document.getElementById("labelText").value = "";

    updatelabelno(); 

    // Close the modal
    $('#addlabelModal').modal('hide'); 
}
//------------------------------------------------------------------------REMOVE REQUESTOR
function editSelectRequestor(requestorName) {
  document.getElementById('requestor').value = requestorName;

  var selectedRequestors = document.getElementById('selectedRequestors');
  selectedRequestors.innerHTML += '<div class="selected-requestor">' + requestorName + 
                                 '<span class="remove-requestor" onclick="editRemoveRequestor(this)">x</span></div>';
  toggleDropdown(); 
}
function editRemoveRequestor(element) {
  element.parentNode.remove();
}

function editremoveRequestor(button) {
    var requestorName = button.parentNode.getAttribute('data-requestor');
    var requestorInput = document.getElementById('requestor');
    var requestors = requestorInput.value.split("/");

    var requestorBlockIndex = -1;
    for (var i = 0; i < requestors.length; i++) {
        var parts = requestors[i].split("\n");
        var blockName = parts[0];

        if (blockName === requestorName) {
            requestorBlockIndex = i;
            break;
        }
    }

    if (requestorBlockIndex > -1) {
        requestors.splice(requestorBlockIndex, 1);
    }

    requestorInput.value = requestors.join("/");
    document.getElementById('searchBox').value = requestors.join("/");

    var requisitioningOfficeInput = document.getElementById('requisitioning_office');
    var requisitioningOffices = requisitioningOfficeInput.value.split("/");
    var requisitioningOfficeIndex = requestorBlockIndex; 

    if (requisitioningOfficeIndex > -1) {
        requisitioningOffices.splice(requisitioningOfficeIndex, 1);
    }

    requisitioningOfficeInput.value = requisitioningOffices.join("/");
    button.parentNode.remove();
}

document.addEventListener('DOMContentLoaded', function() {
    var labelNoGroup = document.getElementById('labelNoGroup');
    labelNoGroup.style.display = 'none';
});

