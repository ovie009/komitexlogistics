<?php
    include_once "class-autoloader.inc.php";
    //session_start();

    if(isset($_POST['submitWaybill'])){

        $numberSent = $_POST['numberSent'];
        $productName = $_POST['product'];
        $logistics = $_POST['Logistics'];
        $merchant = $_POST['Merchant'];
        $waybillDetails = $_POST['waybillDetails'];

        if (empty($numberSent) || empty($productName) || empty($logistics) || empty($merchant)) {
            # code...
            header("location: ../waybill.php?waybillEmptyFields&Tab=waybill");
        } else {
            # code...
    
            $obj = new Controller;
            if (empty($waybillDetails)) {
                # code...
                $obj->submitWaybill($merchant, $logistics, $productName, $numberSent);
            } else {
                # code...
                $obj->submitDetailedWaybill($merchant, $logistics, $productName, $numberSent, $waybillDetails);
            }
            setcookie('waybill_logistics', $logistics, time() + (86400 * 30), '/');
            setcookie('waybill_product', $productName, time() + (86400 * 30), '/');
            
        }
        
    } else if(isset($_POST['editWaybill'])){

        $numberSent = $_POST['numberSent'];
        $id = intval($_POST['id']);

        if (empty($numberSent) || empty($id)) {
            # code...
            header("location: ../waybill.php?waybillEmptyFields&Tab=waybill");
        } else {
            # code...
    
            $obj = new Controller;
    
            $obj->editWaybill($id, $numberSent);
        }
        
    } else if(isset($_POST['editAgentWaybill'])){

        $numberSent = $_POST['numberSent'];
        $id = intval($_POST['id']);

        if (empty($id) || empty($numberSent)) {
            # code...
            header("location: ../waybill.php?waybillEmptyFields&Tab=waybill");
        } else {
            # code...
    
            $obj = new Controller;
    
            $obj->editWaybill($id, $numberSent);
        }
        
    } else if(isset($_POST['approveWaybill'])){

        $productName = $_POST['product'];
        $logistics = $_POST['Logistics'];
        $merchant = $_POST['Merchant'];
        $id = intval($_POST['id']);
        $numberSent = intval($_POST['numberSent']);

        // if (empty($productName) || empty($logistics) || empty($merchant) || empty($numberSent)) {
        if (empty($id)) {
            # code...
            header("location: ../waybill.php?waybillEmptyFields&Tab=waybill");
        } else {
            # code...
    
            $obj = new Controller;
    
            $obj->approveWaybill($id, $merchant, $logistics, $productName, $numberSent);
        }
        
    } else if(isset($_POST['waybillLocation'])){

        $numberSent = $_POST['numberSent'];
        $productName = $_POST['product'];
        $logistics = $_POST['Logistics'];
        $waybillDetails = $_POST['waybillDetails'];
        $location = $_POST['location'];
        $merchant = $_POST['Merchant'];
        

        if (empty($numberSent) || empty($productName) || empty($logistics) || empty($location)) {
            # code...
            header("location: ../waybill.php?waybillEmptyFields&Tab=waybill");
        } else {
            # code...
    
            $obj = new Controller;

            if (empty($_POST['waybillDetails'])) {
                # code...
                $waybillDetails = 'none';
            } else {
                # code...
                $waybillDetails = $_POST['waybillDetails'];
            }
    
            $obj->waybillLocation($merchant ,$logistics, $productName, $numberSent, $waybillDetails, $location);

            setcookie('waybill_location', $location, time() + (86400 * 999999), '/');
            setcookie('waybill_product', $productName, time() + (86400 * 999999), '/');
            setcookie('waybill_merchant', $merchant, time() + (86400 * 999999), '/');
            
        }

    } else if (isset($_POST['approveAgentWaybill'])) {
        # code...
        $id = intval($_POST['id']);

        print_r($_POST);

        if (empty($id)) {
            # code...
            header("location: ../waybill.php?waybillEmptyFields&Tab=waybill");
        } else {
            # code...
    
            $obj = new Controller;

            $obj->approveAgentWaybill($id);
        }

    }else{
        header("location: ../waybill.php");
    }

?>