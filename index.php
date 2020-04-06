<?php
    session_start();
    if($_SESSION['user']) {
        header('Location: homepageUser.php');
    } else {
        header('Location: login.php');
    }
?>
