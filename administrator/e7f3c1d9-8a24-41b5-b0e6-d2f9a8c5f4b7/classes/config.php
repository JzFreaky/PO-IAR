<?php
session_start();
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "system_db2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION['username'];
try {
    $query = "SELECT account_type FROM admin_users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $fetchedAccountType = $result['account_type'] ?? null;
    $_SESSION['account_type'] = $fetchedAccountType;

} catch (PDOException $e) {
    echo "Error fetching account type: " . $e->getMessage();
    exit();
}


//-------------------------------------------------------------------------- ADMIN DASHBOARD COUNTS
$queryTotalEndUsers = "SELECT COUNT(*) as total_end_users FROM end_users";
$stmtTotalEndUsers = $conn->query($queryTotalEndUsers);
$totalEndUsers = $stmtTotalEndUsers->fetch(PDO::FETCH_ASSOC)['total_end_users'];

$queryTotalUACS = "SELECT COUNT(*) as total_uacs FROM uacs_codes";
$stmtTotalUACS = $conn->query($queryTotalUACS);
$totalUACS = $stmtTotalUACS->fetch(PDO::FETCH_ASSOC)['total_uacs'];

$queryTotalAccounts = "SELECT SUM(total) AS total_accounts FROM (
    SELECT COUNT(*) AS total FROM admin_users
    UNION ALL
    SELECT COUNT(*) AS total FROM so_users
    UNION ALL
    SELECT COUNT(*) AS total FROM po_users
) AS combined_counts";
$stmtTotalAccounts = $conn->query($queryTotalAccounts);
$totalAccounts = $stmtTotalAccounts->fetch(PDO::FETCH_ASSOC)['total_accounts'];
//--------------------------------------------------------------------------Procurement Logs
$sql = "SELECT COUNT(*) FROM po_login_logs";
$stmt = $conn->prepare($sql);
$stmt->execute();
$pologinCount = $stmt->fetchColumn();

// Count IAR creation logs
$sql = "SELECT COUNT(*) FROM po_creation_trail";
$stmt = $conn->prepare($sql);
$stmt->execute();
$poCreationCount = $stmt->fetchColumn();

// Count IAR update logs
$sql = "SELECT COUNT(*) FROM po_update_trail";
$stmt = $conn->prepare($sql);
$stmt->execute();
$poUpdateCount = $stmt->fetchColumn();

//-------------------------------------------------------------------------- SUPPLY LOGS
$sql = "SELECT COUNT(*) FROM so_login_logs";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sologinCount = $stmt->fetchColumn();

// Count IAR creation logs
$sql = "SELECT COUNT(*) FROM iar_creation_trail";
$stmt = $conn->prepare($sql);
$stmt->execute();
$iarCreationCount = $stmt->fetchColumn();

// Count IAR update logs
$sql = "SELECT COUNT(*) FROM iar_update_trail";
$stmt = $conn->prepare($sql);
$stmt->execute();
$iarUpdateCount = $stmt->fetchColumn();


//-------------------------------------------END USERS TABLE
$query = "SELECT id, end_user_name, requisitioning_office FROM end_users";

try {
    $stmt = $conn->prepare($query); // Use $conn instead of $pdo
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}





//-------------------------------------------------------------------------- ADMIN DSIPLAYING ACCOUNTS
function fetchProcurementUsers($conn) {
    try {
        $sql = "SELECT id, username, email, created_at, 'BAC' AS account_type FROM po_users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

//--------------------------------------------------------------------------Fetch Supply Office Users
function fetchSupplyUsers($conn) {
    try {
        $sql = "SELECT id, username, email, created_at, account_type FROM so_users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

$procurementUsers = fetchProcurementUsers($conn);
$supplyUsers = fetchSupplyUsers($conn);

//--------------------------------------------------------------------------Merge the results
$allUsers = array_merge($procurementUsers, $supplyUsers);

//--------------------------------------------------------------------------MANAGE UACS INDEX
$sql = "SELECT * FROM uacs_codes";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//--------------------------------------------------------------------------EDIT/UPDATE UACS CODE
function getUACSCodeById($conn, $id) {
    try {
        $sql = "SELECT * FROM uacs_codes WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function updateUACSCode($conn, $id, $classification, $sub_class, $group_name, $object_code, $sub_object_code, $uacs, $status) {
    try {
        $sql = "UPDATE uacs_codes SET 
                classification = :classification, 
                sub_class = :sub_class, 
                group_name = :group_name, 
                object_code = :object_code, 
                sub_object_code = :sub_object_code, 
                uacs = :uacs, 
                status = :status 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':classification', $classification);
        $stmt->bindParam(':sub_class', $sub_class);
        $stmt->bindParam(':group_name', $group_name);
        $stmt->bindParam(':object_code', $object_code);
        $stmt->bindParam(':sub_object_code', $sub_object_code);
        $stmt->bindParam(':uacs', $uacs);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $uacs_code = getUACSCodeById($conn, $id);

    if (!$uacs_code) {
        die("UACS code not found.");
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_uacs_code') {
        $classification = $_POST['classification'];
        $sub_class = $_POST['sub_class'];
        $group_name = $_POST['group_name'];
        $object_code = $_POST['object_code'];
        $sub_object_code = $_POST['sub_object_code'];
        $uacs = $_POST['uacs'];
        $status = $_POST['status'];

        updateUACSCode($conn, $id, $classification, $sub_class, $group_name, $object_code, $sub_object_code, $uacs, $status);

        $_SESSION['success_message'] = "UACS Code successfully updated.";
        header("Location: ../manage_uacs");
        exit;
    }
} else {
    if ($_SERVER['PHP_SELF'] === '../manage_uacs') {
        die("No ID provided.");
    }
}

//--------------------------------------------------------------------------DELETE END USER
if (isset($_GET['delete_end_user_id'])) {
    $endUserIdToDelete = $_GET['delete_end_user_id'];
    if (deleteEndUser($conn, $endUserIdToDelete)) {
        // Set the success message in the session
        $_SESSION['success_message'] = "End-User deleted successfully!";
        // Redirect to the appropriate page after successful deletion
        header("Location: ../end_users"); 
        exit;
    } else {
        // Display an error message if the deletion failed
        echo "Error deleting end user.";
    }
}

// Function to delete an end user
function deleteEndUser($conn, $endUserId) {
    try {
        // Prepare the SQL statement to delete the end user
        $sql = "DELETE FROM end_users WHERE id = :id";

        // Prepare the statement with the ID
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $endUserId, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    } catch (PDOException $e) {
        echo "Error deleting end user: " . $e->getMessage();
        return false;
    }
}

//--------------------------------------------------------------------------DELETE UACS CODE
if (isset($_GET['delete_uacs_id'])) {
    $uacsIdToDelete = $_GET['delete_uacs_id'];
    if (deleteUACS($conn, $uacsIdToDelete)) {
        // Set the success message in the session
        $_SESSION['success_message'] = "UACS code deleted successfully!";
        // Redirect to the appropriate page after successful deletion
        header("Location: ../manage_uacs"); 
        exit;
    } else {
        // Display an error message if the deletion failed
        echo "Error deleting UACS code.";
    }
}

// Function to delete a UACS code
function deleteUACS($conn, $uacsId) {
    try {
        // Prepare the SQL statement to delete the UACS code
        $sql = "DELETE FROM uacs_codes WHERE id = :id";

        // Prepare the statement with the ID
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $uacsId, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    } catch (PDOException $e) {
        echo "Error deleting UACS code: " . $e->getMessage();
        return false;
    }
}




//------------------------------------------------------------------------ADD UACS CODE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_uacs_code') {
    $classification = trim($_POST['classification']);
    $sub_class = trim($_POST['sub_class']);
    $group_name = trim($_POST['group_name']);
    $object_code = trim($_POST['object_code']);
    $sub_object_code = trim($_POST['sub_object_code']);
    $uacs = trim($_POST['uacs']);
    $status = trim($_POST['status']);

    try {
        $sql = "INSERT INTO uacs_codes (classification, sub_class, group_name, object_code, sub_object_code, uacs, status) 
                VALUES (:classification, :sub_class, :group_name, :object_code, :sub_object_code, :uacs, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':classification', $classification);
        $stmt->bindParam(':sub_class', $sub_class);
        $stmt->bindParam(':group_name', $group_name);
        $stmt->bindParam(':object_code', $object_code);
        $stmt->bindParam(':sub_object_code', $sub_object_code);
        $stmt->bindParam(':uacs', $uacs);
        $stmt->bindParam(':status', $status);

        $stmt->execute();

        $_SESSION['success_message'] = "UACS Code successfully added.";
        header("Location: ../manage_uacs");
        exit();
    } catch (PDOException $e) {
        $errorMessage = "Error adding UACS code: " . $e->getMessage();
    }
}

//-------------------------------------------------------------------------ADD AND UPDATE END-USER

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_end_user') {
    $end_user_name = trim($_POST['end_user_name']);
    $requisitioning_office = trim($_POST['requisitioning_office']);

    if (!empty($end_user_name) && !empty($requisitioning_office)) {
        try {
            $query = "UPDATE end_users SET end_user_name = :end_user_name, requisitioning_office = :requisitioning_office WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':end_user_name', $end_user_name);
            $stmt->bindParam(':requisitioning_office', $requisitioning_office);
            $stmt->bindParam(':id', $end_user_id);
            $stmt->execute();

            $_SESSION['success_message'] = "End-User updated successfully.";
            header("Location: index.php"); // Redirect to your actual end users list
            exit();
        } catch (PDOException $e) {
            $errorMessage = "Error updating end user: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_end_user') {
    $end_user_name = trim($_POST['end_user_name']);
    $requisitioning_office = trim($_POST['requisitioning_office']);

    if (!empty($end_user_name) && !empty($requisitioning_office)) {
        try {
            $query = "INSERT INTO end_users (end_user_name, requisitioning_office) VALUES (:end_user_name, :requisitioning_office)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':end_user_name', $end_user_name);
            $stmt->bindParam(':requisitioning_office', $requisitioning_office);
            $stmt->execute();

            $_SESSION['success_message'] = "End-User successfully added.";
            header("Location: ../end_users");
            exit();
        } catch (PDOException $e) {
            $errorMessage = "Error adding UACS code: " . $e->getMessage();
        }
    }
}


//------------------------------------------------------------------------------------------------Add Account
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_account') {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $account_type = trim($_POST['account_type']);

    if (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        // Password doesn't meet the criteria
        $_SESSION['error_message'] = "Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one number, and one special character. Example: Password123!";
        header("Location: ../add_account/");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['profile_picture']['type'], $allowed_types)) {
            $profile_picture = '../../../uploads/' . uniqid() . '_' . basename($_FILES['profile_picture']['name']);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
        } else {
            $_SESSION['error_message'] = "Invalid file type. Please upload a JPEG, PNG, or GIF image.";
            header("Location: ../add_account/");
            exit();
        }
    }

    $valid_tables = ['po_users', 'so_users', 'admin_users']; // Added 'admin_users' to the valid tables
    $table = ($account_type === 'BAC') ? 'po_users' : (($account_type === 'Inspector' || $account_type === 'Property Custodian' || $account_type === 'Supply Office Staff') ? 'so_users' : 'admin_users');
    
    if (!in_array($table, $valid_tables)) {
        $_SESSION['error_message'] = "Invalid account type.";
            header("Location: ../add_account/");
        exit();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO $table (name, username, password, email, account_type, profile_picture) 
                                VALUES (:name, :username, :password, :email, :account_type, :profile_picture)");

        $stmt->bindParam(':name', $name);                        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':account_type', $account_type);
        $stmt->bindParam(':profile_picture', $profile_picture);
        $stmt->execute();
        $stmt->closeCursor();

        $_SESSION['success_message'] = "Account successfully created.";
        header("Location: ../manage_accounts/");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//--------------------------------------------------------------------------FETCH USERS
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    try {
        // First, try to fetch from so_users
        $sql = "SELECT * FROM so_users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
        } else {
            // If not found in so_users, try po_users
            $sql = "SELECT * FROM po_users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                // User not found in either table, redirect to an error page
                header('Location: error.php?message=User+not+found');
                exit;
            } else {
            }
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        exit;
    }
}

//--------------------------------------------------------------------------DELETE USERS
if (isset($_GET['delete_user']) && $_GET['delete_user'] === 'true') {
    if (deleteUser($conn, $username)) {
        $_SESSION['success_message'] = "User deleted successfully!";
        // Redirect to the appropriate page after successful deletion
        header("Location: ../manage_accounts"); 
        exit;
    } else {
        echo "Error deleting user.";
    }
}

function deleteUser($conn, $username) {
    try {
        // Check which table the user belongs to
        $sql = "SELECT 1 FROM so_users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            // User is in so_users
            $sql = "DELETE FROM so_users WHERE username = :username";
        } else {
            // User is in po_users
            $sql = "DELETE FROM po_users WHERE username = :username";
        }

        // Prepare the statement with the ID
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    } catch (PDOException $e) {
        echo "Error deleting user: " . $e->getMessage();
        return false;
    }
}


?>