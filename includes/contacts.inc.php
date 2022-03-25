<?php

    include_once "class-autoloader.inc.php";
    session_start();

    if(isset($_POST['addLogistics'])){

        $username01 = $_POST['username01'];
        $accountType01 = $_POST['accountType01'];
        $confirmAccount = 'Logistics';
        
        $username02 = $_POST['username02'];
        
        $obj = new Controller;
        
        $obj->contacts($username01, $username02, $accountType01, $confirmAccount);
        
    }else if(isset($_POST['addAffiliates'])){
        
        $username01 = $_POST['username01'];
        $accountType01 = $_POST['accountType01'];
        $confirmAccount = 'Affiliate';
        
        $username02 = $_POST['username02'];

        $obj = new Controller;
        
        $obj->contacts($username01, $username02, $accountType01, $confirmAccount);
    
    }else if(isset($_POST['addAgents'])){
        
        $username01 = $_POST['username01'];
        $accountType01 = $_POST['accountType01'];
        $confirmAccount = 'Agent';
        
        $username02 = $_POST['username02'];

        $obj = new Controller;
        
        $obj->contacts($username01, $username02, $accountType01, $confirmAccount);
    
    }else if(isset($_POST['removeContact'])){
        
        $username01 = $_POST['username01'];
        $accountType01 = $_POST['accountType01'];
        
        $username02 = $_POST['username02'];
        $accountType02 = $_POST['accountType02'];

        $obj = new Controller;
        
        $obj->removeContacts($username01, $accountType01, $username02, $accountType02);

    }else if(isset($_POST['confirmContact'])){
        
        $username01 = $_POST['username01'];
        $accountType01 = $_POST['accountType01'];
        
        $username02 = $_POST['username02'];
        $accountType02 = $_POST['accountType02'];

        $obj = new Controller;

        $obj->confirmContact($username01, $username02, $accountType01, $accountType02);

    }else if(isset($_POST['declineContact'])){
        
        $username01 = $_POST['username01'];
        $accountType01 = $_POST['accountType01'];
        
        $username02 = $_POST['username02'];
        $accountType02 = $_POST['accountType02'];

        $obj = new Controller;

        $obj->declineContact($username01, $accountType01, $username02, $accountType02);

    }else if(isset($_POST['resendContact'])){
        echo 'running';
        $username01 = $_POST['username01'];
        $accountType01 = $_POST['accountType01'];
        
        $username02 = $_POST['username02'];
        $accountType02 = $_POST['accountType02'];
        $confirmAccount = 'Logistics';

        $obj = new Controller;

        $obj->resendContacts($username01, $accountType01, $username02, $accountType02, $confirmAccount);

    }else{
        header("location: ../accountinfo.php");
    }

?>