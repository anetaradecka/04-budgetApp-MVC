<?php

namespace App\Controllers;

use \App\Models\User;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Account extends \Core\Controller
{
    public function validateUsernameAction()
    {
        $is_valid = !User::usernameExists($_GET['username']);
        header('Content-Type: application/json');
        echo json_encode($is_valid);
        // true when the username is available; false otherwise
    }
    
}
