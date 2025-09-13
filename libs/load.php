<?php
// -------------------------------------------------
// Project bootstrap (works in both Web + CLI)
// -------------------------------------------------

// --- Database class include (always load first) ---
$databaseClass = __DIR__ . '/../includes/database_class.php';

// Debug (uncomment if needed)
// echo "Database class path: $databaseClass\n";

if (is_file($databaseClass)) {
    include_once $databaseClass;
} else {
    // Debug (uncomment if needed)
    // echo "Database class missing: $databaseClass\n";
}

// Detect project root
if (php_sapi_name() === 'cli') {
    // CLI: go 3 levels up from /libs/
    $docRoot = realpath(__DIR__ . '/../../..');
} else {
    // Web: use server document root
    $docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
}

// Debug (uncomment if needed)
// echo "DOCUMENT ROOT: $docRoot\n";

// --- Config loader ---
$configPath = $docRoot . '/../photogramconfig.json';

// Debug (uncomment if needed)
// echo "Config path: $configPath\n";

if (is_file($configPath) && is_readable($configPath)) {
    $GLOBALS['__site__config'] = file_get_contents($configPath);

    // Debug (uncomment if needed)
    // echo "Config loaded successfully\n";
} else {
    $GLOBALS['__site__config'] = "{}"; // fallback to empty config

    // Debug (uncomment if needed)
    // echo "Config file missing!\n";
}

function get_config(string $key, $default = null) {
    global $__site__config;
    $array = json_decode($__site__config, true);
    return $array[$key] ?? $default;
}

// Debug dump (uncomment if needed)
$array = json_decode($__site__config, true);
// echo "<pre>";
// print_r($array);
// echo "</pre>";

// --- Template loader ---
function load_template($name){
 include $_SERVER['DOCUMENT_ROOT']."/project/_templates/$name.php";
}

