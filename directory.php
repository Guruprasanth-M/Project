<?php
// directory.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Directory – SkillSphere</title>
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

<!-- Directory/Explore Section -->
<section id="directory" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Directory / Explore</h2>
        <input id="directory-search" class="bg-gray-800 rounded px-2 py-1 text-white mb-8 w-full md:w-1/2" placeholder="Search alumni/students by name, batch, college, skills...">
        <div class="grid md:grid-cols-3 gap-8" id="directory-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<script>
// Sample Directory Data
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
            <div class="flex flex-wrap gap-1 mt-2 justify-center">
                ${d.skills.map(s=>`<span class="bg-blue-700 px-2 py-1 rounded text-xs">${s}</span>`).join("")}
            </div>
            <button class="mt-4 bg-blue-600 px-3 py-1 rounded text-white hover-glow">View Profile</button>
        </div>`;
    });
    document.getElementById('directory-cards').innerHTML = cards;
}

document.addEventListener('DOMContentLoaded', renderDirectoryCards);
</script>

</body>
</html>
