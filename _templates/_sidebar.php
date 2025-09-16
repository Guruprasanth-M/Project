<!-- Sidebar -->
<aside class="sidebar open" id="sidebar"> <!-- open by default -->
    <div class="sidebar-header">
        <!-- Sidebar Toggle Button inside header -->
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Open/Close menu">
            <i class="fas fa-bars"></i>
        </button>
        <h2>🎓 Alumni Portal</h2>
    </div>
    <nav>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="NetworkingHub.html"><i class="fas fa-users"></i> Networking Hub</a></li>
            <li><a href="JobPortal.html"><i class="fas fa-briefcase"></i> Job Portal</a></li>
            <li><a href="EventsReunions.html"><i class="fas fa-calendar-alt"></i> Events & Reunions</a></li>
            <li><a href="SuccessStories.html"><i class="fas fa-trophy"></i> Success Stories</a></li>
            <li><a href="feedback_form.html"><i class="fas fa-comments"></i> Feedback & Surveys</a></li>
        </ul>
    </nav>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<style>
/* Sidebar */
.sidebar {
    width: 17rem;
    background: rgba(13,17,23,0.93);
    color: #e2e8f0;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    box-shadow: 0 0 12px rgba(0,0,0,0.09);
    backdrop-filter: blur(6px);
    transform: translateX(0);
    transition: transform 0.4s ease; /* smooth open/close */
}
.sidebar.open { transform: translateX(0); }
.sidebar:not(.open) { transform: translateX(-100%); }

/* Sidebar Header */
.sidebar-header {
    position: relative;
    padding: 1rem;
    border-bottom: 1px solid #222;
    display: flex;
    align-items: center;
    gap: 0.5rem; /* space between button and title */
}
.sidebar-header h2 {
    font-size: 1.8rem;
    font-weight: bold;
    color: #38bdf8;
    margin: 0;
    letter-spacing: 1px;
}

/* Toggle Button */
.sidebar-toggle {
    background: #000;
    color: #fff;
    border: none;
    padding: 0.45rem 0.55rem;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.3s;
    flex-shrink: 0; /* prevent shrinking */
}
.sidebar-toggle:hover {
    background: #fff;
    color: #000;
    transform: scale(1.1);
}

/* Links */
.sidebar nav { margin-top: 2rem; }
.sidebar ul { list-style: none; padding: 0; }
.sidebar ul li { margin-bottom: 1rem; }
.sidebar ul li a {
    display: block;
    padding: 0.75rem 1rem;
    background: rgba(22,27,34,0.93);
    border-radius: 0.5rem;
    transition: background 0.3s, color 0.3s;
    color: #e2e8f0;
    font-weight: 500;
}
.sidebar ul li a:hover { background: #6366f1; color: #fff; }

/* Overlay */
.sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 50;
}
.sidebar.open ~ .sidebar-overlay { display: block; }
</style>

<script>
const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebarOverlay = document.getElementById('sidebarOverlay');

// Toggle sidebar open/close
sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('open');
});

// Close sidebar when overlay clicked
sidebarOverlay.addEventListener('click', () => {
    sidebar.classList.remove('open');
});

// Close sidebar on Escape key
document.addEventListener('keydown', e => {
    if(e.key === "Escape") sidebar.classList.remove('open');
});
</script>
