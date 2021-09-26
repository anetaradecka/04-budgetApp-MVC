<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class SignIn extends \Core\Controller
{    
    public function newAction()
    {
        View::renderTemplate('SignIn/new.html');
    }
}