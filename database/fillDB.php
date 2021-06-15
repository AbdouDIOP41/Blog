<?php
//use \PDO;


use App\ConnectionDB;

require  dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

//require_once 'connectDB.php';

$pdo = ConnectionDB::getPDO();

$posts = [];
$categories = [];
$comments = [];

//clean db
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
//$pdo->exec("TRUNCATE TABLE users");
$pdo->exec("TRUNCATE TABLE posts");
$pdo->exec("TRUNCATE TABLE comments");
$pdo->exec("TRUNCATE TABLE posts_comments");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

echo 'database tables cleaned successfuly ! ';


//create posts 

for ($i = 0; $i < 20 ; $i++){
    $numb = $i + 1;
    $pdo->exec("INSERT INTO posts
                SET title  = '{$faker->sentence(2)}',
                    slug = 'post{$numb}',
                    content = '{$faker->paragraphs(rand(3, 15), true)}',
                    created_at = '{$faker->date} {$faker->time}'
    ");
    $posts[] = $pdo->lastInsertId();
}

echo 'POSTS, ';


//create comments

for ($i = 0; $i < 100; $i++){
    $pdo->exec("INSERT INTO comments
                SET pseudo = '{$faker->userName}', 
                    title  = '{$faker->sentence(2)}',
                    content = '{$faker->paragraphs(rand(3, 15), true)}',
                    created_at = '{$faker->date} {$faker->time}'

    ");
    $comments[] = $pdo->lastInsertId();
}

echo 'COMMENTS, ';




//link posts with comments

foreach($posts as $post){
    $randomComments = $faker->randomElements($comments, rand(1, 2));
    foreach($randomComments as $comment){
        $pdo->exec("INSERT INTO posts_comments SET post_id=$post, comment_id=$comment");
    }
}

echo 'POSTS_COMMENTS, ';


 echo " were created successfully";

