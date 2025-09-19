<?php
// submit_project.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Project – SkillSphere</title>
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

<!-- Submit Project Section -->
<section id="projects" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Submit Your Project</h2>

        <!-- Form -->
        <div class="bg-gray-900 rounded-lg p-6">
            <input id="project-title" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full" placeholder="Project Title">
            <textarea id="project-desc" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full" rows="4" placeholder="Project Description"></textarea>
            <input id="project-link" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full" placeholder="GitHub/Live Link">
            <button onclick="submitProject()" class="bg-blue-700 px-3 py-1 rounded text-white hover-glow">Submit</button>
        </div>

        <!-- List -->
        <div id="projects-list" class="mt-8">
            <!-- JS will render sample projects -->
        </div>
    </div>
</section>

<script>
// Sample Project Data
let projects = [
    {title:"Photogram", desc:"First project in webdevlopment with securty concern", link:"https://github.com/Guruprasanth-M/photogram_"},
    {title:"Buffer overflow", desc:"Learning memory mangemet in c.", link:"https://github.com/Guruprasanth-M/bufferoverflow-in-c"},
];

// Render Projects
function renderProjects() {
    let html = "";
    projects.forEach(p => {
        html += `<div class="bg-gray-800 rounded-lg p-4 mb-4 hover-glow">
            <div class="font-bold text-lg">${p.title}</div>
            <div class="text-sm text-gray-300 mb-2">${p.desc}</div>
            <a href="${p.link}" target="_blank" class="text-blue-400 underline">View Project</a>
        </div>`;
    });
    document.getElementById('projects-list').innerHTML = html;
}

// Add New Project
function submitProject() {
    const title = document.getElementById('project-title').value.trim();
    const desc = document.getElementById('project-desc').value.trim();
    const link = document.getElementById('project-link').value.trim();

    if (title && desc && link) {
        projects.unshift({title, desc, link});
        renderProjects();
        document.getElementById('project-title').value = "";
        document.getElementById('project-desc').value = "";
        document.getElementById('project-link').value = "";
    } else {
        alert("Please fill all fields!");
    }
}

document.addEventListener('DOMContentLoaded', renderProjects);
</script>

</body>
</html>
