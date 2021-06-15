<?php

use App\ConnectionDB;
use App\Model\Comment;
use App\Model\Post ;


$pdo = ConnectionDB::getPDO();

$id = (int)$params['id'];
$slug = $params['slug'];

$query = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);

/** @var Post|false */
$post = $query->fetch();
if ($post === false){
    throw new Exception('aucun article ne correspond a ce ID');
}


if ($post->getSlug() !== $slug){
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}

$query = $pdo->prepare('SELECT c.*
                        FROM posts_comments pc
                        JOIN comments c ON pc.comment_id = c.id
                        WHERE pc.post_id = :id');
$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Comment::class);

/** @var Category[] */
$comments = $query->fetchAll();
//dd($comments);    
?>
<h1><?= htmlentities($post->getTitle())?> </h1>
<p class="text-muted"> <?= $post->getCreated_at()->format('d F Y ') ?> </p>
<p> <?= $post->getContent() ?> </p>




<?php  require  dirname(__DIR__) . '/comment/show.php'; ?>



