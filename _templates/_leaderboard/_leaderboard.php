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
    <style>
      body {
        background: url('https://wallpaperaccess.com/full/8357713.jpg') no-repeat center center fixed;
        background-size: cover;
      }
      .bg-black-trans {
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(3px);
        border-radius: 1.2rem;
      }
      .floating-btn {
        position: fixed;
        bottom: 32px;
        right: 32px;
        background: #22d3ee;
        color: #222831;
        font-weight: bold;
        border-radius: 2rem;
        padding: 0.85rem 2.3rem;
        font-size: 1.1rem;
        z-index: 100;
        box-shadow: 0 6px 20px #22d3ee66;
        cursor: pointer;
        border: none;
        transition: background 0.2s;
      }
      .floating-btn:hover {
        background: #0ff1c6;
        color: #161b22;
      }
      .modal-bg {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(34, 34, 49, 0.85);
        z-index: 101;
        justify-content: center;
        align-items: center;
      }
      .modal-content {
        background: #181e2a;
        color: #e2e8f0;
        border-radius: 1rem;
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 420px;
        width: 90%;
        box-shadow: 0 12px 40px #22d3ee55;
        text-align: left;
        position: relative;
      }
      .modal-content h2 {
        color: #22d3ee;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1.2rem;
      }
      .modal-content ul {
        margin-left: 1.2rem;
        margin-bottom: 1.2rem;
      }
      .modal-content li {
        margin-bottom: 0.7rem;
        font-size: 1.05rem;
      }
      .modal-close {
        position: absolute;
        top: 1.1rem;
        right: 1.3rem;
        font-size: 1.6rem;
        color: #22d3ee;
        background: none;
        border: none;
        cursor: pointer;
        font-weight: bold;
      }
      .difficulty-list {
        margin-bottom: 1.2rem;
      }
      .difficulty-list li {
        margin-bottom: 0.4rem;
        font-size: 1rem;
        padding-left: 0.1em;
      }
      .easy {
        color: #38bdf8;
        font-weight: bold;
      }
      .normal {
        color: #facc15;
        font-weight: bold;
      }
      .hard {
        color: #ef4444;
        font-weight: bold;
      }
      /* Leaderboard View Toggle */
      .lb-view-toggle {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        justify-content: flex-end;
      }
      .lb-view-btn {
        padding: 0.5rem 1.2rem;
        background: #222b3a;
        color: #22d3ee;
        font-weight: bold;
        border-radius: 0.5rem;
        border: 2px solid #22d3ee;
        cursor: pointer;
        transition: background 0.2s, color 0.2s, border-color 0.2s;
      }
      .lb-view-btn.active, .lb-view-btn:hover {
        background: #22d3ee;
        color: #161b22;
        border-color: #0ff1c6;
      }
      /* Glow for current user row */
      .glow-row {
        background: linear-gradient(90deg, #1e293b 85%, #22d3ee55 100%);
        box-shadow: 0 0 22px #22d3eeaa;
        color: #fff;
        font-weight: bold;
        border-left: 4px solid #22d3ee;
      }
      .recent-history-card {
        background: #1c212b;
        color: #e2e8f0;
        padding: 1.2rem;
        border-radius: 0.7rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 20px #22d3ee22;
        max-width: 400px;
        margin-left: auto;
      }
      @media (max-width: 500px) {
        .modal-content { padding: 1.4rem 0.7rem; }
        .recent-history-card { max-width: 100%; }
      }
    </style>
</head>
<body class="text-white font-sans">

<!-- Floating Button -->
<button class="floating-btn" id="showModalBtn">
  How to Acquire Points
</button>

<!-- Modal -->
<div class="modal-bg" id="modalBg">
  <div class="modal-content">
    <button class="modal-close" id="closeModalBtn">&times;</button>
    <h2>How to Acquire Points</h2>
    <ul>
      <li><strong>Play Quizzes:</strong> Earn points based on difficulty:</li>
      <ul class="difficulty-list">
        <li class="easy">Easy: 1–20 pts</li>
        <li class="normal">Normal: 20–50 pts</li>
        <li class="hard">Hard: 50–100 pts</li>
      </ul>
      <li><strong>Project Submission:</strong> Submit verified projects to earn <span class="text-blue-400 font-bold">20–100 pts</span> per project, based on complexity and approval.</li>
      <li><strong>CTF & Challenges:</strong> Participate in CTFs and coding challenges for <span class="text-pink-400 font-bold">15–80 pts</span> each, with higher points for harder challenges.</li>
      <li><strong>Achievements & Badges:</strong> Special achievements can grant bonus points up to <span class="text-yellow-400 font-bold">150 pts</span>.</li>
      <li><strong>Leaderboard Placement:</strong> Top rankings earn extra points and recognition!</li>
    </ul>
    <div class="text-sm text-gray-400 mt-2">
      <span class="font-bold text-blue-300">Tip:</span> More participation = more points. Verified submissions and high scores unlock special badges and extra rewards!
    </div>
  </div>
</div>

<section id="leaderboard" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-6xl mx-auto px-6 bg-black-trans">
        <h2 class="text-4xl font-bold mb-8 shine">Leaderboard & Ranking</h2>
        
        <!-- Recent History -->
        <div class="recent-history-card">
            <h3 class="font-bold text-lg mb-2">Recent History</h3>
            <ul class="text-sm">
                <li><span class="text-blue-400 font-bold">[Points Earned]</span> Guruprasanth played <a href="#" class="underline text-pink-400">Hard Quiz</a> and earned <span class="text-yellow-400 font-bold">70 pts</span>!</li>
                <li><span class="text-green-400 font-bold">[Project]</span> Guruprasanth submitted <a href="#" class="underline text-blue-400">Attendance Tracker</a> and received <span class="text-blue-400 font-bold">90 pts</span>.</li>
                <li><span class="text-pink-400 font-bold">[Challenge]</span> Completed <a href="#" class="underline text-pink-400">CTF #5</a> - <span class="text-yellow-400 font-bold">45 pts</span></li>
                <li><span class="text-yellow-400 font-bold">[Badge]</span> Achievement unlocked: <span class="text-green-400 font-bold">Quiz Master</span> (+100 pts)</li>
            </ul>
        </div>

        <!-- User Level & Progress -->
        <div class="flex flex-wrap gap-8 items-center mb-8">
            <div class="flex-1 min-w-[350px] bg-gray-900 p-8 rounded-xl shadow-lg flex items-center gap-5">
                <img src="/project/assets/images/logo.png" alt="Level Icon" class="h-16 w-16 rounded-full border-2 border-blue-400 shadow">
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
                <div class="font-bold text-2xl text-yellow-400" id="rankNum">#04</div>
                <div class="text-xs text-gray-300">Global Ranking</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-orange-400" id="zealNum">462</div>
                <div class="text-xs text-gray-300">Zeal Acquired</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-blue-300" id="joltNum">107</div>
                <div class="text-xs text-gray-300">Jolt Acquired</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-purple-300" id="quizNum">23</div>
                <div class="text-xs text-gray-300">Quiz Completed</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-pink-300" id="challengesNum">8</div>
                <div class="text-xs text-gray-300">Challenges Completed</div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6 text-center">
                <div class="font-bold text-2xl text-gray-200" id="achievementsNum">4</div>
                <div class="text-xs text-gray-300">Achievements Acquired</div>
            </div>
        </div>

        <!-- Internal/Global Toggle -->
        <div class="lb-view-toggle">
            <button class="lb-view-btn active" id="globalViewBtn">Global</button>
            <button class="lb-view-btn" id="internalViewBtn">Internal (SNA)</button>
        </div>

        <!-- Category Filter -->
        <div class="mb-8">
            <form id="categoryForm" class="flex gap-4 items-center">
                <label for="category" class="text-lg font-bold text-gray-300">Leaderboard Category:</label>
                <select id="category" name="category" class="bg-gray-800 text-white rounded px-4 py-2">
                    <option value="overall">Overall</option>
                    <option value="quiz">Quiz</option>
                    <option value="ctf">CTF</option>
                    <option value="hackathon">Hackathon</option>
                    <option value="projects">Projects</option>
                </select>
            </form>
        </div>

        <!-- Leaderboard Table -->
        <div class="bg-gray-900 rounded-xl p-8 mb-8 overflow-x-auto">
            <h3 class="font-bold text-xl mb-4">Leaderboard Table</h3>
            <table class="w-full table-auto text-sm" id="leaderboardTable">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="px-4 py-2">Rank</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Batch</th>
                        <th class="px-4 py-2">College</th>
                        <th class="px-4 py-2">Points</th>
                        <th class="px-4 py-2">Achievements</th>
                    </tr>
                </thead>
                <tbody id="lbBody">
                    <!-- Table rows will be injected by JS -->
                </tbody>
            </table>
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
    </div>
</section>

<script>
// Modal logic
document.getElementById('showModalBtn').onclick = function() {
  document.getElementById('modalBg').style.display = 'flex';
};
document.getElementById('closeModalBtn').onclick = function() {
  document.getElementById('modalBg').style.display = 'none';
};
document.getElementById('modalBg').onclick = function(e) {
  if (e.target === this) this.style.display = 'none';
};

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

// Different stats for global/internal
const statsGlobal = {rank: 202, zeal: 462, jolt: 107, quiz: 23, challenges: 8, achievements: 4};
const statsInternal = {rank: 7, zeal: 239, jolt: 19, quiz: 14, challenges: 4, achievements: 2};

// Leaderboard sample data (50 members, Guruprasanth glows, SNA college for internal, different order/points for internal)
const leaderboardDataGlobal = [
    {rank: 1, name: "Alice Smith", category: "Quiz", batch: "2022", college: "SNA", points: 980, achievements: "Quiz Master"},
    {rank: 2, name: "Bob Johnson", category: "Hackathon", batch: "2023", college: "TechU", points: 950, achievements: "Hackathon Winner"},
    {rank: 3, name: "Charlie Lee", category: "CTF", batch: "2024", college: "CyberTech", points: 945, achievements: "CTF Top 5"},
    {rank: 4, name: "Guruprasanth", category: "Quiz", batch: "2025", college: "SNA", points: 940, achievements: "Quiz Master"},
    {rank: 5, name: "Diana Patel", category: "Projects", batch: "2022", college: "SNA", points: 930, achievements: "Innovation Badge"},
    {rank: 6, name: "Ethan Brown", category: "Quiz", batch: "2023", college: "TechU", points: 925, achievements: "Quiz Master"},
    {rank: 7, name: "Fiona Green", category: "CTF", batch: "2024", college: "CyberTech", points: 920, achievements: "CTF Top 5"},
    {rank: 8, name: "Hassan Ali", category: "Hackathon", batch: "2023", college: "TechU", points: 915, achievements: "Hackathon Winner"},
    {rank: 9, name: "Isha Singh", category: "Projects", batch: "2022", college: "SNA", points: 910, achievements: "Innovation Badge"},
    {rank: 10, name: "James Bond", category: "CTF", batch: "2024", college: "CyberTech", points: 905, achievements: "CTF Top 5"},
];
for(let i=11; i<=50; i++) {
    leaderboardDataGlobal.push({
        rank: i,
        name: i===33 ? "Guruprasanth" : "Student " + i,
        category: ["Quiz","CTF","Hackathon","Projects"][i%4],
        batch: 2020 + (i%6),
        college: i%3===0 ? "SNA" : (i%3===1 ? "TechU" : "CyberTech"),
        points: 900 - i*3 + (i===33 ? 888 : 0),
        achievements: i%5===0 ? "Quiz Master" : (i%5===1 ? "Hackathon Winner" : (i%5===2 ? "Innovation Badge" : (i%5===3 ? "CTF Top 5" : "Top 10"))),
    });
}
// Internal: Only SNA, different points/order for demo
const leaderboardDataInternal = leaderboardDataGlobal
    .filter(d => d.college === "SNA")
    .map((d, idx) => ({
        ...d,
        rank: idx + 1,
        points: 400 + (leaderboardDataGlobal.length-idx)*5 + (d.name==="Guruprasanth" ? 100 : 0) // Guruprasanth gets a boost
    }));

// Render leaderboard table
function renderLeaderboard(category = "overall", view = "global") {
    const tbody = document.getElementById('lbBody');
    tbody.innerHTML = "";
    let source = view === "global" ? leaderboardDataGlobal : leaderboardDataInternal;
    let filtered = source;
    if (category !== "overall") {
        filtered = source.filter(d => d.category.toLowerCase() === category);
    }
    filtered.forEach(data => {
        const tr = document.createElement('tr');
        // Glow Guruprasanth
        if(data.name.toLowerCase().includes("guruprasanth")) {
            tr.className = "glow-row";
        }
        tr.innerHTML = `
            <td class="px-4 py-2">${data.rank}</td>
            <td class="px-4 py-2 font-bold"><a href="#">${data.name}</a></td>
            <td class="px-4 py-2">${data.category}</td>
            <td class="px-4 py-2">${data.batch}</td>
            <td class="px-4 py-2">${data.college}</td>
            <td class="px-4 py-2">${data.points}</td>
            <td class="px-4 py-2">${data.achievements}</td>
        `;
        tbody.appendChild(tr);
    });
}

// Leaderboard view toggle logic
let leaderboardView = "global";
function updateStats(view) {
    const s = view === "global" ? statsGlobal : statsInternal;
    document.getElementById("rankNum").textContent = `#${s.rank}`;
    document.getElementById("zealNum").textContent = s.zeal;
    document.getElementById("joltNum").textContent = s.jolt;
    document.getElementById("quizNum").textContent = s.quiz;
    document.getElementById("challengesNum").textContent = s.challenges;
    document.getElementById("achievementsNum").textContent = s.achievements;
}
document.getElementById("globalViewBtn").onclick = function() {
    leaderboardView = "global";
    this.classList.add("active");
    document.getElementById("internalViewBtn").classList.remove("active");
    updateStats(leaderboardView);
    renderLeaderboard(document.getElementById('category').value, leaderboardView);
};
document.getElementById("internalViewBtn").onclick = function() {
    leaderboardView = "internal";
    this.classList.add("active");
    document.getElementById("globalViewBtn").classList.remove("active");
    updateStats(leaderboardView);
    renderLeaderboard(document.getElementById('category').value, leaderboardView);
};

// Filter leaderboard on category change
document.getElementById('category').addEventListener('change', function() {
    renderLeaderboard(this.value, leaderboardView);
});

// Initial leaderboard render
updateStats(leaderboardView);
renderLeaderboard("overall", leaderboardView);
</script>

</body>
</html>