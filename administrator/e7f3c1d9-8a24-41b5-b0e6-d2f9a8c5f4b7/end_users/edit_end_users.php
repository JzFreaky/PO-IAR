<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
// Handle form submission for update
if (isset($_GET['id'])) {
    $end_user_id = $_GET['id'];

    try {
        $query = "SELECT * FROM end_users WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $end_user_id, PDO::PARAM_INT);
        $stmt->execute();

        $end_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$end_user) {
            $_SESSION['error_message'] = "End-user not found.";
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error fetching end-user data: " . $e->getMessage();
        exit();
    }
} 

?>
<title>Edit End-User</title>
<div class="container mt-5 custom-container">
    <h1>Edit End-User</h1>
    <form action="" method="post">
        <input type="hidden" name="action" value="update_end_user">
        <div class="form-group">
            <label for="end_user_name">End User Name</label>
            <input type="text" class="form-control" id="end_user_name" name="end_user_name" value="<?= htmlspecialchars($end_user['end_user_name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="requisitioning_office">Requisitioning Office</label>
            <input type="text" class="form-control" id="requisitioning_office" name="requisitioning_office" value="<?= htmlspecialchars($end_user['requisitioning_office']) ?>" required>
        </div>
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Update</button>
    </form>
</div>

<?php include '../../aclasses/footer.php'; ?>