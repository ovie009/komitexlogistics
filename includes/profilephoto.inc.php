<?php

    include_once "class-autoloader.inc.php";
    session_start();

    if(isset($_POST['uploadProfilePhoto'])){
        
        $email = $_POST['email'];
        $username = $_POST['username'];
        $photo = $_FILES['photo'];

        $obj = new Controller;
        
        $obj->uploadProfilePhoto($email, $username, $photo);
        
    } else if(isset($_POST['deleteProfilePhoto'])){
        
        $email = $_POST['email'];
        $defaultPhoto = 'icons/others/user.png';

        $obj = new Controller;
        
        $obj->deleteProfilePhoto($email, $defaultPhoto);
        
    }else{
        header("location: ../accountinfo.php");
    }

?>