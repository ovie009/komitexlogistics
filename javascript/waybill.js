// console.log(document.cookie);
let TabCtrl;


let waybillLogistics = getCookie('waybill_logistics');
if (waybillLogistics != '') {
    console.log(waybillLogistics);
    $("#select-logistics option")
    .removeAttr("selected")
    .filter('[value="'+waybillLogistics+'"]')
    .attr('selected', true);
}

let waybillProduct = getCookie('waybill_product');
console.log(waybillProduct);
if (waybillProduct != '') {
    if (waybillProduct.indexOf('+') != -1) {
        waybillProduct = waybillProduct.replace(/\+/g, ' ');
        console.log(waybillProduct);
    }
    $("#select-product option")
    .removeAttr("selected")
    .filter('[value="'+waybillProduct+'"]')
    .attr('selected', true);
}

let waybillLocation = getCookie('waybill_location');
console.log(waybillLocation);
if (waybillLocation != '') {
    $("#select-location option")
    .removeAttr("selected")
    .filter('[value="'+waybillLocation+'"]')
    .attr('selected', true);
}

let waybillMerchant = getCookie('waybill_merchant');
console.log(waybillMerchant);
if (waybillMerchant != '') {
    $("#select-merchant option")
    .removeAttr("selected")
    .filter('[value="'+waybillMerchant+'"]')
    .attr('selected', true);

}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

let refresh = true;
let waybillTabRefresh = false;
let dropdownGroup = false;
function groupDropdown() {
    
    if (dropdownGroup == false ) {
        

        // // $("#group-dropdown").slideDown(500);
        $(".group-display-wrapper, .group-upload-product").slideDown(500);
        $(".default-expression").attr("style", "display: none;");
        dropdownGroup = true;
        refresh = false;
        
        if (dropdownProduct == true) {
            $(".display-wrapper ,.upload-product").slideUp(500);
            dropdownProduct = false;
        }
        
    } else {
        
        // $("#group-dropdown").slideUp(500);
        $(".group-display-wrapper, .group-upload-product").slideDown(500);
        $(".default-expression").attr("style", "display: flex;");
        dropdownGroup = false;
        refresh = true;
        
    }
    
    // console.log('product '+dropdownProduct);
    // console.log('group '+dropdownGroup);
    // console.log('refresh '+refresh);
    // console.log('');
}

let dropdownProduct = false;
function productDropdown() {
    
    if (dropdownProduct == false ) {
        
        $(".display-wrapper ,.upload-product").slideDown(500);
        $(".default-expression").attr("style", "display: none;");
        dropdownProduct = true;
        refresh = false;
        
        if (dropdownGroup == true) {
            $(".group-display-wrapper ,.group-upload-product").slideUp(500);
            dropdownGroup = false;
        }
    } else {
        
        $(".display-wrapper ,.upload-product").slideUp(500);
        $(".default-expression").attr("style", "display: flex;");
        dropdownProduct = false;
        refresh = true;
        
    }
    
    // console.log('product '+dropdownProduct);
    // console.log('group '+dropdownGroup);
    // console.log('refresh '+refresh);
    // console.log('');
}

$(document).ready(function () {

    $(".send-waybill").click(function () {
    });
    
});

function groupProduct(params) {
    let firstProduct = $("#first-product").val()
    let secondProduct = $("#second-product").val()
    let thirdProduct = $("#third-product").val()

    if (params == 'first') {
        if (firstProduct != 'None') {
            
            if ($("#first-quantity").val() == undefined) {
                $("#first-product").after('<input type="number" name="firstQuantity" id="first-quantity" placeholder="Qty" min="1" required>');
            }
            $("#N_A_1").attr("style", "display: none;");
            
            if (secondProduct == 'None' && thirdProduct == 'None') {
                $("#second-product").load("refresh/groupproducts.php",{
                    product01: firstProduct,
                    product02: 'none'}
                );

                $("#third-product").load("refresh/groupproducts.php",{
                    product01: firstProduct,
                    product02: 'none'}
                );

            } else if (secondProduct == 'None' && thirdProduct != 'None') {
                $("#second-product").load("refresh/groupproducts.php",{
                    product01: firstProduct,
                    product02: thirdProduct }
                );

                $("#third-product").load("refresh/groupproducts.php",{
                    product01: firstProduct,
                    product02: 'none'},
                    function () {
                        $("#third-product option")
                        .removeAttr("selected")
                        .filter('[value="'+thirdProduct+'"]')
                        .attr('selected', true);
                    }
                );
                
            } else if (secondProduct != 'None' && thirdProduct == 'None') {
                $("#second-product").load("refresh/groupproducts.php",{
                    product01: firstProduct,
                    product02: 'none'},
                    function () {
                        $("#second-product option")
                        .removeAttr("selected")
                        .filter('[value="'+secondProduct+'"]')
                        .attr('selected', true);
                    }
                );

                $("#third-product").load("refresh/groupproducts.php",{
                    product01: firstProduct,
                    product02: secondProduct}
                );
            } else {

                $("#second-product").load("refresh/groupproducts.php",{
                    product01: firstProduct,
                    product02: thirdProduct},
                    function () {
                        $("#second-product option")
                        .removeAttr("selected")
                        .filter('[value="'+secondProduct+'"]')
                        .attr('selected', true);
                    }
                );

                $("#third-product").load("refresh/groupproducts.php",{
                    product01: firstProduct,
                    product02: secondProduct},
                    function () {
                        $("#third-product option")
                        .removeAttr("selected")
                        .filter('[value="'+thirdProduct+'"]')
                        .attr('selected', true);
                    }
                );
                
            }

        } else{
            $("#first-quantity").remove();
            $("#N_A_1").attr("style", "display: unset;")

        }
        
    } else if (params == 'second') {
        if (secondProduct != 'None') {

            if ($("#second-quantity").val() == undefined) {
                $("#second-product").after('<input type="number" name="secondQuantity" id="second-quantity" placeholder="Qty" min="1" required>');
            }
            $("#N_A_2").attr("style", "display: none;");

            if (firstProduct == 'None' && thirdProduct == 'None') {
                $("#first-product").load("refresh/groupproducts.php",{
                    product01: secondProduct,
                    product02: 'none'}
                );

                $("#third-product").load("refresh/groupproducts.php",{
                    product01: secondProduct,
                    product02: 'none'}
                );

            } else if (firstProduct == 'None' && thirdProduct != 'None') {
                $("#first-product").load("refresh/groupproducts.php",{
                    product01: secondProduct,
                    product02: thirdProduct}
                );

                $("#third-product").load("refresh/groupproducts.php",{
                    product01: secondProduct,
                    product02: 'none'},
                    function () {
                        $("#third-product option")
                        .removeAttr("selected")
                        .filter('[value="'+thirdProduct+'"]')
                        .attr('selected', true);
                    }
                );

            } else if (firstProduct != 'None' && thirdProduct == 'None') {
                
                $("#first-product").load("refresh/groupproducts.php",{
                    product01: secondProduct,
                    product02: 'none'},
                    function () {
                        $("#first-product option")
                        .removeAttr("selected")
                        .filter('[value="'+firstProduct+'"]')
                        .attr('selected', true);
                    }
                );
                
                $("#third-product").load("refresh/groupproducts.php",{
                    product01: secondProduct,
                    product02: firstProduct}
                );
            } else {

                $("#first-product").load("refresh/groupproducts.php",{
                    product01: secondProduct,
                    product02: thirdProduct},
                    function () {
                        $("#first-product option")
                        .removeAttr("selected")
                        .filter('[value="'+firstProduct+'"]')
                        .attr('selected', true);
                    }
                );

                $("#third-product").load("refresh/groupproducts.php",{
                    product01: secondProduct,
                    product02: firstProduct},
                    function () {
                        $("#third-product option")
                        .removeAttr("selected")
                        .filter('[value="'+thirdProduct+'"]')
                        .attr('selected', true);
                    }
                );
            }
            
        } else{
            $("#second-quantity").remove();
            $("#N_A_2").attr("style", "display: unset;")

        }
        
    } else {
        if (thirdProduct != 'None') {
            
            if ($("#third-quantity").val() == undefined) {
                $("#third-product").after('<input type="number" name="thirdQuantity" id="third-quantity" placeholder="Qty" min="1" required>');
            }
            $("#N_A_3").attr("style", "display: none;");

            if (firstProduct == 'None' && secondProduct == 'None') {
                $("#first-product").load("refresh/groupproducts.php",{
                    product01: thirdProduct,
                    product02: 'none'}
                );

                $("#second-product").load("refresh/groupproducts.php",{
                    product01: thirdProduct,
                    product02: 'none'}
                );

            } else if (firstProduct == 'None' && secondProduct != 'None') {
                $("#first-product").load("refresh/groupproducts.php",{
                    product01: thirdProduct,
                    product02: thirdProduct}
                );

                $("#second-product").load("refresh/groupproducts.php",{
                    product01: thirdProduct,
                    product02: 'none'},
                    function () {
                        $("#second-product option")
                        .removeAttr("selected")
                        .filter('[value="'+secondProduct+'"]')
                        .attr('selected', true);
                    }
                );

            } else if (firstProduct != 'None' && secondProduct == 'None') {
                
                $("#first-product").load("refresh/groupproducts.php",{
                    product01: thirdProduct,
                    product02: 'none'},
                    function () {
                        $("#first-product option")
                        .removeAttr("selected")
                        .filter('[value="'+firstProduct+'"]')
                        .attr('selected', true);
                    }
                );
                
                $("#second-product").load("refresh/groupproducts.php",{
                    product01: thirdProduct,
                    product02: firstProduct}
                );
            } else {

                $("#first-product").load("refresh/groupproducts.php",{
                    product01: thirdProduct,
                    product02: secondProduct},
                    function () {
                        $("#first-product option")
                        .removeAttr("selected")
                        .filter('[value="'+firstProduct+'"]')
                        .attr('selected', true);
                    }
                );

                $("#second-product").load("refresh/groupproducts.php",{
                    product01: thirdProduct,
                    product02: firstProduct},
                    function () {
                        $("#second-product option")
                        .removeAttr("selected")
                        .filter('[value="'+secondProduct+'"]')
                        .attr('selected', true);
                    }
                );
            }

        } else{
            $("#third-quantity").remove();
            $("#N_A_3").attr("style", "display: unset;")

        }
        
    }
}

let slideWaybill = false;
function waybill(data) {
    if (slideWaybill == false) {
        $(".waybill-dropdown").slideDown(500);
        slideWaybill = true;
        refresh = false;
        // console.log('refresh '+refresh);
        // console.log('slidewaybill '+slideWaybill);

        if (data == 'Dispatch') {            
            let logistics = $("#dispatch-logistics").val();
            let merchant = $("#select-merchant").val();
            $("#load-merchant-product").load("refresh/dispatchproduct.php",{
                Logistics: logistics,
                Merchant: merchant},
    
                function () {
                    waybillProduct = getCookie('waybill_product');
                    console.log(waybillProduct);
                    if (waybillProduct != '') {
                        if (waybillProduct.indexOf('+') != -1) {
                            waybillProduct = waybillProduct.replace(/\+/g, ' ');
                            console.log(waybillProduct);
                        }
                        $("#select-product option")
                        .removeAttr("selected")
                        .filter('[value="'+waybillProduct+'"]')
                        .attr('selected', true);
                    }
                }
            );
        }
        
    } else{
        $(".waybill-dropdown").slideUp(500);
        slideWaybill = false;
        refresh = true;
        // console.log('refresh '+refresh);
        // console.log('slidewaybill '+slideWaybill);
    }
}

function dispatchProduct() {
    let logistics = $("#dispatch-logistics").val();
    let merchant = $("#select-merchant").val();
    $("#load-merchant-product").load("refresh/dispatchproduct.php",{
        Logistics: logistics,
        Merchant: merchant}
    );
}

function sendWaybill(product) {

    let presentUrl = window.location.href;
    let getQuery = presentUrl.indexOf("?");
    let destinationUrl;
    
    if (getQuery != -1) {
        let getLink = presentUrl.split("?");
        console.log(getLink[0]);
        console.log(getLink[1]);
        destinationUrl = getLink[0]+'?dropdownWaybill='+product+'&Tab=waybill';
    }else{
        console.log(presentUrl);
        destinationUrl = presentUrl+'?dropdownWaybill='+product+'&Tab=waybill';
    }

    window.location.href = destinationUrl;
    
}

/*function waybillDropdown(product) {
    
    $(".waybill-dropdown").attr("style", "display: block;");
    $("#select-product option")
    .removeAttr("selected")
    .filter('[value="'+product+'"]')
    .attr('selected', true);
    refresh = false;
    
    /*$('html, body').animate({
        scrollTop: $(".tab-container").offset().top
    }, 500);
}*/

function addFirstDiscount(num) {
    $("#hiding-first-discount-"+num+"").slideDown(500);
    $("#add-first-discount-"+num+"").slideUp(500);
}

function cancelFirstDiscount(num) {
    $("#hiding-first-discount-"+num+"").slideUp(500);
    $("#add-first-discount-"+num+"").slideDown(500);
}

function addSecondDiscount(num) {
    $("#hiding-second-discount-"+num+"").slideDown(500);
    $("#add-second-discount-"+num+"").slideUp(500);
}

function cancelSecondDiscount(num) {
    $("#hiding-second-discount-"+num+"").slideUp(500);
    $("#add-second-discount-"+num+"").slideDown(500);
}

function addThirdDiscount(num) {
    $("#hiding-third-discount-"+num+"").slideDown(500);
    $("#add-third-discount-"+num+"").slideUp(500);
}

function cancelThirdDiscount(num) {
    $("#hiding-third-discount-"+num+"").slideUp(500);
    $("#add-third-discount-"+num+"").slideDown(500);
}

function showDiscount(params) {
    $("#dropdown-"+params+"").slideDown(500);
    $("#show-discount-"+params+"").attr("style", "visibility: hidden;");
    refresh = false;
}

function  hideDiscount(params) {
    $("#dropdown-"+params+"").slideUp(500);
    $("#show-discount-"+params+"").attr("style", "visibility: visible;");
    $('div[id^="hiding-"]').slideUp(500);

    resetEditDiscount(params);        
    refresh = true;
}

function editDiscount(num1, num2) {
    
    resetEditDiscount(num1);
    cancelFirstDiscount(num1);
    cancelSecondDiscount(num1);
    cancelThirdDiscount(num1);        

    $("#prc"+num1+"-"+num2+", #qty"+num1+"-"+num2+"").attr("style", "background-color: white; border: 1px solid lightgray");
    $("#prc"+num1+"-"+num2+", #qty"+num1+"-"+num2+"").removeAttr("readonly");
    $(".edit-"+num1+"-"+num2+"").attr("style", "display: none");
    $("#submit-discount-"+num1+"-"+num2+"").attr("style", "display: unset");
}

function resetEditDiscount(num) {

    $('input[id^="prc'+num+'-"], input[id^="qty'+num+'-"]').attr("style", "background-color: whitesmoke; border: none;");
    $('input[id^="prc'+num+'-"], input[id^="qty'+num+'-"]').attr("readonly", true);
    $('button[class^="edit-'+num+'-"]').attr("style", "display: unset");
    $('button[id^="submit-discount-'+num+'-"]').attr("style", "display: none");
}

//code to display selected image before upload
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.display-image')
            .attr('style', 'background-image: url('+e.target.result+');');
            /*.width(150)
            .attr('src', e.target.result)
            .height(150)
            .border-radius(10);*/
        };

        reader.readAsDataURL(input.files[0]);

    }
}

let number;
function changePicture(params) {
    $("#selectPhoto-"+params+"").click();
    number = params;
    refresh = false;
}    

function readUrl(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#product-image-'+number+'')
            .attr('style', 'background-image: url('+e.target.result+');');
        };

        reader.readAsDataURL(input.files[0]);

    }
    $('.product-image-overlay-'+number+'').attr('style', 'visibility: visible;');
}

let count = 1
$(document).ready(function () {
    $("#more-prices").click(function () {
        
        //before adding another ticket, make the previous one's '.close-ticket' button hidden
        //only addmore tickets if tptal ticket is less than 7
        if(count < 4){ 
            let min = count + 1;

            $(".button-wrapper").before("<div class='added-input' id='added-input-"+count+"'></div>");
            
            $("#added-input-"+count+"").append('<input type="number" name="quantity'+count+'" id="quantity" placeholder="Qty" min="'+min+'" required>');
            
            $("#added-input-"+count+"").append('<input type="number" name="price'+count+'" id="price" placeholder="Price" required>');
            
            $("#added-input-"+count+"").append('<button type="button" class="close-added-input" id="close-'+count+'" onclick="closeInput('+count+')">X</button>');

            //$(".button-wrapper").slideDown(500);

            let oldButton = count - 1;
            
            $("#close-"+oldButton+"").attr("style", "display: none;");
            
            count++;
            console.log(count);
            
        }else{//if count is 3 and above
            $(".tab-container").before('<span class="error-notification">Limit Reached!</span>');

            setTimeout(function() {
                $(".error-notification").remove();
            }, 2000);
        }
    });

});

function closeInput(num){
    //alert(num);
    console.log("close running");
    let targetDiv = document.querySelector("#added-input-"+num+"");
    targetDiv.remove();
    num--;
    count--;

    //after removing ticket, make the previous one remove button visible
    let remove = document.querySelector("#close-"+num+"");
    remove.setAttribute("style", "display: unset;");
    console.log(count);
}

function selectPhoto() {
    document.querySelector("#selectPhoto").click();
}

function selectGroupPhoto() {
    document.querySelector("#selectGroupPhoto").click();
}

let editCtrl = false;
function editPrice(num) {

    let x = 1
    while (x < 10) {
        hideDiscount(x);
        $('#edit-price-'+x+'').slideUp(500);
        $('#show-price-'+x+'').slideDown(500);
        x++;
    }

    if (editCtrl == false) {

        $('#edit-price-'+num+'').slideDown(500);
        $('#show-price-'+num+'').slideUp(500);
        refresh = false;
        editCtrl = true;

    } else {

        $('#edit-price-'+num+'').slideUp(500);
        $('#show-price-'+num+'').slideDown(500);
        refresh = true;
        editCtrl = false;
    }
    
    transformArrow(num);
}

function submitEditWaybill(num) {
    resetEditWaybill();
    $('input[id^="waybill-sent-'+num+'"]').attr('style', 'border: 1px solid lightgray;').removeAttr('readonly');
    $('button[id^="submit-waybill-'+num+'"]').slideDown(500);
    $('button[id^="edit-waybill-'+num+'"]').slideUp(500);
    refresh = false;
}

function resetEditWaybill() {
    $('input[id^="waybill-sent-"]').attr('style', 'background-color: white;').attr('readonly', true);
    $('button[id^="submit-waybill-"]').slideUp(500);
    $('button[id^="edit-waybill-"]').slideDown(500);
}

let angle = true;
function transformArrow(num) {
    if (angle == true) {
        console.log("transforming");
        $("#Product-Name-"+num+"").removeClass("up-arrow-1");
        $("#Product-Name-"+num+"").addClass("down-arrow-1");
        angle = false;
    } else {
        console.log("not transforming");
        $("#Product-Name-"+num+"").removeClass("down-arrow-1");
        $("#Product-Name-"+num+"").addClass("up-arrow-1");
        angle = true;
    }
}

function checkUrl() {
    let url = window.location.href;
    
    let emptyFields = url.indexOf("emptyFields");
    let uploadError = url.indexOf("uploadError");
    let unsupportedExtension = url.indexOf("unsupportedExtension");
    let productExist = url.indexOf("productExist");
    let groupExist = url.indexOf("groupExist");
    let smallGroup = url.indexOf("smallGroup");
    let moveFileError = url.indexOf("moveFileError");
    let dbError = url.indexOf("dbError");
    let discountAdded = url.indexOf("discountAdded");
    let discountNull = url.indexOf("discountNull");
    let pictureEdited = url.indexOf("pictureEdited");
    let priceEdited = url.indexOf("priceEdited");
    let largePhoto = url.indexOf("largePhoto");
    let productSuccess = url.indexOf("productSuccess");
    let dropdownWaybill = url.indexOf("dropdownWaybill");
    let Tab = url.indexOf("Tab");


    if (dropdownWaybill != -1) {

        let splitLink = url.split("&");
        console.log(splitLink[0]);
        console.log(splitLink[1]);
        let splitProduct = splitLink[0].split("=");
        console.log(splitProduct[0]);
        console.log(splitProduct[1]);
        
        let space = splitProduct[1].indexOf("%20");
        let product;

        if(space != -1){
            product = splitProduct[1].replace("%20", " ");
        } else{
            product = splitProduct[1];
        }
        console.log(product);

        waybill();
        $("#select-product option")
        .removeAttr("selected")
        .filter('[value="'+product+'"]')
        .attr('selected', true);
    }

    if (Tab != -1) {

        let submitTab = url.split("=");
        TabCtrl = submitTab[submitTab.length - 1];
        
        $(".products-div").attr("style", "display: none;");
        $(".waybill-div").attr("style", "display: none;");
        $(".stock-div").attr("style", "display: none;");
        $("#products-tab").attr("style", "z-index: 1; border-bottom: 1px solid lightgray; background-color: rgb(230, 230, 230);");
        $("#waybill-tab").attr("style", "z-index: 2; border-bottom: 1px solid lightgray; background-color: rgb(230, 230, 230);");
        $("#stock-tab").attr("style", "z-index: 1; border-bottom: 1px solid lightgray; background-color: rgb(230, 230, 230);");
        $("."+TabCtrl+"-div").attr("style", "display: flex;");
        $("#"+TabCtrl+"-tab").attr("style", "z-index: 3; border-bottom: none; background-color: white;")
        
        resetEditWaybill();
        
        let x = 1
        while (x < 10) {
            hideDiscount(x);
            x++;
        }

        if (dropdownWaybill != -1){
            refresh = false;
        }
       
        if (TabCtrl == 'stock') {
            $("#autorefresh").load("refresh/waybill.ref.php", {
                Tab: TabCtrl
            });
            refresh = false;

        } else if (TabCtrl == 'waybill') {
            
            waybillTabRefresh = true;
        } 

    }else{
        TabCtrl = 'products';
    }


    if (priceEdited != -1) {
        $(".tab-container").before('<span class="success-notification">Price Changed Successfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 3000);
    }
    if (pictureEdited != -1) {
        $(".tab-container").before('<span class="success-notification">Picture Changed Successfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 3000);
    }
    if (discountNull != -1) {
        $(".tab-container").before('<span class="success-notification">Discount deleted Successfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 3000);
    }
    if (discountAdded != -1) {
        $(".tab-container").before('<span class="success-notification">Discount Updated Successfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 3000);
    }
    if (dbError != -1) {
        $(".tab-container").before('<span class="error-notification">Error updating information in database!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (moveFileError != -1) {
        $(".tab-container").before('<span class="error-notification">Product submitted, but error uploading picture!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (moveFileError != -1) {
        $(".tab-container").before('<span class="error-notification">Product submitted, but error encountered uploading picture!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 4000);
    }
    if (productExist != -1) {
        $(".tab-container").before('<span class="error-notification">You\'ve already uploaded this product</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (groupExist != -1) {
        $(".tab-container").before('<span class="error-notification">Group with the same name already exist try a different name</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (smallGroup != -1) {
        $(".tab-container").before('<span class="error-notification">Group must contain atleast one product</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (unsupportedExtension != -1) {
        $(".tab-container").before('<span class="error-notification">Picture Extension not supported! Only \'jpg\', \'jpeg\' and \'png\' are allowed</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 4000);
    }
    if (uploadError != -1) {
        $(".tab-container").before('<span class="error-notification">Error uploading image!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (emptyFields != -1) {
        $(".tab-container").before('<span class="error-notification">Empty Fields!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (largePhoto != -1) {
        $(".tab-container").before('<span class="error-notification">Image too large, maximum 3MB!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (productSuccess != -1) {
        $(".tab-container").before('<span class="success-notification">Product submitted Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 3000);
    }
    
    
    
    let waybillSent = url.indexOf("waybillSent");
    let waybillEdited = url.indexOf("waybillEdited");
    let waybillEmptyFields = url.indexOf("waybillEmptyFields");
    let waybillAgentApproved = url.indexOf("waybillAgentApproved");
    if (waybillEdited != -1) {
        $(".tab-container").before('<span class="success-notification">Waybill Edited Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 3000);
    }
    if (waybillSent != -1) {
        $(".tab-container").before('<span class="success-notification">Waybill sent Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 3000);
    }
    if (waybillEmptyFields != -1) {
        $(".tab-container").before('<span class="error-notification">Empty Fields!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 3000);
    }
    if (waybillAgentApproved != -1) {
        $(".tab-container").before('<span class="success-notification">Action Successfull!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 3000);
    }
}

function limit(params) {
    $.post("includes/index-limit.inc.php",{
    limit: params
    }, function(data, status){
        //where data is any text echoed in loaders/load.php
        //if no text is echoed
        if (status == 'success') {
            if (data != 'success') {
                alert(data);
            } else {

                let searchKey = $('#search-keyword').val();
                let sort = $('#sort').val();
                let show = $('#show').val();

                setTimeout(function(){
                        
                    $("#autorefresh").load("refresh/waybill.ref.php", {
                        Tab: TabCtrl
                    });
                    
                },30);
                refresh = false;
                searching = true;
            }
        }                             
    });
}


$(document).ready(function(){

    setInterval(function(){
        
        if (refresh == true) {
            
            let A = 1;
            console.log("refreshing");
            $("#autorefresh").load("refresh/waybill.ref.php", {
                Tab: TabCtrl},

                function () {

                    waybillLogistics = getCookie('waybill_logistics');
                    if (waybillLogistics != '') {
                        // console.log(waybillLogistics);
                        $("#select-logistics option")
                        .removeAttr("selected")
                        .filter('[value="'+waybillLogistics+'"]')
                        .attr('selected', true);
                    }

                    waybillProduct = getCookie('waybill_product');
                    if (waybillProduct != '') {
                        // console.log(waybillProduct);
                        if (waybillProduct.indexOf('+') != -1) {
                            waybillProduct = waybillProduct.replace(/\+/g, ' ');
                            // console.log(waybillProduct);
                        }
                        $("#select-product option")
                        .removeAttr("selected")
                        .filter('[value="'+waybillProduct+'"]')
                        .attr('selected', true);
                    }

                    waybillLocation = getCookie('waybill_location');
                    if (waybillLocation != '') {
                        // console.log(waybillLocation);
                        $("#select-location option")
                        .removeAttr("selected")
                        .filter('[value="'+waybillLocation+'"]')
                        .attr('selected', true);
                    }

                    waybillMerchant = getCookie('waybill_merchant');
                    if (waybillMerchant != '') {
                        // console.log(waybillMerchant);
                        $("#select-merchant option")
                        .removeAttr("selected")
                        .filter('[value="'+waybillMerchant+'"]')
                        .attr('selected', true);

                    }
   
                }
            );
        }

        if (waybillTabRefresh == true) {
            
            $("#waybill-tab").load("refresh/waybilltab.ref.php", {
                Tab: TabCtrl
            });
        }

    },3000);

});