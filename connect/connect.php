<?php

    require_once "dbconfig.php";
    //define('TEST', 'TEST');

    try{
        $connect = new PDO(SERVER_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);

    }catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    