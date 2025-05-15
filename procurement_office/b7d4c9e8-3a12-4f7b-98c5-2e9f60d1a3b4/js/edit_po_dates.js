function formatDate(date) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Intl.DateTimeFormat('en-US', options).format(date);
}


flatpickr("#date", {
    dateFormat: "F j, Y",
    disableMobile: true,
    defaultDate: new Date(document.querySelector("#date").value),
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0], "MMM d, Y"); // Format date as requested
    }
});



flatpickr("#date_delivery", {
    dateFormat: "F j, Y",
    disableMobile: true,
    defaultDate: new Date(document.querySelector("#date_delivery").value),
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0], "MMM d, Y"); // Format date as requested
    }
});

flatpickr("#supplier_date", {
    dateFormat: "F j, Y",
    disableMobile: true,
    defaultDate: new Date(document.querySelector("#supplier_date").value),
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0], "MMM d, Y"); // Format date as requested
    }
});

flatpickr("#ors_burs_date", {
    dateFormat: "F j, Y",
    disableMobile: true,
    defaultDate: new Date(document.querySelector("#ors_burs_date").value),
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0], "MMM d, Y"); // Format date as requested
    }
});