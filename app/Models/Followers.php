<?php

namespace App\Models;

use PDO;

use Framework\Model;

class Follower extends Model
{
    public static function getByFollowsID(string $followsid): array
    {
        $stmt = static::db()->prepare('SELECT * FROM follows WHERE follows_id = :follows_id');
        $stmt->bindParam(':follows_id', $_GET['follows_id'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(array $params): bool
    {
        $sql = 'INSERT INTO followers (user_id, follows_id) 
                VALUES (:user_id, :follows_id)';
        $stmt = static::db()->prepare($sql);

        return $stmt->execute([
            ':user_id' => $params['user_id'],
            ':follows_id' => $params['follows_id'],
        ]);
    }
}

$follower = new Follower();

var_dump($follower->getAll());