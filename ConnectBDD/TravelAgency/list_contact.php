<?php
require_once('connect.php');
require_once('cookie.php');
session_start();
$fail_contact_form = false;
$go_to_send_contact = false;
$identification_by_session = false;

// Vérification si identification par session
if(isset($_SESSION[$var_project.'login']) && isset($_SESSION[$var_project.'password']) && isset($_SESSION[$var_project.'session'])){
    if(($_SESSION[$var_project.'login']!="") && ($_SESSION[$var_project.'password']!="") && ($_SESSION[$var_project.'session']!="")){
        $identification_by_session = true;
    }
}

// Identification
if (isset($_POST[$var_project.'login']) && isset($_POST[$var_project.'password']) && isset($_POST[$var_project.'session']) || $identification_by_session) // Si le nom et l'email est renseigné + étape contact
{
    if($identification_by_session){
        $login = $_SESSION[$var_project.'login'];
        $password = $_SESSION[$var_project.'password'];
        $session = $_SESSION[$var_project.'session'];
    }else{
        $_SESSION[$var_project.'login'] = $login = $_POST[$var_project.'login'];
        $_SESSION[$var_project.'password'] = $password = $_POST[$var_project.'password'];
        $_SESSION[$var_project.'session'] = $session = $_POST[$var_project.'session'];
    }

    setcookie($var_project.'login', $login , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    setcookie($var_project.'password', $password , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    setcookie($var_project.'session', $session , time() + 365*24*3600, null, null, false, true); // On écrit un cookie

    // Envoi en BDD
    require_once('functions.php');

    $res = $bdd->query('SELECT COUNT(*) FROM administrators WHERE login_admin = "'.$login.'" AND pass_admin = "'.$password.'" ');
    //echo $res->fetchColumn();
    if ($res->fetchColumn() == 1) { // Connection
        
        echo ('<!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="utf-8" />
                        <link href="css/styles.css" rel="stylesheet">
                        <link href="css/bo_styles.css" rel="stylesheet">
                        <link href="http://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
                        <title>Contact Travel Agency</title>
                    </head>
                    <body>
                        <header> 
                            <div class="wrapper">
                                <h1>Travel Agency<span class="orange">.</span></h1>
                                <nav>
                                    <ul>
                                        <li><a href="index.php">Accueil</a></li>
                                        <li><a href="index.php#steps">Destinations</a></li>
                                        <li><a href="index.php#possibilities">Circuits</a></li>
                                        <li><a href="index.php#contact">Contact</a></li>
                                        <li><a href="admin.php" class="orange">Administrateur</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </header>
                        <section>
                            <div style="text-align:center;">'); //  id="main-image"
        
                            echo ('<p style="text-align:center;"><h3>Liste des personnes à contacter</h3></p><br>
                                    <ul class="list">
                                        <li class="list"><span class="number">#</span><span class="name">Name</span><span class="email"> Email</span><span class="date"> Date inscription</span><span class="check"> Contacté</span></li>');

                                        // Requete -> liste des personnes
                                        $res = $bdd->query('SELECT * FROM contacts ');
                                        while ($data = $res->fetch())
                                        {   
                                            $date_contact = date('d/m/Y H:i:s', strtotime($data['date_contact']));

                                            $check_contact = $data['check_contact'];
                                            if($check_contact == 0) {
                                                $go_to_send_contact = true;
                                                $check_contact = '<input type="checkbox" id="scales" name="scales" >';
                                            }else{
                                                $check_contact = '<input type="checkbox" id="scales" name="scales" checked>';
                                            }

                                            echo ('<li><a href="#"><span class="number">'.$data['id_contact'].'</span><span class="name">'.$data['name_contact'].'</span><span class="email"> '.$data['email_contact'].'</span><span class="date"> '.$date_contact.'</span><span class="check"> '.$check_contact.'</span></a></li>');
                                            //echo $data['name_contact'].' '.$data['email_contact'].' '.$data['check_contact'].' '.$data['date_contact'].' '.$data['session_contact'].' '.$data['ip_contact'].' '.$data['ip_type_contact']; // 
                                        }
                            echo '</ul>';
                    // Fermeture du HTML
                    echo '<div id="left">';
                    echo '<form name="contact-form" method="post" action="index.php">';
                    echo '<input type="submit" value="RETOUR" id="button-ok" class="button-4" >'; //  disabled="disabled" 
                    echo '</form>';
                    echo '</div>';
                    if($go_to_send_contact) { // button actif uniquement si au moins une personne est à contacter
                        echo '<div id="right">';
                        echo '<form name="contact-form" method="post" action="send_contact.php">';
                        echo '<input type="submit" value="ENVOI" id="button-ok" class="button-4" >'; //  disabled="disabled" 
                        echo '</form>';
                        echo '</div>';
                    }    
                    echo ('</div>
                        </section>
                    </body>
                </html>');

         $fail_contact_form = false;
    }else{
        $fail_contact_form = true;
    }

    //$res->closeCursor();
}else{ // Pour les non identifiés
    echo ('<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8" />
                    <link href="css/styles.css" rel="stylesheet">
                    <link href="css/bo_styles.css" rel="stylesheet">
                    <link href="http://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
                    <title>Contact Travel Agency</title>
                </head>
                <body>
                    <header> 
                        <div class="wrapper">
                            <h1>Travel Agency<span class="orange">.</span></h1>
                            <nav>
                                <ul>
                                    <li><a href="index.php">Accueil</a></li>
                                    <li><a href="index.php#steps">Destinations</a></li>
                                    <li><a href="index.php#possibilities">Circuits</a></li>
                                    <li><a href="index.php#contact">Contact</a></li>
                                    <li><a href="admin.php" class="orange">Administrateur</a></li>
                                </ul>
                            </nav>
                        </div>
                    </header>
                    <section>
                        <div style="text-align:center;">
                            <p style="text-align:center;"><h3>Vous n\'êtes pas identifié</h3></p><br>
                        </div>
                    </section>
                </body>
            </html>');

    delCookie($var_project.'name');
    delCookie($var_project.'email');
    //delCookie($var_project.'login');
    //delCookie($var_project.'password');
    delCookie($var_project.'session');
    delCookie($var_project.'token');
}
?>