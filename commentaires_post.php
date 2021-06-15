<?php

    setcookie('pseudo',$_POST['pseudo'], time() + 365*24*3600, null, null, false, true); 
    session_start();


    if (isset($_POST['pseudo']) && isset($_POST['commentaire'])){
        
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }
            $req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(?,?,?, NOW())');
            $req->execute(array($_SESSION['billet'], $_POST['pseudo'], $_POST['commentaire']));

        header('Location: commentaires.php?billet=' .$_SESSION['billet']);
    }
 
    else {
        echo ('erreur');
    }



?>