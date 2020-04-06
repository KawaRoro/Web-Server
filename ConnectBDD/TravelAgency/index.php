
<?php 
// On démarre la session
session_start();
$session = session_id();
include('cookie.php');

if((isset($_SESSION['name']) && ($_SESSION['name'] == "Schoenmaeker"))  || (isset($_SESSION['name']) && ($_SESSION['name'] == "Khalil")) ){ // destruction de la session pour les administrateurs 
    delCookie("name");
    delCookie("email");
    delCookie("session");
    //session_destroy();
}

// On s'amuse à créer quelques variables de session dans $_SESSION
if(!isset($_SESSION['name'])){
    if(isset($_COOKIE['name'])){
        $_SESSION['name'] = $_COOKIE['name'];
    }else{
        $_SESSION['name'] = '';
        setcookie('name', '' , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    }
}
if(!isset($_SESSION['email'])){
    if(isset($_COOKIE['email'])){
        $_SESSION['email'] = $_COOKIE['email'];
    }else{
        $_SESSION['email'] = '';
        setcookie('email', '' , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    }
}
if(!isset($_SESSION['session'])){
    if(isset($_COOKIE['session'])){
        $_SESSION['session'] = $_COOKIE['session'];
    }else{
        $_SESSION['session'] = session_id();
        setcookie('session', session_id() , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    }
}

if (isset($_POST['name']) AND isset($_POST['email']) AND isset($_POST['contact'])) // Si le nom et l'email est renseigné + étape contact
{
    if($_POST['contact'] == "true"){
        $contact = true;
        $_SESSION['name'] = $name = $_POST['name'];
        $_SESSION['email'] = $email = $_POST['email'];

        setcookie('name', $name , time() + 365*24*3600, null, null, false, true); // On écrit un cookie
        setcookie('email', $email , time() + 365*24*3600, null, null, false, true); // On écrit un cookie

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
                if( ($contact == true) || (isset($_COOKIE['name']) && isset($_COOKIE['email']) && isset($_COOKIE['session'])) ){
                    echo ('<h3 id="contact-us">Déjà contacté</h3>
                    <p>Chez Travel Agency nous savons que voyager est une aventure humaine mais également un engagement financier important pour vous. C\'est pourquoi nous mettons un point d\'honneur à prendre en compte chacune de vos attentes pour vous aider dans la préparation de votre séjour, circuit ou voyage sur mesure.</p>
                    
                    <form name="contact-form" method="post" action="contact.php">
                        
                        <input type="hidden" id="name" name="name" value="$name">
                        
                        <input type="hidden" id="email" name="email" value="$email">
                        <input type="hidden" id="session" name="session" value="$session">
                        <input type="hidden" value="OK" id="button-ok" class="button-3"  disabled="disabled" > 
                    </form>');
                }else{
                    echo ('<h3 id="contact-us">Contactez-nous</h3>
                    <p>Chez Travel Agency nous savons que voyager est une aventure humaine mais également un engagement financier important pour vous. C\'est pourquoi nous mettons un point d\'honneur à prendre en compte chacune de vos attentes pour vous aider dans la préparation de votre séjour, circuit ou voyage sur mesure.</p>
                    
                    <form name="contact-form" method="post" action="contact.php">
                        <label for="name">Nom</label><sup><span style="color : red;">*</span></sup>
                        <input type="text" id="name" name="name" placeholder="Votre nom" onchange="checkInputName(this.value)">
                        <label for="email">Email</label><sup><span style="color : red">*</span></sup>
                        <input type="text" id="email" name="email" placeholder="Votre email" onchange="checkInputEmail(this.value)">
                        <input type="hidden" id="session" name="session" value="'.$session.'">
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






