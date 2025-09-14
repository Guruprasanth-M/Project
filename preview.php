<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SkillSphere – Alumni/Student SPA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .shine { background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hover-glow:hover { box-shadow: 0 0 18px #3b82f6, 0 0 50px #6366f1; transition: box-shadow .3s; }
        .verified-badge { background: #22d3ee; color: #000; padding: 0.25rem 0.75rem; border-radius: 1rem; font-weight: bold; font-size: 0.8rem;}
        .status-badge { background: #22c55e; color: #fff; padding: 0.25rem 0.75rem; border-radius: 1rem; font-weight: bold; font-size: 0.8rem;}
        .high-contrast { filter: invert(1) hue-rotate(180deg); }
        .modal-bg { background: rgba(0,0,0,0.7); }
        .modal { z-index: 50; }
        .aria-hidden { display: none !important; }
    </style>
</head>
<body class="bg-black text-white font-sans">

<!-- Notifications Panel -->
<div id="notifications-panel" class="fixed top-16 right-5 z-50 w-80 bg-gray-900 rounded-lg shadow-lg p-5 hidden animate__animated animate__fadeInDown">
    <h3 class="font-bold text-lg text-blue-300 mb-3">Notifications</h3>
    <ul class="space-y-2">
        <li>🎉 Achievement unlocked: Quiz Master</li>
        <li>📩 New message from Alice Smith</li>
        <li>📅 Event Reminder: Hackathon starts in 2 hours</li>
    </ul>
</div>

<!-- Navbar -->
<nav class="bg-gray-900 shadow-lg sticky top-0 z-40 menu-gradient animate__animated animate__fadeInDown">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between py-4">
        <div class="flex items-center gap-3">
            <img src="https://academy.selfmade.ninja/assets/brand/logo-text-2.svg" alt="Logo" class="h-8 w-8 animate__animated animate__bounce animate__infinite">
            <span class="font-bold text-xl shine">SkillSphere</span>
        </div>
        <div class="hidden md:flex gap-6 items-center">
            <button onclick="showSection('dashboard')" class="hover:text-blue-200 font-semibold">Dashboard</button>
            <button onclick="showSection('profile')" class="hover:text-blue-200 font-semibold">Profile</button>
            <button onclick="showSection('leaderboard')" class="hover:text-blue-200 font-semibold">Leaderboard</button>
            <button onclick="showSection('directory')" class="hover:text-blue-200 font-semibold">Directory</button>
            <button onclick="showSection('jobs')" class="hover:text-blue-200 font-semibold">Jobs</button>
            <button onclick="showSection('events')" class="hover:text-blue-200 font-semibold">Events</button>
            <button onclick="showSection('practice')" class="hover:text-blue-200 font-semibold">Practice</button>
            <button onclick="showSection('project-submission')" class="hover:text-blue-200 font-semibold">Submit Project</button>
            <button onclick="showSection('messages')" class="hover:text-blue-200 font-semibold">Messages</button>
            <button onclick="showSection('qa')" class="hover:text-blue-200 font-semibold">Q&A</button>
            <button onclick="showSection('announcements')" class="hover:text-blue-200 font-semibold">Announcements</button>
        </div>
        <div class="flex gap-3 items-center">
            <button onclick="toggleContrast()" class="bg-gray-800 text-white px-3 py-1 rounded hover:bg-blue-700">A11y</button>
            <button onclick="toggleNotifications()" id="notif-bell" class="bg-gray-800 text-white px-3 py-1 rounded relative hover:bg-blue-700" aria-label="Notifications">
                <span>🔔</span>
                <span class="absolute top-[-6px] right-[-6px] bg-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">3</span>
            </button>
            <button onclick="showSection('auth')" class="border border-blue-400 text-blue-300 px-3 py-1 rounded hover:bg-blue-600 hover:text-white font-semibold">Login</button>
            <button onclick="toggleMenu()" class="md:hidden bg-gray-800 text-white px-3 py-1 rounded">&#9776;</button>
        </div>
    </div>
    <!-- Mobile Hamburger Menu -->
    <div id="mobileMenu" class="md:hidden hidden px-6 py-4 bg-gray-900 animate__animated animate__fadeInDown">
        <button onclick="showSection('dashboard')" class="block w-full text-left py-2">Dashboard</button>
        <button onclick="showSection('profile')" class="block w-full text-left py-2">Profile</button>
        <button onclick="showSection('leaderboard')" class="block w-full text-left py-2">Leaderboard</button>
        <button onclick="showSection('directory')" class="block w-full text-left py-2">Directory</button>
        <button onclick="showSection('jobs')" class="block w-full text-left py-2">Jobs</button>
        <button onclick="showSection('events')" class="block w-full text-left py-2">Events</button>
        <button onclick="showSection('practice')" class="block w-full text-left py-2">Practice</button>
        <button onclick="showSection('project-submission')" class="block w-full text-left py-2">Submit Project</button>
        <button onclick="showSection('messages')" class="block w-full text-left py-2">Messages</button>
        <button onclick="showSection('qa')" class="block w-full text-left py-2">Q&A</button>
        <button onclick="showSection('announcements')" class="block w-full text-left py-2">Announcements</button>
    </div>
</nav>

<!-- Loading Spinner -->
<div id="loading-spinner" class="fixed inset-0 flex items-center justify-center modal-bg z-50 hidden">
    <div class="animate-spin rounded-full h-24 w-24 border-t-4 border-b-4 border-blue-500"></div>
</div>

<!-- Confirmation Modal -->
<div id="confirm-modal" class="fixed inset-0 modal-bg flex items-center justify-center modal hidden">
    <div class="bg-gray-900 rounded-lg shadow-xl p-8 text-center">
        <h2 class="text-xl font-bold mb-3">Are you sure?</h2>
        <p class="mb-4">Do you want to proceed with this action?</p>
        <button onclick="closeModal(true)" class="bg-blue-600 px-4 py-2 rounded text-white mr-2">Yes</button>
        <button onclick="closeModal(false)" class="bg-gray-600 px-4 py-2 rounded text-white">No</button>
    </div>
</div>

<!-- ========== SPA Sections ========== -->

<!-- Dashboard Section -->
<section id="dashboard" class="section py-12 animate__animated animate__fadeIn hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Dashboard</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gray-800 p-6 rounded hover-glow">
                <h3 class="text-xl font-bold mb-2">Quick Stats</h3>
                <ul class="list-disc list-inside text-gray-300">
                    <li>Points: <span class="font-bold text-blue-300">462</span></li>
                    <li>Rank: <span class="font-bold text-yellow-300">#202</span></li>
                    <li>Challenges Completed: <span class="font-bold text-green-300">23</span></li>
                    <li>Global Rank: <span class="font-bold text-purple-300">Top 5%</span></li>
                </ul>
            </div>
            <div class="bg-gray-800 p-6 rounded hover-glow">
                <h3 class="text-xl font-bold mb-2">Recent Activity</h3>
                <ul class="list-disc list-inside text-gray-300">
                    <li>Completed Quiz: Web Security</li>
                    <li>Project Approved: Smart Attendance System</li>
                    <li>Posted: “How to deploy Flask on AWS?”</li>
                    <li>Joined: Hackathon 2025</li>
                </ul>
            </div>
            <div class="bg-gray-800 p-6 rounded hover-glow">
                <h3 class="text-xl font-bold mb-2">Upcoming</h3>
                <ul class="list-disc list-inside text-gray-300">
                    <li>Event: CTF CyberWar – 14 Sep 2025</li>
                    <li>Job: Python Intern at DataCorp</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Profile Section -->
<section id="profile" class="section py-16 animate__animated animate__fadeIn hidden">
    <!-- Cover/banner -->
    <div class="relative h-44 w-full mb-[-4rem]">
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?fit=crop&w=900&q=80" alt="Banner" class="object-cover w-full h-full absolute top-0 left-0 opacity-40">
        <button onclick="openModal('Change banner not implemented')" class="absolute top-2 right-2 bg-blue-700 px-3 py-1 rounded text-white text-xs hover-glow">Change Banner</button>
    </div>
    <!-- Main Profile Card -->
    <div class="max-w-3xl mx-auto bg-gray-900 rounded-xl shadow-xl p-8 mt-[-4rem] relative z-10">
        <div class="flex gap-8 items-center">
            <div class="relative">
                <img src="https://img.icons8.com/color/96/user-male-circle--v2.png" class="w-32 h-32 rounded-full border-4 border-blue-400 shadow-lg bg-white" alt="Profile">
                <button onclick="openModal('Change avatar not implemented')" class="absolute bottom-2 right-2 bg-blue-700 px-2 py-1 rounded text-xs text-white hover-glow">Change</button>
            </div>
            <div>
                <div class="flex gap-3 items-center mb-2">
                    <h1 class="text-3xl font-bold">Guruprasanth M</h1>
                    <span class="verified-badge">Verified</span>
                    <span class="status-badge">Open to Work</span>
                </div>
                <div class="text-lg text-blue-300">Cybersecurity & Ethical Hacking | Developer (C, PHP, Python, Java)</div>
                <div class="mt-1 text-gray-400">Karur, Tamil Nadu, India • <a href="#" class="underline text-blue-300">Contact info</a></div>
                <div class="mt-2 flex gap-2 items-center">
                    <span class="bg-gray-800 px-2 py-1 rounded">Selfmade Ninja Academy</span>
                    <span class="bg-gray-800 px-2 py-1 rounded">500+ connections</span>
                </div>
            </div>
        </div>
        <div class="mt-6 flex gap-4 flex-wrap">
            <button class="bg-blue-700 text-white px-4 py-2 rounded font-bold hover-glow">Connect</button>
            <button class="bg-gray-800 text-blue-300 px-4 py-2 rounded font-bold hover-glow">Message</button>
            <button onclick="openModal('Edit profile not implemented')" class="bg-purple-700 text-white px-4 py-2 rounded font-bold hover-glow">Edit Profile</button>
            <select class="rounded px-2 py-1 bg-gray-800 text-white font-bold border border-blue-500">
                <option>Global</option>
                <option>Campus</option>
                <option>Private</option>
            </select>
        </div>
    </div>
    <!-- Bio with Rich Text Editor -->
    <div class="max-w-3xl mx-auto my-8">
        <h2 class="font-bold text-xl shine mb-2">About</h2>
        <textarea id="profile-bio" class="w-full h-24 px-3 py-2 rounded bg-gray-800 text-white mb-2" placeholder="Write about yourself...">Cybersecurity-focused full-stack developer with hands-on training from Selfmade Ninja Academy (SNA). Proficient in C, PHP, Bash, Linux, with practical experience in secure coding, session management, vulnerability mitigation, and exploit development.</textarea>
        <div class="flex gap-2">
            <button onclick="openModal('Bio saved!')" class="bg-blue-700 px-3 py-1 rounded text-white text-xs hover-glow">Save Bio</button>
            <span class="text-gray-500">Rich text editing mock (formatting not implemented)</span>
        </div>
    </div>
    <!-- Skills & Interests -->
    <div class="max-w-3xl mx-auto grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-gray-900 p-6 rounded shadow">
            <h2 class="font-bold text-xl shine mb-2">Skills</h2>
            <div id="skills-list" class="flex flex-wrap gap-2 mb-2">
                <span class="bg-blue-600 px-2 py-1 rounded text-xs font-bold">Python</span>
                <span class="bg-green-600 px-2 py-1 rounded text-xs font-bold">PHP</span>
                <span class="bg-yellow-600 px-2 py-1 rounded text-xs font-bold">Cybersecurity</span>
                <span class="bg-purple-600 px-2 py-1 rounded text-xs font-bold">Java</span>
                <span class="bg-pink-600 px-2 py-1 rounded text-xs font-bold">Ethical Hacking</span>
                <span class="bg-gray-700 px-2 py-1 rounded text-xs font-bold">Web Dev</span>
            </div>
            <input id="new-skill" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-2/3" placeholder="Add skill...">
            <button onclick="addSkill()" class="bg-gray-700 px-2 py-1 rounded text-xs text-white">+ Add Skill</button>
        </div>
        <div class="bg-gray-900 p-6 rounded shadow">
            <h2 class="font-bold text-xl shine mb-2">Interests</h2>
            <div id="interests-list" class="flex flex-wrap gap-2 mb-2">
                <span class="bg-purple-700 px-2 py-1 rounded text-xs font-bold">AI/ML</span>
                <span class="bg-blue-700 px-2 py-1 rounded text-xs font-bold">Cloud Computing</span>
                <span class="bg-green-700 px-2 py-1 rounded text-xs font-bold">Open Source</span>
                <span class="bg-orange-700 px-2 py-1 rounded text-xs font-bold">CTF</span>
                <span class="bg-pink-700 px-2 py-1 rounded text-xs font-bold">Mentoring</span>
            </div>
            <input id="new-interest" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-2/3" placeholder="Add interest...">
            <button onclick="addInterest()" class="bg-gray-700 px-2 py-1 rounded text-xs text-white">+ Add Interest</button>
        </div>
    </div>
    <!-- Experience & Education -->
    <div class="max-w-3xl mx-auto grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-gray-900 p-6 rounded shadow">
            <h2 class="font-bold text-xl shine mb-2">Experience</h2>
            <ul id="experience-list" class="list-disc ml-4 text-sm text-gray-300">
                <li>Intern, Infosys (Summer 2024)</li>
            </ul>
            <input id="new-experience" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-2/3" placeholder="Add experience...">
            <button onclick="addExperience()" class="bg-gray-700 px-2 py-1 rounded text-xs text-white">+ Add Experience</button>
        </div>
        <div class="bg-gray-900 p-6 rounded shadow">
            <h2 class="font-bold text-xl shine mb-2">Education & Certifications</h2>
            <ul id="education-list" class="list-disc ml-4 text-sm text-gray-300">
                <li>B.Tech CSE, ABC Institute, 2024</li>
                <li>Certified Ethical Hacker</li>
            </ul>
            <input id="new-education" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-2/3" placeholder="Add education/certification...">
            <button onclick="addEducation()" class="bg-gray-700 px-2 py-1 rounded text-xs text-white">+ Add Education</button>
        </div>
    </div>
    <!-- Projects -->
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded shadow mb-8">
        <h2 class="font-bold text-xl shine mb-2">Verified Projects</h2>
        <ul id="projects-list" class="list-disc ml-6 text-sm">
            <li>
                <a href="#" class="text-blue-300 underline">Smart Attendance System</a> <span class="bg-green-700 px-2 py-1 rounded text-xs ml-2">Approved</span>
            </li>
            <li>
                <a href="#" class="text-blue-300 underline">CyberSafe App</a> <span class="bg-green-700 px-2 py-1 rounded text-xs ml-2">Approved</span>
            </li>
            <li>
                <a href="#" class="text-blue-300 underline">SQL Injection Challenge</a> <span class="bg-yellow-600 px-2 py-1 rounded text-xs ml-2">Pending</span>
            </li>
        </ul>
        <div class="flex flex-col md:flex-row gap-2 mt-3">
            <input id="new-project-title" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full md:w-1/3" placeholder="Project Title">
            <input id="new-project-link" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full md:w-1/3" placeholder="Repo/Demo Link">
            <input id="new-project-status" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full md:w-1/3" placeholder="Approved/Pending/Rejected">
            <button onclick="addProject()" class="bg-gray-700 px-2 py-1 rounded text-xs text-white">+ Add Project</button>
        </div>
    </div>
    <!-- Achievements & Badges -->
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded shadow mb-8">
        <h2 class="font-bold text-xl shine mb-2">Achievements & Badges</h2>
        <div id="badges-list" class="flex gap-4 flex-wrap">
            <span class="bg-yellow-500 px-3 py-1 rounded text-black font-bold">Quiz Master</span>
            <span class="bg-green-500 px-3 py-1 rounded text-black font-bold">Hackathon Winner</span>
            <span class="bg-blue-500 px-3 py-1 rounded text-white font-bold">CTF Top 5</span>
            <span class="bg-purple-500 px-3 py-1 rounded text-white font-bold">Innovation Badge</span>
        </div>
    </div>
    <!-- Social Links -->
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded shadow flex gap-4 items-center mb-8">
        <div class="font-bold text-blue-400">Socials:</div>
        <a href="#" class="underline text-blue-300">LinkedIn</a>
        <a href="#" class="underline text-blue-300">GitHub</a>
        <a href="#" class="underline text-blue-300">Twitter</a>
        <a href="#" class="underline text-blue-300">Instagram</a>
        <a href="#" class="underline text-blue-300">Portfolio</a>
    </div>
    <!-- Recent Activity -->
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded shadow mb-8">
        <h2 class="font-bold text-xl shine mb-2">Recent Activity</h2>
        <ul id="recent-activity-list" class="list-disc ml-6 text-sm text-gray-200">
            <li>Answered: <span class="underline">How to deploy on AWS?</span> (Global Q&A)</li>
            <li>Posted: <span class="underline">Submitted Smart Attendance System for review!</span> (Campus Feed)</li>
            <li>Asked: <span class="underline">Best resources for CTF beginners?</span> (Global Q&A)</li>
        </ul>
    </div>
</section>

<!-- Leaderboard Section -->
<section id="leaderboard" class="section py-16 animate__animated animate__fadeIn hidden">
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
            <input id="leaderboard-search" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full md:w-1/3" placeholder="Search by name, batch, college...">
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
                <tbody id="leaderboard-table">
                    <!-- JS will render sample data -->
                </tbody>
            </table>
        </div>
        <!-- League of Ronin Levels -->
        <div class="bg-gradient-to-r from-blue-900 via-black to-purple-900 rounded-xl p-8 mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">League of Ronin</h2>
            <p class="text-gray-300 mb-4">Earn <span class="text-orange-400">🔥</span> Zeal by completing missions and achievements. Level up through six leagues!</p>
            <div class="bg-gray-900 rounded-lg p-6 mb-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    <div class="bg-gray-800 p-4 rounded shadow text-center">
                        <img src="https://cdn.dribbble.com/users/234582/screenshots/15683357/media/4e3e56b6a7e2e8e6e2f5eebfcb5cbe0b.png?compress=1&resize=80x80" class="mx-auto rounded-full mb-2">
                        <div class="font-bold">Ninja Recruit I</div>
                        <div>Level 1 | League I</div>
                        <div class="text-xs text-gray-400 mb-2">100% Completed 🎉</div>
                        <div class="text-xs text-orange-400">Requires 10 <span class="text-lg">🔥</span></div>
                    </div>
                    <div class="bg-gray-800 p-4 rounded shadow text-center">
                        <img src="https://cdn.dribbble.com/users/234582/screenshots/15683357/media/4e3e56b6a7e2e8e6e2f5eebfcb5cbe0b.png?compress=1&resize=80x80" class="mx-auto rounded-full mb-2">
                        <div class="font-bold">Ninja Recruit II</div>
                        <div>Level 2 | League I</div>
                        <div class="text-xs text-gray-400 mb-2">100% Completed 🎉</div>
                        <div class="text-xs text-orange-400">Requires 40 <span class="text-lg">🔥</span></div>
                    </div>
                    <div class="bg-gray-800 p-4 rounded shadow text-center">
                        <img src="https://cdn.dribbble.com/users/234582/screenshots/15683357/media/4e3e56b6a7e2e8e6e2f5eebfcb5cbe0b.png?compress=1&resize=80x80" class="mx-auto rounded-full mb-2">
                        <div class="font-bold">Ninja Recruit III</div>
                        <div>Level 3 | League I</div>
                        <div class="text-xs text-gray-400 mb-2">100% Completed 🎉</div>
                        <div class="text-xs text-orange-400">Requires 90 <span class="text-lg">🔥</span></div>
                    </div>
                    <div class="bg-gray-800 p-4 rounded shadow text-center">
                        <img src="https://cdn.dribbble.com/users/234582/screenshots/15683357/media/4e3e56b6a7e2e8e6e2f5eebfcb5cbe0b.png?compress=1&resize=80x80" class="mx-auto rounded-full mb-2">
                        <div class="font-bold">Ninja Recruit IV</div>
                        <div>Level 4 | League I</div>
                        <div class="text-xs text-gray-400 mb-2">100% Completed 🎉</div>
                        <div class="text-xs text-orange-400">Requires 160 <span class="text-lg">🔥</span></div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-900 rounded-lg p-6">
                <ul class="space-y-2">
                    <li><span class="font-bold text-blue-300">League II</span> <span class="font-bold">Nightcrawler</span> (Level 5 to 8)</li>
                    <li><span class="font-bold text-blue-300">League III</span> <span class="font-bold">Phantom Pupil</span> (Level 9 to 12)</li>
                    <li><span class="font-bold text-blue-300">League IV</span> <span class="font-bold">Cyber Cadet</span> (Level 13 to 16)</li>
                    <li><span class="font-bold text-blue-300">League V</span> <span class="font-bold">Tech Trekker</span> (Level 17 to 20)</li>
                    <li><span class="font-bold text-blue-300">League VI</span> <span class="font-bold">Digital Daredevil</span> (Level 21 to 24)</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Directory/Explore Section -->
<section id="directory" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Directory / Explore</h2>
        <input id="directory-search" class="bg-gray-800 rounded px-2 py-1 text-white mb-8 w-full md:w-1/2" placeholder="Search alumni/students by name, batch, college, skills...">
        <div class="grid md:grid-cols-3 gap-8" id="directory-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<!-- Jobs & Recruiters Section -->
<section id="jobs" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Jobs & Recruiters</h2>
        <div class="grid md:grid-cols-3 gap-8" id="jobs-cards">
            <!-- JS will render sample data -->
        </div>
        <hr class="my-8 border-gray-700">
        <h3 class="font-bold text-xl mb-4">Recruiters</h3>
        <div class="grid md:grid-cols-3 gap-8" id="recruiters-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<!-- Events Section -->
<section id="events" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Events</h2>
        <div class="grid md:grid-cols-3 gap-8" id="events-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section id="announcements" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Announcements</h2>
        <div class="grid md:grid-cols-2 gap-8" id="announcements-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<!-- Q&A Section -->
<section id="qa" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Questions & Answers</h2>
        <div class="bg-gray-900 rounded-lg p-6 mb-8">
            <input id="qa-question" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full" placeholder="Ask a question...">
            <input id="qa-tags" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full" placeholder="Tags (comma separated)">
            <button onclick="addQA()" class="bg-blue-700 px-3 py-1 rounded text-white">Ask</button>
        </div>
        <div id="qa-list">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<!-- Practice/Challenges Section -->
<section id="practice" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Practice / Challenges</h2>
        <div class="grid md:grid-cols-3 gap-8" id="practice-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<!-- Project Submission Section -->
<section id="project-submission" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-lg mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Submit Project</h2>
        <form id="submit-project-form" class="bg-gray-900 rounded-lg p-6 flex flex-col gap-4">
            <input id="submit-title" class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="Project Title" required>
            <textarea id="submit-desc" class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="Project Description" required></textarea>
            <input id="submit-link" class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="GitHub/Repo/Demo Link" required>
            <input id="submit-screenshot" class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="Screenshot URL">
            <select id="submit-status" class="bg-gray-800 rounded px-2 py-1 text-white">
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>
            <button type="submit" class="bg-blue-700 px-3 py-1 rounded text-white">Submit</button>
        </form>
        <div id="project-submission-feedback" class="mt-4 text-green-400 hidden">Project submitted!</div>
    </div>
</section>

<!-- Messages/Mentorship Section -->
<section id="messages" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Messages / Mentorship</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4">Inbox</h3>
                <ul id="messages-inbox" class="space-y-2">
                    <!-- JS will render sample data -->
                </ul>
            </div>
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4">Mentorship Requests</h3>
                <ul id="mentorship-requests" class="space-y-2">
                    <!-- JS will render sample data -->
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Authentication Section -->
<section id="auth" class="section py-16 animate__animated animate__fadeIn hidden">
    <div class="max-w-lg mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Login / Signup</h2>
        <form id="login-form" class="bg-gray-900 rounded-lg p-6 flex flex-col gap-4">
            <input class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="Email" required>
            <input class="bg-gray-800 rounded px-2 py-1 text-white" type="password" placeholder="Password" required>
            <button type="submit" class="bg-blue-700 px-3 py-1 rounded text-white">Login</button>
            <p class="text-gray-400 text-sm mt-2">Don't have an account? <button onclick="showSection('signup')" type="button" class="text-blue-400 underline">Sign up</button></p>
            <p class="text-gray-400 text-sm mt-2"><button onclick="openModal('Password reset not implemented')" type="button" class="text-blue-400 underline">Forgot Password?</button></p>
        </form>
        <!-- Signup Mock -->
        <form id="signup-form" class="bg-gray-900 rounded-lg p-6 flex flex-col gap-4 hidden">
            <input class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="Full Name" required>
            <input class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="Email" required>
            <input class="bg-gray-800 rounded px-2 py-1 text-white" type="password" placeholder="Password" required>
            <input class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="Batch" required>
            <input class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="Department" required>
            <input class="bg-gray-800 rounded px-2 py-1 text-white" placeholder="College" required>
            <button type="submit" class="bg-blue-700 px-3 py-1 rounded text-white">Signup</button>
        </form>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gradient-to-r from-blue-900 via-purple-900 to-cyan-900 text-white py-6 mt-16 text-center animate__animated animate__fadeInUp">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
        <div>&copy; 2025 SkillSphere. All rights reserved.</div>
        <div class="flex gap-4 mt-4 md:mt-0">
            <a href="#" class="hover:underline">Contact</a>
            <a href="#" class="hover:underline">Privacy Policy</a>
            <a href="#" class="hover:underline">Instagram</a>
            <a href="#" class="hover:underline">LinkedIn</a>
        </div>
    </div>
</footer>

<!-- ========== SPA JavaScript Logic ========== -->
<script>
/* ----- SPA Navigation ----- */
function showSection(id) {
    document.querySelectorAll('.section').forEach(s => s.classList.add('hidden'));
    document.getElementById(id).classList.remove('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
    if (id === 'profile') document.body.classList.remove('high-contrast');
}
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
}
function toggleNotifications() {
    document.getElementById('notifications-panel').classList.toggle('hidden');
}
function toggleContrast() {
    document.body.classList.toggle('high-contrast');
}

/* ----- Confirmation Modal ----- */
function openModal(msg) {
    document.getElementById('confirm-modal').querySelector('p').textContent = msg || "Do you want to proceed with this action?";
    document.getElementById('confirm-modal').classList.remove('hidden');
}
function closeModal(confirmed) {
    document.getElementById('confirm-modal').classList.add('hidden');
    if (confirmed) alert('Action confirmed!');
}

/* ----- Profile Add/Remove (frontend only) ----- */
function addSkill() {
    const val = document.getElementById('new-skill').value.trim();
    if (val) {
        let el = document.createElement('span');
        el.className = "bg-blue-600 px-2 py-1 rounded text-xs font-bold";
        el.textContent = val;
        document.getElementById('skills-list').appendChild(el);
        document.getElementById('new-skill').value = "";
    }
}
function addInterest() {
    const val = document.getElementById('new-interest').value.trim();
    if (val) {
        let el = document.createElement('span');
        el.className = "bg-purple-700 px-2 py-1 rounded text-xs font-bold";
        el.textContent = val;
        document.getElementById('interests-list').appendChild(el);
        document.getElementById('new-interest').value = "";
    }
}
function addExperience() {
    const val = document.getElementById('new-experience').value.trim();
    if (val) {
        let el = document.createElement('li');
        el.textContent = val;
        document.getElementById('experience-list').appendChild(el);
        document.getElementById('new-experience').value = "";
    }
}
function addEducation() {
    const val = document.getElementById('new-education').value.trim();
    if (val) {
        let el = document.createElement('li');
        el.textContent = val;
        document.getElementById('education-list').appendChild(el);
        document.getElementById('new-education').value = "";
    }
}
function addProject() {
    const t = document.getElementById('new-project-title').value.trim();
    const l = document.getElementById('new-project-link').value.trim();
    const s = document.getElementById('new-project-status').value.trim();
    if (t && l && s) {
        let el = document.createElement('li');
        el.innerHTML = `<a href="${l}" class="text-blue-300 underline">${t}</a> <span class="bg-green-700 px-2 py-1 rounded text-xs ml-2">${s}</span>`;
        document.getElementById('projects-list').appendChild(el);
        document.getElementById('new-project-title').value = "";
        document.getElementById('new-project-link').value = "";
        document.getElementById('new-project-status').value = "";
    }
}

/* ----- Leaderboard Table Sample Data ----- */
const leaderboardData = [
    {rank:1, name:"Alice Smith", batch:"2022", college:"SNA", points:980, achievements:"Quiz Master"},
    {rank:2, name:"Bob Johnson", batch:"2023", college:"TechU", points:900, achievements:"Hackathon Winner"},
    {rank:3, name:"Catherine Lee", batch:"2022", college:"CodeUni", points:890, achievements:"Innovation Badge"},
    {rank:202, name:"Guruprasanth M", batch:"2024", college:"SNA", points:462, achievements:"CTF Top 5"},
];
function renderLeaderboardTable() {
    let rows = "";
    leaderboardData.forEach(d => {
        rows += `<tr>
            <td class="px-4 py-2">${d.rank}</td>
            <td class="px-4 py-2 font-bold">${d.name}</td>
            <td class="px-4 py-2">${d.batch}</td>
            <td class="px-4 py-2">${d.college}</td>
            <td class="px-4 py-2">${d.points}</td>
            <td class="px-4 py-2">${d.achievements}</td>
        </tr>`;
    });
    document.getElementById('leaderboard-table').innerHTML = rows;
}
document.addEventListener('DOMContentLoaded', renderLeaderboardTable);

/* ----- Directory Cards Sample Data ----- */
const directoryData = [
    {name:"Alice Smith", batch:"2022", college:"SNA", skills:["Python","ML"], avatar:"https://img.icons8.com/color/96/user-female-circle--v2.png"},
    {name:"Bob Johnson", batch:"2023", college:"TechU", skills:["React","NodeJS"], avatar:"https://img.icons8.com/color/96/user-male-circle--v2.png"},
    {name:"Catherine Lee", batch:"2022", college:"CodeUni", skills:["UI/UX","Figma"], avatar:"https://img.icons8.com/color/96/user-female-circle--v2.png"},
];
function renderDirectoryCards() {
    let cards = "";
    directoryData.forEach(d => {
        cards += `<div class="bg-gray-900 rounded-lg p-6 hover-glow flex flex-col items-center text-center">
            <img src="${d.avatar}" class="w-20 h-20 rounded-full mb-3">
            <div class="font-bold text-lg">${d.name}</div>
            <div class="text-gray-400">${d.college} • Batch ${d.batch}</div>
            <div class="flex flex-wrap gap-1 mt-2 justify-center">${d.skills.map(s=>`<span class="bg-blue-700 px-2 py-1 rounded text-xs">${s}</span>`).join("")}</div>
            <button onclick="showSection('profile')" class="mt-4 bg-blue-600 px-3 py-1 rounded text-white hover-glow">View Profile</button>
        </div>`;
    });
    document.getElementById('directory-cards').innerHTML = cards;
}
document.addEventListener('DOMContentLoaded', renderDirectoryCards);

/* ----- Jobs & Recruiters Sample Data ----- */
const jobsData = [
    {title:"Python Developer Intern", company:"DataCorp", location:"Remote", type:"Internship"},
    {title:"Frontend Developer", company:"TechSoft", location:"Bangalore", type:"Full-time"},
    {title:"Cybersecurity Analyst", company:"SecureIT", location:"Chennai", type:"Full-time"},
];
const recruitersData = [
    {name:"Priya Sharma", company:"DataCorp", badge:"Recruiter", recent:"Python Developer Intern"},
    {name:"David Kim", company:"TechSoft", badge:"Recruiter", recent:"Frontend Developer"},
];
function renderJobsCards() {
    let cards = "";
    jobsData.forEach(j => {
        cards += `<div class="bg-gray-900 rounded-lg p-6 hover-glow">
            <div class="font-bold text-lg">${j.title}</div>
            <div class="text-gray-400">${j.company} • ${j.location}</div>
            <div class="text-blue-400 font-bold">${j.type}</div>
            <div class="flex gap-2 mt-3">
                <button class="bg-blue-600 px-3 py-1 rounded text-white hover-glow">Apply</button>
                <button class="bg-gray-700 px-3 py-1 rounded text-white hover-glow">Save</button>
                <button class="bg-gray-700 px-3 py-1 rounded text-white hover-glow">Share</button>
            </div>
        </div>`;
    });
    document.getElementById('jobs-cards').innerHTML = cards;
    let recruiterCards = "";
    recruitersData.forEach(r => {
        recruiterCards += `<div class="bg-gray-900 rounded-lg p-6 hover-glow">
            <img src="https://img.icons8.com/color/96/businesswoman.png" class="w-14 h-14 rounded-full mb-2">
            <div class="font-bold">${r.name}</div>
            <div class="text-gray-400">${r.company}</div>
            <span class="bg-yellow-400 px-2 py-1 rounded text-xs font-bold mt-2">${r.badge}</span>
            <div class="text-sm text-gray-300 mt-2">Recent Job: ${r.recent}</div>
        </div>`;
    });
    document.getElementById('recruiters-cards').innerHTML = recruiterCards;
}
document.addEventListener('DOMContentLoaded', renderJobsCards);

/* ----- Events Sample Data ----- */
const eventsData = [
    {title:"Hackathon 2025", date:"14 Sep 2025", location:"Online", desc:"Global coding event. Join & compete!", rsvp:true},
    {title:"CyberWar CTF", date:"20 Sep 2025", location:"SNA Campus", desc:"Capture The Flag cybersecurity challenge.", rsvp:false},
];
function renderEventsCards() {
    let cards = "";
    eventsData.forEach(e => {
        cards += `<div class="bg-gray-900 rounded-lg p-6 hover-glow">
            <div class="font-bold text-lg">${e.title}</div>
            <div class="text-gray-400">${e.date} • ${e.location}</div>
            <div class="text-sm mt-2">${e.desc}</div>
            <button class="bg-blue-700 px-3 py-1 rounded text-white mt-3">${e.rsvp ? 'RSVP' : 'View'}</button>
        </div>`;
    });
    document.getElementById('events-cards').innerHTML = cards;
}
document.addEventListener('DOMContentLoaded', renderEventsCards);

/* ----- Announcements Sample Data ----- */
const annData = [
    {title:"New Feature: SkillSphere Leaderboard!", date:"13 Sep 2025", info:"Track your skill progress, achievements, and global rank."},
    {title:"Campus Placement Drive", date:"15 Sep 2025", info:"Apply for campus jobs through SkillSphere Jobs board."},
];
function renderAnnouncements() {
    let cards = "";
    annData.forEach(a => {
        cards += `<div class="bg-gray-900 rounded-lg p-6 hover-glow">
            <div class="font-bold text-lg">${a.title}</div>
            <div class="text-gray-400">${a.date}</div>
            <div class="text-sm mt-2">${a.info}</div>
        </div>`;
    });
    document.getElementById('announcements-cards').innerHTML = cards;
}
document.addEventListener('DOMContentLoaded', renderAnnouncements);

/* ----- Q&A Sample Data ----- */
let qaData = [
    {question:"How to deploy Flask on AWS?", tags:["deployment","AWS"], upvotes:5, answers:[{user:"Alice Smith",text:"Use Elastic Beanstalk!"}]},
    {question:"Best resources for CTF beginners?", tags:["ctf","cybersecurity"], upvotes:3, answers:[{user:"Bob Johnson",text:"Try picoCTF and OverTheWire."}]}
];
function renderQA() {
    let html = "";
    qaData.forEach((q,i) => {
        html += `<div class="bg-gray-800 rounded-lg p-4 mb-4">
            <div class="font-bold mb-1">${q.question}</div>
            <div class="flex gap-2 mb-1">${q.tags.map(t=>`<span class="bg-blue-700 px-2 py-1 rounded text-xs">${t}</span>`).join("")}</div>
            <div class="flex gap-3 mb-2">
                <span class="text-yellow-400">▲ ${q.upvotes}</span>
                <button onclick="addAnswer(${i})" class="bg-blue-700 px-2 py-1 rounded text-xs text-white">Answer</button>
            </div>
            <div><b>Answers:</b>
                <ul>${q.answers.map(a=>`<li class="text-sm mt-1"><span class="font-bold">${a.user}:</span> ${a.text}</li>`).join("")}</ul>
            </div>
        </div>`;
    });
    document.getElementById('qa-list').innerHTML = html;
}
function addQA() {
    const q = document.getElementById('qa-question').value.trim();
    const t = document.getElementById('qa-tags').value.split(',').map(x=>x.trim()).filter(Boolean);
    if (q && t.length) {
        qaData.unshift({question:q, tags:t, upvotes:0, answers:[]});
        renderQA();
        document.getElementById('qa-question').value = "";
        document.getElementById('qa-tags').value = "";
    }
}
function addAnswer(idx) {
    let ans = prompt("Type your answer:");
    if (ans) {
        qaData[idx].answers.push({user:"You",text:ans});
        renderQA();
    }
}
document.addEventListener('DOMContentLoaded', renderQA);

/* ----- Practice Challenges Sample Data ----- */
const practiceData = [
    {title:"SQL Injection Challenge", category:"CTF", difficulty:"Medium"},
    {title:"Array Manipulation", category:"Coding", difficulty:"Easy"},
    {title:"XSS Attack Lab", category:"CTF", difficulty:"Hard"},
];
function renderPracticeCards() {
    let cards = "";
    practiceData.forEach(p => {
        cards += `<div class="bg-gray-900 rounded-lg p-6 hover-glow">
            <div class="font-bold text-lg">${p.title}</div>
            <div class="text-blue-400 font-bold">${p.category}</div>
            <div class="text-gray-400">${p.difficulty}</div>
            <button class="bg-blue-700 px-3 py-1 rounded text-white mt-3">Start</button>
        </div>`;
    });
    document.getElementById('practice-cards').innerHTML = cards;
}
document.addEventListener('DOMContentLoaded', renderPracticeCards);

/* ----- Messages/Mentorship Sample Data ----- */
const messagesInbox = [
    {from:"Alice Smith", text:"Congrats on your project approval!"},
    {from:"Bob Johnson", text:"Want to join my CTF team?"},
];
const mentorshipRequests = [
    {from:"Priya Sharma", status:"Pending"},
];
function renderMessages() {
    let inbox = "";
    messagesInbox.forEach(m => {
        inbox += `<li class="bg-gray-800 rounded px-4 py-2 flex justify-between items-center">
            <span><b>${m.from}</b>: ${m.text}</span>
            <button onclick="openModal('Reply not implemented')" class="bg-blue-700 px-2 py-1 rounded text-xs text-white">Reply</button>
        </li>`;
    });
    document.getElementById('messages-inbox').innerHTML = inbox;
    let mentor = "";
    mentorshipRequests.forEach(m => {
        mentor += `<li class="bg-gray-800 rounded px-4 py-2 flex justify-between items-center">
            <span><b>${m.from}</b> (Status: ${m.status})</span>
            <button onclick="openModal('Accept/decline not implemented')" class="bg-green-700 px-2 py-1 rounded text-xs text-white">Accept</button>
            <button onclick="openModal('Decline not implemented')" class="bg-red-700 px-2 py-1 rounded text-xs text-white">Decline</button>
        </li>`;
    });
    document.getElementById('mentorship-requests').innerHTML = mentor;
}
document.addEventListener('DOMContentLoaded', renderMessages);

/* ----- Project Submission Form ----- */
document.getElementById('submit-project-form').onsubmit = function(e) {
    e.preventDefault();
    document.getElementById('project-submission-feedback').classList.remove('hidden');
    setTimeout(() => {
        document.getElementById('project-submission-feedback').classList.add('hidden');
    }, 2000);
    this.reset();
};

/* ----- Authentication Mock ----- */
document.getElementById('login-form').onsubmit = function(e) { e.preventDefault(); alert('Login not implemented'); };
document.getElementById('signup-form').onsubmit = function(e) { e.preventDefault(); alert('Signup not implemented'); };

/* ----- Leaderboard Chart.js ----- */
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
            plugins: {
                legend: { labels: {color:'#fff'} }
            },
            scales: {
                x: { ticks: {color:'#fff'} },
                y: { ticks: {color:'#fff'} }
            }
        }
    });
}
function updateChart(type) { renderChart(type); }
document.addEventListener('DOMContentLoaded', ()=>renderChart('week'));

/* ----- Accessibility: ARIA labels ----- */
document.querySelectorAll('button, input, textarea, select').forEach(el=>{
    if(!el.getAttribute('aria-label')) el.setAttribute('aria-label',el.textContent||el.placeholder||'');
});
</script>
</body>
</html>