<?php
// success_stories.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success Stories – SkillSphere</title>
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

<!-- Success Stories Section -->
<section id="success-stories" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Success Stories</h2>
        <div class="grid md:grid-cols-3 gap-8" id="stories-cards">
            <!-- JS will render stories -->
        </div>
    </div>
</section>

<script>
// Sample Success Stories
const stories = [
    {
        name:"Aarav Mehta",
        company:"Google",
        role:"Software Engineer",
        story:"From practicing coding challenges here, I landed my dream job at Google."
    },
    {
        name:"Sophia Fernandes",
        company:"Microsoft",
        role:"Cloud Architect",
        story:"The mentorship program gave me guidance that helped me secure a role at Microsoft."
    },
    {
        name:"Rahul Sharma",
        company:"TCS",
        role:"Cybersecurity Analyst",
        story:"After completing multiple CTF challenges, I got placed in TCS as a security analyst."
    }
];

function renderStories() {
    let html = "";
    stories.forEach(s => {
        html += `<div class="bg-gray-900 rounded-lg p-6 hover-glow">
            <div class="font-bold text-lg">${s.name}</div>
            <div class="text-gray-400 mb-2">${s.role} @ ${s.company}</div>
            <p class="text-sm text-gray-300">"${s.story}"</p>
        </div>`;
    });
    document.getElementById('stories-cards').innerHTML = html;
}

document.addEventListener('DOMContentLoaded', renderStories);
</script>

</body>
</html>
