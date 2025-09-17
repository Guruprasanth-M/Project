<?php
// events.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events – SkillSphere</title>
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

<!-- Events Section -->
<section id="events" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Events</h2>
        <div class="grid md:grid-cols-3 gap-8" id="events-cards">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<script>
// Sample Events Data
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
</script>

</body>
</html>
