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
        $LIMIT = $_SESSION['searchArray'];
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
    <link rel="stylesheet" href="CSS/accountinfo.css">
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
                    
                        <form action="<?php echo htmlspecialchars('includes/accounttype.inc.php'); ?>" class="select-accountType" method="POST">
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
                                <label for="select-logistics">Merchant</label>
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
                        <h1 id="page-heading">ACCOUNT INFO</h1>
                        <div class="accountinfo-div">
                            <h3>Profile Picture</h3>

                            <div class="profile-photo-container">
                                <div class="profile-photo" style="background-image: url(<?php echo $profilePhoto.'?'.mt_rand();?>);"></div>   
                                <form class="upload-profilephoto" method="POST" action="<?php echo htmlspecialchars('includes/profilephoto.inc.php');?>" enctype="multipart/form-data">
                                    <input type="hidden" name="email" value="<?php echo $email;?>">
                                    <input type="hidden" name="username" value="<?php echo $username;?>">
                                    <input style="display:none" type="file" name="photo" id="selectPhoto" onchange="readURL(this)" accept="image/*" required>
                                    <button type="submit" id="upload-profile-photo-button" name="uploadProfilePhoto">Save</button>
                                </form>
                                <form class="upload-profilephoto-2" method="POST" action="<?php echo htmlspecialchars('includes/profilephoto.inc.php');?>">
                                    <input type="hidden" name="email" value="<?php echo $email;?>">
                                    <button type="submit" id="delete-profile-photo-button" name="deleteProfilePhoto">Delete</button>
                                </form>
                                <input type="image" src="icons/others/pencil.png" alt="edit icon" onclick="selectPhoto()">
                                <input type="image" src="icons/others/garbage(1).png" alt="delete icon"  onclick="deletePhoto()">
                            </div>

                            <p>Fullname: <?php echo $fullname;?></p>
                            <p>Username: <?php echo $username;?></p>
                            <p>email address: <?php echo $email;?></p>
                            <p>Phone Number: <?php echo $phone;?></p>
                            <p class="last-p">Account Type: <?php echo $accountType;?></p><?php

                            $locationObj = new View;

                            $results = $locationObj->viewLocation($username);

                            if (!empty($results)) {
                                # code...
                                $x = 1;
                                ?>
                                <div class="location-wrapper">
                                    <h3 class="location-heading">Locations</h3>
                                    <?php
                                    foreach ($results as $result) {
                                        # code...
                                        $location = $result['location'];
                                        $price = $result['price'];
                                        ?>
                                        <div class="location-holder">
                                            <p id="view-location-<?php echo $x;?>" onclick="locationInput('<?php echo $x;?>')" class="down-arrow"><?php echo $location;?></p>
                                            <p id="view-location-price-<?php echo $x;?>">
                                                <s>N</s><?php echo $price;?>
                                            </p>
                                            <form action="<?php echo htmlspecialchars('includes/locations.inc.php'); ?>" method="post" class="view-location-form-<?php echo $x;?>">
                                                <input type="hidden" name="username" value="<?php echo $username;?>">
                                                <input type="hidden" name="location" value="<?php echo $location;?>">
                                                <input type="number" name="price" class="add-username" placeholder="Price" id="edit-location-price" value="<?php echo $price;?>">
                                                <button type="submit" name="editLocation" class="add-submit" id="edit-location">OK</button>
                                            </form>
                                        </div>
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                    <span class="notice">click on respective location to edit it's price!</span>
                                </div>
                                <?php
                            }

                            if ($accountType == 'Logistics') {
                                ?>
                                <div class="add-affiliates-logistics">
                                    <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="add-form" method="POST">
                                        <input type="hidden" name="email" value="<?php echo $email;?>">
                                        <input type="hidden" name="username01" value="<?php echo $username;?>">
                                        <input type="hidden" name="accountType01" value="<?php echo $accountType;?>">
                                        <button type="button" class="add-button" id="add-affiliate">Add Agent</button>
                                        <input type="text" name="username02" class="add-username" placeholder="username" id="add-affiliate-username">
                                        <button type="submit" name="addAgents" class="add-submit" id="submit-affiliate">OK</button>
                                    </form>
                                    <form action="<?php echo htmlspecialchars('includes/locations.inc.php'); ?>" class="add-form" method="POST" onsubmit="return confirm('Are you sure? Only loction price can be edited afterwards')">
                                        <input type="hidden" name="username" value="<?php echo $username;?>">
                                        <button type="button" class="add-button" id="add-location-button">Add Location</button>
                                        <input type="text" name="location" class="add-username" placeholder="Location" id="add-location" required>
                                        <input type="number" name="price" class="add-username" placeholder="Price" id="add-location-price" required>
                                        <button type="submit" name="addLocation" class="add-submit" id="submit-location">OK</button>
                                    </form>
                                </div>
                                <?php
                            }else if ($accountType == 'Merchant') {
                                # code...
                                ?>
                                <div class="add-affiliates-logistics">
                                    <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="add-form" method="POST">
                                        <input type="hidden" name="email" value="<?php echo $email;?>">
                                        <input type="hidden" name="username01" value="<?php echo $username;?>">
                                        <input type="hidden" name="accountType01" value="<?php echo $accountType;?>">
                                        <button type="button" class="add-button" id="add-logistics">Add Logistics</button>
                                        <input type="text" name="username02" class="add-username" placeholder="username" id="add-logistics-username">
                                        <button type="submit" name="addLogistics" class="add-submit" id="submit-logistics">OK</button>
                                    </form>
                                    <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="add-form" method="POST">
                                        <input type="hidden" name="email" value="<?php echo $email;?>">
                                        <input type="hidden" name="username01" value="<?php echo $username;?>">
                                        <input type="hidden" name="accountType01" value="<?php echo $accountType;?>">
                                        <button type="button" class="add-button" id="add-affiliate">Add Affiliates</button>
                                        <input type="text" name="username02" class="add-username" placeholder="username" id="add-affiliate-username">
                                        <button type="submit" name="addAffiliates" class="add-submit" id="submit-affiliate">OK</button>
                                    </form>
                                </div>
                                <?php
                            }?>

                            <div id="autorefresh">
                                <?php

                                $ctrlObj = new Controller();

                                $ctrlObj->setContactsTime($username);
                        
                                unset($ctrlObj);

                                $contactObj = new View;

                                $results = $contactObj->viewContactsLimit($username, $accountType);
                                
                                $countContactsResult = $contactObj->viewContactsCount($username, $accountType);

                                // print_r($countContactsResult);

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
                                                        
                                                        <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="remove-form" method="POST" onsubmit="return confirm('Are you sure?')">
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

                                                        <!--<div class="remove-form">
                                                            <p id="declined">Your request was declined!</p>
                                                        </div>-->
                                                        <form action="<?php echo htmlspecialchars('includes/contacts.inc.php'); ?>" class="remove-form" method="POST" onsubmit="return confirm('Resend Request?')">
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

                                    $countContactsResult[0]['COUNT(id)'] = 11;
    
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
                                                if ($_SESSION['searchArray'] > 10 && $countResult[0]['COUNT(id)'] > 10) {
                                                    # code...
                                                    ?><button type="button" onclick="limit('less')">Show less</button><?php
                                                }
                                            ?>
                                        </form><?php
    
                                    }

                                }

                            ?></div>
                            
                        </div>
                        <?php
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
    <footer class="accouninfo-footer">
        <!-- <div class="logout-wrapper"> -->
            <a href="logout.php">Logout</a>
        <!-- </div> -->
    </footer>
    <script src="javascript/main.js"></script>
    <script src="javascript/accountinfo.js"></script>
</body>
</html>