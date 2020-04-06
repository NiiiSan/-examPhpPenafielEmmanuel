<?php
    session_start();

    require_once 'functions/user-functions.php';
    require_once 'pdo_connection.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $errors = login($pdo, $_POST['log'], $_POST['password']);
        if(empty($errors)){ 
            header('Location: homepageUser.php');
        }
    }
?>

<html>
    <head>
        <?php include 'assets/stylesheet.php'?>
    </head>
    <body>
        <?php include 'menuUser.php'?>
        <h2> Se Connecter </h2>

        <form method="post">
            <input type="text" name="log"  placeholder="pseudo ou e-mail">
            <input type="password" name="password" required placeholder="mot de passe">
            <input type="submit">
        </form>

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