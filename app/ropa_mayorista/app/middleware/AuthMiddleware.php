<?php
require_once dirname(__DIR__) . '/helpers/SessionHelper.php';

class AuthMiddleware {
    /**
     * Verifica que el usuario esté logueado y opcionalmente tenga un rol específico.
     * Si no cumple, redirige y corta la ejecución.
     */
    public static function check($requiredRoles = []) {
        SessionHelper::init();

        if (!SessionHelper::has('user_id')) {
            // Redirigir al login si no está logueado
            $scriptName = dirname($_SERVER['SCRIPT_NAME']);
            $baseUrl = ($scriptName === '/' || $scriptName === '\\') ? '' : $scriptName;
            header("Location: " . $baseUrl . "/login");
            exit();
        }

        if (!empty($requiredRoles)) {
            $userRole = SessionHelper::get('user_role');
            if (!in_array($userRole, $requiredRoles)) {
                // Si no tiene permisos, lo enviamos al home o a una página de error 403
                $scriptName = dirname($_SERVER['SCRIPT_NAME']);
                $baseUrl = ($scriptName === '/' || $scriptName === '\\') ? '' : $scriptName;
                header("Location: " . $baseUrl . "/");
                exit();
            }
        }
    }
}
