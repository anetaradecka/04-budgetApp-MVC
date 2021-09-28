<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;

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
            Auth::signIn($user);
            $this->redirect(Auth::getReturnToPage());
        } else {
            View::renderTemplate('SignIn/new.html', [
                'username' => $_POST['username']
            ]);
        }
    }

    public function destroyAction()
    {
        Auth::signOut();
        $this->redirect('/');
    }
}