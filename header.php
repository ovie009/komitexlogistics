<?php 
    
    include_once "includes/class-autoloader.inc.php";

    if (isset($_SESSION['komitexLogisticsEmail'])) {
        $fullname = $_SESSION['komitexLogisticsFullname'];
        $username = $_SESSION['komitexLogisticsUsername'];
        $email = $_SESSION['komitexLogisticsEmail'];
        $phone = $_SESSION['komitexLogisticsPhone'];
        $accountType = $_SESSION['komitexLogisticsAccountType'];
        $profilePhoto = $_SESSION['komitexLogisticsProfilePhoto'];

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
        } else if ($accountType == 'Merchant') {
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
    }
    
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    ?> <input type="hidden" id="page-url" value="<?php echo $url;?>"> <?php
?>
<!-- <header id="main-header" style="background-color: black;"> -->
<header id="main-header">
    <audio src="audio/neworder.mp3" id="new-order-audio"></audio>
    <nav class="main-nav">
        <a class="logo-container" href="index">
            <div class="logo"></div>
            <img src="icons/logistics/018-motorcycle.png" alt="">
        </a>
        <button type="button" class="dropdown" id="dropdown-button">
            <?php
                if (isset($_SESSION['komitexLogisticsEmail'])) {
                    $waybillCount = 0;
                    if (strpos($url, "Tab=waybill") == false) {
                        # code...                        
                        if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                            $result = $viewObj->getContactDetails($username);
                            $waybillDateTime = $result[0]['waybill'];
    
                            $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $logistics, 'Logistics');
    
                            $waybillCount += $waybillCountResult[0]['COUNT(id)'];
    
                            
                        } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                            $result = $viewObj->getContactDetails($username);
                            $waybillDateTime = $result[0]['waybill'];
    
                            $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $merchant, 'Merchant');
                            
                            $waybillCount += $waybillCountResult[0]['COUNT(id)'];
                            
                        }
                    }

                    if (strpos($url, "index") == false) {
                        # code...
                        if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                            $result = $viewObj->getContactDetails($username);
                            $waybillDateTime = $result[0]['home'];
                
                            $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $logistics, 'Logistics');
                
                            $waybillCount += $waybillCountResult[0]['COUNT(id)'];
                        
                        } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                            $result = $viewObj->getContactDetails($username);
                            $waybillDateTime = $result[0]['home'];
            
                            $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $merchant, 'Merchant');
            
                            $waybillCount += $waybillCountResult[0]['COUNT(id)'];
            
                        }
                    } 

                    if (strpos($url, "accountinfo") == false) {
                        # code...
                        if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                            $result = $viewObj->getContactDetails($username);
                            $waybillDateTime = $result[0]['contacts'];
                
                            $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $logistics, 'Logistics');
                
                            $waybillCount += $waybillCountResult[0]['COUNT(id)'];
                        
                        } else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                            $result = $viewObj->getContactDetails($username);
                            $waybillDateTime = $result[0]['contacts'];
            
                            $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $merchant, 'Merchant');
            
                            $waybillCount += $waybillCountResult[0]['COUNT(id)'];
            
                        }
                    } 

                    if ($waybillCount > 0) {
                        # code...
                        ?><div class="nav-notification"><?php echo $waybillCount; ?></div><?php
                    }

                    $_SESSION['NewContent'] = $waybillCount;


                }

            ?>
            <img src="icons/dropdown/interface.png" alt="">
        </button>
        <?php
            if (!isset($_SESSION['komitexLogisticsEmail'])) {
                ?>      
                <div class="form-wrapper">
                    <form action="<?php echo htmlspecialchars('includes/login.inc.php');?>" method="POST" id="main-login-form">
                        <input type="text" name="user" id="nav-user" placeholder="email or Username" title="e.g. Janedoe@gmail.com OR Janedoe007" required>
                        <input type="password" name="password" id="nav-password" placeholder="password" title="password" required>
                        <button type="submit" name="login" id="nav-submit">login</button>
                    </form>
                    <p>
                        I don't have an account? <a href="signup">signup</a>
                    </p>
                </div>
                <?php
            }
        ?>
    </nav>
    <?php
        if (isset($_SESSION['komitexLogisticsEmail'])) {
            ?>  
            <nav class="link-wrapper">
                <ul>
                    <?php
                        if ($_SESSION['komitexLogisticsAccountType'] == NULL) {
                            ?>
                            <li class="index><a class="index-li-a" href="index">Home</a></li>
                            <li class="orders-li"><a href="orders">Orders</a></li>
                            <li class="mydeliveries-li"><a href="mydeliveries">My Deliveries</a></li>
                            <li class="ranking-li"><a href="ranking">Ranking</a></li>
                            <li class="report-li"><a href="report">Report</a></li>
                            <li class="transactions-li"><a href="transactions">Transcations</a></li>
                            <li class="waybill-li"><a href="waybill">Waybill<br>/Products</a></li>
                            <li class="accountinfo-li"><a href="accountinfo">Account Info</a></li>
                            <?php
                        }else if ($_SESSION['komitexLogisticsAccountType'] == 'Affiliate'){ 
                            ?>
                            <li class="index-li"><a href="index">Home</a></li>
                            <li class="orders-li"><a href="orders">Orders</a></li>
                            <li class="ranking-li"><a href="ranking">Ranking</a></li>
                            <li class="report-li"><a href="report">Report</a></li>
                            <li class="transactions-li"><a href="transactions">Transcations</a></li>
                            <li class="waybill-li"><a href="waybill">Waybill<br>/Products</a></li>
                            <li class="accountinfo-li"><a href="accountinfo">Account Info</a></li>
                            <?php
                        }else if ($_SESSION['komitexLogisticsAccountType'] == 'Agent'){ 
                            ?>
                            <li class="index-li"><a href="index">Home</a></li>
                            <li class="mydeliveries-li"><a href="mydeliveries">My Deliveries</a></li>
                            <li class="ranking-li"><a href="ranking">Ranking</a></li>
                            <li class="transactions-li"><a href="transactions">Transcations</a></li>
                            <li class="waybill-li"><a href="waybill">Waybill<br>/Products</a></li>
                            <li class="accountinfo-li"><a href="accountinfo">Account Info</a></li>
                            <?php
                        }else if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics'){ 
                            ?>
                            <li class="index-li"><a href="index">Home</a></li>
                            <li class="mydeliveries-li"><a href="mydeliveries">My Deliveries</a></li>
                            <li class="ranking-li"><a href="ranking">Ranking</a></li>
                            <li class="report-li"><a href="report">Report</a></li>
                            <li class="transactions-li"><a href="transactions">Transcations</a></li>
                            <li class="waybill-li"><a href="waybill">Waybill<br>/Products</a></li>
                            <li class="accountinfo-li"><a href="accountinfo">Account Info</a></li>
                            <?php
                        }else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant'){ 
                            ?>
                            <li class="index-li"><a href="index">Home</a></li>
                            <li class="orders-li"><a href="orders">Orders</a></li>
                            <li class="ranking-li"><a href="ranking">Ranking</a></li>
                            <li class="report-li"><a href="report">Report</a></li>
                            <li class="transactions-li"><a href="transactions">Transcations</a></li>
                            <li class="waybill-li"><a href="waybill">Waybill<br>/Products</a></li>
                            <li class="accountinfo-li"><a href="accountinfo">Account Info</a></li>
                            <?php
                        }
                    ?>
                </ul>
            </nav>
            <?php
        }
    ?>
        
    <nav class="side-nav">
        <div class="side-nav-wrapper">
            <?php
                if (!isset($_SESSION['komitexLogisticsEmail'])) {
                    ?>  
                    <div class="side-nav-form-wrapper">
                        <form action="<?php echo htmlspecialchars('includes/login.inc.php');?>" method="POST" id="side-login-form">
                            <input type="text" name="user" id="side-nav-user" placeholder="email or username" title="e.g. Janedoe@gmail.com OR Janedoe007" required>
                            <input type="password" name="password" id="side-nav-password" placeholder="password" title="password" required>
                            <button type="submit" name="login" id="side-nav-submit">login</button>
                        </form>
                        <p>
                            I don't have an account? <a href="signup">signup</a>
                        </p>
                    </div>
                    <?php
                } else{ 
                    ?>
                    <ul>
                        <?php
                            if ($_SESSION['komitexLogisticsAccountType'] == NULL) {
                                ?>
                                <li class="index-li"><a href="index">Home</a></li>
                                <li class="orders-li"><a href="orders">Orders</a></li>
                                <li class="mydeliveries-li"><a href="mydeliveries">My Deliveries</a></li>
                                <li class="ranking-li"><a href="ranking">Ranking</a></li>
                                <li class="report-li"><a href="report">Report</a></li>
                                <li class="transactions-li"><a href="transactions">Transcations</a></li>
                                <li class="waybill-li"><a href="waybill">Waybill/Products</a></li>
                                <li class="accountinfo-li"><a href="accountinfo">Account Info</a></li>
                                <?php
                            }else if ($_SESSION['komitexLogisticsAccountType'] == 'Affiliate'){ 
                                ?>
                                <li class="index-li">
                                    <a href="index" id="home-link">
                                        Home
                                        <?php

                                            if (strpos($url, "index") == false) {
                                                # code...
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['home'];
                                    
                                                $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $merchant, 'Merchant');
                                    
                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }

                                            } 
                    
                    
                                        ?>
                                    </a>
                                </li>
                                <li class="orders-li"><a href="orders">Orders</a></li>
                                <li class="ranking-li"><a href="ranking">Ranking</a></li>
                                <li class="report-li"><a href="report">Report</a></li>
                                <li class="transactions-li"><a href="transactions">Transcations</a></li>
                                <li class="waybill-li">
                                    <a id="waybill-link" href="waybill">
                                        Waybill/Products
                                        <?php
                                        
                                            if (strpos($url, "index") == false) {
                                            
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['waybill'];

                                                $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $merchant, 'Merchant');

                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }
                                            }
                                            
                                        ?>
                                    </a>
                                </li>
                                <li class="accountinfo-li">
                                    <a id="contact-link" href="accountinfo">
                                        Account Info
                                        <?php

                                            if (strpos($url, "accountinfo") == false) {
                                                # code...
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['contacts'];
                                
                                                $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $merchant, 'Merchant');
                                
                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }

                                            }
                                        
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }else if ($_SESSION['komitexLogisticsAccountType'] == 'Agent'){ 
                                ?>
                                <li class="index-li">
                                    <a href="index" id="home-link">
                                        Home
                                        <?php

                                            if (strpos($url, "index") == false) {
                                                # code...
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['home'];
                                    
                                                $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $logistics, 'Logistics');
                                    
                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }

                                            } 
                    
                    
                                        ?>
                                    </a>
                                </li>
                                <li class="mydeliveries-li"><a href="mydeliveries">My Deliveries</a></li>
                                <li class="ranking-li"><a href="ranking">Ranking</a></li>
                                <li class="transactions-li"><a href="transactions">Transcations</a></li>
                                <li class="waybill-li">
                                    <a id="waybill-link" href="waybill">
                                        Waybill/Products
                                        <?php
                                                
                                            if (strpos($url, "index") == false) {
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['waybill'];

                                                $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $logistics, 'Logistics');

                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }
                                            }

                                        ?>
                                    </a>
                                </li>
                                <li class="accountinfo-li">
                                    <a id="contact-link" href="accountinfo">
                                        Account Info
                                        <?php

                                            if (strpos($url, "accountinfo") == false) {
                                                # code...
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['contacts'];
                                
                                                $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $logistics, 'Logistics');
                                
                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }

                                            }
                                        
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }else if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics'){ 
                                ?>
                                <li class="index-li">
                                    <a href="index" id="home-link">
                                        Home
                                        <?php

                                            if (strpos($url, "index") == false) {
                                                # code...
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['home'];
                                    
                                                $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $logistics, 'Logistics');
                                    
                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }

                                            } 
                    
                    
                                        ?>
                                    </a>
                                </li>
                                <li class="mydeliveries-li"><a href="mydeliveries">My Deliveries</a></li>
                                <li class="ranking-li"><a href="ranking">Ranking</a></li>
                                <li class="report-li"><a href="report">Report</a></li>
                                <li class="transactions-li"><a href="transactions">Transcations</a></li>
                                <li class="waybill-li">
                                    <a id="waybill-link" href="waybill">
                                        Waybill/Products
                                        <?php
                                        
                                            if (strpos($url, "Tab=waybill") == false) {
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['waybill'];

                                                $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $logistics, 'Logistics');

                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }
                                            }

                                        ?>
                                    </a>
                                </li>
                                <li class="accountinfo-li">
                                    <a id="contact-link" href="accountinfo">
                                        Account Info
                                        <?php

                                            if (strpos($url, "accountinfo") == false) {
                                                # code...
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['contacts'];
                                
                                                $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $logistics, 'Logistics');
                                
                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }

                                            }
                                        
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }else if ($_SESSION['komitexLogisticsAccountType'] == 'Merchant'){ 
                                ?>
                                <li class="index-li">
                                    <a href="index" id="home-link">
                                        Home
                                        <?php

                                            if (strpos($url, "index") == false) {
                                                # code...
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['home'];

                                                $waybillCountResult = $viewObj->viewNewOrderCount($waybillDateTime, $merchant, 'Merchant');

                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }

                                            } 


                                        ?>
                                    </a>
                                </li>
                                <li class="orders-li"><a href="orders">Orders</a></li>
                                <li class="ranking-li"><a href="ranking">Ranking</a></li>
                                <li class="report-li"><a href="report">Report</a></li>
                                <li class="transactions-li"><a href="transactions">Transcations</a></li>
                                <li class="waybill-li">
                                    <a id="waybill-link" href="waybill">
                                        Waybill/Products
                                        <?php
                                        
                                            if (strpos($url, "Tab=waybill") == false) {

                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['waybill'];

                                                $waybillCountResult = $viewObj->viewNewWaybillCount($waybillDateTime, $merchant, 'Merchant');

                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }
                                            }

                                        ?>
                                    </a>
                                </li>
                                <li class="accountinfo-li">
                                    <a id="contact-link" href="accountinfo">
                                        Account Info
                                        <?php

                                            if (strpos($url, "accountinfo") == false) {
                                                # code...
                                                $result = $viewObj->getContactDetails($username);
                                                $waybillDateTime = $result[0]['contacts'];
                                
                                                $waybillCountResult = $viewObj->viewNewContactsCount($waybillDateTime, $merchant, 'Merchant');
                                
                                                $waybillCount = $waybillCountResult[0]['COUNT(id)'];

                                                if ($waybillCount > 0) {
                                                    # code...
                                                    ?><div class="waybill-notification"><?php echo $waybillCount; ?></div><?php
                                                }

                                            }
                                        
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }
                        ?>
                    </ul>
                    <?php
                }
            ?>
        </div>
    </nav>
</header>