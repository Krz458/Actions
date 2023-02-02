<?php 
    session_start();

    function returnSite(){

        header('Location: admin-login-page.php');
        die();

    }

    if(isset($_SESSION['admin_login'])){

        unset($_SESSION['admin_login']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_logged']);
        returnSite();

    } else {

        returnSite();

    }