<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard | Connect Students to the World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #161b22;
            color: #e2e8f0;
        }
        a { text-decoration: none; color: inherit; }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .flex { display: flex; }
        .sidebar {
            width: 17rem;
            background: #0d1117;
            color: #e2e8f0;
            height: 100vh;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 20;
            box-shadow: 0 0 12px rgba(0,0,0,0.09);
            transition: transform 0.3s;
        }
        .sidebar-header {
            position: sticky;
            top: 0;
            background: #0d1117;
            z-index: 21;
            padding-top: 2.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #222;
        }
        .sidebar-header h2 {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
            color: #38bdf8;
        }
        .sidebar nav {
            margin-top: 2rem;
        }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li { margin-bottom: 1rem; }
        .sidebar ul li a {
            display: block;
            padding: 0.75rem 1rem;
            background: #161b22;
            border-radius: 0.5rem;
            transition: background 0.3s, color 0.3s;
            color: #e2e8f0;
            font-weight: 500;
        }
        .sidebar ul li a:hover, .sidebar ul li a:focus {
            background: #3b82f6;
            color: #fff;
        }
        .sidebar ul li a i { margin-right: 0.5rem; }
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1.2rem;
            left: 1.2rem;
            z-index: 30;
            background: #1e293b;
            color: #38bdf8;
            border: none;
            padding: 0.5rem;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.14);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            min-width: 0;
            background: #161b22;
            padding: 0;
        }
        .dashboard-header {
            padding: 2.5rem 0 1.5rem 0;
            border-bottom: 1px solid #222;
            background: #0d1117;
        }
        .dashboard-header h1 {
            font-size: 2.7rem;
            font-weight: bold;
            color: #38bdf8;
            margin: 0;
            letter-spacing: 1px;
        }
        .dashboard-header p {
            color: #94a3b8;
            font-size: 1.25rem;
            margin-top: 0.7rem;
        }
        .feature-bar {
            display: flex;
            gap: 1.2rem;
            margin: 2rem 0 2rem 0;
            flex-wrap: wrap;
        }
        .feature-btn {
            background: #222;
            color: #e2e8f0;
            border: 1px solid #30363d;
            border-radius: 0.5rem;
            padding: 0.7rem 1.2rem;
            font-weight: 600;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            transition: background 0.2s, border 0.2s;
        }
        .feature-btn:hover {
            background: #3b82f6;
            color: #fff;
            border-color: #3b82f6;
        }
        /* Cards grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
            margin-bottom: 2rem;
        }
        @media(min-width: 700px) {
            .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media(min-width: 1200px) {
            .dashboard-grid { grid-template-columns: repeat(3, 1fr); }
        }
        .card {
            background: #22272e;
            border-radius: 1.2rem;
            padding: 2.3rem 1.4rem;
            text-align: left;
            box-shadow: 0 6px 20px rgba(59,130,246,0.11);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            border: 1px solid #30363d;
        }
        .card:hover {
            transform: translateY(-5px) scale(1.025);
            box-shadow: 0 20px 40px rgba(59,130,246,0.21);
            border-color: #3b82f6;
        }
        .card .icon {
            font-size: 2.7rem;
            margin-bottom: 1.1rem;
            color: #3b82f6;
            transition: color 0.2s;
        }
        .card:hover .icon { color: #38bdf8; }
        .card h2 {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 0.7rem;
            color: #e2e8f0;
        }
        .card p {
            margin-top: 0.2rem;
            color: #94a3b8;
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
        }
        .btn {
            background: #3b82f6;
            color: #ffffff;
            padding: 0.6rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 2px 8px rgba(59,130,246,0.09);
            border: none;
            font-size: 1rem;
        }
        .btn:hover, .btn:focus {
            background: #2563eb;
            transform: translateY(-2px) scale(1.04);
        }
        /* Special Stats Section */
        .stats-bar {
            display: flex;
            gap: 2rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }
        .stat-card {
            background: #22272e;
            padding: 1.3rem 2.2rem;
            border-radius: 1rem;
            color: #38bdf8;
            font-size: 1.18rem;
            font-weight: 600;
            border: 1px solid #30363d;
            box-shadow: 0 2px 8px rgba(59,130,246,0.09);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .stat-card .stat-icon { font-size: 1.6rem; color: #3b82f6; }
        .stat-card .stat-value { font-weight: bold; color: #fff; font-size: 1.45rem; margin-left: 0.2rem;}
        /* Responsive sidebar hamburger */
        @media(max-width: 900px) {
            .sidebar {
                position: fixed;
                left: 0; top: 0; bottom: 0;
                transform: translateX(-100%);
                height: 100vh;
                width: 16rem;
                transition: transform 0.3s;
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-toggle { display: block; }
            .main-content { padding: 0; }
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(30,41,59,0.22);
            z-index: 19;
        }
        .sidebar.open ~ .sidebar-overlay { display: block; }
    </style>
</head>

<body>
    <!-- Hamburger for mobile -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Open alumni portal menu">
        <i class="fas fa-bars"></i>
    </button>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2>🎓 Alumni Portal</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="NetworkingHub.html"><i class="fas fa-users"></i> Networking Hub</a></li>
                    <li><a href="JobPortal.html"><i class="fas fa-briefcase"></i> Job Portal</a></li>
                    <li><a href="EventsReunions.html"><i class="fas fa-calendar-alt"></i> Events & Reunions</a></li>
                    <li><a href="SuccessStories.html"><i class="fas fa-trophy"></i> Success Stories</a></li>
                    <li><a href="feedback_form.html"><i class="fas fa-comments"></i> Feedback & Surveys</a></li>
                </ul>
            </nav>
        </aside>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        <!-- Main Content -->
        <main class="main-content">
            <div class="container">
                <!-- Dashboard Header -->
                <section class="dashboard-header">
                    <h1>Welcome, Explorer!</h1>
                    <p>Connect, collaborate, and create your story. This dashboard is your gateway to alumni, opportunities, and inspiration.</p>
                </section>
                <!-- Quick Feature Bar -->
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
                <!-- Special Stats Bar -->
                <div class="stats-bar">
                    <div class="stat-card"><span class="stat-icon"><i class="fas fa-user-friends"></i></span> Alumni Connections <span class="stat-value">1,234</span></div>
                    <div class="stat-card"><span class="stat-icon"><i class="fas fa-briefcase"></i></span> Jobs Posted <span class="stat-value">98</span></div>
                    <div class="stat-card"><span class="stat-icon"><i class="fas fa-calendar-alt"></i></span> Upcoming Events <span class="stat-value">5</span></div>
                    <div class="stat-card"><span class="stat-icon"><i class="fas fa-trophy"></i></span> Success Stories <span class="stat-value">42</span></div>
                </div>
                <!-- Cards grid -->
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
    <!-- Sidebar toggle script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarOverlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
        });
        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebarOverlay.style.display = 'none';
        });
        document.addEventListener('keydown', function(e){
            if(e.key === "Escape" && sidebar.classList.contains('open')){
                sidebar.classList.remove('open');
                sidebarOverlay.style.display = 'none';
            }
        });
    </script>
</body>
</html>