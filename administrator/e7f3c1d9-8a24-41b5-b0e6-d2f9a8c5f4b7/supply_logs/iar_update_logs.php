<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>
<title>Account Trail</title>
<main class="container mt-5 custom-container">
<div class="row">
        <div class="col-md-12">
            <h3 class="mb-3">IAR Update Trail</h3>
            <div class="table-responsive">
            <table id="iarupdatelogsTable" class="table table-striped" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th style="width: 100px;">ID</th>
                        <th style="width: 100px;">IAR ID</th>
                        <th style="width: 100px;">Updated By</th>
                        <th style="width: 100px;">Updated At</th>
                        <th style="width: 100px;">Account Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM iar_update_trail ORDER BY updated_at DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['iar_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['updated_at'] . "</td>";
                        echo "<td>" . $row['account_type'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

        <div class="row mt-4 mb-3"> <div class="col-md-12">
            <a href="../supply_logs" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a> </div>
    </div>
</main>

<?php include '../../aclasses/footer.php'; ?>
