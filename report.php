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
    <link rel="stylesheet" href="CSS/report.css">
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
                        <h1>REPORT</h1>
                        <div class="report-div">
                            <form action="#" class="report-form">
                                <div>
                                    <label for="report-type">Report type: </label>
                                    <select id="report-type"  onchange="reportDate()">
                                        <?php
                                            if ($_SESSION['komitexLogisticsAccountType'] == 'Logistics' || $_SESSION['komitexLogisticsAccountType'] == 'Agent') {
                                                # code...
                                                ?><option value="Delivered">Orders Delivered</option>
                                                <option value="Waybill">Waybill</option>
                                                <option value="Dispatch">Dispatch</option><?php

                                            } elseif ($_SESSION['komitexLogisticsAccountType'] == 'Merchant' || $_SESSION['komitexLogisticsAccountType'] == 'Affiliate') {
                                                # code...
                                                ?><option value="Delivered">Orders Delivered</option>
                                                <option value="Waybill">Waybill</option><?php
                                            
                                            } 
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="report-date">Show report for: </label>
                                    <input type="date" value="<?php echo date("Y-m-d");?>" id="report-date" onchange="reportDate()" max="<?php echo date("Y-m-d");?>">
                                </div>
                            </form>
                            <div id="autorefresh">
                                      
                            </div>
                                
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
    <script src="javascript/main.js"></script>
    <script src="javascript/report.js"></script>
</body>
</html>