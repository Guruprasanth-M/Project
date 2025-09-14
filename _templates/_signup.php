<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SkillSphere – Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Google Identity Services -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        body { background: linear-gradient(120deg, #0e0e18ff 0%, #22d3ee 100%); }
        .glass { background: rgba(34,34,36,0.7); border-radius: 1rem; box-shadow: 0 8px 32px 0 rgba(31,38,135,.37); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,.18); }
        .login-logo { filter: drop-shadow(0 0 12px #6366f1); }
        .input-style { background: rgba(30,41,59,0.7); color: #fff; border: none; outline: none; }
        .input-style:focus { background: rgba(59,130,246,0.2); border: 2px solid #6366f1; }
        .btn-main { background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%); color: #fff; font-weight: bold; box-shadow: 0 0 12px #6366f1, 0 0 32px #22d3ee44; transition: box-shadow .2s, transform .2s;}
        .btn-main:hover { box-shadow: 0 0 24px #6366f1, 0 0 54px #22d3ee99; transform: scale(1.04); background: linear-gradient(90deg, #22d3ee 0%, #6366f1 100%);}
        .link-main { color: #22d3ee; font-weight: bold; transition: color .2s; }
        .link-main:hover { color: #6366f1; text-decoration: underline; }
        .g_id_signin { margin-top: 1rem; }
        .hidden { display: none; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center">

<main class="flex-grow flex items-center justify-center w-full">
    <div class="glass animate__animated animate__fadeInDown w-full max-w-md mx-auto py-8 px-6">
        <div class="flex flex-col items-center mb-6">
            <img src="h.selfmade.ninja/assets/brand/logo-text-opt.svg" alt="SkillSphere" height="60" class="login-logo mb-2">
            <h1 class="text-3xl font-bold text-white mb-2 font-sans">SkillSphere Signup</h1>
            <span class="text-blue-300 font-semibold tracking-wide mb-2">Alumni & Student Portal</span>
        </div>
        <!-- Signup form -->
        <form method="post" action="signup.php" class="flex flex-col gap-4">
            <div>
                <label for="floatingInputUsername" class="block text-gray-300 mb-1">Username</label>
                <input name="username" type="text" id="floatingInputUsername" class="input-style w-full px-4 py-2 rounded-lg" placeholder="Username" required>
            </div>
            <div>
                <label for="floatingPassword" class="block text-gray-300 mb-1">Password</label>
                <input name="password" type="password" id="floatingPassword" class="input-style w-full px-4 py-2 rounded-lg" placeholder="Password" required>
            </div>
            <div>
                <label for="floatingInput" class="block text-gray-300 mb-1">Email address</label>
                <input name="email_address" type="email" id="floatingInput" class="input-style w-full px-4 py-2 rounded-lg" placeholder="name@example.com" required>
            </div>
            <div>
                <label for="floatingInputphone" class="block text-gray-300 mb-1">Phone number</label>
                <input name="phonenumber" type="text" id="floatingInputphone" class="input-style w-full px-4 py-2 rounded-lg" placeholder="Phone Number" required>
            </div>
            <button class="btn-main px-4 py-2 rounded-lg" type="submit">Sign Up</button>
        </form>
        <div class="mt-4 text-center">
            <span class="text-gray-300">Already have an account?</span>
            <a href="login.php" class="link-main ml-2">Login</a>
        </div>
        <!-- Google Sign-Up Button -->
        <div id="g_id_onload"
             data-client_id="YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com"
             data-context="signup"
             data-ux_mode="popup"
             data-login_uri="signup.php"
             data-auto_prompt="false"
             data-callback="handleCredentialResponse">
        </div>
        <div class="g_id_signin"
             data-type="standard"
             data-shape="pill"
             data-theme="filled_blue"
             data-text="continue_with"
             data-size="large"
             data-logo_alignment="left">
        </div>
        <script>
        function handleCredentialResponse(response) {
            // Send response.credential (JWT) to backend for verification
            alert('Google sign-up JWT:\n' + response.credential);
        }
        </script>
    </div>
</main>
<!-- Footer inclusion -->
</body>
</html>