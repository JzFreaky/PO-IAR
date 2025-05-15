<?php 
require_once 'count_new_items.php'; 
?>
<div class="mobile-logo-container">

</div>
<div class="navbar">
<div class="navbar-left">
    <img src="../../../css/image/logo-v3.png" alt="EVSU Logo" class="logo desktop-logo">
    <span></span>
    <div class="burger-menu" id="burgerMenu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <?php 
        if ($_SESSION['account_type'] === 'Inspector' && $totalNewCountI > 0): 
            ?>
            <span class="badge badge-warning" style="position: relative; top: -12px; right: 5px;"><?php echo $totalNewCountI; ?></span>
        <?php endif; ?>
        <?php if ($_SESSION['account_type'] === 'Property Custodian' && $totalNewCountPC > 0): ?>
            <span class="badge badge-warning" style="position: relative; top: -12px; right: 5px;"><?php echo $totalNewCountPC; ?></span>
        <?php endif; ?>
        <?php if ($_SESSION['account_type'] === 'Supply Office Staff' && $totalNewCountSS > 0): ?>
            <span class="badge badge-warning" style="position: relative; top: -12px; right: 5px;"><?php echo $totalNewCountSS; ?></span>
        <?php endif; ?>
    </div>
    
    
<div class="navbar-right">
<div class="navbar-right" style="padding-right: 15px;">
    <div class="notification-container right-align" id="notificationContainer">
        <button type="button" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell"></i>
            <?php
                    if ($_SESSION['account_type'] === 'Inspector') {
                        $sql = "SELECT COUNT(*) AS unread_count FROM notifications WHERE is_read = 0";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $unread_count = $row['unread_count'];

                        if ($unread_count > 0) {
                            echo '<span class="badge badge-warning notification-count" id="notificationCount">' . $unread_count . '</span>';
                        }
                    } elseif ($_SESSION['account_type'] === 'Property Custodian') {
                        $sql = "SELECT COUNT(*) AS unread_count FROM iar_notifications WHERE is_read = 0";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $unread_count = $row['unread_count'];

                        if ($unread_count > 0) {
                            echo '<span class="badge badge-warning notification-count" id="notificationCount">' . $unread_count . '</span>';
                        }
                    } elseif ($_SESSION['account_type'] === 'Supply Office Staff') {
                        $sql = "SELECT COUNT(*) AS unread_count FROM po_notifications WHERE is_read = 0";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $unread_count = $row['unread_count'];
                
                        if ($unread_count > 0) {
                            echo '<span class="badge badge-warning notification-count" id="notificationCount">' . $unread_count . '</span>';
                        }
                    }
                ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationContainer">
            <div id="notificationList">
            <?php
                    if ($_SESSION['account_type'] === 'Inspector') {
                        $sql = "SELECT * FROM notifications ORDER BY created_at DESC LIMIT 5";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($notifications)) {
                            foreach ($notifications as $notification) {
                                $po_id = $notification['po_id'];
                                $notification_id = $notification['notification_id']; 
                                $class = ($notification['is_read'] == 0) ? 'pulsing-color' : ''; 

                                echo '<div class="dropdown-item d-flex justify-content-between align-items-center ' . $class . '">'
                                . '<a href="../purchase_order/view_po.php?id=' . urlencode($po_id) . '&update_ipo=1&notification_id=' . $notification_id . '" class="text-dark flex-grow-1 notif-no-underline">'
                                . htmlspecialchars($notification['message']) 
                                . '</a>'
                                . '<button class="btn btn-sm btn-danger ml-2 delete-notification" data-id="' . $notification_id . '"><i class="fas fa-trash"></i></button>'
                                . '</div>';
                            }
                        } else {
                            echo '<a class="dropdown-item" href="#">No notifications yet.</a>';
                        }
                    } elseif ($_SESSION['account_type'] === 'Property Custodian') {
                        $sql = "SELECT * FROM iar_notifications ORDER BY created_at DESC LIMIT 5";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $iar_notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($iar_notifications)) {
                            foreach ($iar_notifications as $iar_notification) {
                                $iar_id = $iar_notification['iar_id']; // Assuming you have iar_id in iar_notifications
                                $iar_notification_id = $iar_notification['iar_notification_id'];
                                $class = ($iar_notification['is_read'] == 0) ? 'pulsing-color' : '';

                                echo '<div class="dropdown-item d-flex justify-content-between align-items-center ' . $class . '">'
                                . '<a href="../pending_iar/view_iar.php?id=' . urlencode($iar_id) . '&iar_notification_id=' . $iar_notification_id . '" class="text-dark flex-grow-1 notif-no-underline">'
                                . htmlspecialchars($iar_notification['message'])
                                . '</a>'
                                . '<button class="btn btn-sm btn-danger ml-2 delete-iar-notification" data-id="' . $iar_notification_id . '"><i class="fas fa-trash"></i></button>'
                                . '</div>';
                            }
                        } else {
                            echo '<a class="dropdown-item" href="#">No notifications yet.</a>';
                        }
                    } elseif ($_SESSION['account_type'] === 'Supply Office Staff') {
                        $sql = "SELECT * FROM po_notifications ORDER BY created_at DESC LIMIT 5";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $po_notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                        if (!empty($po_notifications)) {
                            foreach ($po_notifications as $po_notification) {
                                $po_id = $po_notification['po_id'];
                                $po_notification_id = $po_notification['po_notification_id'];
                                $class = ($po_notification['is_read'] == 0) ? 'pulsing-color' : '';
                
                                echo '<div class="dropdown-item d-flex justify-content-between align-items-center ' . $class . '">'
                                . '<a href="../purchase_order/view_po.php?id=' . urlencode($po_id) . '&po_notification_id=' . $po_notification_id . '" class="text-dark flex-grow-1 notif-no-underline">'
                                . htmlspecialchars($po_notification['message'])
                                . '</a>'
                                . '<button class="btn btn-sm btn-danger ml-2 delete-po-notification" data-id="' . $po_notification_id . '"><i class="fas fa-trash"></i></button>'
                                . '</div>';
                            }
                        } else {
                            echo '<a class="dropdown-item" href="#">No notifications yet.</a>';
                        }
                    } else {
                        echo '<a class="dropdown-item" href="#">No notifications yet.</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

        <div class="profile-container" id="profileContainer">
            <?php if (isset($_SESSION['profile_picture'])): ?>
                <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" alt="Profile Picture" class="profile-picture">
            <?php else: ?>
                <img src="default_profile_picture.png" alt="Default Profile Picture" class="profile-picture">
            <?php endif; ?>
            <span><?php echo $_SESSION['name']; ?></span>
            <div class="dropdown-content" id="dropdownContent">
                <img src="<?php echo isset($_SESSION['profile_picture']) ? htmlspecialchars($_SESSION['profile_picture']) : 'default_profile_picture.png'; ?>" alt="Profile Picture">
                <h4><?php echo $_SESSION['name']; ?></h4>
        
                <a href="../profile/update_photo.php"><i class="fas fa-camera"></i> Update Photo</a>
                <a href="../profile/account_settings.php"><i class="fas fa-cog"></i> Account Settings</a>
                <a href="../profile/change_password.php"><i class="fas fa-key"></i> Change Password</a>
                <a href="../../class/function/navbar/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="sidebar" id="sidebar">
    <div class="account-type">
        <i class="fas fa-user-tag"></i> 
        <span><?php echo htmlspecialchars($_SESSION['account_type']); ?></span>
    </div>
    
    <?php if ($_SESSION['account_type'] == 'Inspector'): ?>
        <a href="../dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <?php 
            $newPoCount = 0;
            $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM purchase_orders WHERE ipo_new = 1 AND status IN ('approved', 'canceled', 'Complete', 'Incomplete')");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $newPoCount = $result['count']; 
            
            if ($newPoCount > 0): 
        ?>
            <a href="../purchase_order" class="new-ipo"><i class="fas fa-file-alt"></i> Purchase Orders <span class="badge badge-warning"><?php echo $newPoCount; ?></span></a> 
        <?php else: ?>
            <a href="../purchase_order"><i class="fas fa-file-alt"></i> Purchase Orders</a> 
        <?php endif; ?>

        <?php 
        $newIAICount = 0;
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM arrived_items WHERE iai_new = 1 ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $newIAICount = $result['count']; 
            
        if ($newIAICount > 0): 
        ?>
            <a href="../arrived_items" class="new-iai"><i class="fas fa-search-plus"></i> Item's for Inspection <span class="badge badge-warning"><?php echo $newIAICount; ?></span></a> 
        <?php else: ?>
            <a href="../arrived_items"><i class="fas fa-search-plus"></i> Item's for Inspection </a> 
        <?php endif; ?>

        <a href="../pending_iar"><i class="fas fa-clock"></i> Pending Inspection and Acceptance Reports</a> 
        <?php 
            $newINDiarCount = 0;
            $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE indiar_new = 1 AND property_custodian_status = 'rejected'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $newINDiarCount = $result['count']; 
                
            if ($newINDiarCount > 0): 
        ?>
        <?php endif; ?>
    
        <?php 
        $newIAiarCount = 0;
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE iaiar_new = 1 AND property_custodian_status IN ('complete','partial','accept/not correct specs','rejected','pending')");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $newIAiarCount = $result['count']; 
            
        if ($newIAiarCount > 0): 
        ?>
            <a href="../all_iar" class="new-iaiar"><i class="fas fa-file-invoice"></i> All Inspection and Acceptance Reports <span class="badge badge-warning"><?php echo $newIAiarCount; ?></span></a> 
        <?php else: ?>
            <a href="../all_iar"><i class="fas fa-file-invoice"></i> All Inspection and Acceptance Reports</a> 
        <?php endif; ?>
    <?php endif; ?>



<?php if ($_SESSION['account_type'] == 'Property Custodian'): ?>
    <a href="../dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <?php 
        $newPiarCount = 0;
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE ppiar_new = 1 AND property_custodian_status = 'pending'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $newPiarCount = $result['count']; 
        
        if ($newPiarCount > 0): 
            ?>
            <a href="../pending_iar" class="new-piar"><i class="fas fa-clock"></i> Pending Inspection and Acceptance Reports <span class="badge badge-warning"><?php echo $newPiarCount; ?></span></a> 
        <?php else: ?>
            <a href="../pending_iar"><i class="fas fa-clock"></i> Pending Inspection and Acceptance Reports</a> 
        <?php endif; ?>
        <?php 
        $newPAiarCount = 0;
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE paiar_new = 1 AND property_custodian_status IN ('complete','partial','accept/not correct specs','rejected','pending')");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $newPAiarCount = $result['count']; 
        
        if ($newPAiarCount > 0): 
            ?>
            <a href="../all_iar" class="new-piar"><i class="fas fa-file-invoice"></i> All Inspection and Acceptance Reports <span class="badge badge-warning"><?php echo $newPAiarCount; ?></span></a> 
        <?php else: ?>
            <a href="../all_iar"><i class="fas fa-file-invoice"></i> All Inspection and Acceptance Reports</a> 
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($_SESSION['account_type'] == 'Supply Office Staff'): ?>
    <a href="../dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <?php 
    $newSpoCount = 0;
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM purchase_orders WHERE spo_new = 1 AND status IN ('approved', 'canceled', 'Complete', 'Incomplete')");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $newSpoCount = $result['count']; 
    
    if ($newSpoCount > 0): 
        ?>
        <a href="../purchase_order" class="new-spo"><i class="fas fa-file-alt"></i> Purchase Orders <span class="badge badge-warning"><?php echo $newSpoCount; ?></span></a> 
    <?php else: ?>
        <a href="../purchase_order"><i class="fas fa-file-alt"></i> Purchase Orders</a> 
        <?php endif; ?>

        <a href="../delivered_items"><i class="fas fa-check-circle"></i> Delivered Item's</a> 
    <?php 
        $newSPiarCount = 0;
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE spiar_new = 1 AND property_custodian_status = 'pending'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $newSPiarCount = $result['count']; 
        
        if ($newSPiarCount > 0): 
            ?>
            <a href="../pending_iar" class="new-spiar"><i class="fas fa-clock"></i> Pending Inspection and Acceptance Reports <span class="badge badge-warning"><?php echo $newSPiarCount; ?></span></a> 
        <?php else: ?>
            <a href="../pending_iar"><i class="fas fa-clock"></i> Pending Inspection and Acceptance Reports</a> 
        <?php endif; ?>
        
        <?php 
            $newSAiarCount = 0;
            $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE saiar_new = 1 AND property_custodian_status IN ('complete','partial','accept/not correct specs','rejected','pending')");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $newSAiarCount = $result['count']; 
            
            if ($newSAiarCount > 0): 
                ?>
                <a href="../all_iar" class="new-siar"><i class="fas fa-file-invoice"></i> All Inspection and Acceptance Reports <span class="badge badge-warning"><?php echo $newSAiarCount; ?></span></a> 
            <?php else: ?>
                <a href="../all_iar"><i class="fas fa-file-invoice"></i> All Inspection and Acceptance Reports</a> 
            <?php endif; ?>
    <?php endif; ?>

</div>
