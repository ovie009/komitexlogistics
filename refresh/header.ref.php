<?php 
    
    session_start();
    include_once "../includes/class-autoloader.inc.php";

    $url = $_POST['pageUrl'];
    // print_r($_POST);

    if (isset($_SESSION['komitexLogisticsEmail'])) {
        $fullname = $_SESSION['komitexLogisticsFullname'];
        $username = $_SESSION['komitexLogisticsUsername'];
        $email = $_SESSION['komitexLogisticsEmail'];
        $phone = $_SESSION['komitexLogisticsPhone'];
        $accountType = $_SESSION['komitexLogisticsAccountType'];
        $profilePhoto = $_SESSION['komitexLogisticsProfilePhoto'];

        $viewObj = new View();
        if ($accountType == 'Logistics') {
            # code...
            $logistics = $username;
            $agent = 'none';
        } else if($accountType == 'Agent'){
            # code...
            $contactResult = $viewObj->viewContacts($username, $accountType);
            if (!empty($contactResult)) {
                $logistics = $contactResult[0]['Logistics'];
                $agent = $username;
            }
        } else if ($accountType == 'Merchant') {
            # code...
            $merchant = $username;
            $affiliate = 'none';
        } else if($accountType == 'Affiliate'){
            # code...
            $contactResult = $viewObj->viewContacts($username, $accountType);
            if (!empty($contactResult)) {
                $merchant = $contactResult[0]['Merchant'];
                $affiliate = $username;
            }
        }
    
        if ($_POST['A'] == 'DropdownButton') {
            # code...
            $waybillCount = 0;
            if (strpos($url, "Tab=waybill") == false) {
                # code...
                if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['waybill'];
        
                    $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $logistics, 'Logistics');
        
                    $waybillCount += $waybillCountResult[0]['COUNT(id)'];
        
                } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['waybill'];
    
                    $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $merchant, 'Merchant');
    
                    $waybillCount += $waybillCountResult[0]['COUNT(id)'];
    
                }

                
            } 
            
            if (strpos($url, "index.php") == false) {
                # code...
                if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['home'];
        
                    $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $logistics, 'Logistics');
        
                    $waybillCount += $waybillCountResult[0]['COUNT(id)'];
                
                } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['home'];
    
                    $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $merchant, 'Merchant');
    
                    $waybillCount += $waybillCountResult[0]['COUNT(id)'];
    
                }
            } 

            if (strpos($url, "accountinfo.php") == false) {
                # code...
                if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['contacts'];
        
                    $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $logistics, 'Logistics');
        
                    $waybillCount += $waybillCountResult[0]['COUNT(id)'];
                
                } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['contacts'];
    
                    $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $merchant, 'Merchant');
    
                    $waybillCount += $waybillCountResult[0]['COUNT(id)'];
    
                }
            }

            if ($waybillCount > 0) {
                # code...
                ?><div class="nav-notification"><?php echo $waybillCount; ?></div><?php
                if ($waybillCount > $_SESSION['NewContent']) {
                    # code...?>
                    <script>

                        document.getElementById("new-order-audio").play();

                    </script><?php

                    $_SESSION['NewContent'] = $waybillCount;

                }

            }
            ?><img src="icons/dropdown/interface.png" alt=""><?php
            
        } else if ($_POST['A'] == 'waybillLink') {
            # code...
            if (strpos($url, "Tab=waybill") == false) {
                # code...
                if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                    echo 'Waybill/Products';
                    // echo $url;
                    // echo $_SERVER['REQUEST_URI'];
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['waybill'];
    
                    $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $logistics, 'Logistics');
    
                    $waybillCount = $waybillCountResult[0]['COUNT(id)'];
    
                    if ($waybillCount > 0) {
                    # code...
                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                    }
    
                } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                    echo 'Waybill/Products';
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['waybill'];
    
                    $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $merchant, 'Merchant');
                    
                    $waybillCount = $waybillCountResult[0]['COUNT(id)'];
                    
                    $_SESSION['NewWaybill'] = $waybillCount;
    
                    if ($waybillCount > 0) {
                        # code...
                        ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                    }
                }
            } else {
                # code...
                echo 'Waybill/Products';
            }

        } else if ($_POST['A'] == 'homeLink') {
            # code...
            if (strpos($url, "index.php") == false) {
                # code...
                echo 'Home';

                if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['home'];
        
                    $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $logistics, 'Logistics');
        
                    $waybillCount = $waybillCountResult[0]['COUNT(id)'];
                
                    if ($waybillCount > 0) {
                        # code...
                        ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                    }

                } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['home'];
    
                    $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $merchant, 'Merchant');
    
                    $waybillCount = $waybillCountResult[0]['COUNT(id)'];
    
                    if ($waybillCount > 0) {
                        # code...
                        ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                    }
                }


            }  else {
                # code...
                echo 'Home';
            }

        } else if ($_POST['A'] == 'contactLink') {
            # code...
            if (strpos($url, "accountinfo.php") == false) {
                # code...
                echo 'Account Info';

                if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['contacts'];
        
                    $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $logistics, 'Logistics');
        
                    $waybillCount = $waybillCountResult[0]['COUNT(id)'];
                
                    if ($waybillCount > 0) {
                        # code...
                        ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                    }

                } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['contacts'];
    
                    $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $merchant, 'Merchant');
    
                    $waybillCount = $waybillCountResult[0]['COUNT(id)'];
    
                    if ($waybillCount > 0) {
                        # code...
                        ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                    }
                }


            }  else {
                # code...
                echo 'Account Info';
            }
        }

    } else {
        # code...
        ?><img src="icons/dropdown/interface.png" alt=""><?php
    }
?>