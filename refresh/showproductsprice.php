<?php
    
    include_once "../includes/class-autoloader.inc.php";

    $viewObj = new View();
    $merchant = $_POST['Merchant'];
    $productName = $_POST['ProductName'];
    $quantity = $_POST['Quantity'];
    $results = $viewObj->viewSingleProduct($merchant, $productName);
    // print_r($_POST);
    // echo '<br>';
    // print_r($results);
    $quantity1 = intval($results[0]['FirstDiscountQty']);
    $quantity2 = intval($results[0]['SecondDiscountQty']);
    $quantity3 = intval($results[0]['ThirdDiscountQty']);
    $type = $results[0]['Type'];
    $price = 0;

    if ($quantity == 1) {
        # code...
        $price = floatval($results[0]['Price']);
    } else{
        if ($quantity == $quantity1) {
            # code...
            $price = floatval($results[0]['FirstDiscountPrice']);
        } elseif ($quantity == $quantity2) {
            # code...
            $price = floatval($results[0]['SecondDiscountPrice']);
        } elseif ($quantity == $quantity3) {
            # code...
            $price = floatval($results[0]['ThirdDiscountPrice']);
        } else {
            $price = floatval($results[0]['Price']) * floatval($quantity);
        }
    }

    if ($price != 0) {
        # code...
        ?>
            <s class="unedited">N</s>
            <input type="number" name="price" id="product-cost" value="<?php echo $price; ?>" readonly>
            <input type="checkbox" id="edit-price" onclick="editPrice()">
            <input type="hidden" name="type" id="product-type" value="<?php echo $type; ?>" readonly>
            <label for="edit-price" id="check-edit">Edit Price</label>
        <?php
    } else{
        # code...
        ?><p class="not-avaliable">N/A</p><?php
    }


?>