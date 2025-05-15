//----------------------------------DROPDOWN
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

/* ------------------------------CREATING PURCHASE ORDER*/
function addItemRow() {
    const tableBody = document.getElementById('item-rows');
    const newRow = document.createElement('tr');

    newRow.innerHTML = `
        <td><input type="text" name="stock_no[]" required></td>
        <td><input type="text" name="unit[]" required></td>
        <td><input type="text" name="description[]" required></td>
        <td><input type="number" name="quantity[]" required></td>
        <td><input type="number" name="unit_cost[]" required></td>
        <td><input type="number" name="amount[]" required></td>
    `;

    tableBody.appendChild(newRow);
}

/*--------------------------------------PO DATABLE FUNC*/
$(document).ready(function() {
    $('#purchaseOrdersTable').DataTable({
        "order": [[0, "desc"]]  // Sort by the first column (PO No.) ascending
    });
});

/*--------------------------------------IAR DATABLE FUNC*/
$(document).ready(function() {
    $('#iarTable').DataTable({
        "order": [[0, "desc"]]  // Sort by the first column (PO No.) ascending
    });
});

$(document).ready(function() {
    $('#accountsTable').DataTable();
});

/*--------------------------------------END USERS TABLE*/
$(document).ready(function() {
    $('#endUsersTable').DataTable();
});
/*--------------------------------------UACS TABLE*/
$(document).ready(function() {
    $('#uacsTable').DataTable();
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

// --------------------------BURGER MENU
document.getElementById('burgerMenu').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
});



// --------------------------ACCOUNT TRAILS TABLE
$(document).ready(function() {
    $('#pologinlogsTable').DataTable();
});

$(document).ready(function() {
    $('#pocreationlogsTable').DataTable();
});

$(document).ready(function() {
    $('#poupdatelogsTable').DataTable();
});

$(document).ready(function() {
    $('#sologinlogsTable').DataTable();
});

$(document).ready(function() {
    $('#iarcreationlogsTable').DataTable();
});

$(document).ready(function() {
    $('#iarupdatelogsTable').DataTable();
});

// --------------------------DELETE MODALS
document.addEventListener('DOMContentLoaded', function() {
    var deleteEndUserModal = document.getElementById("deleteEndUserModal");
    var confirmEndUserDeleteButton = document.getElementById("confirmEndUserDelete");

    document.querySelectorAll('a[data-toggle="modal"][data-target="#deleteEndUserModal"]').forEach(function(button) {
      button.addEventListener('click', function() {
        var deleteId = this.getAttribute('data-delete-id');
        confirmEndUserDeleteButton.href = "?delete_end_user_id=" + deleteId;
      });
    });
  });

document.addEventListener('DOMContentLoaded', function() {
    var deleteUACSModal = document.getElementById("deleteUACSModal"); // Use the same ID as the modal
    var confirmUACSDeleteButton = document.getElementById("confirmUACSDelete");

    document.querySelectorAll('a[data-toggle="modal"][data-target="#deleteUACSModal"]').forEach(function(button) {
      button.addEventListener('click', function() {
        var deleteId = this.getAttribute('data-delete-id');
        confirmUACSDeleteButton.href = "?delete_uacs_id=" + deleteId;
      });
    });
  });
  