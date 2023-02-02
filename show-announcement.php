<?php

    session_start();

    $offer_id = $_GET['id'];

            require 'connect/connect.php';
            try{
                $query = $connect->prepare('SELECT offers.contents, offers.price, currencies.currency, offers.date, users.email, offers.heading, category.category FROM offers, users, currencies, category WHERE offers.id = :id AND offers.currency = currencies.id AND category.id = offers.category');
                $query->bindValue(':id', $offer_id, PDO::PARAM_INT);
                $query->execute();

                //var_dump($query);
                foreach($query as $row){
                        $elements['email'] = $row[4];
                        $elements['content'] = $row[0];
                        $elements['price'] = $row[1] . ' ' . $row[2];
                        $elements['date'] = $row[3];
                        $elements['heading'] = $row[5];
                        $elements['category'] = $row[6];
                        //print_r ($row[5] . '">' . $row[0] . '</a></td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td></tr>');
                }
            } catch (PDOException $error) {
                print "Error!: " . $error->getMessage() . "<br/>";
            }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Web show - ' . $elements['heading'];  ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <div id="contener">
        <div>
            <?= isset($_SESSION['logged']) ? '<p><a href="index.php">index</a> | <a href="show-profile.php">your profile info</a> | <a href="users-offers.php">show own announcements</a></p>' : '<p><a href="index.php">index</a> | <a href="login-field.php">login</a></p>' ?>
            <?= isset($_SESSION['user_login']) ? '<p><div class="show-login">You are logged as ' . $_SESSION['user_login'] . '. <a href="login-serve/logout.php">Logout</a>.</div></p>' : '' ?>
        </div>
        <div>
            <div class="offer-left border border-primary"><?php echo $elements['heading']; ?></div>            <div class="offer-right border border-primary"><?php echo $elements['email']; ?></div>
            <div class="offer-left border border-primary"><?php echo $elements['content']; ?></div>            <div class="offer-right border border-primary" style="margin-top: 0px"><?php echo $elements['price']; ?></div>
            <div style="margin-bottom:5px; margin-top:3px" class="offer-left border border-primary"><i><img style="width:398px;" src="announcement/images/<?php echo $offer_id ?>.png" alt = "no any photos"/></i></div>   <div style="margin-bottom:5px; margin-top:3px" class="offer-right border border-primary" style="margin-top: 0px"><?php echo $elements['category']; ?></div>
        </div>    
    </div>
</body>
</html>