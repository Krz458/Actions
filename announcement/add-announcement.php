<?php

    session_start();
    
    function returnSite(){

        $_SESSION['o_index'] = false;
        header("Location: ../u_add_anno.php");
        die();

    }

    function isFromIndex(){
        if(isset($_SESSION['o_index'])){

            unset($_SESSION['o_index']);
            return true;
    
        } else {
    
            return false;
    
        }
    } 

    function isLogged(){

        if(isset($_SESSION['logged'])){

            return true;

        } else {

            $_SESSION['o_bad_contents'] = "You are not logged.";
            return false;

        }

    }

    function validateContentsErr(String $contents){

        if(!(empty($contents))){

            if (!(filter_var($contents, FILTER_VALIDATE_URL))){
        
                return true;
                    
            } else {
    
                $_SESSION['o_bad_contents'] = "Your text contained a link.";
                return false;
    
            }

        } else {

            $_SESSION['o_bad_contents'] = "Your text was empty.";
            return false;

        }

        
    }

    function validateHeadingErr(String $heading){

        if(!(empty($heading))){
            if (strlen($heading) <= 30){

                if (!(filter_var($heading, FILTER_VALIDATE_URL))){
        
                    return true;

                } else {
                
                    $_SESSION['o_bad_heading'] = "Your heading contained a link.";
                    return false;
                
                }
            } else {
                $_SESSION['o_bad_heading'] = "Your heading was too long.";
                return false;
            }

        } else {

            $_SESSION['o_bad_heading'] = "Your heading was empty.";
            return false;

        }

        
    }

    function validatePriceErr(String $price){

        if(!(empty($price))){

            if (filter_var($price, FILTER_VALIDATE_FLOAT)){
        
                if (strlen($price) <= 10){
                    $second = $price[strlen($price)-2]; 
                    $third = $price[strlen($price)-3];
                    $contains = str_contains($price, '.'); 
                    if ($second == '.' or $third == '.' or !$contains){
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    $_SESSION['o_bad_price'] = 'Your value is too long';
                    return false;
                }
                    
            } else {
    
                $_SESSION['o_bad_price'] = "Your value is not a number";
                return false;
    
            }

        } else {

            $_SESSION['o_bad_price'] = "You did not enter any price.";
            return false;

        }

        
    }

    function validateCategory($value){
        include '../connect/connect.php';

        $query = $connect->query('SELECT category.id FROM category');
        $result = $query->fetchAll();
        foreach ($result as $row){
            if ($value == $row[0])
            return true;
        }
        return false;
        
    }

    function getUserEmail(){

        //Issue
        try{

            require 'connect/connect.php';

            $query = $connect->prepare('SELECT email FROM users WHERE id = :id');
            $query->bindValue(':id', $_POST['user_id']);
            $query->execute();

            foreach($query as $row){

                return $row[0];

            }

        } catch (PDOException $e) {

            print "Error!: " . $e->getMessage() . "<br/>";
            die();

        }
    }

    function enterAnnouncement(){

        require '../connect/connect.php';

            if(isset($_SESSION['user_id']))
                $user_id = $_SESSION['user_id'];
            else
                $user_id = 0;

            try{

                $query = $connect->prepare('INSERT INTO `offers` (`id`, `user_id`, `heading`, `contents`, `price`, `currency`, `date`, `category`) VALUES (NULL, :user_id, :heading, :contents, :price, :currency, :date, :category)');

                $query->bindValue(':user_id', $user_id, PDO::PARAM_STR);
                $query->bindValue(':contents', $_POST['contents'], PDO::PARAM_STR);
                $query->bindValue(':heading', $_POST['heading'], PDO::PARAM_STR);
                $query->bindValue(':price', $_POST['price'], PDO::PARAM_STR);
                $query->bindValue(':currency', $_POST['currency'], PDO::PARAM_STR);
                $query->bindValue(':date', date('Y-m-d'), PDO::PARAM_STR);
                $query->bindValue(':category', $_POST['category'], PDO::PARAM_STR);
                $query->execute();

            } catch (PDOException $e) {

                print "Error!: " . $e->getMessage() . "<br/>";
                die();

            }
    }

    function getAnnouncementId(){
        include '../connect/connect.php';
            $query = $connect->prepare('SELECT MAX(offers.id) FROM offers WHERE offers.user_id = :u_id');
            $query->bindValue(':u_id', $_SESSION['user_id']);
            $query->execute();
            $result = $query->fetch();
            return $result[0];
    }


    if(isFromIndex()){

        if(validateContentsErr($_POST['contents'])){

            if(isLogged()){

                if(validatePriceErr($_POST['price'])){
                    if (validateHeadingErr($_POST['heading'])){
                        if (validateCategory($_POST['category'])){
                            enterAnnouncement();
                            include 'image_save.php';
                            
                            $image = new ImageSave;
                            if ($image->check_image_err_mess($_FILES['image'])){
                                $image->saveImage(getAnnouncementId());
                            }
                            $_SESSION['added_announcement'] = true;
                            returnSite();
                        } else {
                            returnSite();
                        }
                    } else {
                    returnSite();
                    }
                } else {

                    returnSite();

                }

            } else {

                returnSite();

            }

        } else {

            returnSite();

        }

    } else {

        returnSite();

    }
