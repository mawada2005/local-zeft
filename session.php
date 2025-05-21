

<?php
require_once 'C:\wamp64\www\(Local-shop)\connect.php';
function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
        // Set secure session params
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_strict_mode', 1);
        
        session_start();
        
        // Generate a new session ID periodically (every 30 minutes)
        if (!isset($_SESSION['last_regeneration'])) {
            regenerateSession();
        } else {
            $interval = 30 * 60; // 30 minutes
            if (time() - $_SESSION['last_regeneration'] >= $interval) {
                regenerateSession();
            }
        }
    }
}

// Regenerate session ID
function regenerateSession() {
    // Regenerate ID
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

// Check if user is logged in
function isLoggedIn() {
    startSession();
    return isset($_SESSION['user_id']);
}

// Get current user ID
function getCurrentUserId() {
    startSession();
    return $_SESSION['user_id'] ?? null;
}

// Set user session
function loginUser($userId, $username) {
    startSession();
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['last_activity'] = time();
}

// Logout user
function logoutUser() {
    startSession();
    $_SESSION = array();
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
}
?>