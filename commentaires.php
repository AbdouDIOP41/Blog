<?php 
    session_start();
    $_SESSION['billet'] = $_GET['billet'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <?php
            include('billets.php');
             
            echo '<h2>Commentaires </h2>';

            $reponse = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\' )
            AS date_commentaire_fr FROM commentaires WHERE id_billet=?');
            $reponse->execute(array($_GET['billet']));

            //$donnees = $reponse->fetch();
            if (empty($donnees = $reponse->fetch()))
                echo "Ce billet n'existe pas";
            else {
            while( $donnees = $reponse->fetch()){

        ?>
        <p>
                <?php  echo '<strong>' .htmlspecialchars($donnees['auteur']). ' </strong> le '
                .htmlspecialchars($donnees['date_commentaire_fr']); ?>
        </p>
        <p>
                <?php echo nl2br(htmlspecialchars($donnees['commentaire'])) ?>
        </p>

        <?php
            }
            $reponse->closeCursor();
        ?>

        <form method="post" action="commentaires_post.php">
            <p>
                <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" value=<?php echo $_COOKIE['pseudo'];?> required> <br/>
                <label for="commentaire">commentaire</label> :  <input type="text" name="commentaire" id="commentaire" required/><br />

                <input type="submit" value="Envoyer" /> 
            
            </p>
        </form>
        <?php
            }
        ?>


</body>
</html>