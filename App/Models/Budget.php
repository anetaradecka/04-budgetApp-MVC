<?php

namespace App\Models;

use PDO;
use DateTime;
use \App\Auth;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Budget extends \Core\Model
{
    public static function toDecimal($value) {
        return number_format((float)$value, 2, '.', '');
    }

    public static function getPeriod() {
        return isset($_POST['period']) ? $_POST['period'] : 'current_month';
    }

    public static function getStartDate() {
        $now = new DateTime();
        $start_date = (new DateTime())->setDate($now->format("Y"), $now->format("m"), 1);
        return isset($_POST['start_date']) ? $_POST['start_date'] : $start_date->format("Y-m-d");
    }

    public static function getEndDate() {
        $now = new DateTime();
        $end_date = (new DateTime())->setDate($now->format("Y"), $now->format("m"), $now->format("d"));
        return isset($_POST['end_date']) ? $_POST['end_date'] : $end_date->format("Y-m-d");
    }

    public static function getRevenues() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT revenue_category_assigned_to_user, amount, revenue_date AS date, comment, name
                    FROM revenues LEFT JOIN revenue_category_default ON revenues.revenue_category_assigned_to_user = revenue_category_default.id
                    WHERE user_id = :user_id AND revenue_date BETWEEN :start_date AND :end_date';
            $start_date = static::getStartDate();
            $end_date = static::getEndDate();
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $statement->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getTotalRevenues() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT SUM(amount) as total FROM revenues WHERE user_id = :user_id AND revenue_date BETWEEN :start_date AND :end_date';
            $start_date = static::getStartDate();
            $end_date = static::getEndDate();
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $statement->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC)['total'];
        }
    
        return 0;
    }

    public static function getExpenses() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT expense_category_assigned_to_user, amount, expense_date AS date, comment, name
                    FROM expenses LEFT JOIN expense_category_default ON expenses.expense_category_assigned_to_user = expense_category_default.id
                    WHERE user_id = :user_id AND expense_date BETWEEN :start_date AND :end_date';
            $start_date = static::getStartDate();
            $end_date = static::getEndDate();
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $statement->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getTotalExpenses() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT SUM(amount) as total FROM expenses WHERE user_id = :user_id AND expense_date BETWEEN :start_date AND :end_date';
            $start_date = static::getStartDate();
            $end_date = static::getEndDate();
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $statement->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC)['total'];
        }
    
        return 0;
    }

    public static function getExpenseCategories() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM expense_category_assigned_to_user WHERE user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getPaymentMethods() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM payment_method_assigned_to_user WHERE user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getRevenueCategories() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM revenue_category_assigned_to_user WHERE user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function addExpense() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'INSERT INTO expenses (id, user_id, expense_category_assigned_to_user, payment_method_assigned_to_user, amount, expense_date, comment)
                    VALUES (NULL, :user_id, :category, :method, :amount, :date, :comment)';
            $amount = static::toDecimal($_POST['amount']);
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':category', $_POST['category'], PDO::PARAM_INT);
            $statement->bindParam(':method', $_POST['method'], PDO::PARAM_INT);
            $statement->bindParam(':amount', $amount, PDO::PARAM_STR);
            $statement->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
            $statement->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function addRevenue() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'INSERT INTO revenues (id, user_id, revenue_category_assigned_to_user, amount, revenue_date, comment)
                    VALUES (NULL, :user_id, :category, :amount, :date, :comment)';
            $amount = static::toDecimal($_POST['amount']);
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':category', $_POST['category'], PDO::PARAM_INT);
            $statement->bindParam(':amount', $amount, PDO::PARAM_STR);
            $statement->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
            $statement->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function calculate($value1, $value2) {
        return static::toDecimal($value1 - $value2);
    }

    public static function deleteRevenueCategory() {
        $revenue_category = isset($_POST['revenue_category_ids']) ? $_POST['revenue_category_ids'] : false;

        if ($revenue_category) {
            $user = Auth::getUser();
            $db = static::getDB();
            $sql = 'delete from revenue_category_assigned_to_user WHERE id = :revenue_category_ids AND user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':revenue_category_ids', $revenue_category, PDO::PARAM_INT);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public static function deleteExpenseCategory() {
        $expense_category = isset($_POST['expense_category_ids']) ? $_POST['expense_category_ids'] : false;

        if ($expense_category) {
            $user = Auth::getUser();
            $db = static::getDB();
            $sql = 'delete from expense_category_assigned_to_user WHERE expense_category_id = :expense_category_ids AND user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':expense_category_ids', $expense_category, PDO::PARAM_INT);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public static function deletePaymentMethod() {
        $payment_method = isset($_POST['payment_method_ids']) ? $_POST['payment_method_ids'] : false;

        if ($payment_method) {
            $user = Auth::getUser();
            $db = static::getDB();
            $sql = 'delete from payment_method_assigned_to_user WHERE id = :payment_method_ids AND user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':payment_method_ids', $payment_method, PDO::PARAM_INT);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public static function addRevenueCategory() {
        $new_revenue_category = isset($_POST['new_revenue_category']) ? $_POST['new_revenue_category'] : false;

        if ($new_revenue_category) {
            $user = Auth::getUser();
            $db = static::getDB();
            $sql = 'insert into revenue_category_assigned_to_user (user_id, name) VALUES (:user_id, :name)';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':name', $new_revenue_category, PDO::PARAM_STR);
            $statement->execute();
        }
    }

    public static function addExpenseCategory() {
        $new_expense_category = isset($_POST['new_expense_category']) ? $_POST['new_expense_category'] : false;
        $has_limit = isset($_POST['has_limit']) ? $_POST['has_limit'] : false;
        $expense_limit = isset($_POST['expense_limit']) ? $_POST['expense_limit'] : false;

        if ($new_expense_category) {
            $user = Auth::getUser();
            $db = static::getDB();
            $sql = 'insert into expense_category_assigned_to_user (user_id, name, has_limit, expense_limit) VALUES (:user_id, :name, :has_limit, :expense_limit)';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':name', $new_expense_category, PDO::PARAM_STR);
            $statement->bindParam(':has_limit', $has_limit, PDO::PARAM_BOOL);
            $statement->bindParam(':expense_limit', $expense_limit, PDO::PARAM_STR);
            $statement->execute();
        }
    }

    public static function addPaymentMethod() {
        $new_payment_method = isset($_POST['new_payment_method']) ? $_POST['new_payment_method'] : false;

        if ($new_payment_method) {
            $user = Auth::getUser();
            $db = static::getDB();
            $sql = 'insert into payment_method_assigned_to_user (user_id, name) VALUES (:user_id, :name)';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':name', $new_payment_method, PDO::PARAM_STR);
            $statement->execute();
        }
    }
    
    public static function edit() {
        static::deleteRevenueCategory();
        static::deleteExpenseCategory();
        static::deletePaymentMethod();

        static::addRevenueCategory();
        static::addExpenseCategory();
        static::addPaymentMethod();

        return false;
    }

    public static function getCurrentMonthExpenses($expense_id) {
        $user = Auth::getUser();
        $user_id = $user->id;
        $start_date = date('Y-m-01');
        
        // Ile uzytkownik wydal w biezacym miesiacu na dana kategorie?
        $db = static::getDB();
        $sql = "select sum(amount) as amount from expenses where expense_date >= '" . $start_date . "' and expense_category_assigned_to_user = " . $expense_id . " and user_id = " . $user_id;
        $response = $db->query($sql)->fetch();

        return static::toDecimal($response['amount']);
    }

    public static function getExpenseMetadata($expense_id) {
        $user = Auth::getUser();

        // Czy uzytkownik ustawil limit (jaki?) na wybranej kategorii?
        $db = static::getDB();
        $sql = 'select has_limit, expense_limit from expense_category_assigned_to_user where expense_category_id = :expense_id and user_id = :user_id';
        $statement = $db->prepare($sql);
        $statement->bindParam(':expense_id', $expense_id, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function validate($expense_id, $expense_amount) {
        $currentMonthExpenses = static::getCurrentMonthExpenses($expense_id, $expense_amount);
        $expenseMetadata = static::getExpenseMetadata($expense_id, $expense_amount);
        $expense_limit = static::toDecimal($expenseMetadata['expense_limit']);
        $new_expense = static::toDecimal($expense_amount);

        // Czy po dodaniu $expense_amount przekroczymy limit dla tej kategorii?
        if ($expenseMetadata['has_limit']) {
            return json_encode($currentMonthExpenses + $new_expense > $expense_limit);
        }

        return false;
    }
}
