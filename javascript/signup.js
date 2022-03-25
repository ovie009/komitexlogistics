let fullname = $("#fullname").val();
let username = $("#username").val();
let email = $("#email").val();
let phone = $("#phone").val();
let password = $("#password").val();
let Rpassword = $("#Rpassword").val();

$(document).ready(function () {
    $("#signup-form").submit(function (event) {
        event.preventDefault();
        //removeMessage();//remove error message or VAT info
        
        //variables to represent input field
        fullname = $("#fullname").val();
        username = $("#username").val();
        email = $("#email").val();
        phone = $("#phone").val();
        password = $("#password").val();
        Rpassword = $("#Rpassword").val();
        let signup = true;
        //if inputs is empty, make variable value = 0, else, select value
        if( password != Rpassword ){
            console.log('different');
            errorMessages('differentPassword');
        }

        $.post("includes/signup.inc.php",{
        fullname: fullname,
        username: username,
        email: email,
        phone: phone,
        password: password,
        Rpassword: Rpassword,

        signup: signup
        }, function(data, status){
            //where data is any text echoed in loaders/load.php
            //if no text is echoed
            if (status == 'success') {
                if (data != 'success') {
                    errorMessages(data);
                }else{
                    //alert(data);
                    window.location.href = "index.php";
                }
            }                             
            
        }); 
    });
});

$(document).ready(function () {
    $("#signup").click(function () {
        //variables to represent input field
        fullname = $("#fullname").val();
        username = $("#username").val();
        email = $("#email").val();
        phone = $("#phone").val();
        password = $("#password").val();
        Rpassword = $("#Rpassword").val();

        if (fullname == '' || username == '' || email == '' || phone == '' || password == '' || Rpassword == '') {
            errorMessages('emptyFields');
        }
    });
});


function errorMessages(data){
    if (data == 'emptyFields') {
        removeMessages();
        $("#signup").before("<p class='error'>Empty Fields!</p>");
    } else if (data == 'invalidName') {
        removeMessages();
        $("#signup").before("<p class='error'>Invalid Name!</p>");
    } else if (data == 'invalidPhone') {
        removeMessages();
        $("#signup").before("<p class='error'>Invalid Name!</p>");
    } else if (data == 'invalidEmail') {
        removeMessages();
        $("#signup").before("<p class='error'>Invalid email!</p>");
    } else if (data == 'differentPassword') {
        removeMessages();
        $("#signup").before("<p class='error'>Passwords do not match!</p>");
    } else if (data == 'emailExist') {
        removeMessages();
        $("#signup").before("<p class='error'>Email already exist in database!</p>");
    } else if (data == 'userExist') {
        removeMessages();
        $("#signup").before("<p class='error'>Username already exist, try a different username!</p>");
    }
}

function removeMessages(){
    let error = document.querySelector(".error");
    if (error != null) {
        error.remove();
    }
}

// let FULLNAME;
// if (fullname == '') {
//     FULLNAME = false;
// } else {
//     $("#onclick-fullname").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//     FULLNAME = true;
// }

// $("#fullname").click(function(){   
//     if (FULLNAME == false) {
//         $("#onclick-fullname").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//         FULLNAME = true;
//     }
// });

// let USERNAME;
// if (username == '') {
//     USERNAME = false;
// } else {
//     $("#onclick-username").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//     USERNAME = true;
// }

// $("#username").click(function(){   
//     if (USERNAME == false) {
//         $("#onclick-username").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//         USERNAME = true;
//     }
// });


// let EMAIL;
// if (email == '') {
//     EMAIL = false;
// } else {
//     $("#onclick-email").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//     EMAIL = true;
// }

// $("#email").click(function(){   
//     if (EMAIL == false) {
//         $("#onclick-email").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//         EMAIL = true;
//     }
// });


// let PHONE;
// if (phone == '') {
//     PHONE = false;
// } else {
//     $("#onclick-phone").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//     PHONE = true;
// }

// $("#phone").click(function(){   
//     if (PHONE == false) {
//         $("#onclick-phone").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//         PHONE = true;
//     }
// });


// let PASSWORD;
// if (password == '') {
//     PASSWORD = false;
// } else {
//     $("#onclick-password").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//     PASSWORD = true;
// }

// $("#password").click(function(){   
//     if (PASSWORD == false) {
//         $("#onclick-password").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//         PASSWORD = true;
//     }
// });


// let RPASSWORD;
// if (Rpassword == '') {
//     RPASSWORD = false;
// } else {
//     $("#onclick-Rpassword").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//     RPASSWORD = true;
// }

// $("#Rpassword").click(function(){   
//     if (RPASSWORD == false) {
//         $("#onclick-Rpassword").animate({top: '-9px', fontSize: '.7em', padding: '5px'});
//         RPASSWORD = true;
//     }
// });