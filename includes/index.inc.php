<?php
    include_once "class-autoloader.inc.php";
    session_start();

    if(isset($_POST['cancelOrder'])){

        if (empty($_POST['id'])) {
            # code...
            echo 'emptyFields';
        } else {
            # code...
            $id = $_POST['id'];

            $obj = new Controller;

            $obj->cancelOrder($id);
        }
        
        
    } else if(isset($_POST['enterFeedback'])){ 
        
        
        if (empty($_POST['id']) || empty($_POST['feedback'])) {
            # code...
            echo 'emptyFields';
            //header("location: ../index.php?emptyFields");
        } else {
            # code...
            $id = $_POST['id'];
            $feedback = $_POST['feedback'];

            $obj = new Controller;

            $obj->enterFeedback($id, $feedback);
        }
        
    } else if(isset($_POST['enterRescheduleDate'])){ 
        
        
        if (empty($_POST['id']) || empty($_POST['rescheduleDate'])) {
            # code...
            echo 'emptyFields';
            //header("location: ../index.php?emptyFields");
        } else {
            # code...
            $id = $_POST['id'];
            $rescheduleDate = $_POST['rescheduleDate'];

            $obj = new Controller;

            $obj->enterRescheduleDate($id, $rescheduleDate);
        }
        
    } else if(isset($_POST['takeOrder'])){ 
        
        
        if (empty($_POST['id']) || empty($_POST['username'])) {
            # code...
            echo 'emptyFields';
            //header("location: ../index.php?emptyFields");
        } else {
            # code...
            $id = $_POST['id'];
            $username = $_POST['username'];

            $obj = new Controller;

            $obj->takeOrder($id, $username);
        }
        
        
    }else{
        header("location: ../index.php");
    }

?>