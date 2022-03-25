refresh = true;
function slideDelivered(params, deliver) {
    if (deliver == false) {
        $('div[class^="delivery-wrapper-'+params+'"]').slideDown(500);
        $('div[class^="order-buttons-wrapper-'+params+'"]').slideUp(500);
        $('p[class^="report-'+params+'"]').slideUp(500);
        $('span[id^="feedback-time-'+params+'"]').slideUp(500);
        refresh = false;
        console.log(refresh);
    } else {
        $('div[class^="delivery-wrapper-'+params+'"]').slideUp(500);
        $('div[class^="order-buttons-wrapper-'+params+'"]').slideDown(500);
        $('p[class^="report-'+params+'"]').slideDown(500);
        $('span[id^="feedback-time-'+params+'"]').slideDown(500);
        refresh = true;
        console.log(refresh);
    }
}

function cancelOrder(params) {
    
    let x = confirm('Are  you sure you want to cancel this order?');
    if (x == true) {
        $.post("includes/mydeliveries.inc.php",{
        id: params,

        cancelOrder: x
        }, function(data, status){
            //where data is any text echoed in loaders/load.php
            //if no text is echoed
            if (status == 'success') {
                if (data == 'success') {
                    //alert(data);
                    setTimeout(function(){
                        
                        let A = 1;
                        console.log("refreshing");
                        $("#autorefresh").load("refresh/mydeliveries.ref.php", {
                        A: A});
                        
                    },30);
                    refresh = true;
                    console.log(refresh);
                } else{
                    alert(data);
                }
            }                             
            
        }); 
    }
}

function enterDelivered(id, x, type) {
    
    let paymentMethod = $('textarea[id^="delivery-textarea-'+x+'"]').val()

    $.post("includes/mydeliveries.inc.php",{
    id: id,
    type: type,
    paymentMethod: paymentMethod,

    enterDelivered: true
    }, function(data, status){
        //where data is any text echoed in loaders/load.php
        //if no text is echoed
        if (status == 'success') {
            if (data != 'success') {
                if (data == 'No Stock') {
                    alert("This product is out of stock");
                } else {
                    alert(data);
                }
            }else{
                //alert(data);
                setTimeout(function(){
                        
                    let A = 1;
                    console.log("refreshing");
                    $("#autorefresh").load("refresh/mydeliveries.ref.php", {
                    A: A});
                    
                },30);
                refresh = true;
                console.log(refresh);
            }
        }                             
        
    }); 

}
 
function dropOrder(id) {
    
    $.post("includes/mydeliveries.inc.php",{
    id: id,

    dropOrder: true
    }, function(data, status){
        //where data is any text echoed in loaders/load.php
        //if no text is echoed
        if (status == 'success') {
            if (data != 'success') {
                alert(data);
            }else{
                //alert(data);
                setTimeout(function(){
                        
                    let A = 1;
                    console.log("refreshing");
                    $("#autorefresh").load("refresh/mydeliveries.ref.php", {
                    A: A});
                    
                },30);
                refresh = true;
                console.log(refresh);
            }
        }                             
    }); 
}

function show(params) {
    $.post("includes/index-show.inc.php",{
    show: params
    }, function(data, status){
        //where data is any text echoed in loaders/load.php
        //if no text is echoed
        if (status == 'success') {
            if (data != 'success') {
                alert(data);
            } else {

                setTimeout(function(){
                        
                    let A = 1;
                    console.log("refreshing");
                    $("#autorefresh").load("refresh/mydeliveries.ref.php", {
                    A: A});
            
                },30);
                refresh = true;
            }
        }                             
    });
}

$(document).ready(function(){

    setInterval(function(){
        
        if (refresh == true) {
            
            let A = 1;
            console.log("refreshing");
            $("#autorefresh").load("refresh/mydeliveries.ref.php", {
            A: A});
        }

    },5000);

});

 