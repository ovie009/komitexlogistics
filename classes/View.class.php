<?php

    class View extends Model
    {
        public function viewContacts(string $username, string $accountType)
        {
            # code...
            $results = $this->getContacts($username, $accountType);
            return $results;
        }
        
        public function viewContactsLimit(string $username, string $accountType)
        {
            # code...
            $results = $this->getContactsLimit($username, $accountType);
            return $results;
        }
        
        public function viewAgents(string $username, string $accountType)
        {
            # code...
            $results = $this->getAgents($username, $accountType);
            return $results;
        }
        
        public function viewAgentAgents(string $username, string $accountType, string $agent)
        {
            # code...
            $results = $this->getAgentAgents($username, $accountType, $agent);
            return $results;
        }
        
        public function viewLogisticsContacts(string $username, string $accountType)
        {
            # code...
            $results = $this->getLogisticsContacts($username, $accountType);
            return $results;
        }
        
        public function viewMerchantContacts(string $username, string $accountType)
        {
            # code...
            $results = $this->getMerchantContacts($username, $accountType);
            return $results;
        }
        
        public function getContactDetails(string $username02)
        {
            # code...
            $results = $this->checkLoginDetails($username02);
            return $results;
        }

        public function viewLocation(string $username)
        {
            # code...
            $results = $this->selectLocation($username);
            return $results;
        }       
        
        public function viewProducts(string $username)
        {
            # code...
            $results = $this->selectProduct($username);
            return $results;
        }
        
        public function viewProductsNoLimit(string $username)
        {
            # code...
            $results = $this->selectProductNoLimit($username);
            return $results;
        }
        
        public function viewProductsExceptTwo(string $username, string $product01, string $product02)
        {
            # code...
            $results = $this->selectProductsExceptTwo($username, $product01, $product02);
            return $results;
        }
        
        public function viewDispatchedProduct(string $username, string $dateTime)
        {
            # code...
            $results = $this->selectDispatchedProduct($username, $dateTime);
            return $results;
        }
        
        public function countProducts(string $username)
        {
            # code...
            $results = $this->selectProductCount($username);
            return $results;
        }
        
        public function viewWaybill(string $username)
        {
            # code...
            $results = $this->selectWaybill($username);
            return $results;
        }

        public function countWaybill(string $username)
        {
            # code...
            $results = $this->selectWaybillCount($username);
            return $results;
        }

        public function viewLogisticsWaybill(string $username)
        {
            # code...
            $results = $this->selectLogisticsWaybill($username);
            return $results;
        }

        public function countLogisticsWaybill(string $username)
        {
            # code...
            $results = $this->selectLogisticsWaybillCount($username);
            return $results;
        }

        public function viewApprovedWaybill(string $username)
        {
            # code...
            $results = $this->selectApprovedWaybill($username);
            return $results;
        }
        
        public function viewSingleProduct(string $merchant, string $productName)
        {
            # code...
            $results = $this->checkProduct($merchant, $productName);
            return $results;
        }

        public function viewSingleGroups(string $merchant, string $productName)
        {
            # code...
            $results = $this->checkGroups($merchant, $productName);
            return $results;
        }

        public function viewGroups(string $merchant)
        {
            # code...
            $results = $this->selectGroups($merchant);
            return $results;
        }

        public function viewStock(string $merchant, string $logistics, string $productName)
        {
            # code...
            $results = $this->selectStock($merchant, $logistics, $productName);
            return $results;
        }

        public function viewMerchantStock(string $merchant)
        {
            # code...
            $results = $this->selectMerchantStock($merchant);
            return $results;
        }

        public function viewLogisticsStock(string $logistics)
        {
            # code...
            $results = $this->selectLogisticsStock($logistics);
            return $results;
        }

        public function countLogisticsStock(string $logistics)
        {
            # code...
            $results = $this->selectLogisticsStockCount($logistics);
            return $results;
        }

        public function viewLogisticsMerchantStock(string $logistics, string $merchant)
        {
            # code...
            $results = $this->selectLogisticsMerchantStock($logistics, $merchant);
            return $results;
        }

        public function viewWaybillWithLogistics(string $merchant, string $logistics)
        {
            # code...
            $results = $this->selectWaybillWithLogistics($merchant, $logistics);
            return $results;
        }

        public function viewOrder(string $merchant)
        {
            # code...
            $results = $this->selectOrder($merchant);
            return $results;
        }

        public function countOrder(string $merchant)
        {
            # code...
            $results = $this->selectOrderCount($merchant);
            return $results;
        }

        public function viewMerchantOrder(string $merchant, string $runningDate)
        {
            # code...
            //$runningDate = '2020-01-01';
            //$runningDate = date('Y-m-d');
            $results = $this->selectMerchantOrder($merchant, $runningDate);
            return $results;
        }

        public function viewFirstMerchantOrder(string $merchant)
        {
            # code...
            $results = $this->selectFirstMerchantOrder($merchant);
            return $results;
        }

        public function viewLogisticsOrder(string $logistics, string $runningDate)
        {
            # code...
            //$runningDate = '2020-01-01';
            //$runningDate = date('Y-m-d');
            $results = $this->selectLogisticsOrder($logistics, $runningDate);
            return $results;
        }

        public function viewFirstLogisticsOrder(string $logistics)
        {
            # code...
            $results = $this->selectFirstLogisticsOrder($logistics);
            return $results;
        }

        public function viewPendingOrder(string $logistics)
        {
            # code...
            $runningDate = date('Y-m-d');
            $results = $this->selectPendingOrder($logistics, $runningDate);
            return $results;
        }

        public function viewRescheduledOrder(string $logistics)
        {
            # code...
            $runningDate = date('Y-m-d');
            $results = $this->selectRescheduledOrder($logistics, $runningDate);
            return $results;
        }

        public function viewOrdersTaken(string $logistics, string $agent, string $runningDate)
        {
            # code...
            $results = $this->selectOrdersTaken($logistics, $agent, $runningDate);
            return $results;
        }

        public function countLogisticsDelivered(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsDelivered($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsCanceled(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsCanceled($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsRescheduled(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsRescheduled($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsPending(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsPending($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsTaken(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsTaken($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsNotContacted(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsNotContacted($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsTotalOrder(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsTotalOrder($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsRescheduledOrder(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsRescheduledOrder($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsRepostedOrder(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsRepostedOrder($logistics, $runningDate);
            return $results;
        }

        public function countLogisticsPostedOrder(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsPostedOrder($logistics, $runningDate);
            return $results;
        }

        public function countMerchantDelivered(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantDelivered($merchant, $runningDate);
            return $results;
        }

        public function countMerchantCanceled(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantCanceled($merchant, $runningDate);
            return $results;
        }

        public function countMerchantRescheduled(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantRescheduled($merchant, $runningDate);
            return $results;
        }

        public function countMerchantPending(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantPending($merchant, $runningDate);
            return $results;
        }

        public function countMerchantTaken(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantTaken($merchant, $runningDate);
            return $results;
        }

        public function countMerchantNotContacted(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantNotContacted($merchant, $runningDate);
            return $results;
        }

        public function countMerchantTotalOrder(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantTotalOrder($merchant, $runningDate);
            return $results;
        }

        public function countMerchantRescheduledOrder(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantRescheduledOrder($merchant, $runningDate);
            return $results;
        }

        public function countMerchantRepostedOrder(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantRepostedOrder($merchant, $runningDate);
            return $results;
        }

        public function countMerchantPostedOrder(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantPostedOrder($merchant, $runningDate);
            return $results;
        }

        public function viewLogisiticsOrderSearch(string $searchKey, string $logistics, string $sort, string $show)
        {
            # code...
            if ($sort == 'uploadNewest') {
                # code...
                $SORT = "ORDER BY id DESC";

            } else if ($sort == 'uploadOldest'){
                # code...
                $SORT = "ORDER BY id ASC";

            } else if ($sort == 'priceAsc'){
                # code...
                $SORT = "ORDER BY Price ASC";

            } else if ($sort == 'priceDesc'){
                # code...
                $SORT = "ORDER BY Price DESC";

            } else if ($sort == 'locationDesc'){
                # code...
                $SORT = "ORDER BY Location DESC";

            } else if ($sort == 'locationAsc'){
                # code...
                $SORT = "ORDER BY Location ASC";

            } else if ($sort == 'merchantAsc'){
                # code...
                $SORT = "ORDER BY Merchant ASC";

            } else if ($sort == 'merchantDesc'){
                # code...
                $SORT = "ORDER BY Merchant DESC";

            }


            if ($show == 'all') {
                # code...
                $SHOW = "Status IS NOT NULL";

            } else if ($show == 'delivered'){
                # code...
                $SHOW = "Status = 'Delivered'";
                
            } else if ($show == 'canceled'){
                # code...
                $SHOW = "Status = 'Canceled'";

            } else if ($show == 'rescheduled'){
                # code...
                $SHOW = "Status = 'Rescheduled'";

            } else if ($show == 'pending'){
                # code...
                $SHOW = "Status = 'Pending'";

            }
            
            
            $results = $this->selectLogisiticsOrderSearch($searchKey, $logistics, $SORT, $SHOW);
            return $results;
        }
        
        public function viewMerchantOrderSearch(string $searchKey, string $merchant, string $sort, string $show)
        {
            # code...
            if ($sort == 'uploadNewest') {
                # code...
                $SORT = "ORDER BY id DESC";
        
            } else if ($sort == 'uploadOldest'){
                # code...
                $SORT = "ORDER BY id ASC";
        
            } else if ($sort == 'priceAsc'){
                # code...
                $SORT = "ORDER BY Price ASC";
        
            } else if ($sort == 'priceDesc'){
                # code...
                $SORT = "ORDER BY Price DESC";
        
            } else if ($sort == 'locationDesc'){
                # code...
                $SORT = "ORDER BY Location DESC";
        
            } else if ($sort == 'locationAsc'){
                # code...
                $SORT = "ORDER BY Location ASC";
        
            } else if ($sort == 'merchantAsc'){
                # code...
                $SORT = "ORDER BY Merchant ASC";
        
            } else if ($sort == 'merchantDesc'){
                # code...
                $SORT = "ORDER BY Merchant DESC";
        
            }
        
            if ($show == 'all') {
                # code...
                $SHOW = "Status IS NOT NULL";
        
            } else if ($show == 'delivered'){
                # code...
                $SHOW = "Status = 'Delivered'";
                
            } else if ($show == 'canceled'){
                # code...
                $SHOW = "Status = 'Canceled'";
        
            } else if ($show == 'rescheduled'){
                # code...
                $SHOW = "Status = 'Rescheduled'";
        
            } else if ($show == 'pending'){
                # code...
                $SHOW = "Status = 'Pending'";
        
            }
            
            $results = $this->selectMerchantOrderSearch($searchKey, $merchant, $SORT, $SHOW);
            return $results;
        }
        
        public function countLogisiticsOrderSearch(string $searchKey, string $logistics, string $sort, string $show)
        {
            # code...
            if ($sort == 'uploadNewest') {
                # code...
                $SORT = "ORDER BY id DESC";

            } else if ($sort == 'uploadOldest'){
                # code...
                $SORT = "ORDER BY id ASC";

            } else if ($sort == 'priceAsc'){
                # code...
                $SORT = "ORDER BY Price ASC";

            } else if ($sort == 'priceDesc'){
                # code...
                $SORT = "ORDER BY Price DESC";

            } else if ($sort == 'locationDesc'){
                # code...
                $SORT = "ORDER BY Location DESC";

            } else if ($sort == 'locationAsc'){
                # code...
                $SORT = "ORDER BY Location ASC";

            } else if ($sort == 'merchantAsc'){
                # code...
                $SORT = "ORDER BY Merchant ASC";

            } else if ($sort == 'merchantDesc'){
                # code...
                $SORT = "ORDER BY Merchant DESC";

            }


            if ($show == 'all') {
                # code...
                $SHOW = "Status IS NOT NULL";

            } else if ($show == 'delivered'){
                # code...
                $SHOW = "Status = 'Delivered'";
                
            } else if ($show == 'canceled'){
                # code...
                $SHOW = "Status = 'Canceled'";

            } else if ($show == 'rescheduled'){
                # code...
                $SHOW = "Status = 'Rescheduled'";

            } else if ($show == 'pending'){
                # code...
                $SHOW = "Status = 'Pending'";

            }
            
            
            $results = $this->selectLogisiticsOrderSearchCount($searchKey, $logistics, $SORT, $SHOW);
            return $results;
        }
        
        public function countMerchantOrderSearch(string $searchKey, string $merchant, string $sort, string $show)
        {
            # code...
            if ($sort == 'uploadNewest') {
                # code...
                $SORT = "ORDER BY id DESC";
        
            } else if ($sort == 'uploadOldest'){
                # code...
                $SORT = "ORDER BY id ASC";
        
            } else if ($sort == 'priceAsc'){
                # code...
                $SORT = "ORDER BY Price ASC";
        
            } else if ($sort == 'priceDesc'){
                # code...
                $SORT = "ORDER BY Price DESC";
        
            } else if ($sort == 'locationDesc'){
                # code...
                $SORT = "ORDER BY Location DESC";
        
            } else if ($sort == 'locationAsc'){
                # code...
                $SORT = "ORDER BY Location ASC";
        
            } else if ($sort == 'merchantAsc'){
                # code...
                $SORT = "ORDER BY Merchant ASC";
        
            } else if ($sort == 'merchantDesc'){
                # code...
                $SORT = "ORDER BY Merchant DESC";
        
            }
        
            if ($show == 'all') {
                # code...
                $SHOW = "Status IS NOT NULL";
        
            } else if ($show == 'delivered'){
                # code...
                $SHOW = "Status = 'Delivered'";
                
            } else if ($show == 'canceled'){
                # code...
                $SHOW = "Status = 'Canceled'";
        
            } else if ($show == 'rescheduled'){
                # code...
                $SHOW = "Status = 'Rescheduled'";
        
            } else if ($show == 'pending'){
                # code...
                $SHOW = "Status = 'Pending'";
        
            }
            
            $results = $this->selectMerchantOrderSearchCount($searchKey, $merchant, $SORT, $SHOW);
            return $results;
        }

        public function viewLogisticsDeliveredOrder(string $logistics, string $runningDate)
        {
            # code...
            $results = $this->selectLogisticsDeliveredOrder($logistics, $runningDate);
            return $results;
        }

        public function viewMerchantDeliveredOrder(string $merchant, string $runningDate)
        {
            # code...
            $results = $this->selectMerchantDeliveredOrder($merchant, $runningDate);
            return $results;
        }

        public function viewLogisticsWaybillSum(string $logistics, string $productName, string $merchant)
        {
            # code...
            $results = $this->selectLogisticsWaybillSum($logistics, $productName, $merchant);
            return $results;
        }

        public function viewMerchantWaybillSum(string $merchant, string $productName, string $logistics)
        {
            # code...
            $results = $this->selectMerchantWaybillSum($merchant, $productName, $logistics);
            return $results;
        }

        public function viewLocationPrice(string $logistics, string $location)
        {
            # code...
            $results = $this->checkLocation($logistics, $location);
            return $results;    
        }

        public function viewWaybillReport(string $accountType, string $username, string $dateTime)
        {
            # code...
            $results = $this->selectWaybillReport($accountType, $username, $dateTime);
            return $results;    
        }

        public function viewNewWaybillCount(string $dateTime, string $username, string $accountType)
        {
            # code...
            $results = $this->selectNewWaybillCount($dateTime, $username, $accountType);
            return $results;    
        }

        public function viewNewOrderCount(string $dateTime, string $username, string $accountType)
        {
            # code...
            $results = $this->selectNewOrderCount($dateTime, $username, $accountType);
            return $results;    
        }

        public function viewNewContactsCount(string $dateTime, string $username, string $accountType)
        {
            # code...
            $results = $this->selectNewContactsCount($dateTime, $username, $accountType);
            return $results;    
        }

        public function viewContactsCount(string $username, string $accountType)
        {
            # code...
            $results = $this->selectContactsCount($username, $accountType);
            return $results;    
        }

        public function linkPhoneNumbers(string $orderDetails)
        {
            # code...
            $orderPositions = array();
            $orderLength = strlen($orderDetails);
            $lastPos = 0;
            $spaces = array(" ", "\n", "\t");
            foreach ($spaces as $sp) {
                # code...
                $phoneNumber = array("".$sp."+234", "".$sp."234", "".$sp."07", "".$sp."08", "".$sp."09", "".$sp."70", "".$sp."71", "".$sp."80", "".$sp."81", "".$sp."90", "".$sp."91");
            
                foreach ($phoneNumber as $a) {
                    # code...
                    while (($lastPos = stripos($orderDetails, $a, $lastPos)) !== false) {
            
                        $orderPositions[] = $lastPos;
                        $lastPos = $lastPos + strlen($a);
                    
                    }
            
                    rsort($orderPositions);
            
                    if ($a === "".$sp."+234") {
                        # code...
                        if (sizeof($orderPositions) > 0) {
                            # code...
                            $Index = 0;
                            foreach ($orderPositions as $b) {
                                # code...
                                $b += 1;
                                if (($b + 14) > $orderLength) {
                                    # code...
                                    unset($orderPositions[$Index]);
                                } else {
                                    $test = substr($orderDetails, $b, 14);
                                    if (!preg_match('/[a-zA-Z":=<>]+$/', $test)) {
                                        # code...
                                        if (!strpos($test, ' ') || !strpos($test, '-')) {
                                            # code...
                                            $x = $b + 14;
                                            $y = $b;
                                            $linkStart = '<a href="tel:'.$test.'">';
                                            $linkEnd = '</a>';
                                            $orderDetails = substr_replace($orderDetails, $linkEnd, $x, 0);
                                            $orderDetails = substr_replace($orderDetails, $linkStart, $y, 0);
                                        } else {
                                            $test = substr($orderDetails, $b, 17);
                                            if (!preg_match('/[a-zA-Z":=><]+$/', $test)) {
                                                # code...
                                                if (!strpos($test, 'br')) {
                                                    # code...
                                                    $x = $b + 17;
                                                    $y = $b;
                                                    $linkStart = '<a href="tel:'.$test.'">';
                                                    $linkEnd = '</a>';
                                                    $orderDetails = substr_replace($orderDetails, $linkEnd, $x, 0);
                                                    $orderDetails = substr_replace($orderDetails, $linkStart, $y, 0);
                                                }
                                            }   
                                        }
                                    }
                                }
                                $Index++;
                            }
                        }
            
                    } else if ($a === "".$sp."234") {
                        # code...
                        if (sizeof($orderPositions) > 0) {
                            # code...
                            $Index = 0;
                            foreach ($orderPositions as $b) {
                                # code...
                                $b += 1;
                                if (($b + 13) > $orderLength) {
                                    # code...
                                    unset($orderPositions[$Index]);
                                } else {
                                    $test = substr($orderDetails, $b, 10);
                                    if (!preg_match('/[a-zA-Z":=<>]+$/', $test)) {
                                        # code...
                                        if (!strpos($test, ' ') || !strpos($test, '-')) {
                                            # code...
                                            $x = $b + 13;
                                            $y = $b;
                                            $linkStart = '<a href="tel:'.$test.'">';
                                            $linkEnd = '</a>';
                                            $orderDetails = substr_replace($orderDetails, $linkEnd, $x, 0);
                                            $orderDetails = substr_replace($orderDetails, $linkStart, $y, 0);
                                        } else {
                                            $test = substr($orderDetails, $b, 16);
                                            if (!preg_match('/[a-zA-Z":=><]+$/', $test)) {
                                                # code...
                                                if (!strpos($test, 'br')) {
                                                    # code...
                                                    $x = $b + 16;
                                                    $y = $b;
                                                    $linkStart = '<a href="tel:'.$test.'">';
                                                    $linkEnd = '</a>';
                                                    $orderDetails = substr_replace($orderDetails, $linkEnd, $x, 0);
                                                    $orderDetails = substr_replace($orderDetails, $linkStart, $y, 0);
                                                }
                                            }   
                                        }
                                    }
                                }
                                $Index++;
                            }
                        }
            
                    } else if ($a === "".$sp."07" || $a === "".$sp."08" || $a === "".$sp."09"){
                        # code...
                        if (sizeof($orderPositions) > 0) {
                            # code...
                            $Index = 0;
                            foreach ($orderPositions as $b) {
                                # code...
                                $b += 1;
                                if (($b + 10) > $orderLength) {
                                    # code...
                                    unset($orderPositions[$Index]);
                                } else {
                                    $test = substr($orderDetails, $b, 11);
                                    if (!preg_match('/[a-zA-Z":=<>]+$/', $test)) {
                                        # code...
                                        if (!strpos($test, ' ') || !strpos($test, '-')) {
                                            # code...
                                            $x = $b + 11;
                                            $y = $b;
                                            $linkStart = '<a href="tel:'.$test.'">';
                                            $linkEnd = '</a>';
                                            $orderDetails = substr_replace($orderDetails, $linkEnd, $x, 0);
                                            $orderDetails = substr_replace($orderDetails, $linkStart, $y, 0);
                                        } else {
                                            $test = substr($orderDetails, $b, 13);
                                            if (!preg_match('/[a-zA-Z":=><]+$/', $test)) {
                                                # code...
                                                if (!strpos($test, 'br')) {
                                                    # code...
                                                    $x = $b + 13;
                                                    $y = $b;
                                                    $linkStart = '<a href="tel:'.$test.'">';
                                                    $linkEnd = '</a>';
                                                    $orderDetails = substr_replace($orderDetails, $linkEnd, $x, 0);
                                                    $orderDetails = substr_replace($orderDetails, $linkStart, $y, 0);
                                                }
                                            }   
                                        }
                                    }
                                }
                                $Index++;
                            }
                        }
            
                    } else if ($a === "".$sp."70" || $a === "".$sp."71" || $a === "".$sp."80" || $a === "".$sp."81" || $a === "".$sp."90" || $a === "".$sp."91"){
                        # code...
                        if (sizeof($orderPositions) > 0) {
                            # code...
                            $Index = 0;
                            foreach ($orderPositions as $b) {
                                # code...
                                $b += 1;
                                if (($b + 10) > $orderLength) {
                                    # code...
                                    unset($orderPositions[$Index]);
                                } else {
                                    $test = substr($orderDetails, $b, 10);
                                    if (!preg_match('/[a-zA-Z":=<>]+$/', $test)) {
                                        # code...
                                        if (!strpos($test, ' ') || !strpos($test, '-')) {
                                            # code...
                                            $x = $b + 11;
                                            $y = $b;
                                            $linkStart = '<a href="tel:'.$test.'">';
                                            $linkEnd = '</a>';
                                            $orderDetails = substr_replace($orderDetails, $linkEnd, $x, 0);
                                            $orderDetails = substr_replace($orderDetails, $linkStart, $y, 0);
                                        }
                                    }
                                }
                                $Index++;
                            }
                        }
            
                    }
            
                    $orderPositions = array();
                    $orderLength = strlen($orderDetails);
                    
                }
            
            }
            return $orderDetails;    
        }
    }
    
?>