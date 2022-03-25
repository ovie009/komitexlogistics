<label for="select-product">Product: </label> 
<?php

    include_once "../includes/class-autoloader.inc.php";

    $viewObj = new View();

    $merchant = $_POST['Merchant'];
    $logistics = $_POST['Logistics'];
    // print_r($_POST);
    $approvedWaybillResult = $viewObj->viewLogisticsMerchantStock($logistics, $merchant);
    if (!empty($approvedWaybillResult)) {
        # code...?>
        <select name="product" id="select-product">
            <?php
                foreach ($approvedWaybillResult as $result) {?>

                    <option value="<?php echo $result['ProductName'];?>"> <?php echo $result['ProductName'];?> </option>
                    
                    <?php
                }
            ?>
        </select>                                    
        <?php
    }else{
        # code...?>
        <p class="default-notice">N/A</p>                            
        <?php
    }
?>