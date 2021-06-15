<?php


//require_once 'connectDB.php';

use App\ConnectionDB;

require  dirname(__DIR__) . '/vendor/autoload.php';

$pdo = ConnectionDB::getPDO();



$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("DROP TABLE  IF EXISTS users");
$pdo->exec("DROP TABLE IF EXISTS posts");
$pdo->exec("DROP TABLE IF EXISTS comments");
$pdo->exec("DROP TABLE IF EXISTS posts_comments");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

echo 'OK database table were cleaned ';