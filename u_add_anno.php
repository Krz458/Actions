<?php

    session_start();

    if (!isset($_SESSION['logged'])){
        header('Location: login-field.php');
    }    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web shop - add announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <div id="contener">
    <p><a href="login-field.php">login</a><?= isset($_SESSION['logged']) ?  ' | <a href="show-profile.php">your profile info</a>' : '' ?></p>
    <?= isset($_SESSION['user_login']) ? '<p><div class="show-login">You are logged as ' . $_SESSION['user_login'] . '. <a href="login-serve/logout.php">Logout</a>.</div></p>' : '' ?>
    <p><a href="index.php">index</a></p>

        <div>
        <?php
            if (isset($_SESSION['added_announcement'])){
                echo  '<div class="entered-announcement"><p>Your announcement is correct added.</p></div>';
                unset($_SESSION['added_announcement']);
            }
         ?>
        <form enctype="multipart/form-data" action="announcement/add-announcement.php" method="post">

        <?php

            if(isset($_SESSION['o_bad_heading'])){
                echo '<div class="bad">' . $_SESSION['o_bad_heading'] . '</div>';
                unset($_SESSION['o_bad_heading']);
            }

        ?>
            <label for="heading">heading:</label>
            <input class="enter-field" type="text" name="heading" required><br>


        <?php

            if(isset($_SESSION['o_bad_contents'])){
                echo '<div class="bad">' . $_SESSION['o_bad_contents'] . '</div>';
                unset($_SESSION['o_bad_contents']);
            }

        ?>
            <label for="contents">contents:</label>
            <input class="enter-field" type="text" name="contents" required><br>
            
        <?= isset($_SESSION['bad_avatar']) ? '<div class="bad">' . $_SESSION['bad_avatar'] . '</div>' : '' ?>
        <?php unset($_SESSION['bad_avatar']); ?>
            <label for="image">image (optional):</label> 
            <input type="hidden" name="MAX_FILE_SIZE" value="512000"/>
            <input class="enter-field" type="file" name="image"><br>
        <?php

            if(isset($_SESSION['o_bad_price'])){
                echo '<div class="bad">' . $_SESSION['o_bad_price'] . '</div>';
                unset($_SESSION['o_bad_price']);
            }

        ?>
            <label for="price">price:</label>
            <input class="enter-field" type="number" step="0.01" name="price" required><br>
            <label for="currency">currency:</label>
            <select id="currency" name="currency">
        <?php

            require 'connect/connect.php';

            $query = $connect->query('SELECT currency, id FROM currencies');
            foreach ($query as $row){
                echo '<option value="' . $row[1] . '">' . $row[0] . '</option>';
            }

        ?>
            </select>
            <br/>
            <label for="category">category:</label>
            <select id="category" name="category">

        <?php

            require 'connect/connect.php';

            $query = $connect->query('SELECT category.id, category.category FROM category');
            foreach ($query as $row){
                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
            }

        ?>

            </select>
            

            <input class="enter-field" type="submit" value="add announcement">

        </form>
        </div>
</body>
</html>