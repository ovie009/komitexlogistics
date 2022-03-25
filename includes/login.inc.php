<?php
    include_once "class-autoloader.inc.php";
    session_start();
    
    // print_r($_POST);

    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $password = $_POST['password'];
        if(empty($user) || empty($password)){
            header("location: ../index.php?emptyFields");
            exit;
        }else if(!empty($user) && !empty($password)){
            
            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // echo 'yes!';    
            $obj = new Controller;
            
            $obj->login($user, $password);

        }

    }else{
        // echo 'dunno';
        header("location: ../index.php");
    }


?>