<?php

function printCard($mapping, $url = null ){ ?>

    <div class="card w-75">
        <h5 class="card-header"> <?= htmlentities($mapping->getTitle())?> </h5>
  <div class="card-body">
       
        <p class="text-muted"><?= $mapping->getCreated_at()->format('d F Y ') ?> </p>


            <div class="overflow-auto bg-light p-2 mr-3 " style= "height: 100px">
                <p class="card-text"> <?= $mapping->getContent() ?> </p>
            </div>
            <?php 
            if ($url !== null) : ?>
                <a href="<?= $url ?>" class="btn btn-primary mt-4">  Commentaires </a>
           <?php endif; ?>

        <a class="nav-link dropdown-toggle" data-toggle="Action" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#one">SUPPRIMER</a>
        <a class="dropdown-item" href="#two">MODIFIER</a>
 
    </div>

</div>


<?php } ?>