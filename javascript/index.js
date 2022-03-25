console.log(document.cookie);
refresh = true;
searching = false;

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
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

let sortSearch = getCookie('index_searchSort');
if (sortSearch != '') {
    console.log(sortSearch);
    $("#sort option")
    .removeAttr("selected")
    .filter('[value="'+sortSearch+'"]')
    .attr('selected', true);
}

let showSearch = getCookie('index_searchShow');
if (showSearch != '') {
    console.log(showSearch);
    $("#show option")
    .removeAttr("selected")
    .filter('[value="'+showSearch+'"]')
    .attr('selected', true);
}

function toggleSearch(search){
    if (search == false) {
        $('#main-header').slideUp(500);
        $('#search-header').slideDown(500);
        $('.search-container').attr('style', 'display: none');
        refresh = false;
    } else {
        $('#main-header').slideDown(500);
        $('#search-header').slideUp(500);
        $('.search-container').attr('style', 'display: flex');
        setTimeout(function(){
                            
            let A = 1;
            console.log("refreshing");
            $("#autorefresh").load("refresh/index.ref.php", {
            A: A});
    
        },30);
        refresh = true;
    }
}

function search() {
    
    let searchKey = $('#search-keyword').val();
    let sort = $('#sort').val();
    let show = $('#show').val();
    
    setCookie('index_searchSort', sort, 10000);
    setCookie('index_searchShow', show, 10000);
    
    console.log("searching");
    console.log(document.cookie);
    
    if (searchKey == '') {
        let A = 1;
        console.log("refreshing");
        $("#autorefresh").load("refresh/index.ref.php", {
            A: A});
            searching = false;
        } else {
            $("#autorefresh").load("refresh/searchresult.php", {
                sort: sort,
                show: show,
                searchKey: searchKey
            });
        refresh = false;
        searching = true;
    }   
}

// $("#search-keyword").change(function () {

//     let searchKey = $('#search-keyword').val();
//     console.log("searching");

//     if (searchKey == '') {
//         let A = 1;
//         console.log("refreshing");
//         $("#autorefresh").load("refresh/index.ref.php", {
//         A: A});
//     } 

// });

function slideFeedback(params, feedback) {
    if (feedback == false) {
        $('div[class^="feedback-wrapper-'+params+'"]').slideDown(500);
        $('div[class^="order-buttons-wrapper-'+params+'"]').slideUp(500);
        $('p[class^="report-'+params+'"]').slideUp(500);
        $('span[id^="feedback-time-'+params+'"]').slideUp(500);
        refresh = false;
        console.log(refresh);
    } else {
        $('div[class^="feedback-wrapper-'+params+'"]').slideUp(500);
        $('div[class^="order-buttons-wrapper-'+params+'"]').slideDown(500);
        $('p[class^="report-'+params+'"]').slideDown(500);
        $('span[id^="feedback-time-'+params+'"]').slideDown(500);
        if (searching != true) {
            refresh = true;
            console.log(refresh);
        }
    }
}

function slideReschedule(params, reschedule) {
    if (reschedule == false) {
        $('div[class^="reschedule-wrapper-'+params+'"]').slideDown(500);
        $('div[class^="order-buttons-wrapper-'+params+'"]').slideUp(500);
        $('p[class^="report-'+params+'"]').slideUp(500);
        refresh = false;
        console.log(refresh);
    } else {
        $('div[class^="reschedule-wrapper-'+params+'"]').slideUp(500);
        $('div[class^="order-buttons-wrapper-'+params+'"]').slideDown(500);
        $('p[class^="report-'+params+'"]').slideDown(500);
        if (searching != true) {
            refresh = true;
            console.log(refresh);
        } 
    }
}

function cancelOrder(params) {
    
    let x = confirm('Are  you sure you want to cancel this order?');
    if (x == true) {
        $.post("includes/index.inc.php",{
        id: params,

        cancelOrder: x
        }, function(data, status){
            //where data is any text echoed in loaders/load.php
            //if no text is echoed
            if (status == 'success') {
                if (data != 'success') {
                    alert(data);
                } else {
                    
                    if (searching != true) {
                        setTimeout(function(){
                                
                            let A = 1;
                            console.log("refreshing");
                            $("#autorefresh").load("refresh/index.ref.php", {
                            A: A});
                    
                        },30);
                        refresh = true;
                        console.log(refresh);
                    } else {
                        let searchKey = $('#search-keyword').val();
                        let sort = $('#sort').val();
                        let show = $('#show').val();
                        
                        console.log("searching");
            
                        $("#autorefresh").load("refresh/searchresult.php", {
                            sort: sort,
                            show: show,
                            searchKey: searchKey
                        });
                        refresh = false;
                        searching = true;
                    }
                }
            }                             
        }); 
    }
}

function enterFeedback(id, x) {
    
    let feedback = $('textarea[id^="feedback-textarea-'+x+'"]').val()

    $.post("includes/index.inc.php",{
    id: id,
    feedback: feedback,

    enterFeedback: true
    }, function(data, status){
        //where data is any text echoed in loaders/load.php
        //if no text is echoed
        if (status == 'success') {
            if (data != 'success') {
                alert(data);
            } else {

                if (searching != true) {
                    setTimeout(function(){
                            
                        let A = 1;
                        console.log("refreshing");
                        $("#autorefresh").load("refresh/index.ref.php", {
                        A: A});
                
                    },30);
                    refresh = true;
                    console.log(refresh);
                } else {
                    let searchKey = $('#search-keyword').val();
                    let sort = $('#sort').val();
                    let show = $('#show').val();
                    
                    console.log("searching");
        
                    $("#autorefresh").load("refresh/searchresult.php", {
                        sort: sort,
                        show: show,
                        searchKey: searchKey
                    });
                    refresh = false;
                    searching = true;
                }
            }
        }                             
    }); 
}
 
function enterRescheduleDate(id, x) {
    
    let rescheduleDate = $('input[id^="reschedule-date-'+x+'"]').val()

    $.post("includes/index.inc.php",{
    id: id,
    rescheduleDate: rescheduleDate,

    enterRescheduleDate: true
    }, function(data, status){
        //where data is any text echoed in loaders/load.php
        //if no text is echoed
        if (status == 'success') {
            if (data != 'success') {
                alert(data);
            } else {

                if (searching != true) {
                    setTimeout(function(){
                            
                        let A = 1;
                        console.log("refreshing");
                        $("#autorefresh").load("refresh/index.ref.php", {
                        A: A});
                
                    },30);
                    refresh = true;
                    console.log(refresh);
                } else {
                    let searchKey = $('#search-keyword').val();
                    let sort = $('#sort').val();
                    let show = $('#show').val();
                    
                    console.log("searching");
        
                    $("#autorefresh").load("refresh/searchresult.php", {
                        sort: sort,
                        show: show,
                        searchKey: searchKey
                    });
                    refresh = false;
                    searching = true;
                }
            }
        }                             
    }); 
}
 
function takeOrder(id, username) {
    
    $.post("includes/index.inc.php",{
    id: id,
    username: username,

    takeOrder: true
    }, function(data, status){
        //where data is any text echoed in loaders/load.php
        //if no text is echoed
        if (status == 'success') {
            if (data != 'success') {
                alert(data);
            } else {

                if (searching != true) {
                    setTimeout(function(){
                            
                        let A = 1;
                        console.log("refreshing");
                        $("#autorefresh").load("refresh/index.ref.php", {
                        A: A});
                
                    },30);
                    refresh = true;
                    console.log(refresh);
                } else {
                    let searchKey = $('#search-keyword').val();
                    let sort = $('#sort').val();
                    let show = $('#show').val();
                   
                    console.log("searching");
        
                    $("#autorefresh").load("refresh/searchresult.php", {
                        sort: sort,
                        show: show,
                        searchKey: searchKey
                    });
                    refresh = false;
                    searching = true;
                }
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
                    $("#autorefresh").load("refresh/index.ref.php", {
                    A: A});
            
                },30);
                refresh = true;
            }
        }                             
    });
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
                        
                    $("#autorefresh").load("refresh/searchresult.php", {
                        sort: sort,
                        show: show,
                        searchKey: searchKey
                    });
                    
                },30);
                refresh = false;
                searching = true;
            }
        }                             
    });
}

// (function() {        
//     var timer;
//     $(window).bind('scroll',function () {
//         clearTimeout(timer);
//         $(".date-heading").attr("style", "visibility: visible;");
//         timer = setTimeout( refresh , 1000 );
//     });
//     var refresh = function () { 
//         // do stuff
//         $(".date-heading").attr("style", "visibility: hidden;");
//         console.log('Stopped Scrolling'); 
//     };
// })();

// document.getElementById("new-order-audio").play();

$(document).ready(function(){

    setInterval(function(){
        
        if (refresh == true) {
            
            let A = 1;
            console.log("refreshing");
            $("#autorefresh").load("refresh/index.ref.php", {
            A: A});
        }

    },3000);

});