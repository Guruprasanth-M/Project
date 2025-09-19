<?php
// practice.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practice – SkillSphere</title>
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

<!-- Practice/Challenges Section -->
<section id="practice" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Practice / Challenges</h2>
        <div class="grid md:grid-cols-3 gap-8" id="practice-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<script>
// Sample Practice Data
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
</script>

</body>
</html>
