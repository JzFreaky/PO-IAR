<?php
require '../../class/function/config.php';
require '../../class/function/inspector_config.php';
include '../../../database/db.php';
include '../../../sclasses/header.php';
include '../../../sclasses/navbar.php';
require '../../class/function/inspector.php';
?>
<title>All IAR</title>
<main class="container mt-5 custom-container">
<div class="table-responsive"> 
<div class="row mb-3">
    <div class="col-md-12"> 
        <div class="report-header"> 
            <h2>All Inspection and Acceptance Report's</h2>
            <div class="button-container float-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal">
                    <i class="fas fa-file-download"></i> Generate Report
                </button>
            </div>
        </div>
    </div>
</div>
    <table id="iarTable" class="table table-striped table-bordered" style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 70px;">IAR No.</th>
                <th style="width: 200px;">P.O. No./Date</th>
                <th style="width: 150px;">Requestor</th>
                <th style="width: 200px;">Requisitioning Office</th>
                <th style="width: 80px;">Date</th>
                <th style="width: 70px;">Type</th>
                <th style="width: 50px;">Action</th>
                <th class="d-none">Item Descriptions</th> 
            </tr>
        </thead>
        <?php if (!empty($allIARs)): ?>
                <?php foreach ($allIARs as $iar): ?>
                    <tr <?php if ($iar['iaiar_new'] == 1) { echo 'class="pulsing-color"'; } ?>>
                        <td><?php echo htmlspecialchars($iar['iar_no']); ?></td>
                        <td><?php echo htmlspecialchars($iar['po_no']); ?></td>
                        <td><?php echo htmlspecialchars($iar['requestor']); ?></td>
                        <td><?php echo htmlspecialchars($iar['req_office']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($iar['date'])); ?></td>
                        <td>
                        <?php 
                            if ($iar['property_custodian_status'] === 'complete') {
                                echo '<span class="badge badge-success">Complete</span>';
                            } elseif ($iar['property_custodian_status'] === 'partial') {
                                echo '<span class="badge badge-warning">Partial</span>';
                            } elseif ($iar['property_custodian_status'] === 'accept/not correct specs') {
                                echo '<span class="badge badge-secondary">Accept/Not Correct Specs</span>';
                            } elseif ($iar['property_custodian_status'] === 'rejected') {
                                echo '<span class="badge badge-danger">Rejected</span>';
                            } elseif ($iar['property_custodian_status'] === 'pending') {
                                echo '<span class="badge badge-info">Pending</span>';
                            }
                            ?>
                        </td>
                        <td class="d-none"><?php echo htmlspecialchars($iar['item_descriptions']); ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary" type="button" id="dropdownMenuButton<?php echo $iar['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $iar['id']; ?>">
                                    <a class="dropdown-item ai-dropdown-item" href="view_iar.php?id=<?php echo $iar['id']; ?>&update_iaiar=1"><i class="fas fa-eye view-icon"></i> View</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
<!-- Modal for Report Generation -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                    <label for="iarType">IAR Type:</label>
                    <select class="form-control" id="iarType">
                        <option value="All">All</option>
                        <option value="complete">Complete</option>
                        <option value="partial">Partial</option>
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

</main>

<?php include '../../../sclasses/footer.php'; ?>
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
        var iarType = $('#iarType').val();

        var url = 'generate_report.php?' + 
            'reportType=' + reportType + 
            '&selectedMonth=' + selectedMonth + 
            '&selectedYear=' + selectedYear +
            '&selectedYearMonthly=' + selectedYearMonthly +
            '&iarType=' + iarType;

        window.open(url, '_blank');
    });

});
</script>