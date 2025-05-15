<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/flatpickr.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="css/plogin.css">
    <link rel="stylesheet" href="../css/p.o.css">
    <link rel="icon" href="../css/image/system-logo.png" type="image/x-icon">
    <link rel="icon" href="../../css/image/system-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/font-awesome_css/all.min.css">
</head>
<body>
    
<!----------------------SUCCESS MESSAGE-->
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show success-message" role="alert">
        <?php echo $_SESSION['success_message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<!----------------------APPROVING THE PO ERROR-->
<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show error-message" role="alert">
        <?php echo $_SESSION['error_message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
        <?php unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>

<!----------------------LOADER-->
<div id="preloader" class="preloader">
    <div class="loader"></div>
</div>

<!-- ERROR MESSAGE-->
<div id="section1Error" class="error-message"></div>
<div id="section2Error" class="error-message"></div>
<div id="section4Error" class="error-message"></div>

<!----------------------APPROVING THE PO ERROR-->
<div id="project-description-error" class="error-message" style="display: none;"></div>