refresh = true;

$(document).ready(function(){

    let date = $("#report-date").val();
    let type = $("#report-type").val();

    console.log("refreshing");
    $("#autorefresh").load("refresh/report.ref.php", {
    type: type,
    date: date}/*,

        function (responseTXT, statusTXT, xhr) {
            let orderProduct = getCookie('order_product');
            console.log(orderProduct);
            if (orderProduct != '') {
                if (orderProduct.indexOf('+') != -1) {
                    orderProduct = orderProduct.replace('+', ' ');
                    console.log(orderProduct);
                }
                $("#select-product option")
                .removeAttr("selected")
                .filter('[value="'+orderProduct+'"]')
                .attr('selected', true);
            }

            let orderLocation = getCookie('order_location');
            console.log(orderLocation);
            if (orderLocation != '') {
                $("#select-location option")
                .removeAttr("selected")
                .filter('[value="'+orderLocation+'"]')
                .attr('selected', true);
            }
        }*/

    );
    
});



function reportDate() {
    setTimeout(function(){

        let type = $("#report-type").val();
        let date = $("#report-date").val();
        console.log("refreshing");
        $("#autorefresh").load("refresh/report.ref.php", {
            type: type,
            date: date
        });

    },50);
}