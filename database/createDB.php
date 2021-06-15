<?php

//use App\ConnectionDB;
//$pdo = ConnectionDB::getPDO();
// DB Connection

//require_once 'connectDB.php';

use App\ConnectionDB;

require  dirname(__DIR__) . '/vendor/autoload.php';

$pdo = ConnectionDB::getPDO();




/*
// users table
$pdo->exec("CREATE TABLE users(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    pseudo VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'USERS, ';
*/

// posts table 
$pdo->exec("CREATE TABLE posts(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR (255) NOT NULL,
    slug VARCHAR (255) NOT NULL,
    content text NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'POSTS, ';


//comments table
$pdo->exec("CREATE TABLE comments(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(255) NOT NULL,
    title VARCHAR (255) NOT NULL,
    content text NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'COMMENTS, ';



//posts_comments table
$pdo->exec("CREATE TABLE posts_comments (
    post_id INT UNSIGNED NOT NULL,
    comment_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, comment_id),
    CONSTRAINT fk_post
        FOREIGN KEY (post_id)
        REFERENCES posts (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT fk_comment
        FOREIGN KEY (comment_id)
        REFERENCES comments (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
) DEFAULT CHARSET=utf8mb4");

echo 'POSTS_COMMENTS, ';