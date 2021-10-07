<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

class Password extends \Core\Controller
{
    public function resetAction()
    {
        if (isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['password2'])) {
            if (User::usernameExists($_POST['username'])) {
                User::resetPassword($_POST['username'], $_POST['password1']);
                $this->redirect('/SignIn');
            } else {
                View::renderTemplate('Password/reset.html', [
                    'user_exists' => false
                ]);
            }
        } else {
            View::renderTemplate('Password/reset.html', [
                'user_exists' => true
            ]);
        }
    }
}