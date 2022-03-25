<?php

    session_start();
    include_once "../includes/class-autoloader.inc.php";
    if (isset($_SESSION['komitexLogisticsEmail'])) { 
        $fullname = $_SESSION['komitexLogisticsFullname'];
        $username = $_SESSION['komitexLogisticsUsername'];
        $email = $_SESSION['komitexLogisticsEmail'];
        $phone = $_SESSION['komitexLogisticsPhone'];
        $accountType = $_SESSION['komitexLogisticsAccountType'];
        $profilePhoto = $_SESSION['komitexLogisticsProfilePhoto'];
        date_default_timezone_set('Africa/Lagos');
    }

    $reportDate = $_POST['date'];
    $type = $_POST['type'];

    ?>
    <div class="print-heading">
        <!-- <div class="logo"></div> -->
        <img src="images/logo2.jpg" alt="" id="cropped-logo">
        <img src="icons/logistics/018-motorcycle.png" alt="">
    </div>
    <?php

    if ($type == 'Delivered') {
        # code...
        ?><h6 class="print-title">
            Remittance Report for <?php echo $reportDate; ?>
        </h6><?php
        if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                
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
                # code...
                $orderResult = $viewObj->viewLogisticsDeliveredOrder($logistics, $reportDate);
                if (!empty($orderResult)) {
                    # code...
                    $x = 1;
                    ?><div class="table-container">
                        <table>
                            <tr>
                                <th>S/N</th>
                                <th>Merchant</th>
                                <th>Order Deatils</th>
                                <th>Product</th>
                                <th>Location</th>
                                <th>Price (<s>N</s>)</th>
                                <th>Charges (<s>N</s>)</th>
                                <th>Remittance (<s>N</s>)</th>
                            </tr><?php
    
                            $totalPrice = 0;
                            $totalCost = 0;
                            $totalRemittance = 0;
    
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
    
                                if(str_word_count($orderDetails) > 3){
                                    $words = explode(' ', $orderDetails);
                                    $a = 0;
                                    $orderDetails = '';
                                    while ($a <= 2) {
                                        # code...
                                        $orderDetails .= $words[$a].' ';
                                        $a++;
                                    }
                                    $orderDetails .= '...';
                                }
    
                                ?><tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $merchant; ?></td>
                                    <td><?php echo $orderDetails; ?></td>
                                    <td><?php echo $quantity.' '.$product; ?></td>
                                    <td><?php echo $location; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $cost; ?></td>
                                    <td><?php echo $price - $cost; ?></td>
                                </tr><?php
                                
                                $totalPrice += $price;
                                $totalCost += $cost;
                                $totalRemittance += $price - $cost;
                                $x++;
                            }
    
                            ?>
                            <tr>
                                <td class="empty-right"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-left"></td>
                                <td>Total</td>
                                <td><?php echo $totalPrice; ?></td>
                                <td><?php echo $totalCost; ?></td>
                                <td><?php echo $totalRemittance; ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <form class="print-container">
                        <button onclick="window.print()" type="button"><img src="icons/others/print.png" alt="print icon"></button>
                    </form> 
                    <?php
    
                } else {
                    # code...
                    ?><p class="default-expression">
                        No Report found...
                    </p><?php
                }
            } 
                
        } elseif ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
            # code...
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
                # code...
                $orderResult = $viewObj->viewMerchantDeliveredOrder($merchant, $reportDate);
                if (!empty($orderResult)) {
                    # code...
                    $x = 1;
                    ?><div class="table-container">
                        <table>
                            <tr>
                                <th>S/N</th>
                                <th>Logistics</th>
                                <th>Order Deatils</th>
                                <th>Product</th>
                                <th>Location</th>
                                <th>Price (<s>N</s>)</th>
                                <th>Charges (<s>N</s>)</th>
                                <th>Remittance (<s>N</s>)</th>
                            </tr><?php
    
                            $totalPrice = 0;
                            $totalCost = 0;
                            $totalRemittance = 0;
    
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
    
                                if(str_word_count($orderDetails) > 3){
                                    $words = explode(' ', $orderDetails);
                                    $a = 0;
                                    $orderDetails = '';
                                    while ($a <= 2) {
                                        # code...
                                        $orderDetails .= $words[$a].' ';
                                        $a++;
                                    }
                                    $orderDetails .= '...';
                                }
    
                                ?><tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $logistics; ?></td>
                                    <td><?php echo $orderDetails; ?></td>
                                    <td><?php echo $quantity.' '.$product; ?></td>
                                    <td><?php echo $location; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $cost; ?></td>
                                    <td><?php echo $price - $cost; ?></td>
                                </tr><?php
                                
                                $totalPrice += $price;
                                $totalCost += $cost;
                                $totalRemittance += $price - $cost;
                                $x++;
                            }
    
                            ?>
                            <tr>
                                <td class="empty-right"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-left"></td>
                                <td>Total</td>
                                <td><?php echo $totalPrice; ?></td>
                                <td><?php echo $totalCost; ?></td>
                                <td><?php echo $totalRemittance; ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <form class="print-container">
                        <button onclick="window.print()" type="button"><img src="icons/others/print.png" alt="print icon"></button>
                    </form> 
                    <?php
    
                } else {
                    # code...
                    ?><p class="default-expression">
                        No result found...
                    </p><?php
                }
            }
        }
    } else if ($type == 'Waybill') {
        # code...
        if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                
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
                # code...
                $waybillResult = $viewObj->viewWaybillReport('Logistics', $logistics, $reportDate);
                if (!empty($waybillResult)) {
                    # code...
                    $x = 1;
                    // print_r($waybillResult);
                    ?>
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>S/N</th>
                                <th>Merchant</th>
                                <th>Waybill Details</th>
                                <th>Time Sent</th>
                                <th>Time Received</th>
                                <th>Time Difference</th>
                                <th>Product</th>
                                <th>Quantity</th>

                            </tr><?php
    
                            $totalQuantity = 0;
    
                            foreach ($waybillResult as $result) {
                                # code...
                                $id = $result['id'];
                                $quantity = $result['NumberSent'];
                                $product = $result['ProductName'];
                                $logistics = $result['Logistics'];
                                $affiliate = $result['Affiliate'];
                                $agent = $result['Agent'];
                                $merchant = $result['Merchant'];
                                $waybillDetails = $result['waybillDetails'];
                                $dateTimeSent = $result['DateTimeSent'];
                                $dateTimeReceived = $result['DateTimeReceived'];

                                $newSentTime = date("h:i A", strtotime($dateTimeSent));

                                if($dateTimeReceived != NULL) {
                                    $newReceivedTime = date("h:i A", strtotime($dateTimeReceived));

                                    $timeDifference = strtotime($dateTimeReceived) - strtotime($dateTimeSent);

                                    $HOURS = intval($timeDifference / 3600);
                                    $MINUTES = intval(($timeDifference % 3600) / 60);

                                    $timeDifference = $HOURS.' hrs '.$MINUTES.' mins';

                                } else {
                                    $newReceivedTime = 'N/A';
                                    $timeDifference = 'N/A';
                                }


    
                                ?><tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $merchant; ?></td>
                                    <td><?php echo $waybillDetails; ?></td>
                                    <td><?php echo $newSentTime; ?></td>
                                    <?php 
                                        if ($newReceivedTime == 'N/A') {
                                            # code...
                                            ?><td class="N-A"><?php echo $newReceivedTime; ?></td><?php
                                            
                                        } else {
                                            # code...
                                            ?><td><?php echo $newReceivedTime; ?></td><?php
                                        }
                                        
                                        if ($timeDifference == 'N/A') {
                                            # code...
                                            ?><td class="time-difference N-A"><?php echo $timeDifference; ?></td><?php
                                            
                                        } else {
                                            # code...
                                            ?><td class="time-difference"><?php echo $timeDifference; ?></td><?php
                                        }
                                        
                                    ?>
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                </tr><?php
                                
                                $totalQuantity += $quantity;
                                $x++;
                            }
    
                            ?>
                            <tr>
                                <td class="empty-right"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-left"></td>
                                <td>Total Items Recieved</td>
                                <td><?php echo $totalQuantity; ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <form class="print-container">
                        <button onclick="window.print()" type="button"><img src="icons/others/print.png" alt="print icon"></button>
                    </form> 
                    <?php
    
                } else {
                    # code...
                    ?><p class="default-expression">
                        No Report found...
                    </p><?php
                }
            } 
                
        } elseif ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
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
                # code...
                $waybillResult = $viewObj->viewWaybillReport('Merchant', $merchant, $reportDate);
                if (!empty($waybillResult)) {
                    # code...
                    $x = 1;
                    // print_r($waybillResult);
                    ?>
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>S/N</th>
                                <th>Logistics</th>
                                <th>Waybill Details</th>
                                <th>Time Sent</th>
                                <th>Time Received</th>
                                <th>Time Difference</th>
                                <th>Product</th>
                                <th>Quantity</th>

                            </tr><?php
    
                            $totalQuantity = 0;
    
                            foreach ($waybillResult as $result) {
                                # code...
                                $id = $result['id'];
                                $quantity = $result['NumberSent'];
                                $product = $result['ProductName'];
                                $logistics = $result['Logistics'];
                                $affiliate = $result['Affiliate'];
                                $agent = $result['Agent'];
                                $merchant = $result['Merchant'];
                                $waybillDetails = $result['waybillDetails'];
                                $dateTimeSent = $result['DateTimeSent'];
                                $dateTimeReceived = $result['DateTimeReceived'];

                                $newSentTime = date("h:i A", strtotime($dateTimeSent));

                                if($dateTimeReceived != NULL) {
                                    $newReceivedTime = date("h:i A", strtotime($dateTimeReceived));

                                    $timeDifference = strtotime($dateTimeReceived) - strtotime($dateTimeSent);

                                    $HOURS = intval($timeDifference / 3600);
                                    $MINUTES = intval(($timeDifference % 3600) / 60);

                                    $timeDifference = $HOURS.' hrs '.$MINUTES.' mins';


                                } else {
                                    $newReceivedTime = 'Item not received yet';
                                    $timeDifference = 'N/A';
                                }


    
                                ?><tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $logistics; ?></td>
                                    <td><?php echo $waybillDetails; ?></td>
                                    <td><?php echo $newSentTime; ?></td>
                                    <?php 
                                        if ($newReceivedTime == 'N/A') {
                                            # code...
                                            ?><td class="N-A"><?php echo $newReceivedTime; ?></td><?php
                                            
                                        } else {
                                            # code...
                                            ?><td><?php echo $newReceivedTime; ?></td><?php
                                        }
                                        
                                        if ($timeDifference == 'N/A') {
                                            # code...
                                            ?><td class="time-difference N-A"><?php echo $timeDifference; ?></td><?php
                                            
                                        } else {
                                            # code...
                                            ?><td class="time-difference"><?php echo $timeDifference; ?></td><?php
                                        }
                                        
                                    ?>
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                </tr><?php
                                
                                $totalQuantity += $quantity;
                                $x++;
                            }
    
                            ?>
                            <tr>
                                <td class="empty-right"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-left"></td>
                                <td>Total Items Recieved</td>
                                <td><?php echo $totalQuantity; ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <form class="print-container">
                        <button onclick="window.print()" type="button"><img src="icons/others/print.png" alt="print icon"></button>
                    </form> 
                    <?php
    
                } else {
                    # code...
                    ?><p class="default-expression">
                        No Report found...
                    </p><?php
                }
            }
        }
    } else if ($type == 'Dispatch') {
        # code...
        if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                
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
                # code...
                $waybillResult = $viewObj->viewDispatchedProduct($logistics, $reportDate);
                if (!empty($waybillResult)) {
                    # code...
                    $x = 1;
                    // print_r($waybillResult);
                    ?>
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>S/N</th>
                                <th>Product</th>
                                <th>Merchant</th>
                                <th>Location</th>
                                <th>Waybill Details</th>
                                <th>Time Sent</th>
                                <th>Quantity</th>

                            </tr><?php
    
                            $totalQuantity = 0;
    
                            foreach ($waybillResult as $result) {
                                # code...
                                $id = $result['id'];
                                $quantity = $result['NumberSent'];
                                $product = $result['ProductName'];
                                $logistics = $result['Logistics'];
                                $location = $result['Location'];
                                $affiliate = $result['Affiliate'];
                                $agent = $result['Agent'];
                                $merchant = $result['Merchant'];
                                $waybillDetails = $result['waybillDetails'];
                                $dateTimeSent = $result['DateTimeSent'];

                                $newSentTime = date("h:i A", strtotime($dateTimeSent));

                                ?><tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $merchant; ?></td>
                                    <td><?php echo $location; ?></td>
                                    <td><?php echo $waybillDetails; ?></td>
                                    <td><?php echo $newSentTime; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                </tr><?php
                                
                                $totalQuantity += $quantity;
                                $x++;
                            }
    
                            ?>
                            <tr>
                                <td class="empty-right"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-center"></td>
                                <td class="empty-left"></td>
                                <td>Total Items Dispatched</td>
                                <td><?php echo $totalQuantity; ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <form class="print-container">
                        <button onclick="window.print()" type="button"><img src="icons/others/print.png" alt="print icon"></button>
                    </form> 
                    <?php
    
                } else {
                    # code...
                    ?><p class="default-expression">
                        No Report found...
                    </p><?php
                }
            } 
                
        }
    }

?>