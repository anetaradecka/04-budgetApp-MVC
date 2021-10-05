<?php

namespace App\Controllers;

use \Core\View;

class Expenses extends Authenticated
{
    public function indexAction()
    {
        View::renderTemplate('Expenses/index.html');
    }

    public function addAction()
    {
        View::renderTemplate('Expenses/add.html');
    }
}
