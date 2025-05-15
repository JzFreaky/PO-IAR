<?php
require '../../../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $itemId = $_POST['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM arrived_items WHERE id = :id");
        $stmt->bindParam(':id', $itemId);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Item deleted successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete item"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
?>
