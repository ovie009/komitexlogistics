<?php
    session_start();
    include_once "../includes/class-autoloader.inc.php";
    
    if (isset($_SESSION['komitexLogisticsEmail'])) {
        # code...
        $fullname = $_SESSION['komitexLogisticsFullname'];
        $username = $_SESSION['komitexLogisticsUsername'];
        $email = $_SESSION['komitexLogisticsEmail'];
        $phone = $_SESSION['komitexLogisticsPhone'];
        $accountType = $_SESSION['komitexLogisticsAccountType'];
        $profilePhoto = $_SESSION['komitexLogisticsProfilePhoto'];
    } else {
        # code...
        header("location: ..index.php");
    }

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
                        ?><span>Order for <?php echo $quantity; ?> <?php echo $product; ?> @ <s>N</s><?php echo $price; ?> sent to <?php echo $logistics; ?> <br> Location: <?php echo $location; ?> @ <s>N</s><?php echo $cost; ?> </span>
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