<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Budget;

class Edit extends Authenticated
{
    public function indexAction()
    {
        Budget::removeSelected();

        View::renderTemplate('Edit/edit.html', [
            'revenue_categories' => Budget::getRevenueCategories(),
            'expense_categories' => Budget::getExpenseCategories(),
            'payment_methods' => Budget::getPaymentMethods()
        ]);
    }

    public function saveAction()
    {
        // View::renderTemplate('Edit/edit.html', [
        //     'success' => Budget::saveChanges()
        // ]);
    }
}
