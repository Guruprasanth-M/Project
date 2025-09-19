<aside class="sidebar closed" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header" >
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu">
            <i class="fas fa-bars"></i>
        </button>
        <span class="sidebar-title text-sm font-semibold">Menu</span>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <ul class="text-sm">
            <li>
                <a href="#dashboard" onclick="showSection('dashboard')" title="Dashboard">
                    <i class="fas fa-tachometer-alt"></i><span> Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/project/profile.php" onclick="showSection('profile')" title="Profile">
                     <!-- <a href="/project/_templates/_profile/_profile.php" onclick="showSection('profile')" title="Profile"></a> -->
                    <i class="fas fa-user"></i><span> Profile</span>
                </a>
            </li>
            <li>
                <a href="lead.php"  title="Leaderboard">
                    <i class="fas fa-trophy"></i><span> Leaderboard</span>
                </a>
            </li>
            <li>
                <a href="directory.php" title="Directory">
                    <i class="fas fa-users"></i><span> Directory</span>
                </a>
            </li>
            <li>
                <a href="job.php" onclick="showSection('jobs')" title="Jobs & Recruiters">
                    <i class="fas fa-briefcase"></i><span> Jobs & Recruiters</span>
                </a>
            </li>
            <li>
                <a href="event.php" onclick="showSection('events')" title="Events & Announcements">
                    <i class="fas fa-calendar-alt"></i><span> Events</span>
                </a>
            </li>
            <li>
                <a href="practice.php" onclick="showSection('challenges')" title="Practice/Challenges">
                    <i class="fas fa-code"></i><span> Challenges</span>
                </a>
            </li>
            <li>
                <a href="QA.php" onclick="showSection('qa')" title="Q&A Forum">
                    <i class="fas fa-question-circle"></i><span> Q&A</span>
                </a>
            </li>
            <li>
                <a href="message.php" onclick="showSection('messages')" title="Messages">
                    <i class="fas fa-envelope"></i><span> Messages</span>
                </a>
            </li>
            <li>
                <a href="submit.php" onclick="showSection('projects')" title="Projects">
                    <i class="fas fa-project-diagram"></i><span> Projects</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
