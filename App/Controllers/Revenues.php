<?php

namespace App\Controllers;

use \Core\View;

class Revenues extends Authenticated
{
    public function indexAction()
    {
        View::renderTemplate('Revenues/index.html');
    }

    public function addAction()
    {
        View::renderTemplate('Revenues/add.html');
    }
}
