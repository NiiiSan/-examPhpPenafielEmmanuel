<?php
    session_start();
    require_once 'functions/user-functions.php';
    $user = connectedUser();
?>
<html>
    <head>
        <?php include 'assets/stylesheet.php'?>
    </head>
    <body>
        <?php include 'menuUser.php'?>
        <h2> Tu es bel et bien connecté <b><?php echo($user['pseudo']);?></b> !</h2>
        <a href="logout.php">Se déconnecter!</a>
    </body>
</html>