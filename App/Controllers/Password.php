<?php

namespace App\Controllers;

use \Core\View;

class Password extends \Core\Controller
{
    public function resetAction()
    {
        View::renderTemplate('Password/reset.html');
    }

    public function newAction()
    {
        View::renderTemplate('Password/new.html');
    }
}