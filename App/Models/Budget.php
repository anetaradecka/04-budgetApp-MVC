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
    public static function getExpenseCategories() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM expense_category_default'; // WHERE id = :id
            $statement = $db->prepare($sql);
            // $statement->bindParam(':id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(); // RETURN TYPE?
        }
    
        return false;
    }

    public static function getRevenueCategories() {
        $user = Auth::getUser();

        if ($user) {
            $db = static::getDB();
            $sql = 'SELECT * FROM income_category_default'; // WHERE id = :id
            $statement = $db->prepare($sql);
            // $statement->bindParam(':id', $user->id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(); // RETURN TYPE?
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
            return $statement->fetch(); // RETURN TYPE?
        }
    
        return false;
    }
}
