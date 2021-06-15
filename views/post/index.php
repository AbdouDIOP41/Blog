<?php

use App\URL;
use App\Model\Post;
use App\ConnectionDB;
use App\Helpers\Text;
use App\PaginatedQuery;

$title = 'Mon Blog';
$pdo = ConnectionDB::getPDO();

$query = " SELECT * FROM posts ORDER BY created_at DESC ";

$queryCount = "SELECT COUNT(id) FROM posts ";

$paginatedQuery = new PaginatedQuery($query, $queryCount);

$posts = $paginatedQuery->getItems(Post::class);

$link = $router->url('home');


?>

<h1>Mon Blog</h1>

<div class="container">
    <?php foreach($posts as $post) : 

    ?>
    <div class="container-fluid mt-4">
        <?php  require_once  dirname(__DIR__) . '/card.php';
                $urlPost = $router->url('post', [
                    'id' => $post->getId(),
                    'slug' => $post->getSlug()
                ]);
           printCard($post, $urlPost);

        ?>
    </div>

    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
        <?= $paginatedQuery->previousLink($link) ?>
        <?= $paginatedQuery->nextLink($link) ?>

</div>