<?php
// leaderboard.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard – SkillSphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-black text-white font-sans">

<!-- Leaderboard Section -->
<section id="leaderboard" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Leaderboard & Ranking</h2>
        
        <!-- User Level & Progress -->
        <div class="flex flex-wrap gap-8 items-center mb-8">
            <div class="flex-1 min-w-[350px] bg-gray-900 p-8 rounded-xl shadow-lg flex items-center gap-5">
                <img src="https://cdn.dribbble.com/users/234582/screenshots/15683357/media/4e3e56b6a7e2e8e6e2f5eebfcb5cbe0b.png?compress=1&resize=120x120" alt="Level Icon" class="h-16 w-16 rounded-full border-2 border-blue-400 shadow">
                <div>
                    <div class="text-2xl font-bold text-blue-300">Nightcrawler III</div>
                    <div class="flex items-center gap-2 text-gray-400 mt-1">
                        <span>Progress Towards:</span>
                        <span class="font-bold text-white">Nightcrawler IV</span>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <div class="w-60 bg-gray-700 rounded-full h-3">
                            <div class="bg-gradient-to-r from-orange-400 via-pink-500 to-yellow-300 h-3 rounded-full" style="width: 80%;"></div>
                        </div>
                        <span class="text-orange-400 font-bold ml-2">490 <span class="text-lg">🔥</span></span>
                    </div>
                </div>
            </div>
            <div class="flex-1 min-w-[350px] bg-gray-900 p-8 rounded-xl shadow-lg flex flex-col justify-center">
                <div class="font-bold text-gray-200 mb-2">Total Achievements Earned: <span class="text-yellow-400">4</span></div>
                <div class="text-gray-400">Quiz Master, Hackathon Winner, Innovation Badge, CTF Top 5</div>
            </div>
        </div>

        <!-- Stats Panel -->
        <div class="grid grid-cols-2 md:grid-cols-6 gap-6 mb-8">
            <div class="bg-gray-800 rounded-lg p-6 text-center flex flex-col items-center">
                <img src="https://img.icons8.com/color/48/trophy.png" class="h-8 w-8 mb-2">
                <div class="font-bold text-2xl text-yellow-400">#202</div>
                <div class="text-xs text-gray-300">Global Ranking</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-orange-400">462</div>
                <div class="text-xs text-gray-300">Zeal Acquired</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-blue-300">107</div>
                <div class="text-xs text-gray-300">Jolt Acquired</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-purple-300">23</div>
                <div class="text-xs text-gray-300">Quiz Completed</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-pink-300">8</div>
                <div class="text-xs text-gray-300">Challenges Completed</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-gray-200">4</div>
                <div class="text-xs text-gray-300">Achievements Acquired</div>
            </div>
        </div>

        <!-- Progress Chart -->
        <div class="bg-gray-900 rounded-xl p-8 mb-8">
            <div class="flex gap-3 mb-2">
                <button onclick="updateChart('week')" class="bg-gray-800 px-3 py-1 rounded text-white">1W</button>
                <button onclick="updateChart('month')" class="bg-gray-800 px-3 py-1 rounded text-gray-400">1M</button>
                <button onclick="updateChart('3m')" class="bg-gray-800 px-3 py-1 rounded text-gray-400">3M</button>
                <button onclick="updateChart('6m')" class="bg-gray-800 px-3 py-1 rounded text-gray-400">6M</button>
                <button onclick="updateChart('year')" class="bg-gray-800 px-3 py-1 rounded text-gray-400">1Y</button>
            </div>
            <canvas id="progressChart" height="120"></canvas>
            <div class="flex gap-4 mt-2">
                <span class="text-pink-400 font-bold">● Quiz</span>
                <span class="text-blue-400 font-bold">● Challenges</span>
            </div>
        </div>

        <!-- Leaderboard Table -->
        <div class="bg-gray-900 rounded-xl p-8 mb-8 overflow-x-auto">
            <h3 class="font-bold text-xl mb-4">Leaderboard Table</h3>
            <table class="w-full table-auto text-sm">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="px-4 py-2">Rank</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Batch</th>
                        <th class="px-4 py-2">College</th>
                        <th class="px-4 py-2">Points</th>
                        <th class="px-4 py-2">Achievements</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2 font-bold">Alice Smith</td>
                        <td class="px-4 py-2">2022</td>
                        <td class="px-4 py-2">SNA</td>
                        <td class="px-4 py-2">980</td>
                        <td class="px-4 py-2">Quiz Master</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2 font-bold">Bob Johnson</td>
                        <td class="px-4 py-2">2023</td>
                        <td class="px-4 py-2">TechU</td>
                        <td class="px-4 py-2">900</td>
                        <td class="px-4 py-2">Hackathon Winner</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
// Chart.js sample data
let chartData = {
    week: {labels:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"], quiz:[2,3,5,4,6,4,3], challenges:[1,2,3,2,2,1,2]},
    month: {labels:["Week 1","Week 2","Week 3","Week 4"], quiz:[10,12,8,14], challenges:[5,8,7,9]},
    "3m": {labels:["Jul","Aug","Sep"], quiz:[30,25,28], challenges:[15,18,20]},
    "6m": {labels:["Apr","May","Jun","Jul","Aug","Sep"], quiz:[10,16,25,30,25,28], challenges:[8,12,15,18,18,20]},
    year: {labels:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep"], quiz:[5,8,12,10,16,25,30,25,28], challenges:[2,4,7,8,12,15,18,18,20]},
};
let chart;
function renderChart(type="week") {
    const ctx = document.getElementById('progressChart').getContext('2d');
    if (chart) chart.destroy();
    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData[type].labels,
            datasets: [
                {
                    label: "Quiz",
                    data: chartData[type].quiz,
                    borderColor: "#ec4899",
                    backgroundColor: "rgba(236,72,153,0.2)",
                    tension: 0.4
                },
                {
                    label: "Challenges",
                    data: chartData[type].challenges,
                    borderColor: "#3b82f6",
                    backgroundColor: "rgba(59,130,246,0.2)",
                    tension: 0.4
                }
            ]
        },
        options: {
            plugins: { legend: { labels: {color:'#fff'} } },
            scales: { x: { ticks: {color:'#fff'} }, y: { ticks: {color:'#fff'} } }
        }
    });
}
function updateChart(type) { renderChart(type); }
document.addEventListener('DOMContentLoaded', ()=>renderChart('week'));
</script>

</body>
</html>
