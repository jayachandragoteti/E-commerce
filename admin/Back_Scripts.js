//============== AJAX PAGE CALLS ==============

function Ajax_Products(){
    $.ajax({
        url: "Products.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            filter_data();
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_City_Admins(){
    $.ajax({
        url: "City_Admins_List.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            filter_data();
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_Sellers(){
    $.ajax({
        url: "Sellers_List.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            filter_data();
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_Coustomers(){
    $.ajax({
        url: "Coustomers_List.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            filter_data();
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_Add_City_Admin(){
    $.ajax({
        url: "Add_City_Admin.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            filter_data();
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_Add_Seller(){
    $.ajax({
        url: "Add_Seller.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            filter_data();
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_Add_Coustomer(){
    $.ajax({
        url: "Add_Coustomer.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            filter_data();
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_Add_Category(){
    $.ajax({
        url: "Add_Category.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            filter_data();
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
//============ END AJAX PAGE CALLS ============

function add_catogery() {
    var formdata = {
        catogery : $("#catogery").val(),
        add_catogery_submit : $("#add_catogery_submit").val()
    }
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:formdata,
        success:function (responce) {
            $('.Ajax_Add_Catogery_Responce').html(responce);
        }
    });
}