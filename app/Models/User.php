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

    public static function update(array $params, string $dbname, int $id): bool
    {
        $sql = 'UPDATE :dbname
                SET :dbname.`email` = :email, 
                WHERE :dbname.`id` = :id'; 
        $stmt = static::db()->prepare($sql);
    
        return $stmt->execute([
            'id' => $id,
            ':dbname' => $dbname,
            ':email' => $params['email'],
            ':name' => $params['name'],
            ':password' => self::hashPassword($params['password']),
            ':registered' => time(),
            ':last_login' => time(),
        ]);
    }

    public static function update(array $params): bool
    {
      
    }

    protected static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
 
$user = new User();
 
$cls = $user->getAll('users');
var_dump($cls);

$arrayName = array(
    'email' => 'alds@gmail.com', 
    'name' => 'alan',
    'password' => 'sadk213k',
);
$cls = $user->update($arrayName,'users',0);
var_dump($cls);