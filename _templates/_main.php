<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = "Guest";
if (!empty($_SESSION['user_id'])) {
    try {
        $user = new user($_SESSION['user_id']);
        $username = htmlspecialchars($user->getUsername());
    } catch (Exception $e) {
        $username = "Guest";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #000000ff 0%, #22d3ee 100%);
            color: #e2e8f0;
            overflow-x: hidden;
        }
        .flex { display: flex; gap: 0; } /* Remove gap between sidebar and main */
        .container { max-width: 1400px; margin: 0 auto; padding: 0 1.5rem; }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background: linear-gradient(120deg, #000000ff 0%, #22d3ee 100%);
            color: #e2e8f0;
            top: 0;
            left: 0;
            z-index: 100;
            box-shadow: 0 0 12px rgba(0,0,0,0.09);
            backdrop-filter: blur(2px);
            transform: translateX(0);
            transition: width 0.22s cubic-bezier(.88,-0.15,.23,1.11);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        
           
        }
        .sidebar.closed {
            width: 56px;
        }
        .sidebar-header {
            padding: 0.75rem 0.5rem;
            border-bottom: 1px solid #222;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(0,0,0,0.12);
        }
        .sidebar-toggle {
            background: #fff;
            color: #000;
            border: none;
            padding: 0.4rem 0.6rem;
            border-radius: 10px;
            font-size: 1.2rem;
            cursor: pointer;
            margin: 0 auto;
            transition: all 0.3s;
        }
        .sidebar-toggle:hover {
            background: #fff;
            color: #000;
            transform: scale(1.1);
        }
        .sidebar nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 2rem 0 0 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        .sidebar ul li {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .sidebar ul li a {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #e2e8f0;
            font-size: 1rem;
            width: 85%;
            padding: 0.5rem 0.4rem;
            border-radius: 0.55rem;
            transition: background 0.18s, color 0.15s;
            text-decoration: none;
            justify-content: flex-start;
        }
        .sidebar ul li a i {
            font-size: 1.2rem;
            min-width: 24px;
            text-align: center;
        }
        .sidebar ul li a span {
            transition: opacity 0.15s, width 0.13s, margin 0.13s;
            white-space: nowrap;
            overflow: hidden;
            margin-left: 0.1rem;
        }
        .sidebar.closed ul li a span,
        .sidebar.closed .sidebar-bottom a span {
            opacity: 0;
            width: 0;
            pointer-events: none;
        }
        
        .sidebar ul li a:hover, .sidebar ul li a:focus {
            background: rgba(55,255,100,0.11);
            color: #bdf8c6;
        }

        /* Main content shifts with sidebar */
        .main-content {
            flex: 1;
            min-width: 0;
            background: transparent;
            margin-left: 56px;
            transition: margin-left 0.22s cubic-bezier(.88,-0.15,.23,1.11);
        }
        .sidebar.open ~ .main-content,
        .main-content.shift {
            margin-left: 50px;
        }
        @media (max-width: 900px) {
            .main-content,
            .main-content.shift {
                margin-left: 0;
            }
            .sidebar,
            .sidebar.closed {
                width: 90vw;
            }
        }

        /* Dashboard content styles */
        .dashboard-header {
            padding: 2rem ;
            border-bottom: 1px solid #222;
            background: rgba(13,17,23,0.88);
            border-radius: 20px;
            margin-bottom: 2rem;
            margin-top: 2rem;
        }
        .dashboard-header h1 { font-size: 2rem; font-weight: bold; color: #38bdf8; margin: 0; }
        .dashboard-header p { color: #94a3b8; font-size: 1rem; margin-top: 0.5rem; }
        .feature-bar { display: flex; gap: 0.8rem; margin: 1.5rem 0; flex-wrap: wrap; }
        .feature-btn {
            background: rgba(34,34,34,0.88);
            color: #e2e8f0;
            border: 1px solid #30363d;
            border-radius: 0.5rem;
            padding: 0.55rem 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .feature-btn:hover { background: #38bdf8; color: #161b22; border-color: #38bdf8; }
        .stats-bar { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .stat-card { background: rgba(34,39,46,0.98); padding: 0.9rem 1.2rem; border-radius: 0.8rem; color: #38bdf8; font-weight: 600; border: 1px solid #30363d; display: flex; align-items: center; gap: 0.6rem; }
        .stat-card .stat-icon { font-size: 1.3rem; color: #6366f1; }
        .stat-card .stat-value { font-weight: bold; color: #fff; font-size: 1.1rem; margin-left: 0.2rem; }
        .dashboard-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 2rem; }
        @media(min-width: 700px) { .dashboard-grid { grid-template-columns: repeat(2,1fr); } }
        @media(min-width: 1200px) { .dashboard-grid { grid-template-columns: repeat(3,1fr); } }
        .card {
            background: rgba(34,39,46,0.98);
            border-radius: 1rem;
            padding: 1.5rem 1.2rem;
            text-align: left;
            box-shadow: 0 6px 20px rgba(59,130,246,0.13);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border: 1px solid #30363d;
        }
        .card:hover { transform: translateY(-5px) scale(1.02); border-color: #38bdf8; }
        .card .icon { font-size: 2rem; margin-bottom: 0.8rem; color: #6366f1; }
        .card h2 { font-size: 1.1rem; font-weight: 700; margin-bottom: 0.5rem; color: #e2e8f0; }
        .card p { color: #94a3b8; font-size: 0.95rem; margin-bottom: 1rem; }
        .btn {
            background: #38bdf8; color: #161b22; padding: 0.45rem 0.9rem; border-radius: 0.4rem; font-weight: 600; border: none; font-size: 0.9rem;
        }
        .btn:hover { background: #6366f1; color: #fff; }
    </style>
</head>
<body>
    <div class="flex" style="gap:0;">
        <?php include '_sidebar.php'; ?>
        <main class="main-content" id="mainContent">
            <div class="container">
                <section class="dashboard-header">
                    <h1>Welcome, <?php echo $username; ?>!</h1>
                    <p>Connect, collaborate, and create your story. This dashboard is your gateway to alumni, opportunities, and inspiration.</p>
                </section>

                <div class="stats-bar">
                    <div class="stat-card"><i class="fas fa-user-friends stat-icon"></i> Alumni Connections <span class="stat-value">1,234</span></div>
                    <div class="stat-card"><i class="fas fa-briefcase stat-icon"></i> Jobs Posted <span class="stat-value">98</span></div>
                    <div class="stat-card"><i class="fas fa-calendar-alt stat-icon"></i> Upcoming Events <span class="stat-value">5</span></div>
                    <div class="stat-card"><i class="fas fa-trophy stat-icon"></i> Success Stories <span class="stat-value">42</span></div>
                </div>

                <section class="dashboard-grid">
                    <div class="card">
                        <i class="fas fa-users icon"></i>
                        <h2>Networking Hub</h2>
                        <p>Connect with alumni in your field, find mentors, and join vibrant communities.</p>
                        <a href="directory.php" class="btn">Go to Hub</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-briefcase icon"></i>
                        <h2>Job Portal</h2>
                        <p>Discover open positions, internships, or post your own opportunities for others.</p>
                        <a href="job.php" class="btn">Find Jobs</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-calendar-alt icon"></i>
                        <h2>Events & Reunions</h2>
                        <p>See upcoming events, reunions, and register to meet fellow alumni.</p>
                        <a href="event.php" class="btn">See Events</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-trophy icon"></i>
                        <h2>Success Stories</h2>
                        <p>Read about inspiring alumni journeys and featured achievements.</p>
                        <a href="success_stories.php" class="btn">Read Stories</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-code icon"></i>
                        <h2>Practice here</h2>
                        <p>Improve your problem solving skill by solving our problems</p>
                        <a href="practice.php" class="btn">Send Feedback</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-lightbulb icon"></i>
                        <h2>Ideas & Innovation</h2>
                        <p>Propose new features, vote on ideas, and help shape the future of this portal.</p>
                        <a href="submit.php" class="btn">Submit Idea</a>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', () => {
            const isClosed = sidebar.classList.contains('closed');
            sidebar.classList.toggle('closed');
            sidebar.classList.toggle('open', isClosed);
            if (isClosed) {
                mainContent.classList.add('shift');
            } else {
                mainContent.classList.remove('shift');
            }
        });

        document.addEventListener('keydown', e => {
            if (e.key === "Escape") {
                sidebar.classList.add('closed');
                sidebar.classList.remove('open');
                mainContent.classList.remove('shift');
            }
        });
    </script>
</body>
</html>