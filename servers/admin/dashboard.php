<!-- Remove this line -->
<link href="https://cdn.tailwindcss.com" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<body class="bg-gray-900 text-white">
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-800 p-4 rounded-xl">
                <h2 class="text-gray-400 text-sm">Total Revenue</h2>
                <p class="text-xl font-bold">$1,250.00</p>
                <p class="text-green-400 text-xs mt-1">+12.3% from last month</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-xl">
                <h2 class="text-gray-400 text-sm">New Customers</h2>
                <p class="text-xl font-bold">1,234</p>
                <p class="text-red-400 text-xs mt-1">-20% this period</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-xl">
                <h2 class="text-gray-400 text-sm">Active Accounts</h2>
                <p class="text-xl font-bold">45,678</p>
                <p class="text-green-400 text-xs mt-1">+12.8% goal achieved</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-xl">
                <h2 class="text-gray-400 text-sm">Growth Rate</h2>
                <p class="text-xl font-bold">4.5%</p>
                <p class="text-green-400 text-xs mt-1">+4.2% performance</p>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-xl">
            <h2 class="text-lg font-semibold mb-4">Total Visitors</h2>
            <canvas id="visitorsChart" height="100"></canvas>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('visitorsChart').getContext('2d');
        const visitorsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: Array.from({ length: 30 }, (_, i) => `Day ${i + 1}`),
                datasets: [{
                    label: 'Visitors',
                    data: Array.from({ length: 30 }, () => Math.floor(Math.random() * 100)),
                    backgroundColor: 'rgba(255, 165, 0, 0.2)',
                    borderColor: 'orange',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#ccc' }, grid: { color: '#444' } },
                    y: { ticks: { color: '#ccc' }, grid: { color: '#444' } }
                }
            }
        });
    </script>
</body>

</html>