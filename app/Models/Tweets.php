<?php

namespace App\Models;

require "../../framework/Model.php";

use PDO;

use Framework\Model;

class Tweets extends Model
{
    public static function getByContent(string $content): array
    {
        $stmt = static::db()->prepare('SELECT * FROM tweets WHERE content = :content');
        $stmt->execute([':content' => $content]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByCreatedDate(string $date_created): array
    {
        $stmt = static::db()->prepare('SELECT * FROM tweets WHERE date_created = :date_created');
        $stmt->bindParam(':date_created', $_GET['date_created'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUpdatedDate(string $date_updated): array
    {
        $stmt = static::db()->prepare('SELECT * FROM tweets WHERE date_updated = :date_updated');
        $stmt->bindParam(':date_updated', $_GET['date_updated'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $params): bool
    {
        $sql = 'INSERT INTO tweets (user_id, content, date_created, date_updated) 
                VALUES (:user_id, :content, :date_created, :date_updated)';
        $stmt = static::db()->prepare($sql);

        return $stmt->execute([
            ':user_id' => $params['user_id'],
            ':content' => $params['content'],
            ':date_created' => time(),
            ':date_updated' => time(),
        ]);
    }

    public static function update(array $params): bool
    {
        $sql = 'UPDATE tweets
                SET tweets.`content` = :content, 
                tweets.`date_updated` = :date_updated 
                WHERE tweets.`user_id` = :user_id'; 
        $stmt = static::db()->prepare($sql);
    
        return $stmt->execute([
            ':content' => $params['content'],
            ':user_id' => $params['user_id'],
            ':date_updated' => time(),
        ]);
    }
}

$tweet = new Tweets();
// var_dump($tweet->getAll('tweets'));
// echo "<br>";

// $arrayName = array( 
//     'user_id' => '2',
//     'content' => 'smt new2',
// );
// $tweet->create($arrayName);

// $array = array(
//     'content' => 'hello',
//     'user_id' => '1',
// );
// $tweet->update($array);
// var_dump($tweet->getAll('tweets'));

// $tweet->deleteByUserId('tweets',1);
// var_dump($tweet->getAll('tweets'));

// var_dump($tweet->getByUserId('tweets', 2));