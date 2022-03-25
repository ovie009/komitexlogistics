<?php 
    
    session_start();
    include_once "../includes/class-autoloader.inc.php";

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
    }

    ?>
    <section>
        Waybill
        <?php
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

            
            $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            if (strpos($url, "Tab=waybill") == false) {
                # code...
                if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['waybill'];
    
                    $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $logistics, 'Logistics');
    
                    $waybillCount = $waybillCountResult[0]['COUNT(id)'];
    
                    if ($waybillCount > 0) {
                        # code...
                        ?><div class="waybill-tab-notification"><?php echo $waybillCount; ?></div><?php
                    }
                } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                    $result = $viewObj->getContactDetails($username);
                    $waybillDateTime = $result[0]['waybill'];
    
                    $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $merchant, 'Merchant');
    
                    $waybillCount = $waybillCountResult[0]['COUNT(id)'];
    
                    if ($waybillCount > 0) {
                        # code...
                        ?><div class="waybill-tab-notification"><?php echo $waybillCount; ?></div><?php
                    }
                }
            }


        ?>
    </section>
    <?php
?>