<?php

namespace App\Models;

require "../../framework/Model.php";

use PDO;

use Framework\Model;

class Follower extends Model
{
    public static function getByFollowsID(string $followsid): array
    {
        $stmt = static::db()->prepare('SELECT * FROM follows WHERE follows_user_id = :follows_user_id');
        $stmt->bindParam(':follows_user_id', $_GET['follows_user_id'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(array $params): bool
    {
        $sql = 'INSERT INTO followers (user_id, follows_user_id) 
                VALUES (:user_id, :follows_user_id)';
        $stmt = static::db()->prepare($sql);

        return $stmt->execute([
            ':user_id' => $params['user_id'],
            ':follows_user_id' => $params['follows_user_id'],
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
}

$follower = new Follower();

var_dump($follower->getAll('followers'));

$newArray = [
    "user_id" => "3",
    "follows_user_id" => "35943"
];
$follower->create($newArray);
echo '<br>';
var_dump($follower->getByUserId('followers'));

$arrayName = array('user_id' => '3');
$follower->deleteByUserId('followers', $arrayName);
var_dump($follower->getAll('followers'));
