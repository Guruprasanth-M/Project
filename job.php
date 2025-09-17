
<?php
// jobs.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jobs – SkillSphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .shine { 
            background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
        }
        .hover-glow:hover { 
            box-shadow: 0 0 18px #3b82f6, 0 0 50px #6366f1; 
            transition: box-shadow .3s; 
        }
    </style>
</head>
<body class="bg-black text-white font-sans">

<!-- Jobs & Recruiters Section -->
<section id="jobs" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Jobs & Recruiters</h2>

        <!-- Jobs -->
        <div class="grid md:grid-cols-3 gap-8" id="jobs-cards">
            <!-- JS will render sample data -->
        </div>

        <hr class="my-8 border-gray-700">

        <!-- Recruiters -->
        <h3 class="font-bold text-xl mb-4">Recruiters</h3>
        <div class="grid md:grid-cols-3 gap-8" id="recruiters-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<script>
// Sample Jobs Data
const jobsData = [
    {title:"Python Developer Intern", company:"DataCorp", location:"Remote", type:"Internship"},
    {title:"Frontend Developer", company:"TechSoft", location:"Bangalore", type:"Full-time"},
    {title:"Cybersecurity Analyst", company:"SecureIT", location:"Chennai", type:"Full-time"},
];

// Sample Recruiters Data
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
</script>

</body>
</html>
