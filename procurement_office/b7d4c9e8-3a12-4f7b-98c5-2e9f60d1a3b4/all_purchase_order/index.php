<?php
require '../classes/config.php';
include '../../database/db.php'; 
include '../../pclasses/header.php';
include '../../pclasses/navbar.php';
require '../classes/bac.php';

function fetchAllPurchaseOrders($conn) {
    try {
        // Order by po_no instead of date
        $sql = "SELECT po.id, po.requestor, po.requisitioning_office, po.po_no, po.date, po.status 
                FROM purchase_orders po 
                WHERE po.status IN ('approved', 'incomplete', 'complete', 'pending', 'canceled')  
                ORDER BY po.po_no DESC"; // Change this line
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        // Log the error to a file or handle it appropriately
        error_log("Error fetching purchase orders: " . $e->getMessage());
        return [];
    }
}
$allpurchase_orders = fetchAllPurchaseOrders($conn);
?>
<title>All Purchase Orders</title>
<main class="container mt-5 custom-container">
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
        <h2>All Purchase Order's</h2>
            <div class="button-container float-right"> 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal">
                    <i class="fas fa-file-download"></i> Generate Report
                </button>
            </div>
        </div>
    </div>
</div>
    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Generate Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="reportType">Report Type:</label>
                    <select class="form-control" id="reportType">
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                </div>
                <div class="form-group" id="selectedMonthDiv"> 
                    <label for="selectedMonth">Select Month:</label>
                    <select class="form-control" id="selectedMonth"></select>
                </div> 
                <div class="form-group" id="selectedYearDiv"> 
                    <label for="selectedYear">Select Year:</label>
                    <select class="form-control" id="selectedYear"></select>
                </div> 
                <div class="form-group" id="selectedYearMonthlyDiv"> 
                    <label for="selectedYearMonthly">Select Year (Monthly):</label>
                    <select class="form-control" id="selectedYearMonthly"></select>
                </div> 
                <div class="form-group">
                    <label for="poType">PO Type:</label>
                    <select class="form-control" id="poType">
                        <option value="All">All</option>
                        <option value="Complete/Incomplete">Arrived</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-primary" id="generateReportBtn">Generate</button>
            </div>
        </div>
    </div>
</div>  
<div class="table-responsive">
    <table id="purchaseOrdersTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>PO No.</th>
                <th>Requestor</th>
                <th>Requisitioning Office</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($allpurchase_orders)): ?>
                <?php foreach ($allpurchase_orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($order['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($order['requisitioning_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($order['date'])); ?></td>
                        <td>
                            <?php 
                            if ($order['status'] === 'Complete' || $order['status'] === 'Incomplete') { 
                                echo '<span class="badge badge-success">Arrived</span>';
                            } elseif ($order['status'] === 'approved') {
                                echo '<span class="badge badge-primary">Approved</span>';
                            } elseif ($order['status'] === 'pending') {
                                echo '<span class="badge badge-warning">Pending</span>';
                            } elseif ($order['status'] === 'canceled') {
                                echo '<span class="badge badge-danger">Canceled</span>';
                            } else {
                                echo '<span class="badge badge-secondary">N/A</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $order['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $order['id']; ?>">
                                    <a class="dropdown-item ai-dropdown-item" href="view_po.php?id=<?php echo $order['id']; ?>">
                                        <i class="fas fa-eye view-icon"></i> View
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No approved purchase orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include '../../pclasses/footer.php'; ?>

<script>
    $(document).ready(function() {
    initializeMonthDropdown();
    initializeYearDropdown();

    $('#selectedMonthDiv').hide(); 
    $('#selectedYearDiv').hide();
    $('#selectedYearMonthlyDiv').hide();

   
    function getWeekStart(date) {
        var day = date.getDay();
        var diff = date.getDate() - day + (day === 0 ? -6 : 1); // Adjust for Sunday
        return new Date(date.setDate(diff));
    }

    function getWeekEnd(date) {
        var day = date.getDay();
        var diff = date.getDate() - day + (day === 0 ? -6 : 1); // Adjust for Sunday
        return new Date(date.setDate(diff + 6));
    }


    // Function to initialize the month dropdown
    function initializeMonthDropdown() {
        var months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        var monthDropdown = $('#selectedMonth');
        for (var i = 0; i < months.length; i++) {
            monthDropdown.append('<option value="' + (i + 1) + '">' + months[i] + '</option>');
        }
    }

    function initializeYearDropdown() {
        var currentYear = new Date().getFullYear();
        var yearDropdown = $('#selectedYear');
        for (var i = 0; i < 5; i++) {
            yearDropdown.append('<option value="' + (currentYear - i) + '">' + (currentYear - i) + '</option>');
        }
        var yearDropdownMonthly = $('#selectedYearMonthly');
        for (var i = 0; i < 5; i++) {
            yearDropdownMonthly.append('<option value="' + (currentYear - i) + '">' + (currentYear - i) + '</option>');
        }
    }

    function getMonthName(monthNum) {
        var months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        return months[monthNum - 1]; 
    }

    $('#reportType').change(function() {
        if ($(this).val() === 'Monthly') {
            $('#selectedMonthDiv').show();
            $('#selectedYearDiv').hide(); 
            $('#selectedYearMonthlyDiv').show(); 
        } else if ($(this).val() === 'Yearly') {
            $('#selectedMonthDiv').hide(); 
            $('#selectedYearDiv').show(); 
            $('#selectedYearMonthlyDiv').hide(); 
        } else {
            $('#selectedMonthDiv').hide(); 
            $('#selectedYearDiv').hide(); 
            $('#selectedYearMonthlyDiv').hide();
        }
    });
    $('#generateReportBtn').click(function() {
        var reportType = $('#reportType').val();
        var selectedMonth = $('#selectedMonth').val();
        var selectedYear = $('#selectedYear').val();
        var selectedYearMonthly = $('#selectedYearMonthly').val();
        var poType = $('#poType').val();

        var url = 'generate_report.php?' + 
            'reportType=' + reportType + 
            '&selectedMonth=' + selectedMonth + 
            '&selectedYear=' + selectedYear +
            '&selectedYearMonthly=' + selectedYearMonthly +
            '&poType=' + poType;

        window.open(url, '_blank');
    });
});
</script>