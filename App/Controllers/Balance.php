<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Budget;

class Balance extends Authenticated
{
    public function indexAction()
    {
        $total_revenues = Budget::getTotalRevenues();
        $total_expenses = Budget::getTotalExpenses();

        View::renderTemplate('Balance/index.html', [
            'period' => Budget::getPeriod(),
            'start_date' => Budget::getStartDate(),
            'end_date' => Budget::getEndDate(),
            'revenues' => Budget::getRevenues(),
            'total_revenues' => $total_revenues,
            'expenses' => Budget::getExpenses(),
            'total_expenses' => $total_expenses,
            'total' => Budget::calculate($total_revenues, $total_expenses)
        ]);
    }
}
