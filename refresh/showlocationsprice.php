<?php
    
    include_once "../includes/class-autoloader.inc.php";

    $viewObj = new View();
    $location = $_POST['Location'];
    $logistics = $_POST['Logistics'];
    // echo $_POST['Logistics'];
    // echo $_POST['Location'];
    $locationResult = $viewObj->viewLocationPrice($logistics, $location);
    $cost = $locationResult[0]['price'];
    // echo $price;
    // print_r($_POST);


    ?>

        <s class="unedited">N</s>
        <input type="number" name="cost" id="location-cost" value="<?php echo $cost; ?>" readonly>
        
    <?php

?>