<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Budget;

class Expenses extends Authenticated
{
    public function addAction()
    {
        View::renderTemplate('Expenses/add.html', [
            'expense_categories' => Budget::getExpenseCategories(),
            'payment_methods' => Budget::getPaymentMethods()
        ]);
    }

    public function addedAction()
    {
        Budget::addExpense();
        View::renderTemplate('Expenses/added.html');
    }
}
