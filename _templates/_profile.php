<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = "Guest";
if (!empty($_SESSION['user_id'])) {
    try {
        require_once($_SERVER['DOCUMENT_ROOT'].'/project/includes/userclass_class.php');
        $user = new user($_SESSION['user_id']);
        $username = htmlspecialchars($user->getUsername());
    } catch (Exception $e) {
        $username = "Guest";
    }
}

// Handle resume upload (preview logic only, not functional)
$resume_uploaded = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['resume'])) {
    // Normally, you would move the uploaded file and store its path in the DB
    // For preview purposes, just set a flag
    $resume_uploaded = true;
}

// Dummy resume URL for download preview
$resume_url = $resume_uploaded ? '/uploads/my_resume.pdf' : '#';
?>
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
        }
        .profile-top {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-top: 2rem;
        }
        .profile-avatar {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            border: 4px solid #38bdf8;
            background: #222;
        }
        .profile-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 0.8rem;
            position: relative;
        }
        .profile-info-box {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .profile-info h2 {
            font-size: 1.43rem;
            font-weight: bold;
            color: #38bdf8;
            margin: 0 0 0.16rem 0;
            display: inline-block;
            background: #222b3a;
            padding: 0.13rem 0.7rem;
            border-radius: 0.2rem;
            width: fit-content;
        }
        .resume-actions {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .resume-btn {
            background: #22d3ee;
            color: #161b22;
            border-radius: 0.28rem;
            border: none;
            padding: 0.35rem 1rem;
            font-weight: 600;
            font-size: 0.98rem;
            cursor: pointer;
            transition: background 0.18s, color 0.15s;
        }
        .resume-btn:hover {
            background: #6366f1;
            color: #fff;
        }
        /* Add more styles as needed for the rest of the profile */
    </style>
</head>
<body>
<div class="container">
    <header class="dashboard-header">
        <h1>Profile</h1>
    </header>

    <section class="profile-card">
        <div class="profile-top">
            <div class="profile-avatar-area">
                <img src="https://img.icons8.com/color/128/user-male-circle--v2.png" class="profile-avatar" alt="Profile">
            </div>
            <div class="profile-info">
                <div class="profile-info-box">
                    <h2>
                        <?php echo $username; ?>
                    </h2>
                    <div class="resume-actions">
                        <form action="" method="post" enctype="multipart/form-data" style="display:inline;">
                            <label class="resume-btn">
                                <i class="fas fa-upload"></i> Upload Resume
                                <input type="file" name="resume" style="display:none" onchange="this.form.submit()">
                            </label>
                        </form>
                        <?php if ($resume_uploaded): ?>
                            <a href="<?php echo $resume_url; ?>" class="resume-btn" download>
                                <i class="fas fa-download"></i> Download Resume
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="subinfo">Karur, Tamil Nadu, India • <a href="#">Contact info</a></div>
                <div class="links">
                    Selfmade Ninja Academy <span style="color:#cbd5e1;">•</span> 500+ connections
                </div>
                <div class="mentor-area">
                    <span class="mentor-label"><i class="fa fa-user-tie"></i> Mentor:</span>
                    <span class="mentor-name">Anand Kumar (ID: SNA2035)</span>
                </div>
            </div>
        </div>
        <!-- BADGES & ACHIEVEMENTS ROW INSIDE PROFILE CARD -->
        <div class="profile-badges-row" style="margin-top: 1.1rem; margin-left: 165px; display: flex; align-items: center;">
            <span class="badge badge-hackathon"><i class="fa fa-trophy"></i> Hackathon Winner</span>
            <span class="badge badge-ctf"><i class="fa fa-flag"></i> CTF Top 5</span>
            <span class="badge badge-quiz"><i class="fa fa-star"></i> Quiz Master</span>
            <span class="badge badge-innovation"><i class="fa fa-lightbulb"></i> Innovation Badge</span>
        </div>
        <!-- Socials and other info -->
        <div class="socials" style="display:flex; gap:0.8rem; align-items:center; margin-left:1rem;">
            <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
            <a href="#" title="GitHub"><i class="fab fa-github"></i></a>
            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" title="Portfolio"><i class="fa fa-globe"></i></a>
        </div>
        <div class="profile-bio">
            Cybersecurity-focused full-stack developer with hands-on training from Selfmade Ninja Academy (SNA)...<br>
            <button class="save-bio-btn">Save Bio</button>
        </div>
    </section>
    <!-- DASHBOARD GRID, skills, etc... -->
</div>
</body>
</html>