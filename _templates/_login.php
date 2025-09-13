<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$login_success = false;
$login_error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Unsafe: Accepting raw input without checks
    $username = $_POST['username'];
    $password = $_POST['password'];

    $token = UserSession::authenticate($username, $password);

    if ($token) {
        try {
            $session = new UserSession($token);
            $user = $session->getUser();

            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['session_token'] = $token;

            $login_success = true;
        } catch (Exception $e) {
            $login_error = "Session error: " . $e->getMessage();
        }
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unsafe Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: auto;
            margin-top: 100px;
        }
    </style>
</head>
<body>

<?php if ($login_success): ?>
    <main class="container">
        <div class="bg-light p-5 rounded mt-3">
            <h1>Login Successful</h1>
            <p class="lead">Welcome back, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>.</p>
            <a href="dashboard.php" class="btn btn-success">Go to Dashboard</a>
        </div>
    </main>
<?php elseif ($login_error): ?>
    <main class="container">
        <div class="bg-light p-5 rounded mt-3">
            <h1>Login Failed</h1>
            <a href="dashboard.php" class="btn btn-success">Go to Dashboard</a>
        </div>
    </main>
<?php endif; ?>

<?php if (!$login_success): ?>
    <main class="form-signin">
        <form method="post" action="login.php">
            <img class="mb-4" src="https://git.selfmade.ninja/uploads/-/system/appearance/logo/1/Logo_Dark.png" alt="" height="50">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating mb-2">
                <input name="username" type="text" class="form-control" id="floatingUsername" placeholder="Username">
                <label for="floatingUsername">Username</label>
            </div>

            <div class="form-floating mb-2">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label><input type="checkbox" value="remember-me"> Remember me</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </form>
    </main>
<?php endif; ?>

</body>
</html>
