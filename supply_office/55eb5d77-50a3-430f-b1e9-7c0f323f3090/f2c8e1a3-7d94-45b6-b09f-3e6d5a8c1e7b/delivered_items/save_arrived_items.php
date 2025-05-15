<?php
require '../../../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $po_no = $_POST['poNo'] ?? '';
    $selectedStockNos = $_POST['selectedStockNos'] ?? '';
    $selectedQuantities = $_POST['selectedQuantities'] ?? '';
    $selectedPoIds = $_POST['selectedPoIds'] ?? '';
    $selectedAmounts = $_POST['selectedAmounts'] ?? '';
    $selectedUnitCosts = $_POST['selectedUnitCosts'] ?? '';
    $selectedUnits = $_POST['selectedUnits'] ?? '';
    $delivery_date = $_POST['deliveryDate'] ?? '';
    $invoice_no = $_POST['invoice_no'] ?? '';

    if (!empty($po_no) && !empty($selectedStockNos) && !empty($selectedQuantities) && 
        !empty($selectedPoIds) && !empty($selectedAmounts) && !empty($selectedUnitCosts) && 
        !empty($selectedUnits) && !empty($delivery_date) && !empty($invoice_no)) {
        
        // Convert string data into arrays
        $stockItems = explode(";;", $selectedStockNos);
        $quantities = explode(";;", $selectedQuantities);
        $poIds = explode(";;", $selectedPoIds);
        $amounts = explode(";;", $selectedAmounts);
        $unitCosts = explode(";;", $selectedUnitCosts);
        $units = explode(";;", $selectedUnits);

        // Ensure all arrays have the same count
        if (count($stockItems) !== count($quantities) || count($quantities) !== count($poIds) ||
            count($poIds) !== count($amounts) || count($amounts) !== count($unitCosts) ||
            count($unitCosts) !== count($units)) {
            echo json_encode(["success" => false, "message" => "Mismatch between stock details."]);
            exit;
        }

        try {
            $conn->beginTransaction();

            $stmt = $conn->prepare("INSERT INTO arrived_items 
                (po_no, stock_no, description, original_quantity, unit, unit_cost, amount, po_id, delivery_date, invoice_no) 
                VALUES (:po_no, :stock_no, :description, :original_quantity, :unit, :unit_cost, :amount, :po_id, :delivery_date, :invoice_no)");

            foreach ($stockItems as $index => $item) {
                [$stock_no, $description] = explode(" | ", $item, 2); // Extract stock number and description
                $original_quantity = trim($quantities[$index]);
                $po_id = trim($poIds[$index]);
                $amount = trim($amounts[$index]);
                $unit_cost = trim($unitCosts[$index]);
                $unit = trim($units[$index]);

                $stmt->execute([
                    ':po_no' => trim($po_no),
                    ':stock_no' => trim($stock_no),
                    ':description' => trim($description),
                    ':original_quantity' => trim($original_quantity),
                    ':unit' => trim($unit),
                    ':unit_cost' => trim($unit_cost),
                    ':amount' => trim($amount),
                    ':po_id' => trim($po_id),
                    ':delivery_date' => trim($delivery_date),
                    ':invoice_no' => trim($invoice_no)
                ]);
            }

            $conn->commit();
            echo json_encode(["success" => true, "message" => "Items successfully saved."]);
        } catch (PDOException $e) {
            $conn->rollBack();
            echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
