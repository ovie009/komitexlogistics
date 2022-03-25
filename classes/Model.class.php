<?php

    abstract class Model extends Dbh
    {
        protected function checkSignupEmail(string $email)
        {
            # code...
            $sql = "SELECT * FROM login WHERE komitexLogisticsEmail=?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);

            $results = $stmt->fetchAll();
            $stmt = null;
            return $results;
        }
        
        protected function checkSignupUsername(string $username)
        {
            # code...
            $sql = "SELECT komitexLogisticsUsername FROM login WHERE komitexLogisticsUsername=?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);

            $results = $stmt->fetchAll();
            $stmt = null;
            return $results;
        }
        
        protected function insertSignup(string $fullname, string $username, string $email, string $phone, string $password)
        {
            # code...
            $sql = "INSERT INTO login(komitexLogisticsFullname, komitexLogisticsUsername, komitexLogisticsEmail, komitexLogisticsPhone, komitexLogisticsPassword) VALUES (?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$fullname, $username, $email, $phone, $password]);
            
            $_SESSION['komitexLogisticsFullname'] = $fullname;
            $_SESSION['komitexLogisticsUsername'] = $username;
            $_SESSION['komitexLogisticsEmail'] = $email;
            $_SESSION['komitexLogisticsPhone'] = $phone;
            $_SESSION['komitexLogisticsAccountType'] = NULL;
            $_SESSION['komitexLogisticsProfilePhoto'] = 'icons/others/user.png';

            $stmt = null;
            echo 'success';
        }

        protected function checkLoginDetails(string $user)
        {
            # code...
            // echo $user;
            $sql = "SELECT * FROM login WHERE komitexLogisticsEmail=? OR komitexLogisticsUsername=?;";
            // echo '1';
            $stmt = $this->connect()->prepare($sql);
            // echo '2';
            $stmt->execute([$user, $user]);
            // echo '3';
            $results = $stmt->fetchAll();
            // echo '4';
            $stmt = null;
            // echo '5';
            // echo '6';
            // print_r($results);
            // echo '7';
            return $results;
        }

        protected function saveLoginDetails(string $user, array $results, string $password)
        {
            
            if (empty($results)) {
                # code...
                header("location: ../index.php?nullEmail");

            } else {
                # code...
                $passwordCheck = password_verify($password, $results[0]['komitexLogisticsPassword']);
    
                if ($passwordCheck === false) {
                // if ($passwordCheck === true) {
                // if ($password != $results[0]['komitexLogisticsPassword']) {
                    # code...
                    header("location: ../index.php?wrongPassword&user=".$user."");
                    
                } else {
                    
                    $_SESSION['komitexLogisticsFullname'] = $results[0]['komitexLogisticsFullname'];
                    $_SESSION['komitexLogisticsUsername'] = $results[0]['komitexLogisticsUsername'];
                    $_SESSION['komitexLogisticsEmail'] = $results[0]['komitexLogisticsEmail'];
                    $_SESSION['komitexLogisticsPhone'] = $results[0]['komitexLogisticsPhone'];
                    $_SESSION['komitexLogisticsAccountType'] = $results[0]['komitexLogisticsAccountType'];
                    $_SESSION['komitexLogisticsAccountType'] = $results[0]['komitexLogisticsAccountType'];
                    $_SESSION['komitexLogisticsProfilePhoto'] = $results[0]['komitexLogisticsProfilePhoto'];
                    echo '<br>';
                    echo $results[0]['komitexLogisticsEmail'];
                    echo '<br>';
                    echo $_SESSION['komitexLogisticsFullname'];
                    header("location: ../index.php");
                    # code...
                }

            }
            
            
        }

        protected function updateAccountType(string $account, string $email)
        {
            # code...
            $sql = "UPDATE `login` SET `komitexLogisticsAccountType` = '$account' WHERE `login`.`komitexLogisticsEmail` = '$email';";
            try {
                //code...
                $this->connect()->query($sql);
                $_SESSION['komitexLogisticsAccountType'] = $account;
                header("location: ../accountinfo.php?Success");
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
            }
        
        }

        protected function updateProfilePhoto(string $email, string $profilePhoto)
        {
            # code...
            $sql = "UPDATE `login` SET `komitexLogisticsProfilePhoto` = '$profilePhoto' WHERE `login`.`komitexLogisticsEmail` = '$email';";
            try {
                //code...
                $this->connect()->query($sql);
                $_SESSION['komitexLogisticsProfilePhoto'] = $profilePhoto;
                if ($profilePhoto != 'icons/others/user.png') {
                    # code...
                    header("location: ../accountinfo.php?uploadSuccess");
                }else{
                    header("location: ../accountinfo.php?deleteSuccess");
                }
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage();
                header("location: ../accountinfo.php?databaseError");
            }
        }

        protected function insertContacts(string $username01, string $username02, string $accountType01, string $accountType02)
        {
            # code...
            $sql = "INSERT INTO contacts($accountType01, $accountType02) VALUES (?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username01, $username02]);
            $stmt = null;
        }

        protected function approveContacts(string $username01, string $username02, string $accountType01, string $accountType02)
        {
            # code...
            $sql = "UPDATE `contacts` SET `Status` = 'Approved', DateTime = CURRENT_TIMESTAMP WHERE `contacts`.`$accountType01` = '$username01' AND `contacts`.`$accountType02` = '$username02' ;";
            try {
                //code...
                $this->connect()->query($sql);
                header("location: ../accountinfo.php?added".$accountType02);     
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../accountinfo.php?databaseError");
            }
        
        }

        protected function checkMyContacts(string $username01, string $accountType01, string $username02, string $accountType02)
        {
            # code...
            $sql = "SELECT * FROM `contacts` WHERE `contacts`.`$accountType01` = '$username01' AND `contacts`.`$accountType02` = '$username02';";
            //$sql = "SELECT * FROM `contacts` WHERE `contacts`.`?` = '?' AND `contacts`.`?` = '?';";
            $stmt = $this->connect()->query($sql);
            //$stmt = $this->connect()->prepare($sql);
            //$stmt->execute([$accountType01, $username01, $accountType02, $username02]);

            $results = $stmt->fetchAll();
            $stmt = null;
            return $results;
        }

        protected function getContacts(string $username, string $accountType)
        {
            # code...
            $sql = "SELECT * FROM contacts WHERE $accountType = '$username' ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();
            $stmt = null;

            return $results;
        }

        protected function getContactsLimit(string $username, string $accountType)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM contacts WHERE $accountType = '$username' ORDER BY id DESC LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();
            $stmt = null;

            return $results;
        }

        protected function getAgents(string $username, string $accountType)
        {
            # code...
            $sql = "SELECT * FROM contacts WHERE $accountType = '$username' AND Agent IS NOT NULL ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();
            $stmt = null;

            return $results;
        }

        protected function getAgentAgents(string $username, string $accountType, string $agent)
        {
            # code...
            $sql = "SELECT * FROM contacts WHERE $accountType = '$username' AND Agent IS NOT NULL AND Agent != '$agent' ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();
            $stmt = null;

            return $results;
        }

        protected function getLogisticsContacts(string $username, string $accountType)
        {
            # code...
            $sql = "SELECT * FROM contacts WHERE $accountType = '$username' AND Status = 'Approved' AND Logistics IS NOT NULL ORDER BY Logistics ASC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();
            $stmt = null;

            return $results;
        }

        protected function getMerchantContacts(string $username, string $accountType)
        {
            # code...
            $sql = "SELECT * FROM contacts WHERE $accountType = '$username' AND Status = 'Approved' AND Merchant IS NOT NULL ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();
            $stmt = null;

            return $results;
        }

        protected function deleteContacts(string $username01, string $accountType01, string $username02, string $accountType02)
        {
            # code...
            $sql = "DELETE FROM `contacts` WHERE `contacts`.`$accountType01` = '$username01' AND `contacts`.`$accountType02` = '$username02';";
            try {
                //code...
                $this->connect()->query($sql);
                if ($accountType02 == 'Agent') {
                    # code...
                    header("location: ../accountinfo.php?removeAgent");     
                }
                if ($accountType02 == 'Affiliate') {
                    # code...
                    header("location: ../accountinfo.php?removeAffiliate");     
                }
                return true;
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../accountinfo.php?databaseError");
            }
        }
        
        protected function declineContacts(string $username01, string $accountType01, string $username02, string $accountType02)
        {
            # code...
            $sql = "UPDATE `contacts` SET `Status` = 'Declined', DateTime = CURRENT_TIMESTAMP WHERE `contacts`.`$accountType01` = '$username01' AND `contacts`.`$accountType02` = '$username02' ;";
            try {
                //code...
                $this->connect()->query($sql);
                header("location: ../accountinfo.php?decline".$accountType02);     
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../accountinfo.php?databaseError");
            }
        
        }

        protected function notApprovedContacts(string $username01, string $accountType01, string $username02, string $accountType02)
        {
            # code...
            $sql = "UPDATE `contacts` SET `Status` = 'Not Approved', DateTime = CURRENT_TIMESTAMP WHERE `contacts`.`$accountType01` = '$username01' AND `contacts`.`$accountType02` = '$username02' ;";
            try {
                //code...
                $this->connect()->query($sql);
                header("location: ../accountinfo.php?decline".$accountType02);     
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../accountinfo.php?databaseError");
            }
        
        }

        protected function newLocation(string $username, string $location, string $price)
        {
            # code...
            $sql = "INSERT INTO `locations`(`username`, `location`, `price`) VALUES (?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $location, $price]);
            $stmt = null;       
            header("location: ../accountinfo.php?locationAdded");
        }

        protected function checkLocation(string $username, string $location)
        {
            # code...
            $sql = "SELECT * FROM locations WHERE username = '$username' AND location = '$location';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLocation(string $username)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM locations WHERE username = '$username' ORDER BY location ASC LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function updateLocation(string $username, string $location, string $price)
        {
            # code...
            $sql = "UPDATE `locations` SET `price` = '$price' WHERE `locations`.`username` = '$username' AND `locations`.`location` = '$location';";
            try {
                //code...
                $this->connect()->query($sql);
                header("location: ../accountinfo.php?locationEdited");     
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../accountinfo.php?databaseError");
            }
        
        }

        protected function insertNoDiscountProduct(string $username, string $productName, string $productPrice, string $productPhoto, string $photoTmpName)
        {
            # code...
            $sql = "INSERT INTO `products`(`Merchant`, `ProductName`, `Price`, `Picture`) VALUES (?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $productName, $productPrice, $productPhoto]);

            if ($productPhoto != 'icons/others/bag1.png') {
                # code...
                $photoDestination = '../'.$productPhoto;

                if (!move_uploaded_file($photoTmpName, $photoDestination)) {
                    # code...
                    header("location: ../waybill.php?moveFileError&Tab=products");
                } else {
                    # code...
                    header("location: ../waybill.php?productSuccess&Tab=products");
                }
            } else {
                header("location: ../waybill.php?productSuccess&Tab=products");
            }
            
            $stmt = null;
            
        }

        protected function insertProductGroup(string $username, string $productName, string $productPrice, string $productPhoto, string $photoTmpName)
        {
            # code...
            $type = 'Group';
            $sql = "INSERT INTO `products`(`Merchant`, `ProductName`, `Price`, `Picture`, `Type`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $productName, $productPrice, $productPhoto, $type]);

            if ($productPhoto != 'icons/others/bag2.png') {
                # code...
                $photoDestination = '../'.$productPhoto;

                if (!move_uploaded_file($photoTmpName, $photoDestination)) {
                    # code...
                    header("location: ../waybill.php?moveFileError&Tab=products");
                } else {
                    # code...
                    header("location: ../waybill.php?productSuccess&Tab=products");
                }
            } else {
                header("location: ../waybill.php?productSuccess&Tab=products");
            }
            
            $stmt = null;
            
        }

        protected function checkGroups(string $merchant, string $productName)
        {
            # code...
            $sql = "SELECT * FROM groups WHERE Merchant = '$merchant' AND GroupName = '$productName';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectGroups(string $merchant)
        {
            # code...
            $sql = "SELECT * FROM groups WHERE Merchant = '$merchant';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function insertGroup(string $merchant, string $groupName, string $firstProduct, string $firstQuantity, string $secondProduct, string $secondQuantity, string $thirdProduct, string $thirdQuantity)
        {
            # code...
            if ($firstProduct == 'None') {
                # code...
                $firstProduct = NULL;
            }
            if ($firstQuantity == 'None') {
                # code...
                $firstQuantity = NULL;
            }

            if ($secondProduct == 'None') {
                # code...
                $secondProduct = NULL;
            }
            if ($secondQuantity == 'None') {
                # code...
                $secondQuantity = NULL;
            }

            if ($thirdProduct == 'None') {
                # code...
                $thirdProduct = NULL;
            }
            if ($thirdQuantity == 'None') {
                # code...
                $thirdQuantity = NULL;
            }

            $sql = "INSERT INTO `groups`(`Merchant`, `GroupName`, `FirstProduct`, `FirstQuantity`, `SecondProduct`, `SecondQuantity`, `ThirdProduct`, `ThirdQuantity`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $groupName, $firstProduct, $firstQuantity, $secondProduct, $secondQuantity, $thirdProduct, $thirdQuantity]);

            $stmt = null;
            
        }

        protected function insertOneDiscountProduct(string $username, string $productName, string $productPrice, string $price1, string $quantity1, string $productPhoto, string $photoTmpName)
        {
            # code...
            $sql = "INSERT INTO `products`(`Merchant`, `ProductName`, `Price`, `FirstDiscountPrice`, `FirstDiscountQty`, `Picture`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $productName, $productPrice, $price1, $quantity1, $productPhoto]);
            
            if ($productPhoto != 'icons/others/bag1.png') {
                # code...
                $photoDestination = '../'.$productPhoto;

                if (!move_uploaded_file($photoTmpName, $photoDestination)) {
                    # code...
                    header("location: ../waybill.php?moveFileError&Tab=products");
                } else {
                    # code...
                    header("location: ../waybill.php?productSuccess&Tab=products");
                }
            } else {
                header("location: ../waybill.php?productSuccess&Tab=products");
            }

            $stmt = null;
            
        }

        protected function insertTwoDiscountProduct(string $username, string $productName, string $productPrice, string $price1, string $quantity1, string $price2, string $quantity2, string $productPhoto, string $photoTmpName)
        {
            # code...
            $sql = "INSERT INTO `products`(`Merchant`, `ProductName`, `Price`, `FirstDiscountPrice`, `FirstDiscountQty`, `SecondDiscountPrice`, `SecondDiscountQty`, `Picture`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $productName, $productPrice, $price1, $quantity1, $price2, $quantity2, $productPhoto]);
            
            if ($productPhoto != 'icons/others/bag1.png') {
                # code...
                $photoDestination = '../'.$productPhoto;

                if (!move_uploaded_file($photoTmpName, $photoDestination)) {
                    # code...
                    header("location: ../waybill.php?moveFileError&Tab=products");
                } else {
                    # code...
                    header("location: ../waybill.php?productSuccess&Tab=products");
                }
            } else {
                header("location: ../waybill.php?productSuccess&Tab=products");
            }

            $stmt = null;
            
        }

        protected function insertThreeDiscountProduct(string $username, string $productName, string $productPrice, string $price1, string $quantity1, string $price2, string $quantity2, string $price3, string $quantity3, string $productPhoto, string $photoTmpName)
        {
            # code...
            $sql = "INSERT INTO `products`(`Merchant`, `ProductName`, `Price`, `FirstDiscountPrice`, `FirstDiscountQty`, `SecondDiscountPrice`, `SecondDiscountQty`, `ThirdDiscountPrice`, `ThirdDiscountQty`, `Picture`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $productName, $productPrice, $price1, $quantity1, $price2, $quantity2, $price3, $quantity3, $productPhoto]);
            
            if ($productPhoto != 'icons/others/bag1.png') {
                # code...
                $photoDestination = '../'.$productPhoto;

                if (!move_uploaded_file($photoTmpName, $photoDestination)) {
                    # code...
                    header("location: ../waybill.php?moveFileError&Tab=products");
                } else {
                    # code...
                    header("location: ../waybill.php?productSuccess&Tab=products");
                }
            } else {
                header("location: ../waybill.php?productSuccess&Tab=products");
            }
            
            $stmt = null;
            
        }

        protected function updateProductPrice(string $username, string $productName, string $price)
        {
            # code...
            $sql = "UPDATE `products` SET `Price`= ?, DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            try {
                //code...
                $stmt->execute([$price, $username, $productName]);
                header("location: ../waybill.php?priceEdited&Tab=products");
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../waybill.php?dbError&Tab=products");
            }
        }

        protected function updateOneDiscount(string $username, string $productName, string $price1, string $quantity1)
        {
            # code...
            //"UPDATE `products` SET `id`=[value-1],`Merchant`=[value-2],`Affiliate`=[value-3],`ProductName`=[value-4],`Price`=[value-5],`FirstDiscountPrice`=[value-6],`FirstDiscountQty`=[value-7],`SecondDiscountPrice`=[value-8],`SecondDiscountQty`=[value-9],`ThirdDiscountPrice`=[value-10],`ThirdDiscountQty`=[value-11],`Picture`=[value-12],`Stock`=[value-13] WHERE 1"
            $sql = "UPDATE `products` SET `FirstDiscountPrice`= ?,`FirstDiscountQty`= ?, DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            try {
                //code...
                $stmt->execute([$price1, $quantity1, $username, $productName]);
                header("location: ../waybill.php?discountAdded&Tab=products");
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../waybill.php?dbError&Tab=products");
            }
        }

        protected function updateSecondDiscount(string $username, string $productName, string $price2, string $quantity2)
        {
            # code...
            $sql = "UPDATE `products` SET `SecondDiscountPrice`= ?,`SecondDiscountQty`= ?, DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            try {
                //code...
                $stmt->execute([$price2, $quantity2, $username, $productName]);
                header("location: ../waybill.php?discountAdded&Tab=products");
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../waybill.php?dbError&Tab=products");
            }
        }

        protected function updateThirdDiscount(string $username, string $productName, string $price3, string $quantity3)
        {
            # code...
            $sql = "UPDATE `products` SET `ThirdDiscountPrice`= ?,`ThirdDiscountQty`= ?, DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            try {
                //code...
                $stmt->execute([$price3, $quantity3, $username, $productName]);
                header("location: ../waybill.php?discountAdded&Tab=products");
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../waybill.php?dbError&Tab=products");
            }
        }

        protected function updateOneDiscountNull(string $username, string $productName)
        {
            # code...
            //"UPDATE `products` SET `id`=[value-1],`Merchant`=[value-2],`Affiliate`=[value-3],`ProductName`=[value-4],`Price`=[value-5],`FirstDiscountPrice`=[value-6],`FirstDiscountQty`=[value-7],`SecondDiscountPrice`=[value-8],`SecondDiscountQty`=[value-9],`ThirdDiscountPrice`=[value-10],`ThirdDiscountQty`=[value-11],`Picture`=[value-12],`Stock`=[value-13] WHERE 1"
            $sql = "UPDATE `products` SET `FirstDiscountPrice`= NULL,`FirstDiscountQty`= NULL, DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            try {
                //code...
                $stmt->execute([$username, $productName]);
                header("location: ../waybill.php?discountNull&Tab=products");
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../waybill.php?dbError&Tab=products");
            }
        }

        protected function updateSecondDiscountNull(string $username, string $productName)
        {
            # code...
            $sql = "UPDATE `products` SET `SecondDiscountPrice`= NULL,`SecondDiscountQty`= NULL, DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            try {
                //code...
                $stmt->execute([$username, $productName]);
                header("location: ../waybill.php?discountNull&Tab=products");
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../waybill.php?dbError&Tab=products");
            }
        }

        protected function updateThirdDiscountNull(string $username, string $productName)
        {
            # code...
            $sql = "UPDATE `products` SET `ThirdDiscountPrice`= NULL,`ThirdDiscountQty`= NULL, DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            try {
                //code...
                $stmt->execute([$username, $productName]);
                header("location: ../waybill.php?discountNull&Tab=products");
            } catch (\TypeError $e) {
                //throw $e;
                echo "Error: ".$e->getMessage(); 
                header("location: ../waybill.php?dbError&Tab=products");
            }
        }

        protected function updateProductPhoto(string $username, string $productName, string $productPhoto, string $photoTmpName)
        {
            # code...
            $sql = "UPDATE `products` SET `Picture`= ?, DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$productPhoto, $username, $productName]);

            $photoDestination = '../'.$productPhoto;

            if (!move_uploaded_file($photoTmpName, $photoDestination)) {
                # code...
                header("location: ../waybill.php?uploadError&Tab=products");
            } else {
                # code...
                header("location: ../waybill.php?pictureEdited&Tab=products");
            }
            
            $stmt = null;
            
        }

        protected function selectProduct(string $username)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM products WHERE Merchant = '$username' AND Merchant IS NOT NULL ORDER BY DateTime DESC, id DESC LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectProductNoLimit(string $username)
        {
            # code...
            $sql = "SELECT * FROM products WHERE Merchant = '$username' AND Type = 'Product' AND Merchant  IS NOT NULL ORDER BY DateTime DESC, id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectProductsExceptTwo(string $username, string $product01, string $product02)
        {
            # code...
            $sql = "SELECT * FROM products WHERE Merchant = '$username' AND Type = 'Product' AND ProductName != '$product01' AND ProductName != '$product02' AND Merchant IS NOT NULL ORDER BY DateTime DESC, id DESC;";
            // $sql = "SELECT * FROM products WHERE Merchant = '$username' AND Type = 'Product' AND ProductName != ('$product01' OR '$product02') AND Merchant IS NOT NULL ORDER BY DateTime DESC, id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectDispatchedProduct(string $logistics, string $dateTime)
        {
            # code...
            $sql = "SELECT * FROM waybill WHERE Logistics = '$logistics' AND Type = 'Dispatch' AND DateTimeSent = '$dateTime' ORDER BY DateTimeSent DESC, id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectProductCount(string $username)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM products WHERE Merchant = '$username' AND Merchant IS NOT NULL;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectWaybillWithLogistics(string $merchant, string $logistics)
        {
            # code...
            $sql = "SELECT * FROM waybill WHERE Merchant = '$merchant' AND Logistics = '$logistics' AND Status = 'Approved' AND Merchant IS NOT NULL GROUP BY ProductName ORDER BY DateTimeReceived DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function checkProduct(string $merchant, string $productName)
        {
            # code...
            $sql = "SELECT * FROM products WHERE Merchant = '$merchant' AND ProductName = '$productName' AND Merchant IS NOT NULL;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function insertWaybill(string $merchant, string $logistics, string $productName, string $numberSent)
        {
            # code...
            $sql = "INSERT INTO `waybill`(`Merchant`, `Logistics`, `ProductName`, `NumberSent`) VALUES (?,?,?,?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $logistics, $productName, $numberSent]);
            $stmt = null;

            header("location: ../waybill.php?waybillSent&Tab=waybill");
            
        }

        protected function updateProductDateTime(string $merchant, string $productName)
        {
            # code...

            $sql = "UPDATE `products` SET DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $productName]);
            
        }

        protected function insertDetailedWaybill(string $merchant, string $logistics, string $productName, string $numberSent, string $waybillDetails)
        {
            # code...
            $sql = "INSERT INTO `waybill`(`Merchant`, `Logistics`, `ProductName`, `NumberSent`, `waybillDetails`) VALUES (?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $logistics, $productName, $numberSent, $waybillDetails]);
            $stmt = null;

            $sql = "UPDATE `products` SET DateTime = CURRENT_TIMESTAMP WHERE `products`.`Merchant` = ? AND `products`.`ProductName` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $productName]);
            
            header("location: ../waybill.php?waybillSent&Tab=waybill");
            
        }

        protected function insertWaybillLD(string $merchant, string $logistics, string $productName, string $numberSent, string $waybillDetails, string $location)
        {
            # code...
            $status = 'Approved';
            $type = 'Dispatch';
            $sql = "INSERT INTO `waybill`(`Merchant`, `Logistics`, `ProductName`, `NumberSent`, `waybillDetails`, `Location`, `Type`, `Status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $logistics, $productName, $numberSent, $waybillDetails, $location, $type, $status]);
            $stmt = null;

            header("location: ../waybill.php?waybillSent&Tab=waybill");
            
        }

        protected function insertWaybillL(string $merchant, string $logistics, string $productName, string $numberSent, string $location)
        {
            # code...
            $sql = "INSERT INTO `waybill`(`Merchant`, `Logistics`, `ProductName`, `NumberSent`, `Location`) VALUES (?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $logistics, $productName, $numberSent, $location]);
            $stmt = null;

            header("location: ../waybill.php?waybillSent&Tab=waybill");
            
        }

        protected function updateWaybill(int $id, string $numberSent)
        {
            # code...
            $sql = "UPDATE `waybill` SET `NumberSent` = ? WHERE `waybill`.`id` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$numberSent, $id]);
            $stmt = null;

            header("location: ../waybill.php?waybillEdited&Tab=waybill");
            
        }

        protected function updateWaybillApproved(int $id)
        {
            # code...
            $sql = "UPDATE `waybill` SET `Status` = 'Approved', `DateTimeReceived` = CURRENT_TIMESTAMP WHERE `waybill`.`id` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $stmt = null;

        }

        protected function updateAgentWaybillApproved(int $id)
        {
            # code...
            $sql = "UPDATE `waybill` SET `Status` = 'Approved', `DateTimeReceived` = CURRENT_TIMESTAMP WHERE `waybill`.`id` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $stmt = null;

            header("location: ../waybill.php?waybillAgentApproved&Tab=waybill");
        }

        protected function selectWaybill(string $username)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM waybill WHERE Merchant = '$username' AND Type = 'Waybill' ORDER BY id DESC, DateTimeReceived DESC LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectWaybillCount(string $username)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM waybill WHERE Merchant = '$username' ORDER BY id DESC, DateTimeReceived DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsWaybill(string $username)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM waybill WHERE Logistics = '$username' ORDER BY id DESC LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsWaybillCount(string $username)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM waybill WHERE Logistics = '$username';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectApprovedWaybill(string $username)
        {
            # code...
            $sql = "SELECT * FROM waybill WHERE Logistics = '$username' AND Status = 'Approved' AND Merchant IS NOT NULL GROUP BY ProductName ORDER BY DateTimeReceived DESC, id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsWaybillSum(string $logistics, string $productName, string $merchant)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT SUM(NumberSent) FROM waybill WHERE Logistics = '$logistics' AND Merchant = '$merchant' AND Status = 'Approved' AND ProductName = '$productName' AND Type = 'Waybill';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantWaybillSum(string $merchant, string $productName, string $logistics)
        {
            # code...
            $sql = "SELECT SUM(NumberSent) FROM waybill WHERE Merchant = '$merchant' AND Logistics = '$logistics' AND Status = 'Approved' AND Type = 'Waybill' AND ProductName = '$productName';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectWaybillReport(string $accountType, string $username, string $dateTime)
        {
            # code...
            $sql = "SELECT * FROM waybill WHERE $accountType = '$username' AND DateTimeSent LIKE '%".$dateTime."%';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function insertStock(string $merchant, string $logistics, string $productName, int $numberSent)
        {
            # code...
            $sql = "INSERT INTO `stock`(`Merchant`, `Logistics`, `ProductName`, `StockLeft`) VALUES (?, ?, ?, ?);";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $logistics, $productName, $numberSent]);
            $stmt = null;
        }

        protected function updateStock(string $merchant, string $logistics, string $productName, int $numberSent)
        {
            # code...
            //$sql = "UPDATE `stock` SET `StockLeft` = '$numberSent' WHERE `stock`.`Merchant` = '$merchant' AND `stock`.`Logistics` = '$logistics' AND `stock`.`ProductName` = '$productName';";
            $sql = "UPDATE `stock` SET `StockLeft` = ?, DateTime = CURRENT_TIMESTAMP WHERE `stock`.`Merchant` = ? AND `stock`.`Logistics` = ? AND `stock`.`ProductName` = ?;";
            //$this->connect()->query($sql);
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$numberSent, $merchant, $logistics, $productName]);
            $stmt = null;
        }

        protected function selectStock(string $merchant, string $logistics, string $productName)
        {
            # code...
            $sql = "SELECT * FROM `stock` WHERE `stock`.`Merchant` = '$merchant' AND `stock`.`ProductName` = '$productName' AND `stock`.`Logistics` = '$logistics';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
        
        protected function selectMerchantStock(string $merchant)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM `stock` WHERE `stock`.`Merchant` = '$merchant' ORDER BY DateTime DESC LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
        
        protected function selectLogisticsStock(string $logistics)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM `stock` WHERE `stock`.`Logistics` = '$logistics' ORDER BY DateTime DESC LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
        
        protected function selectLogisticsStockCount(string $logistics)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `stock` WHERE `stock`.`Logistics` = '$logistics';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
        
        protected function selectLogisticsMerchantStock(string $logistics, string $merchant)
        {
            # code...
            $sql = "SELECT * FROM `stock` WHERE `stock`.`Logistics` = '$logistics' AND `stock`.`Merchant` = '$merchant';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
        
        protected function insertMerchantOrder(string $merchant, string $logistics, string $orderDetails, string $productName, string $type, int $quantity, float $price, string $location, float $cost)
        {
            # code...
            $sql = "INSERT INTO `orders`(`Merchant`, `Logistics`, `OrderDetails`, `Product`, `Type`, `Quantity`, `Price`, `Location`, `Cost`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $logistics, $orderDetails, $productName, $type, $quantity, $price, $location, $cost]);
            $stmt = null;

            header("location: ../orders.php?orderSuccess");
        }
        
        protected function insertAffiliateOrder(string $merchant, string $affiliate, string $logistics, string $orderDetails, string $productName, string $type, int $quantity, float $price, string $location, float $cost)
        {
            # code...
            $sql = "INSERT INTO `orders`(`Merchant`, `Affiliate`, `Logistics`, `OrderDetails`, `Product`, `Type`, `Quantity`, `Price`, `Location`, `Cost`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$merchant, $affiliate, $logistics, $orderDetails, $productName, $type, $quantity, $price, $location, $cost]);
            $stmt = null;

            header("location: ../orders.php?orderSuccess");
        }

        protected function selectSingleOrder(string $id)
        {
            # code...
            $sql = "SELECT * FROM `orders` WHERE `orders`.`id` = '$id';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsDeliveredOrder(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`Status` = 'Delivered' AND `orders`.`RunningDate` = '$runningDate'  ORDER BY DateTime DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantDeliveredOrder(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`Status` = 'Delivered' AND `orders`.`RunningDate` = '$runningDate'  ORDER BY DateTime DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectOrder(string $merchant)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Merchant` = '$merchant' ORDER BY id DESC LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectOrderCount(string $merchant)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantOrder(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectFirstMerchantOrder(string $merchant)
        {
            # code...
            $sql = "SELECT SentDateTime FROM `orders` WHERE `orders`.`Merchant` = '$merchant' ORDER BY id ASC LIMIT 1;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsOrder(string $logistics, string $runningDate)
        {
            # code...
            //$runningDate = '2020-01-01';
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectFirstLogisticsOrder(string $logistics)
        {
            # code...
            //$runningDate = '2020-01-01';
            $sql = "SELECT SentDateTime FROM `orders` WHERE `orders`.`Logistics` = '$logistics' ORDER BY id ASC LIMIT 1;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectPendingOrder(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` < '$runningDate'  AND (`orders`.`Status` = 'Pending' OR `orders`.`Status` = 'Taken') ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function resetOrder(string $id, string $remark)
        {
            # code...
            $sql = "UPDATE `orders` SET `Status` = 'Pending', `Feedback` = NULL, `Agent` = NULL, DateTime = NULL, `RunningDate` = CURRENT_TIMESTAMP, `Remark` = '$remark' WHERE `orders`.`id` = '$id';";
            $this->connect()->query($sql);
        }

        protected function selectRescheduledOrder(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RescheduledDate` <= '$runningDate'  AND `orders`.`Status` = 'Rescheduled' ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();
            
            return $results;
        }

        protected function selectOrdersTaken(string $logistics, string $agent, string $runningDate)
        {
            # code...
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`Agent` = '$agent' AND `orders`.`RunningDate` = '$runningDate' ORDER BY id DESC;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function updateEnableEditOrder(string $id)
        {
            # code...
            $sql = "UPDATE `orders` SET `EnableEdit` = 0 WHERE `orders`.`id` = '$id';";
            $this->connect()->query($sql);
        }

        protected function updateOrderCanceled(string $id)
        {
            # code...
            $username = $_SESSION['komitexLogisticsUsername'];

            $sql = "UPDATE `orders` SET `Status` = 'Canceled', `Agent` = '$username', DateTime = CURRENT_TIMESTAMP WHERE `orders`.`id` = '$id';";
            $this->connect()->query($sql);
            //header("location: ../index.php?cancelSuccess");
            echo 'success';
        }

        protected function updateOrderRescheduled(string $id, string $rescheduleDate)
        {
            # code...
            $sql = "UPDATE `orders` SET `Status` = 'Rescheduled', `RescheduledDate` = ?, DateTime = CURRENT_TIMESTAMP WHERE `orders`.`id` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$rescheduleDate, $id]);
            $stmt = null;
            //header("location: ../index.php?cancelSuccess");
            echo 'success';
        }

        protected function updateOrderTaken(string $id, string $username)
        {
            # code...
            $sql = "UPDATE `orders` SET `Status` = 'Taken', `Agent` = ?, DateTime = CURRENT_TIMESTAMP WHERE `orders`.`id` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $id]);
            $stmt = null;
            //header("location: ../index.php?cancelSuccess");
            echo 'success';
        }

        protected function updateOrderDropped(string $id)
        {
            # code...
            $sql = "UPDATE `orders` SET `Status` = 'Pending', `Agent` = NULL, DateTime = NULL WHERE `orders`.`id` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $stmt = null;
            //header("location: ../index.php?cancelSuccess");
            echo 'success';
        }

        protected function updateOrderFeedback(string $id, string $feedback)
        {
            # code...
            $sql = "UPDATE `orders` SET `Feedback` = ?, FeedbackTime = CURRENT_TIMESTAMP WHERE `orders`.`id` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$feedback, $id]);
            $stmt = null;

            echo 'success';
            //header("location: ../index.php?feedbackSuccess");
        }

        protected function updateOrderDelivered(string $id, string $paymentMethod)
        {
            # code...
            $sql = "UPDATE `orders` SET `PaymentMethod` = ?, `Status` = 'Delivered', DateTime = CURRENT_TIMESTAMP  WHERE `orders`.`id` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$paymentMethod, $id]);
            $stmt = null;

            echo 'success';
            //header("location: ../index.php?feedbackSuccess");
        }

        protected function removeOrder(string $id)
        {
            # code...
            $sql = "DELETE FROM `orders` WHERE `orders`.`id` = '$id';";
            $stmt = $this->connect()->query($sql);
            header("location: ../orders.php?orderDeleted");

        }

        protected function selectLogisticsDelivered(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Delivered';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsCanceled(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Canceled';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsRescheduled(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Rescheduled';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsPending(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND (`orders`.`Status` = 'Pending' OR `orders`.`Status` = 'Taken');";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsTaken(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Taken';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsNotContacted(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Pending' AND  `orders`.`Feedback` IS NULL;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsTotalOrder(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsRescheduledOrder(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND  `orders`.`Remark` LIKE '%Rescheduled%';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsRepostedOrder(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND  `orders`.`Remark` LIKE '%Reposted%';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisticsPostedOrder(string $logistics, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND `orders`.`RunningDate` = '$runningDate' AND  `orders`.`Remark` IS NULL;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
        
        protected function selectMerchantDelivered(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Delivered';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantCanceled(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Canceled';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantRescheduled(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Rescheduled';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantPending(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND (`orders`.`Status` = 'Pending' OR `orders`.`Status` = 'Taken');";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantTaken(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Taken';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantNotContacted(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND `orders`.`Status` = 'Pending' AND  `orders`.`Feedback` IS NULL;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantTotalOrder(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantRescheduledOrder(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND  `orders`.`Remark` LIKE 'Rescheduled%';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantRepostedOrder(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND  `orders`.`Remark` LIKE 'Reposted%';";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantPostedOrder(string $merchant, string $runningDate)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND `orders`.`RunningDate` = '$runningDate' AND  `orders`.`Remark` IS NULL;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisiticsOrderSearch(string $searchKey, string $logistics, string $sort, string $show)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND $show AND (`orders`.`OrderDetails` LIKE '%".$searchKey."%' OR `orders`.`Location` LIKE '%".$searchKey."%' OR `orders`.`Merchant` LIKE '%".$searchKey."%' OR `orders`.`Product` LIKE '%".$searchKey."%' OR `orders`.`Price` LIKE '%".$searchKey."%' OR `orders`.`Quantity` LIKE '%".$searchKey."%' OR `orders`.`Affiliate` LIKE '%".$searchKey."%' OR `orders`.`Agent` LIKE '%".$searchKey."%' OR ((`orders`.`Status` = 'Pending' OR `orders`.`Status` = 'Taken') AND `orders`.`Feedback` LIKE '%".$searchKey."%')) $sort LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectLogisiticsOrderSearchCount(string $searchKey, string $logistics, string $sort, string $show)
        {
            # code...
            
            
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Logistics` = '$logistics' AND $show AND (`orders`.`OrderDetails` LIKE '%".$searchKey."%' OR `orders`.`Location` LIKE '%".$searchKey."%' OR `orders`.`Merchant` LIKE '%".$searchKey."%' OR `orders`.`Product` LIKE '%".$searchKey."%' OR `orders`.`Price` LIKE '%".$searchKey."%' OR `orders`.`Quantity` LIKE '%".$searchKey."%' OR `orders`.`Affiliate` LIKE '%".$searchKey."%' OR `orders`.`Agent` LIKE '%".$searchKey."%' OR ((`orders`.`Status` = 'Pending' OR `orders`.`Status` = 'Taken') AND `orders`.`Feedback` LIKE '%".$searchKey."%')) $sort ;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
        
        protected function selectMerchantOrderSearch(string $searchKey, string $merchant, string $sort, string $show)
        {
            # code...
            $LIMIT = $_SESSION['searchArray'];
            $sql = "SELECT * FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND $show AND  (`orders`.`OrderDetails` LIKE '%".$searchKey."%' OR `orders`.`Location` LIKE '%".$searchKey."%' OR `orders`.`Logistics` LIKE '%".$searchKey."%' OR `orders`.`Merchant` LIKE '%".$searchKey."%' OR `orders`.`Product` LIKE '%".$searchKey."%' OR `orders`.`Price` LIKE '%".$searchKey."%' OR `orders`.`Quantity` LIKE '%".$searchKey."%' OR `orders`.`Affiliate` LIKE '%".$searchKey."%' OR ((`orders`.`Status` = 'Pending' OR `orders`.`Status` = 'Taken') AND `orders`.`Feedback` LIKE '%".$searchKey."%')) $sort LIMIT $LIMIT;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }

        protected function selectMerchantOrderSearchCount(string $searchKey, string $merchant, string $sort, string $show)
        {
            # code...
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`Merchant` = '$merchant' AND $show AND  (`orders`.`OrderDetails` LIKE '%".$searchKey."%' OR `orders`.`Location` LIKE '%".$searchKey."%' OR `orders`.`Logistics` LIKE '%".$searchKey."%' OR `orders`.`Merchant` LIKE '%".$searchKey."%' OR `orders`.`Product` LIKE '%".$searchKey."%' OR `orders`.`Price` LIKE '%".$searchKey."%' OR `orders`.`Quantity` LIKE '%".$searchKey."%' OR `orders`.`Affiliate` LIKE '%".$searchKey."%' OR ((`orders`.`Status` = 'Pending' OR `orders`.`Status` = 'Taken') AND `orders`.`Feedback` LIKE '%".$searchKey."%')) $sort;";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
        }
        
        protected function selectNewWaybillCount(string $dateTime, string $username, string $accountType)
        {
            $sql = "SELECT COUNT(id) FROM `waybill` WHERE `waybill`.`$accountType` = '$username' AND (`waybill`.`DateTimeSent` > '$dateTime' OR `waybill`.`DateTimeReceived` > '$dateTime'); AND DateTimeReceived IS NOT NULL";
            // $sql = "SELECT * FROM `waybill` WHERE `waybill`.`$accountType` = '$username' AND (`waybill`.`DateTimeSent` > '$dateTime' OR `waybill`.`DateTimeReceived` > '$dateTime'); AND DateTimeReceived IS NOT NULL";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
            # code...
        }

        protected function selectNewOrderCount(string $dateTime, string $username, string $accountType)
        {
            $sql = "SELECT COUNT(id) FROM `orders` WHERE `orders`.`$accountType` = '$username' AND (`orders`.`SentDateTime` > '$dateTime' OR `orders`.`DateTime` > '$dateTime'  OR `orders`.`FeedbackTime` > '$dateTime'); AND DateTime IS NOT NULL AND FeedbackTime IS NOT NULL";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
            # code...
        }

        protected function selectContactsCount(string $username, string $accountType)
        {
            $sql = "SELECT COUNT(id) FROM `contacts` WHERE `contacts`.`$accountType` = '$username'";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
            # code...
        }

        protected function selectNewContactsCount(string $dateTime, string $username, string $accountType)
        {
            $sql = "SELECT COUNT(id) FROM `contacts` WHERE `contacts`.`$accountType` = '$username' AND `contacts`.`DateTime` > '$dateTime'";
            $stmt = $this->connect()->query($sql);
            $results = $stmt->fetchAll();

            return $results;
            # code...
        }

        protected function updateIndexTime(string $username)
        {
            $sql = "UPDATE `login` SET `login`.`home` = CURRENT_TIMESTAMP WHERE `login`.`komitexLogisticsUsername` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
            $stmt = null;
        }

        protected function updateWaybillTime(string $username)
        {
            $sql = "UPDATE `login` SET `login`.`waybill` = CURRENT_TIMESTAMP WHERE `login`.`komitexLogisticsUsername` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
            $stmt = null;
        }

        protected function updateContactsTime(string $username)
        {
            $sql = "UPDATE `login` SET `login`.`contacts` = CURRENT_TIMESTAMP WHERE `login`.`komitexLogisticsUsername` = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
            $stmt = null;
        }

    }
    
?>