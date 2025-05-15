<?php
// update_item_specification.php

require '../classes/config.php';  // Ensure the connection file is correctly included

if (isset($_POST['po_id'], $_POST['item_no'], $_POST['item_specification'])) {
    $po_id = $_POST['po_id'];
    $item_no = $_POST['item_no'];
    $item_specification = $_POST['item_specification'];

    // Sanitize input for safety
    $item_specification = trim($item_specification);

    // Check if the specification already exists for the given PO and item number
    $sql_check = "SELECT id FROM po_item_specifications WHERE po_id = :po_id AND item_no = :item_no";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':po_id', $po_id);
    $stmt_check->bindParam(':item_no', $item_no);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        // If the specification exists, update it
        $sql_update = "UPDATE po_item_specifications 
                       SET item_specification = :item_specification 
                       WHERE po_id = :po_id AND item_no = :item_no";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':po_id', $po_id);
        $stmt_update->bindParam(':item_no', $item_no);
        $stmt_update->bindParam(':item_specification', $item_specification);
        $stmt_update->execute();

        echo "Specification updated successfully!";
    } else {
        // If the specification doesn't exist, insert it
        $sql_insert = "INSERT INTO po_item_specifications (po_id, item_no, item_specification) 
                       VALUES (:po_id, :item_no, :item_specification)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(':po_id', $po_id);
        $stmt_insert->bindParam(':item_no', $item_no);
        $stmt_insert->bindParam(':item_specification', $item_specification);
        $stmt_insert->execute();

        echo "Specification inserted successfully!";
    }
} else {
    echo "Invalid request!";
}
?>
