<?php 
require_once('connect.php');
require_once('functions.php');
require_once('cookie.php');
// On démarre la session
session_start();
$session = session_id();
$token = generateToken();

if((isset($_SESSION[$var_project.'login']) && ($_SESSION[$var_project.'login'] == "admin"))  || (isset($_SESSION[$var_project.'login']) && ($_SESSION[$var_project.'login'] == "Admin")) ){ // destruction de la session pour les administrateurs 
    delCookie($var_project.'name');
    //delCookie($var_project.'login');
    //delCookie($var_project.'password');
    delCookie($var_project.'session');
    delCookie($var_project.'token');
    //session_destroy();
}

// On s'amuse à créer quelques variables de session dans $_SESSION
if(!isset($_SESSION[$var_project.'name'])){
    if(isset($_COOKIE[$var_project.'name'])){
        $_SESSION[$var_project.'name'] = $_COOKIE[$var_project.'name'];
    }else{
        $_SESSION[$var_project.'name'] = '';
        setcookie($var_project.'name', '' , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    }
}
if(!isset($_SESSION[$var_project.'email'])){
    if(isset($_COOKIE[$var_project.'email'])){
        $_SESSION[$var_project.'email'] = $_COOKIE[$var_project.'email'];
    }else{
        $_SESSION[$var_project.'email'] = '';
        setcookie($var_project.'email', '' , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    }
}
if(!isset($_SESSION[$var_project.'session'])){
    if(isset($_COOKIE[$var_project.'session'])){
        $_SESSION[$var_project.'session'] = $_COOKIE[$var_project.'session'];
    }else{
        $_SESSION[$var_project.'session'] = session_id();
        setcookie($var_project.'session', session_id() , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    }
}
if(!isset($_SESSION[$var_project.'token'])){
    if(isset($_COOKIE[$var_project.'token'])){
        $_SESSION[$var_project.'token'] = $_COOKIE[$var_project.'token'];
    }else{
        $_SESSION[$var_project.'token'] = generateToken();
        setcookie($var_project.'token', generateToken() , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    }
}

if (isset($_POST[$var_project.'name']) && isset($_POST[$var_project.'email']) && isset($_POST[$var_project.'contact']) && isset($_POST[$var_project.'session']) && isset($_POST[$var_project.'token'])) // Si le nom et l'email est renseigné + étape contact
{
    if($_POST[$var_project.'contact'] == "true"){
        $contact = true;
        $_SESSION[$var_project.'name'] = $name = $_POST[$var_project.'name'];
        $_SESSION[$var_project.'email'] = $email = $_POST[$var_project.'email'];
        $_SESSION[$var_project.'session'] = $session = $_POST[$var_project.'session'];
        $_SESSION[$var_project.'token'] = $token = $_POST[$var_project.'token'];

        setcookie($var_project.'name', $name , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
        setcookie($var_project.'email', $email , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
        setcookie($var_project.'session', $session , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
        setcookie($var_project.'token', $token , time() + 365*24*3600, null, null, false, true); // On écrit un cookie

    }else{
        $contact = false;
    }
}else{
    $contact = false;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="css/styles.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
        <title>Travel Agency</title>
    </head>
    
    <body>
        <header> 
            <div class="wrapper">
                <h1>Travel Agency<span class="orange">.</span></h1>
                <nav>
                    <ul>
                        <li><a href="#main-image">Accueil</a></li>
                        <li><a href="#steps">Destinations</a></li>
                        <li><a href="#possibilities">Circuits</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="admin.php">Administrateur</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        
        <section id="main-image">
			<div class="wrapper">
                <h2>Organisez votre<br><strong>voyage sur mesure</strong></h2>
                <a href="#" class="button-1">Par ici</a>
			</div>
		</section>
        
        <section id="steps">
             <div class="wrapper">
                 <ul>
                    <li id="step-1">
                        <h4>Planifier</h4>
                        <p>Confiez-nous vos rêves d’évasion : en famille ou entre amis, nous trouverons la formule qui comblera vos attentes.</p>
                     </li>
                     <li id="step-2">
                        <h4>Organiser</h4>
                        <p>Bénéficiez de l’expertise de nos spécialistes de chaque destination, ils vous accompagnent dans la réalisation de votre voyage.</p>
                     </li>
                     <li id="step-3">
                        <h4>Voyager</h4>
                        <p>Nous nous chargeons d’assurer votre sécurité et de veiller à votre pleine sérénité tout au long de votre voyage.</p>
                     </li>
                     <div class="clear"></div>
                 </ul>
            </div>
        </section>
        
       <section id="possibilities">
			<div class="wrapper">
                <article style="background-image: url(images/article-image-1.jpg);">
                    <div class="overlay">
                        <h4>Partez en famille</h4>
                        <p><small>Offrez le meilleur à ceux que vous aimez et partagez des moments fabuleux !</small></p>
                        <a href="#" class="button-2">Plus d'infos</a>
                    </div>
                </article>
                
                <article style="background-image: url(images/article-image-2.jpg);">
                    <div class="overlay">
                        <h4>Envie de s'evader</h4>
                        <p><small>Parfois un peu d'évasion serait le bienvenue et ferait le plus grand bien !</small></p>
                        <a href="#" class="button-2">Plus d'infos</a>
                    </div>
                </article>
                
                <div class="clear"></div>
                
			</div>
		</section>
        
        <section id="contact">
            <div class="wrapper">
                <?php 
                if( ($contact == true) || (isset($_COOKIE['name']) && isset($_COOKIE['email']) && isset($_COOKIE['session']) && isset($_COOKIE['token']) ) ){
                    echo ('<h3 id="contact-us">Déjà contacté</h3>
                    <p>Chez Travel Agency nous savons que voyager est une aventure humaine mais également un engagement financier important pour vous. C\'est pourquoi nous mettons un point d\'honneur à prendre en compte chacune de vos attentes pour vous aider dans la préparation de votre séjour, circuit ou voyage sur mesure.</p>
                    
                    <form name="contact-form" method="post" action="contact.php">
                        
                        <input type="hidden" id="name" name="'.$var_project.'name" value="$name">
                        
                        <input type="hidden" id="email" name="'.$var_project.'email" value="$email">
                        <input type="hidden" id="session" name="'.$var_project.'session" value="'.$session.'">
                        <input type="hidden" id="token" name="'.$var_project.'token" value="'.$token.'">
                        <input type="hidden" value="OK" id="button-ok" class="button-3"  disabled="disabled" > 
                    </form>');
                }else{
                    echo ('<h3 id="contact-us">Contactez-nous</h3>
                    <p>Chez Travel Agency nous savons que voyager est une aventure humaine mais également un engagement financier important pour vous. C\'est pourquoi nous mettons un point d\'honneur à prendre en compte chacune de vos attentes pour vous aider dans la préparation de votre séjour, circuit ou voyage sur mesure.</p>
                    
                    <form name="contact-form" method="post" action="contact.php">
                        <label for="'.$var_project.'name">Nom</label><sup><span style="color : red;">*</span></sup>
                        <input type="text" id="name" name="'.$var_project.'name" placeholder="Votre nom" onchange="checkInputName(this.value)">
                        <label for="'.$var_project.'email">Email</label><sup><span style="color : red">*</span></sup>
                        <input type="text" id="email" name="'.$var_project.'email" placeholder="Votre email" onchange="checkInputEmail(this.value)">
                        <input type="hidden" id="session" name="'.$var_project.'session" value="'.$session.'">
                        <input type="hidden" id="token" name="'.$var_project.'token" value="'.$token.'">
                        <input type="submit" value="OK" id="button-ok" class="button-3"  disabled="disabled"  onclick="validForm()"> 
                    </form>');
                }
                ?>
            </div>
        </section>
        
        
        <footer>
            <div class="wrapper">
                <h1>Travel Agency<span class="orange">.</span></h1>
                <div class="copyright">Copyright © Tous droits réservés.</div>
			</div>
        </footer>
        
        <script src="js/form.js"></script>
    
    </body>

</html>






