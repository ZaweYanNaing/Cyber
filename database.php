<?php
// ============================================================
// config/database.php — Database Connection (mysqli)
// ============================================================

// --- Settings ---
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Change if needed
define('DB_PASS', '');           // Change if needed
define('DB_NAME', 'cyber_law_db');

define('SITE_NAME', 'Cyber Law Awareness System');
define('BASE_URL',  'http://localhost/cyber_law_aweness_system');
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('UPLOAD_URL', BASE_URL . '/uploads/');
define('MAX_FILE_SIZE', 50 * 1024 * 1024); // 50 MB

// --- Connect to MySQL ---
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset('utf8mb4');

// Check connection
if ($conn->connect_error) {
    die('<div style="font-family:sans-serif;color:red;padding:2rem;">
         <h2>Database Error</h2>
         <p>' . $conn->connect_error . '</p>
         <p>Please check your config/database.php settings.</p>
         </div>');
}

// ============================================================
// Helper Functions
// ============================================================

// Safely print text (prevent XSS)
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Get current language from URL: ?lang=en or ?lang=mm
function getLang() {
    return (isset($_GET['lang']) && $_GET['lang'] === 'mm') ? 'mm' : 'en';
}

// Redirect to another page
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

// Check if admin is logged in (used in admin pages)
function requireAdmin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['admin_id'])) {
        redirect(BASE_URL . '/admin/login.php');
    }
}
