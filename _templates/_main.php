<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = isset($_SESSION['username']) && !empty($_SESSION['username'])
    ? htmlspecialchars($_SESSION['username'])
    : "Guest";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #000000ff 0%, #22d3ee 100%);
            color: #e2e8f0;
            overflow-x: hidden;
        }
        .flex { display: flex; }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 2rem; }

        /* SIDEBAR STYLES */
        .sidebar {
            width: 220px;
            background: linear-gradient(120deg, #000000ff 0%, #22d3ee 100%);
            color: #e2e8f0;
            height: 100vh;
            position: fixed;
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
            border-radius: 50%;
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
            gap: 1.7rem;
        }
        .sidebar ul li {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .sidebar ul li a {
            display: flex;
            align-items: center;
            gap: 1.1rem;
            color: #e2e8f0;
            background: none;
            border: none;
            font-size: 1.23rem;
            width: 85%;
            padding: 0.65rem 0.4rem;
            border-radius: 0.55rem;
            transition: background 0.18s, color 0.15s;
            text-decoration: none;
            justify-content: flex-start;
        }
        .sidebar ul li a i {
            font-size: 1.35rem;
            min-width: 26px;
            transition: color 0.22s, opacity 0.22s;
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
            margin: 10;
            pointer-events: none;
        }
        .sidebar ul li a:hover, .sidebar ul li a:focus {
            background: rgba(55,255,100,0.11);
            color: #bdf8c6;
        }
        .sidebar-bottom {
            margin-bottom: 1.4rem;
            display: flex;
            justify-content: center;
        }
        .sidebar-bottom a {
            display: flex;
            align-items: center;
            gap: 1.1rem;
            color: #e2e8f0;
            width: 85%;
            padding: 0.65rem 0.4rem;
            border-radius: 0.55rem;
            transition: background 0.22s, color 0.15s;
            text-decoration: none;
            justify-content: flex-start;
        }
        .sidebar-bottom a i {
            font-size: 1.35rem;
            min-width: 26px;
            text-align: center;
        }
        .sidebar-bottom a span {
            transition: opacity 0.18s, width 0.13s, margin 0.13s;
            white-space: nowrap;
            overflow: hidden;
            margin-left: 0.1rem;
        }
        .sidebar-bottom a:hover, .sidebar-bottom a:focus {
            background: #1e641e;
            color: #fff;
        }

        /* Main content shifts when sidebar open (matches sidebar width) */
        .main-content {
            flex: 1;
            min-width: 0;
            background: transparent;
            padding: 0;
            margin-left: 56px;
            transition: margin-left 0.22s cubic-bezier(.88,-0.15,.23,1.11);
        }
        .sidebar.open ~ .main-content,
        .main-content.shift {
            margin-left: 220px;
        }
        /* Responsive: sidebar overlays content on small screens */
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

        /* --- rest of your dashboard styles below, unchanged --- */
        .dashboard-header {
            padding: 2.5rem 0 1.5rem 0;
            border-bottom: 1px solid #222;
            background: rgba(13,17,23,0.88);
            border-radius: 0 0 1.2rem 1.2rem;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,.12);
            margin-bottom: 2rem;
        }
        .dashboard-header h1 { font-size: 2.7rem; font-weight: bold; color: #38bdf8; margin: 0; letter-spacing: 1px; }
        .dashboard-header p { color: #94a3b8; font-size: 1.25rem; margin-top: 0.7rem; }
        .feature-bar { display: flex; gap: 1.2rem; margin: 2rem 0; flex-wrap: wrap; }
        .feature-btn {
            background: rgba(34,34,34,0.88);
            color: #e2e8f0;
            border: 1px solid #30363d;
            border-radius: 0.5rem;
            padding: 0.7rem 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .feature-btn:hover { background: #38bdf8; color: #161b22; border-color: #38bdf8; }
        .stats-bar { display: flex; gap: 2rem; margin-bottom: 2.5rem; flex-wrap: wrap; }
        .stat-card { background: rgba(34,39,46,0.98); padding: 1.3rem 2.2rem; border-radius: 1rem; color: #38bdf8; font-weight: 600; border: 1px solid #30363d; display: flex; align-items: center; gap: 0.8rem; }
        .stat-card .stat-icon { font-size: 1.6rem; color: #6366f1; }
        .stat-card .stat-value { font-weight: bold; color: #fff; font-size: 1.45rem; margin-left: 0.2rem; }
        .dashboard-grid { display: grid; grid-template-columns: 1fr; gap: 2.5rem; margin-bottom: 2rem; }
        @media(min-width: 700px) { .dashboard-grid { grid-template-columns: repeat(2,1fr); } }
        @media(min-width: 1200px) { .dashboard-grid { grid-template-columns: repeat(3,1fr); } }
        .card {
            background: rgba(34,39,46,0.98);
            border-radius: 1.2rem;
            padding: 2.3rem 1.4rem;
            text-align: left;
            box-shadow: 0 6px 20px rgba(59,130,246,0.13);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border: 1px solid #30363d;
        }
        .card:hover { transform: translateY(-5px) scale(1.025); border-color: #38bdf8; }
        .card .icon { font-size: 2.7rem; margin-bottom: 1.1rem; color: #6366f1; }
        .card h2 { font-size: 1.35rem; font-weight: 700; margin-bottom: 0.7rem; color: #e2e8f0; }
        .card p { margin-top: 0.2rem; color: #94a3b8; font-size: 1.1rem; margin-bottom: 1.2rem; }
        .btn {
            background: #38bdf8; color: #161b22; padding: 0.6rem 1.25rem; border-radius: 0.5rem; font-weight: 600; border: none; font-size: 1rem;
        }
        .btn:hover, .btn:focus { background: #6366f1; color: #fff; transform: translateY(-2px) scale(1.04); }
    </style>
</head>
<body>
    <div class="flex">
        <?php include '_sidebar.php'; ?>
        <main class="main-content" id="mainContent">
            <div class="container">
                <section class="dashboard-header">
                    <h1>Welcome, <?php echo $username; ?>!</h1>
                    <p>Connect, collaborate, and create your story. This dashboard is your gateway to alumni, opportunities, and inspiration.</p>
                </section>
                <div class="feature-bar">
                    <button class="feature-btn"><i class="fas fa-bolt"></i> Launch</button>
                    <button class="feature-btn"><i class="fas fa-chart-line"></i> Analytics</button>
                    <button class="feature-btn"><i class="fas fa-graduation-cap"></i> Courses</button>
                    <button class="feature-btn"><i class="fas fa-award"></i> Achievements</button>
                    <button class="feature-btn"><i class="fas fa-globe"></i> Explore</button>
                    <button class="feature-btn"><i class="fas fa-lightbulb"></i> Ideas</button>
                    <button class="feature-btn"><i class="fas fa-rocket"></i> Projects</button>
                    <button class="feature-btn"><i class="fas fa-heart"></i> Support</button>
                </div>
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
                        <a href="NetworkingHub.html" class="btn">Go to Hub</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-briefcase icon"></i>
                        <h2>Job Portal</h2>
                        <p>Discover open positions, internships, or post your own opportunities for others.</p>
                        <a href="JobPortal.html" class="btn">Find Jobs</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-calendar-alt icon"></i>
                        <h2>Events & Reunions</h2>
                        <p>See upcoming events, reunions, and register to meet fellow alumni.</p>
                        <a href="EventsReunions.html" class="btn">See Events</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-trophy icon"></i>
                        <h2>Success Stories</h2>
                        <p>Read about inspiring alumni journeys and featured achievements.</p>
                        <a href="SuccessStories.html" class="btn">Read Stories</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-comments icon"></i>
                        <h2>Feedback & Surveys</h2>
                        <p>Share your thoughts, suggest improvements, and help grow the community.</p>
                        <a href="feedback_form.html" class="btn">Send Feedback</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-lightbulb icon"></i>
                        <h2>Ideas & Innovation</h2>
                        <p>Propose new features, vote on ideas, and help shape the future of this portal.</p>
                        <a href="#" class="btn">Submit Idea</a>
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

        // Also close (to icons only) on ESC key
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