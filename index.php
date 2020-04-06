<?php
    session_start();
    if($_SESSION['user']) {
        header('Location: homepageAdmin.php');
    } else {
        header('Location: login.php');
    }
?>
