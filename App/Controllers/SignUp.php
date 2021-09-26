<?php

namespace App\Controllers;

use \App\Models\User;
use \Core\View;

/**
 * SignUp controller
 *
 * PHP version 7.0
 */
class SignUp extends \Core\Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('SignUp/new.html');
    }

    public function createAction()
    {
        $user = new User($_POST);

        if ($user->signUp()) {
            $this->redirect('/SignUp/success');
        } else {
            View::renderTemplate('SignUp/new.html', [
                'user' => $user
            ]);
        }
    }

    public function successAction()
    {
        View::renderTemplate('SignUp/success.html');
    }
}
