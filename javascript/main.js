let headerRefresh = true;

$(document).ready(function () {
    $(".dropdown").click(function () {
        $(".side-nav").slideToggle(400);

        if (headerRefresh == true) {
            headerRefresh = false;
        } else{
            headerRefresh = true;
        }

    });
});

function checkUrl() {
    let url = window.location.href;

    let emptyFields = url.indexOf("emptyFields");
    let nullEmail = url.indexOf("nullEmail");
    let wrongPassword = url.indexOf("wrongPassword");

    if (emptyFields != -1) {
        alert("Empty Fields");
    }
    if (nullEmail != -1) {
        alert("You don't have an account, click 'signup' to register");
    }
    if (wrongPassword != -1) {
        let user = url.split("=");
        
        let navUser = document.querySelector("#nav-user");
        let sideNavUser = document.querySelector("#side-nav-user");
        
        navUser.setAttribute("value", user[1]);
        sideNavUser.setAttribute("value", user[1]);
        alert("wrongPassword");

    }
}

$(document).ready(function () {
    $("#nav-submit").click(function () {
        //variables to represent input field
        let email = $("#nav-email").val();
        let password = $("#nav-password").val();
        
        if (email == '' || password == '') {
            loginErrorMessages('emptyFields');
        }
    });
});

function loginErrorMessages(data){
    if (data == 'emptyFields') {
        alert("Empty Fields");
    } else if (data == 'nullEmail') {
        alert("You don't have an account, click 'signup' to register");
    } else if (data == 'wrongPassword') {
        alert("wrongPassword");
    }
}

$(document).ready(function () {
    $("#side-nav-submit").click(function () {
        //variables to represent input field
        let email = $("#side-nav-email").val();
        let password = $("#side-nav-password").val();
        
        if (email == '' || password == '') {
            loginErrorMessages('emptyFields');
        }
    });
});

function loginErrorMessages(data){
    if (data == 'emptyFields') {
        alert("Empty Fields");
    } else if (data == 'nullEmail') {
        alert("You don't have an account, click 'signup' to register");
    }
}


$(document).ready(function(){

    setInterval(function(){
        
        let A = 'DropdownButton';
        let pageUrl = $("#page-url").val();
        let B = 'waybillLink';
        let C = 'homeLink';
        let D = 'contactLink';
        if (headerRefresh == true) {
            
            // console.log("header refreshing");
            $("#dropdown-button").load("refresh/header.ref.php", {
                pageUrl: pageUrl,
                A: A
            });
            
            // console.log("link refreshing");
            $("#waybill-link").load("refresh/header.ref.php", {
                pageUrl: pageUrl,
                A: B
            });

            $("#home-link").load("refresh/header.ref.php", {
                pageUrl: pageUrl,
                A: C
            });

            $("#contact-link").load("refresh/header.ref.php", {
                pageUrl: pageUrl,
                A: D
            });
        }

    },3000);

});