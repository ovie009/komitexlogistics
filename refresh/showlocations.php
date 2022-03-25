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

    $locationResult = $viewObj->viewLocation($_POST['Logistics']);

    ?><label for="select-product">Location: </label><?php

    if (!empty($locationResult)) {
        # code...?>
        <select name="location" id="select-location" onchange="loadCost()">
        <?php
            foreach ($locationResult as $result) {?>

                <option value="<?php echo $result['location'];?>"><?php echo $result['location'];?></option>
                
                <?php
            }
        ?>
        </select>

        <section id="load-location-cost">
            <s class="unedited">N</s>
            <input type="number" id="location-cost" value="10" readonly>
        </section>
        <?php

    } else {
        # code...
        ?><p class="not-avaliable">N/A</p><?php
    }
                                            

?>