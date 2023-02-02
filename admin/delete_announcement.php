<?php
    session_start();

    $id = $_GET['id'];

    require('../connect/connect.php');

    try{
        $query = $connect->prepare('DELETE FROM offers WHERE id=:id');
        $query->bindValue(':id', $id);
        $query->execute();
    } catch(PDOException $error) {
        print('Error: ' . $error->getMessage() . '<br/>');
        die();
    }

    $_SESSION['deleted_offer'] = true;
    header('Location: ../index.php');
    die();
