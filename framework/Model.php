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
            // $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';port=' . DB_PORT;
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

    public static function getByID(string $dbname,int $id): array
    {
        $stmt = static::db()->prepare('SELECT * FROM ' . $dbname . ' WHERE id = ' . $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUserID(string $dbname, int $user_id): array
    {
        $stmt = static::db()->prepare('SELECT * FROM ' . $dbname . ' WHERE user_id = ' . $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteById(string $dbname, int $id): bool
    {
        $stmt = static::db()->prepare('DELETE FROM ' . $dbname . ' WHERE id = ' . $id);

        return $stmt->execute();
    }

    public static function deleteByUserId(string $dbname, int $user_id): bool
    {
        $stmt = static::db()->prepare('DELETE FROM ' . $dbname . ' WHERE user_id = ' . $user_id);

        return $stmt->execute();
    }
}