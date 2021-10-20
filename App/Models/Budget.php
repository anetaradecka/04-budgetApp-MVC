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
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':start_date', $_POST['start_date'], PDO::PARAM_STR);
            $statement->bindParam(':end_date', $_POST['end_date'], PDO::PARAM_STR);
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
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':start_date', $_POST['start_date'], PDO::PARAM_STR);
            $statement->bindParam(':end_date', $_POST['end_date'], PDO::PARAM_STR);
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
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':start_date', $_POST['start_date'], PDO::PARAM_STR);
            $statement->bindParam(':end_date', $_POST['end_date'], PDO::PARAM_STR);
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
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':start_date', $_POST['start_date'], PDO::PARAM_STR);
            $statement->bindParam(':end_date', $_POST['end_date'], PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC)['total'];
        }
    
        return 0;
    }

    public static function getExpenseCategories() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM expense_category_default';
            $statement = $db->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getPaymentMethods() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM payment_method_default';
            $statement = $db->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getRevenueCategories() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM revenue_category_default';
            $statement = $db->prepare($sql);
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
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':category', $_POST['category'], PDO::PARAM_INT);
            $statement->bindParam(':method', $_POST['method'], PDO::PARAM_INT);
            $statement->bindParam(':amount', static::toDecimal($_POST['amount']), PDO::PARAM_STR);
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
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->bindParam(':category', $_POST['category'], PDO::PARAM_INT);
            $statement->bindParam(':amount', static::toDecimal($_POST['amount']), PDO::PARAM_STR);
            $statement->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
            $statement->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    
        return false;
    }
}
