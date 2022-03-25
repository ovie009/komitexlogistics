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

    // $productResult = $viewObj->viewWaybillWithLogistics($merchant, );
    $product01 = $_POST['product01'];
    $product02 = $_POST['product02'];
    $productsResult = $viewObj->viewProductsExceptTwo($merchant, $product01, $product02);

    ?><option value="None">None</option><?php

    foreach ($productsResult as $result) {?>

        <option value="<?php echo $result['ProductName'];?>"> <?php echo $result['ProductName'];?> </option>
        
        <?php
    }
    
                                            

?>