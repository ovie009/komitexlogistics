<?php
    include_once "class-autoloader.inc.php";
    session_start();

    if(isset($_POST['accountType'])){
        
        $account = $_POST['accountType'];
        $email = $_POST['email'];
        if (empty($account)) {
            # code...
        }else if ($account == 'Affiliate' || $account == 'Agent' || $account == 'Logistics' || $account == 'Merchant') {
            # code...
            $obj = new Controller;

            $obj->accountType($account, $email);
        
        }else{
            header("location: ../index.php?Error");
        }

        


    }else{
        header("location: ../index.php?Empty");
    }

?>