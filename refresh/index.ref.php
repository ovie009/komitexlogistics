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
        date_default_timezone_set('Africa/Lagos');
    } else {
        # code...
        header("location: ..logout.php");
    }
    


    if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
        ?><div class="index-div"><?php
            
            $viewObj = new View();
            $ctrlObj = new Controller();


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

            if (!empty($contactResult) || $accountType == 'Logistics') {
                # code...
                $ctrlObj->repostPendingOrder($logistics);
                $ctrlObj->repostRescheduledOrder($logistics);
                $ctrlObj->setIndexTime($username);
                unset($ctrlObj);

                
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

                        
                        $orderResult = $viewObj->viewLogisticsOrder($logistics, $dateSelected);
                        if (!empty($orderResult)) {
                            # code...
                            $x = 1;
                            
                            ?><div class="status-heading"><?php
                            
                                $numberDelivered = $viewObj->countLogisticsDelivered($logistics, $dateSelected);
                                $numberCanceled = $viewObj->countLogisticsCanceled($logistics, $dateSelected);
                                $numberRescheduled = $viewObj->countLogisticsRescheduled($logistics, $dateSelected);
                                $numberPending = $viewObj->countLogisticsPending($logistics, $dateSelected);
                                $numberTaken = $viewObj->countLogisticsTaken($logistics, $dateSelected);
                                $numberNotContact = $viewObj->countLogisticsNotContacted($logistics, $dateSelected);
                            
                                ?><div class="status-wrapper"><?php
                                    ?><div id="Delivered"></div> <p class="Delivered-text"><?php echo $numberDelivered[0]['COUNT(id)'];?> Delivered</p>
                                </div><?php
                            
                                ?><div class="status-wrapper"><?php
                                    ?><div id="Canceled"></div> <p class="Delivered-text"><?php echo $numberCanceled[0]['COUNT(id)'];?> Canceled</p>
                                </div><?php
                            
                                ?><div class="status-wrapper"><?php
                                    ?><div id="Rescheduled"></div> <p class="Delivered-text"><?php echo $numberRescheduled[0]['COUNT(id)'];?> Rescheduled</p>
                                </div><?php
                                
                                if ($dateSelected == date('Y-m-d')) {
                            
                                    ?><!--<div class="status-wrapper"><?php
                                    ?><div id="Taken"></div> <p class="Delivered-text"><?php echo $numberTaken[0]['COUNT(id)'];?> Taken</p>
                                    </div>--><?php
                            
                                    if ($numberNotContact[0]['COUNT(id)'] != 0){
                                        ?><div class="status-wrapper"><?php
                                        ?><div id="not-contacted"></div>
                                            <p class="Delivered-text">
                                                <?php echo $numberNotContact[0]['COUNT(id)']; ?> Customers has not been contacted
                                            </p><?php
                                        ?></div><?php
                                    }
                                    ?><div class="status-wrapper"><?php
                                        ?><div id="Pending"></div> <p class="Delivered-text"><?php echo $numberPending[0]['COUNT(id)'];?> Pending</p>
                                    </div><?php
                            
                                }
                            
                            ?></div> <?php

                            foreach ($orderResult as $result) {
                                # code...
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
                                $remark = $result['Remark'];
                                if ($remark != NULL) {
                                    # code...
                                    $remark = ', '.$result['Remark'];
                                }

                                $paymentMethod = $result['PaymentMethod'];
                                if ($paymentMethod != NULL) {
                                    # code...
                                    $paymentMethod = ', '.$result['PaymentMethod'];
                                }

                                $rescheduleDate = $result['RescheduledDate'];
                                $newRescheduleDate = date("D F jS Y", strtotime($rescheduleDate));
                                $dateTime = $result['DateTime'];
                                $actionTime = date("h:i a", strtotime($dateTime));

                                $feedbackTime = $result['FeedbackTime'];
                                $feedbackActionTime = date("h:i a", strtotime($feedbackTime));

                                $sentDateTime = $result['SentDateTime'];
                                $newSentTime = date("h:i a", strtotime($sentDateTime));
                                $newSentDate = date("D F jS Y", strtotime($sentDateTime));

                                $currentDate = date("Y-m-d");

                                $orderDetails = $viewObj->linkPhoneNumbers($orderDetails);

                                ?><div class="orders-holder">
                                    <div class="order-header">
                                        <div class="indicator-wrapper">
                                            <?php
                                                if ($status == 'Pending') {
                                                    # code...
                                                    ?><div id="Pending"></div>Pending<?php echo $remark;

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
                                                    ?><div id="Canceled"></div>Canceled by <?php 
                                                    if ($take == $username) {
                                                        # code...
                                                        echo 'you '.$actionTime;
                                                    } else {
                                                        echo $take.' '.$actionTime;
                                                    }
                                                
                                                } else if ($status == 'Delivered') {
                                                    # code...
                                                    ?><div id="Delivered"></div>Delivered by <?php 
                                                    if ($take == $username) {
                                                        # code...
                                                        echo 'you '.$actionTime;
                                                    } else {
                                                        echo $take.' '.$actionTime;
                                                    }
                                                
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
                                    <span>Location: <?php echo $location; ?></span>
                                    <span>Merchant: <?php echo $merchant; ?></span>
                                    <p>
                                        <?php echo nl2br($orderDetails); ?>
                                    </p>
                                    <div class="feedback-wrapper-<?php echo $x; ?>">
                                        <form action="<?php echo htmlspecialchars('includes/index.inc.php');?>" method="POST" class="feedback-form">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <textarea name="feedback" id="feedback-textarea-<?php echo $x; ?>" cols="20" rows="3" placeholder="Type feedback" required></textarea>
                                            <button type="button" class="enter-feedback" onclick="enterFeedback(<?php echo $id; ?>, <?php echo $x; ?>)">Enter</button>
                                            <button type="button" class="close-feedback" onclick="slideFeedback(<?php echo $x; ?>, true)">Close</button>
                                        </form>
                                    </div>
                                    <div class="reschedule-wrapper-<?php echo $x; ?>">
                                        <form action="<?php echo htmlspecialchars('includes/index.inc.php');?>" method="POST" class="feedback-form">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="date" name="rescheduleDate" id="reschedule-date-<?php echo $x; ?>" min="<?php echo $currentDate; ?>" required>
                                            <button type="button" class="enter-feedback" onclick="enterRescheduleDate(<?php echo $id; ?>, <?php echo $x; ?>)">Enter</button>
                                            <button type="button" class="close-feedback" onclick="slideReschedule(<?php echo $x; ?>, true)">Close</button>
                                        </form>
                                    </div><?php
                                        
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
                                    
                                    
                                    if ($status == 'Pending') {
                                        # code...
                                        ?><form action="<?php echo htmlspecialchars('includes/index.inc.php');?>" method="POST" class="take-form">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                            <button type="button" onclick="takeOrder(<?php echo $id; ?>, '<?php echo $username; ?>')">Take</button>
                                        </form>
                                        
                                        <div class="order-buttons-wrapper-<?php echo $x; ?>">
                                            <form class="order-buttons" action="<?php echo htmlspecialchars('includes/index.inc.php');?>" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <button type="button" id="feedback-order-<?php echo $x; ?>" onclick="slideFeedback(<?php echo $x; ?>, false)">Feedback</button>
                                                <button type="button" id="rescheduled-order-<?php echo $x; ?>" onclick="slideReschedule(<?php echo $x; ?>, false)">Reschedule</button>
                                                <button type="button" id="cancel-order-<?php echo $x; ?>" onclick="cancelOrder(<?php echo $id; ?>)">Cancel</button>
                                            </form>
                                        </div>
                                        <?php
                                    }

                                    ?><div class="order-footer">
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

                            ?><ul class="status-footing"><?php
                                $numberTotalOrder = $viewObj->countLogisticsTotalOrder($logistics, $dateSelected);
                                $numberRescheduledOrder = $viewObj->countLogisticsRescheduledOrder($logistics, $dateSelected);
                                $numberRepostedOrder = $viewObj->countLogisticsRepostedOrder($logistics, $dateSelected);
                                $numberPostedOrder = $viewObj->countLogisticsPostedOrder($logistics, $dateSelected);
                                ?><li><div id="Total-order"></div>Total Order - <?php echo $numberTotalOrder[0]['COUNT(id)']; ?></li><?php
                                
                                if ($dateSelected == date('Y-m-d')) {
                                    # code...
                                    ?><li><div id="Posted-today"></div>Posted Today - <?php echo $numberPostedOrder[0]['COUNT(id)']; ?></li><?php

                                    if ($numberTotalOrder[0]['COUNT(id)'] > $_SESSION['NewOrder']) {
                                        # code...
                                        $_SESSION['NewOrder'] = $numberTotalOrder[0]['COUNT(id)']; 
                                        ?>
                                        <script>

                                            document.getElementById("new-order-audio").play();
                                            
                                            // function playAudio() {
                                            //     x.play();
                                            // }

                                            // function pauseAudio() {
                                            //     x.pause();
                                            // }

                                        </script>
                                        <?php
                                    }

                                } elseif ($yesterday == $dateSelected) {
                                    # code...
                                    ?><li><div id="Posted-today"></div>Posted Yesterday - <?php echo $numberPostedOrder[0]['COUNT(id)']; ?></li><?php
                                } else{
                                    # code...
                                    ?><li><div id="Posted-today"></div>Posted <?php echo $dateDisplayed.' - '.$numberPostedOrder[0]['COUNT(id)']; ?></li><?php
                                }

                                ?><li><div id="Rescheduled"></div>Rescheduled from Previous Days - <?php echo $numberRescheduledOrder[0]['COUNT(id)']; ?></li><?php
                                ?><li><div id="Reposted"></div>Reposted from Previous Days - <?php echo $numberRepostedOrder[0]['COUNT(id)']; ?></li><?php
                            ?></ul> <?php

                        } else {
                            # code...
                            ?>
                                <p class="default-expression">
                                <?php
                                    if ($dateSelected == date('Y-m-d')) {
                                        # code...
                                        echo 'No New Orders Posted Today';
                                    } elseif ($yesterday == $dateSelected) {
                                        # code...
                                        echo 'No Order History for Yesterday, or they\'ve all been reposted to Present Day';
                                    } else{
                                        # code...
                                        echo 'No Order History on '.$dateDisplayed.', or they\'ve all been reposted to Present Day';
                                    }
                                ?>
                                </p>
                            <?php
                        }
                    }


                    $firstOrderResult = $viewObj->viewFirstLogisticsOrder($logistics);
                    if (!empty($firstOrderResult)) {
                        # code...
                        $firstDate = date("Y-m-d", strtotime($firstOrderResult[0]['SentDateTime']));
                        ?><form action="<?php echo htmlspecialchars('includes/index-show.inc.php');?>" metthod="POST" class="show-more-or-less">
                            <?php
                            
                                if (strtotime(end($_SESSION['dateArray'])) == strtotime($firstDate)) {
                                    # code...
                                    ?><button type="button" onclick="show('more')" style="visibility: hidden;">Show More</button><?php
                                } else {
                                    ?><button type="button" onclick="show('more')">Show More</button><?php
                                }
                            ?>
                            <?php
                                if (count($_SESSION['dateArray']) > 1) {
                                    # code...
                                    ?><button type="button" onclick="show('less')">Show less</button><?php
                                }
                            ?>
                        </form><?php
                    }

                ?></div><?php
                //$orderResult = $viewObj->viewRescheduledOrder($logistics);

            } 
            
        
            
        ?></div><?php
    } elseif ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
        # code...
        ?><div class="index-div"><?php
            
            $viewObj = new View();
            $ctrlObj = new Controller();
            $ctrlObj->setIndexTime($username);
            unset($ctrlObj);


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
                        $orderResult = $viewObj->viewMerchantOrder($merchant, $dateSelected);
                        if (!empty($orderResult)) {
                            # code...

                            ?><div class="status-heading"><?php
                                                                
                                $numberDelivered = $viewObj->countMerchantDelivered($merchant, $dateSelected);
                                $numberCanceled = $viewObj->countMerchantCanceled($merchant, $dateSelected);
                                $numberRescheduled = $viewObj->countMerchantRescheduled($merchant, $dateSelected);
                                $numberPending = $viewObj->countMerchantPending($merchant, $dateSelected);
                                $numberTaken = $viewObj->countMerchantTaken($merchant, $dateSelected);
                                $numberNotContact = $viewObj->countMerchantNotContacted($merchant, $dateSelected);
                            
                                ?><div class="status-wrapper"><?php
                                    ?><div id="Delivered"></div> <p class="Delivered-text"><?php echo $numberDelivered[0]['COUNT(id)'];?> Delivered</p>
                                </div><?php
                            
                                ?><div class="status-wrapper"><?php
                                    ?><div id="Canceled"></div> <p class="Delivered-text"><?php echo $numberCanceled[0]['COUNT(id)'];?> Canceled</p>
                                </div><?php
                            
                                ?><div class="status-wrapper"><?php
                                    ?><div id="Rescheduled"></div> <p class="Delivered-text"><?php echo $numberRescheduled[0]['COUNT(id)'];?> Rescheduled</p>
                                </div><?php
                                
                                if ($dateSelected == date('Y-m-d')) {
                            
                                    ?><!--<div class="status-wrapper"><?php
                                    ?><div id="Taken"></div> <p class="Delivered-text"><?php echo $numberTaken[0]['COUNT(id)'];?> Taken</p>
                                    </div>--><?php
                            
                                    if ($numberNotContact[0]['COUNT(id)'] != 0){
                                        ?><div class="status-wrapper"><?php
                                        ?><div id="not-contacted"></div>
                                            <p class="Delivered-text">
                                                <?php echo $numberNotContact[0]['COUNT(id)']; ?> Customers has not been contacted
                                            </p><?php
                                        ?></div><?php
                                    }

                                    ?><div class="status-wrapper"><?php
                                        ?><div id="Pending"></div> <p class="Delivered-text"><?php echo $numberPending[0]['COUNT(id)'];?> Pending</p>
                                    </div><?php
                            
                                }
                            
                            ?></div> <?php

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
                                $remark = $result['Remark'];
                                if ($remark != NULL) {
                                    # code...
                                    $remark = ', '.$result['Remark'];
                                }

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
                            
                                $orderDetails = $viewObj->linkPhoneNumbers($orderDetails);

                                ?><div class="orders-holder">
                                    <div class="order-header">
                                        <div class="indicator-wrapper">
                                            <?php
                                                if ($status == 'Pending') {
                                                    # code...
                                                    ?><div id="Pending"></div>Pending<?php echo $remark;

                                                } else if ($status == 'Taken') {
                                                    # code...
                                                    ?><div id="Taken"></div>Product taken for dispatch<?php

                                                } else if ($status == 'Rescheduled') {
                                                    # code...
                                                    ?><div id="Rescheduled"></div>Rescheduled to <?php echo $newRescheduleDate;

                                                } else if ($status == 'Canceled') {
                                                    # code...
                                                    ?><div id="Canceled"></div>Canceled<?php
                                                
                                                } else if ($status == 'Delivered') {
                                                    # code...
                                                    ?><div id="Delivered"></div>Delivered<?php
                                                
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <span id="merchant-span">Order for <?php echo $quantity; ?> <?php echo $product; ?> @ <s>N</s><?php echo $price; ?> sent to <?php echo $logistics; ?>
                                    <br>Location: <?php echo $location; ?> @ <s>N</s><?php echo $cost; ?> </span>
                                    <p>
                                        <?php echo nl2br($orderDetails); ?>
                                    </p><?php

                                    if ($status != 'Canceled' && $status != 'Rescheduled') {
                                        # code...
                                        if ($status == 'Delivered') {
                                            # code...
                                            ?>
                                            <div class="comment-wrapper"><p class="report-<?php echo $x; ?>" id="contact-delivered">Delivered</p><span style="color: seagreen;" id="feedback-time-<?php echo $x; ?>"><?php echo $actionTime; ?></span> </div>
                                            
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

                                        
                                    ?><div class="order-footer">
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
                            }

                            ?><ul class="status-footing"><?php
                                $numberTotalOrder = $viewObj->countMerchantTotalOrder($merchant, $dateSelected);
                                $numberRescheduledOrder = $viewObj->countMerchantRescheduledOrder($merchant, $dateSelected);
                                $numberRepostedOrder = $viewObj->countMerchantRepostedOrder($merchant, $dateSelected);
                                $numberPostedOrder = $viewObj->countMerchantPostedOrder($merchant, $dateSelected);
                                ?><li><div id="Total-order"></div>Total Order - <?php echo $numberTotalOrder[0]['COUNT(id)']; ?></li><?php
                                
                                if ($dateSelected == date('Y-m-d')) {
                                    # code...
                                    ?><li><div id="Posted-today"></div>Posted Today - <?php echo $numberPostedOrder[0]['COUNT(id)']; ?></li><?php

                                    if ($numberTotalOrder[0]['COUNT(id)'] > $_SESSION['NewOrder']) {
                                        # code...
                                        $_SESSION['NewOrder'] = $numberTotalOrder[0]['COUNT(id)']; 
                                        ?>
                                        <script>

                                            document.getElementById("new-order-audio").play();
                                            
                                            // function playAudio() {
                                            //     x.play();
                                            // }

                                            // function pauseAudio() {
                                            //     x.pause();
                                            // }

                                        </script>
                                        <?php
                                    }
                                    
                                } elseif ($yesterday == $dateSelected) {
                                    # code...
                                    ?><li><div id="Posted-today"></div>Posted Yesterday - <?php echo $numberPostedOrder[0]['COUNT(id)']; ?></li><?php
                                } else{
                                    # code...
                                    ?><li><div id="Posted-today"></div>Posted <?php echo $dateDisplayed.' - '.$numberPostedOrder[0]['COUNT(id)']; ?></li><?php
                                }

                                ?><li><div id="Rescheduled"></div>Rescheduled from Previous Days - <?php echo $numberRescheduledOrder[0]['COUNT(id)']; ?></li><?php
                                ?><li><div id="Reposted"></div>Reposted from Previous Days - <?php echo $numberRepostedOrder[0]['COUNT(id)']; ?></li><?php
                            ?></ul> <?php


                        } else {
                            # code...
                            ?>
                            <p class="default-expression">
                                <?php
                                    if ($dateSelected == date('Y-m-d')) {
                                        # code...
                                        echo 'You\'ve not Posted any Orders Today';
                                    } elseif ($yesterday == $dateSelected) {
                                        # code...
                                        echo 'No History of Orders Delivered or Canceled Yesterday';
                                    } else{
                                        # code...
                                        echo 'No History of Orders Delivered or Canceled on '.$dateDisplayed;
                                    }
                                ?>
                            </p>
                            <?php
                        }
                    }
                    $firstOrderResult = $viewObj->viewFirstMerchantOrder($merchant);
                    if (!empty($firstOrderResult)) {
                        # code...
                        $firstDate = date("Y-m-d", strtotime($firstOrderResult[0]['SentDateTime']));
                        ?><form action="<?php echo htmlspecialchars('includes/index-show.inc.php');?>" metthod="POST" class="show-more-or-less">
                            <?php
                            
                                if (strtotime(end($_SESSION['dateArray'])) == strtotime($firstDate)) {
                                    # code...
                                    ?><button type="button" onclick="show('more')" style="visibility: hidden;">Show More</button><?php
                                } else {
                                    ?><button type="button" onclick="show('more')">Show More</button><?php
                                }
                            ?>
                            <?php
                                if (count($_SESSION['dateArray']) > 1) {
                                    # code...
                                    ?><button type="button" onclick="show('less')">Show less</button><?php
                                }
                            ?>
                        </form><?php
                    }

                ?></div><?php
            }
            
        ?></div><?php
    }
?>