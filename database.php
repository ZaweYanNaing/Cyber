<?php
// database.php — DB Connection & Helpers

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'cyber_law_db';

// Connect
$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die('<p style="color:red">DB Error: ' . $conn->connect_error . '</p>');
}

// ── Helpers ──────────────────────────────────────────────────

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
        redirect('/Cyber_Test/admin/login.php');
    }
}
