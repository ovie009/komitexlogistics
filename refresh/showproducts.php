<?php
    
    session_start();
    include_once "../includes/class-autoloader.inc.php";

    $fullname = $_SESSION['komitexLogisticsFullname'];
    $username = $_SESSION['komitexLogisticsUsername'];
    $email = $_SESSION['komitexLogisticsEmail'];
    $phone = $_SESSION['komitexLogisticsPhone'];
    $accountType = $_SESSION['komitexLogisticsAccountType'];
    $profilePhoto = $_SESSION['komitexLogisticsProfilePhoto'];

    $viewObj = new View();

    if ($accountType == 'Merchant') {
        # code...
        $merchant = $username;
    } else if($accountType == 'Affiliate'){
        # code...
        $contactResult = $viewObj->viewContacts($username, $accountType);
        $merchant = $contactResult[0]['Merchant'];
    }
    $logistics =$_POST['Logistics'];

    $productResult = $viewObj->viewWaybillWithLogistics($merchant, $logistics)

    ?><label for="select-product">Product: </label><?php

    if (!empty($productResult)) {
        # code...?>
        <select name="product" id="select-product" onchange="loadPrice()">
        <?php
            foreach ($productResult as $result) {?>

                <option value="<?php echo $result['ProductName'];?>"><?php echo $result['ProductName'];?></option>
                
                <?php
            }

            $groupsResult = $viewObj->viewGroups($merchant);
            foreach ($groupsResult as $result) {
                # code...
                $checkArray = array();
                if ($result['FirstProduct'] != NULL) {
                    # code...
                    $firstProduct = $result['FirstProduct'];
                    
                    $firstCheck= $viewObj->viewStock($merchant, $logistics, $firstProduct);
                    if (empty($firstCheck)) {
                        # code...
                        $checkArray[] = 'false';
                    } else {
                        # code...
                        $checkArray[] = 'true';
                    }
                }
                
                if ($result['SecondProduct'] != NULL) {
                    # code...
                    $secondProduct = $result['SecondProduct'];
                    
                    $secondCheck= $viewObj->viewStock($merchant, $logistics, $secondProduct);
                    if (empty($secondCheck)) {
                        # code...
                        $checkArray[] = 'false';
                    } else {
                        # code...
                        $checkArray[] = 'true';
                    }
                }

                if ($result['ThirdProduct'] != NULL) {
                    # code...
                    $thirdProduct = $result['ThirdProduct'];
                    
                    $thirdCheck= $viewObj->viewStock($merchant, $logistics, $thirdProduct);
                    if (empty($thirdCheck)) {
                        # code...
                        $checkArray[] = 'false';
                    } else {
                        # code...
                        $checkArray[] = 'true';
                    }
                }

                if (!(in_array('false', $checkArray))) {
                    # code...
                    ?><option value="<?php echo $result['GroupName'];?>"><?php echo $result['GroupName'];?></option><?php
                }
                // print_r($checkArray);
            }
        ?>
        </select>
        <button type="submit" name="submitOrder">send</button>
        <?php

    } else {
        # code...
        ?><p class="not-avaliable">N/A</p><?php
    }
                                            

?>