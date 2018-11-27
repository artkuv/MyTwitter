<?php

namespace App\Models;

require "../../framework/Model.php";

use PDO;

use Framework\Model;

class Tweets extends Model
{
    public static function getByEmail(string $content): array
    {
        $stmt = static::db()->prepare('SELECT * FROM tweets WHERE content = :content');
        $stmt->execute([':content' => $content]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByFollowsID(string $date_updated): array
    {
        $stmt = static::db()->prepare('SELECT * FROM tweets WHERE date_updated = :date_updated');
        $stmt->bindParam(':date_updated', $_GET['date_updated'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(array $params): bool
    {
        $sql = 'INSERT INTO tweets (user_id, content, date_cteated, date_updated) 
                VALUES (:user_id, :content, :date_cteated, :date_updated)';
        $stmt = static::db()->prepare($sql);

        return $stmt->execute([
            ':user_id' => $params['user_id'],
            ':content' => $params['content'],
            ':date_cteated' => time(),
            ':date_updated' => time(),
        ]);
    }
}