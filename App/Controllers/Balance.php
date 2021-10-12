<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Budget;

class Balance extends Authenticated
{
    public function indexAction()
    {
        View::renderTemplate('Balance/index.html', [
            'start_date' => Budget::getStartDate(),
            'end_date' => Budget::getEndDate(),
            'revenues' => Budget::getRevenues(),
            'total_revenues' => Budget::getTotalRevenues(),
            'expenses' => Budget::getExpenses(),
            'total_expenses' => Budget::getTotalExpenses()
        ]);
    }
}
