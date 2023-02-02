<?php

    session_start();
    if(!(isset($_SESSION['logged']))){
        header('Location: login-field.php');
        die();
    }
    $_SESSION['fromShowProfile'] = true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>your account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="contener">
        <p><a href="index.php">Index</a> | <a href="users-offers.php">show own announcements</a></p>
    
        <?php 
        
            require 'connect/connect.php';
            
            $query = $connect->prepare('SELECT email, login, date FROM users WHERE id=:id');
            $query->bindValue(':id', $_SESSION['user_id']);
            $query->execute();
            
            foreach($query as $row){

                print_r('<p>your e-mail: ' . $row[0] . ' | your login: ' . $row[1] . ' | the date your account was created: ' . $row[2] . '</p>');
            }

            echo '<br/><img src="login-serve/avatars/' . $_SESSION['user_login'] . '.png" class="avatar" width="64" height="64" alt="Your avatar is not available"/>';
            
            //echo ''
        ?>
        <br/><div class="border border-primary delete-account">
            <form action="login-serve/delete-account.php" method="post">
                <?php
                    if (isset($_SESSION['bad_password'])){
                        echo '<div class="bad">' . $_SESSION['bad_password'] . '</div>';
                        unset($_SESSION['bad_password']);}
                ?>
                
                <label for="password">password:</label> 
                <input class="enter-field" type="password" name="password" required>
                <input class="enter-field" type="submit" value="delete account">
            </form>
            </div>
    


</div>

</body>
</html>