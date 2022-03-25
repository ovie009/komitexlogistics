<?php
    include_once "class-autoloader.inc.php";
    session_start();

    if(isset($_POST['signup'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $Rpassword = $_POST['Rpassword'];

        if(empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($Rpassword)){
            
            echo 'emptyFields';
            exit();

        }else if(!preg_match("/^[a-zA-Z \s]*$/", $fullname)) {
            
            echo 'invalidName';
            exit();

        }else if (!preg_match("/^[0-9 -+]*$/", $phone)) {
            
            echo 'invalidPhone';
            exit();
            
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            echo 'invalidEmail';
            exit();

        }else if( $password !== $Rpassword) {
            
            echo 'differentPassword';
            exit();

        }else{
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $obj = new Controller;
            
            $obj->signup($fullname, $username, $email, $phone, $hashedPassword);

        }

    }else{
        header("location: ../index.php");
    }



?>