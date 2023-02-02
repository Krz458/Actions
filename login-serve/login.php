<?php

session_start();

    function returnSiteErrorMessage(){

        $_SESSION['bad'] = true;
        header("Location: ../login-field.php");
        die();

    }

    function logoutFromAdminAccount(){
        if (isset($_SESSION['admin_logged'])){
            unset($_SESSION['admin_login']);
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_logged']);
        }
    }

    if (isset($_SESSION['index'])){
        if ($_POST['login'] != "" and $_POST['password'] != ""){
            include '../connect/connect.php';

            $query = $connect->prepare('SELECT `id`, `login`, `password` FROM `users` WHERE `login` = :login');
            $query->bindValue(':login', $_POST['login']);
            //$query->bindValue(':password', $_POST['password']);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($_POST['password'], $result['password'])){
            //if ($query->rowCount() != 0){
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_login'] = $result['login'];
                $_SESSION['logged'] = true;
                logoutFromAdminAccount();
                header("Location: ../index.php");
                die();

                //$_SESSION['user_id'] = $query
                //echo 'well';
                //To extend

            } else {

                returnSiteErrorMessage();
            }

        } else {

            returnSiteErrorMessage();
        }

    } else {

        header("Location: ../login-field.php");
        die();
        
    }
    