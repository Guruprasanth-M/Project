<?php
// qa.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Q&A – SkillSphere</title>
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

<!-- Q&A Section -->
<section id="qa" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Questions & Answers</h2>
        
        <!-- Ask Form -->
        <div class="bg-gray-900 rounded-lg p-6 mb-8">
            <input id="qa-question" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full" placeholder="Ask a question...">
            <input id="qa-tags" class="bg-gray-800 rounded px-2 py-1 text-white mb-2 w-full" placeholder="Tags (comma separated)">
            <button onclick="addQA()" class="bg-blue-700 px-3 py-1 rounded text-white hover-glow">Ask</button>
        </div>

        <!-- Q&A List -->
        <div id="qa-list">
            <!-- JS will render sample data -->
        </div>
    </div>
</section>

<script>
// Sample Q&A Data
let qaData = [
    {question:"How to deploy Flask on AWS?", tags:["deployment","AWS"], upvotes:5, answers:[{user:"Alice Smith",text:"Use Elastic Beanstalk!"}]},
    {question:"Best resources for CTF beginners?", tags:["ctf","cybersecurity"], upvotes:3, answers:[{user:"Bob Johnson",text:"Try picoCTF and OverTheWire."}]}
];

// Render Q&A
function renderQA() {
    let html = "";
    qaData.forEach((q,i) => {
        html += `<div class="bg-gray-800 rounded-lg p-4 mb-4">
            <div class="font-bold mb-1">${q.question}</div>
            <div class="flex gap-2 mb-1">
                ${q.tags.map(t=>`<span class="bg-blue-700 px-2 py-1 rounded text-xs">${t}</span>`).join("")}
            </div>
            <div class="flex gap-3 mb-2">
                <span class="text-yellow-400">▲ ${q.upvotes}</span>
                <button onclick="addAnswer(${i})" class="bg-blue-700 px-2 py-1 rounded text-xs text-white hover-glow">Answer</button>
            </div>
            <div><b>Answers:</b>
                <ul>
                    ${q.answers.map(a=>`<li class="text-sm mt-1"><span class="font-bold">${a.user}:</span> ${a.text}</li>`).join("")}
                </ul>
            </div>
        </div>`;
    });
    document.getElementById('qa-list').innerHTML = html;
}

// Add Question
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

// Add Answer
function addAnswer(idx) {
    let ans = prompt("Type your answer:");
    if (ans) {
        qaData[idx].answers.push({user:"You",text:ans});
        renderQA();
    }
}

document.addEventListener('DOMContentLoaded', renderQA);
</script>

</body>
</html>
