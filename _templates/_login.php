<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Make sure to include or require your User class
// require_once 'User.php';

$login_success = false;
$login_error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $user_id = User::login($username, $password);

    if ($user_id) {
        try {
            $user = new User($user_id);
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->getUsername();
            $login_success = true;
            // Redirect immediately to index.php
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            $login_error = "Session error: " . $e->getMessage();
        }
    } else {
        $login_error = "Invalid username or password.";
    }
}
include '_head.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SkillSphere – Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background: linear-gradient(120deg, #010102ff 0%, #22d3ee 100%);
        }
        .glass {
            background: rgba(34,34,36,0.7);
            border-radius: 1rem;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,.37);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,.18);
        }
        .login-logo {
            filter: drop-shadow(0 0 12px #6366f1);
        }
        .input-style {
            background: rgba(30,41,59,0.7);
            color: #fff;
            border: none;
            outline: none;
        }
        .input-style:focus {
            background: rgba(59,130,246,0.2);
            border: 2px solid #6366f1;
        }
        .btn-main {
            background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%);
            color: #fff;
            font-weight: bold;
            box-shadow: 0 0 12px #6366f1, 0 0 32px #22d3ee44;
            transition: box-shadow .2s, transform .2s;
        }
        .btn-main:hover {
            box-shadow: 0 0 24px #6366f1, 0 0 54px #22d3ee99;
            transform: scale(1.04);
            background: linear-gradient(90deg, #22d3ee 0%, #6366f1 100%);
        }
        .link-main {
            color: #22d3ee;
            font-weight: bold;
            transition: color .2s;
        }
        .link-main:hover {
            color: #6366f1;
            text-decoration: underline;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center">

<main class="flex-grow flex items-center justify-center w-full">
    <div class="glass animate__animated animate__fadeInDown w-full max-w-md mx-auto py-8 px-6">
        <div class="flex flex-col items-center mb-6">
            <!-- <img src="https://selfmade.ninja/assets/brand/logo-text.svg" alt="SkillSphere" height="60" class="login-logo mb-2"> -->
            <h1 class="text-3xl font-bold text-white mb-2 font-sans">SkillSphere Login</h1>
            <span class="text-blue-300 font-semibold tracking-wide mb-2">Alumni & Student Portal</span>
        </div>
        <?php if ($login_error): ?>
            <div class="mb-4 p-3 rounded bg-red-500 bg-opacity-70 text-white text-center font-semibold animate__animated animate__fadeIn">
                <?= htmlspecialchars($login_error) ?>
            </div>
        <?php endif; ?>
        <form method="post" action="login.php" class="flex flex-col gap-4">
            <div>
                <label for="floatingUsername" class="block text-gray-300 mb-1">Username</label>
                <input name="username" type="text" id="floatingUsername" class="input-style w-full px-4 py-2 rounded-lg" placeholder="Username" required>
            </div>
            <div>
                <label for="floatingPassword" class="block text-gray-300 mb-1">Password</label>
                <input name="password" type="password" id="floatingPassword" class="input-style w-full px-4 py-2 rounded-lg" placeholder="Password" required>
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center text-gray-400">
                    <input type="checkbox" value="remember-me" class="mr-2">
                    Remember me
                </label>
                <a href="#" class="text-blue-300 hover:underline text-sm">Forgot password?</a>
            </div>
            <button class="btn-main px-4 py-2 rounded-lg" type="submit">Sign in</button>
        </form>
        <div class="mt-4 text-center">
            <span class="text-gray-300">Don't have an account?</span>
            <a href="signup.php" class="link-main ml-2">Sign Up</a>
        </div>
    </div>
</main>
</body>
</html>