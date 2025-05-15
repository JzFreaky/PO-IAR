function formatDate(date) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Intl.DateTimeFormat('en-US', options).format(date);
}


flatpickr("#date1", {
    dateFormat: "F j, Y",
    defaultDate: new Date(),
    disableMobile: true,  // This forces Flatpickr to take over
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0]);
    }
});

document.querySelector("#date1").value = formatDate(new Date());


flatpickr("#date_delivery", {
    dateFormat: "F j, Y", 
    disableMobile: true,
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0]); 
    }
});

flatpickr("#supplier_date", {
    dateFormat: "F j, Y",
    disableMobile: true, 
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0]); 
    }
});

flatpickr("#ors_burs_date", {
    dateFormat: "F j, Y",
    disableMobile: true, 
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0]); 
    }
});