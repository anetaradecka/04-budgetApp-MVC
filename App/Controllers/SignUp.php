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
        
        $this->userExists = User::exists($this->getNick());

        if (!$this->userExists) {
            $this->userCreated = User::signUp($this->getNick(), $this->getPassword1());
        }
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('SignUp/index.html', [
            'user_created' => $this->userCreated,
            'user_exists' => $this->userExists,
            'nick_error' => $this->validateNick($this->getNick()),
            'password_error' => $this->validatePassword($this->getPassword1(), $this->getPassword2())
        ]);
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
