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

//-------------------------------------------------------CALCULATE AMOUNTXQUANTITY
function calculateAmount(inputElement) {
    let row = inputElement.closest('tr'); 
    let quantity = row.querySelector('input[name="quantity[]"]').value;
    let unitCost = row.querySelector('input[name="unit_cost[]"]').value;
    
    if (quantity && unitCost) {
        let amount = quantity * unitCost;
        let roundedAmount = parseFloat(amount).toFixed(2); 
        row.querySelector('input[name="amount[]"]').value = roundedAmount; 
    } else {
        row.querySelector('input[name="amount[]"]').value = ''; 
    }
}
/*-----------------------------------------------DATABLE FUNC*/
$(document).ready(function() {
    $('#purchaseOrdersTable').DataTable({
        "order": [[0, "desc"]]  // Sort by the first column (PO No.) ascending
    });
});

function validateInput(input) {
    if (input.value < 1) {
        input.value = '';
    }
}

//-------------------------------------------------------BURGER MENU
document.getElementById('burgerMenu').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
});
//-----------------------------------------------------------------REQUISITIONING OFFICE INPUT
const selectItems = document.getElementById('selectItems');
const searchBox = document.getElementById('searchBox');
const requestorInput = document.getElementById('requestor');
const selectedRequestorsContainer = document.getElementById('selectedRequestors');
const requisitioningOfficeInput = document.getElementById('requisitioning_office'); 
const requestorCount = document.querySelector('.requestor-count');

var selectedRequestors = [];

function toggleSmallBox() {
    const smallBox = document.getElementById('smallBox');
    smallBox.style.display = smallBox.style.display === 'block' ? 'none' : 'block';
}
function selectRequestor(requestor) {
    const requestorElement = document.createElement('div');
    requestorElement.classList.add('selected-requestor');
    requestorElement.innerHTML = `
        <span>${requestor}</span>
        <span class="remove-requestor" onclick="removeRequestor('${requestor}')">x</span>
    `;

    selectedRequestorsContainer.appendChild(requestorElement);

    const currentRequestors = requestorInput.value ? requestorInput.value.split('/') : [];
    if (!currentRequestors.includes(requestor)) {
        currentRequestors.push(requestor);
        requestorInput.value = currentRequestors.join('/');
    }
    updateCounter();
}

function removeRequestor(requestor) {
    const requestorElements = selectedRequestorsContainer.querySelectorAll('.selected-requestor');
    let updatedRequestors = []; 
    let updatedRequisitioningOffices = [];
    let requisitioningOfficeInputValue = requisitioningOfficeInput.value.split('/');
    let requestorInputValue = requestorInput.value.split('/');

    requestorElements.forEach((element, index) => {
        const currentRequestor = element.querySelector('span').textContent;
        if (currentRequestor === requestor) {
            selectedRequestorsContainer.removeChild(element);
        } else {
            updatedRequestors.push(currentRequestor);
            updatedRequisitioningOffices.push(requisitioningOfficeInputValue[index]);
        }
    });

    requestorInput.value = updatedRequestors.join('/');
    requisitioningOfficeInput.value = updatedRequisitioningOffices.join('/');
    updateCounter();
}

function toggleDropdown() {
    selectItems.style.display = selectItems.style.display === 'block' ? 'none' : 'block';
}

function toggleSmallBox() {
    const smallBox = document.getElementById('smallBox');
    smallBox.style.display = smallBox.style.display === 'block' ? 'none' : 'block';
}

document.addEventListener('click', function(event) {
    const smallBox = document.getElementById('smallBox');
    const dotIcon = document.querySelector('.dot-icon');
    
    if (!smallBox.contains(event.target) && !dotIcon.contains(event.target)) {
        smallBox.style.display = 'none';
    }
});

function filterItems() {
    const filter = searchBox.value.toLowerCase();
    const items = selectItems.querySelectorAll('div');
    let found = false;

    items.forEach(item => {
        const words = item.textContent.toLowerCase().split(' ');

        // Check if any word in the item matches the filter
        let matchFound = words.some(word => word.includes(filter));

        if (matchFound) {
            item.style.display = ''; 
            found = true;
        } else {
            item.style.display = 'none'; 
        }
    });

    selectItems.style.display = found ? 'block' : 'none';
}

searchBox.addEventListener('input', function() {
    let inputValue = this.value;
    let lastSlashIndex = inputValue.lastIndexOf('/');

    if (lastSlashIndex !== -1) {
        inputValue = inputValue.substring(lastSlashIndex + 1);
    }

    if (inputValue === '') {
        selectItems.style.display = 'none';
        return;
    }

    filterItems();
});

document.querySelectorAll('.select-items div').forEach(item => {
    item.addEventListener('click', function() {
        const value = this.getAttribute('data-value');
        const endUserName = this.textContent.split(' - ')[0]; 

        if (requestorInput.value) {
            requestorInput.value += '/' + value;
        } else {
            requestorInput.value = value;
        }
        searchBox.value = endUserName; 

        if (requisitioningOfficeInput.value) {
            requisitioningOfficeInput.value += '/' + this.textContent.split(' - ')[1]; 
        } else {
            requisitioningOfficeInput.value = this.textContent.split(' - ')[1];
        }

        selectItems.style.display = 'none'; 
    });
});

function updateCounter() {
    const selectedRequestorsCount = selectedRequestorsContainer.querySelectorAll('.selected-requestor').length;
    const dotIcon = document.querySelector('.dot-icon');
    const requestorCountSpan = document.querySelector('.requestor-count');

    if (selectedRequestorsCount > 0) {
        requestorCountSpan.textContent = selectedRequestorsCount;
        requestorCountSpan.style.display = 'block'; // Make the counter visible
    } else {
        requestorCountSpan.textContent = ''; // Clear the counter
        requestorCountSpan.style.display = 'none'; // Hide the counter
    }
}

const form = document.querySelector('form'); 
form.addEventListener('submit', function(event) {
    const selectedRequestors = requestorInput.value;
});

//---------------------------------------------------------PO ADD ITEM
document.getElementById('quantity').addEventListener('input', calculateAmount);
document.getElementById('unit_cost').addEventListener('input', calculateAmount);

function calculateAmount() {
    const quantity = parseFloat(document.getElementById('quantity').value) || 0;
    const unitCost = parseFloat(document.getElementById('unit_cost').value) || 0;
    const amount = quantity * unitCost;
    document.getElementById('amount').value = amount;
}

document.getElementById('edit_quantity').addEventListener('input', calculateEditAmount);
document.getElementById('edit_unit_cost').addEventListener('input', calculateEditAmount);

function calculateEditAmount() {
    const quantity = parseFloat(document.getElementById('edit_quantity').value) || 0;
    const unitCost = parseFloat(document.getElementById('edit_unit_cost').value) || 0;
    const amount = quantity * unitCost;
    document.getElementById('edit_amount').value = amount;
}

function getCurrentItemCount() {
    return document.getElementById('item-rows').querySelectorAll('.item-row').length;
}

document.getElementById('stock_no').value = 1;

$('#addItemModal').on('show.bs.modal', function() {
    document.getElementById('unit').value = '';
    document.getElementById('description').value = '';
    document.getElementById('quantity').value = '';
    document.getElementById('unit_cost').value = '';
    document.getElementById('amount').value = '';
  });

function addItemToTable() {
    const stockNo = document.getElementById('stock_no').value;
    const unit = document.getElementById('unit').value;
    const description = document.getElementById('description').value;
    const quantity = document.getElementById('quantity').value;
    const unitCost = document.getElementById('unit_cost').value;

    if (stockNo.trim() === '' || unit.trim() === '' || description.trim() === '' || quantity.trim() === '' || unitCost.trim() === '') {
        alert("Please fill in all required fields.");
        return; 
    }

    const amount = (parseFloat(quantity) * parseFloat(unitCost)).toFixed(2);

    const newRow = document.createElement('tr');
    newRow.classList.add('item-row');
    newRow.innerHTML = `
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

    document.getElementById('item-rows').appendChild(newRow);
    updateTotalAmount();

    const currentItemCount = getCurrentItemCount();
    document.getElementById('stock_no').value = currentItemCount + 1;

    updateLabelNo();

    $('#addItemModal').on('hidden.bs.modal', function () {
        document.getElementById('unit').value = '';
        document.getElementById('description').value = '';
        document.getElementById('quantity').value = '';
        document.getElementById('unit_cost').value = '';
    });

    $('#addItemModal').modal('hide');
}

function removeItem(button) {
    const row = button.closest("tr"); 
    if (row) {
        row.remove(); 
    }

    updateStockNumbers(); 

    if (typeof updateTotalAmount === "function") {
        updateTotalAmount();  
    }

    if (typeof updateLabelNo === "function") {
        updateLabelNo(); 
    }
}

//-------------------------------------------------UPDATE STOCK/PROPERTY NO.
function updateStockNumbers() {
    const rows = document.querySelectorAll('.item-row');
    rows.forEach((row, index) => {
        const stockNoCell = row.children[0];
        const stockNoInput = stockNoCell.querySelector('input[type="hidden"]');

        const newStockNo = index + 1; // Sequential numbering
        stockNoCell.innerHTML = `${newStockNo} <input type="hidden" name="item_details[stock_no][]" value="${newStockNo}">`;
    });

    // Update the stock_no input field for the next item
    const currentItemCount = getCurrentItemCount();
    document.getElementById('stock_no').value = currentItemCount + 1;
}

function editItem(button) {
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

        // Calculate and set the edit_amount
        const amount = (parseFloat(quantity) * parseFloat(unitCost)).toFixed(2);
        document.getElementById('edit_amount').value = amount;

        // Open the Edit Item Modal
        $('#editItemModal').modal('show');
    }

    function updateItem() {
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
            updateTotalAmount();
        }
        $('#editItemModal').modal('hide');
    }

function updateLabelNo() {
    const itemRows = document.querySelectorAll(".item-row");
    const nextStockNo = itemRows.length + 1;
    document.getElementById("labelNo").value = nextStockNo;
}

function updateTotalAmount() {
    const rows = document.querySelectorAll('#item-rows tr');
    let total = 0;

    rows.forEach(row => {
        const amountCell = row.querySelector('td:nth-child(6) input[type="hidden"]');
        if (amountCell) {
            total += parseFloat(amountCell.value);
        }
    });

    const totalInWords = numberToWords(Math.floor(total));
    document.getElementById('total_amount_words').value = totalInWords; 
}

/*--------------------------------------------------------------------------LABEL MODAL*/ 
let labelCounter = 1; 
let currentLabelRow; 

function addLabelToTable() {
    const labelText = document.getElementById('labelText').value;

    if (labelText) {
        const tableBody = document.getElementById('item-rows');
        const row = document.createElement('tr');

        // Create a label cell
        const labelCell = document.createElement('td');
        labelCell.colSpan = 6;
        labelCell.innerText = labelText;
        labelCell.id = `label_text_${labelCounter}`; 
        row.appendChild(labelCell);

        const actionCell = document.createElement('td');

        // Create the edit button
        const editButton = document.createElement('button');
        editButton.type = 'button'; // Prevent form submission
        editButton.className = 'btn btn-primary btn-sm';
        editButton.innerHTML = '<i class="fas fa-edit"></i>'; 

        editButton.onclick = function () {
            currentLabelRow = row; 
            document.getElementById('editLabelText').value = labelText; 
            $('#editLabelModal').modal('show'); 
        };
        actionCell.appendChild(editButton);

        editButton.style.marginRight = '5px';

        // Create the remove button
        const removeButton = document.createElement('button');
        removeButton.className = 'btn btn-danger btn-sm';
        removeButton.innerText = 'X';
        removeButton.onclick = function () {
            // Remove the row from the table
            row.remove();
        
            // Remove the associated hidden inputs using unique identifiers
            const hiddenInput = document.querySelector(`input[name="label_text[]"][data-row-id="${row.dataset.rowId}"]`);
            const hiddenLabelNoInput = document.querySelector(`input[name="label_no[]"][data-row-id="${row.dataset.rowId}"]`);
        
            if (hiddenInput) hiddenInput.remove();
            if (hiddenLabelNoInput) hiddenLabelNoInput.remove();
        };
        
        
        actionCell.appendChild(removeButton);
        row.appendChild(actionCell);

        tableBody.appendChild(row);

        document.getElementById('labelText').value = '';
        $('#addLabelModal').modal('hide');

        const nextStockNo = getNextStockNo();

        const uniqueId = Date.now(); // Generate a unique identifier

        // Set a unique identifier for the row
        row.dataset.rowId = uniqueId;

        // Create the hidden input for label text
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'label_text[]';
        hiddenInput.dataset.rowId = uniqueId; // Link to the row
        hiddenInput.value = labelText;

        // Create the hidden input for label number
        const hiddenLabelNoInput = document.createElement('input');
        hiddenLabelNoInput.type = 'hidden';
        hiddenLabelNoInput.name = 'label_no[]';
        hiddenLabelNoInput.dataset.rowId = uniqueId; // Link to the row
        hiddenLabelNoInput.value = nextStockNo;

        // Append hidden inputs to the form
        document.querySelector('form').appendChild(hiddenInput);
        document.querySelector('form').appendChild(hiddenLabelNoInput);


        labelCounter++; 
    } else {
        alert("Please enter a label text.");
    }
}

// Function to get the next available stock number from item rows
function getNextStockNo() {
    const itemRows = document.querySelectorAll('.item-row'); // Assuming these rows have class 'item-row'
    const existingStockNos = Array.from(itemRows).map(row => parseInt(row.querySelector('input[name="item_details[stock_no][]"]').value));
    const maxStockNo = existingStockNos.length > 0 ? Math.max(...existingStockNos) : 0;
    return maxStockNo + 1; 
}

// Function to save the edited label
document.getElementById('saveEditLabel').onclick = function (event) {
    event.preventDefault(); 
    const newLabelText = document.getElementById('editLabelText').value;
    if (newLabelText) {
        currentLabelRow.cells[0].innerText = newLabelText; 
        const hiddenInput = document.getElementById(`label_text_hidden_${currentLabelRow.cells[0].id.split('_')[2]}`);
        if (hiddenInput) {
            hiddenInput.value = newLabelText; 
        }

        $('#editLabelModal').modal('hide'); 
    } else {
        alert("Please enter a label text.");
    }
};

function getNextLabelNo() {
    const itemRows = document.querySelectorAll('.item-row');
    const existingStockNos = Array.from(itemRows).map(row => parseInt(row.querySelector('input[name="item_details[stock_no][]"]').value));
    const maxStockNo = existingStockNos.length > 0 ? Math.max(...existingStockNos) : 0;
    return maxStockNo + 1; 
}

document.addEventListener('DOMContentLoaded', function() {
    var labelNoGroup = document.getElementById('labelNoGroup');
    labelNoGroup.style.display = 'none';
});

document.addEventListener("DOMContentLoaded", function() {
    updateLabelNo(); 
});

function numberToWords(num) {
    if (num === 0) return 'ZERO PESOS';

    const belowTwenty = [
        'ZERO', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE',
        'TEN', 'ELEVEN', 'TWELVE', 'THIRTEEN', 'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 
        'SEVENTEEN', 'EIGHTEEN', 'NINETEEN'
    ];
    const tens = [
        '', '', 'TWENTY', 'THIRTY', 'FORTY', 'FIFTY', 'SIXTY', 'SEVENTY', 'EIGHTY', 'NINETY'
    ];
    const thousands = ['', 'THOUSAND', 'MILLION', 'BILLION'];

    let words = '';
    let i = 0;

    function helper(n) {
        let result = ''; 
        if (n < 20) {
            result += belowTwenty[n] + ' ';
        } else if (n < 100) {
            result += tens[Math.floor(n / 10)] + ' ' + (n % 10 !== 0 ? belowTwenty[n % 10] + ' ' : '');
        } else if (n < 1000) {
            result += belowTwenty[Math.floor(n / 100)] + ' HUNDRED ';
            // Only add "ZERO" if the tens place is not zero
            result += (n % 100 !== 0) ? helper(n % 100) : ''; 
        }
        return result; 
    }

    while (num > 0) {
        const chunk = num % 1000;
        if (chunk > 0) {
            words = helper(chunk) + thousands[i] + ' ' + words; 
        }
        num = Math.floor(num / 1000);
        i++;
    }
    return words.trim() + ' PESOS'; 
}

//---------------------------------------------------------REQUESTOR
function validateSection1() {
    var requestor = document.getElementById("requestor").value;
    var requisitioningOffice = document.getElementById("requisitioning_office").value;
    var supplier = document.getElementById("supplier").value;
    var address = document.getElementById("address").value;
    var date1 = document.getElementById("date1").value;
    var tin = document.getElementById("tin").value; // Optional, can be removed if not required
    var modeProcurement = document.getElementById("mode_procurement").value;

    // TIN validation check (9 or 12 digits)
    var tinPattern = /^\d{3}-\d{3}-\d{3}(-\d{3})?$/;
    if (tin && !tinPattern.test(tin)) {
        document.getElementById("section1Error").innerHTML = '<div class="alert alert-danger">TIN must be in the format 123-456-789 or 123-456-789-000.</div>';
        return false;
    }

    // General validation for other fields
    if (requestor && requisitioningOffice && supplier && address && date1 && modeProcurement) {
        return true; 
    } else {
        document.getElementById("section1Error").innerHTML = '<div class="alert alert-danger">Please fill in all required fields.</div>';
        return false; 
    }
}


function validateSection2() {
    var placeDelivery = document.getElementById("place_delivery").value;
    var deliveryTerm = document.getElementById("delivery_term").value;
    var paymentTerm = document.getElementById("payment_term").value;

    if (placeDelivery && deliveryTerm && paymentTerm) {
        return true;
    } else {
        document.getElementById("section2Error").innerHTML = '<div class="alert alert-danger">Please fill in all required fields.</div>';
        return false;
    }
}

function validateSection4() {
    var signatureOfficial = document.getElementById("signature_official").value;
    var designation = document.getElementById("designation").value;

    if ( signatureOfficial && designation) {
        return true;
    } else {
        // Display error message in a div
        document.getElementById("section4Error").innerHTML = '<div class="alert alert-danger">Please fill in all required fields.</div>';
        return false;
    }
}

let section1Validated = false;
let section2Validated = false;
let section4Validated = false;

function showNextSection() {
    if (section1.style.display !== "none" && (section1Validated || validateSection1())) {
        section1Validated = true;
        section1.style.display = "none";
        section2.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
        // Clear error message for Section 1
        document.getElementById("section1Error").innerHTML = "";
    } else if (section2.style.display !== "none" && (section2Validated || validateSection2())) {
        section2Validated = true;
        section2.style.display = "none";
        section3.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
        // Clear error message for Section 2
        document.getElementById("section2Error").innerHTML = "";
    } else if (section3.style.display !== "none") {
        section3.style.display = "none";
        section4.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
    } else if (section4.style.display !== "none" && (section4Validated || validateSection4())) { // Validate Section 4
        section4Validated = true; 
        section4.style.display = "none";
        section5.style.display = "block";
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

function showPreviousSection() {
    var section1 = document.getElementById("section1");
    var section2 = document.getElementById("section2");
    var section3 = document.getElementById("section3");
    var section4 = document.getElementById("section4");
    var section5 = document.getElementById("section5");
    var nextButton = document.getElementById("nextButton");
    var submitButton = document.getElementById("submitButton");
    var backButton = document.getElementById("backButton");

    if (section5.style.display !== "none") {
        section5.style.display = "none";
        section4.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
    } else if (section4.style.display !== "none") {
        section4.style.display = "none";
        section3.style.display = "block";
        nextButton.style.display = "block";
        submitButton.style.display = "none";
        backButton.style.display = "block";
    } else if (section3.style.display !== "none") {
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
    } else if (section2.style.display !== "none") {
        section2Validated = false; // Reset flag for Section 2 when going back
    } else if (section4.style.display !== "none") { // Reset flag for Section 4 when going back
        section4Validated = false;
    } 
}

//-------------------------------------------------PROJECT DESCRIPTION
function updateProjectDescriptions() {
    const fundType = document.getElementById('fundType').value;
    const projectDescriptionsDataList = document.getElementById('projectDescriptions');
    projectDescriptionsDataList.innerHTML = '<option value="">Select Project Description</option>'; 
  
    if (fundType === 'IGF') {
      // Access the JSON string using a global variable
      projectDescriptionsDataList.innerHTML += igfOptionsJSON; 
    } else if (fundType === 'RAF') {
      projectDescriptionsDataList.innerHTML += rafOptionsJSON; 
    }
  }
  
  // Event listener for fund type selection
  document.getElementById('fundType').addEventListener('change', updateProjectDescriptions);

//-------------------------------------------------PROJECT DESCRIPTION
  function checkProjectDescription() {
    const tableRows = document.getElementById('item-rows').querySelectorAll('tr');
    let hasProjectDescription = false;

    for (const row of tableRows) {
      const descriptionCell = row.querySelector('td:nth-child(3)'); // Assuming description is in the 3rd column
      if (descriptionCell.textContent.trim() !== "") {
        hasProjectDescription = true;
        break;
      }
    }

    if (!hasProjectDescription) {
      document.getElementById("project-description-error").innerHTML = '<div class="alert alert-danger">Please add a project description before adding an item.</div>';
      document.getElementById("project-description-error").style.display = "block"; // Show the error message

      setTimeout(function() {
        document.getElementById("project-description-error").style.display = "none";
      }, 3000);

      // Stop the modal from opening
      event.stopPropagation();
      event.preventDefault();
      return false;
    } else {
      document.getElementById("project-description-error").style.display = "none"; 
    }
  }

  function formatTIN(input) {
    let value = input.value.replace(/\D/g, '');
    
    if (value.length <= 9) {
        input.value = value.replace(/(\d{3})(\d{3})(\d{3})/, '$1-$2-$3');
    } else if (value.length <= 12) {
        input.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{3})/, '$1-$2-$3-$4');
    }
}

//------------------------------------------------------------------ITEM SPECIFICATIONS
function setItemNo() {
    var table = document.getElementById('item-rows');  // Replace with your table ID
    var rows = table.getElementsByTagName('tr'); // Get all rows in the table
    var lastStockNo = 0;
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        
        if (cells.length > 0) {
            var stockNo = parseInt(cells[0].textContent || cells[0].innerText);
            
            if (stockNo > lastStockNo) {
                lastStockNo = stockNo;
            }
        }
    }

    document.getElementById('item_no').value = lastStockNo;
}

$('#addItemSpecificationModal').on('show.bs.modal', function (event) {
    setItemNo();
});

// Function to save Item Specification
function saveItemSpecification() {
    var itemSpecification = document.getElementById("item_specification").value;
    var itemNo = document.getElementById('item_no').value;

    if (!itemSpecification.trim()) {
        alert("Item Specification cannot be empty.");
        return;
    }

    var tableBody = document.getElementById("item-rows");
    var newRow = document.createElement("tr");

    // Assign a unique index to the row
    var rowIndex = tableBody.rows.length; 
    newRow.setAttribute('data-row-index', rowIndex);

    // Create cells for the new row
    var stockNoCell = document.createElement("td");
    var unitCell = document.createElement("td");
    var descriptionCell = document.createElement("td");
    var quantityCell = document.createElement("td");
    var unitCostCell = document.createElement("td");
    var amountCell = document.createElement("td");
    var actionCell = document.createElement("td");

    // Set content for the cells
    descriptionCell.textContent = itemSpecification;

    // Append the cells to the new row
    newRow.appendChild(stockNoCell);
    newRow.appendChild(unitCell);
    newRow.appendChild(descriptionCell);
    newRow.appendChild(quantityCell);
    newRow.appendChild(unitCostCell);
    newRow.appendChild(amountCell);

    // Create Edit and Remove buttons
    var editButton = document.createElement("button");
    editButton.type = 'button';
    editButton.className = "btn btn-sm btn-primary edit-button";
    editButton.innerHTML = '<i class="fas fa-edit"></i>';
    editButton.addEventListener('click', function () {
        editItemSpecification(this);
    });

    editButton.style.marginRight = '5px';

    var removeButton = document.createElement("button");
    removeButton.className = "btn btn-danger btn-sm";
    removeButton.innerHTML = 'X'; 
    removeButton.addEventListener('click', function () {
        removeItemSpecification(this);
    });

    actionCell.appendChild(editButton);
    actionCell.appendChild(removeButton);
    newRow.appendChild(actionCell);

    // Append the new row to the table body
    tableBody.appendChild(newRow);

    // Create and append hidden inputs with the same `data-row-index`
    var hiddenInputSpec = document.createElement("input");
    hiddenInputSpec.type = "hidden";
    hiddenInputSpec.name = "item_details[item_specification][]";
    hiddenInputSpec.value = itemSpecification;
    hiddenInputSpec.setAttribute('data-row-index', rowIndex);

    var hiddenInputItemNo = document.createElement("input");
    hiddenInputItemNo.type = "hidden";
    hiddenInputItemNo.name = "item_details[item_no][]";
    hiddenInputItemNo.value = itemNo;
    hiddenInputItemNo.setAttribute('data-row-index', rowIndex);

    document.querySelector('form').appendChild(hiddenInputSpec);
    document.querySelector('form').appendChild(hiddenInputItemNo);

    // Hide the modal and reset input fields
    $('#addItemSpecificationModal').modal('hide');
    document.getElementById("item_specification").value = "";
    document.getElementById("item_no").value = "";
}


// Function to edit item specification
function editItemSpecification(button) {
    var row = button.parentNode.parentNode; 
    var itemSpec = row.querySelector('td:nth-child(3)').textContent; 

    // Populate the modal input fields
    document.getElementById('edit_item_specification').value = itemSpec;

    window.editingRow = row;
    $('#editItemSpecificationModal').modal('show');
}


function removeItemSpecification(button) {
    var row = button.parentNode.parentNode; 
    row.parentNode.removeChild(row); 

    var itemSpec = row.querySelector('td:nth-child(3)').textContent; // Get item specification
    var hiddenInputs = document.querySelectorAll('input[name="item_details[item_specification][]"]');
    
    hiddenInputs.forEach(input => {
        if (input.value === itemSpec) {
            input.parentNode.removeChild(input); 
        }
    });
}

function saveEditItemSpecification() {
    var updatedItemSpec = document.getElementById('edit_item_specification').value;

    if (!updatedItemSpec.trim()) {
        alert("Item Specification cannot be empty.");
        return;
    }

    var row = window.editingRow;
    row.querySelector('td:nth-child(3)').textContent = updatedItemSpec;

    var rowIndex = row.getAttribute('data-row-index');
    var hiddenInputSpec = document.querySelector(`input[name="item_details[item_specification][]"][data-row-index="${rowIndex}"]`);

    if (hiddenInputSpec) {
        hiddenInputSpec.value = updatedItemSpec; 
    }

    $('#editItemSpecificationModal').modal('hide');
    window.editingRow = null;
}

//---------------------------------------------------------------LOGOUT NAVBAR
document.getElementById('logoutLink').addEventListener('click', function(event) {
    event.preventDefault();
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'config.php';
    
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'logout';
    form.appendChild(input);
    
    document.body.appendChild(form);
    form.submit();
});


