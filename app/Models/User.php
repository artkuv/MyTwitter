<?php
namespace App\Models;
 
require "../../framework/Model.php";
 
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
        $sql = 'INSERT INTO users (email, password, name, user_id, registered, last_login) 
                VALUES (:email, :password, :name, :user_id, :registered, :last_login)';
        $stmt = static::db()->prepare($sql);
 
        return $stmt->execute([
            ':email' => $params['email'],
            ':name' => $params['name'],
            ':user_id' => $params['user_id'],
            ':password' => self::hashPassword($params['password']),
            ':registered' => time(),
            ':last_login' => time(),
        ]);
    }

    public static function update(array $params): bool
    {
        $sql = 'UPDATE users
                SET users.`email` = :email,
                users.`name` = :name,
                users.`password` = :password,
                users.`last_login` = :last_login 
                WHERE `users`.`user_id` = :user_id'; 
        $stmt = static::db()->prepare($sql);
    
        return $stmt->execute([
            ':user_id' => $params['user_id'],
            ':email' => $params['email'],
            ':name' => $params['name'],
            'last_login' => time(),
            ':password' => self::hashPassword($params['password'])
        ]);
    }

    protected static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
 
$user = new User();
 
// var_dump($user->getAll('users'));

// $array = array(
//     'email' => 'asfk@gmail.com',
//     'name' => 'evgen',
//     'user_id' => '3',
//     'password' => 'asd213ds'
// );
// $user->create($array);
// var_dump($user->getAll('users'));

// $arrayName = array(
//     'user_id' => '3',
//     'email' => 'alds@gmail.com', 
//     'name' => 'alan',
//     'password' => 'sadk213k',
// );
// $user->update($arrayName);
// var_dump($user->getAll('users'));

// $user->deleteByUserId('users', '3');