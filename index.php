<?php

    session_start();

    $_SESSION['o_index'] = true;

    function showUsersIndex() {
        echo '<!-- Offers -->';
        echo '<table class="table table-bordered">';
        echo'<tr><th class="table-dark">heading</th><th>price</th><th>date of issue</th><th>e-mail</th><th>category</th></tr>';

        require 'connect/connect.php';
            foreach($connect->query('SELECT offers.heading, offers.price, currencies.currency, offers.date, users.email, offers.id, category.category, category.id FROM offers, users, currencies, category WHERE offers.user_id = users.id AND currencies.id = offers.currency AND category.id = offers.category GROUP BY offers.id') as $row){
                    print_r ('<tr><td><a href="show-announcement.php?id=' . $row[5] . '">' . $row[0] . '</a>' . ' <img style="width:120px;" src="announcement/images/'. $row[5] . '.png" alt = " "/>' . '</td><td>' . $row[1] . " " . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td><td><a href="index.php?category_id=' . $row[7] . '">' . $row[6] . '</a></td></tr>');
            }
        echo '</table>';
    }

    function showUsersIndexCategory() {
        echo '<!-- Offers -->';
        echo '<table class="table table-bordered">';
        echo'<tr><th class="table-dark">heading</th><th>price</th><th>date of issue</th><th>e-mail</th><th>category</th></tr>';

        require 'connect/connect.php';
        $query = $connect->prepare('SELECT offers.heading, offers.price, currencies.currency, offers.date, users.email, offers.id, category.category FROM offers, users, currencies, category WHERE offers.user_id = users.id AND currencies.id = offers.currency AND category.id = offers.category AND offers.category = :categoryId');
        $query->bindValue(':categoryId', $_GET['category_id']);
        $query->execute();
            foreach($query as $row){
                    print_r ('<tr><td><a href="show-announcement.php?id=' . $row[5] . '">' . $row[0] . '</a>' . ' <img style="width:120px;" src="announcement/images/'. $row[5] . '.png" alt = " "/>' . '</td><td>' . $row[1] . " " . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td><td>' . $row[6] . '</td></tr>');
                    $title = 'Web shop - ' . $row['category'];
            }  
        echo '</table>';
    }

    function showAdminsIndex() {
        echo '<!-- Offers -->';
        echo '<table class="table table-bordered">';
        echo'<tr><th class="table-dark">heading</th><th>price</th><th>date of issue</th><th>e-mail</th><th>category</th><th>action</th></tr>';

        require 'connect/connect.php';
            foreach($connect->query('SELECT offers.heading, offers.price, currencies.currency, offers.date, users.email, offers.id, category.category, category.id FROM offers, users, currencies, category WHERE offers.user_id = users.id AND currencies.id = offers.currency AND category.id = offers.category GROUP BY offers.id') as $row){
                    print_r ('<tr><td><a href="show-announcement.php?id=' . $row[5] . '">' . $row[0] . '</a>' . ' <img style="width:120px;" src="announcement/images/'. $row[5] . '.png" alt = " "/>' . '</td><td>' . $row[1] . " " . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td><td><a href="index.php?category_id=' . $row[7] . '">' . $row[6] . '</a></td><td><a href="admin/delete_announcement.php?id=' . $row[5] . '"><button>delete</button></a></td></tr>');
            }
        echo '</table>';
    }

    function showAdminIndexCategory() {
        echo '<!-- Offers -->';
        echo '<table class="table table-bordered">';
        echo'<tr><th class="table-dark">heading</th><th>price</th><th>date of issue</th><th>e-mail</th><th>category</th><th>action</th></tr>';

        require 'connect/connect.php';
        $query = $connect->prepare('SELECT offers.heading, offers.price, currencies.currency, offers.date, users.email, offers.id, category.category FROM offers, users, currencies, category WHERE offers.user_id = users.id AND currencies.id = offers.currency AND category.id = offers.category AND offers.category = :categoryId');
        $query->bindValue(':categoryId', $_GET['category_id']);
        $query->execute();
            foreach($query as $row){
                    print_r ('<tr><td><a href="show-announcement.php?id=' . $row[5] . '">' . $row[0] . '</a>' . ' <img style="width:120px;" src="announcement/images/'. $row[5] . '.png" alt = " "/>' . '</td><td>' . $row[1] . " " . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td><td>' . $row[6] . '</td><td><a href="admin/delete_announcement.php?id=' . $row[5] . '"><button>delete</button></a></td></tr>');
                    $title = 'Web shop - ' . $row['category'];
            }  
        echo '</table>';
    }

    function showUserInformation(){
        if (isset($_SESSION['logged'])){
           echo '<p><a href="index.php">index</a> | <a href="show-profile.php">your profile info</a> | <a href="users-offers.php">show own announcements</a></p>';
        } else {
            echo '<p><a href="index.php">index</a> | <a href="login-field.php">login</a>';
        }
        if (isset($_SESSION['user_login'])){
            echo '<p><div class="show-login">You are logged as ' . $_SESSION['user_login'] . '. <a href="login-serve/logout.php">Logout</a>.</div></p>';
        }
        if (isset($_SESSION['logged'])){
            echo '<p><a href="u_add_anno.php">add announcement</a></p>';
        }
        if (isset($_SESSION['added_announcement'])){
            echo '<div class="entered-announcement"><p>Your announcement is correct added.</p></div>';
            unset($_SESSION['added_announcement']);
        }
        if (isset($_SESSION['deleted_offer'])){
            echo '<p class="entered-announcement">You deleted this your announcement.</p>';
            unset($_SESSION['deleted_offer']);
        }

            include 'connect/connect.php';

            $query = $connect->query('SELECT category.id, category.category FROM category');
            echo '<table class="table table-bordered"><tr>';
            foreach ($query as $row){
                echo  '<td><a href="index.php?category_id=' . $row[0] . '">' . $row[1] . '</a></td>';
            }
            echo '</tr></table>';

    }
    
    /*
    function showCategoryUserInformation(){
        if (isset($_SESSION['logged'])){
           echo '<p><a href="show-profile.php">your profile info</a> | <a href="users-offers.php">show own announcements</a></p>';
        } else {
            echo '<p><a href="login-field.php">login</a>';
        }

        if (isset($_SESSION['user_login'])){
            echo '<p><div class="show-login">You are logged as ' . $_SESSION['user_login'] . '. <a href="login-serve/logout.php">Logout</a>.</div></p>';
        }

        if (isset($_SESSION['logged'])){
            echo '<p><a href="u_add_anno.php">add announcement</a></p>';
        }
        
        if (isset($_SESSION['added_announcement'])){
            echo '<div class="entered-announcement"><p>Your announcement is correct added.</p></div>';
            unset($_SESSION['added_announcement']);
        }
        if (isset($_SESSION['deleted_offer'])){
            echo '<p class="entered-announcement">You deleted this your announcement.</p>';
            unset($_SESSION['deleted_offer']);
        }
    }
    */

    function showAdminInformation(){
        echo '<p><a href="index.php">index</a> | <a href="admin/admin-login-page.php">admin login page</a></p>';
        echo '<p><div class="show-login">You are logged as ' . $_SESSION['admin_login'] . '(admin). <a href="admin/admin-logout.php">Logout</a>.</div></p>';
        if (isset($_SESSION['deleted_offer'])){
            echo '<p class="entered-announcement">You deleted this announcement.</p>';
            unset($_SESSION['deleted_offer']);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php

            function getCategoryName(){
                include 'connect/connect.php';
        
                $query = $connect->prepare('SELECT category FROM category WHERE category.id = :categoryId');
                $query->bindValue(':categoryId', $_GET['category_id']);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return ' - ' . $result['category'];
            }

            if (isset ($_GET['category_id'])){
                echo 'Web shop' . getCategoryName() . ' (category)';
            } else {
                echo 'Web shop';
            }

         ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <div id="contener">
    
        <?php
            
            if (isset($_SESSION['admin_logged'])){             
                if (isset($_GET['category_id'])){
                    showAdminInformation();
                    showAdminIndexCategory();
                } else {
                    showAdminInformation();
                    showAdminsIndex();
                }
            } elseif (isset($_GET['category_id'])) {
                showUserInformation();
                showUsersIndexCategory();
            } else {
                showUserInformation();
                showUsersIndex();
            }
        ?>

    </div>
</body>
</html>