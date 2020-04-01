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
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <section id="main-image">
			<div class="wrapper">
                <?php
                if (isset($_POST['name']) AND isset($_POST['email'])) // Si le nom et l'email est renseigné
                {
                    // On affiche les informations
                    echo '<form name="contact-form" method="post" action="index.php#contact">'; //#contact
                    echo '<input type="hidden" id="name" name="name" value="'.$_POST['name'].'" >';
                    echo '<input type="hidden" id="email" name="email" value="'.$_POST['email'].'" >';
                    echo '<input type="hidden" id="contact" name="contact" value="true" >';
                    echo "<p><h3>".$_POST['name']." (".$_POST['email'].") <br><strong>Votre demande a bien été prise en compte,</strong><br> vous serez contacté très prochainement.</h3></p>";
                    //echo '<a href="index.php#contact" class="button-1">Retour</a>';
                    echo '<input type="submit" value="RETOUR" id="button-ok" class="button-4" >'; //  disabled="disabled" // onclick="validForm()"
                    echo '</form>';
                }
                else // Sinon, on affiche un message d'erreur
                {
                    echo '<p><h2>Demande incorrect</h2></p>';
                }
                ?>
            </div>
		</section>
    </body>
</html>