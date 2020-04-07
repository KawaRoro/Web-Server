<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <style><?php include("css/styles.css"); ?></style>
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
        <title>Contact Travel Agency</title>
    </head>
    <body>
        <h1>Travel Agency<span class="orange">.</span></h1>
        <?php
        echo "<p><h3>".$_GET['name']." (".$_GET['email'].") <br><strong>Votre demande a bien été prise en compte,</strong><br> vous serez contacté très prochainement.</h3></p>";
        ?>
    </body>
</html>