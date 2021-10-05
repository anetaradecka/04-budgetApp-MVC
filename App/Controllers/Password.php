<?php

namespace App\Controllers;

use \Core\View;

class Password extends \Core\Controller
{
    public function forgotAction()
    {
        View::renderTemplate('Password/forgot.html');
    }

    public function resetAction()
    {
        View::renderTemplate('Password/reset.html');
    }
}