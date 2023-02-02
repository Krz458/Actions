<?php

    session_start();
    //print_r($_SESSION);

    $_SESSION['index'] = true;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login field</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="contener">
    <p><a href="index.php">index</a><?= isset($_SESSION['logged']) ?  ' | <a href="show-profile.php">your profile info</a>' : '' ?></p>
    <?= isset($_SESSION['user_login']) ? '<p><div class="show-login">You are logged as ' . $_SESSION['user_login'] . '. <a href="login-serve/logout.php">Logout</a>.</div></p>' : '' ?>
    <?= isset($_SESSION['created_account']) ? '<p><div class="show-login">' . $_SESSION['created_account'] . '</div></p>' : '' ?>
    <?php unset($_SESSION['created_account']); ?>
    
    <div>
    <h1>login:</h1><br/><br/>
    <form action="login-serve/login.php" method="post">
        <?= isset($_SESSION['bad']) ? '<div class="bad">The bad login dates.</div>' : '' ?>
        <?php unset($_SESSION['bad']); ?>
        <label for="login">login:</label> 
        <input class="enter-field" type="text" name="login" required><br>
        
        <label for="password">password:</label>
        <input class="enter-field" type="password" name="password" required><br>
        <input class="enter-field" type="submit" value="login">
    </form>
    </div>

    <br/><br/><br/>
    <hr/>


    <h1>register:</h1><br/><br/>
    <form enctype="multipart/form-data" action="login-serve/register-user.php" method="post">
        <?php
            if (isset($_SESSION['bad_r_login'])){
                echo '<div class="bad">' . $_SESSION['bad_r_login'] . '</div>';
                unset($_SESSION['bad_r_login']);
            } else if (isset($_SESSION['deletedAccount'])){
                echo '<div class="bad">' . $_SESSION['deletedAccount'] . '</div>';
                unset($_SESSION['deletedAccount']);
            }
        ?> 
        
        <label for="login">login:</label> 
        <input class="enter-field" type="text" name="login" required><br>

        <?php
            if (isset($_SESSION['bad_password'])){
                echo '<div class="bad">' . $_SESSION['bad_password'] . '</div>';
                unset($_SESSION['bad_password']);}
        ?>
        <label for="password">password:</label> 
        <input class="enter-field" type="password" name="password" required><br>

        <?php
            if (isset($_SESSION['bad_email'])){
                echo '<div class="bad">' . $_SESSION['bad_email'] . '</div>';
                unset($_SESSION['bad_email']);}
        ?>
        <label for="email">e-mail:</label> 
        <input class="enter-field" type="email" name="email" required><br>

        <?php
            if (isset($_SESSION['bad_avatar'])){
                echo '<div class="bad">' . $_SESSION['bad_avatar'] . '</div>';
                unset($_SESSION['bad_avatar']);}
        ?>
        <label for="avatar">avatar (optional):</label> 
        <input type="hidden" name="MAX_FILE_SIZE" value="512000"/>
        <input class="enter-field" type="file" name="avatar"><br>

        <hr/>
        <input type="submit" value="register">
    </form>

    <br/>

</div>

</body>
</html>