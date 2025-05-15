function formatDate(date) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Intl.DateTimeFormat('en-US', options).format(date);
}


flatpickr("#iar_date", {
    dateFormat: "F j, Y", 
    defaultDate: new Date(),
    disableMobile: true,
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0]); 
    }
});

document.querySelector("#iar_date").value = formatDate(new Date());

flatpickr("#invoice_date", {
    dateFormat: "F j, Y", 
    defaultDate: new Date(),
    disableMobile: true,
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0]); 
    }
});

document.querySelector("#invoice_date").value = formatDate(new Date());

flatpickr("#date_inspected", {
    dateFormat: "F j, Y", 
    defaultDate: new Date(),
    disableMobile: true,
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0]);
    }
});

document.querySelector("#date_inspected").value = formatDate(new Date());

//--------------------------------------------------INSPECTOR INSPECT MODAL
function toggleRemarks() {
    const remarksSection = document.getElementById('remarks-section');
    if (remarksSection.style.display === 'none' || remarksSection.style.display === '') {
        remarksSection.style.display = 'block';
    } else {
        remarksSection.style.display = 'none';
    }
}

function closeModal() {
    document.getElementById('modalOverlay').style.display = 'none';
    document.getElementById('itemDetailModal').style.display = 'none';
    // Optionally, reset the modal fields
    document.getElementById('remarks-section').style.display = 'none'; // Hide remarks when closing
}
