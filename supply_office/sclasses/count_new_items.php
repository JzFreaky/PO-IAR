<?php 
//----------------------------------------INSPECTOR PART
$newPoCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM purchase_orders WHERE ipo_new = 1 AND status IN ('approved', 'canceled', 'Complete', 'Incomplete')");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newPoCount = $result['count']; 

$newINDiarCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE indiar_new = 1 AND property_custodian_status = 'rejected'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newINDiarCount = $result['count'];

/* $newIDiarCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE idiar_new = 1 AND property_custodian_status IN ('complete', 'partial')");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newIDiarCount = $result['count']; */

$newIAiarCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE iaiar_new = 1 AND property_custodian_status IN ('complete','partial','accept/not correct specs','rejected','pending')");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newIAiarCount = $result['count'];

$newIAICount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM arrived_items WHERE iai_new = 1");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newIAICount = $result['count'];


$totalNewCountI = $newPoCount + $newINDiarCount + /* $newIDiarCount */ + $newIAiarCount + $newIAICount;
//----------------------------------------PROPERTY CUSTODIAN PART
$newPPoCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM purchase_orders WHERE ppo_new = 1 AND status IN ('approved', 'canceled', 'Complete', 'Incomplete')");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newPPoCount = $result['count']; 

$newPiarCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE ppiar_new = 1 AND property_custodian_status = 'pending'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newPiarCount = $result['count'];

$newPAiarCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE paiar_new = 1 AND property_custodian_status IN ('complete','partial','accept/not correct specs','rejected','pending')");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newPAiarCount = $result['count'];

$totalNewCountPC = $newPPoCount + $newPiarCount + $newPAiarCount;

//----------------------------------------SUPPLY OFFICE STAFF
$newSPoCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM purchase_orders WHERE spo_new = 1 AND status IN ('approved', 'canceled', 'Complete', 'Incomplete')");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newSPoCount = $result['count']; 

$newSPiarCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE spiar_new = 1 AND property_custodian_status = 'pending'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newSPiarCount = $result['count'];

$newSAiarCount = 0;
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM inspection_acceptance_report WHERE saiar_new = 1 AND property_custodian_status IN ('complete','partial','accept/not correct specs','rejected','pending')");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$newSAiarCount = $result['count'];

$totalNewCountSS = $newSPoCount + $newSPiarCount + $newSAiarCount;

?>