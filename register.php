<?php

    require_once 'functions/user-functions.php';
    require_once 'pdo_connection.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $errors = validateFormUser();

        if(count($errors) == 0){
            $errors = addUser($pdo, $errors);
            if(count($errors) == 0){
                header('Location: login.php');
            }
        }
    }
?>

<html>
    <head>
        <?php include 'assets/stylesheet.php'?>
    </head>
    <body>
        <?php include 'menuUser.php'?>
        <h2>Créer un compte</h2>

        <form method="post">
            <input type="text" name="pseudo" required placeholder="pseudo"><br>
            <input type="email" name="mail" required placeholder="e-mail"><br>
            <input type="password" name="password" required placeholder="mot de passe"><br>
            <input type="file" name="avatar" placeholder="avatar"><br>
            <input type="submit">
        </form>

        <a href="login.php">Je viens de me souvenir de mon compte x)</a>

        <ul>
            <?php 
                if(isset($errors)){
                    if(count($errors)>0){
                        echo('<h2>Erreurs sur le formulaire :</h2>');
                        foreach ($errors as $error){
                            echo('<li>'.$error.'</li>');
                        }
                    } 
                }   
            ?>
        </ul>

    </body>
</html>