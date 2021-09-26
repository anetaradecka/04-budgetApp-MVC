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

    public function createAction()
    {
        $user = User::authenticate($_POST['username'], $_POST['password']);

        if ($user) {
            $this->redirect('/');
        } else {
            View::renderTemplate('SignIn/new.html', [
                'username' => $_POST['username']
            ]);
        }
    }
}