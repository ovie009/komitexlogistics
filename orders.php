<?php
    session_start();
    include_once "includes/class-autoloader.inc.php";
    
    if (isset($_SESSION['komitexLogisticsEmail'])) { 
        $fullname = $_SESSION['komitexLogisticsFullname'];
        $username = $_SESSION['komitexLogisticsUsername'];
        $email = $_SESSION['komitexLogisticsEmail'];
        $phone = $_SESSION['komitexLogisticsPhone'];
        $accountType = $_SESSION['komitexLogisticsAccountType'];
        $profilePhoto = $_SESSION['komitexLogisticsProfilePhoto'];
        $_SESSION['searchArray'] = 10;
    } else {
        # code...
        header("location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="rgb(7, 66, 124)">
    <title>Komitex Logistics</title>
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/orders.css">
    <link rel="shortcut icon" type="image/png" href="icons/logistics/018-motorcycle.png">
    <script src="jquery/jquery-3.4.1.min.js"></script>
</head>
<body onload="checkUrl()">
    <?php
        require "header.php";
    ?>
    <div class="popup-background"></div>
    <main class="index-main">
        <section class="front-page-info">
            <?php
                if (isset($_SESSION['komitexLogisticsEmail'])) { 

                    if ($_SESSION['komitexLogisticsAccountType'] == NULL) {?>
                    
                        <form action="<?php echo htmlspecialchars('includes/accounttype.inc.php');?>" class="select-accountType" method="POST">
                            <h2>Select account type</h2>
                            <input type="hidden" name="email" value="<?php echo $_SESSION['komitexLogisticsEmail'] ?>">
                            <div class="radio-wrapper">
                                <label for="select-affiliate">Affiliate</label>
                                <input type="radio" name="accountType" value="Affiliate" id="select-affiliate">
                            </div>
                            <div class="radio-wrapper">
                                <label for="select-agent">Agent</label>
                                <input type="radio" name="accountType" value="Agent" id="select-agent">
                            </div>
                            <div class="radio-wrapper">
                                <label for="select-logistics">Logistics</label>
                                <input type="radio" name="accountType" value="Logistics" id="select-logistics">
                            </div>
                            <div class="radio-wrapper">
                                <label for="select-merchant">Merchant</label>
                                <input type="radio" name="accountType" value="Merchant" id="select-merchant">
                            </div>
                            <div class="radio-wrapper">
                                <p>Note: once submitted, it cannot be edited</p>
                                <button type="submit" name="submitAccountType">OK</button>
                            </div>
                        </form>
                        <?php
                    }else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate'){
                        ?>
                        <h1>ORDERS</h1>
                        <div class="orders-div">
                            <form class="add-new-form">
                                <button type="button" id="add-new-product" onclick="orderDropdown()">Send New Order</button>
                            </form>
                            <?php

                                $viewObj = new View();


                                if ($accountType == 'Merchant') {
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

                                if (!empty($contactResult) || $accountType == 'Merchant') {
                                    $contactResult = $viewObj->viewLogisticsContacts($merchant, 'Merchant');
                                    //echo $contactResult[0]['Logistics'];
                                    //echo '<br>';
                                }    
                            ?>
                            <div class="drop-send-order">
                                <form class="submit-order" method="POST"  action="<?php echo htmlspecialchars('includes/orders.inc.php');?>">
                                    <input type="hidden" name="Merchant" id="merchant" value="<?php echo $merchant; ?>">
                                    <input type="hidden" name="Affiliate" value="<?php echo $affiliate; ?>">
                                    <label for="order-details">Order Details (compulsory):</label>
                                    <textarea name="orderDetails" id="order-details" cols="40" rows="6" placeholder="Type Order here" required></textarea>
                                    <div>
                                        <label for="order-quantity">Quantity: </label>
                                        <input type="number" name="quantity" id="order-quantity" placeholder="Qty" value="1" min="1" oninput="loadPrice()" required>
                                        <section id="load-product-cost">
                                            <s class="unedited">N</s>
                                            <input type="number" name="price" id="product-cost" value="22500" readonly>
                                        </section> 
                                    </div>
                                    <div>
                                        <label for="select-logistics">Logistics: </label>
                                        <select name="logistics" id="select-logistics">
                                            <?php
                                                foreach ($contactResult as $result) {?>

                                                    <option value="<?php echo $result['Logistics'];?>"><?php echo $result['Logistics'];?></option>
                                                    
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div id="select-location-wrapper"></div>
                                    <div id="select-product-wrapper"></div>
                                    <div id="stock-notice-wrapper"></div>
                                </form>
                            </div>

                            <div id="autorefresh">
                                <?php

                                    if (!empty($contactResult) || $accountType == 'Merchant') {

                                        $controllerObj = new Controller;
                                        $controllerObj->disableEdit($merchant);

                                        $countResult = $viewObj->countOrder($merchant);
                                        $orderResult = $viewObj->viewOrder($merchant);
                                        if (!empty($orderResult)) {
                                            # code...

                                            ?><div class="orders-container"><?php

                                                foreach ($orderResult as $result) {
                                                    # code...
                                                    $id = $result['id'];
                                                    $quantity = $result['Quantity'];
                                                    $product = $result['Product'];
                                                    $price = $result['Price'];
                                                    $logistics = $result['Logistics'];
                                                    $orderDetails = $result['OrderDetails'];
                                                    $location = $result['Location'];
                                                    $cost = $result['Cost'];
                                                    $uploader = $result['Affiliate'];
                                                    $enableEdit = $result['EnableEdit'];

                                                    $sentDateTime = $result['SentDateTime'];
                                                    $newSentTime = date("h:i A", strtotime($sentDateTime));
                                                    $newSentDate = date("F jS Y", strtotime($sentDateTime));

                                                    $orderDetails = $viewObj->linkPhoneNumbers($orderDetails);
                                                
                                                    ?><div class="orders-holder"><?php
                                                        ?><span>Order for <?php echo $quantity; ?> <?php echo $product; ?> @ <s>N</s><?php echo $price; ?> sent to <?php echo $logistics; ?> 
                                                        <br>Location: <?php echo $location; ?> @ <s>N</s><?php echo $cost; ?> </span>
                                                        <p>
                                                            <?php echo nl2br($orderDetails); ?>
                                                        </p>
                                                        <?php
                                                            if ($enableEdit == 1) {
                                                                # code...
                                                                ?><form method="POST" id="order-edit-form" action="<?php echo htmlspecialchars('includes/orders.inc.php');?>">
                                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                    <button type="submit" name="deleteOrder" id="delete-order">Delete</button>
                                                                </form><?php
                                                            }
                                                        ?>
                                                        <div class="order-footer">
                                                            <p>Sent <?php echo $newSentTime; ?> <br> <?php echo $newSentDate; ?></p>
                                                            <?php
                                                                if ($accountType == 'Merchant') {
                                                                    # code...
                                                                    if ($uploader != NULL) {
                                                                        # code...
                                                                        ?><p>Uploaded by <?php echo $uploader; ?></p><?php
                                                                    }
                                                                    
                                                                } else {
                                                                    # code...
                                                                    if ($uploader == NULL) {
                                                                        # code...
                                                                        ?><p>Uploaded by <?php echo $merchant; ?></p><?php
                                                                    } elseif ($uploader != NULL && $uploader != $affiliate ) {
                                                                        # code...
                                                                        ?><p>Uploaded by <?php echo $uploader; ?></p><?php
                                                                    }
                                                                }
                                                                
                                                            ?>
                                                        </div><?php
                                                    ?></div><?php
                                                }

                                                $LIMIT = $_SESSION['searchArray'];
                                                if ($countResult[0]['COUNT(id)'] > $LIMIT) {
                                                    # code...
                                                    ?><form action="<?php echo htmlspecialchars('includes/index-limit.inc.php');?>" metthod="POST" class="show-more-or-less">
                                                        <button type="button" onclick="limit('more')">Show More</button>
                                                        <?php
                                                            if ($_SESSION['searchArray'] > 10) {
                                                                # code...
                                                                ?><button type="button" onclick="limit('less')">Show less</button><?php
                                                            }
                                                            ?>
                                                    </form><?php
                                                } else{
                                                    ?><form action="<?php echo htmlspecialchars('includes/index-limit.inc.php');?>" metthod="POST" class="show-more-or-less">
                                                        <button type="button" style="visibility: hidden;">Show More</button>
                                                        <?php
                                                            if ($_SESSION['searchArray'] > 10 && $countResult[0]['COUNT(id)'] > 10) {
                                                                # code...
                                                                ?><button type="button" onclick="limit('less')">Show less</button><?php
                                                            }
                                                        ?>
                                                    </form><?php
                        
                                                }

                                            ?></div><?php
                                        } else {
                                            # code...
                                            ?>
                                                <p class="default-expression">You've not uploaded any order, click on 'Send New Order' to send Order</p>
                                            <?php
                                        }
                                    }    
                                ?>
                            </div>

                        </div>
                        <?php
                    } else {
                        header("location: index.php");
                    }
                }else {
                    header("location: index.php");
                }
            ?>
        </section>
    </main>
    <?php
        require "footer.php";
    ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/orders.js"></script>
</body>
</html>