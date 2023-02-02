<?php
    function deleteOffers(){
        require '../connect/connect.php';

        $query = $connect->prepare('DELETE FROM offers WHERE user_id=:id');
        $query->bindValue(':id', $_SESSION['user_id']);
        $query->execute();
    }
    function deleteAccount(){
        require '../connect/connect.php';

        $query = $connect->prepare('DELETE FROM users WHERE id=:id');
        $query->bindValue(':id', $_SESSION['user_id']);
        $query->execute();
    }
    session_start();
    if(!isset( $_SESSION['fromShowProfile'])){
        header('Location: ../login-field.php');
        die();
    } else {
        unset($_SESSION['fromShowProfile']);
    } 
    if ($_POST['password'] != ""){
        require '../connect/connect.php';

        $query = $connect->prepare('SELECT `id`, `login`, `password` FROM `users` WHERE `login` = :login');
        $query->bindValue(':login', $_SESSION['user_login']);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (password_verify($_POST['password'], $result['password'])){
            deleteOffers();
            deleteAccount();
            session_unset();
            session_start();
            $_SESSION['deletedAccount'] = "Your account is deleted";
            header('Location: ../show-profile.php');
            die();
        } else {
            $_SESSION['bad_password'] = "password isn't correct";
            header('Location: ../show-profile.php');
            die();
        }
    } else {
        $_SESSION['bad_password'] = "password is empty";
        header('Location: ../show-profile.php');
        die();
    }
