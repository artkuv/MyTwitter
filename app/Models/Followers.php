<?php

namespace App\Models;

require "../../framework/Model.php";

use PDO;

use Framework\Model;

class Follower extends Model
{
    public static function getByFollowsID(string $followsid): array
    {
        $stmt = static::db()->prepare('SELECT * FROM followers WHERE follows_user_id = :follows_user_id');
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

    public static function update(int $follows, int $user_id): bool
    {
        $sql = 'UPDATE followers
                SET `followers`.`follows_user_id` = ' . $follows . 
                ' WHERE followers.user_id = ' . $user_id; 
        $stmt = static::db()->prepare($sql);
    
        return $stmt->execute();
    }
}

$follower = new Follower();

// var_dump($follower->getAll('followers'));

// $newArray = [
//     "user_id" => "2",
//     "follows_user_id" => "35943"
// ];
// $follower->create($newArray);
// echo '<br>';
// var_dump($follower->getByUserId('followers',2));

// $follower->deleteByUserId('followers', 3);
// var_dump($follower->getAll('followers'));

// echo '<br>';
// $follower->update(23456,2);
// var_dump($follower->getAll('followers'));