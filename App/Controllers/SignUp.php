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
    private $userCreated = null;
    private $userExists = null;

    public function __construct() {
        // $_SESSION['registration_success'] = true;
        $nick = $this->getNick();
        $password1 = $this->getPassword1();

        $this->userExists = User::exists($nick);

        if (!$this->userExists && $nick !== null && $password1 !== null) {
            $this->userCreated = User::signUp($nick, $password1);
        }
    }

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
            View::renderTemplate('SignUp/success.html');
        } else {
            View::renderTemplate('SignUp/new.html', [
                'user' => $user
            ]);
        }
    }

    protected function validateNick($nick)
    {
        if (isset($nick)) {
            $nickIsShorterThan3 = strlen($nick) < 3;
            $nickIsLongerThan20 = strlen($nick) > 20;
            $nickContainsSpecialChars = !ctype_alnum($nick);

            return $nickIsShorterThan3 || $nickIsLongerThan20 || $nickContainsSpecialChars;
        }
    }

    protected function validatePassword($password1, $password2)
    {
        if (isset($password1) && isset($password2)) {
            $passwordShorterThan5 = strlen($password1) < 5;
            $passwordLongerThan20 = strlen($password1) > 20;
            $passwordNotEqual = $password1 != $password2;

            return $passwordShorterThan5 || $passwordLongerThan20 || $passwordNotEqual;
        }
    }

    private function getNick() {
        return isset($_POST['nick']) ? $_POST['nick'] : null;
    }

    private function getPassword1() {
        return isset($_POST['password1']) ? $_POST['password1'] : null;
    }

    private function getPassword2() {
        return isset($_POST['password2']) ? $_POST['password2'] : null;
    }
}
