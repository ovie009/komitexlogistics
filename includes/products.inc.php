<?php
    include_once "class-autoloader.inc.php";

    if(isset($_POST['submitProduct'])){

        $obj = new Controller;

        if (empty($_POST['username']) || empty($_POST['productName']) || empty($_POST['productPrice'])) {
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];    
        }
        
        echo $username;
        echo '<br>';
        print_r($_FILES);
        echo '<br>';

        
        if ($_FILES['photo']['size'] == 0) {
            # code...
            $productPhoto = 'icons/others/bag1.png';
            $photoTmpName = 'none';
        } else {
            # code...
            $photo = $_FILES['photo'];
            $photoName = $photo['name'];
            $photoTmpName = $photo['tmp_name'];
            $photoSize = $photo['size'];
            $photoError = $photo['error'];
    
            $photoExt = explode('.', $photoName);
            $photoActualExt = strtolower(end($photoExt));
            $productNewName = strtolower(str_replace(' ', '.', $productName));
    
            $allowed = array('jpg', 'jpeg', 'png');
    
            if(in_array($photoActualExt, $allowed)){
                if($photoError === 0){
                    if($photoSize <= 3000000){
                        
                        $photoNewName = $username.'.'.$productNewName.'.'.$photoActualExt;
    
                        $photoDestination = '../uploads/'.$photoNewName;
    
                        $productPhoto = 'uploads/'.$photoNewName;
    
                    }else{
                        header("location: ../waybill.php?largePhoto");
                    }
                }else{
                    header("location: ../waybill.php?uploadError");
                }
            }else{
                header("location: ../waybill.php?unsupportedExtension");
            }
        }
        echo $productPhoto;

        if (isset($_POST['price1']) && !isset($_POST['price2']) && !isset($_POST['price3'])) {
            # code...
            $price1 = $_POST['price1'];
            $quantity1 = $_POST['quantity1'];
            if (empty($price1) || empty($quantity1)) {
                # code...
                header("location: ../waybill.php?emptyFields");
            }else{
                $obj->submitOneDiscountProduct($username, $productName, $productPrice, $price1, $quantity1, $productPhoto, $photoTmpName);
            }
            
        }elseif (isset($_POST['price1']) && isset($_POST['price2']) && !isset($_POST['price3'])) {
            # code...
            $price1 = $_POST['price1'];
            $quantity1 = $_POST['quantity1'];
            
            $price2 = $_POST['price2'];
            $quantity2 = $_POST['quantity2'];
            
            if (empty($price1) || empty($quantity1) || empty($price2) || empty($quantity2)) {
                # code...
                header("location: ../waybill.php?emptyFields");
            }else{
                $obj->submitTwoDiscountProduct($username, $productName, $productPrice, $price1, $quantity1, $price2, $quantity2, $productPhoto, $photoTmpName);
            }

        }elseif (isset($_POST['price1']) && isset($_POST['price2']) && isset($_POST['price3'])) {
            # code...

            $price1 = $_POST['price1'];
            $quantity1 = $_POST['quantity1'];
            
            $price2 = $_POST['price2'];
            $quantity2 = $_POST['quantity2'];
            
            $price3 = $_POST['price3'];
            $quantity3 = $_POST['quantity3'];
        
            if (empty($price1) || empty($quantity1) || empty($price2) || empty($quantity2) || empty($price3) || empty($quantity3)) {
                # code...
                header("location: ../waybill.php?emptyFields");
            }else{
                $obj->submitThreeDiscountProduct($username, $productName, $productPrice, $price1, $quantity1, $price2, $quantity2, $price3, $quantity3, $productPhoto, $photoTmpName);
            }

        } else if(!isset($_POST['price1']) && !isset($_POST['price2']) && !isset($_POST['price3'])){

            $obj->submitNoDiscountProduct($username, $productName, $productPrice, $productPhoto, $photoTmpName);

        }
        
    } elseif (isset($_POST['submitDiscount1'])) {
        # code...
        if ( empty($_POST['username']) || empty($_POST['productName']) || empty($_POST['price1']) || empty($_POST['quantity1']) ) {
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $price1 = $_POST['price1'];
            $quantity1 = $_POST['quantity1'];
            $action = 'submitDiscount1';

            $obj = new Controller();

            $obj->submitDiscount($username, $productName, $price1, $quantity1, $action);
            echo $action;
            echo '<br>';
        }
        print_r($_POST);

    } elseif (isset($_POST['submitDiscount2'])) {
        # code...
        if (empty($_POST['username']) || empty($_POST['productName']) || empty($_POST['price2']) || empty($_POST['quantity2'])) {
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $price2 = $_POST['price2'];
            $quantity2 = $_POST['quantity2'];
            $action = 'submitDiscount2';

            $obj = new Controller();

            $obj->submitDiscount($username, $productName, $price2, $quantity2, $action);
        }

    } elseif (isset($_POST['submitDiscount3'])) {
        # code...
        if (empty($_POST['username']) || empty($_POST['productName']) || empty($_POST['price3']) || empty($_POST['quantity3'])) {
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $price3 = $_POST['price3'];
            $quantity3 = $_POST['quantity3'];
            $action = 'submitDiscount3';

            $obj = new Controller();

            $obj->submitDiscount($username, $productName, $price3, $quantity3, $action);
        }

    } elseif (isset($_POST['deleteDiscount1'])) {
        # code...
        if (empty($_POST['username']) || empty($_POST['productName'])){
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $action = 'deleteDiscount1';

            $obj = new Controller();

            $obj->deleteDiscount($username, $productName, $action);
        }

    } elseif (isset($_POST['deleteDiscount2'])) {
        # code...
        if (empty($_POST['username']) || empty($_POST['productName'])){
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $action = 'deleteDiscount2';

            $obj = new Controller();

            $obj->deleteDiscount($username, $productName, $action);
        }

    } elseif (isset($_POST['deleteDiscount3'])) {
        # code...
        if (empty($_POST['username']) || empty($_POST['productName'])){
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $action = 'deleteDiscount3';
            
            $obj = new Controller();
            
            $obj->deleteDiscount($username, $productName, $action);
        }
        
    } elseif (isset($_POST['changeProductPicture'])) {
        # code...
        $obj = new Controller;
        
        if (empty($_POST['username']) || empty($_POST['productName']) || $_FILES['productPhoto']['size'] == 0 ) {
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $photo = $_FILES['productPhoto'];
            $photoName = $photo['name'];
            $photoTmpName = $photo['tmp_name'];
            $photoSize = $photo['size'];
            $photoError = $photo['error'];
    
            $photoExt = explode('.', $photoName);
            $photoActualExt = strtolower(end($photoExt));
            $productNewName = strtolower(str_replace(' ', '.', $productName));
    
            $allowed = array('jpg', 'jpeg', 'png');
    
            if(in_array($photoActualExt, $allowed)){
                if($photoError === 0){
                    if($photoSize <= 3000000){
                        
                        $photoNewName = $username.'.'.$productNewName.'.'.$photoActualExt;
    
                        $photoDestination = '../uploads/'.$photoNewName;
    
                        $productPhoto = 'uploads/'.$photoNewName;

                        $obj->changeProductPicture($username, $productName, $productPhoto, $photoTmpName);
                        
                    }else{
                        header("location: ../waybill.php?largePhoto");
                    }
                }else{
                    header("location: ../waybill.php?uploadError");
                }
            }else{
                header("location: ../waybill.php?unsupportedExtension");
            }
        }
        
    } elseif (isset($_POST['editPrice'])) {
        # code...
        if (empty($_POST['username']) || empty($_POST['productName']) || empty($_POST['productPrice'])) {
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $price = $_POST['productPrice'];
            
            $obj = new Controller;

            $obj->editPrice($username, $productName, $price);

        }

    } else if (isset($_POST['submitGroup'])) {
        # code...
        print_r($_POST);

        
        $obj = new Controller;

        if (empty($_POST['username']) || empty($_POST['productName']) || empty($_POST['productPrice'])) {
            # code...
            header("location: ../waybill.php?emptyFields");
        } else {
            # code...
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];    
        }
        
        if ($_POST['firstProduct'] != 'None' && $_POST['secondProduct'] == 'None' && $_POST['thirdProduct'] == 'None' ) {
            # code...
            header("location: ../waybill.php?smallGroup");

        } else if ($_POST['firstProduct'] == 'None' && $_POST['secondProduct'] != 'None' && $_POST['thirdProduct'] == 'None' ) {
            # code...
            header("location: ../waybill.php?smallGroup");

        } else if ($_POST['firstProduct'] == 'None' && $_POST['secondProduct'] == 'None' && $_POST['thirdProduct'] != 'None' ) {
            # code...
            header("location: ../waybill.php?smallGroup");

        } else {
            # code...
            $firstProduct = $_POST['firstProduct'];
            $secondProduct = $_POST['secondProduct'];
            $thirdProduct = $_POST['thirdProduct'];

            if (isset($_POST['firstQuantity'])) {
                # code...
                $firstQuantity = $_POST['firstQuantity'];
            } else{
                # code...
                $firstQuantity = 'None';
            }

            if (isset($_POST['secondQuantity'])) {
                # code...
                $secondQuantity = $_POST['secondQuantity'];
            } else{
                # code...
                $secondQuantity = 'None';
            }

            if (isset($_POST['thirdQuantity'])) {
                # code...
                $thirdQuantity = $_POST['thirdQuantity'];
            } else{
                # code...
                $thirdQuantity = 'None';
            }
        }        
        
        echo '<br>';

        print_r($_FILES);

        
        if ($_FILES['photo']['size'] == 0) {
            # code...
            $productPhoto = 'icons/others/bag2.png';
            $photoTmpName = 'none';
        } else {
            # code...
            $photo = $_FILES['photo'];
            $photoName = $photo['name'];
            $photoTmpName = $photo['tmp_name'];
            $photoSize = $photo['size'];
            $photoError = $photo['error'];
    
            $photoExt = explode('.', $photoName);
            $photoActualExt = strtolower(end($photoExt));
            $productNewName = strtolower(str_replace(' ', '.', $productName));
    
            $allowed = array('jpg', 'jpeg', 'png');
    
            if(in_array($photoActualExt, $allowed)){
                if($photoError === 0){
                    if($photoSize <= 3000000){
                        
                        $photoNewName = $username.'.'.$productNewName.'.'.$photoActualExt;
    
                        $photoDestination = '../uploads/'.$photoNewName;
    
                        $productPhoto = 'uploads/'.$photoNewName;
    
                    }else{
                        header("location: ../waybill.php?largePhoto");
                    }
                }else{
                    header("location: ../waybill.php?uploadError");
                }
            }else{
                header("location: ../waybill.php?unsupportedExtension");
            }
        }
        echo $productPhoto;
        $obj->submitGroup($username, $productName, $productPrice, $productPhoto, $photoTmpName, $firstProduct, $firstQuantity, $secondProduct, $secondQuantity, $thirdProduct, $thirdQuantity);

    }else{
        header("location: ../waybill.php");
    }

?>