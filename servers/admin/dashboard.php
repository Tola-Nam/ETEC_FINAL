<!-- Remove this line -->
<link href="https://cdn.tailwindcss.com" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<body class="bg-gray-900 text-white">
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-800 p-4 rounded-xl">
                <h2 class="text-gray-400 text-sm">Total Revenue</h2>
                <p class="text-xl font-bold text-gray-400">$1,250.00</p>
                <p class="text-green-400 text-xs mt-1">+12.3% from last month</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-xl">
                <h2 class="text-gray-400 text-sm">New Customers</h2>
                <p class="text-xl font-bold text-gray-400">1,234</p>
                <p class="text-red-400 text-xs mt-1">-20% this period</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-xl">
                <h2 class="text-gray-400 text-sm">Active Accounts</h2>
                <p class="text-xl font-bold text-gray-400">45,678</p>
                <p class="text-green-400 text-xs mt-1">+12.8% goal achieved</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-xl">
                <h2 class="text-gray-400 text-sm">Growth Rate</h2>
                <p class="text-xl font-bold text-gray-400">4.5%</p>
                <p class="text-green-400 text-xs mt-1">+4.2% performance</p>
            </div>
        </div>

        <!-- Chart and Table Side by Side -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Chart Section -->
            <div class="md:w-1/2 bg-gray-800 p-6 rounded-xl">
                <h2 class="text-lg font-semibold mb-4 text-gray-400">AVERAGE OF SALE FOR MONTH</h2>
                <canvas id="visitorsChart" height="100"></canvas>
            </div>

            <!-- Table Section -->
            <div class="md:w-1/2 bg-white rounded-xl shadow p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-700">Teammates</h3>
                    <button class="text-sm text-gray-500 hover:text-gray-700">
                        Filters
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase border-b">
                            <tr>
                                <th class="py-2">Name</th>
                                <th>Status</th>
                                <th>Unassigned</th>
                                <th>Waiting</th>
                                <th>Open</th>
                                <th>Idle</th>
                                <th>Total</th>
                                <th>Longest</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t">
                                <td class="py-2">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-300 shadow-sm">
                                            <img src="https://d2zp5xs5cp8zlg.cloudfront.net/image-59328-800.jpg"
                                                alt="Profile" class="w-full h-full object-cover">
                                        </div>
                                        <span class="text-gray-800 font-medium">Terrence Purdy</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Online</span>
                                </td>
                                <td>6</td>
                                <td>6</td>
                                <td>49</td>
                                <td>41</td>
                                <td>96</td>
                                <td>5 years</td>
                            </tr>
                            <tr class="border-t">
                                <td class="py-2">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-300 shadow-sm">
                                            <img src="https://d2zp5xs5cp8zlg.cloudfront.net/image-59328-800.jpg"
                                                alt="Profile" class="w-full h-full object-cover">
                                        </div>
                                        <span class="text-gray-800 font-medium">Terrence Purdy</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Online</span>
                                </td>
                                <td>13</td>
                                <td>9</td>
                                <td>264</td>
                                <td>238</td>
                                <td>502</td>
                                <td>10 months</td>
                            </tr>
                            <tr class="border-t">
                                <td class="py-2 flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                                    Randy King
                                </td>
                                <td>
                                    <span class="bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Online</span>
                                </td>
                                <td>22</td>
                                <td>14</td>
                                <td>328</td>
                                <td>226</td>
                                <td>554</td>
                                <td>1 year</td>
                            </tr>
                            <tr class="border-t">
                                <td class="py-2 flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                                    Cheryl Ryan
                                </td>
                                <td>
                                    <span class="bg-yellow-100 text-yellow-600 px-2 py-0.5 rounded-full">Away</span>
                                </td>
                                <td>19</td>
                                <td>14</td>
                                <td>56</td>
                                <td>37</td>
                                <td>93</td>
                                <td>1 year</td>
                            </tr>
                            <tr class="border-t">
                                <td class="py-2 flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                                    Pauline Delcourt
                                </td>
                                <td>
                                    <span class="bg-gray-200 text-gray-500 px-2 py-0.5 rounded-full">Offline</span>
                                </td>
                                <td>32</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>134</td>
                                <td>1 month</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
                    backgroundColor: 'hsla(39, 100.00%, 50.00%, 0.20)',
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