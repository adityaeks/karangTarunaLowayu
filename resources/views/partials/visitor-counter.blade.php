<div class="visitor-stats card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-chart-bar mr-2"></i> Statistik Pengunjung</h5>
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><i class="fas fa-users text-primary"></i> Total Pengunjung</span>
                <span class="badge bg-primary rounded-pill" id="total-visitors">0</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><i class="fas fa-calendar-day text-success"></i> Hari Ini</span>
                <span class="badge bg-success rounded-pill" id="today-visitors">0</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><i class="fas fa-wifi text-danger"></i> Online</span>
                <span class="badge bg-danger rounded-pill" id="online-visitors">0</span>
            </li>
        </ul>
    </div>
</div>

<script>
    // Function to update visitor statistics
    function updateVisitorStats() {
        fetch('/api/visitor-stats')
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-visitors').textContent = data.total;
                document.getElementById('today-visitors').textContent = data.today;
                document.getElementById('online-visitors').textContent = data.online;
            })
            .catch(error => console.error('Error fetching visitor stats:', error));
    }

    // Update stats when page loads and every 60 seconds
    document.addEventListener('DOMContentLoaded', function() {
        updateVisitorStats();
        setInterval(updateVisitorStats, 60000);
    });
</script>
