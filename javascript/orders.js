console.log(document.cookie);
let refresh = true;
let logistics = $("#select-logistics").val();
let logisticsLocation = $("#select-location").val();
let merchant = $("#merchant").val();
let quantity = $("#order-quantity").val();
let orderProduct = getCookie('order_product');
let orderLogistics = getCookie('order_logistics');

if (orderLogistics != '') {
    // console.log(orderLogistics);
    $("#select-logistics option")
    .removeAttr("selected")
    .filter('[value="'+orderLogistics+'"]')
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

function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
}


let dropdownOrder = false;
function orderDropdown() {
    
    if (dropdownOrder == false ) {
            
        dropdownOrder = true;
        refresh = false;
        $(".drop-send-order").slideDown(500);
        $(".default-expression").attr("style", "display: none;");
        
    } else {
        
        dropdownOrder = false;
        refresh = true;
        $(".drop-send-order").slideUp(500);
        $(".default-expression").attr("style", "display: flex;");
    
    }
    
    // console.log('Order '+dropdownOrder);
    // console.log('refresh '+refresh);
}


function checkUrl() {
    let url = window.location.href;
    
    let emptyFields = url.indexOf("emptyFields");
    let orderSuccess = url.indexOf("orderSuccess");
    let orderDeleted = url.indexOf("orderDeleted");

    if (emptyFields != -1) {
        $(".orders-div").before('<span class="error-notification">Empty Fields!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }

    if (orderDeleted != -1) {
        $(".orders-div").before('<span class="success-notification">Order deleted Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
    }
    
    if (orderSuccess != -1) {
        $(".orders-div").before('<span class="success-notification">Order Uploaded Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
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

                setTimeout(function(){
                        
                    let A = 1;
                    // console.log("refreshing");
                    $("#autorefresh").load("refresh/orders.ref.php", {
                        A: A
                    });
                    
                },30);
                refresh = false;
            }
        }                             
    });
}


$(document).ready(function(){
    logistics = $("#select-logistics").val();
    $("#select-product-wrapper").load("refresh/showproducts.php", {
    Logistics: logistics},

        function (responseTXT, statusTXT, xhr) {
            orderProduct = getCookie('order_product');
            console.log(orderProduct);
            if (orderProduct != '') {
                if (orderProduct.indexOf('+') != -1) {
                    orderProduct = orderProduct.replace(/\+/g, ' ');
                    // replaceAll(orderProduct, '+', ' ');
                    // console.log(orderProduct);
                }
                console.log(orderProduct);
                $("#select-product option")
                .removeAttr("selected")
                .filter('[value="'+orderProduct+'"]')
                .attr('selected', true);
            }

            merchant = $("#merchant").val();
            productName = $("#select-product").val();
            quantity = $("#order-quantity").val();
            // console.log(merchant);
            // console.log(productName);
            if (productName != undefined) {
                $("#load-product-cost").load("refresh/showproductsprice.php", {
                    Merchant: merchant,
                    Quantity: quantity,
                    ProductName: productName},
                    
                    function () {
                        let productType = $("#product-type").val();
                        // console.log(productType);
                        
                        if (productType == 'Product') {
                            $("#order-quantity").removeAttr("readonly");
                            $("#order-quantity").attr("style", "border: 1px solid lightgray; color: black;");
                        } else if (productType == 'Group') {
                            $("#order-quantity").attr("readonly", true);
                            $("#order-quantity").attr("style", "border: none; color: gray;");
                        }
                    }
                );

                $("#stock-notice-wrapper").load("refresh/showproductstock.php", {
                    Merchant: merchant,
                    Logistics: logistics,
                    ProductName: productName
                });
            }
        }
    );
    
    $("#select-location-wrapper").load("refresh/showlocations.php", {
    Logistics: logistics},

        function (responseTXT, statusTXT, xhr) {
            
            let orderLocation = getCookie('order_location');
            // console.log(orderLocation);
            if (orderLocation != '') {
                $("#select-location option")
                .removeAttr("selected")
                .filter('[value="'+orderLocation+'"]')
                .attr('selected', true);
            }

            logisticsLocation = $("#select-location").val();
            if (logisticsLocation != undefined) {
                
                // console.log(logistics);
                // console.log(logisticsLocation);
                $("#load-location-cost").load("refresh/showlocationsprice.php", {
                    Logistics: logistics,
                    Location: logisticsLocation
                });
            }
                
        }
    
    );

    $("#select-logistics").change(function () {
        logistics = $("#select-logistics").val();
        $("#select-product-wrapper").load("refresh/showproducts.php", {
            Logistics: logistics},

            function (responseTXT, statusTXT, xhr) {
                orderProduct = getCookie('order_product');
                // console.log(orderProduct);
                if (orderProduct != '') {
                    if (orderProduct.indexOf('+') != -1) {
                        orderProduct = orderProduct.replace(/\+/g, ' ');
                        // replaceAll(orderProduct, '+', ' ');
                        // console.log(orderProduct);
                    }
                    $("#select-product option")
                    .removeAttr("selected")
                    .filter('[value="'+orderProduct+'"]')
                    .attr('selected', true);
                }

                merchant = $("#merchant").val();
                quantity = $("#order-quantity").val();
                productName = $("#select-product").val();
                if (productName != undefined) {
                    // console.log(merchant);
                    // console.log(productName);
                    $("#load-product-cost").load("refresh/showproductsprice.php", {
                        Merchant: merchant,
                        Quantity: quantity,
                        ProductName: productName},

                        function () {
                            let productType = $("#product-type").val();
                            console.log(productType);
                            
                            if (productType == 'Product') {
                                $("#order-quantity").removeAttr("readonly");
                                $("#order-quantity").attr("style", "border: 1px solid lightgray; color: black;");
                            } else if (productType == 'Group') {
                                $("#order-quantity").attr("readonly", true);
                                $("#order-quantity").attr("style", "border: none; color: gray;");
                            }
                        }
                    );

                    $("#stock-notice-wrapper").load("refresh/showproductstock.php", {
                        Merchant: merchant,
                        Logistics: logistics,
                        ProductName: productName
                    });
                }                    
            }
        );

        $("#select-location-wrapper").load("refresh/showlocations.php", {
        Logistics: logistics},

            function (responseTXT, statusTXT, xhr) {

                logisticsLocation = $("#select-location").val();
                if (logisticsLocation != undefined) {
                    
                    // console.log(logistics);
                    // console.log(logisticsLocation);
                    $("#load-location-cost").load("refresh/showlocationsprice.php", {
                        Logistics: logistics,
                        Location: logisticsLocation
                    });
                }
                    
            }            
        );
    });
        
    logistics = $("#select-logistics").val();
    logisticsLocation = $("#select-location").val();
    // console.log(logistics);
    // console.log(logisticsLocation);
    if (logisticsLocation != undefined) {
        $("#load-location-cost").load("refresh/showlocationsprice.php", {
            Logistics: logistics,
            Location: logisticsLocation
        });
    }
        
    merchant = $("#merchant").val();
    quantity = $("#order-quantity").val();
    productName = $("#select-product").val();
    // console.log(merchant);
    // console.log(productName);
    if (productName != undefined) {
        $("#load-product-cost").load("refresh/showproductsprice.php", {
            Merchant: merchant,
            Quantity: quantity,
            ProductName: productName},

            function () {
                let productType = $("#product-type").val();
                // console.log(productType);
                
                if (productType == 'Product') {
                    $("#order-quantity").removeAttr("readonly");
                    $("#order-quantity").attr("style", "border: 1px solid lightgray; color: black;");
                } else if (productType == 'Group') {
                    $("#order-quantity").attr("readonly", true);
                    $("#order-quantity").attr("style", "border: none; color: gray;");
                }
            }

        );

        $("#stock-notice-wrapper").load("refresh/showproductstock.php", {
            Merchant: merchant,
            Logistics: logistics,
            ProductName: productName
        });
    }
        
    setInterval(function(){
        
        if (refresh == true) {
            
            let A = 1;
            console.log("refreshing");
            $("#autorefresh").load("refresh/orders.ref.php", {
            A: A});
        }

    },1000);
    
});



function loadCost() {
    // console.log('test3');
    logistics = $("#select-logistics").val();
    logisticsLocation = $("#select-location").val();
    // console.log(logistics);
    // console.log(logisticsLocation);
    $("#load-location-cost").load("refresh/showlocationsprice.php", {
        Logistics: logistics,
        Location: logisticsLocation
    });
}

function loadPrice() {
    // console.log('test3');
    merchant = $("#merchant").val();
    quantity = $("#order-quantity").val();
    productName = $("#select-product").val();
    // console.log(merchant);
    // console.log(productName);
    if (productName != undefined) {
        $("#load-product-cost").load("refresh/showproductsprice.php", {
            Merchant: merchant,
            Quantity: quantity,
            ProductName: productName},
            
            function () {
                let productType = $("#product-type").val();
                // console.log(productType);
                
                if (productType == 'Product') {
                    $("#order-quantity").removeAttr("readonly");
                    $("#order-quantity").attr("style", "border: 1px solid lightgray; color: black;");
                } else if (productType == 'Group') {
                    $("#order-quantity").attr("readonly", true);
                    $("#order-quantity").attr("style", "border: none; color: gray;");
                }
            }
        );

        $("#stock-notice-wrapper").load("refresh/showproductstock.php", {
            Merchant: merchant,
            Logistics: logistics,
            ProductName: productName
        });
    }

}

let disableEdit = true;
function editPrice() {
    if (disableEdit == true) {
        // let priceInput = $("#product-cost");
        $("#product-cost").removeAttr("readonly");
        $("#product-cost").attr("style", "padding-left: 5px; border: 1px solid lightgray; color: black;");
        disableEdit = false;
    } else {
        // let priceInput = $("#product-cost");
        $("#product-cost").attr("readonly", true);
        $("#product-cost").attr("style", "padding-left: 0; border: none; color: gray;");
        disableEdit = true;
    }
}