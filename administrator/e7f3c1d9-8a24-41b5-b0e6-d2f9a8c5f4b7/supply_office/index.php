<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
require '../classes/supply_config.php';

?>
<title>Supply Office</title>
<main class="container mt-5 custom-container">
    <h2>Supply Office Dashboard</h2>
    <div class="card-container mt-4">
        <div class="card green">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-check-circle"></i></span> 
            </div>
                <h3><?php echo $totalDelivered; ?></h3>
                <p>Arrived Item's</p>
                <a href="arrived_items">View Details</a>
            </div>
            
            <div class="card yellow">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-hourglass-half"></i></i></span> 
            </div>
                <h3><?php echo $pendingIAR; ?></h3>
                <p>Pending IAR's</p>
                <a href="pending_iar">View Details</a>
            </div>
    
            <div class="card bg">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-users"></i></span> 
            </div>
                <h3><?php echo $allIAR; ?></h3>
                <p>All IAR's</p>
                <a href="all_iar">View Details</a>
            </div>
        </div>

        <!-- Left and Right side containers below -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="left-container bg-white p-4 border shadow-sm">
                <h4>Inspection and Acceptance Report's Generated Monthly</h4>
                <div class="chart-container">
            <canvas id="iarChart"></canvas>
        </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="right-container bg-white p-4 border shadow-sm">
                <h4>Inspection and Acceptance Report's (Yearly)</h4>
                <div class="chart-container">
                <canvas id="iarLineChart"></canvas>
            </div>
            </div>
        </div>
    </div>
   
</main>
<?php include '../../aclasses/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Get the monthly IAR counts from PHP
    var monthlyCounts = <?php echo json_encode($monthlyIARCounts); ?>;

    // Yearly IAR Line Chart
    var ctxLine = document.getElementById('iarLineChart').getContext('2d');
    var iarLineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'IAR Count (Yearly)',
                data: monthlyCounts,  // The counts passed from PHP to JS
                fill: false,
                borderColor: 'blue',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

   // Data for Pie Chart
   const pieLabels = <?php echo json_encode($monthsYears); ?>; // Correct data source
    const pieData = <?php echo json_encode($counts); ?>;

    // Pie Chart
    const pieCtx = document.getElementById('iarChart').getContext('2d');
    const iarChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                label: 'Inspection and Acceptance Reports',
                data: pieData,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Monthly Inspection and Acceptance Reports' }
            }
        }
    });
</script>