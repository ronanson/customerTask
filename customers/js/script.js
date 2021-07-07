$(document).ready(function(){
    
    if (location.href.indexOf("newcustomer") > -1){
        getDistrictData();
    }
    if (location.href.indexOf("customerlist") > -1){
        customerListData();
        deleteCustomer();
    }
    

});
function getDistrictData(){
    $.get("php_back/districtdata.php", function(adat){$(".districtData").html(adat)});
}
function customerListData(){
    $.get("php_back/customerlistdata.php", function(adat){$(".customers").html(adat)});
}

function deleteCustomer(){
    $(document).on("click", ".del", function() {
        
        let id = $(this).attr("data-id");
        
        $.ajax({
            url: "php_back/deletecustomer.php",
            method: "POST",
            data: { id: id },
            success: function(){
                customerListData();
            },
            error: function(){
                $("#error").text("A törlés nem sikerült!");
            },

        });
    });
}