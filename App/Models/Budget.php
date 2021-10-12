<?php

namespace App\Models;

use PDO;
use \App\Auth;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Budget extends \Core\Model
{
    public static function getRevenues() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM revenues WHERE user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll();
        }
    
        return false;
    }

    public static function getTotalRevenues() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT SUM(amount) as total FROM revenues WHERE user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC)['total'];
        }
    
        return 0;
    }

    public static function getExpenses() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM expenses WHERE user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getTotalExpenses() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT SUM(amount) as total FROM expenses WHERE user_id = :user_id';
            $statement = $db->prepare($sql);
            $statement->bindParam(':user_id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC)['total'];
        }
    
        return 0;
    }

    public static function getExpenseCategories() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM expense_category_default'; // WHERE id = :id
            $statement = $db->prepare($sql);
            // $statement->bindParam(':id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getRevenueCategories() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM revenue_category_default'; // WHERE id = :id
            $statement = $db->prepare($sql);
            // $statement->bindParam(':id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public static function getPaymentMethods() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM payment_method_default'; // WHERE id = :id
            $statement = $db->prepare($sql);
            // $statement->bindParam(':id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    
        return false;
    }
}
