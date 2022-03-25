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

    if ($accountType == 'Merchant' || $accountType == 'Affiliate') {
        # code...
        $viewObj = new View();
        if ($accountType == 'Merchant') {
            # code...
            $merchant = $username;
        } else if($accountType == 'Affiliate'){
            # code...
            $contactResult = $viewObj->viewContacts($username, $accountType);
            if (!empty($contactResult)) {
                $merchant = $contactResult[0]['Merchant'];
            }
        }

        if (isset($_POST['Tab'])){
            # code...
            if ($_POST['Tab'] == 'products') {
                # code...
                ?>
                <div class="products-div">
                    <form class="add-new-form">
                        <button type="button" id="add-new-product" onclick="productDropdown()">Add New Product</button>
                        <button type="button" id="add-new-group" onclick="groupDropdown()">Group Products</button>
                    </form>
                    <?php 
                        if (!empty($contactResult) || $accountType == 'Merchant') {
                            ?>
                            <div>
                                <div class="display-wrapper">
                                    <div class="display-image" style="background-image: url(icons/others/bag1.png);">
        
                                    </div>
                                    <button type="button"  onclick="selectPhoto()">Select Picture</button>
                                    <!--<input type="image" src="icons/others/pencil.png" alt="edit icon" onclick="selectPhoto()">-->
                                </div>
                                <form class="upload-product" enctype="multipart/form-data" onsubmit="return confirm('Product Name cannot be edited afterwards, do you want to proceed?')"  method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
        
                                    <input type="hidden" name="username" value="<?php echo $merchant;?>">
                                    <input style="display:none" type="file" name="photo" id="selectPhoto" onchange="readURL(this)" accept="image/*">
                                    <div class="main-product-wrapper">
                                        <textarea name="productName" id="product-name" cols="60" rows="3" placeholder="Product Name" class="product-input" required></textarea>
                                        <input type="number" name="productPrice" id="product-price" placeholder="Price" class="product-input" min="0"  required>
                                    </div>
                                    <div class="button-wrapper">
                                        <button  id="more-prices" type="button">Add Discount</button>
                                        <button type="submit" id="submit-product" name="submitProduct">Submit</button>
                                    </div>
                                
                                </form>
                            </div>
                            <?php
                                $productsResult = $viewObj->viewProductsNoLimit($merchant);
                            ?>
                            <div id="group-dropdown">
                                <div class="group-display-wrapper">
                                    <div class="display-image" style="background-image: url(icons/others/bag2.png);">
        
                                    </div>
                                    <button type="button"  onclick="selectGroupPhoto()">Select Picture</button>
                                    <!--<input type="image" src="icons/others/pencil.png" alt="edit icon" onclick="selectPhoto()">-->
                                </div>
                                <form class="group-upload-product" enctype="multipart/form-data" onsubmit="return confirm('Product Name cannot be edited afterwards, do you want to proceed?')"  method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
        
                                    <input type="hidden" name="username" value="<?php echo $merchant;?>">
                                    <input style="display:none" type="file" name="photo" id="selectGroupPhoto" onchange="readURL(this)" accept="image/*">
                                    
                                    <div class="group-added-input">
                                        <label for="first-Product">
                                            First Product:
                                        </label>
                                        <select name="firstProduct" id="first-product" onchange="groupProduct('first')">
                                            <option value="None">None</option>
                                            <?php
                                                foreach ($productsResult as $result) {?>

                                                    <option value="<?php echo $result['ProductName'];?>"> <?php echo $result['ProductName'];?> </option>
                                                    
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                        <span class="N-A" id="N_A_1">N/A</span>
                                        <!-- <input type="number" name="firstQuantity" id="quantity" placeholder="Qty" min="1" required> -->
                                    </div>
                                    <div class="group-added-input">
                                        <label for="second-Product">
                                            Second Product:
                                        </label>
                                        <select name="secondProduct" id="second-product" onchange="groupProduct('second')">
                                            <option value="None">None</option>
                                            <?php
                                                foreach ($productsResult as $result) {?>

                                                    <option value="<?php echo $result['ProductName'];?>"> <?php echo $result['ProductName'];?> </option>
                                                    
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                        <span class="N-A" id="N_A_2">N/A</span>
                                        <!-- <input type="number" name="secondQuantity" id="first-quantity" placeholder="Qty" min="1" required> -->
                                    </div>
                                    <div class="group-added-input">
                                        <label for="third-Product">
                                            Third Product:
                                        </label>
                                        <select name="thirdProduct" id="third-product" onchange="groupProduct('third')">
                                        <option value="None">None</option>
                                            <?php
                                                foreach ($productsResult as $result) {?>

                                                    <option value="<?php echo $result['ProductName'];?>"> <?php echo $result['ProductName'];?> </option>
                                                    
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                        <span class="N-A" id="N_A_3">N/A</span>
                                        <!-- <input type="number" name="thirdQuantity" id="quantity" placeholder="Qty" min="1" required> -->
                                    </div>
                                    <div class="main-product-wrapper">
                                        <textarea name="productName" id="product-name" cols="60" rows="3" placeholder="Group Name" class="product-input" required></textarea>
                                        <input type="number" name="productPrice" id="product-price" placeholder="Price" class="product-input" min="0"  required>
                                        <!-- <button type="submit" id="submit-group" name="submitGroup">Submit</button> -->
                                    </div>
                                    <div class="button-wrapper">
                                        <button type="submit" id="submit-group" name="submitGroup">Submit</button>
                                    </div>
                                
                                </form>
                            </div>
                        
                            <?php
                                
                                $countResult = $viewObj->countProducts($merchant);
                                $products = $viewObj->viewProducts($merchant);
                                if (!empty($products)) {?>
                                    
                                    <div class="products-container">
                                        <?php
                                        $x = 1;
                                        foreach ($products as $product) {
                                            # code...
                                            $productName = $product['ProductName'];
                                            $price = $product['Price'];
                                            $price1 = $product['FirstDiscountPrice'];
                                            $quantity1 = $product['FirstDiscountQty'];
                                            $price2 = $product['SecondDiscountPrice'];
                                            $quantity2 = $product['SecondDiscountQty'];
                                            $price3 = $product['ThirdDiscountPrice'];
                                            $quantity3 = $product['ThirdDiscountQty'];
                                            $picture = $product['Picture'];
                                            $type = $product['Type'];
                                            // echo $type;
                                            ?>
        
                                            <div class="product-holder">
                                                <?php
                                                    if ($type == 'Product') {
                                                        # code...
                                                        ?><button type="button" id="send-waybill" onclick="sendWaybill('<?php echo $productName; ?>')">Send <br> Waybill</button><?php
                                                    }
                                                ?>
                                                <div class="product-main-details">
                                                    <div class="product-image" style="background-image: url(<?php echo $picture; ?>);" ondblclick="changePicture(<?php echo $x; ?>)" id="product-image-<?php echo $x; ?>">
        
                                                        <form class="product-image-overlay-<?php echo $x; ?>"  method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>" enctype="multipart/form-data">
                                                            <input type="hidden" name="username" value="<?php echo $merchant; ?>" required>
                                                            <input type="hidden" name="productName" value="<?php echo $productName; ?>" required>
                                                            <input style="display:none" type="file" name="productPhoto" id="selectPhoto-<?php echo $x; ?>" onchange="readUrl(this)" accept="image/*">
                                                            <button type="submit" name="changeProductPicture">Save</button>
                                                        </form>
        
                                                    </div>
                                                    <div class="product-details">
                                                        <p id="Product-Name-<?php echo $x; ?>" onclick="editPrice(<?php echo $x; ?>)" class="up-arrow-1"><?php echo $productName; ?></p>
                                                        <p id="show-price-<?php echo $x; ?>"><s>N</s><?php echo $price; ?></p>
                                                        <div id="edit-price-<?php echo $x; ?>">
                                                            <form  method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                <input type="hidden" name="username" value="<?php echo $merchant; ?>" required>
                                                                <input type="hidden" name="productName" value="<?php echo $productName; ?>" required>
                                                                <input type="number" name="productPrice" placeholder="price" value="<?php echo $price; ?>" required>
                                                                <button type="submit" name="editPrice">OK</button>
                                                            </form>
                                                        </div>
                                                        <?php
                                                            if ($type == 'Product') {
                                                                # code...
                                                                ?><button type="button" id="show-discount-<?php echo $x; ?>" onclick="showDiscount(<?php echo $x; ?>)" class="down-arrow">Show Discounts</button><?php
                                                            } else if ($type == 'Group') {
                                                                # code...
                                                                ?><button type="button" id="show-discount-<?php echo $x; ?>" onclick="showDiscount(<?php echo $x; ?>)" class="down-arrow">Show Products</button><?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                                    if ($type == 'Product') {
                                                        # code...?>                                                        
                                                        <div class="dropdown-product" id="dropdown-<?php echo $x; ?>"><?php
        
                                                            if (!empty($price1) && empty($price2) && empty($price3)) {
                                                                # code...?>
                                                                <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                    <input type="hidden" name="username" value="<?php echo $merchant; ?>" required>
                                                                    <input type="hidden" name="productName" value="<?php echo $productName; ?>" required>
                                                                    <label for="prc1">Price</label>
                                                                    <input type="number" name="price1" placeholder="Price" value="<?php echo $price1; ?>" class="prc" id="prc<?php echo $x; ?>-1" readonly required>
                                                                    <label for="qty1">Qty</label>
                                                                    <input type="number" name="quantity1" placeholder="Qty" value="<?php echo $quantity1; ?>" class="prc" id="qty<?php echo $x; ?>-1" min="2" readonly required>
                                                                    <button type="button" id="edit-discount" onclick="editDiscount(<?php echo $x; ?>, 1)" class="edit-<?php echo $x; ?>-1">Edit</button>
                                                                    <button type="submit" id="submit-discount-<?php echo $x; ?>-1" name="submitDiscount1">Submit</button>
                                                                    <button type="submit" id="delete-discount" name="deleteDiscount1">Delete</button>
                                                                </form>
                                                                <div id="hiding-second-discount-<?php echo $x; ?>">
                                                                    <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                        <input type="hidden" name="username" value="<?php echo $merchant; ?>" required>
                                                                        <input type="hidden" name="productName" value="<?php echo $productName; ?>" required>
                                                                        <label for="prc1">Price</label>
                                                                        <input type="number" name="price2" class="hide-prc" id="prc" required>
                                                                        <label for="qty1">Qty</label>
                                                                        <input type="number" name="quantity2" class="hide-prc" id="qty" min="3" required>
                                                                        <button type="submit" id="hidden-submit" name="submitDiscount2">Submit</button>
                                                                        <button type="button" id="delete-discount" name="cancelDiscount"  onclick="cancelSecondDiscount(<?php echo $x; ?>)">Cancel</button>
                                                                    </form>
                                                                </div>
                                                                <form class="discount-list" id="add-second-discount-<?php echo $x; ?>">
                                                                    <button type="button" id="addmore-discount" onclick="addSecondDiscount(<?php echo $x; ?>)">Add More Discounts</button>
                                                                </form>        
                                                                <?php
                                                            } elseif (!empty($price1) && !empty($price2) && empty($price3)) {
                                                                # code...?>
                                                                <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                    <input type="hidden" name="username" value="<?php echo $merchant; ?>">
                                                                    <input type="hidden" name="productName" value="<?php echo $productName; ?>"><label for="prc1">Price</label>
                                                                    <input type="number" name="price1" placeholder="Price" value="<?php echo $price1; ?>" class="prc" id="prc<?php echo $x; ?>-1" readonly>
                                                                    <label for="qty1">Qty</label>
                                                                    <input type="number" name="quantity1" placeholder="Qty" value="<?php echo $quantity1; ?>" class="prc" id="qty<?php echo $x; ?>-1" min="2" readonly>
                                                                    <button type="button" id="edit-discount" onclick="editDiscount(<?php echo $x; ?>, 1)" class="edit-<?php echo $x; ?>-1">Edit</button>
                                                                    <button type="submit" id="submit-discount-<?php echo $x; ?>-1" name="submitDiscount1">Submit</button>
                                                                </form>
                                                                <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                    <input type="hidden" name="username" value="<?php echo $merchant; ?>">
                                                                    <input type="hidden" name="productName" value="<?php echo $productName; ?>">                                                            <label for="prc1">Price</label>
                                                                    <input type="number" name="price2" placeholder="Price" value="<?php echo $price2; ?>" class="prc" id="prc<?php echo $x; ?>-2" readonly>
                                                                    <label for="qty1">Qty</label>
                                                                    <input type="number" name="quantity2" placeholder="Qty" value="<?php echo $quantity2; ?>" class="prc" id="qty<?php echo $x; ?>-2" min="3" readonly>
                                                                    <button type="button" id="edit-discount" onclick="editDiscount(<?php echo $x; ?>, 2)" class="edit-<?php echo $x; ?>-2">Edit</button>
                                                                    <button type="submit" id="submit-discount-<?php echo $x; ?>-2" name="submitDiscount2">Submit</button>
                                                                    <button type="submit" id="delete-discount" name="deleteDiscount2">Delete</button>
                                                                </form>
                                                                <div id="hiding-third-discount-<?php echo $x; ?>">
                                                                    <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                        <input type="hidden" name="username" value="<?php echo $merchant; ?>">
                                                                        <input type="hidden" name="productName" value="<?php echo $productName; ?>">
                                                                        <label for="prc1">Price</label>
                                                                        <input type="number" name="price3" class="hide-prc" id="prc">
                                                                        <label for="qty1">Qty</label>
                                                                        <input type="number" name="quantity3" class="hide-prc" id="qty" min="4">
                                                                        <button type="submit" id="hidden-submit" name="submitDiscount3">Submit</button>
                                                                        <button type="button" id="delete-discount" name="cancelDiscount"  onclick="cancelThirdDiscount(<?php echo $x; ?>)">Cancel</button>
                                                                    </form>
                                                                </div>
                                                                <form class="discount-list" id="add-third-discount-<?php echo $x; ?>">
                                                                    <button type="button" id="addmore-discount" onclick="addThirdDiscount(<?php echo $x; ?>)">Add More Discounts</button>
                                                                </form>        
                                                                <?php
                                                            } elseif (!empty($price1) && !empty($price2) && !empty($price3)) {
                                                                # code...?>
                                                                    <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                        <input type="hidden" name="username" value="<?php echo $merchant; ?>">
                                                                        <input type="hidden" name="productName" value="<?php echo $productName; ?>">
                                                                        <label for="prc1">Price</label>
                                                                        <input type="number" name="price1" placeholder="Price" value="<?php echo $price1; ?>" class="prc" id="prc<?php echo $x; ?>-1" readonly>
                                                                        <label for="qty1">Qty</label>
                                                                        <input type="number" name="quantity1" placeholder="Qty" value="<?php echo $quantity1; ?>" class="prc" id="qty<?php echo $x; ?>-1" min="2" readonly>
                                                                        <button type="button" id="edit-discount" onclick="editDiscount(<?php echo $x; ?>, 1)" class="edit-<?php echo $x; ?>-1">Edit</button>
                                                                        <button type="submit" id="submit-discount-<?php echo $x; ?>-1" name="submitDiscount1">Submit</button>
                                                                    </form>
                                                                    <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                        <input type="hidden" name="username" value="<?php echo $merchant; ?>">
                                                                        <input type="hidden" name="productName" value="<?php echo $productName; ?>">
                                                                        <label for="prc1">Price</label>
                                                                        <input type="number" name="price2" placeholder="Price" value="<?php echo $price2; ?>" class="prc" id="prc<?php echo $x; ?>-2" readonly>
                                                                        <label for="qty1">Qty</label>
                                                                        <input type="number" name="quantity2" placeholder="Qty" value="<?php echo $quantity2; ?>" class="prc" id="qty<?php echo $x; ?>-2" min="3" readonly>
                                                                        <button type="button" id="edit-discount" onclick="editDiscount(<?php echo $x; ?>, 2)" class="edit-<?php echo $x; ?>-2">Edit</button>
                                                                        <button type="submit" id="submit-discount-<?php echo $x; ?>-2" name="submitDiscount2">Submit</button>
                                                                    </form>      
                                                                    <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                        <input type="hidden" name="username" value="<?php echo $merchant; ?>">
                                                                        <input type="hidden" name="productName" value="<?php echo $productName; ?>">
                                                                        <label for="prc1">Price</label>
                                                                        <input type="number" name="price3" placeholder="Price" value="<?php echo $price3; ?>" class="prc" id="prc<?php echo $x; ?>-3" readonly>
                                                                        <label for="qty1">Qty</label>
                                                                        <input type="number" name="quantity3" placeholder="Qty" value="<?php echo $quantity3; ?>" class="prc" id="qty<?php echo $x; ?>-3" min="4" readonly>
                                                                        <button type="button" id="edit-discount" onclick="editDiscount(<?php echo $x; ?>, 3)" class="edit-<?php echo $x; ?>-3">Edit</button>
                                                                        <button type="submit" id="submit-discount-<?php echo $x; ?>-3" name="submitDiscount3">Submit</button>
                                                                        <button type="submit" id="delete-discount" name="deleteDiscount3">Delete</button>
                                                                    </form>      
                                                                <?php
                                                            } elseif (empty($price1) && empty($price2) && empty($price3)) {
                                                                # code...?>
                                                                <div id="hiding-first-discount-<?php echo $x; ?>">
            
                                                                    <form class="discount-list" method="POST" action="<?php echo htmlspecialchars('includes/products.inc.php');?>">
                                                                        <input type="hidden" name="username" value="<?php echo $merchant; ?>">
                                                                        <input type="hidden" name="productName" value="<?php echo $productName; ?>">
                                                                        <label for="prc1">Price</label>
                                                                        <input type="number" name="price1" class="hide-prc" id="prc" required>
                                                                        <label for="qty1">Qty</label>
                                                                        <input type="number" name="quantity1" class="hide-prc" id="qty" min="2" required>
                                                                        <button type="submit" id="hidden-submit" name="submitDiscount1">Submit</button>
                                                                        <button type="button" id="delete-discount" name="cancelDiscount"  onclick="cancelFirstDiscount(<?php echo $x; ?>)">Cancel</button>
                                                                    </form>
            
                                                                </div>
            
                                                                <form class="discount-list" id="add-first-discount-<?php echo $x; ?>">
                                                                    <button type="button" id="addmore-discount" onclick="addFirstDiscount(<?php echo $x; ?>)">Add Discount</button>
                                                                    <p class="no-discount-notice">N/A</p>
                                                                </form>        
                                                                <?php
                                                            }?>
        
                                                            <button type="button" id="hide-discount-<?php echo $x; ?>" onclick="hideDiscount(<?php echo $x; ?>)" class="up-arrow">Hide Discounts</button>
                                                        </div>
                                                        <?php
                                                    } else if ($type == 'Group') {
                                                        # code...
                                                        ?><div class="dropdown-product" id="dropdown-<?php echo $x; ?>"><?php
                                                            $groupsResult = $viewObj->viewSingleGroups($merchant, $productName);
                                                            if ($groupsResult[0]['FirstProduct'] != NULL) {
                                                                # code...
                                                                ?><form class="discount-list" id="add-first-discount-<?php echo $x; ?>">
                                                                    <p><?php 
                                                                    echo $groupsResult[0]['FirstQuantity'].' '.$groupsResult[0]['FirstProduct']; 
                                                                    ?></p>
                                                                </form><?php
                                                            }
                                                            if ($groupsResult[0]['SecondProduct'] != NULL) {
                                                                # code...
                                                                ?><form class="discount-list" id="add-first-discount-<?php echo $x; ?>">
                                                                    <p><?php 
                                                                    echo $groupsResult[0]['SecondQuantity'].' '.$groupsResult[0]['SecondProduct']; 
                                                                    ?></p>
                                                                </form><?php
                                                            }
                                                            if ($groupsResult[0]['ThirdProduct'] != NULL) {
                                                                # code...
                                                                ?><form class="discount-list" id="add-first-discount-<?php echo $x; ?>">
                                                                    <p><?php 
                                                                        echo $groupsResult[0]['ThirdQuantity'].' '.$groupsResult[0]['ThirdProduct']; 
                                                                    ?></p>
                                                                </form><?php
                                                            }
                                                            ?><button type="button" id="hide-discount-<?php echo $x; ?>" onclick="hideDiscount(<?php echo $x; ?>)" class="up-arrow">Hide Discounts</button>
                                                            <?php
                                                        ?></div><?php
                                                    }
                                                ?>
                                            </div>
                                            
                                            <?php
                                            $x++;
                                        }
                                    ?></div><?php

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
                                        <p class="default-expression">You've not uploaded any product, click on 'Add New Product' to upload new product</p>
                                    <?php
                                }
                            ?>
                            <?php
                        }
                    ?>
                </div>
                <?php
            } else if ($_POST['Tab'] == 'waybill') {
                # code...
                $controllerObj = new Controller();
                $controllerObj->setWaybillTime($username);
                unset($controllerObj);
                ?>
                <div class="waybill-div">
                    <form class="add-new-form">
                        <button type="button" class="send-waybill" onclick="waybill()">Send Waybill</button>
                    </form>
                    <?php

                        if (!empty($contactResult) || $accountType == 'Merchant') {
                            $contactResult = $viewObj->viewLogisticsContacts($merchant, 'Merchant');
                            $productsResult = $viewObj->viewProductsNoLimit($merchant);
                            $countResult = $viewObj->countWaybill($merchant);
                            $waybillResult = $viewObj->viewWaybill($merchant);
                            if (!empty($contactResult) && !empty($productsResult)) {
                                ?>
                                <div class="waybill-dropdown">
                                    <form class="send-waybill-form" method="POST" action="<?php echo htmlspecialchars('includes/waybill.inc.php');?>" onsubmit="return confirm('Only waybill quantity can be edited before pickup, do you want to proceed?')">
                                        <label for="waybill-details">Waybill details (optional):</label>
                                        <textarea name="waybillDetails" id="waybill-details" cols="26" rows="3" wrap="soft" required></textarea>
                                        <div>
                                            <input type="hidden" name="Merchant" value="<?php echo $merchant;?>">
                                            <input type="number" name="numberSent" id="waybill-qty" placeholder="Qty" autofocus required>
                                            <button type="submit" name="submitWaybill">Submit</button>
                                        </div>    
                                        <div>
                                            <label for="select-logistics">Logistics: </label>
                                            <select name="Logistics" id="select-logistics">
                                                <?php
                                                    foreach ($contactResult as $result) {?>

                                                        <option value="<?php echo $result['Logistics'];?>"><?php echo $result['Logistics'];?></option>
                                                        
                                                        <?php
                                                    }
                                                ?>
                                            </select>                  
                                        </div>
                                        <div>
                                            <label for="select-product">Product: </label>                  
                                            <select name="product" id="select-product">
                                                <?php
                                                    foreach ($productsResult as $result) {?>

                                                        <option value="<?php echo $result['ProductName'];?>"> <?php echo $result['ProductName'];?> </option>
                                                        
                                                        <?php
                                                    }
                                                ?>
                                            </select>                                    
                                        </div>
                                    </form>
                                </div>
                                <?php
                                if (!empty($waybillResult)) {
                                    # code...?>
                                    <div class="waybill-container">
                                        <?php
                                        $a = 1;
                                        foreach ($waybillResult as $result) {
                                            # code...
                                            $affiliate = $result['Affiliate'];
                                            $logistics = $result['Logistics'];
                                            $productName = $result['ProductName'];
                                            $numberSent = $result['NumberSent'];
                                            $status = $result['Status'];
                                            $waybillDetails = $result['waybillDetails'];
                                            $id = $result['id'];
                                            
                                            $sentDateTime = $result['DateTimeSent'];
                                            $receivedDateTime = $result['DateTimeReceived'];
                                            $newSentTime = date("h:i A", strtotime($sentDateTime));
                                            $newSentDate = date("F jS Y", strtotime($sentDateTime));

                                            $waybillDetails = $viewObj->linkPhoneNumbers($waybillDetails);
                                            
                                            if ($receivedDateTime != NULL) {
                                                # code...
                                                $newReceivedTime = date("h:i A", strtotime($receivedDateTime));
                                                $newReceivedDate = date("F jS Y", strtotime($receivedDateTime));

                                            }?>

                                            <div class="waybill-holder">
                                                <form class="waybill-sent-form"  method="POST" action="<?php echo htmlspecialchars('includes/waybill.inc.php');?>" onsubmit="return confirm('Do you want to proceed?')">
                                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                                    <input type="number" name="numberSent" id="waybill-sent-<?php echo $a; ?>" value="<?php echo $numberSent; ?>" readonly>
                                                    <label for="waybill-sent">
                                                        <?php echo $productName; ?> Sent to <?php echo $logistics; ?>
                                                    </label>
                                                    <?php
                                                        if ($waybillDetails != NULL && $affiliate != NULL) {
                                                            # code...?>
                                                            <span><?php echo nl2br($waybillDetails); ?><br>Uploaded by <?php echo $affiliate; ?></span>
                                                            <?php
                                                        } else if ($waybillDetails == NULL && $affiliate != NULL) {
                                                            # code...?>
                                                            <span><br>Uploaded by <?php echo $affiliate; ?></span>
                                                            <?php
                                                        } else if ($waybillDetails != NULL && $affiliate == NULL) {
                                                            # code...?>
                                                            <span><?php echo nl2br($waybillDetails); ?></span>
                                                            <?php
                                                        }
                                                    
                                                        if ($status == 'Not Approved') {
                                                            # code...?>
                                                            <button type="button" id="edit-waybill-<?php echo $a; ?>" onclick="submitEditWaybill(<?php echo $a; ?>)">Edit</button>
                                                            <button type="submit" id="submit-waybill-<?php echo $a; ?>" name="editWaybill">Submit</button>
                                                            <?php
                                                        }
                                                    ?>
                                                </form>
                                                <?php
                                                    if ($status == 'Not Approved') {
                                                        # code...?>
                                                        <p class="confirmation-notice">
                                                            Waybill hasn't been received yet
                                                        </p>
                                                        <?php
                                                    }
                                                ?>
                                                <div class="time-container">
                                                    <div>
                                                        <p>Sent <?php echo $newSentTime; ?></p>
                                                        <p><?php echo $newSentDate; ?></p>
                                                    </div>
                                                    <?php
                                                        if ($receivedDateTime != NULL) {
                                                            # code...?>
                                                            <div>
                                                                <p>Received <?php echo $newReceivedTime; ?></p>
                                                                <p><?php echo $newReceivedDate; ?></p>
                                                            </div>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            $a++;
                                        }?>
                                    </div>
                                    <?php
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

                            }else{
                                ?>
                                    <p class="default-expression">You can only sent waybill when you've uploaded a product and Added Logistics <br> Go to Account Info and click on 'Add Logistics'</p>
                                <?php
                            }
                        }
                    ?>
                    
                </div>
                <?php
            } else if ($_POST['Tab'] == 'stock') {
                # code...
                ?>
                <div class="stock-div">
                    <?php
                        
                        $viewObj = new View();
                        $_SESSION['searchArray'] = 20;

                        if (!empty($contactResult) || $accountType == 'Merchant') {
                            # code...
                            $stockResults = $viewObj->viewMerchantStock($merchant);
                            if (!empty($stockResults)) {
                                # code...
                                ?><div class="table-container">
                                    <table>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Logistics</th>
                                            <th>Product</th>
                                            <th>Total Sent</th>
                                            <th>Stock Left</th>
                                        </tr><?php
                
                                            $x = 1;
                                            $totalSent = 0;
                                            $totalLeft = 0;
                                            foreach ($stockResults as $stockResult) {
                                                # code...
                                                $productName = $stockResult['ProductName'];
                                                $logistics = $stockResult['Logistics'];
                                                $stockLeft = $stockResult['StockLeft'];
                                                $waybillSum = $viewObj->viewMerchantWaybillSum($merchant, $productName, $logistics);
                                                $sent = $waybillSum[0]['SUM(NumberSent)'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $x; ?></td>
                                                    <td><?php echo $logistics; ?></td>
                                                    <td><?php echo $productName; ?></td>
                                                    <td><?php echo $sent; ?></td>
                                                    <td><?php echo $stockLeft; ?></td>
                                                </tr>
                                                <?php
                                                $totalSent += $sent;
                                                $totalLeft += $stockLeft;
                                                $x++;
                                            }
                                        ?>
                                        <tr>
                                            <td class="empty-right"></td>
                                            <td class="empty-left"></td>
                                            <td>Total</td>
                                            <td><?php echo $totalSent; ?></td>
                                            <td><?php echo $totalLeft; ?></td>
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
                    
                    ?>
                </div>
                <?php
            }
        }

    }else if($accountType == 'Logistics' || $accountType == 'Agent') {
        # code...
        $viewObj = new View();

        if ($accountType == 'Logistics') {
            # code...
            $logistics = $username;
        } else if($accountType == 'Agent'){
            # code...
            $contactResult = $viewObj->viewContacts($username, $accountType);
            if (!empty($contactResult)) {
                $logistics = $contactResult[0]['Logistics'];
            }
        }

        if (isset($_POST['Tab'])) {
            # code...
            if ($_POST['Tab'] == 'products') {
                # code...
                ?>
                <div class="products-div">
                    <?php

                        if (!empty($contactResult) || $accountType == 'Logistics') {
                            // $products = $viewObj->viewApprovedWaybill($logistics);
                            $countResult = $viewObj->countLogisticsStock($logistics);
                            $products = $viewObj->viewLogisticsStock($logistics);
                            if (!empty($products)) {?>
                                
                                <div class="products-container">
                                    <?php
                                    $x = 1;
                                    foreach ($products as $product) {
                                        # code...
                                        $productName = $product['ProductName'];
                                        $merchant = $product['Merchant'];
                                        $singleProduct = $viewObj->viewSingleProduct($merchant, $productName);
                                        
                                        $productName = $singleProduct[0]['ProductName'];
                                        $price = $singleProduct[0]['Price'];
                                        $price1 = $singleProduct[0]['FirstDiscountPrice'];
                                        $quantity1 = $singleProduct[0]['FirstDiscountQty'];
                                        $price2 = $singleProduct[0]['SecondDiscountPrice'];
                                        $quantity2 = $singleProduct[0]['SecondDiscountQty'];
                                        $price3 = $singleProduct[0]['ThirdDiscountPrice'];
                                        $quantity3 = $singleProduct[0]['ThirdDiscountQty'];
                                        $picture = $singleProduct[0]['Picture'];
                                        ?>

                                        <div class="product-holder">
                                            <button type="button" id="send-waybill" onclick="sendWaybill('<?php echo $productName; ?>')">Dispatch</button>
                                            <div class="product-main-details">
                                                <div class="product-image" style="background-image: url(<?php echo $picture; ?>);"></div>
                                                <div class="product-details">
                                                    <p id="Product-Name-<?php echo $x; ?>"><?php echo $productName; ?> from <?php echo $merchant; ?></p>
                                                    <p id="show-price-<?php echo $x; ?>"><s>N</s><?php echo $price; ?></p>
                                                    
                                                    <button type="button" id="show-discount-<?php echo $x; ?>" onclick="showDiscount(<?php echo $x; ?>)" class="down-arrow">Show Discounts</button>
                                                </div>
                                            </div>
                                            <div class="dropdown-product" id="dropdown-<?php echo $x; ?>">
                                                <?php
                                                    if (!empty($price1) && empty($price2) && empty($price3)) {
                                                        # code...?>
                                                        <form class="discount-list">
                                                            <input type="hidden" name="username" value="<?php echo $username; ?>" required>
                                                            <input type="hidden" name="productName" value="<?php echo $productName; ?>" required>
                                                            <label for="prc1">Price</label>
                                                            <input type="number" name="price1" placeholder="Price" value="<?php echo $price1; ?>" class="prc" id="prc<?php echo $x; ?>-1" readonly required>
                                                            <label for="qty1">Qty</label>
                                                            <input type="number" name="quantity1" placeholder="Qty" value="<?php echo $quantity1; ?>" class="prc" id="qty<?php echo $x; ?>-1" min="2" readonly required>
                                                        </form>
                                                        <?php
                                                    } elseif (!empty($price1) && !empty($price2) && empty($price3)) {
                                                        # code...?>
                                                        <form class="discount-list">
                                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                            <input type="hidden" name="productName" value="<?php echo $productName; ?>"><label for="prc1">Price</label>
                                                            <input type="number" name="price1" placeholder="Price" value="<?php echo $price1; ?>" class="prc" id="prc<?php echo $x; ?>-1" readonly>
                                                            <label for="qty1">Qty</label>
                                                            <input type="number" name="quantity1" placeholder="Qty" value="<?php echo $quantity1; ?>" class="prc" id="qty<?php echo $x; ?>-1" min="2" readonly>
                                                        </form>
                                                        <form class="discount-list">
                                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                            <input type="hidden" name="productName" value="<?php echo $productName; ?>">                                                            <label for="prc1">Price</label>
                                                            <input type="number" name="price2" placeholder="Price" value="<?php echo $price2; ?>" class="prc" id="prc<?php echo $x; ?>-2" readonly>
                                                            <label for="qty1">Qty</label>
                                                            <input type="number" name="quantity2" placeholder="Qty" value="<?php echo $quantity2; ?>" class="prc" id="qty<?php echo $x; ?>-2" min="3" readonly>
                                                        </form>
                                                        <?php
                                                    } elseif (!empty($price1) && !empty($price2) && !empty($price3)) {
                                                        # code...?>
                                                            <form class="discount-list">
                                                                <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                                <input type="hidden" name="productName" value="<?php echo $productName; ?>">
                                                                <label for="prc1">Price</label>
                                                                <input type="number" name="price1" placeholder="Price" value="<?php echo $price1; ?>" class="prc" id="prc<?php echo $x; ?>-1" readonly>
                                                                <label for="qty1">Qty</label>
                                                                <input type="number" name="quantity1" placeholder="Qty" value="<?php echo $quantity1; ?>" class="prc" id="qty<?php echo $x; ?>-1" min="2" readonly>
                                                            </form>
                                                            <form class="discount-list">
                                                                <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                                <input type="hidden" name="productName" value="<?php echo $productName; ?>">
                                                                <label for="prc1">Price</label>
                                                                <input type="number" name="price2" placeholder="Price" value="<?php echo $price2; ?>" class="prc" id="prc<?php echo $x; ?>-2" readonly>
                                                                <label for="qty1">Qty</label>
                                                                <input type="number" name="quantity2" placeholder="Qty" value="<?php echo $quantity2; ?>" class="prc" id="qty<?php echo $x; ?>-2" min="3" readonly>
                                                            </form>      
                                                            <form class="discount-list">
                                                                <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                                <input type="hidden" name="productName" value="<?php echo $productName; ?>">
                                                                <label for="prc1">Price</label>
                                                                <input type="number" name="price3" placeholder="Price" value="<?php echo $price3; ?>" class="prc" id="prc<?php echo $x; ?>-3" readonly>
                                                                <label for="qty1">Qty</label>
                                                                <input type="number" name="quantity3" placeholder="Qty" value="<?php echo $quantity3; ?>" class="prc" id="qty<?php echo $x; ?>-3" min="4" readonly>
                                                            </form>      
                                                        <?php
                                                    } elseif (empty($price1) && empty($price2) && empty($price3)) {
                                                        # code...?>
                                                        <form class="discount-list" id="add-first-discount-<?php echo $x; ?>">
                                                            <p class="no-discount-notice">N/A</p>
                                                        </form>        
                                                        <?php
                                                    }
                                                ?>
                                                <button type="button" id="hide-discount-<?php echo $x; ?>" onclick="hideDiscount(<?php echo $x; ?>)" class="up-arrow">Hide Discounts</button>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                </div>
                                <?php
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
                            }else{
                                ?>
                                <p class="default-expression">No merchant has sent you any product</p>
                                <?php
                            }
                        }
                    ?>
                </div>
                <?php
            } else if ($_POST['Tab'] == 'waybill') {
                # code...
                $controllerObj = new Controller();
                $controllerObj->setWaybillTime($username);
                unset($controllerObj);
                ?>
                <div class="waybill-div">
                    <form class="add-new-form">
                        <button type="button" class="send-waybill" onclick="waybill('Dispatch')">Dispatch Item</button>
                    </form>
                    <?php

                        if (!empty($contactResult) || $accountType == 'Logistics') {
                            $contactResult = $viewObj->viewContacts($logistics, 'Logistics');
                            if ($accountType == 'Logistics') {
                                # code...
                                $agentResult = $viewObj->viewAgents($logistics, 'Logistics');
                            } else if ($accountType == 'Agent'){
                                # code...
                                $agentResult = $viewObj->viewAgentAgents($logistics, 'Logistics', $username);
                            }

                            $countResult = $viewObj->countLogisticsWaybill($logistics);
                            $waybillResult = $viewObj->viewLogisticsWaybill($logistics);
                            $approvedWaybillResult = $viewObj->viewLogisticsStock($logistics);
                            $merchantResult = $viewObj->viewMerchantContacts($logistics, 'Logistics');
                            if (!empty($contactResult)) {
                                ?>
                                <div class="waybill-dropdown">
                                    <form class="send-waybill-form" method="POST" action="<?php echo htmlspecialchars('includes/waybill.inc.php');?>" onsubmit="return confirm('Only waybill quantity can be edited before pickup, do you want to proceed?')">
                                        <label for="waybill-details">Waybill details (optional):</label>
                                        <textarea name="waybillDetails" id="waybill-details" cols="26" rows="3" wrap="soft" required></textarea>
                                        <div>
                                            <input type="hidden" name="Logistics" id="dispatch-logistics" value="<?php echo $logistics;?>">
                                            <input type="number" name="numberSent" id="waybill-qty" placeholder="Qty" required>
                                            <button type="submit" name="waybillLocation">Submit</button>
                                        </div>    
                                        <div>
                                            <label for="select-location">Location: </label>
                                            <?php
                                                $locationResult = $viewObj->viewLocation($logistics);
                                                if (!empty($locationResult)) {
                                                    # code...?>
                                                    <select name="location" id="select-location">
                                                        <?php
                                                            foreach ($locationResult as $result) {?>

                                                                <option value="<?php echo $result['location'];?>"><?php echo $result['location'];?></option>
                                                                
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>                                            
                                                    <?php
                                                }else{
                                                    # code...?>
                                                    <p class="default-notice">N/A</p>                            
                                                    <?php
                                                }
                                            ?>                  
                                        </div>
                                        <div>
                                            <label for="select-merchant">Merchant: </label>
                                            <?php
                                                if (!empty($merchantResult)) {
                                                    # code...?>
                                                    <select name="Merchant" id="select-merchant" onchange="dispatchProduct()">
                                                        <?php
                                                            # code...
                                                            foreach ($merchantResult as $result) {?>

                                                                <option value="<?php echo $result['Merchant'];?>"> <?php echo $result['Merchant'];?> </option>
                                                                
                                                                <?php
                                                                $merchant = $result['Merchant'];
                                                            }
                                                        ?>
                                                    </select>                                                    
                                                    <?php
                                                }else{
                                                    # code...?>
                                                    <p class="default-notice">N/A</p>                            
                                                    <?php
                                                }
                                            ?>                  
                                                                                
                                        </div>
                                        <div id="load-merchant-product">
                                                             
                                        </div>

                                    </form>
                                </div>
                                <?php
                                if (!empty($waybillResult)) {
                                    # code...?>
                                    <div class="waybill-container">
                                        <?php
                                        $a = 1;
                                        foreach ($waybillResult as $result) {
                                            # code...
                                            $affiliate = $result['Affiliate'];
                                            $merchant = $result['Merchant'];
                                            $productName = $result['ProductName'];
                                            $numberSent = $result['NumberSent'];
                                            $status = $result['Status'];
                                            $agent = $result['Agent'];
                                            $location = $result['Location'];
                                            $waybillDetails = $result['waybillDetails'];
                                            $id = $result['id'];
                                            $type = $result['Type'];
                                            
                                            $sentDateTime = $result['DateTimeSent'];
                                            $receivedDateTime = $result['DateTimeReceived'];
                                            $newSentTime = date("h:i A", strtotime($sentDateTime));
                                            $newSentDate = date("F jS Y", strtotime($sentDateTime));

                                            $waybillDetails = $viewObj->linkPhoneNumbers($waybillDetails);
                                            
                                            if ($receivedDateTime != NULL) {
                                                # code...
                                                $newReceivedTime = date("h:i A", strtotime($receivedDateTime));
                                                $newReceivedDate = date("F jS Y", strtotime($receivedDateTime));

                                            }
                                            
                                            if ($type == 'Waybill') {
                                                # code...?>
                                                <div class="waybill-holder">
                                                    <form class="waybill-sent-form">
                                                        <input type="number" name="numberSent" id="waybill-sent-<?php echo $a; ?>" value="<?php echo $numberSent; ?>" readonly>
                                                        <label for="waybill-sent">
                                                            <?php echo $productName; ?> Sent from <?php echo $merchant; ?>
                                                        </label>
                                                        <?php
                                                            if ($waybillDetails != NULL && $affiliate != NULL) {
                                                                # code...?>
                                                                <span><?php echo nl2br($waybillDetails); ?><br>Uploaded by <?php echo $affiliate; ?></span>
                                                                <?php
                                                            } else if ($waybillDetails == NULL && $affiliate != NULL) {
                                                                # code...?>
                                                                <span><br>Uploaded by <?php echo $affiliate; ?></span>
                                                                <?php
                                                            } else if ($waybillDetails != NULL && $affiliate == NULL) {
                                                                # code...?>
                                                                <span><?php echo nl2br($waybillDetails); ?></span>
                                                                <?php
                                                            }
                                                        ?>
                                                    </form>
                                                    <?php
                                                        if ($status == 'Not Approved' && $agent == NULL) {
                                                            # code...?>
                                                            <form class="approve-waybill-form"  method="POST" action="<?php echo htmlspecialchars('includes/waybill.inc.php');?>" onsubmit="return confirm('This action cannot be reversed, do you want to proceed?')">
                                                                <input type="hidden" name="Logistics" value="<?php echo $logistics;?>">
                                                                <input type="hidden" name="Merchant" value="<?php echo $merchant;?>">
                                                                <input type="hidden" name="numberSent" value="<?php echo $numberSent; ?>">
                                                                <input type="hidden" name="product" value="<?php echo $productName;?>">
                                                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                                                <button type="submit" name="approveWaybill">Picked Up</button>                                                                    
                                                            </form> 
                                                            <?php
                                                        }
                                                    ?>
                                                    <div class="time-container">
                                                        <div>
                                                            <p>Sent <?php echo $newSentTime; ?></p>
                                                            <p><?php echo $newSentDate; ?></p>
                                                        </div>
                                                        <?php
                                                            if ($receivedDateTime != NULL) {
                                                                # code...?>
                                                                <div>
                                                                    <p>Received <?php echo $newReceivedTime; ?></p>
                                                                    <p><?php echo $newReceivedDate; ?></p>
                                                                </div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }else{
                                                # code...?>
                                                <div class="waybill-holder">
                                                    <form class="waybill-sent-form" method="POST" action="<?php echo htmlspecialchars('includes/waybill.inc.php');?>">
                                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                                        <input type="number" name="numberSent" id="waybill-sent-<?php echo $a; ?>" value="<?php echo $numberSent; ?>" readonly>
                                                        <label for="waybill-sent">
                                                            <?php echo 'of '.$merchant.' '.$productName; ?> Dispatched to <?php echo $location; ?> 
                                                        </label>
                                                        <?php
                                                            if ($waybillDetails != NULL) {
                                                                # code...?>
                                                                <span><?php echo nl2br($waybillDetails); ?></span>
                                                                <?php
                                                            }

                                                            if (($accountType == 'Logistics' && $status == 'Not Approved') || ($status == 'Not Approved' && strtolower($agent) != strtolower($username))) {
                                                                # code...?>
                                                                <button type="button" id="edit-waybill-<?php echo $a; ?>" onclick="submitEditWaybill(<?php echo $a; ?>)">Edit</button>
                                                                <button type="submit" id="submit-waybill-<?php echo $a; ?>" name="editAgentWaybill">Submit</button>
                                                                <?php
                                                            }
                                                        ?>
                                                    </form>
                                                    <?php
                                                    if ($status == 'Not Approved' && strtolower($agent) != strtolower($username)) {
                                                            # code...?>
                                                            <p class="confirmation-notice">
                                                                Waybill hasn't been received yet
                                                            </p>
                                                            <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($status == 'Not Approved' && strtolower($agent) == strtolower($username)) {
                                                            # code...?>
                                                            <form class="approve-waybill-form"  method="POST" action="<?php echo htmlspecialchars('includes/waybill.inc.php');?>" onsubmit="return confirm('This action cannot be reversed, do you want to proceed?')">
                                                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                                                <button type="submit" name="approveAgentWaybill">Picked Up</button>                                                                    
                                                            </form> 
                                                            <?php
                                                        }
                                                    ?>
                                                    <div class="time-container">
                                                        <div>
                                                            <p>Sent <?php echo $newSentTime; ?></p>
                                                            <p><?php echo $newSentDate; ?></p>
                                                        </div>
                                                        <?php
                                                            if ($receivedDateTime != NULL) {
                                                                # code...?>
                                                                <div>
                                                                    <p>Received <?php echo $newReceivedTime; ?></p>
                                                                    <p><?php echo $newReceivedDate; ?></p>
                                                                </div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            $a++;
                                        }?>
                                    </div>
                                    <?php
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

                                }else{
                                    ?>
                                    <p class="default-expression">No waybill history found</p>
                                    <?php
                                }    

                            }
                        }
                    ?>
                    
                </div>
                <?php
            } else if ($_POST['Tab'] == 'stock') {
                # code...
                ?>
                <div class="stock-div">
                    <?php

                        $viewObj = new View();
                        $_SESSION['searchArray'] = 20;

                        if (!empty($contactResult) || $accountType == 'Logistics') {
                            # code...
                            $stockResults = $viewObj->viewLogisticsStock($logistics);
                            if (!empty($stockResults)) {
                                # code...
                                ?><div class="table-container">
                                    <table>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Merchant</th>
                                            <th>Product</th>
                                            <th>Total Sent</th>
                                            <th>Stock Left</th>
                                        </tr><?php
                
                                            $x = 1;
                                            $totalSent = 0;
                                            $totalLeft = 0;
                                            foreach ($stockResults as $stockResult) {
                                                # code...
                                                $productName = $stockResult['ProductName'];
                                                $merchant = $stockResult['Merchant'];
                                                $stockLeft = $stockResult['StockLeft'];
                                                $waybillSum = $viewObj->viewLogisticsWaybillSum($logistics, $productName, $merchant);
                                                $sent = $waybillSum[0]['SUM(NumberSent)'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $x; ?></td>
                                                    <td><?php echo $merchant; ?></td>
                                                    <td><?php echo $productName; ?></td>
                                                    <td><?php echo $sent; ?></td>
                                                    <td><?php echo $stockLeft; ?></td>
                                                </tr>
                                                <?php
                                                $totalSent += $sent;
                                                $totalLeft += $stockLeft;
                                                $x++;
                                            }
                                        ?>
                                        <tr>
                                            <td class="empty-right"></td>
                                            <td class="empty-left"></td>
                                            <td>Total</td>
                                            <td><?php echo $totalSent; ?></td>
                                            <td><?php echo $totalLeft; ?></td>
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
                    
                    ?>
                </div>
                <?php
            }
        }

    }


?>