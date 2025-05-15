<?php
//////////////////////////////////////PROPERTY CUSTODIAN CONFIG
include '../../../database/db.php';


//-------------------------------------------------------------------------------PROPERTY CUSTODIAN VIEW PO
try {
    if (isset($order['id'])) {
        $labels = $conn->query("SELECT * FROM purchase_order_labels WHERE po_id = " . intval($order['id']) . " ORDER BY label_no")->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $labels = []; 
    }
} catch (PDOException $e) {
}

if (isset($order['id']) && !empty($order['id'])) {
    $stmt = $conn->prepare("SELECT * FROM purchase_order_items WHERE po_id = :po_id");
    $stmt->bindParam(':po_id', $order['id'], PDO::PARAM_INT);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $items = []; 
}

function displaypoItemsAndLabels($items, $labels) {
    $output = '';
    $labelIndex = 0; 
    $numLabels = count($labels);
    
    // Iterate through each item
    foreach ($items as $item) { 
        while ($labelIndex < $numLabels && $labels[$labelIndex]['label_no'] <= $item['stock_no']) {
            $output .= '<tr><td colspan="6"><strong>' . htmlspecialchars($labels[$labelIndex]['label_text']) . '</strong></td></tr>';
            $labelIndex++;
        }
        
        $output .= '<tr>
            <td>' . htmlspecialchars($item['stock_no']) . '</td>
            <td>' . htmlspecialchars($item['unit']) . '</td>
            <td style="text-align: left;">' . htmlspecialchars($item['description']) . '</td>
            <td>' . htmlspecialchars($item['quantity']) . '</td>
            <td>' . htmlspecialchars($item['unit_cost']) . '</td>
            <td>' . htmlspecialchars($item['amount']) . '</td>
        </tr>';
    }
    
    return $output; 
}


?>

