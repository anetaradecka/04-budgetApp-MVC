<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{
    public static function getAll()
    {
        $db = static::getDB();
        $statement = $db->query('SELECT id, name FROM users');

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function exists($login) {
        $db = static::getDB();
        $sql = 'SELECT id FROM users WHERE username = :username';
        $statement = $db->prepare($sql);
        $statement->execute([':username' => $login]);

        return $statement->rowCount() > 0;
    }

    public static function signUp($login, $password)
    {
        $db = static::getDB();
        $sql = 'INSERT INTO users VALUES (NULL, :username, :password)';
        $statement = $db->prepare($sql);
        $statement->execute([':username' => $login, ':password' => password_hash($password, PASSWORD_DEFAULT)]);

        return $statement->rowCount() === 1;
    }

    public static function signIn($login, $password)
    {
        $db = static::getDB();
        $sql = 'SELECT * FROM users WHERE username = :username';
        $statement = $db->prepare($sql);
        $statement->execute([':username' => $login]);
        
        if ($statement->rowCount() > 0 )
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return password_verify($password, $result['password']);
        }
        else
        {
            return false;
        }
    }
}
