<?php
    
    include_once "../includes/class-autoloader.inc.php";

    $viewObj = new View();
    $merchant = $_POST['Merchant'];
    $productName = $_POST['ProductName'];
    $logistics = $_POST['Logistics'];
    $results = $viewObj->viewStock($merchant, $logistics, $productName);
    // print_r($_POST);
    // echo '<br>';
    // print_r($results);
    if (!empty($results)) {
        # code...
        $stock = $results[0]['StockLeft'];
        // if ($stock < 6) {
        # code...
        ?><p class="n-a">You have <?php echo $stock.' '.$productName; ?> left in stock</p><?php
        // }
    }


?>