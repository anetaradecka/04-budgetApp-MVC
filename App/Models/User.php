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
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function validate()
    {
        if ($this->username == '') $this->errors[] = 'Username is required.';
        if (static::usernameExists($this->username)) $this->errors[] = 'Username is already taken.';
        if ($this->password1 == '') $this->errors[] = 'Password is required.';
        if ($this->password1 !== $this->password2) $this->errors[] = 'Password must match confirmation.';
        if (strlen($this->password1) < 6) $this->errors[] = 'Password must be at least 6 characters long.';
        if (strlen($this->password1) > 12) $this->errors[] = 'Password must be at most 12 characters long.';
        if (preg_match('/.*[a-z]+.*/i', $this->password1) == 0) $this->errors[] = 'Password must contain at least one letter.';
        if (preg_match('/.*\d+.*/i', $this->password1) == 0) $this->errors[] = 'Password must contain at least one number.';
    }

    public static function usernameExists($username)
    {
        return static::findByUsername($username) !== false;
    }

    public static function findById($id) {
        $db = static::getDB();
        $sql = 'SELECT * FROM users WHERE id = :id';
        $statement = $db->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $statement->execute();

        return $statement->fetch();
    }

    public static function findByUsername($username) {
        $db = static::getDB();
        $sql = 'SELECT * FROM users WHERE username = :username';
        $statement = $db->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $statement->execute();

        return $statement->fetch();
    }

    public static function authenticate($username, $password) {
        $user = static::findByUsername($username);

        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }

        return false;
    }

    public function signUp()
    {
        $this->validate();

        if (empty($this->errors)) {
            $db = static::getDB();
            $sql = 'INSERT INTO users VALUES (NULL, :username, :password)';
            $password = password_hash($this->password1, PASSWORD_DEFAULT);
            $statement = $db->prepare($sql);
            $statement->bindValue(':username', $this->username, PDO::PARAM_STR);
            $statement->bindValue(':password', $password, PDO::PARAM_STR);
            return $statement->execute();
        }

        return false;
    }

    public static function signIn($username, $password)
    {
        $db = static::getDB();
        $sql = 'SELECT * FROM users WHERE username = :username';
        $statement = $db->prepare($sql);
        $statement->execute([':username' => $username]);

        if ($statement->rowCount() > 0) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return password_verify($password, $result['password']);
        }

        return false;
    }

    public static function resetPassword($username, $password)
    {
        $db = static::getDB();
        $sql = 'UPDATE users SET password = :password WHERE username = :username';
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $statement = $db->prepare($sql);
        $statement->execute([':username' => $username, ':password' => $password_hash]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
