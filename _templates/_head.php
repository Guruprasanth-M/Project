<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern Dashboard Header</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    .dropdown {
      display: none;
      position: absolute;
      right: 0;
      top: 110%;
      min-width: 13rem;
      background: #161b22;
      border-radius: 0.5rem;
      box-shadow: 0 6px 32px rgba(0,0,0,0.25);
      z-index: 50;
      padding: 1rem 0;
      border: 1px solid #222;
    }
    .group:hover .dropdown,
    .group:focus-within .dropdown {
      display: block;
    }
    .header-btn {
      border: 1px solid #475569;
      background: #0d1117;
      color: #f4f4f5;
      border-radius: 0.375rem;
      padding: 0.5rem 0.6rem;
      margin-left: 0.3rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s, color 0.2s, border-color 0.2s;
      font-size: 1rem;
    }
    .header-btn:hover {
      background: #1e293b;
      color: #3b82f6;
      border-color: #3b82f6;
    }
    .search-bar {
      border: 1px solid #475569;
      background: #0d1117;
      color: #f4f4f5;
      border-radius: 0.375rem;
      padding: 0.5rem 1rem;
      width: 340px;
      font-size: 1rem;
      outline: none;
      transition: border-color 0.2s;
    }
    .search-bar:focus {
      border-color: #3b82f6;
    }
    @media (max-width: 900px) {
      .search-bar { width: 180px;}
      .header-btn { padding: 0.5rem 0.4rem;}
    }
  </style>
</head>
<body class="bg-[#0d1117]">
<header class="w-full bg-[#0d1117] text-white border-b border-[#161b22] flex items-center justify-between px-2 py-2">
  <!-- Left: Burger + Logo + Dashboard + Quick Links -->
  <div class="flex items-center">
    <button class="header-btn mr-2" aria-label="Open menu">
      <i class="fas fa-bars"></i>
    </button>
    <img src="https://labs.selfmade.ninja/assets/brand/logo-text-opt.svg" alt="Logo" class="h-8 w-8 mr-2 rounded-full bg-black">
    <span class="font-bold text-base md:text-lg text-white mr-3">Dashboard</span>
    <button class="header-btn" title="Quick Links">
      <i class="fas fa-link"></i>
      <span class="ml-2 hidden md:inline">Quick Links</span>
    </button>
  </div>
  <!-- Center: Search Bar -->
  <div class="flex flex-1 justify-center">
    <div class="flex items-center w-full max-w-md">
      <i class="fas fa-search text-gray-400 mr-2"></i>
      <input type="text" class="search-bar" placeholder="Type / to search">
      <span class="text-xs text-gray-400 ml-2">to search</span>
    </div>
  </div>
  <!-- Right: Notifications, Tasks, Settings, Login (with dropdown) -->
  <div class="flex items-center space-x-2">
    <button class="header-btn" title="Notifications"><i class="fas fa-bell"></i></button>
    <button class="header-btn" title="Tasks"><i class="fas fa-list-check"></i></button>
    <button class="header-btn" title="Settings"><i class="fas fa-cog"></i></button>
    <!-- Login Button with dropdown -->
    <div class="relative group">
      <button class="header-btn font-semibold" id="loginBtn">
        <i class="fas fa-sign-in-alt mr-2"></i>Login
      </button>
      <div class="dropdown">
        <a href="#" class="block px-4 py-2 hover:bg-[#222] text-sm text-gray-200"><i class="fab fa-github mr-2"></i>Sign in with GitHub</a>
        <a href="#" class="block px-4 py-2 hover:bg-[#222] text-sm text-gray-200"><i class="fab fa-google mr-2"></i>Sign in with Google</a>
        <a href="#" class="block px-4 py-2 hover:bg-[#222] text-sm text-gray-200"><i class="fas fa-envelope mr-2"></i>Email Login</a>
        <div class="border-t border-gray-700 my-2"></div>
        <a href="#" class="block px-4 py-2 hover:bg-[#222] text-sm text-blue-400">Need help?</a>
      </div>
    </div>
  </div>
</header>
</body>
</html>