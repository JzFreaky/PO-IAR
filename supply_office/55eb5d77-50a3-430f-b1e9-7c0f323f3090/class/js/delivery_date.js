/* SUPPLY OFFICE STAFF ARRIVED ITEMS SAVING */

document.addEventListener("DOMContentLoaded", function () {
  flatpickr("#deliveryDate", {
    dateFormat: "F j, Y", // Display format for the user
    altInput: true,
    altFormat: "F j, Y", // Alternative format displayed in the input
    dateFormat: "Y-m-d", // Actual format submitted to the server
    disableMobile: true,  
  });
});

document.getElementById('quantity').addEventListener('input', function(event) {
    // If the input value is negative, set it to 1
    if (event.target.value < 1) {
        event.target.value = 1;
    }
});

//--------------------------------------SUPPLY OFFICE STAFF ARRIVED ITEMS
function fetchStockNumbers(poNo) {
  if (!poNo) return;

  // Reset stock selection completely
  document.getElementById("selectedStockNos").value = "";
  document.getElementById("selectedQuantities").value = "";
  document.getElementById("selectedUnits").value = "";
  document.getElementById("selectedUnitCosts").value = "";
  document.getElementById("selectedAmounts").value = "";
  document.getElementById("selectedPoIds").value = "";

  document.getElementById("stockNoDropdown").innerText = "Select Stock No.";
  
  let stockMenu = document.getElementById("stockNoMenu");
  stockMenu.innerHTML = ""; // Clear previous stock list

  fetch('fetch_stock_numbers.php?po_no=' + encodeURIComponent(poNo))
    .then(response => response.json())
    .then(data => {
      if (data.length === 0) {
        stockMenu.innerHTML = '<span class="dropdown-item text-danger">No items found</span>';
        return;
      }

      data.forEach(item => {
        let checkboxId = "stock_" + item.stock_no.replace(/\s+/g, "_");

        let optionHTML = `
        <div class="form-check">
            <input class="form-check-input stock-checkbox" 
                  type="checkbox" 
                  value="${item.stock_no}" 
                  data-quantity="${item.quantity}" 
                  data-description="${item.description}" 
                  data-unit="${item.unit}" 
                  data-unit-cost="${item.unit_cost}" 
                  data-amount="${item.amount}" 
                  data-po-id="${item.po_id}" 
                  id="${checkboxId}">
            <label class="form-check-label" for="${checkboxId}">
                ${item.stock_no} - ${item.description}
            </label>
        </div>
      `;
        stockMenu.innerHTML += optionHTML;
      });

      // Add event listener to checkboxes AFTER clearing previous data
      document.querySelectorAll(".stock-checkbox").forEach(checkbox => {
        checkbox.addEventListener("change", updateSelectedStockNos);
      });
    })
    .catch(error => console.error("Error fetching stock numbers:", error));
}

// Function to reset inputs when PO No changes
document.getElementById("poNo").addEventListener("change", function() {
  let poNo = this.value;

  // Clear ALL selected values
  document.getElementById("selectedStockNos").value = "";
  document.getElementById("selectedQuantities").value = "";
  document.getElementById("selectedUnits").value = "";
  document.getElementById("selectedUnitCosts").value = "";
  document.getElementById("selectedAmounts").value = "";
  document.getElementById("selectedPoIds").value = "";

  // Reset dropdown text
  document.getElementById("stockNoDropdown").innerText = "Select Stock No.";

  // Clear the stock number menu
  let stockMenu = document.getElementById("stockNoMenu");
  stockMenu.innerHTML = "";

  // Uncheck any selected checkboxes (if they exist)
  document.querySelectorAll(".stock-checkbox:checked").forEach(checkbox => {
    checkbox.checked = false;
  });

  console.log("Stock selection reset.");
  
  // Fetch new stock numbers after resetting
  fetchStockNumbers(poNo);
});

// Function to update selected stock numbers with descriptions
function updateSelectedStockNos() {
  let selectedCheckboxes = Array.from(document.querySelectorAll(".stock-checkbox:checked"));

  let stockNumbers = selectedCheckboxes.map(cb => cb.value);
  let stockDetails = selectedCheckboxes.map(cb => `${cb.value} | ${cb.getAttribute("data-description")}`);
  let stockQuantities = selectedCheckboxes.map(cb => cb.getAttribute("data-quantity"));
  let stockUnits = selectedCheckboxes.map(cb => cb.getAttribute("data-unit"));
  let stockUnitCosts = selectedCheckboxes.map(cb => cb.getAttribute("data-unit-cost"));
  let stockAmounts = selectedCheckboxes.map(cb => cb.getAttribute("data-amount"));
  let stockPoIds = selectedCheckboxes.map(cb => cb.getAttribute("data-po-id"));

  document.getElementById("stockNoDropdown").innerText = stockNumbers.join(", ") || "Select Stock No.";
  document.getElementById("selectedStockNos").value = stockDetails.join(";;");
  document.getElementById("selectedQuantities").value = stockQuantities.join(";;");
  document.getElementById("selectedUnits").value = stockUnits.join(";;");
  document.getElementById("selectedUnitCosts").value = stockUnitCosts.join(";;");
  document.getElementById("selectedAmounts").value = stockAmounts.join(";;");
  document.getElementById("selectedPoIds").value = stockPoIds.join(";;");
}

//---------------------------------------------------------------------------------SUPPLY STAFF EDIT ITEM MODAL
function editItem(id, po_no, description, delivery_date, invoice_no) {
  document.getElementById("editItemId").value = id;
  document.getElementById("editPoNo").value = po_no;
  document.getElementById("editDescription").value = description;
  document.getElementById("editDeliveryDate").value = delivery_date;
  document.getElementById("editInvoiceNo").value = invoice_no;

  $("#editItemModal").modal("show");
}





