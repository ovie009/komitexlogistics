<?php

    class Controller extends Model
    {

        public function signup(string $fullname, string $username, string $email, string $phone, string $password)
        {
            # code...
            $emailResults = $this->checkSignupEmail($email);
            
            if (empty($emailResults)) {
                # code...
                $usernameResults = $this->checkSignupUsername($username);
                
                if (empty($usernameResults)) {
                    # code...
                    $this->insertSignup($fullname, $username, $email, $phone, $password);
                } else {
                    # code...
                    echo 'userExist';
                }

            }else{
                echo 'emailExist';
            }

        }

        public function login(string $user, string $password)
        {
            # code...
            $results = $this->checkLoginDetails($user);

            // echo 'inside controller';

            $this->saveLoginDetails($user, $results, $password);
        }
        
        public function accountType(string $account, string $email)
        {
            # code...
            $this->updateAccountType($account, $email);
        }

        public function uploadProfilePhoto(string $email, string $username, array $photo)
        {
            # code...

            $email = $_POST['email'];
            $username = $_POST['username'];
    
            $photoName = $photo['name'];
            $photoTmpName = $photo['tmp_name'];
            $photoSize = $photo['size'];
            $photoError = $photo['error'];
    
            $photoExt = explode('.', $photoName);
            $photoActualExt = strtolower(end($photoExt));
    
            $allowed = array('jpg', 'jpeg', 'png');
    
            if(in_array($photoActualExt, $allowed)){
                if($photoError === 0){
                    if($photoSize <= 3000000){
                        
                        $photoNewName = $username.'.'.$photoActualExt;
    
                        $photoDestination = '../uploads/'.$photoNewName;

                        $profilePhoto = 'uploads/'.$photoNewName;

                        $results = $this->checkLoginDetails($username);

                        if ($results[0]['komitexLogisticsProfilePhoto'] != 'icons/others/user.png') {
                            # code...
                            $results[0]['komitexLogisticsProfilePhoto'] = '../'.$results[0]['komitexLogisticsProfilePhoto'];
                            
                            unlink($results[0]['komitexLogisticsProfilePhoto']);
                            
                        }
                        
                        if (!move_uploaded_file($photoTmpName, $photoDestination)) {
                            # code...
                            header("location: ../accountinfo.php?uploadError");
                        } else {
                            $this->updateProfilePhoto($email, $profilePhoto);
                            # code...
                        }

                    }else{
                        header("location: ../accountinfo.php?largePhoto");
                    }
                }else{
                    header("location: ../accountinfo.php?uploadError");
                }
            }else{
                header("location: ../accountinfo.php?unsupportedExtension");
            }
        }

        public function deleteProfilePhoto(string $email, string $defaultPhoto)
        {
            # code...

            $results = $this->checkLoginDetails($email);
            
            if ($results[0]['komitexLogisticsProfilePhoto'] != 'icons/others/user.png') {
                # code...
                $results[0]['komitexLogisticsProfilePhoto'] = '../'.$results[0]['komitexLogisticsProfilePhoto'];
                
                unlink($results[0]['komitexLogisticsProfilePhoto']);
            }

            $this->updateProfilePhoto($email, $defaultPhoto);

        }

        public function contacts(string $username01, string $username02, string $accountType01, string $confirmAccount)
        {
            # code...

            $results = $this->checkLoginDetails($username02);
            $accountType02 = $results[0]['komitexLogisticsAccountType'];

            if (empty($results)) {
                # code...
                header("location: ../accountinfo.php?invalidUser");     
                
            } else {
                # code...
                $existingResult01 = $this->checkMyContacts($username01, $accountType01, $username02, $accountType02);
                if (empty($existingResult01)) {
                    # code...
                    $existingResult02 = $this->getContacts($username02, $accountType02);

                    if ($confirmAccount == 'Affiliate') {
                        # code...
                        if (empty($existingResult02)) {
                            # code...
                            $this->insertContacts($username01, $username02, $accountType01, $accountType02);
                            $this->approveContacts($username01, $username02, $accountType01, $accountType02);
                            header("location: ../accountinfo.php?added".$confirmAccount."");     
                        } else {
                            # code...
                            header("location: ../accountinfo.php?existingResult".$confirmAccount."");     
                        }
                        
                    } else if ($confirmAccount == 'Agent'){
                        # code...
                        if (empty($existingResult02)) {
                            # code...
                            $this->insertContacts($username01, $username02, $accountType01, $accountType02);
                            $this->approveContacts($username01, $username02, $accountType01, $accountType02);
                            header("location: ../accountinfo.php?added".$confirmAccount."");     
                        } else {
                            # code...
                            header("location: ../accountinfo.php?existingResult".$confirmAccount."");     
                        }
                        
                    } else if ($confirmAccount == 'Logistics'){
                        # code...
                        $this->insertContacts($username01, $username02, $accountType01, $accountType02);
                        header("location: ../accountinfo.php?requestSent");     
                    }
    
                    
                } else {
                    # code...
                    header("location: ../accountinfo.php?my".$confirmAccount."Result");     

                }
            }
        }

        public function resendContacts(string $username01, string $accountType01, string $username02, string $accountType02, string $confirmAccount)
        {
            # code...
            $this->deleteContacts($username01, $accountType01, $username02, $accountType02);
            $this->contacts($username01, $username02, $accountType01, $confirmAccount);
        }

        public function removeContacts(string $username01, string $accountType01, string $username02, string $accountType02)
        {
            # code...
            $this->deleteContacts($username01, $accountType01, $username02, $accountType02);
        }

        public function confirmContact(string $username01, string $username02, string $accountType01, string $accountType02)
        {
            # code...
            $this->approveContacts($username01, $username02, $accountType01, $accountType02);
        }

        public function declineContact(string $username01, string $accountType01, string $username02, string $accountType02)
        {
            # code...
            $this->declineContacts($username01, $accountType01, $username02, $accountType02);
        }

        public function addLocation(string $username, string $location, string $price)
        {
            # code...
            $results = $this->checkLocation($username, $location);
            if (empty($results)) {
                # code...
                $this->newLocation($username, $location, $price);
            }   else{
                header("location: ../accountinfo.php?locationExist");
            }
        }

        public function editLocation(string $username, string $location, string $price)
        {
            # code...
            $this->updateLocation($username, $location, $price);
        }

        public function submitNoDiscountProduct(string $username, string $productName, string $productPrice, string $productPhoto, string $photoTmpName)
        {
            # code...
            $results = $this->checkProduct($username, $productName);
            if (empty($results)) {
                # code...
                $this->insertNoDiscountProduct($username, $productName, $productPrice, $productPhoto, $photoTmpName);
            } else{
                header("location: ../waybill.php?productExist&Tab=products");
            }
        }
        
        public function submitGroup(string $username, string $productName, string $productPrice, string $productPhoto, string $photoTmpName, string $firstProduct, string $firstQuantity, string $secondProduct, string $secondQuantity, string $thirdProduct, string $thirdQuantity)
        {
            # code...
            $results = $this->checkProduct($username, $productName);
            $groupResults = $this->checkGroups($username, $productName);
            if (empty($results) && empty($groupResults)) {
                # code...
                $this->insertGroup($username, $productName, $firstProduct, $firstQuantity, $secondProduct, $secondQuantity, $thirdProduct, $thirdQuantity);
                $this->insertProductGroup($username, $productName, $productPrice, $productPhoto, $photoTmpName);

            } else{
                header("location: ../waybill.php?groupExist&Tab=products");
            }
            
        }
        
        public function submitOneDiscountProduct(string $username, string $productName, string $productPrice, string $price1, string $quantity1, string $productPhoto, string $photoTmpName)
        {
            # code...
            $results = $this->checkProduct($username, $productName);
            if (empty($results)) {
                # code...
                $this->insertOneDiscountProduct($username, $productName, $productPrice, $price1, $quantity1, $productPhoto, $photoTmpName);
            } else{
                header("location: ../waybill.php?productExist&Tab=products");
            }
        }
        
        public function submitTwoDiscountProduct(string $username, string $productName, string $productPrice, string $price1, string $quantity1, string $price2, string $quantity2, string $productPhoto, string $photoTmpName)
        {
            # code...
            $results = $this->checkProduct($username, $productName);
            if (empty($results)) {
                # code...
                $this->insertTwoDiscountProduct($username, $productName, $productPrice, $price1, $quantity1, $price2, $quantity2, $productPhoto, $photoTmpName);
            } else{
                header("location: ../waybill.php?productExist&Tab=products");
            }
        }
        
        public function submitThreeDiscountProduct(string $username, string $productName, string $productPrice, string $price1, string $quantity1, string $price2, string $quantity2, string $price3, string $quantity3, string $productPhoto, string $photoTmpName)
        {
            # code...
            $results = $this->checkProduct($username, $productName);
            if (empty($results)) {
                # code...
                $this->insertThreeDiscountProduct($username, $productName, $productPrice, $price1, $quantity1, $price2, $quantity2, $price3, $quantity3, $productPhoto, $photoTmpName);
            } else{
                header("location: ../waybill.php?productExist&Tab=products");
            }
        }
        
        public function submitDiscount(string $username, string $productName, string $price, string $quantity, string $action)
        {
            # code...
            if ($action == 'submitDiscount1') {
                # code...
                $this->updateOneDiscount($username, $productName, $price, $quantity);
            } elseif ($action == 'submitDiscount2') {
                # code...
                $this->updateSecondDiscount($username, $productName, $price, $quantity);
            } elseif ($action == 'submitDiscount3') {
                # code...
                $this->updateThirdDiscount($username, $productName, $price, $quantity);
            }
            
            
        }

        public function deleteDiscount(string $username, string $productName, string $action)
        {
            # code...
            if ($action == 'deleteDiscount1') {
                # code...
                $this->updateOneDiscountNull($username, $productName);
            } elseif ($action == 'deleteDiscount2') {
                # code...
                $this->updateSecondDiscountNull($username, $productName);
            } elseif ($action == 'deleteDiscount3') {
                # code...
                $this->updateThirdDiscountNull($username, $productName);
            }
            
            
        }

        public function changeProductPicture(string $username, string $productName, string $productPhoto, string $photoTmpName)
        {
            # code...
            $this->updateProductPhoto($username, $productName, $productPhoto, $photoTmpName);
        }

        public function editPrice(string $username, string $productName, string $price)
        {
            # code...
            $this->updateProductPrice($username, $productName, $price);
        }

        public function submitWaybill(string $merchant, string $logistics, string $productName, string $numberSent)
        {
            # code...
            $this->updateProductDateTime($merchant, $productName);
            $this->insertWaybill($merchant, $logistics, $productName, $numberSent);
        }

        public function submitDetailedWaybill(string $merchant, string $logistics, string $productName, string $numberSent, string $waybillDetails)
        {
            # code...
            $this->insertDetailedWaybill($merchant, $logistics, $productName, $numberSent, $waybillDetails);
        }

        public function editWaybill(int $id, string $numberSent)
        {
            # code...
            $this->updateWaybill($id, $numberSent);
        }

        public function approveWaybill(int $id, string $merchant, string $logistics, string $productName, int $numberSent)
        {
            # code...
            $results = $this->selectStock($merchant, $logistics, $productName);
            if (empty($results)) {
                # code...
                $this->insertStock($merchant, $logistics, $productName, $numberSent);
                $this->updateWaybillApproved($id);
     
                header("location: ../waybill.php");
                
            } else {
                # code...
                $numberSent += $results[0]['StockLeft'];
                $this->updateStock($merchant, $logistics, $productName, $numberSent);
                $this->updateWaybillApproved($id);
                
                header("location: ../waybill.php?Tab=waybill");
            }
            
        }

        public function approveAgentWaybill(int $id)
        {
            # code...
            $this->updateAgentWaybillApproved($id);
            
        }

        public function waybillLocation(string $merchant,string $logistics, string $productName, string $numberSent, string $waybillDetails, string $location)
        {
            # code...
            if ($waybillDetails == 'none') {
                # code...
                $this->insertWaybillL($merchant, $logistics, $productName, $numberSent, $location);
            } else {
                # code...
                $this->insertWaybillLD($merchant, $logistics, $productName, $numberSent, $waybillDetails, $location);
            }
        }

        public function submitOrder(string $merchant, string $affiliate, string $logistics, string $orderDetails, string $productName, string $type, int $quantity, string $location, float $price, float $cost)
        {
            # code...
            $results = $this->checkLocation($logistics, $location);
            $cost = floatval($results[0]['price']);

            if ($affiliate == 'none') {
                # code...
                $this->updateProductDateTime($merchant, $productName);
                $this->insertMerchantOrder($merchant, $logistics, $orderDetails, $productName, $type, $quantity, $price, $location, $cost);
            } else {
                # code...
                $this->updateProductDateTime($merchant, $productName);
                $this->insertAffiliateOrder($merchant, $affiliate, $logistics, $orderDetails, $type, $productName, $quantity, $price, $location, $cost);
            }
            
        }

        public function disableEdit(string $merchant)
        {
            # code...
            $results = $this->selectOrder($merchant);

            foreach ($results as $result) {
                # code...
                $sentDateTime = strtotime($result['SentDateTime']);
                $currentDateTime = time();
                $enableEdit = $result['EnableEdit'];
                $id = $result['id'];
                if ($enableEdit == 1) {
                    # code...
                    $difference = $currentDateTime - $sentDateTime;
                    $minutes = floor($difference/60);

                    if ($minutes > 5) {
                        # code...
                        $this->updateEnableEditOrder($id);
                    }
                }
            }
        }

        public function deleteOrder(string $id)
        {
            # code...
            $this->removeOrder($id);
        }

        public function cancelOrder(string $id)
        {
            # code...
            $this->updateOrderCanceled($id);
        }

        public function enterFeedback(string $id, string $feedback)
        {
            # code...
            $this->updateOrderFeedback($id, $feedback);
        }

        public function enterDelivered(string $id, string $paymentMethod, string $type)
        {
            # code...
            if ($type == 'Product') {
                # code...
                $result = $this->selectSingleOrder($id);
                $merchant = $result[0]['Merchant'];
                $logistics = $result[0]['Logistics'];
                $productName = $result[0]['Product'];
                $quantity = intval($result[0]['Quantity']);
                $stockResults = $this->selectStock($merchant, $logistics, $productName);
                if (intval($stockResults[0]['StockLeft']) >= $quantity) {
                    # code...
                    $stockLeft = intval($stockResults[0]['StockLeft']) - $quantity;
                    $this->updateStock($merchant, $logistics, $productName, $stockLeft);
                    $this->updateOrderDelivered($id, $paymentMethod);
                } else {
                    # code...
                    echo 'No Stock';
                }
                
            } else {
                # code...
                $result = $this->selectSingleOrder($id);
                $merchant = $result[0]['Merchant'];
                $logistics = $result[0]['Logistics'];
                $productName = $result[0]['Product'];
                $groupResults = $this->checkGroups($merchant, $productName);
                $firstProduct = $groupResults[0]['FirstProduct'];
                $secondProduct = $groupResults[0]['SecondProduct'];
                $thirdProduct = $groupResults[0]['ThirdProduct'];
                $firstQuantity = intval($groupResults[0]['FirstQuantity']);
                $secondQuantity = intval($groupResults[0]['SecondQuantity']);
                $thirdQuantity = intval($groupResults[0]['ThirdQuantity']);

                $checkArray = array();
                if ($firstProduct != NULL) {
                    # code...
                    $firstCheck = $this->selectStock($merchant, $logistics, $firstProduct);
                    if (!empty($firstCheck)) {
                        # code...
                        if (intval($firstCheck[0]['StockLeft']) >= $firstQuantity) {
                            # code...
                            $checkArray[] = 'true';
                        } else {
                            # code...
                            $checkArray[] = 'false';
                        }
                    } 
                }
                
                if ($secondProduct != NULL) {
                    # code...
                    $secondCheck = $this->selectStock($merchant, $logistics, $secondProduct);
                    if (!empty($secondCheck)) {
                        # code...
                        if (intval($secondCheck[0]['StockLeft']) >= $secondQuantity) {
                            # code...
                            $checkArray[] = 'true';
                        } else {
                            # code...
                            $checkArray[] = 'false';
                        }
                    }
                }
                
                if ($thirdProduct != NULL) {
                    # code...
                    $thirdCheck = $this->selectStock($merchant, $logistics, $thirdProduct);
                    if (!empty($thirdCheck)) {
                        # code...
                        if (intval($thirdCheck[0]['StockLeft']) >= $thirdQuantity) {
                            # code...
                            $checkArray[] = 'true';
                        } else {
                            # code...
                            $checkArray[] = 'false';
                        }
                    }
                    
                }

                if ((in_array('false', $checkArray))) {
                    # code...
                    echo 'No Stock';
                    
                } else {
                    # code...
                    if ($firstProduct != NULL) {
                        # code...
                        $firstCheck = $this->selectStock($merchant, $logistics, $firstProduct);
                        if (!empty($firstCheck)) {
                            # code...
                            $firstStock = intval($firstCheck[0]['StockLeft']) - $firstQuantity;
                            $this->updateStock($merchant, $logistics, $firstProduct, $firstStock);
                        }
                    }
                    if ($secondProduct != NULL) {
                        # code...
                        $secondCheck = $this->selectStock($merchant, $logistics, $secondProduct);
                        if (!empty($secondCheck)) {
                            # code...
                            $secondStock = intval($secondCheck[0]['StockLeft']) - $secondQuantity;
                            $this->updateStock($merchant, $logistics, $secondProduct, $secondStock);
                        }
                    }
                    if ($thirdProduct != NULL) {
                        # code...
                        $thirdCheck = $this->selectStock($merchant, $logistics, $thirdProduct);
                        if (!empty($thirdCheck)) {
                            # code...
                            $thirdStock = intval($thirdCheck[0]['StockLeft']) - $thirdQuantity;
                            $this->updateStock($merchant, $logistics, $thirdProduct, $thirdStock);
                        }
                    }
                    $this->updateOrderDelivered($id, $paymentMethod);
                }
            }
        }

        public function enterRescheduleDate(string $id, string $rescheduleDate)
        {
            # code...
            $this->updateOrderRescheduled($id, $rescheduleDate);
        }

        public function takeOrder(string $id, string $username)
        {
            # code...
            $this->updateOrderTaken($id, $username);
        }

        public function dropOrder(string $id)
        {
            # code...
            $this->updateOrderDropped($id);
        }

        public function repostPendingOrder(string $logistics)
        {
            # code...
            $runningDate = date('Y-m-d');
            $results = $this->selectPendingOrder($logistics, $runningDate);

            foreach ($results as $result) {
                # code...
                $id = $result['id'];
                $oldRunningDate = $result['RunningDate'];
                $oldDate = date("D F jS Y", strtotime($oldRunningDate));
                $remark = 'Reposted from '.$oldDate;
                $this->resetOrder($id, $remark);
            }
        }

        public function repostRescheduledOrder(string $logistics)
        {
            # code...
            $runningDate = date('Y-m-d');
            $results = $this->selectRescheduledOrder($logistics, $runningDate);

            foreach ($results as $result) {
                # code...
                $id = $result['id'];
                $rescheduleDate = $result['RescheduledDate'];
                $oldDate = date("D F jS Y", strtotime($rescheduleDate));
                $remark = 'Rescheduled from '.$oldDate;
                $this->resetOrder($id, $remark);
            }
        }

        public function setWaybillTime(string $username)
        {
            # code...
            $this->updateWaybillTime($username);
        }

        public function setIndexTime(string $username)
        {
            # code...
            $this->updateIndexTime($username);
        }

        public function setContactsTime(string $username)
        {
            # code...
            $this->updateContactsTime($username);
        }

    }

?>