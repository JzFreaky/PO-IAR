//----------------------------------------------------------------------------PROP FLATPICKR DATES
flatpickr("#piar_date", {
    dateFormat: "F j, Y",
    disableMobile: true,
    defaultDate: new Date(document.querySelector("#piar_date").value),
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0], "MMM d, Y"); // Format date as requested
    }
});

flatpickr("#pinvoice_date", {
    dateFormat: "F j, Y",
    disableMobile: true,
    defaultDate: new Date(document.querySelector("#pinvoice_date").value),
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0], "MMM d, Y"); // Format date as requested
    }
});

flatpickr("#pdate_received", {
    dateFormat: "F j, Y",
    disableMobile: true, 
    defaultDate: new Date(document.querySelector("#pdate_received").value),
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0], "MMM d, Y"); // Format date as requested
     }
}); 

flatpickr("#date_received", {
    dateFormat: "F j, Y", 
    defaultDate: new Date(),
    disableMobile: true,
    onChange: function(selectedDates, dateStr, instance) {
        instance.input.value = formatDate(selectedDates[0]);
    }
});

document.querySelector("#date_received").value = formatDate(new Date());  

//----------------------------------------------------------------------------CONFIRM BUTTON
function confirmStatus() {
  $('#confirmModal').modal('show');
}
function submitForm() {
  var inspStatus = document.getElementById("insp_status").value;

  var propertyCustodianStatus = "";
  if (inspStatus === "partial") {
      propertyCustodianStatus = "partial";
  } else if (inspStatus === "complete") {
      propertyCustodianStatus = "complete";
  }

  // Update the hidden input value for property_custodian_status
  document.getElementById("property_custodian_status").value = propertyCustodianStatus;

  // Submit the form
  document.getElementById("inspectionForm").submit();
}


//----------------------------------------------------------------------------PENDING PAGE NEXT
function showNextSection() {
    var section1 = document.getElementById("section1");
    var section2 = document.getElementById("section2");
    var section3 = document.getElementById("section3");
    var nextButton = document.getElementById("nextButton");
    var confirmButton = document.getElementById("confirmButton");
    var backButton = document.getElementById("backButton");
  
    if (section1.style.display !== "none") {
      section1.style.display = "none";
      section2.style.display = "block";
      nextButton.style.display = "block";
      confirmButton.style.display = "none";
      backButton.style.display = "block";
    } else if (section2.style.display !== "none") {
      section2.style.display = "none";
      section3.style.display = "block";
      nextButton.style.display = "none";
      confirmButton.style.display = "block";
      backButton.style.display = "block";
    }
  }
  
  function showPreviousSection() {
    var section1 = document.getElementById("section1");
    var section2 = document.getElementById("section2");
    var section3 = document.getElementById("section3");
    var nextButton = document.getElementById("nextButton");
    var confirmButton = document.getElementById("confirmButton");
    var backButton = document.getElementById("backButton");
  
    if (section3.style.display !== "none") {
      section3.style.display = "none";
      section2.style.display = "block";
      nextButton.style.display = "block";
      confirmButton.style.display = "none";
      backButton.style.display = "block";
    } else if (section2.style.display !== "none") {
      section2.style.display = "none";
      section1.style.display = "block";
      nextButton.style.display = "block";
      confirmButton.style.display = "none";
      backButton.style.display = "none";
    }
  }
  

//----------------------------------------------------------TEXT AREA OF INC DETAILS IN PROP CUSTOD
window.onload = function() {
  var incompleteDetails = document.getElementById('insp_incomplete_details');
  var checkbox = document.getElementById('items_incomplete_accept');

  if (!checkbox.checked) {
      incompleteDetails.style.display = 'none';
  }
};

document.getElementById('items_incomplete_accept').addEventListener('change', function() {
  var incompleteDetails = document.getElementById('insp_incomplete_details');
  if (this.checked) {
      incompleteDetails.style.display = 'block';
  } else {
      incompleteDetails.style.display = 'none';
  }
});     