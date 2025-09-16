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
    
</head>
<body>
    <!-- Hamburger -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Open menu">
        <i class="fas fa-bars"></i>
    </button>

    <div class="flex">
        <?php include '_sidebar.php'; ?>

        <main class="main-content">
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

    <script src="sidebar.js"></script>
</body>
</html>
<style>
    body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(120deg, #000000ff 0%, #22d3ee 100%);
    color: #e2e8f0;
}
.flex { display: flex; }
.container { max-width: 1400px; margin: 0 auto; padding: 0 2rem; }

.main-content { flex: 1; min-width: 0; background: transparent; padding: 0; }
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