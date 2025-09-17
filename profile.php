<?php include '/_templates/_head.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome for social/achievement icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #000 0%, #22d3ee 100%);
            color: #e2e8f0;
            overflow-x: hidden;
        }
        .container {
            max-width: 950px;
            margin: 0 auto;
            padding: 0 1.2rem;
        }
        .dashboard-header {
            padding: 2rem 0 1.2rem 0;
            border-bottom: 1px solid #222;
            background: rgba(13,17,23,0.88);
            border-radius: 0.8rem 0.8rem 0 0;
            box-shadow: 0 4px 24px 0 rgba(31,38,135,.12);
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
        }
        .download-report-btn {
            position: absolute;
            right: 1.2rem;
            top: 2.1rem;
            background: #38bdf8;
            color: #161b22;
            border-radius: 0.48rem;
            font-weight: 600;
            border: none;
            padding: 0.42rem 1.1rem;
            font-size: 0.98rem;
            box-shadow: 0 2px 8px #38bdf844;
            cursor: pointer;
        }
        .dashboard-header h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #38bdf8;
            margin: 0;
            letter-spacing: 1px;
        }
        .dashboard-header p {
            color: #94a3b8;
            font-size: 1.02rem;
            margin-top: 0.4rem;
        }
        .student-rank {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #22d3ee33;
            color: #22d3ee;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 1.02rem;
            margin-top: 0.7rem;
            padding: 0.2rem 1.2rem;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .student-rank:hover {
            background: #38bdf8;
            color: #fff;
        }
        .profile-card {
            background: rgba(34,39,46,0.98);
            border-radius: 1.1rem;
            padding: 1.5rem 1.3rem 1.2rem 1.3rem;
            box-shadow: 0 2px 12px rgba(59,130,246,0.13);
            border: 1px solid #30363d;
            margin-bottom: 1.1rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            min-width: 0;
            position: relative;
        }
        .profile-top {
            display: flex;
            gap: 2.3rem;
            align-items: flex-start;
            width: 100%;
        }
        .profile-avatar-area {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 155px;
        }
        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 4px solid #22d3ee;
            object-fit: cover;
            box-shadow: 0 2px 12px #22d3ee44;
            background: #222;
        }
        .profile-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 0.8rem;
        }
        .profile-info h2 {
            font-size: 1.43rem;
            font-weight: bold;
            color: #38bdf8;
            margin: 0 0 0.16rem 0;
            display: block;
            background: #222b3a;
            padding: 0.13rem 0.7rem;
            border-radius: 0.2rem;
            width: fit-content;
        }
        .profile-info .subinfo {
            color: #94a3b8;
            font-size: 1.01rem;
            margin-top: 0.17rem;
        }
        .profile-info .links {
            margin-top: 0.32rem;
            font-size: 1.01rem;
            color: #38bdf8;
            background: #222b3a;
            padding: 0.09rem 0.6rem;
            border-radius: 0.2rem;
            width: fit-content;
            display: inline-block;
        }
        .mentor-area {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin-top: 0.5rem;
            flex-wrap: wrap;
            font-size: 1.01rem;
        }
        .mentor-label {
            color: #94a3b8;
            font-weight: 500;
            background: #222b3a;
            padding: 0.09rem 0.6rem;
            border-radius: 0.2rem;
        }
        .mentor-name {
            background: #22d3ee33;
            color: #22d3ee;
            padding: 0.18rem 0.8rem;
            border-radius: 9999px;
            font-weight: 600;
            border: none;
        }
        .profile-badges-row {
            margin-top: 1.1rem;
            margin-left: 165px;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }
        .profile-badges-row .badge {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            border-radius: 9999px;
            font-weight: 600;
            padding: 0.23rem 0.7rem;
            font-size: 0.98rem;
            border: none;
        }
        .profile-badges-row .badge-hackathon { background: #222b3a; color: #38bdf8;}
        .profile-badges-row .badge-ctf { background: #fde68a; color: #b45309;}
        .profile-badges-row .badge-quiz { background: #bbf7d0; color: #059669;}
        .profile-badges-row .badge-innovation { background: #a78bfa; color: #fff;}
        .profile-actions {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin-top: 1.2rem;
            flex-wrap: wrap;
            margin-left: 165px;
        }
        .profile-actions button,
        .profile-actions select {
            background: #22d3ee;
            color: #161b22;
            border-radius: 0.48rem;
            font-weight: 600;
            border: none;
            padding: 0.42rem 1.1rem;
            font-size: 1.01rem;
            transition: background 0.22s, color 0.15s, transform 0.18s;
        }
        .profile-actions button:hover,
        .profile-actions select:hover {
            background: #6366f1;
            color: #fff;
            transform: scale(1.03);
        }
        .socials {
            display: flex;
            gap: 0.8rem;
            align-items: center;
            margin-left: 1rem;
        }
        .socials a {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.15rem;
            transition: color 0.18s;
            padding: 0.1rem 0.3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
        }
        .socials a:hover { color: #22d3ee; background: #171e29; }
        .profile-bio {
            margin: 1.1rem 0 0.2rem 0;
            font-size: 1.06rem;
            color: #cbd5e1;
            width: 100%;
            text-align: center;
        }
        .save-bio-btn {
            margin-top: 0.6rem;
            background:#38bdf8;
            color:#161b22;
            padding:0.28rem 1rem;
            border-radius:0.35rem;
            font-weight:600;
            border:none;
        }
        .save-bio-btn:hover {
            background: #6366f1;
            color: #fff;
        }
        /* GRID CARDS */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.3rem;
            margin-bottom: 1.2rem;
            margin-top: 1.2rem;
        }
        @media(max-width:1000px){
            .dashboard-grid { grid-template-columns: 1fr; }
        }
        .card {
            background: rgba(34,39,46,0.98);
            border-radius: 1.1rem;
            padding: 1rem 0.7rem;
            text-align: left;
            box-shadow: 0 2px 12px rgba(59,130,246,0.13);
            border: 1px solid #30363d;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            min-height: 120px;
            margin-bottom: 0;
        }
        .card h2 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
            color: #e2e8f0;
        }
        .card ul, .card .chips {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .chip {
            background: #222b3a;
            color: #38bdf8;
            border-radius: 9999px;
            font-size: 0.98rem;
            font-weight: 600;
            padding: 0.19rem 0.75rem;
            margin-bottom: 0.3rem;
        }
        .card .chips span {margin-bottom:0;}
        .card li a {color: #38bdf8;text-decoration: underline;}
        .card .pending {background:#fde68a;color:#b45309;}
        .card .approved {background:#bbf7d0;color:#059669;}
        .card .rejected {background:#fecaca;color:#991b1b;}
        .card .badge {padding:0.16rem 0.65rem;font-size:0.85rem;}
        .card input, .card textarea {
            width: 99%;
            background: #161b22;
            color: #e2e8f0;
            border: 1px solid #30363d;
            border-radius: 0.4rem;
            padding: 0.45rem;
            font-size: 0.98rem;
            margin-top: 0.4rem;
            margin-bottom: 0.4rem;
            box-sizing: border-box;
        }
        .card input:focus, .card textarea:focus {
            border-color: #38bdf8;
            outline: none;
        }
        .card button {
            background: #38bdf8;
            color: #161b22;
            border-radius: 0.4rem;
            font-weight: 600;
            border: none;
            padding: 0.45rem 1.1rem;
            font-size: 0.98rem;
            margin-top: 0.3rem;
            transition: background 0.22s, color 0.15s, transform 0.18s;
        }
        .card button:hover, .card button:focus {
            background: #6366f1;
            color: #fff;
            transform: scale(1.04);
        }
        /* Education and Verified Projects same height */
        .card.education-cert,
        .card.verified-projects {
            min-height: 220px;
            max-height: 220px;
            overflow-y: auto;
        }
        .card.verified-projects ul {
            padding-bottom: 0.4em;
        }
        .card.verified-projects li {
            margin-bottom: 0.8em;
        }
        .card.verified-projects .badge,
        .card.verified-projects .pending {
            margin-top: 0.2em;
        }
        /* Only show last 2 projects */
        .card.verified-projects ul li { display: none; }
        .card.verified-projects ul li:nth-last-child(-n+2) { display: block; }
    </style>
</head>
<body>
<div class="container">
    <div class="dashboard-header">
        <button class="download-report-btn"><i class="fa fa-download"></i> Download Report</button>
        <h1>Welcome, Guruprasanth M</h1>
        <p>Cybersecurity & Ethical Hacking | Developer (C, PHP, Python, Java)</p>
        <a href="https://your-leaderboard-url.com" class="student-rank" title="Go to Leaderboard">
            <i class="fa fa-trophy"></i> Top 20 in System
        </a>
    </div>
    <!-- PROFILE CARD -->
    <section class="profile-card">
        <div class="profile-top">
            <div class="profile-avatar-area">
                <img src="https://img.icons8.com/color/128/user-male-circle--v2.png" class="profile-avatar" alt="Profile">
            </div>
            <div class="profile-info">
                <h2>
                    Guruprasanth M
                </h2>
                <div class="subinfo">Karur, Tamil Nadu, India • <a href="#">Contact info</a></div>
                <div class="links">
                    Selfmade Ninja Academy <span style="color:#cbd5e1;">•</span> 500+ connections
                </div>
                <div class="mentor-area">
                    <span class="mentor-label"><i class="fa fa-user-tie"></i> Mentor:</span>
                    <span class="mentor-name">Anand Kumar (ID: SNA2035)</span>
                </div>
                <!-- BADGES & ACHIEVEMENTS ROW INSIDE PROFILE CARD -->
                <div class="profile-badges-row">
                    <span class="badge badge-hackathon"><i class="fa fa-trophy"></i> Hackathon Winner</span>
                    <span class="badge badge-ctf"><i class="fa fa-flag"></i> CTF Top 5</span>
                    <span class="badge badge-quiz"><i class="fa fa-star"></i> Quiz Master</span>
                    <span class="badge badge-innovation"><i class="fa fa-lightbulb"></i> Innovation Badge</span>
                </div>
                <div class="profile-actions">
                    <button>Connect</button>
                    <button>Message</button>
                    <button>Edit Profile</button>
                    <select>
                        <option>Global</option>
                        <option>Campus</option>
                        <option>Private</option>
                    </select>
                    <div class="socials">
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="#" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Portfolio"><i class="fa fa-globe"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-bio">
            Cybersecurity-focused full-stack developer with hands-on training from Selfmade Ninja Academy (SNA)...<br>
            <button class="save-bio-btn">Save Bio</button>
        </div>
    </section>
    <!-- DASHBOARD GRID -->
    <div class="dashboard-grid">
        <section class="card">
            <h2>Skills</h2>
            <div class="chips">
                <span class="chip">Python</span>
                <span class="chip">PHP</span>
                <span class="chip">C</span>
                <span class="chip">Java</span>
                <span class="chip">Cybersecurity</span>
                <span class="chip">Linux</span>
                <span class="chip">Networking</span>
                <span class="chip">SQL</span>
                <span class="chip">Web Security</span>
            </div>
        </section>
        <section class="card">
            <h2>Interests</h2>
            <div class="chips">
                <span class="chip">AI/ML</span>
                <span class="chip">Cloud Computing</span>
                <span class="chip">Bug Bounty</span>
                <span class="chip">Open Source</span>
                <span class="chip">CTFs</span>
                <span class="chip">Penetration Testing</span>
                <span class="chip">Reverse Engineering</span>
            </div>
        </section>
        <section class="card">
            <h2>Recent Activity</h2>
            <ul>
                <li>Answered: <a href="#">How to deploy on AWS?</a> (Global Q&A)</li>
                <li>Posted: <a href="#">Submitted Smart Attendance System for review!</a> (Campus Feed)</li>
                <li>Asked: <a href="#">Best resources for CTF beginners?</a> (Global Q&A)</li>
                <li>Commented: <a href="#">Tips for bug bounty hunting!</a> (Global Q&A)</li>
            </ul>
        </section>
        <section class="card">
            <h2>Experience</h2>
            <ul>
                <li>Intern, Infosys (Summer 2024)</li>
                <li>Campus Cybersecurity Club Leader (2023-2024)</li>
                <li>Freelance Penetration Tester (2022-2023)</li>
            </ul>
            <input type="text" maxlength="60" placeholder="Add experience..." />
            <button>+ Add Experience</button>
        </section>
        <section class="card education-cert">
            <h2>Education & Certifications</h2>
            <ul>
                <li>B.Tech CSE, ABC Institute, 2024</li>
                <li>Certified Ethical Hacker</li>
                <li>Google Cybersecurity Certificate</li>
            </ul>
            <input type="text" maxlength="60" placeholder="Add education/certification..." />
            <button>+ Add Education</button>
        </section>
        <section class="card verified-projects">
            <h2>Verified Projects</h2>
            <ul>
                <li>
                    <strong>CyberSafe App</strong><br>
                    <a href="#">Source Code</a> | <a href="#">Demo</a>
                    <div style="margin: 0.2em 0 0.2em 0;"><span class="badge approved">Approved</span></div>
                    <div style="font-size:0.98em; color:#cbd5e1;">Mobile app for reporting and tracking cyber threats and security incidents.</div>
                </li>
                <li>
                    <strong>SQL Injection Challenge</strong><br>
                    <a href="#">Source Code</a> | <a href="#">Demo</a>
                    <div style="margin: 0.2em 0 0.2em 0;"><span class="badge pending">Pending</span></div>
                    <div style="font-size:0.98em; color:#cbd5e1;">A gamified platform to learn, test, and defend against SQL injection attacks.</div>
                </li>
            </ul>
            <input type="text" maxlength="60" placeholder="Project Title" />
            <input type="text" maxlength="60" placeholder="Repo/Demo Link" />
            <input type="text" maxlength="100" placeholder="Project Explanation" />
            <div style="display:flex;gap:0.5rem;">
                <button>+ Add Project</button>
                <button style="background:#22d3ee;color:#161b22;">Team Submit</button>
            </div>
        </section>
    </div>
</div>
</body>
</html>
<?php include '/_templates/_footer.php'; ?>