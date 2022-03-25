function selectPhoto() {
    document.querySelector("#selectPhoto").click();
}

function deletePhoto(){

    $('#delete-profile-photo-button').click();

    //console.log(typeof email);

    /*$.post("includes/profilephoto.inc.php",{
    
        email: email,
        deleteProfilePhoto: true

    }, function(data, status){
        //where data is any text echoed
        //if no text is echoed
        if (status == 'success') {
            if (data != 'success') {
                loginErrorMessages(data);
            }else{
                //alert(data);
                window.location.href = "accountinfo.php";
            }
        }                             
        
    });*/
}

//code to display selected image before upload
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-photo')
            .attr('style', 'background-image: url('+e.target.result+'); border: 1px solid gray');
            /*.width(150)
            .attr('src', e.target.result)
            .height(150)
            .border-radius(10);*/
        };

        reader.readAsDataURL(input.files[0]);

        $("#upload-profile-photo-button").attr("style", "display: flex;");
    }
}

$(document).ready(function () {
    $("#add-logistics").click(function () {
        $("#add-logistics-username, #submit-logistics").slideToggle(500);
    });
});

$(document).ready(function () {
    $("#add-affiliate").click(function () {
        $("#add-affiliate-username, #submit-affiliate").slideToggle(500);
    });
});

$(document).ready(function () {
    $("#add-location-button").click(function () {
        $("#add-location, #add-location-price, #submit-location").slideToggle(500);
    });
});

function locationInput(num){
    $(".view-location-form-"+num+", #view-location-price-"+num+"").slideToggle(500);
    transformArrow(num);
}

let angle = true;
function transformArrow(num) {
    if (angle == true) {
        console.log("transforming");
        $("#view-location-"+num+"").removeClass("down-arrow");
        $("#view-location-"+num+"").addClass("up-arrow");
        angle = false;
    } else {
        console.log("not transforming");
        $("#view-location-"+num+"").removeClass("up-arrow");
        $("#view-location-"+num+"").addClass("down-arrow");
        angle = true;
    }
}

function checkUrl() {
    let url = window.location.href;
    
    let largePhoto = url.indexOf("largePhoto");
    let uploadError = url.indexOf("uploadError");
    let uploadSuccess = url.indexOf("uploadSuccess");
    let deleteSuccess = url.indexOf("deleteSuccess");
    let unsupportedExtension = url.indexOf("unsupportedExtension");
    let databaseError = url.indexOf("databaseError");
    let invalidUser = url.indexOf("invalidUser");
    let existingResultAffiliate = url.indexOf("existingResultAffiliate");
    let existingResultAgent = url.indexOf("existingResultAgent");
    let myAffiliateResult = url.indexOf("myAffiliateResult");
    let myAgentResult = url.indexOf("myAgentResult");
    let myLogisticsResult = url.indexOf("myLogisticsResult");
    let wrongAccountAffiliate = url.indexOf("wrongAccountAffiliate");
    let wrongAccountAgent = url.indexOf("wrongAccountAgent");
    let requestSent = url.indexOf("requestSent");
    let addedAffiliate = url.indexOf("addedAffiliate");
    let addedAgent = url.indexOf("addedAgent");
    let removeAgent = url.indexOf("removeAgent");
    let removeAffiliate = url.indexOf("removeAffiliate");
    let locationExist = url.indexOf("locationExist");
    let locationAdded = url.indexOf("locationAdded");

    if (largePhoto != -1) {
        $("#page-heading").after('<span class="error-notification">Image too large, maximum 3MB!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (locationExist != -1) {
        $("#page-heading").after('<span class="error-notification">location exist already!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (uploadError != -1) {
        $("#page-heading").after('<span class="error-notification">Error uploading image!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (unsupportedExtension != -1) {
        $("#page-heading").after('<span class="error-notification">Unsupported file extension!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (databaseError != -1) {
        $("#page-heading").after('<span class="error-notification">Error fron database!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (invalidUser != -1) {
        $("#page-heading").after('<span class="error-notification">Username doesn\'t exist in database!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (wrongAccountAffiliate != -1) {
        $("#page-heading").after('<span class="error-notification">Username exist but user is not an Affiliate!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (wrongAccountAgent != -1) {
        $("#page-heading").after('<span class="error-notification">Username exist but user is not an Agent!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (existingResultAffiliate != -1) {
        $("#page-heading").after('<span class="error-notification">Affiliate already added by another merchant!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (myAffiliateResult != -1) {
        $("#page-heading").after('<span class="error-notification">Affiliate already added by you!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (existingResultAgent != -1) {
        $("#page-heading").after('<span class="error-notification">Agent already added by another logistic!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (myAgentResult != -1) {
        $("#page-heading").after('<span class="error-notification">Agent already added by you!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (myLogisticsResult != -1) {
        $("#page-heading").after('<span class="error-notification">Logistics already added by you!</span>');

        setTimeout(function() {
            $(".error-notification").remove();
        }, 2000);
    }
    if (requestSent != -1) {
        $("#page-heading").after('<span class="success-notification">Request Sucessfully sent!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
    }
    if (uploadSuccess != -1) {
        $("#page-heading").after('<span class="success-notification">Uploaded Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
    }
    if (addedAffiliate != -1) {
        $("#page-heading").after('<span class="success-notification">Affiliate added Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
    }
    if (addedAgent != -1) {
        $("#page-heading").after('<span class="success-notification">Agent added Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
    }
    if (removeAffiliate != -1) {
        $("#page-heading").after('<span class="success-notification">Affiliate Removed Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
    }
    if (removeAgent != -1) {
        $("#page-heading").after('<span class="success-notification">Agent Removed Sucessfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
    }
    if (deleteSuccess != -1) {
        $("#page-heading").after('<span class="success-notification">Deleted successfully!</span>');

        setTimeout(function() {
            $(".success-notification").remove();
        }, 2000);
    }
    if (locationAdded != -1) {
        $("#page-heading").after('<span class="success-notification">Location added successfully!</span>');

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

                let searchKey = $('#search-keyword').val();
                let sort = $('#sort').val();
                let show = $('#show').val();

                setTimeout(function(){
                        
                    $("#autorefresh").load("refresh/accountinfo.ref.php", {
                        Tab: TabCtrl
                    });
                    
                },30);
                refresh = false;
                searching = true;
            }
        }                             
    });
}

//function reloads various elements(div) in the page after 5000 miliseconds / 5 seconds
$(document).ready(function(){
    setInterval(function(){
    let A = 1;
    console.log("refreshing");
    $("#autorefresh").load("refresh/accountinfo.ref.php", {
    main: A});
    },1000);
});
