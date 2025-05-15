//-----------------------------------SAVING THE ARRIVED ITEMS
document.getElementById("saveDeliveryBtn").addEventListener("click", function () {
  let poNo = document.getElementById("poNo").value;
  let selectedStockNos = document.getElementById("selectedStockNos").value;
  let selectedQuantities = document.getElementById("selectedQuantities").value;
  let selectedPoIds = document.getElementById("selectedPoIds").value;
  let selectedAmounts = document.getElementById("selectedAmounts").value;
  let selectedUnitCosts = document.getElementById("selectedUnitCosts").value;
  let selectedUnits = document.getElementById("selectedUnits").value;
  let deliveryDate = document.getElementById("deliveryDate").value;
  let invoiceNo = document.getElementById("invoice_no").value;

  if (!poNo || !selectedStockNos || !selectedQuantities || !selectedPoIds || !selectedAmounts || !selectedUnitCosts || !selectedUnits || !deliveryDate || !invoiceNo) {
      alert("Please fill in all fields.");
      return;
  }

  let formData = new FormData();
  formData.append("poNo", poNo);
  formData.append("selectedStockNos", selectedStockNos);
  formData.append("selectedQuantities", selectedQuantities);
  formData.append("selectedPoIds", selectedPoIds);
  formData.append("selectedAmounts", selectedAmounts);
  formData.append("selectedUnitCosts", selectedUnitCosts);
  formData.append("selectedUnits", selectedUnits);
  formData.append("deliveryDate", deliveryDate);
  formData.append("invoice_no", invoiceNo);

  fetch("save_arrived_items.php", {
      method: "POST",
      body: formData
  })
  
  .then(response => response.json())
    .then(data => {
        if (data.success) {
            localStorage.setItem("deliveryMessage", data.message); 
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});

// Display success message after reload
document.addEventListener("DOMContentLoaded", function () {
    let message = localStorage.getItem("deliveryMessage");
    if (message) {
        let container = document.getElementById("delivered_container");
        if (container) {
            container.innerHTML = `<div class="success-message alert alert-success">${message}</div>`;
            setTimeout(() => {
                container.innerHTML = ""; 
            }, 3000);
        }
        localStorage.removeItem("deliveryMessage"); 
    }
});

//-------------------------------SAVEING THE EDITED ITEM
function saveEditedItem() {
    let formData = new FormData(document.getElementById("editItemForm"));

    fetch("update_arrived_item.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            localStorage.setItem("editMessage", data.message); 
                location.reload(); 
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
}

// Display success message after reload
document.addEventListener("DOMContentLoaded", function () {
    let message = localStorage.getItem("editMessage");
    if (message) {
        let container = document.getElementById("edit_delivered");
        if (container) {
            container.innerHTML = `<div class="success-message alert alert-success">${message}</div>`;
            setTimeout(() => {
                container.innerHTML = ""; 
            }, 3000);
        }
        localStorage.removeItem("editMessage"); 
    }
});

//-------------------------------DELETING ITEM
function openDeleteModal(itemId) {
    document.getElementById('deleteItemId').value = itemId;
    $('#deleteItemModal').modal('show'); 
}

function confirmDelete() {
    let itemId = document.getElementById('deleteItemId').value;

    fetch('delete_item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + itemId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            localStorage.setItem("deleteMessage", data.message); 
                location.reload(); 
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
}

// Display success message after reload
document.addEventListener("DOMContentLoaded", function () {
    let message = localStorage.getItem("deleteMessage");
    if (message) {
        let container = document.getElementById("delete_delivered");
        if (container) {
            container.innerHTML = `<div class="success-message alert alert-success">${message}</div>`;
            setTimeout(() => {
                container.innerHTML = ""; 
            }, 3000);
        }
        localStorage.removeItem("deleteMessage"); 
    }
});


