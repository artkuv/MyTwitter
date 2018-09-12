<?php

namespace Framework;

use PDO;

abstract class Model 
{
    static protected $db;

    protected static function db()
    {
        if (null === static::$db) 
        {
            $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . 'dbname=' . DB_NAME;
            static::$db = new PDO($dsn, DB_USER, DB_PASS);

            // Включаем режим отображения ошибок в PDO
            static::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return static::$db;
    }

    public static function getAll(string $dbname): array
    {
        $stmt = static::db()->query('SELECT * FROM $dbname');
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByID(string $id, string $dbname): array
    {
        $stmt = static::db()->prepare('SELECT * FROM $dbname WHERE id = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByUserID(string $userid, string $dbname): array
    {
        $stmt = static::db()->prepare('SELECT * FROM $dbname WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $_GET['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}