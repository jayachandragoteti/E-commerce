//============== AJAX PAGE CALLS ==============
index_ajax_call();
function index_ajax_call(){
    $.ajax({
        url: "AjaxIndex.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            $(".My_Orders,.My_Wishlist,.My_Cart,.My_Account,.Terms_Conditions").removeClass("active");
            $(".Home").addClass("active");
            setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_my_wishlist(){
    $.ajax({
        url: "my_wishlist.php",
        success: function (result) {
            $(".My_Orders,.Home,.My_Cart,.My_Account,.Terms_Conditions").removeClass("active");
            $(".My_Wishlist").addClass("active");
            $("#Ajax_Content_Display").html(result);
            Ajax_my_wishlist_data();
            setInterval(function(){   Ajax_my_wishlist_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_my_cart(){
    $.ajax({
        url: "my_cart.php",
        success: function (result) {
            $(".My_Orders,.Home,.My_Wishlist,.My_Account,.Terms_Conditions").removeClass("active");
            $(".My_Cart").addClass("active");
            $("#Ajax_Content_Display").html(result);
            Ajax_my_Cart_data();
        setInterval(function(){  Ajax_my_Cart_data() },2000).fadeoIn(1000);
        }
    });
}
function Ajax_my_account(){
    $.ajax({
        url: "my_account.php",
        success: function (result) {
            $(".My_Orders,.Home,.My_Wishlist,.My_Cart,.Terms_Conditions").removeClass("active");
            $(".My_Account").addClass("active");
            $("#Ajax_Content_Display").html(result);
        }
    });
}
function Ajax_My_Orders(){
    $.ajax({
        url: "my_orders.php",
        success: function (result) {
            $(".My_Account,.Home,.My_Wishlist,.My_Cart,.Terms_Conditions").removeClass("active");
            $(".My_Orders").addClass("active");
            $("#Ajax_Content_Display").html(result);
            my_orders_data();
        }
    });
}
function Ajax_Terms_Conditions(){
    $.ajax({
        url: "terms-conditions.php",
        success: function (result) {
            $(".My_Account,.Home,.My_Wishlist,.My_Cart,.My_Orders").removeClass("active");
            $(".Terms_Conditions").addClass("active");
            $("#Ajax_Content_Display").html(result);
        }
    });
}
function product_details(product_id){
    var product_id;
    $.ajax({
        url: "product_details.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            product_details_data(product_id);
        }
    });
}
function Ajax_Shipping(cart_id){
    var cart_id;
    $.ajax({
        url: "shopping_details.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            Ajax_Shipping_form(cart_id);
        }
    });
}
//============ END AJAX PAGE CALLS ============
function Login_Form() {
    var formdata ={
        Email_Mobile:$("#Email_Mobile").val(),
        Password: $("#Password").val()
    }
    if (formdata.Email_Mobile =="" && formdata.Password =="") {
        $(".Login_Errors").html("* All fields must be filed!");
    } else if (formdata.Password =="") {
        $(".Login_Errors").html("* Password must be filed!");
    } else if (formdata.Email_Mobile =="" ) {
        $(".Login_Errors").html("* Username must be filed!");
    }else{
        $.ajax({
            type:"POST",
            url:"Back_Scripts.php",
            data:formdata,
            success:function (responce) {
                if (responce == 'Coustomer') {
                    index_ajax_call();
                    location.replace("index.php");
                }else {
                    //location.replace("index.php");
                    $(".Login_Errors").html(responce);
                }                
            }
        });
    }
}
function show_Forgot_Password_Form() {
    if($("#Forgot_Password_Form").is(":visible")){
        $("#Forgot_Password_Form").hide();
    } else{
        $("#Forgot_Password_Form").show();
    }
}
//========================================================
function Customer_Register(){
    var username = $("#username").val();
    var Password = $("#register_Password").val();
    var Confirm_Password = $("#Confirm_Password").val();
    if (username == " " && Password == " " && Confirm_Password == " ") {
        $(".ajax_registration_responce").html("* All fields must be filed!");
    } else if (Password.length < 8) {
        $(".ajax_registration_responce").html("Password contains at least 8 distinct");
    } else if (Password != Confirm_Password) {
        $(".ajax_registration_responce").html('password and confirm password should be same');
    } else if ($("#Term_and_Conditions").prop("checked") != true) {
        $(".ajax_registration_responce").html("Please agree  Terms and Conditions");
    } else {
        $(".ajax_registration_responce").html("<img src='assets/images/loding.gif' />");
        $.ajax({
            type:"POST",
            url:"Back_Scripts.php",
            data:{
                username:username,
                Password:Password,
                Confirm_Password:Confirm_Password,
                Customer_Register:"Customer_Register"
            },
            success:function (responce) {
                $('.ajax_registration_responce').html(responce);
            }
        });
    }
}
//========================================================
function Forgot_Password(){
    var Forgot_Email_Mobile = $("#Forgot_Email_Mobile").val();
    $(".ajax_Forgot_Password_responce").html("<img src='assets/images/loding.gif' />");
    if (Forgot_Email_Mobile !="") {
        $.ajax({
            type:"POST",
            url:"Back_Scripts.php",
            data:{
                Forgot_Email_Mobile:Forgot_Email_Mobile
            },
            success:function (responce) {
                $('.ajax_Forgot_Password_responce').html(responce);
            }
        });
    } else {
        $('.ajax_Forgot_Password_responce').html('*All fields must be filled!');
    }
    
    
}
//========================================================
function my_account_update(){
    var formdata ={
        fname : $("#fname").val(),
        lname : $("#lname").val(),
        phone : $("#phone").val(),
        email : $("#email").val(),
        pincode : $("#pincode").val(),
        address : $("#address").val(),
        old_password : $("#old_password").val(),
        new_password : $("#new_password").val(),
        confirm_password : $("#confirm_password").val(),
        my_account_update : "my_account_update"
    };
    $(".my_account_update_responce").html("<img src='assets/images/loding.gif' />");
    $.ajax({
        
        type:"POST",
        url:"Back_Scripts.php",
        data:formdata,
        success:function (responce) {
            $(".my_account_update_responce").html(responce);
        }
    });
    
}
//========================================================
filter_data();
    function filter_data() {
        var action="filter_data";
        var categories = get_filter('categories');
        var cities = get_filter('cities');
        var material = get_filter('material');
        var gender = get_filter('gender');
        var low_hight_Price = get_filter('low_hight_Prices');
        
        if ($("#search_text").val() != "") {
            var search_text = $("#search_text").val();
        }else{
            var search_text = "";
        }

        $.ajax({
            type:"POST",
            url:"Back_Scripts.php",
            data:{
                action:action,
                categories:categories,
                cities:cities,
                material: material,
                gender:gender,
                search_text:search_text,
                low_hight_Price:low_hight_Price
            },
            success:function (responce) {
                $('.ajax_filter_products_data').html(responce);
                }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('.categories').click(function(){
        var filter = [];
        $('.categories:checked').each(function(){
            filter.push($(this).val());
        });
        filter_sub_category(filter);
    });  

    function filter_sub_category(filter_sub_category){
        var filter_sub_category;
        $(".ajax_filter_sub_category_data").html("<img src='assets/images/loding.gif' />");
        $.ajax({
            type:"POST",
            url:"Back_Scripts.php",
            data:{
                filter_sub_category:filter_sub_category
            },
            success:function (responce) {
                $('.ajax_filter_sub_category_data').html(responce);
                }
        });
    }

//========================================================
function add_to_wishlist(product_id) {
    var product_id;
    $(".product_responce"+product_id).html("<img src='assets/images/loding.gif' />");
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            product_id:product_id,
            add_to_wishlist:"add_to_wishlist"
        },
        success:function (responce) {
            $(".product_responce"+product_id).html(responce);
        }
    });
}
function remove_from_wishlist(product_id) {
    var product_id;
    $(".product_responce"+product_id).html("<img src='assets/images/loding.gif' />");
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            product_id:product_id,
            remove_from_wishlist:"remove_from_wishlist"
        },
        success:function (responce) {
            $(".product_responce"+product_id).html(responce);
        }
    });
}
function Ajax_my_wishlist_data(){
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            Ajax_my_wishlist_data_responce:"Ajax_my_wishlist_data_responce"
        },
        success:function (responce) {
            $(".Ajax_my_wishlist_data_responce").html(responce);
        }
    });
    
}
function add_to_cart(product_id) {
    var product_id;
    $(".product_responce"+product_id).html("<img src='assets/images/loding.gif' />");
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            product_id:product_id,
            add_to_cart:"add_to_cart"
        },
        success:function (responce) {
            $(".product_responce"+product_id).html(responce);
        }
    });
}
function remove_from_cart(product_id) {
    var product_id;
    $(".product_responce"+product_id).html("<img src='assets/images/loding.gif' />");
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            product_id:product_id,
            remove_from_cart:"remove_from_cart"
        },
        success:function (responce) {
            $(".product_responce"+product_id).html(responce);
        }
    });
}
function Ajax_my_Cart_data(){
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            Ajax_my_cart_data_responce:"Ajax_my_Cart_data_responce"
        },
        success:function (responce) {
            $(".Ajax_my_cart_data_responce").html(responce);
        }
    });
    
}

function product_details_data(product_id){
    var product_id;
    $(".product_details_data_responce").html("<img src='assets/images/loding.gif'/>");
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            product_id:product_id,
            product_details_data:"product_details_data"
        },
        success:function (responce) {
            $(".product_details_data_responce").html(responce);
        }
    });
    
}

function Ajax_cart_quantity(cart_id,pre_cart_value,value){
    //alert(cart_id+pre_cart_value+value);
    var cart_id;
    var pre_cart_value;
    var value;
    if (value == 'minus') {
        var cart_valu = parseInt(pre_cart_value) - 1;
    } else if (value == 'plus'){
        var cart_valu = parseInt(pre_cart_value) + 1;
    }else{
        var cart_valu =$('#cart_quantity').val();
    }
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            cart_id:cart_id,
            cart_valu:cart_valu
        },
        success:function (responce) {
            $(".Ajax_cart_quantity_responce"+cart_id).html(responce);
        }
    });
    
}
//========================================================
function Ajax_Shipping_form(cart_id){
    var cart_id;
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            cart_id:cart_id,
            Ajax_Shipping_form:"Ajax_Shipping_form"
        },
        success:function (responce) {
            $(".Ajax_Shipping_form_responce").html(responce);
        }
    });
}

function Shipping_form_details_submit(cart_id,user_id){
    var cart_id = cart_id;
    var user_id = user_id;
    var formdata ={
        cart_id: cart_id,
        user_id:user_id,
        first_name :$("#first_name").val(),
        last_name :$("#last_name").val(),
        phone :$("#phone").val(),
        alternate_number :$("#alternate_number").val(),
        email :$("#email").val(),
        pincode :$("#pincode").val(),
        address :$("#address").val(),
        Area :$("#Area").val(),
        Shipping_form_details:"Shipping_form_details"
    };
    if (formdata.cart_id != "" && formdata.user_id != ""  && formdata.first_name != "" && formdata.last_name != "" && formdata.phone != "" && formdata.alternate_number != "" && formdata.email != "" && formdata.pincode != "" && formdata.address != "" && formdata.Area != "" && formdata.Shipping_form_details != "") {
        $.ajax({
            type:"POST",
            url:"Back_Scripts.php",
            data:formdata,
            success:function (responce) {
                $(".Ajax_Shipping_form_responce").html(responce);
            }
        });
    } else {
        $(".shipping_errors").html('All fields must be filled!');
    }
}

function cash_on_delivery(orders_sno){
    var orders_sno;
    var formdata ={
        Cash_on_Delivery:'Cash_on_Delivery',
        orders_sno:orders_sno
    }
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:formdata,
        success:function (responce) {
            $(".Cash_on_Delivery_responce").html(responce);
        }
    });
}

function Order_complete(order_sno){
    var order_sno;
    var formdata = {
        order_sno: order_sno,
        complete_Order : "complete_Order"
    }
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:formdata,
        success:function (responce) {
            $(".Ajax_Shipping_form_responce").html(responce);
        }
    });
}


function my_orders_data(){
    $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{
            my_orders_data : "my_orders_data"
        },
        success:function (responce) {
            //alert(responce);
            $(".Ajax_my_orders_data_responce").html(responce);
        }
    });
}