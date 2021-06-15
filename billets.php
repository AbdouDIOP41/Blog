<?php

        $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $index = 'index.php';
        $comms = 'commentaires.php';

        try {
            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }
/*
        $nbbillets = $bdd->query('SELECT COUNT(id) AS nb_billets FROM billets');
        $limite = 5;
        $x = (int) ($nbbillets / $limite);
        $nbpage = (($nbbillets%$limite) == 0) ? $x : ($x + 1);

        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $debut = ($page - 1) * $limite;*/
        
        //echo $nbbillets;
        

       // $nbbillets->closeCursor();
        global $limite, $page, $debut;
        $limite  = 5;
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $debut = ($page - 1) * $limite;

        /*global $tabInfos;
        $tabInfos = array();
        if(strpos($GLOBALS['monUrl'], $GLOBALS['index']) !== false) {
                    
            $tabInfos['limite'] = 5;
            $tabInfos['cliquepage'] = '';
            $tabInfos['adresse'] = '3 Rue du Paradis';
            $tabInfos['ville'] = 'Marseille';
        }
*/

        function nombrepage(){
            $table = '';
            if(strpos($GLOBALS['monUrl'], $GLOBALS['index']) !== false) {
                $table = 'billets';
                //$limite = 1;
            }
            //$chaine = 'ORDER BY date_creation DESC LIMIT ' .$GLOBALS['debut']. ',' .$GLOBALS['limite'] ;
            else if (strpos($GLOBALS['monUrl'], $GLOBALS['comms']) !== false){
                $table = 'commentaires';
            }
            //$chaine = 'WHERE id='.$_GET['billet'];
            $nbbillets = $GLOBALS['bdd']->query('SELECT COUNT(id) AS nb_elem FROM ' .$table);
            echo '<pre>';
            print_r($nbbillets);
            echo '</pre>';
            $nb = $nbbillets->fetch();
            echo $nb['nb_elem']. ' billets </br>';

            $x = (int) ($nb['nb_elem'] / $GLOBALS['limite']);
            $nbpage = (($nb['nb_elem']%$GLOBALS['limite']) == 0) ? $x : ($x + 1);
           // $nbbillets->closeCursor();
            return $nbpage;

            
            //return $nb['nb_elem'];

        }

    function requete(){

        $chaine = '';

        if(strpos($GLOBALS['monUrl'], $GLOBALS['index']) !== false)
            $chaine = 'ORDER BY date_creation DESC LIMIT ' .$GLOBALS['debut']. ',' .$GLOBALS['limite'] ;
        else if (strpos($GLOBALS['monUrl'], $GLOBALS['comms']) !== false)
            $chaine = 'WHERE id='.$_GET['billet'];

        $req = 'SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\' ) 
                AS date_creation_fr FROM billets ' . $chaine ;
        $res = $GLOBALS['bdd']->query($req);
        echo '<pre>';
         print_r($res);
         echo '</pre>';
        return $res;

    }
    //$arg = 'ORDER BY date_creation DESC LIMIT 0, 5';
    $reponse = requete();



    function afficher_donnee($data){
 
            while ( $donnees = $data->fetch()){
        ?>
                <div class="news">
                    <h3>
                        <?php
                            echo htmlspecialchars($donnees['titre']). ' <em> le ' . htmlspecialchars($donnees['date_creation_fr']). '</em>';
                            //<em>le <?php echo $donnees['date_creation_fr']; 
                        ?>
                    </h3>

                    <p>
                        <?php
                            echo htmlspecialchars($donnees['contenu']);
                            //<em>le <?php echo $donnees['date_creation_fr']; 
                        ?>
                        </br>
                            <?php
                                if (strpos($GLOBALS['monUrl'], $GLOBALS['index']) !== false){
                            ?>
                                    <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
                            <?php
                                }
                            
                            ?>
                        
                    </p>

                </div>

        <?php
            } // Fin de la boucle des billets
            $data->closeCursor();
        }

    afficher_donnee($reponse);

    $np = nombrepage();
    echo $nb;

    echo 'page ';
    $rgx = '#billet='.$_GET['billet'].'&amp;?#';
    for($i = 1 ; $i <=$np ; $i++){
        
        echo ' <a href="?'.$rgx. 'page='.$i.'">'.$i.'</a> ';
    }
    echo '</p>';
?>


        
           
            


