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
    <title>admin login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<div id="contener">
    <p><a href="../index.php">index</a></p>
    <?= isset($_SESSION['admin_login']) ? '<p><div class="show-login">You are logged as ' . $_SESSION['admin_login'] . '(admin). <a href="admin-logout.php">Logout</a>.</div></p>' : '' ?>
    <?= isset($_SESSION['created_account']) ? '<p><div class="show-login">' . $_SESSION['created_account'] . '</div></p>' : '' ?>
    <?php unset($_SESSION['created_account']); ?>
    
    <div>
    <h1 style="color: red">admin login:</h1><br/><br/>
    <form action="admin-login.php" method="post">
        <?= isset($_SESSION['bad']) ? '<div class="bad">The bad login dates.</div>' : '' ?>
        <?php unset($_SESSION['bad']); ?>
        <label for="login">login:</label> 
        <input class="enter-field" type="text" name="login" required><br>
        
        <label for="password">password:</label>
        <input class="enter-field" type="password" name="password" required><br>
        <input class="enter-field" type="submit" value="Login">
    </form>
    </div>
</div>

</body>
</html>