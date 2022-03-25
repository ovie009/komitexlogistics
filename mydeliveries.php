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
        date_default_timezone_set('Africa/Lagos');
        $_SESSION['dateArray'] = array(date('Y-m-d'));
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
    <link rel="stylesheet" href="CSS/mydeliveries.css">
    <link rel="shortcut icon" type="image/png" href="icons/logistics/018-motorcycle.png">
    <script src="jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
    <?php
        require "header.php";
    ?>
    <div class="popup-background"></div>
    <main class="index-main">
        <section class="front-page-info">
            <?php
                if (isset($_SESSION['komitexLogisticsEmail'])) { 

                    if ($_SESSION['komitexLogisticsAccountType'] == NULL) {?>
                    
                        <form action="includes/accounttype.inc.php" class="select-accountType" method="POST">
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
                    }else{
                        ?>
                        <h1>MY DELIVERIES</h1>
                        <div id="autorefresh">
                        <?php
                        if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                            ?><div class="mydeliveries-div"><?php
                                
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
                                }
                                
                                ?><div class="orders-container"><?php

                                    foreach ($_SESSION['dateArray'] as $dateSelected) {
                                        # code...
                                        ?><h5 class="date-heading">
                                            <?php 
                                                $yesterday = date('Y-m-d',  (strtotime(date('Y-m-d')) - 86400));
                                                $dateDisplayed = date('D, jS F Y', strtotime($dateSelected));
                                                if ($dateSelected == date('Y-m-d')) {
                                                    # code...
                                                    echo 'Today';
                                                } elseif ($yesterday == $dateSelected) {
                                                    # code...
                                                    echo 'Yesterday';
                                                } else{
                                                    # code...
                                                    echo $dateDisplayed;
                                                }
                                                
                                            ?>
                                        </h5><?php
                                        if (!empty($contactResult) || $accountType == 'Logistics') {
                                            # code...
                                            $orderResult = $viewObj->viewOrdersTaken($logistics, $username, $dateSelected);
                                            if (!empty($orderResult)) {
                                                # code...
                                                $x = 1;
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
                                                    $take = $result['Agent'];
                                                    $enableEdit = $result['EnableEdit'];
                                                    $merchant = $result['Merchant'];
                                                    $feedback = $result['Feedback'];
                                                    $status = $result['Status'];
                                                    $type = $result['Type'];

                                                    $paymentMethod = $result['PaymentMethod'];
                                                    if ($paymentMethod != NULL) {
                                                        # code...
                                                        $paymentMethod = ', '.$result['PaymentMethod'];
                                                    }

                                                    $rescheduleDate = $result['RescheduledDate'];
                                                    $newRescheduleDate = date("D F jS Y", strtotime($rescheduleDate));
                                                    $dateTime = $result['DateTime'];
                                                    $actionTime = date("h:i A", strtotime($dateTime));

                                                    $feedbackTime = $result['FeedbackTime'];
                                                    $feedbackActionTime = date("h:i a", strtotime($feedbackTime));

                                                    $sentDateTime = $result['SentDateTime'];
                                                    $newSentTime = date("h:i A", strtotime($sentDateTime));
                                                    $newSentDate = date("D F jS Y", strtotime($sentDateTime));

                                                    $currentDate = date("Y-m-d");
                                                
                                                    ?><div class="orders-holder">
                                                        <div class="order-header">
                                                            <div class="indicator-wrapper">
                                                                <?php
                                                                    if ($status == 'Pending') {
                                                                        # code...
                                                                        ?><div id="Pending"></div>Pending<?php

                                                                    } else if ($status == 'Taken') {
                                                                        # code...
                                                                        ?><div id="Taken"></div>Taken by <?php
                                                                        if ($take == $username) {
                                                                            # code...
                                                                            echo 'you '.$actionTime;
                                                                        } else {
                                                                            echo $take.' '.$actionTime;
                                                                        }

                                                                    } else if ($status == 'Rescheduled') {
                                                                        # code...
                                                                        ?><div id="Rescheduled"></div>Rescheduled to <?php echo $newRescheduleDate;

                                                                    } else if ($status == 'Canceled') {
                                                                        # code...
                                                                        ?><div id="Canceled"></div>Canceled at <?php echo $actionTime;
                                                                    
                                                                    } else if ($status == 'Delivered') {
                                                                        # code...
                                                                        ?><div id="Delivered"></div>Delivered <?php echo $actionTime;
                                                                    
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            if ($type == 'Product') {
                                                                # codde...
                                                                ?><span>Order for <?php echo $quantity; ?> <?php echo $product; ?> @ <s>N</s><?php echo $price; ?></span><?php
                                                            } else {
                                                                # codde...
                                                                $groupResults = $viewObj->viewSingleGroups($merchant, $product);
                                                                $firstProduct = $groupResults[0]['FirstProduct'];
                                                                $secondProduct = $groupResults[0]['SecondProduct'];
                                                                $thirdProduct = $groupResults[0]['ThirdProduct'];
                                                                $firstQuantity = $groupResults[0]['FirstQuantity'];
                                                                $secondQuantity = $groupResults[0]['SecondQuantity'];
                                                                $thirdQuantity = $groupResults[0]['ThirdQuantity'];

                                                                ?><span>
                                                                    Order for <?php echo $product; ?> (
                                                                        <?php
                                                                            if ($firstProduct != NULL) {
                                                                                # code...
                                                                                echo $firstQuantity.' '.$firstProduct.' & ';
                                                                            }
                                                                            if ($secondProduct != NULL) {
                                                                                # code...
                                                                                echo $secondQuantity.' '.$secondProduct;
                                                                            }
                                                                            if ($thirdProduct != NULL) {
                                                                                # code...
                                                                                echo ' & '.$thirdQuantity.' '.$thirdProduct;
                                                                            }
                                                                        ?>
                                                                    ) @ <s>N</s><?php echo $price; ?>
                                                                </span><?php
                                                            }
                                                        ?>
                                                        <span>Location: <?php echo $location; ?> @ <s>N</s><?php echo $cost; ?> </span>
                                                        <span>Merchant: <?php echo $merchant; ?></span>
                                                        <p>
                                                            <?php echo nl2br($orderDetails); ?>
                                                        </p>
                                                        <div class="delivery-wrapper-<?php echo $x; ?>">
                                                            <form action="<?php echo htmlspecialchars('includes/mydeliveries.inc.php');?>" method="POST" class="feedback-form">
                                                                <textarea name="paymentMethod" id="delivery-textarea-<?php echo $x; ?>" cols="20" rows="1" placeholder="Payment Method" required></textarea>
                                                                <!-- <input type="hidden" value="<?php  echo $id; ?>" name="id">
                                                                <input type="hidden" value="<?php  echo $type; ?>" name="type">
                                                                <button type="submit" name="enterDelivered" class="enter-feedback">Enter</button> -->
                                                                <button type="button" class="enter-feedback" onclick="enterDelivered(<?php echo $id; ?>, <?php echo $x; ?>, '<?php echo $type; ?>')">Enter</button>
                                                                <button type="button" class="close-feedback" onclick="slideDelivered(<?php echo $x; ?>, true)">Close</button>
                                                            </form>
                                                        </div>
                                                        <?php

                                                        if ($status != 'Canceled' && $status != 'Rescheduled') {
                                                            # code...
                                                            if ($status == 'Delivered') {
                                                                # code...
                                                                ?>
                                                                <div class="comment-wrapper"><p class="report-<?php echo $x; ?>" id="contact-delivered">Delivered<?php echo $paymentMethod; ?></p><span style="color: seagreen;" id="feedback-time-<?php echo $x; ?>"><?php echo $actionTime; ?></span> </div>
                                                                
                                                                <?php
                                                            } else {
                                                                # code...
                                                                if ($feedback == NULL) {
                                                                    # code...
                                                                    ?><p class="report-<?php echo $x; ?>" id="contact-false">Customer has not been contacted yet</p><?php
                                                                } else {
                                                                    # code...
                                                                    ?>
                                                                    <div class="comment-wrapper"><p class="report-<?php echo $x; ?>" id="contact-true"><?php echo $feedback; ?></p><span id="feedback-time-<?php echo $x; ?>"><?php echo $feedbackActionTime; ?></span> </div>
                                                                    <?php
                                                                }
                                                            }
                                                            
                                                        } elseif ($status == 'Canceled' ) {
                                                            # code...
                                                            if ($feedback == NULL) {
                                                                # code...
                                                                ?>
                                                                <div class="comment-wrapper"><p class="report-<?php echo $x; ?>" id="contact-false">Canceled</p><span style="color: tomato;" id="feedback-time-<?php echo $x; ?>"><?php echo $actionTime; ?></span> </div>
                                                                <?php
                                                            } else {
                                                                # code...
                                                                ?>
                                                                <div class="comment-wrapper"><p class="report-<?php echo $x; ?>" id="contact-false"><?php echo $feedback; ?></p><span style="color: tomato;" id="feedback-time-<?php echo $x; ?>"><?php echo $actionTime; ?></span> </div>
                                                                <?php
                                                            }

                                                        } elseif ($status == 'Rescheduled' ) {
                                                            # code...
                                                            ?>
                                                            <div class="comment-wrapper"><p class="report-<?php echo $x; ?>" id="contact-rescheduled">Rescheduled to <?php echo $newRescheduleDate; ?></p><span style="color: orange;" id="feedback-time-<?php echo $x; ?>"><?php echo $actionTime; ?></span> </div>
                                                            <?php

                                                        }
                                                        
    
                                                            
                                                            if ($status == 'Taken') {
                                                                # code...
                                                                ?><form action="<?php echo htmlspecialchars('includes/mydeliveries.inc.php');?>" method="POST" id="take-form">
                                                                    <button type="button" onclick="dropOrder(<?php echo $id; ?>)">Drop</button>
                                                                </form>
                                                                
                                                                <div class="order-buttons-wrapper-<?php echo $x; ?>">
                                                                    <form class="order-buttons" action="<?php echo htmlspecialchars('includes/mydeliveries.inc.php');?>" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                        <button type="button" id="cancel-order" onclick="cancelOrder(<?php echo $id; ?>)">Cancel</button>
                                                                        <button type="button" id="deliver-order" onclick="slideDelivered(<?php echo $x; ?>, false)">Delivered</button>
                                                                    </form>
                                                                </div>
                                                                <?php
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
                                                                    } else{
                                                                        # code...
                                                                        ?><p>Uploaded by <?php echo $uploader; ?></p><?php
                                                                    }
                                                                }
                                                                
                                                            ?>
                                                        </div><?php
                                                    ?></div><?php
                                                    $x++;
                                                }
            
                                            } else {
                                                # code...
                                                ?>
                                                    <p class="default-expression">
                                                    <?php
                                                        if ($dateSelected == date('Y-m-d')) {
                                                            # code...
                                                            echo 'You\'ve not taken any order today, click on \'Take\' in the home page';
                                                        } elseif ($yesterday == $dateSelected) {
                                                            # code...
                                                            echo 'No history of orders taken yesterday, or all pending orders taken has been reposted to present day';
                                                        } else{
                                                            # code...
                                                            echo 'No history of orders taken on '.$dateDisplayed.', or all pending orders taken has been reposted to present day';
                                                        }
                                                    ?>
                                                    </p>
                                                <?php
                                            }
                                        } 
                                    }
                                    ?><form action="<?php echo htmlspecialchars('includes/index-show.inc.php');?>" metthod="POST" class="show-more-or-less">
                                        <button type="button" onclick="show('more')">Show More</button>
                                        <?php
                                            if (count($_SESSION['dateArray']) > 1) {
                                                # code...
                                                ?><button type="button" onclick="show('less')">Show less</button><?php
                                            }
                                        ?>
                                    </form><?php

                                ?></div><?php

                                
                            
                                
                            ?></div><?php
                        } else {
                            header("location: index.php");
                        }
                        ?></div><?php
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
    <script src="javascript/mydeliveries.js"></script>
</body>
</html>