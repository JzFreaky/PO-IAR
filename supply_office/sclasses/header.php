<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../class/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../class/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../class/css/flatpickr.min.css">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="../../class/css/s.o.css">
    <link rel="icon" href="../css/image/system-logo.png" type="image/x-icon">
    <link rel="icon" href="../../../css/image/system-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../class/css/font-awesome_css/all.min.css">
</head>
<body>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show success-message" role="alert">
        <?php echo $_SESSION['success_message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger alert-dismissible fade show error-message" role="alert">
            <?php echo $_SESSION['error_message']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>


<div id="dialogBox" class="dialog-box" style="display: none;">
    <div class="dialog-content">
        <span class="close-button" onclick="closeDialogBox()">&times;</span>
        <p id="dialogMessage"></p>
        <button onclick="closeDialogBox()" class="button-modal">OK</button>
    </div>
</div>


<!-- LOADER-->
<div id="preloader" class="preloader">
    <div class="loader"></div>
</div>

<!-- ERROR MESSAGE-->
<div id="section1Error" class="error-message"></div>
<div id="section2Error" class="error-message"></div>


<!-- PO NOTIFICATION ERROR MESSAGE-->
<div id="notifError" class="error-message"></div>
<div id="notifSuccess" class="success-message"></div>

<!-- IAR NOTIFICATION ERROR MESSAGE-->
<div id="IARnotifError" class="error-message"></div>
<div id="IARnotifError" class="success-message"></div>

<!-- PROP CUSTODIAN ERROR MESSAGE-->
<div id="Accepterror" class="error_message"></div> 

<!-- DELIVERY DATE SUCCESS MESSAGE-->
<?php if (isset($_GET['success'])): ?>
    <div class="success-message alert alert-success">
        <?php echo htmlspecialchars($_GET['success']); ?>
    </div>
<?php endif; ?>

<!-- INSPECTOR DELIVERY DATE SUCCESS MESSAGE-->
<div id="messageContainer"></div>

<!-- SUPPLY STAFF DELIVERY ITEM SAVE/EDIT/DELETE-->
<div id="delivered_container"></div>
<div id="edit_delivered"></div>
<div id="delete_delivered"></div>

