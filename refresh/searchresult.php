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
        $LIMIT = $_SESSION['searchArray'];
    } else {
        # code...
        header("location: ..logout.php");
    }
    
    $searchKey = $_POST['searchKey'];
    $sort = $_POST['sort'];
    $show = $_POST['show'];

    if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {

        ?><div class="index-div"><?php
            
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

            if (!empty($contactResult) || $accountType == 'Logistics') {
                
                ?><div class="orders-container"><?php

                    $countResult = $viewObj->countLogisiticsOrderSearch($searchKey, $logistics, $sort, $show);
                    // print_r($countResult);
                    ?><div class="count-search-result"><?php
                        ?><p><?php echo $countResult[0]['COUNT(id)'];?> Results found</p>
                    </div><?php


                    //print_r($countResult);
                    $orderResult = $viewObj->viewLogisiticsOrderSearch($searchKey ,$logistics, $sort, $show);
                    if (!empty($orderResult)) {
                        # code...
                        $x = 1;
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
                            $merchant = $result['Merchant'];
                            $uploader = $result['Affiliate'];
                            if ($uploader == NULL) {
                                # code...
                                $uploader = $merchant;
                            }
                            $take = $result['Agent'];
                            if ($take == $username) {
                                # code...
                                $take = 'you';
                            }
                            $enableEdit = $result['EnableEdit'];
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
                            
                            $sentDateTime = $result['SentDateTime'];
                            $newSentTime = date("h:i A", strtotime($sentDateTime));
                            $newSentDate = date("D F jS Y", strtotime($sentDateTime));
                            
                            $currentDate = date("Y-m-d");

                            // $orderDetails = $viewObj->linkPhoneNumbers($orderDetails);
                            
                            $lastPos = 0;
                            $orderPositions = array();
                            while (($lastPos = stripos($orderDetails, $searchKey, $lastPos)) !== false) {
                                $orderPositions[] = $lastPos;
                                $lastPos = $lastPos + strlen($searchKey);
                            }
                            rsort($orderPositions);
                            $m = strlen($searchKey);
                            foreach ($orderPositions as $n) {
                                $p = $m + $n;
                                $orderDetails = substr_replace($orderDetails, '</mark>', $p, 0);
                                $orderDetails = substr_replace($orderDetails, '<mark>', $n, 0);
                            }
                            $orderPositions = array();
                            
                            $lastPos = 0;
                            $locationPositions = array();
                            while (($lastPos = stripos($location, $searchKey, $lastPos)) !== false) {
                                $locationPositions[] = $lastPos;
                                $lastPos = $lastPos + strlen($searchKey);
                            }
                            rsort($locationPositions);
                            $m = strlen($searchKey);
                            foreach ($locationPositions as $n) {
                                $p = $m + $n;
                                $location = substr_replace($location, '</mark>', $p, 0);
                                $location = substr_replace($location, '<mark>', $n, 0);
                            }
                            $locationPositions = array();

                            
                            $lastPos = 0;
                            $productPositions = array();
                            while (($lastPos = stripos($product, $searchKey, $lastPos)) !== false) {
                                $productPositions[] = $lastPos;
                                $lastPos = $lastPos + strlen($searchKey);
                            }
                            rsort($productPositions);
                            $m = strlen($searchKey);
                            foreach ($productPositions as $n) {
                                $p = $m + $n;
                                $product = substr_replace($product, '</mark>', $p, 0);
                                $product = substr_replace($product, '<mark>', $n, 0);
                            }
                            $productPositions = array();

                            
                            $lastPos = 0;
                            $pricePositions = array();
                            while (($lastPos = stripos($price, $searchKey, $lastPos)) !== false) {
                                $pricePositions[] = $lastPos;
                                $lastPos = $lastPos + strlen($searchKey);
                            }
                            rsort($pricePositions);
                            $m = strlen($searchKey);
                            foreach ($pricePositions as $n) {
                                $p = $m + $n;
                                $price = substr_replace($price, '</mark>', $p, 0);
                                $price = substr_replace($price, '<mark>', $n, 0);
                            }
                            $pricePositions = array();

                            
                            $lastPos = 0;
                            $merchantPositions = array();
                            while (($lastPos = stripos($merchant, $searchKey, $lastPos)) !== false) {
                                $merchantPositions[] = $lastPos;
                                $lastPos = $lastPos + strlen($searchKey);
                            }
                            rsort($merchantPositions);
                            $m = strlen($searchKey);
                            foreach ($merchantPositions as $n) {
                                $p = $m + $n;
                                $merchant = substr_replace($merchant, '</mark>', $p, 0);
                                $merchant = substr_replace($merchant, '<mark>', $n, 0);
                            }
                            $merchantPositions = array();

                            $lastPos = 0;
                            $uploaderPositions = array();
                            while (($lastPos = stripos($uploader, $searchKey, $lastPos)) !== false) {
                                $uploaderPositions[] = $lastPos;
                                $lastPos = $lastPos + strlen($searchKey);
                            }
                            rsort($uploaderPositions);
                            $m = strlen($searchKey);
                            foreach ($uploaderPositions as $n) {
                                $p = $m + $n;
                                $uploader = substr_replace($uploader, '</mark>', $p, 0);
                                $uploader = substr_replace($uploader, '<mark>', $n, 0);
                            }
                            $uploaderPositions = array();

                            
                            $lastPos = 0;
                            $takePositions = array();
                            if (strtolower($searchKey) == strtolower($username)) {
                                # code...
                                while (($lastPos = stripos($take, 'you', $lastPos)) !== false) {
                                    $takePositions[] = $lastPos;
                                    $lastPos = $lastPos + strlen('you');
                                }
    
                            } else {
                                while (($lastPos = stripos($take, $searchKey, $lastPos)) !== false) {
                                    $takePositions[] = $lastPos;
                                    $lastPos = $lastPos + strlen($searchKey);
                                }
    
                            }
                            rsort($takePositions);
                            $m = strlen($searchKey);
                            foreach ($takePositions as $n) {
                                $p = $m + $n;
                                $take = substr_replace($take, '</mark>', $p, 0);
                                $take = substr_replace($take, '<mark>', $n, 0);
                            }
                            $takePositions = array();
                            
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
                                                echo $take.' '.$actionTime;
                                            
                                            } else if ($status == 'Delivered') {
                                                # code...
                                                ?><div id="Delivered"></div>Delivered by <?php 
                                                echo $take.' '.$actionTime;
                                            
                                            }
                                        ?>
                                    </div>
                                </div>
                                <span>Order for <?php echo $quantity; ?> <?php echo $product; ?> @ <s>N</s><?php echo $price; ?></span>
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
                                                <div class="comment-wrapper"><p class="report-<?php echo $x; ?>" id="contact-true"><?php echo $feedback; ?></p><span id="feedback-time-<?php echo $x; ?>"><?php echo $actionTime; ?></span> </div>
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
                                        ?>
                                        <form action="<?php echo htmlspecialchars('includes/index.inc.php');?>" method="POST" class="take-form">
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
                                ?>
                                <div class="order-footer">
                                    <p>Sent <?php echo $newSentTime; ?> <br> <?php echo $newSentDate; ?></p>
                                    <p>Uploaded by <?php echo $uploader; ?></p>
                                </div><?php
                            ?></div><?php
                            $x++;
                        }

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

                    } else {
                        # code...
                        ?>
                            <p class="default-expression">
                                No results found
                            </p>
                        <?php
                    }

                ?></div><?php
            } 
            
        ?></div><?php

    } elseif ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
        # code...
        ?><div class="index-div"><?php
            
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
                
                $countResult = $viewObj->countMerchantOrderSearch($searchKey ,$merchant, $sort, $show);
                ?><div class="count-search-result"><?php
                    ?><p><?php echo $countResult[0]['COUNT(id)'];?> Results found</p>
                </div><?php
                
                $orderResult = $viewObj->viewMerchantOrderSearch($searchKey, $merchant, $sort, $show);
                if (!empty($orderResult)) {
                    # code...
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
                        $merchant = $result['Merchant'];
                        $uploader = $result['Affiliate'];
                        if ($uploader == NULL) {
                            # code...
                            $uploader = $merchant;
                        }
                        if (strtolower($username) == strtolower($uploader)) {
                            # code...
                            $uploader = 'you';
                        }
                        $take = $result['Agent'];
                        $enableEdit = $result['EnableEdit'];
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
                        $actionTime = date("h:i a, D F jS Y", strtotime($dateTime));

                        $sentDateTime = $result['SentDateTime'];
                        $newSentTime = date("h:i A", strtotime($sentDateTime));
                        $newSentDate = date("D F jS Y", strtotime($sentDateTime));

                        $currentDate = date("Y-m-d");

                        // $orderDetails = $viewObj->linkPhoneNumbers($orderDetails);
                        
                        $lastPos = 0;
                        $orderPositions = array();
                        while (($lastPos = stripos($orderDetails, $searchKey, $lastPos)) !== false) {
                            $orderPositions[] = $lastPos;
                            $lastPos = $lastPos + strlen($searchKey);
                        }
                        rsort($orderPositions);
                        $m = strlen($searchKey);
                        foreach ($orderPositions as $n) {
                            $p = $m + $n;
                            $orderDetails = substr_replace($orderDetails, '</mark>', $p, 0);
                            $orderDetails = substr_replace($orderDetails, '<mark>', $n, 0);
                        }
                        $orderPositions = array();
                        
                        
                        $lastPos = 0;
                        $locationPositions = array();
                        while (($lastPos = stripos($location, $searchKey, $lastPos)) !== false) {
                            $locationPositions[] = $lastPos;
                            $lastPos = $lastPos + strlen($searchKey);
                        }
                        rsort($locationPositions);
                        $m = strlen($searchKey);
                        foreach ($locationPositions as $n) {
                            $p = $m + $n;
                            $location = substr_replace($location, '</mark>', $p, 0);
                            $location = substr_replace($location, '<mark>', $n, 0);
                        }
                        $locationPositions = array();

                        
                        $lastPos = 0;
                        $productPositions = array();
                        while (($lastPos = stripos($product, $searchKey, $lastPos)) !== false) {
                            $productPositions[] = $lastPos;
                            $lastPos = $lastPos + strlen($searchKey);
                        }
                        rsort($productPositions);
                        $m = strlen($searchKey);
                        foreach ($productPositions as $n) {
                            $p = $m + $n;
                            $product = substr_replace($product, '</mark>', $p, 0);
                            $product = substr_replace($product, '<mark>', $n, 0);
                        }
                        $productPositions = array();

                        
                        $lastPos = 0;
                        $pricePositions = array();
                        while (($lastPos = stripos($price, $searchKey, $lastPos)) !== false) {
                            $pricePositions[] = $lastPos;
                            $lastPos = $lastPos + strlen($searchKey);
                        }
                        rsort($pricePositions);
                        $m = strlen($searchKey);
                        foreach ($pricePositions as $n) {
                            $p = $m + $n;
                            $price = substr_replace($price, '</mark>', $p, 0);
                            $price = substr_replace($price, '<mark>', $n, 0);
                        }
                        $pricePositions = array();

                        
                        $lastPos = 0;
                        $logisticsPositions = array();
                        while (($lastPos = stripos($logistics, $searchKey, $lastPos)) !== false) {
                            $logisticsPositions[] = $lastPos;
                            $lastPos = $lastPos + strlen($searchKey);
                        }
                        rsort($logisticsPositions);
                        $m = strlen($searchKey);
                        foreach ($logisticsPositions as $n) {
                            $p = $m + $n;
                            $logistics = substr_replace($logistics, '</mark>', $p, 0);
                            $logistics = substr_replace($logistics, '<mark>', $n, 0);
                        }
                        $merchantPositions = array();

                        $lastPos = 0;
                        $uploaderPositions = array();
                        if (strtolower($searchKey) == strtolower($username)) {
                            # code...
                            while (($lastPos = stripos($uploader, 'you', $lastPos)) !== false) {
                                $uploaderPositions[] = $lastPos;
                                $lastPos = $lastPos + strlen('you');
                            }

                        } else {
                            while (($lastPos = stripos($uploader, $searchKey, $lastPos)) !== false) {
                                $uploaderPositions[] = $lastPos;
                                $lastPos = $lastPos + strlen($searchKey);
                            }

                        }
                        rsort($uploaderPositions);
                        $m = strlen($searchKey);
                        foreach ($uploaderPositions as $n) {
                            $p = $m + $n;
                            $uploader = substr_replace($uploader, '</mark>', $p, 0);
                            $uploader = substr_replace($uploader, '<mark>', $n, 0);
                        }
                        $uploaderPositions = array();

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
                            </p>

                            <?php

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
                                            <div class="comment-wrapper"><p class="report-<?php echo $x; ?>" id="contact-true"><?php echo $feedback; ?></p><span id="feedback-time-<?php echo $x; ?>"><?php echo $actionTime; ?></span> </div>
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
                                
                                
                            ?>
                            <div class="order-footer">
                                <p>Sent <?php echo $newSentTime; ?> <br> <?php echo $newSentDate; ?></p>
                                <p>Uploaded by <?php echo $uploader; ?></p>
                            </div><?php
                        ?></div><?php
                    }

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

                } else {
                    # code...
                    ?>
                        <p class="default-expression">
                            No results found
                        </p>
                    <?php
                }
            }
            
        ?></div><?php
    }
?>