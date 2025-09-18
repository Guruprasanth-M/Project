<?php

include 'libs/load.php';
session_start();

// Check if the token exists in session
if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
    try {
        $session = new UserSession($_SESSION['token']);
        $session->removeSession();
    } catch (Exception $e) {
        // Optionally log or ignore, since session might be already invalid
    }
}

// Always destroy PHP session
session_unset();
session_destroy();

// Redirect to home page after logout
header("Location: index.php");
exit;
?>