<?php 

function validateFormUser() {
    $errors = [];
    if(empty($_POST['pseudo'])){
        $errors[] = 'Il manque le pseudo';
    }
    if(empty($_POST['mail'])){
        $errors[] = 'Il manque l\'e_mail!';
    }
    if(empty($_POST['password'])){
        $errors[] = 'Il manque le mot de passe!';
    }
    return $errors;
}

function addUser($pdo, $errors){
    $errors = [];
    try{
        $req = $pdo->prepare(
            'INSERT INTO users(pseudo, mail, password, avatar)
            VALUES(:pseudo, :mail, :password, :avatar)');
        $req->execute([
            'pseudo' => $_POST['pseudo'],
            'mail' => $_POST['mail'],
            'password' =>  md5($_POST['password']),
            'avatar' =>$_POST['avatar']
            ]);
    } catch (PDOException $exception){
        if($exception->getCode() === '23000'){
            $errors[] = 'Pseudo ou e-mail déjà utilisé!';
        }
    }
    return $errors;
}

function login($pdo, $log, $password){
    $errors = [];
    try{
        $req = $pdo->prepare(
            'SELECT * FROM users WHERE (pseudo = :pseudo OR mail = :mail) AND password = :password');
        $req->execute([
            'pseudo' => $log,
            'mail' => $log,
            'password' =>  md5($password)
            ]);
    } catch (PDOException $exception){
        var_dump($exception);
        die();
    }
    $res = $req->fetch();
    if($res == false){
        $errors[] = 'On ne te connais pô!';
        session_destroy();
    } else {
        $_SESSION['user'] = $res;
    }
    return $errors;
}

function connectedUser(){
    if($_SESSION['user']){
        return $_SESSION['user'];
    } else {
        header('Location: login.php');
    }
}

?>