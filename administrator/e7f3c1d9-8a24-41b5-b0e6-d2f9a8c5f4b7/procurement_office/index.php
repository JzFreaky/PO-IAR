<?php
require '../classes/config.php';
include '../../database/db.php';
include '../../aclasses/header.php';
include '../../aclasses/navbar.php';
require '../classes/procurement_config.php';

?>
<title>Procurement Office</title>
<main class="container mt-5 custom-container">
    <h2>Procurement Office Dashboard</h2>
    <div class="card-container mt-4">
        <div class="card yellow">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-hourglass-half"></i></span> 
            </div>
            <h3><?php echo $pendingPO; ?></h3>
            <p>Pending Purchase Orders</p>
            <a href="pending_po">View Details</a>
        </div>

        <div class="card red">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-ban"></i></span> 
            </div>
            <h3><?php echo $canceledPO; ?></h3>
            <p>Canceled Purchase Orders</p>
            <a href="canceled_po">View Details</a>
        </div>

        <div class="card green">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-check-circle"></i></span> 
            </div>
            <h3><?php echo $approvedPO; ?></h3>
            <p>Approved Purchase Orders</p>
            <a href="approved_po">View Details</a>
        </div>

        <div class="card blue">
            <div class="icon-container"> 
                <span class="icon"><i class="fas fa-file-invoice"></i></span> 
            </div>
            <h3><?php echo $allPO; ?></h3>
            <p>All Purchase Orders</p>
            <a href="all_po">View Details</a>
        </div>
    </div>

    <!-- Left and Right side containers below -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="left-container bg-white p-4 border shadow-sm">
                <h4>Purchase Orders Generated Monthly</h4>
                <div class="chart-container">
    <canvas id="poChart"></canvas>
</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="right-container bg-white p-4 border shadow-sm">
                <h4>Purchase Orders (Yearly)</h4>
                <div class="chart-container">
        <canvas id="poLineChart"></canvas>
    </div>
            </div>
        </div>
    </div>
</main>

<?php include '../../aclasses/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for Pie Chart
    const pieLabels = <?php echo json_encode($monthsYears); ?>; // Correct data source
    const pieData = <?php echo json_encode($counts); ?>;

    // Pie Chart
    const pieCtx = document.getElementById('poChart').getContext('2d');
    const poChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                label: 'Purchase Orders',
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
                title: { display: true, text: 'Monthly Purchase Orders' }
            }
        }
    });

    // Data for Line Chart
    const lineLabels = <?php echo json_encode($years); ?>;
    const lineData = <?php echo json_encode($yearlyCounts); ?>;

    // Line Chart
    const lineCtx = document.getElementById('poLineChart').getContext('2d');
    const poLineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: lineLabels,
            datasets: [{
                label: 'Yearly Purchase Orders',
                data: lineData,
                borderColor: '#36A2EB',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.4 // Smooth curve
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Yearly Purchase Orders Trend' }
            },
            scales: {
                x: { title: { display: true, text: 'Year' } },
                y: { title: { display: true, text: 'Number of Orders' } }
            }
        }
    });
</script>