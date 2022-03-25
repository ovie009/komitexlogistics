<?php
    include_once "class-autoloader.inc.php";
    session_start();

    if(isset($_POST['addLocation'])){
        $username = $_POST['username'];
        $location = $_POST['location'];
        $price = $_POST['price'];

        if(empty($location) || empty($location)){
            header("location: ../accountinfo.php?emptyFields");
            exit;

        }else{
            
            $obj = new Controller;
            
            $obj->addLocation($username, $location, $price);

        }

    } else if(isset($_POST['editLocation'])){
        $username = $_POST['username'];
        $location = $_POST['location'];
        $price = $_POST['price'];

        if(empty($location) || empty($location)){
            header("location: ../accountinfo.php?emptyFields");
            exit;

        }else{
            
            $obj = new Controller;
            
            $obj->editLocation($username, $location, $price);

        }

    }else{
        header("location: ../index.php");
    }

?>