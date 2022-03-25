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
        $LIMIT = $_SESSION['searchArray'];
    } else {
        # code...
        header("location: ..index.php");
    }
    

    
    $ctrlObj = new Controller();

    $ctrlObj->setContactsTime($username);

    unset($ctrlObj);
    
    $contactObj = new View;

    $results = $contactObj->viewContactsLimit($username, $accountType);

    $countContactsResult = $contactObj->viewContactsCount($username, $accountType);


    if (!empty($results)) {
        # code...
        $x = 0;
        foreach ($results as $result) {
            # code...
            $x++;
            $status = $result['Status'];
            
            if (strtolower($username) == strtolower($result['Agent']) && $accountType ==  'Agent') {
                # code...
                if ($result['Logistics'] != NULL) {
                    $username02 =  $result['Logistics'];

                    $agent = $contactObj->getContactDetails($username02);

                    $contactPhoto = $agent[0]['komitexLogisticsProfilePhoto'];
                    $contactPhone = $agent[0]['komitexLogisticsPhone'];
                    $accountType02 = $agent[0]['komitexLogisticsAccountType'];
                    
                }
                
            } else if (strtolower($username) == strtolower($result['Affiliate']) && $accountType ==  'Affiliate') {
                # code...
                if ($result['Merchant'] != NULL) {
                    $username02 =  $result['Merchant'];
                    
                    $affiliate = $contactObj->getContactDetails($username02);
                    
                    $contactPhoto = $affiliate[0]['komitexLogisticsProfilePhoto'];
                    $contactPhone = $affiliate[0]['komitexLogisticsPhone'];
                    $accountType02 = $affiliate[0]['komitexLogisticsAccountType'];
                
                }

            } else if (strtolower($username) == strtolower($result['Logistics']) && $accountType ==  'Logistics') {
                # code...
                if ($result['Agent'] != NULL && $result['Merchant'] == NULL) {
                    $username02 =  $result['Agent'];

                    $agent = $contactObj->getContactDetails($username02);

                    $contactPhoto = $agent[0]['komitexLogisticsProfilePhoto'];
                    $contactPhone = $agent[0]['komitexLogisticsPhone'];
                    $accountType02 = $agent[0]['komitexLogisticsAccountType'];
                    
                }else if ($result['Agent'] == NULL && $result['Merchant'] != NULL) {
                    $username02 =  $result['Merchant'];

                    $merchant = $contactObj->getContactDetails($username02);
                    
                    $contactPhoto = $merchant[0]['komitexLogisticsProfilePhoto'];
                    $contactPhone = $merchant[0]['komitexLogisticsPhone'];
                    $accountType02 = $merchant[0]['komitexLogisticsAccountType'];
                    
                }

            } else if (strtolower($username) == strtolower($result['Merchant']) && $accountType ==  'Merchant') {
                # code...
                if ($result['Affiliate'] != NULL && $result['Logistics'] == NULL) {
                    $username02 =  $result['Affiliate'];

                    $affiliate = $contactObj->getContactDetails($username02);

                    $contactPhoto = $affiliate[0]['komitexLogisticsProfilePhoto'];
                    $contactPhone = $affiliate[0]['komitexLogisticsPhone'];
                    $accountType02 = $affiliate[0]['komitexLogisticsAccountType'];
                    
                }else if ($result['Affiliate'] == NULL && $result['Logistics'] != NULL) {
                    $username02 =  $result['Logistics'];

                    $logistics = $contactObj->getContactDetails($username02);
                    
                    $contactPhoto = $logistics[0]['komitexLogisticsProfilePhoto'];
                    $contactPhone = $logistics[0]['komitexLogisticsPhone'];
                    $accountType02 = $logistics[0]['komitexLogisticsAccountType'];
                    
                }
                //echo 'confirm';
            }
            
            if (!($accountType == 'Logistics' && $status == 'Declined')) {
                # code...
                ?>
                <div class="connections-wrapper">
                    <span class="accountType-indicator"><?php echo $accountType02; ?></span>
                    <div class="connections-profile">
                        <div class="connections-profile-photo" style="background-image: url(<?php echo $contactPhoto; ?>);"></div>
                        <div class="contact-info">
                            <h3><?php echo $username02; ?></h3>
                            <p><a href="tel:<?php echo $contactPhone; ?>"><?php echo $contactPhone; ?></a></p>
                        </div>
                    </div>
                    <?php
                        if ($accountType02 == 'Agent' && $accountType == 'Logistics') {
                            # code...?>
                            <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="remove-form" method="POST" onsubmit="return confirm('Are you sure you want to remove this agent?')">
                                <input type="hidden" name="username01" value="<?php echo $username; ?>">
                                <input type="hidden" name="username02" value="<?php echo $username02; ?>">
                                <input type="hidden" name="accountType01" value="<?php echo $accountType; ?>">
                                <input type="hidden" name="accountType02" value="<?php echo $accountType02; ?>">
                                <button type="submit" name="removeContact" onclick="removeContact(<?php echo $username.', '.$accountType.', '.$username02.', '.$accountType02?>)">Remove <?php echo $accountType02; ?></button>
                            </form> 

                            <?php
                        } else if ($accountType02 == 'Affiliate' && $accountType == 'Merchant') {
                            # code...?>
                            <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="remove-form" method="POST" onsubmit="return confirm('Are you sure you want to remove this affiliate?')">
                                <input type="hidden" name="username01" value="<?php echo $username; ?>">
                                <input type="hidden" name="username02" value="<?php echo $username02; ?>">
                                <input type="hidden" name="accountType01" value="<?php echo $accountType; ?>">
                                <input type="hidden" name="accountType02" value="<?php echo $accountType02; ?>">
                                <button type="submit" name="removeContact" onclick="removeContact(<?php echo $username.', '.$accountType.', '.$username02.', '.$accountType02?>)">Remove <?php echo $accountType02; ?></button>
                            </form>

                            <?php
                        } else if ($accountType02 == 'Merchant' && $accountType == 'Logistics' && $status == 'Not Approved'){
                            # code...?>
                            
                            <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="remove-form" method="POST" onsubmit="return confirm('Confirm Merchant? This cannot be undone')">
                                <input type="hidden" name="username01" value="<?php echo $username; ?>">
                                <input type="hidden" name="username02" value="<?php echo $username02; ?>">
                                <input type="hidden" name="accountType01" value="<?php echo $accountType; ?>">
                                <input type="hidden" name="accountType02" value="<?php echo $accountType02; ?>">
                                <button type="submit" name="confirmContact" id="logistics-confirm">Confirm</button>
                                <button type="submit" name="declineContact" id="logistics-decline">Decline</button>
                            </form>

                            <?php
                        } else if ($accountType == 'Merchant' && $accountType02 == 'Logistics' && $status == 'Not Approved'){
                            # code...?>

                            <div class="remove-form">
                                <p id="awaiting">Awaiting Confirmation!</p>
                            </div>

                            <?php
                        } else if ($accountType == 'Merchant' && $accountType02 == 'Logistics' && $status == 'Declined'){
                            # code...?>

                            <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="remove-form" method="POST" onsubmit="return confirm('Confirm Merchant? This cannot be undone')">
                                <input type="hidden" name="username01" value="<?php echo $username; ?>">
                                <input type="hidden" name="username02" value="<?php echo $username02; ?>">
                                <input type="hidden" name="accountType01" value="<?php echo $accountType; ?>">
                                <input type="hidden" name="accountType02" value="<?php echo $accountType02; ?>">
                                <label id="declined" for="logistics-confirm">Your request was declined!</label>
                                <button type="submit" name="resendContact" id="logistics-confirm">Resend</button>
                            </form>

                            <?php
                        }
                    ?>
                </div>
                <?php
            }

        }

        $checkNumber = $x % 2;
        if ($checkNumber == 1) {
            ?>
                <div class="connections-wrapper" style="visibility: hidden;">
                    <span class="accountType-indicator"><?php echo $accountType02; ?></span>
                    <div class="connections-profile">
                        <div class="connections-profile-photo" style="background-image: url(<?php echo $contactPhoto; ?>);"></div>
                        <div class="contact-info">
                            <h3><?php echo $username02; ?></h3>
                            <p><a href="tel:<?php echo $contactPhone; ?>"><?php echo $contactPhone; ?></a></p>
                        </div>
                    </div>
                </div>
            <?php
            # code...
        }

        if ($accountType == 'Merchant' || $accountType == 'Logistics'  ) {
            # code...
            if ($accountType == 'Merchant') {
                $countResult = $contactObj->viewContactsCount($username, 'Merchant');
            }
            if ($accountType == 'Logistics'  ) {
                $countResult = $contactObj->viewContactsCount($username, 'Logistics');
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
        }

        // echo $countContactsResult[0]['COUNT(id)'];
        // echo $_SESSION['searchArray'];
        // $countContactsResult[0]['COUNT(id)'] = 15;
    
        if ($countContactsResult[0]['COUNT(id)'] > $LIMIT) {
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
                    if ($_SESSION['searchArray'] > 10 && $countContactsResult[0]['COUNT(id)'] > 10) {
                        # code...
                        ?><button type="button" onclick="limit('less')">Show less</button><?php
                    }
                ?>
            </form><?php

        }
    }


?>