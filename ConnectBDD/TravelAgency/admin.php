<?php
session_start();
$session = session_id();
?>
<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>Page Administrateur</title>
  <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
  <link rel="stylesheet" href="css/bo_styles.css">
</head>
<body>
<!-- Form login / mdp -->
<div class="login-page">
  <div class="form">
    <h2>Espace administrateur</h2>
    <?php
    if(isset($_SESSION['login']) && isset($_SESSION['password'])){
      header('Location: list_contact.php');
      exit();
    }else{
      echo ('<form class="register-form" method="post" action="list_contact.php">
        <label for="name">Identifiant</label><sup><span style="color : red;">*</span></sup>
        <input type="text" name="name" placeholder="Entrer votre identifiant"/>
        <label for="password">Mot de passe</label><sup><span style="color : red;">*</span></sup>
        <input type="password" name="password" placeholder="Entrer votre mot de passe"/>
        <input type="hidden" name="session" value="'.$session.'"/>
        <label for="email">Courriel</label><sup><span style="color : red;">*</span></sup>
        <input type="text" name="email" placeholder="Entrer votre email"/>
        <button>Valider</button>
        <p class="message">Pas enregistré ? <a href="#">Connection</a></p>
      </form>
      <form class="login-form" method="post" action="list_contact.php">
        <label for="name">Identifiant</label><sup><span style="color : red;">*</span></sup>
        <input type="text" name="name" placeholder="Entrer votre identifiant"/>
        <label for="password">Mot de passe</label><sup><span style="color : red;">*</span></sup>
        <input type="password" name="password" placeholder="Entrer votre mot de passe"/>
        <input type="hidden" name="session" value="'.$session.'"/>
        <button>Valider</button>
        <!--<p class="message">Pas enregistré ? <a href="#">Créer un compte</a></p>-->
      </form>');
    }
    ?>
  </div>
</div>
<!-- optional for refresh Form -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="js/script.js"></script>-->

</body>
</html>
