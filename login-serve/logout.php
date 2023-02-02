<?php 
    session_start();

    function returnSite(){

        header('Location: ../login-field.php');
        die();

    }

    if(isset($_SESSION['user_login'])){

        unset($_SESSION['user_login']);
        unset($_SESSION['user_id']);
        unset($_SESSION['logged']);
        returnSite();

    } else {

        returnSite();

    }
    