<?php
    include_once "class-autoloader.inc.php";
    session_start();

    if(isset($_POST['submitOrder'])){

        if (empty($_POST['orderDetails']) || empty($_POST['quantity']) || empty($_POST['Merchant']) || empty($_POST['Affiliate']) || empty($_POST['logistics']) || empty($_POST['product'])) {
            # code...
            header("location: ../orders.php?emptyFields");
        } else {
            # code...
            $merchant = $_POST['Merchant'];
            $affiliate = $_POST['Affiliate'];
            $logistics = $_POST['logistics'];
            $orderDetails = $_POST['orderDetails'];
            $productName = $_POST['product'];
            $location = $_POST['location'];
            $type = $_POST['type'];
            $quantity = intval($_POST['quantity']);
            $price = intval($_POST['price']);
            $cost = intval($_POST['cost']);

            $obj = new Controller;
            print_r($_POST);
            $obj->submitOrder($merchant, $affiliate, $logistics, $orderDetails, $productName, $type, $quantity, $location, $price, $cost);

                    
            setcookie('order_logistics', $logistics, time() + (86400 * 999999), '/');
            setcookie('order_location', $location, time() + (86400 * 999999), '/');
            setcookie('order_product', $productName, time() + (86400 * 999999), '/');
        }
        
    } else if(isset($_POST['deleteOrder'])){ 

        if (empty($_POST['id'])) {
            # code...
            header("location: ../orders.php?emptyFields");
        } else {
            # code...
            $id = $_POST['id'];
            $obj = new Controller;
            print_r($_POST);
            $obj->deleteOrder($id);

        }
        
    }else{
        header("location: ../orders.php");
    }

?>