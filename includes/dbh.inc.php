<?php

$dsn = 'mysql:host=localhost;dbname=myBlog';
$db_username = 'root';
$db_password = '';

try {
    $pdo = new PDO($dsn,$db_username,$db_password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection Failed') .$e -> getMessage();
}
