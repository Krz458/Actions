<?php

    session_start();

    function set_error_message(String $type, String $option){
        switch($type){

            case 'email':
                switch($option){
                    case 'not_correct':
                        $_SESSION['bad_email'] = 'The email is not correct.';
                        break;

                    case 'email_exist':
                        $_SESSION['bad_email'] = 'The email is assigned to an exist account.';
                        break;
                }

            case 'login':
                switch($option){
                    case 'short':
                        $_SESSION['bad_r_login'] = 'The login is too short.';
                    break;

                    case 'long':
                        $_SESSION['bad_r_login'] = 'The login is too long.';
                    break;

                    case 'not_allow_char':
                        $_SESSION['bad_r_login'] = 'The login include not allowed characters.';
                    break;

                    case 'login_exist':
                        $_SESSION['bad_r_login'] = 'The login is assigned to an exist account.';
                        break;

                }
            break;

            case 'password':
                switch($option){
                    case 'short':
                        $_SESSION['bad_password'] = 'The password is too short.';
                    break;

                    case 'long':
                        $_SESSION['bad_password'] = 'The password is too long.';
                    break;

                    case 'easy':
                        $_SESSION['bad_password'] = 'The password is too easy (123..., qwerty...).';
                    break;

                }

            case 'avatar':
                switch($option){
                    case 'to_learge':
                        $_SESSION['bad_avatar'] = 'The file size is too learge';
                    break;

                    case 'upload_not_complete':
                        $_SESSION['bad_avatar'] = 'The file has not complete uploaded.';
                    break;

                    case 'no_upload':
                        $_SESSION['bad_avatar'] = 'The file is is not uploded.';
                    break;
                }
        }
    }

    function returnSite(){
        header("Location: ../login-field.php");
        die();
    }

    function check_email_err_messs(String $email){

        if(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){

            require '../connect/connect.php';
                    $query = $connect->prepare('SELECT * FROM users WHERE email = :email');
                    $query->bindValue(':email', $email);
                    $query->execute();

                    if ($query->rowCount() == 0){

                        return true;

                    } else {

                        set_error_message('email', 'email_exist');
                        return false;

                    }

        } else {

            set_error_message('email', 'not_correct');
            return false;

        }
    }

    function check_password_err_messs(String $password){

        if(strlen($password) >= 8){

            if(!(strlen($password) > 20)){

                return true;

            } else {

                set_error_message('password', 'long');
                return false;
            }
        } else {

            set_error_message('password', 'short');
            return false;
        }
    }

    function check_login_err_messs(String $login){
        if(strlen($login) >= 8){

            if(!(strlen($login) > 20)){

                if(ctype_alnum($login)){

                    require '../connect/connect.php';
                        $query = $connect->prepare('SELECT * FROM users WHERE login = :login');
                        $query->bindValue(':login', $login);
                        $query->execute();

                        if ($query->rowCount() == 0){

                            return true;

                        } else {

                            set_error_message('login', 'login_exist');
                            return false;

                        }

                } else {

                    set_error_message('login', 'not_allow_char');
                    return false;

                }

            } else {

                set_error_message('login', 'long');
                return false;

            }
        } else {

            set_error_message('login', 'short');
            return false;

        }
    }

    function hashPassword(String $password){
       return password_hash($password, PASSWORD_DEFAULT);
    }
    

    function create_account(){

        require '../connect/connect.php';
        
            $query = $connect->prepare('INSERT INTO `users` (`id`, `email`, `login`, `password`, `date`) VALUES (NULL, :email, :login, :password, :date)');
            $query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $query->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
            $query->bindValue(':password', hashPassword($_POST['password']));
            $query->bindValue(':date', date('Y-m-d'), PDO::PARAM_STR);
            $query->execute();

    }


    if(check_email_err_messs($_POST['email'])){

        if(check_password_err_messs($_POST['password'])){

            if(check_login_err_messs($_POST['login'])){
                include 'u_avatar.php';

                $userAvatar = new Avatar();

                if ($userAvatar->check_avatar_err_mess($_FILES['avatar']))
                    // if return true save avatar, if false not save the avatar, but create the account, if is error what is not 4, send error and not create account
                    $userAvatar->saveAvatar($_POST['login']);
                           
                    //require 'email-sender.php';
                    //$email = new EmailSender();
                    //$email->sendEmail($_POST['email']);
                    //echo $email->getEmail($_POST['email']);
                    create_account();
                    $_SESSION['created_account'] = 'Your account is properly created.';
                    returnSite();

                    // Add e-mail confirm system

            } else {

                returnSite();

            }

        } else {

            returnSite();

        }

    } else {

        returnSite();

    }

    
    //var_dump($_FILES['avatar']);
    /*
    check_avatar_err_mess($_FILES['avatar']);
    require 'u_avatar.php';
    $userAvatar = new Avatar();
    $userAvatar->check_avatar_err_mess($_FILES['avatar']);
    $userAvatar->saveAvatar($_POST['login']);
    */

    // avatar is not saving
    returnSite();

    //echo "current user:" .get_current_user ();

    //echo "script was executed under user:" .exec ('whoami');


