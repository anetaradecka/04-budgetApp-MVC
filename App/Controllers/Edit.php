<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Budget;

class Edit extends Authenticated
{
    public function indexAction()
    {
        Budget::edit();

        View::renderTemplate('Edit/edit.html', [
            'revenue_categories' => Budget::getRevenueCategories(),
            'expense_categories' => Budget::getExpenseCategories(),
            'payment_methods' => Budget::getPaymentMethods()
        ]);
    }

    public function expenseAction()
    {
        header('Content-Type: application/json; charset=utf-8');
        exit;
    }
}
