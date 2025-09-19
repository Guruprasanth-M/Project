<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logged_in = false;
$username = "Guest";

// Use username from session
if (!empty($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
    $logged_in = true;
}

// Dummy mentor name
$mentor_name = "Mr. R. CyberGuru";

// Dummy points and ranks
$global_points = 940; // Example: from global leaderboard
$internal_points = 540; // Example: from internal leaderboard (SNA only)
$global_rank = 4; // Example rank in global leaderboard
$internal_rank = 2; // Example rank in internal leaderboard

// Handle resume upload (preview only, not functional)
$resume_uploaded = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['resume']) && $logged_in) {
    $resume_uploaded = true;
    // For actual upload, move the file here and set $resume_url accordingly
}
// Dummy resume URL (use actual uploaded path if implemented)
$resume_url = $resume_uploaded ? '/uploads/my_resume.pdf' : '#';

// Dummy report URL
$report_url = '/downloads/my_report.pdf'; // Replace with actual path if needed

// Handle visibility selection
$profile_visibility = isset($_SESSION['profile_visibility']) ? $_SESSION['profile_visibility'] : 'Global';
if (isset($_POST['profile_visibility'])) {
    $_SESSION['profile_visibility'] = $_POST['profile_visibility'];
    $profile_visibility = $_POST['profile_visibility'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $logged_in ? $username . " – Profile" : "Login"; ?> Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #000 0%, #22d3ee 100%);
            color: #e2e8f0;
        }
        .container { max-width: 950px; margin: 0 auto; padding: 1rem; }
        .dashboard-header { padding: 2rem 0 1rem; border-bottom: 1px solid #222; }
        .login-card {
            margin: 5rem auto;
            max-width: 400px;
            background: rgba(34,34,36,0.7);
            border-radius: 1rem;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,.37);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,.18);
            padding: 2rem;
            text-align: center;
        }
        .login-card img { width: 96px; margin-bottom: 1rem; }
        .login-card h2 { color: #22d3ee; margin-bottom: 0.5rem; }
        .login-card p { color: #cbd5e1; margin-bottom: 1rem; }
        .login-btn {
            display: inline-block;
            background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%);
            padding: 0.6rem 1.2rem;
            color: #fff;
            font-weight: 600;
            border-radius: 0.3rem;
            text-decoration: none;
            transition: 0.2s;
            box-shadow: 0 0 12px #6366f1, 0 0 32px #22d3ee44;
        }
        .login-btn:hover { background: linear-gradient(90deg, #22d3ee 0%, #6366f1 100%); }
        .profile-card, .profile-section { background:#222831; padding:1rem; border-radius:0.5rem; margin-bottom:2rem; box-shadow:0 4px 12px rgba(0,0,0,0.5);}
        .profile-card h2 { color:#22d3ee; margin-bottom:0.5rem; }
        .profile-card ul, .profile-card div { margin:0.5rem 0; }
        .badge { margin-right:0.5rem; padding:0.3rem 0.6rem; border-radius:0.25rem; background:#1f2937; color:#facc15; font-size:0.8rem; font-weight:600; }
        .points-badge {
            background: #22d3ee;
            color: #222;
            font-weight: bold;
            border-radius: 0.4rem;
            padding: 0.25rem 0.7rem;
            margin-right: 0.7rem;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 2px 8px #22d3ee44;
        }
        .points-badge i { margin-right: 0.3em; color: #facc15; }
        .rank-label {
            background: #6366f1;
            color: #fff;
            font-weight: bold;
            border-radius: 0.4rem;
            padding: 0.25rem 0.7rem;
            margin-right: 0.5rem;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
        }
        .social-link { color:#38bdf8; margin-right:0.5rem; text-decoration:underline; }
        .save-btn { background:#22d3ee; color:#000; border:none; padding:0.3rem 0.8rem; border-radius:0.3rem; cursor:pointer; font-size:0.9rem; }
        .save-btn:hover { background:#6366f1; color:#fff; }
        input, textarea, select { background:#1f2937; color:#fff; border:none; border-radius:0.3rem; padding:0.3rem; width:100%; }
        button { cursor:pointer; }
        .skills-interests-container { display:flex; gap:3rem; flex-wrap:wrap; }
        .experience-education-container { display:flex; gap:3rem; flex-wrap:wrap; }
        .profile-section > div + div { margin-top: 1rem; }
        .skill-list, .interest-list { margin-bottom: 1rem; }
        .profile-actions { margin-top: 1rem; display: flex; gap: 1rem; flex-wrap:wrap; align-items:center;}
        .mentor-card { background: #1f2937; padding: 0.7rem 1.2rem; border-radius: 0.5rem; display: inline-block; margin-top: 0.5rem; color: #facc15; font-weight: 600;}
        .resume-status { color: #22d3ee; margin-left: 0.5rem; font-weight: 600;}
        .download-btn {
            background: #6366f1;
            color: #fff;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            cursor: pointer;
            font-size: 0.9rem;
            box-shadow: 0 2px 10px #6366f188;
            transition: background 0.2s;
            text-decoration: none;
        }
        .download-btn:hover { background: #22d3ee; color: #222831;}
        .upload-btn {
            background: #facc15;
            color: #222831;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 0.3rem;
        }
        .upload-btn:hover { background: #fde68a; }
        .vis-form { margin-top: 0.7rem; }
        .vis-label { font-size: 0.95rem; color: #f4f4f5; margin-right: 0.5rem;}
        .vis-select { width: auto; display:inline-block; font-size:0.95rem; }
        .profile-points-rank { margin-top: 0.5rem; margin-bottom: 0.5rem; }
    </style>
</head>
<body>
<div class="container">
    <header class="dashboard-header">
        <h1>Profile</h1>
    </header>

    <?php if (!$logged_in): ?>
        <!-- Guest view -->
        <div class="login-card">
            <img src="https://img.icons8.com/color/128/circled-user-male-skin-type-1-2--v2.png" alt="Guest">
            <h2>Welcome, Guest!</h2>
            <p>Please log in to view your profile.</p>
            <a href="login.php" class="login-btn">Login</a>
        </div>
    <?php else: ?>
        <!-- Profile view -->

        <!-- Top Profile Info -->
        <div class="profile-card">
            <div style="display:flex; align-items:center; gap:1rem;">
                <img src="/project/assests/images/logo.png" style="border-radius:50%; border:3px solid #38bdf8; width:96px; height:96px;" alt="Avatar">
                <div>
                    <h2><?php echo $username; ?></h2>
                    <div>Karur, Tamil Nadu, India • <a href="#" class="social-link">Contact info</a></div>
                    <div class="profile-points-rank">
                        <span class="points-badge" title="Global Points">
                            <i class="fas fa-coins"></i> <?php echo $global_points; ?> pts
                        </span>
                        <span class="rank-label" title="Global Rank">
                            <i class="fas fa-globe"></i> Global: #<?php echo $global_rank; ?>
                        </span>
                        <span class="points-badge" style="background:#6366f1;color:#fff;" title="Internal Points">
                            <i class="fas fa-coins"></i> <?php echo $internal_points; ?> pts
                        </span>
                        <span class="rank-label" style="background:#22d3ee;color:#222;" title="Internal Rank">
                            <i class="fas fa-university"></i> Internal: #<?php echo $internal_rank; ?>
                        </span>
                    </div>
                    <div style="margin-top:0.5rem;">
                        <span class="badge">Selfmade Ninja Academy</span>
                        <span class="badge">500+ connections</span>
                    </div>
                    <!-- Mentor -->
                    <div class="mentor-card">
                        <i class="fas fa-user-tie"></i> Mentor: <?php echo $mentor_name; ?>
                    </div>
                    <!-- Profile Visibility -->
                    <form method="get" class="vis-form">
                        <label class="vis-label" for="profile_visibility">
                            Who can see your profile:
                        </label>
                        <select name="profile_visibility" id="profile_visibility" class="vis-select" onchange="this.form.submit()">
                            <option value="Global" <?php if($profile_visibility=='Global') echo 'selected'; ?>>Global</option>
                            <option value="Internal" <?php if($profile_visibility=='Internal') echo 'selected'; ?>>Internal</option>
                            <option value="Private" <?php if($profile_visibility=='Private') echo 'selected'; ?>>Private</option>
                        </select>
                        <span class="badge"><?php echo $profile_visibility; ?></span>
                    </form>
                    <!-- Actions -->
                    <div class="profile-actions">
                        <!-- Download Report -->
                        <a href="<?php echo $report_url; ?>" class="download-btn" download>
                            <i class="fas fa-file-download"></i> Download Report
                        </a>
                        <!-- Upload Resume -->
                        <form method="post" enctype="multipart/form-data" style="display:inline;">
                            <label for="resume" class="upload-btn">
                                <i class="fas fa-file-upload"></i> Upload Resume
                            </label>
                            <input type="file" id="resume" name="resume" style="display:none;" onchange="this.form.submit()">
                            <?php if ($resume_uploaded): ?>
                                <span class="resume-status">Resume uploaded!</span>
                            <?php endif; ?>
                        </form>
                        <!-- View Resume (if uploaded) -->
                        <?php if ($resume_uploaded): ?>
                            <a href="<?php echo $resume_url; ?>" class="download-btn" target="_blank">
                                <i class="fas fa-file"></i> View Resume
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- About -->
        <div class="profile-section">
            <h2>About</h2>
            <textarea rows="4" id="bio-text">Cybersecurity-focused full-stack developer with hands-on training from Selfmade Ninja Academy (SNA).</textarea>
            <!-- <button class="save-btn" onclick="saveBio()">Save Bio</button> -->
        </div>

        <!-- Skills & Interests -->
        <div class="profile-section skills-interests-container">
            <div style="flex:1;">
                <h2>Skills</h2>
                <div class="skill-list" id="skills-list">
                    <span class="badge">C</span>
                    <span class="badge">PHP</span>
                    <span class="badge">PYTHON</span>
                </div>
                <input id="skill-input" placeholder="Add skill...">
                <button class="save-btn" onclick="addSkill()">+ Add Skill</button>
            </div>
            <div style="flex:1;">
                <h2>Interests</h2>
                <div class="interest-list" id="interests-list">
                    <span class="badge">AI/ML</span>
                    <span class="badge">Cloud Computing</span>
                    <span class="badge">Cybersecurity</span>
                    <span class="badge">Web Development</span>
                    <span class="badge">Open Source</span>
                    <span class="badge">DevOps</span>
                </div>
                <input id="interest-input" placeholder="Add interest...">
                <button class="save-btn" onclick="addInterest()">+ Add Interest</button>
            </div>
        </div>

        <!-- Experience & Education -->
        <div class="profile-section experience-education-container">
            <div style="flex:1;">
                <h2>Experience</h2>
                <ul id="experience-list">
                    <li>Intern, Infosys (Summer 2024)</li>
                </ul>
                <input id="experience-input" placeholder="Add experience...">
                <button class="save-btn" onclick="addExperience()">+ Add Experience</button>
            </div>
            <div style="flex:1;">
                <h2>Education & Certifications</h2>
                <ul id="education-list">
                    <li>B.Tech CSE, ABC Institute, 2024</li>
                    <li>Certified Ethical Hacker</li>
                </ul>
                <input id="education-input" placeholder="Add education/certification...">
                <button class="save-btn" onclick="addEducation()">+ Add Education</button>
            </div>
        </div>

        <!-- Projects -->
        <div class="profile-section">
            <h2>Projects</h2>
            <ul id="projects-list">
                <li>Photogram <span class="badge">Approved</span></li>
                <li>College profile building site (No name right now) <span class="badge">Approved</span></li>
            </ul>
            <input id="project-title-input" placeholder="Project Title">
            <input id="project-link-input" placeholder="Repo/Demo Link">
            <input id="project-status-input" placeholder="Approved/Pending">
            <button class="save-btn" onclick="addProject()">+ Add Project</button>
        </div>

        <!-- Achievements -->
        <div class="profile-section">
            <h2>Achievements & Badges</h2>
            <span class="badge">Quiz Master</span>
            <span class="badge">Hackathon Winner</span>
            <span class="badge">CTF Top 5</span>
        </div>

        <!-- Social Links -->
        <div class="profile-section">
            <h2>Socials</h2>
<!-- LinkedIn -->
<a href="https://www.linkedin.com/in/yourprofile" target="_blank" class="social-link">
  <i class="fab fa-linkedin" style="color:#0A66C2; font-size:1.4em; margin-right:0.3em;"></i> LinkedIn
</a>
<!-- GitHub -->
<a href="https://github.com/yourusername" target="_blank" class="social-link">
  <i class="fab fa-github" style="color:#333; font-size:1.4em; margin-right:0.3em;"></i> GitHub
</a>
<!-- Twitter/X -->
<a href="https://twitter.com/yourusername" target="_blank" class="social-link">
  <i class="fab fa-twitter" style="color:#1DA1F2; font-size:1.4em; margin-right:0.3em;"></i> Twitter
</a>
<!-- Instagram -->
<a href="https://instagram.com/yourusername" target="_blank" class="social-link">
  <i class="fab fa-instagram" style="color:#E4405F; font-size:1.4em; margin-right:0.3em;"></i> Instagram
</a>
<!-- Facebook -->
<a href="https://facebook.com/yourusername" target="_blank" class="social-link">
  <i class="fab fa-facebook" style="color:#1877F3; font-size:1.4em; margin-right:0.3em;"></i> Facebook
</a>
        </div>

        <!-- Recent Activity -->
        <div class="profile-section">
            <h2>Recent Activity</h2>
            <ul>
                <li>Answered: <span class="social-link">How to deploy on AWS?</span></li>
                <li>Posted: <span class="social-link">Submitted Smart Attendance System for review!</span></li>
            </ul>
        </div>
    <?php endif; ?>
</div>
<?php if ($logged_in): ?>
<script>
function addSkill() {
    const input = document.getElementById('skill-input');
    const value = input.value.trim();
    if (value) {
        const span = document.createElement('span');
        span.className = 'badge';
        span.textContent = value;
        document.getElementById('skills-list').appendChild(span);
        input.value = '';
    }
}
function addInterest() {
    const input = document.getElementById('interest-input');
    const value = input.value.trim();
    if (value) {
        const span = document.createElement('span');
        span.className = 'badge';
        span.textContent = value;
        document.getElementById('interests-list').appendChild(span);
        input.value = '';
    }
}
function addExperience() {
    const input = document.getElementById('experience-input');
    const value = input.value.trim();
    if (value) {
        const li = document.createElement('li');
        li.textContent = value;
        document.getElementById('experience-list').appendChild(li);
        input.value = '';
    }
}
function addEducation() {
    const input = document.getElementById('education-input');
    const value = input.value.trim();
    if (value) {
        const li = document.createElement('li');
        li.textContent = value;
        document.getElementById('education-list').appendChild(li);
        input.value = '';
    }
}
function addProject() {
    const title = document.getElementById('project-title-input').value.trim();
    const link = document.getElementById('project-link-input').value.trim();
    const status = document.getElementById('project-status-input').value.trim();
    if (title && status) {
        const li = document.createElement('li');
        li.innerHTML = (link ? `<a href="${link}" class="social-link">${title}</a>` : title) + ` <span class="badge">${status}</span>`;
        document.getElementById('projects-list').appendChild(li);
        document.getElementById('project-title-input').value = '';
        document.getElementById('project-link-input').value = '';
        document.getElementById('project-status-input').value = '';
    }
}
function saveBio() {
    alert("Bio saved (mock)");
}
</script>
<?php endif; ?>
</body>
</html>