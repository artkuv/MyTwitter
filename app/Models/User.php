<?php

namespace App\Models;

use PDO;

use Framework\Model;

class User extends Model
{
    public static function getByEmail(string $email): array
    {
        $stmt = static::db()->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByPassword(string $password): array
    {
        $stmt = static::db()->prepare('SELECT * FROM users WHERE password = :password');
        $stmt->execute([':password' => $password]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByName(string $name): array
    {
        $stmt = static::db()->prepare('SELECT * FROM users WHERE name = :name');
        $stmt->execute([':name' => $name]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public static function getByIP(string $ip): array
    {
        $stmt = static::db()->prepare('SELECT * FROM users WHERE ip = :ip');
        $stmt->execute([':ip' => $ip]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByRegistered(string $registered): array
    {
        $stmt = static::db()->prepare('SELECT * FROM users WHERE registered = :registered');
        $stmt->bindParam(':registered', $_GET['registered'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByLastLogin(string $lastlogin): array
    {
        $stmt = static::db()->prepare('SELECT * FROM users WHERE lastlogin = :lastlogin');
        $stmt->bindParam(':lastlogin', $_GET['lastlogin'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(array $params): bool
    {
        $sql = 'INSERT INTO users (email, name, password, registered, last_login) 
                VALUES (:email, :name, :password, :registered, :last_login)';
        $stmt = static::db()->prepare($sql);

        return $stmt->execute([
            ':email' => $params['email'],
            ':name' => $params['name'],
            ':password' => self::hashPassword($params['password']),
            ':registered' => time(),
            ':last_login' => time(),
        ]);
    }

    //UPDATE <table_name>
    //SET <col_name1> = <value1>, <col_name2> = <value2>, ...
    //WHERE <condition>; 

    protected static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

$user = new User();

var_dump($user->getAll());