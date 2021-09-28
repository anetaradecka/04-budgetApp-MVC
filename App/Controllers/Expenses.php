<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

class Expenses extends \Core\Controller
{
    public function indexAction()
    {
        $this->requireLogin();
        View::renderTemplate('Expenses/index.html');
    }
}
