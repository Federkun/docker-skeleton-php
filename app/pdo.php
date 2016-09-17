<?php

$config = [
    'dbname' => getenv('MYSQL_DATABASE'),
    'username' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
];

$pdo = new PDO(
    sprintf('mysql:host=mysql;dbname=%s;charset=utf8mb4', $config['dbname']),
    $config['username'], $config['password']
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

echo $pdo->query('SELECT CURRENT_USER()')->fetchColumn();
