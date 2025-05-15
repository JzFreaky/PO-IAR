<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>
<style>
    .grid-item {
    background-color: white;
    padding: 20px;
    text-align: center;
    color: #333;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    
    font-weight: bold;
    transition: all 0.3s ease;
}

.grid-item img {
    max-width: 80px; 
    margin-bottom: 10px;
}

.grid-item p {
    margin: 0;
    font-size: 16px;
    color: #333;
    text-decoration: none;
}

.grid-item:hover {
    background-color: #ddd;
    transform: scale(1.05);
}

.procurement-portal {
    background-color: #4caf50;
    color: white;
}

.supply-portal {
    background-color: #169d9f;
    color: white;
}

</style>
<title>Account Trail</title>
<main class="container mt-5 custom-container">
    <h2>Account Trails</h2>
        <section class="grid-container">
        <a href="../procurement_logs/" class="grid-item procurement-portal" style="text-decoration: none;">
            <img src="../../../css/image/group.png" alt="Procurement Office Portal">
            <p>Procurement Office</p> 
        </a>
        <a href="../supply_logs/" class="grid-item supply-portal" style="text-decoration: none;">
            <img src="../../../css/image/so.png" alt="Supply Office Portal">
            <p>Supply Office</p> 
        </a>
    </section>
</main>

<?php include '../../aclasses/footer.php'; ?>
