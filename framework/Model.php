<?php

namespace Framework;

use PDO;
?>

<pre>

<?php 
abstract class Model 
{
    static protected $db;

    protected static function db()
    {
        if (null === static::$db) 
        {
            // $dsn = 'mysql:dbname=' . DB_NAME . 'host=' . DB_HOST . ';port=' . DB_PORT;
            // static::$db = new PDO($dsn, DB_USER, DB_PASS);
            $dsn = 'mysql:dbname=mytwitter;host=localhost;port=3306';
            $user = 'root';
            $password = 'root';

            static::$db = new PDO($dsn, $user, $password);

            // Включаем режим отображения ошибок в PDO
            static::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return static::$db;
    }

    public static function getAll(string $dbname): array
    {
        $stmt = static::db()->query('SELECT * FROM ' . $dbname);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByID(string $dbname): array
    {
        $stmt = static::db()->prepare('SELECT * FROM ' . $dbname . ' WHERE id = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUserID(string $dbname): array
    {
        $stmt = static::db()->prepare('SELECT * FROM ' . $dbname . ' WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $_GET['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}