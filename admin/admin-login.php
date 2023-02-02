<?php

session_start();

    function returnSiteErrorMessage(){

        $_SESSION['bad'] = true;
        header("Location: admin-login-page.php");
        die();

    }

    function logout_user_account(){
        if (isset($_SESSION['logged'])){
            unset($_SESSION['logged']);
            unset($_SESSION['user_id']);
            unset($_SESSION['user_login']);
        }
    }

    if (isset($_SESSION['index'])){
        if ($_POST['login'] != "" and $_POST['password'] != ""){
            include '../connect/connect.php';

            $query = $connect->prepare('SELECT `id`, `login`, `password` FROM `admins` WHERE `login` = :login');
            $query->bindValue(':login', $_POST['login']);
            //$query->bindValue(':password', $_POST['password']);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($_POST['password'], $result['password'])){
            //if ($query->rowCount() != 0){
                $_SESSION['admin_id'] = $result['id'];
                $_SESSION['admin_login'] = $result['login'];
                logout_user_account();
                $_SESSION['admin_logged'] = true;
                header("Location: ../index.php");
                die();
                


                /*
            include '../connect/connect.php';

            

                $query = $connect->prepare('SELECT id, login FROM admins WHERE login = :login AND password = :password');
                $query->bindValue(':login', $_POST['login']);
                $query->bindValue(':password', $_POST['password']);
                $query->execute();

                if ($query->rowCount() != 0){
                    foreach($query as $row){  
                        $_SESSION['admin_id'] = $row[0];
                        $_SESSION['admin_login'] = $row[1];
                    }       
                    logout_user_account();
                    $_SESSION['admin_logged'] = true;
                    header("Location: ../index.php");
                    die();

                    //$_SESSION['admin_id'] = $query
                    //echo 'well';
                    //To extend
    */
            } else {

                returnSiteErrorMessage();
            }

        } else {

            returnSiteErrorMessage();
        }

    } else {

        header("Location: admin-login-field.php");
        die();
        
    }
    