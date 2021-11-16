<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Budget;

class Expenses extends Authenticated
{
    public function validateAction()
    {
        $expense_id = htmlspecialchars($_GET['id']);
        $expense_amount = htmlspecialchars($_GET['amount']);
        $limit_exceeded = Budget::validate($expense_id, $expense_amount);

        header('Content-Type: application/json; charset=utf-8');
        header('X-Limit-Exceeded: ' . json_encode($limit_exceeded));
        exit;
    }

    public function addAction()
    {
        View::renderTemplate('Expenses/add.html', [
            'expense_categories' => Budget::getExpenseCategories(),
            'payment_methods' => Budget::getPaymentMethods()
        ]);
    }

    public function submitAction()
    {
        Budget::addExpense();
        header('Content-Type: application/json; charset=utf-8');
        exit;
    }
}
