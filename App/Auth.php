<?php

namespace App;

use \App\Models\User;

class Auth
{
    public static function signIn($user)
    {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user->id;
    }

    public static function signOut()
    {
        // Unset all of the session variables
        $_SESSION = [];

        // Delete the session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        // Finally destroy the session
        session_destroy();
    }

    public static function rememberRequestedPage()
    {
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }

    public static function getReturnToPage()
    {
        return $_SESSION['return_to'] ?? '/';
    }

    public static function getUser()
    {
        if (isset($_SESSION['user_id'])) {
            User::findById($_SESSION['user_id']);
        }
    }
}
