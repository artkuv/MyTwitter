<pre>
<?php

$dsn = 'mysql:dbname=mytwitter;host=localhost;port=3306';
$user = 'root';
$password = 'root';

$connection = new PDO($dsn, $user, $password);

// $statement = $connection->prepare("SELECT * FROM `users` WHERE email = :email");
// $statement->execute([
//     ':email' => $_GET['email']
// ]);

$statement = $connection->prepare('SELECT * FROM `users` WHERE id = :id;');
$statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$statement->execute();

$result = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($result);