<?php
/*try {
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $response = $bdd->query('SELECT console, nom, prix FROM jeux_video WHERE console="NES" or console="PC" ORDER BY prix DESC LIMIT 20');
    while($data = $response->fetch()){
        echo '<p>'.$data['console'].' - '.$data['nom'].' - '.$data['prix'].' €</p>';
    }
    $response->closeCursor();
}
catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
}*/

// Prepare requete
/*if(isset($_GET['console'])){

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $requete = $bdd->prepare('SELECT console, nom, prix FROM jeux_video WHERE console=?');
        $requete->execute(array($_GET['console']));
        while($data = $requete->fetch()){
            echo '<p>'.$data['console'].' - '.$data['nom'].' - '.$data['prix'].' €</p>';
        }
        $requete->closeCursor();
    }
    catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
    }
}*/

// Just connect to BDD
if(isset($_GET['console'])){

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
    }
}

/*
$req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = :possesseur AND prix <= :prixmax');
$req->execute(array('possesseur' => $_GET['possesseur'], 'prixmax' => $_GET['prix_max']));
*/

?>
