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
// Select simplifié
$req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = :possesseur AND prix <= :prixmax');
$req->execute(array('possesseur' => $_GET['possesseur'], 'prixmax' => $_GET['prix_max']));

// INSERT simplifié
$req = $bdd->prepare('INSERT jeux_video(nom, prix) VALUES (? , ?)');
$req->execute(array($_GET['possesseur'], $_GET['prix_max']));

// Ajout
// http://127.0.0.1:5500/_crm/Web-Server/Exemples/connect.php?nom=Ben&console=NES&prix_max=35&possesseur=bill&nbre_joueurs_max=18&commentaires=blabla
$req = $bdd->prepare('INSERT jeux_video(nom, possesseur, console, prix, nbre_joueurs_max, commentaires) VALUES (? , ?, ?, ?, ?, ?)');
        
if(isset($_GET['nom']) && isset($_GET['possesseur']) && isset($_GET['console']) && isset($_GET['prix_max']) && isset($_GET['nbre_joueurs_max']) && isset($_GET['commentaires'])){
    
    $nom = $_GET['nom'];
    $possesseur = $_GET['possesseur'];
    $console = $_GET['console'];
    $prix_max = $_GET['prix_max'];
    $nbre_joueurs_max = $_GET['nbre_joueurs_max'];
    $commentaires = $_GET['commentaires'];
    
    $req->execute(array($nom, $possesseur, $console, $prix_max, $nbre_joueurs_max, $commentaires));
}

// Modification
$nb_modifs = $bdd->exec('UPDATE jeux_video SET possesseur = \'Florent\' WHERE possesseur = \'Michel\'');
echo $nb_modifs . ' entrées ont été modifiées !';

//
// UPDATE - requête préparée 
// http://127.0.0.1:5500/_crm/Web-Server/Exemples/connect.php?nom=Ben&console=true&prix=50&nbre_joueurs_max=8
$nom = $_GET['nom'];
$prix = $_GET['prix'];
$nbre_joueurs_max = $_GET['nbre_joueurs_max'];
$req = $bdd->prepare('UPDATE jeux_video SET prix = :prix, nbre_joueurs_max = :nbre_joueurs_max WHERE nom = :nom');
$req->execute(array(
    'prix' => $prix,
    'nbre_joueurs_max' => $nbre_joueurs_max,
    'nom' => $nom
    ));

// Plantage
$reponse = $bdd->query('SELECT nom FROM jeux_video') or die(print_r($bdd->errorInfo()));

// 
*/

?>
