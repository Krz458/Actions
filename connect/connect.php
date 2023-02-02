<?php

    require "dbconfig.php";

    try{
        $connect = new PDO($server_type.':host='.$db_host.';dbname='.$db_name, $db_username, $db_password);

    }catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    