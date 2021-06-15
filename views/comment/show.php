<div id="list-example" class="list-group">
<a class="navbar-brand" href="#">Les Commentaires</a>
        <?php foreach($comments as $k => $comment):
            $num = $k + 1; ?>
            <a class="list-group-item list-group-item-action mt-4" href="#<?= $comment->getPseudo()?>"> @<?= $comment->getPseudo()?><?= $num ?></a>
           <div id="'. $comment->getPseudo(). '">
           <?php
                require_once  dirname(__DIR__) . '/card.php';
                printCard($comment);
            ?>
            </div>
        <?php endforeach ?>
</div>


