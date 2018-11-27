<pre>
<?php

$dsn = 'mysql:dbname=mytwitter;host=localhost;port=3306';
$user = 'root';
$password = 'root';

$connection = new PDO($dsn, $user, $password);

$getAll = $connection->query('SELECT * FROM users');

$result = $getAll->fetchAll(PDO::FETCH_ASSOC);
var_dump($result);

$getByEmail = $connection->prepare("SELECT * FROM `users` WHERE email = :email");
$getByEmail->execute([
    ':email' => $_GET['email']
]);

$result = $getByEmail->fetch(PDO::FETCH_ASSOC);
var_dump($result);

$getById = $connection->prepare('SELECT * FROM `users` WHERE id = :id;');
$getById->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$getById->execute();

$result = $getById->fetch(PDO::FETCH_ASSOC);
var_dump($result);