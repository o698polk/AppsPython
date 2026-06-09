<?php
class SessionHelper {
    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            // Endurecimiento de sesión para OWASP
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
            ini_set('session.cookie_samesite', 'Lax');
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        session_unset();
        session_destroy();
    }

    public static function regenerate() {
        session_regenerate_id(true);
    }
}
