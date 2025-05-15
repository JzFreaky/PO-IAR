<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
?>

<title>Procurement Office</title>
<main class="container mt-5 custom-container">
    <h2>Procurement Office Account Trails</h2>
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-3">Login Logs</h3>
            <div class="table-responsive">
            <table id="pologinlogsTable" class="table table-striped" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th style="width: 100px;">ID</th>
                        <th style="width: 100px;">User ID</th>
                        <th style="width: 100px;">Name</th>
                        <th style="width: 100px;">Account Type</th>
                        <th style="width: 100px;">Login Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM po_login_logs ORDER BY login_time DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['account_type'] . "</td>";
                        echo "<td>" . $row['login_time'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="row mt-4 mb-3"> <div class="col-md-12">
            <a href="../procurement_logs" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a> </div>
    </div>
</main>
<?php include '../../aclasses/footer.php'; ?>