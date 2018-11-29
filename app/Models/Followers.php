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

    public static function deleteByUserId(array $params): bool
    {
        $sql = 'DELETE FROM followers 
                WHERE `followers`.`user_id` = user_id';
        $stmt = static::db()->prepare($sql);

        return $stmt->execute([
            ':user_id' => $params['user_id'],
        ]);
    }
}

$follower = new Follower();

var_dump($follower->getAll('followers'));

$newArray = [
    "user_id" => "23424",
    "follows_user_id" => "35943"
];
$follower->create($newArray);
var_dump($follower->getAll('followers'));

$arrayName = array('id' => '3');
$follower->deleteByUserId($arrayName);
var_dump($follower->getAll('followers'));
