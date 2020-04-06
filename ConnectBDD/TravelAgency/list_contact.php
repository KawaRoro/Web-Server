<?php
session_start();
$fail_contact_form = false;

// Vérification si identification par session
if(isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['session'])){
    if(($_SESSION['login']!="") && ($_SESSION['password']!="") && ($_SESSION['session']!="")){
        $identification_by_session = true;
    }
}


// Identification
if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['session']) || $identification_by_session) // Si le nom et l'email est renseigné + étape contact
{
    if($identification_by_session){
        $name = $_SESSION['login'];
        $password = $_SESSION['password'];
        $session = $_SESSION['session'];
    }else{
        $_SESSION['login'] = $name = $_POST['name'];
        $_SESSION['password'] = $password = $_POST['password'];
        $_SESSION['session'] = $session = $_POST['session'];
    }

    setcookie('login', $name , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    setcookie('password', $password , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    setcookie('session', $session , time() + 365*24*3600, null, null, false, true); // On écrit un cookie

    // Envoi en BDD
    require_once('connect.php');

    $res = $bdd->query('SELECT COUNT(*) FROM administrators WHERE login_admin = "'.$name.'" AND pass_admin = "'.$password.'" ');
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
                                            echo ('<li><a href="#"><span class="number">'.$data['id_contact'].'</span><span class="name">'.$data['name_contact'].'</span><span class="email"> '.$data['email_contact'].'</span><span class="date"> '.$date_contact.'</span><span class="check"> '.$data['check_contact'].'</span></a></li>');
                                            //echo $data['name_contact'].' '.$data['email_contact'].' '.$data['check_contact'].' '.$data['date_contact'].' '.$data['session_contact'].' '.$data['ip_contact'].' '.$data['ip_type_contact']; // 
                                        }
                            echo '</ul>';
        // Fermeture du HTML
                    echo '<form name="contact-form" method="post" action="index.php">';
                    echo '<input type="submit" value="RETOUR" id="button-ok" class="button-4" >'; //  disabled="disabled" // onclick="validForm()"
                    echo '</form>';                 
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

    include('cookie.php');

    delCookie("login");
    delCookie("password");
    delCookie("session");

}
?>