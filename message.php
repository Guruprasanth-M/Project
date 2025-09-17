<?php
// mentor.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mentorship – SkillSphere</title>
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

<!-- Mentorship / Messages Section -->
<section id="messages" class="section py-16 animate__animated animate__fadeIn">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 shine">Messages / Mentorship</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Inbox -->
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4">Inbox</h3>
                <ul id="messages-inbox" class="space-y-2">
                    <!-- JS will render sample data -->
                </ul>
            </div>
            <!-- Mentorship Requests -->
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4">Mentorship Requests</h3>
                <ul id="mentorship-requests" class="space-y-2">
                    <!-- JS will render sample data -->
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
// Sample Inbox Messages
const messagesInbox = [
    {from:"Alice Smith", text:"Congrats on your project approval!"},
    {from:"Bob Johnson", text:"Want to join my CTF team?"},
];

// Sample Mentorship Requests
const mentorshipRequests = [
    {from:"Priya Sharma", status:"Pending"},
];

function renderMessages() {
    let inbox = "";
    messagesInbox.forEach(m => {
        inbox += `<li class="bg-gray-800 rounded px-4 py-2 flex justify-between items-center">
            <span><b>${m.from}</b>: ${m.text}</span>
            <button class="bg-blue-700 px-2 py-1 rounded text-xs text-white hover-glow">Reply</button>
        </li>`;
    });
    document.getElementById('messages-inbox').innerHTML = inbox;

    let mentor = "";
    mentorshipRequests.forEach(m => {
        mentor += `<li class="bg-gray-800 rounded px-4 py-2 flex justify-between items-center">
            <span><b>${m.from}</b> (Status: ${m.status})</span>
            <div class="flex gap-2">
                <button class="bg-green-700 px-2 py-1 rounded text-xs text-white hover-glow">Accept</button>
                <button class="bg-red-700 px-2 py-1 rounded text-xs text-white hover-glow">Decline</button>
            </div>
        </li>`;
    });
    document.getElementById('mentorship-requests').innerHTML = mentor;
}

document.addEventListener('DOMContentLoaded', renderMessages);
</script>

</body>
</html>
