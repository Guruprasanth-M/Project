<?php
// profile.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        .shine { background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hover-glow:hover { box-shadow: 0 0 18px #3b82f6, 0 0 50px #6366f1; transition: box-shadow .3s; }
        .verified-badge { background: #22d3ee; color: #000; padding: 0.25rem 0.75rem; border-radius: 1rem; font-weight: bold; font-size: 0.8rem;}
        .status-badge { background: #22c55e; color: #fff; padding: 0.25rem 0.75rem; border-radius: 1rem; font-weight: bold; font-size: 0.8rem;}
    </style>
</head>
<body class="bg-black text-white font-sans">

<!-- Profile Section -->
<section id="profile" class="section py-16 animate__animated animate__fadeIn">
    <!-- Cover/banner -->
    <div class="relative h-44 w-full mb-[-4rem]">
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?fit=crop&w=900&q=80" alt="Banner" class="object-cover w-full h-full absolute top-0 left-0 opacity-40">
        <button class="absolute top-2 right-2 bg-blue-700 px-3 py-1 rounded text-white text-xs hover-glow">Change Banner</button>
    </div>

    <!-- Main Profile Card -->
    <div class="max-w-3xl mx-auto bg-gray-900 rounded-xl shadow-xl p-8 mt-[-4rem] relative z-10">
        <div class="flex gap-8 items-center">
            <div class="relative">
                <img src="https://img.icons8.com/color/96/user-male-circle--v2.png" class="w-32 h-32 rounded-full border-4 border-blue-400 shadow-lg bg-white" alt="Profile">
                <button class="absolute bottom-2 right-2 bg-blue-700 px-2 py-1 rounded text-xs text-white hover-glow">Change</button>
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
            <button class="bg-purple-700 text-white px-4 py-2 rounded font-bold hover-glow">Edit Profile</button>
            <select class="rounded px-2 py-1 bg-gray-800 text-white font-bold border border-blue-500">
                <option>Global</option>
                <option>Campus</option>
                <option>Private</option>
            </select>
        </div>
    </div>

    <!-- Bio -->
    <div class="max-w-3xl mx-auto my-8">
        <h2 class="font-bold text-xl shine mb-2">About</h2>
        <textarea id="profile-bio" class="w-full h-24 px-3 py-2 rounded bg-gray-800 text-white mb-2">Cybersecurity-focused full-stack developer with hands-on training from Selfmade Ninja Academy (SNA)...</textarea>
        <div class="flex gap-2">
            <button class="bg-blue-700 px-3 py-1 rounded text-white text-xs hover-glow">Save Bio</button>
        </div>
    </div>

    <!-- Skills & Interests -->
    <div class="max-w-3xl mx-auto grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-gray-900 p-6 rounded shadow">
            <h2 class="font-bold text-xl shine mb-2">Skills</h2>
            <div class="flex flex-wrap gap-2 mb-2">
                <span class="bg-blue-600 px-2 py-1 rounded text-xs font-bold">Python</span>
                <span class="bg-green-600 px-2 py-1 rounded text-xs font-bold">PHP</span>
                <span class="bg-yellow-600 px-2 py-1 rounded text-xs font-bold">Cybersecurity</span>
            </div>
        </div>
        <div class="bg-gray-900 p-6 rounded shadow">
            <h2 class="font-bold text-xl shine mb-2">Interests</h2>
            <div class="flex flex-wrap gap-2 mb-2">
                <span class="bg-purple-700 px-2 py-1 rounded text-xs font-bold">AI/ML</span>
                <span class="bg-blue-700 px-2 py-1 rounded text-xs font-bold">Cloud Computing</span>
            </div>
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

</body>
</html>
