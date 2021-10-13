<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Budget;

class Revenues extends Authenticated
{
    public function addAction()
    {
        View::renderTemplate('Revenues/add.html', [
            'revenue_categories' => Budget::getRevenueCategories()
        ]);
    }

    public function addedAction()
    {
        Budget::addRevenue();
        View::renderTemplate('Revenues/added.html');
    }
}
