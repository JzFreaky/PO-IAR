<?php
require '../classes/config.php'; // Your database connection file
include '../../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'update_specification') {
        // Handle the update specification functionality
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $updated_specification = filter_var($_POST['updated_specification'], FILTER_SANITIZE_STRING);

        try {
            $stmt = $conn->prepare("UPDATE po_item_specifications SET item_specification = ? WHERE id = ?");
            $stmt->execute([$updated_specification, $id]);
            echo json_encode(['success' => true, 'message' => 'Specification updated successfully']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error updating specification: ' . $e->getMessage()]);
        }
    } elseif ($action === 'delete_specification') {
        // Handle the delete specification functionality
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $stmt = $conn->prepare("DELETE FROM po_item_specifications WHERE id = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Specification deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Specification not found or already deleted']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error deleting specification: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action specified']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit;
?>
