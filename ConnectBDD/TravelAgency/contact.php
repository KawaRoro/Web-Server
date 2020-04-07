
<?php
require_once('connect.php');
require_once('functions.php');

session_start();
$fail_contact_form = false;
$count_contact_form = 0;
if (isset($_POST[$var_project.'name']) && isset($_POST[$var_project.'email']) && isset($_POST[$var_project.'session']) && isset($_POST[$var_project.'token'])) // Si le nom et l'email est renseigné + étape contact
{
    
    $_SESSION[$var_project.'name'] = $name = $_POST[$var_project.'name'];
    $_SESSION[$var_project.'email'] = $email = $_POST[$var_project.'email'];
    $_SESSION[$var_project.'session'] = $session = $_POST[$var_project.'session'];
    $_SESSION[$var_project.'token'] = $token = $_POST[$var_project.'token'];

    setcookie($var_project.'name', $name , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    setcookie($var_project.'email', $email , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    setcookie($var_project.'session', $session , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    setcookie($var_project.'token', $token , time() + 365*24*3600, null, null, false, true); // On écrit un cookie

    // Envoi en BDD

    $f_ip = getUserIP();
    $ip = $f_ip[0];
    $type_ip = $f_ip[1];

    $query_select_bdd = 'SELECT COUNT(*) as total_rows FROM contacts WHERE name_contact = "'.$name.'" AND email_contact = "'.$email.'" ';

    $res = $bdd->query($query_select_bdd);
    $row = $res->fetch(PDO::FETCH_ASSOC);
    $total_rows = $row['total_rows'];
    //fetchColumn();
    if ($total_rows == 0) {
        $query_insert_bdd = 'INSERT contacts(name_contact, email_contact, check_contact, date_contact, session_contact, token_contact, ip_contact, ip_type_contact) VALUES (?, ?, false, NOW(), ?, ?, ?, ?)';

        $req = $bdd->prepare($query_insert_bdd);

        if($req->execute(array($name, $email, $session, $token, $ip , $type_ip ))){
            $fail_contact_form = false;
        }else{
            $fail_contact_form = true;
        }
    }else{
        if ($total_rows > 0) {
            $count_contact_form = $total_rows;
        }
        $fail_contact_form = true;
    }

    //$res->closeCursor();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="css/styles.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
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
                        <li><a href="index.php#contact" class="orange" >Contact</a></li>
                        <li><a href="admin.php">Administrateur</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <section id="main-image">
			<div class="wrapper">
                <?php
                if (isset($_POST[$var_project.'name']) && isset($_POST[$var_project.'email']) && ($fail_contact_form == false)) // Si le nom et l'email est renseigné ou 
                {
                    // On affiche les informations
                    echo '<form name="contact-form" method="post" action="index.php#contact">'; //#contact
                    echo '<input type="hidden" id="name" name="'.$var_project.'name" value="'.$_POST[$var_project.'name'].'" >';
                    echo '<input type="hidden" id="email" name="'.$var_project.'email" value="'.$_POST[$var_project.'email'].'" >';
                    echo '<input type="hidden" id="session" name="'.$var_project.'session" value="'.$_POST[$var_project.'session'].'" >';
                    echo '<input type="hidden" id="token" name="'.$var_project.'token" value="'.$_POST[$var_project.'token'].'" >'; // 
                    echo '<input type="hidden" id="contact" name="'.$var_project.'contact" value="true" >';
                    echo "<p><h3>".$_POST[$var_project.'name']." (".$_POST[$var_project.'email'].") <br><strong>Votre demande a bien été prise en compte,</strong><br> vous serez contacté très prochainement.</h3></p>";
                    //echo '<a href="index.php#contact" class="button-1">Retour</a>';
                    echo '<input type="submit" value="RETOUR" id="button-ok" class="button-4" >'; //  disabled="disabled" // onclick="validForm()"
                    echo '</form>';
                }
                else // Sinon, on affiche un message d'erreur
                {
                    echo $count_contact_form;
                    if($count_contact_form > 0){
                        echo '<form name="contact-form" method="post" action="index.php#contact">';
                        echo '<p><h2>Vous êtes déjà inscrit : '.$count_contact_form.' fois</h2></p>';
                        echo '<input type="submit" value="RETOUR" id="button-ok" class="button-4" >'; //  disabled="disabled" // onclick="validForm()"
                        echo '</form>';
                    }else{
                        echo '<form name="contact-form" method="post" action="index.php#contact">';
                        echo '<p><h2>Demande incorrect</h2></p>';
                        echo '<input type="submit" value="RETOUR" id="button-ok" class="button-4" >'; //  disabled="disabled" // onclick="validForm()"
                        echo '</form>';
                    }
                }
                ?>
            </div>
		</section>
    </body>
</html>