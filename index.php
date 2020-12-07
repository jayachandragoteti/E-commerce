<?PHP
include 'DB_Connection.php';
session_start();
$site="SELECT * FROM `site`";
$site_result=mysqli_query($connect,$site);
$site_row=mysqli_fetch_array($site_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120909275-1" type="d8dd7c58e1b80c256def9972-text/javascript"></script>
<script type="d8dd7c58e1b80c256def9972-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120909275-1');
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="<?PHP echo $site_row['name']; ?>, E-Commerce ,Shopping">
<meta name="keywords" content="<?PHP echo $site_row['name']; ?>, E-Commerce ,Shopping">
<meta name="author" content="Askbootstrap">
<title><?PHP echo $site_row['name']; ?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="apple-touch-icon" sizes="76x76" href="assets/images/<?PHP echo $site_row['favicon']; ?>">
<link rel="icon" type="image/png" href="assets/images/<?PHP echo $site_row['favicon']; ?>">
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="assets/css/Scrollbar_style.css">
<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">

<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/mobile.css" rel="stylesheet">
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/icofont.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/plugins/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="assets/plugins/owl-carousel/owl.theme.css">
</head>
<style>
    nav .nav-item .nav-link{
        color:white;
    }
</style>
<body>
<!--========================================================-->
<div class="modal fade login-modal-main" id="bd-example-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="login-modal">
                    <div class="row">
                        <div class="col-lg-6 pad-right-0">
                            <div class="login-modal-left">
                            </div>
                        </div>
                        <div class="col-lg-6 pad-left-0">
                            <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                                <div class="login-modal-right">
                                    <div class="tab-content" >
                                        <div class="tab-pane active" id="login" role="tabpanel">
                                            <h5 class="heading-design-h5 ">Login to your account</h5>
                                            <form id="Login_Form" method="post" role="form">
                                                <fieldset class="form-group">
                                                    <label for="formGroupExampleInput">Enter Email/Mobile number</label>
                                                    <input type="text" class="form-control" name="Email_Mobile" id="Email_Mobile" placeholder="username">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label for="formGroupExampleInput2">Enter Password</label>
                                                    <input type="password" class="form-control" name="Password" id="Password" placeholder="********">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <button type="button" class="btn btn-lg btn-theme-round btn-block" onclick="Login_Form()">Enter to your account</button>
                                                </fieldset>
                                                <!--<div class="login-with-sites text-center">
                                                    <p>or Login with your social profile:</p>
                                                    <button class="btn-facebook login-icons btn-lg"><i class="fa fa-facebook"></i> Facebook</button>
                                                    <button class="btn-google login-icons btn-lg"><i class="fa fa-google"></i> Google</button>
                                                    <button class="btn-twitter login-icons btn-lg"><i class="fa fa-twitter"></i> Twitter</button>
                                                </div>-->
                                                <p>
                                                    <h5 class="text-danger Login_Errors"></h5>
                                                    <p>
                                                        <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="checkbox" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Remember me </span>
                                                            <a href="#" class="custom-control-description pull-right ml-lg-5"onclick="show_Forgot_Password_Form()"><i class="fas fa-user-lock"></i> Forgot Password</a>
                                                        </label>
                                                    </p>
                                                </p>
                                            </form>
                                            <form id="Forgot_Password_Form" method="post" role="form" style="display:none;">
                                                <fieldset class="form-group">
                                                    <label for="formGroupExampleInput">Enter Email/Mobile number</label>
                                                    <input type="text" class="form-control" name="Forgot_Email_Mobile" id="Forgot_Email_Mobile" placeholder="username">
                                                </fieldset>
                                                <h5 class="text-danger ajax_Forgot_Password_responce"></h5>
                                                <fieldset class="form-group">
                                                    <button type="button" class="btn btn-lg btn-theme-round btn-block" onclick="Forgot_Password()">Enter</button>
                                                </fieldset>
                                            </form>    
                                        </div>
                                        <div class="tab-pane" id="register" role="tabpanel">
                                            <h5 class="heading-design-h5">Register Now!</h5>
                                            <form id="Register_Form" method="post" role="form">
                                                <fieldset class="form-group">
                                                    <label for="username">Enter Email/Mobile number</label>
                                                    <input type="email" name="username" class="form-control" id="username" placeholder="Ex: gotetijayachandra@gmail.com">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label for="register_Password">Enter Password</label>
                                                    <input type="password" name="register_Password" class="form-control" id="register_Password" placeholder="********">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label for="Confirm_Password">Enter Confirm Password </label>
                                                    <input type="password" name="Confirm_Password" class="form-control" id="Confirm_Password" placeholder="********">
                                                </fieldset>
                                                <p>
                                                    <h5 class="text-danger ajax_registration_responce"></h5>
                                                    <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                        <input type="checkbox" name="Term_and_Conditions"  id="Term_and_Conditions" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">I Agree with Term and Conditions </span>
                                                    </label>
                                                </p>
                                                <fieldset class="form-group">
                                                    <button type="button" class="btn btn-lg btn-theme-round btn-block" onclick="Customer_Register()">Create Your Account</button>
                                                    <!--<input type="button" class="btn btn-lg btn-theme-round btn-block" onclick="Customer_Register()" value="Create Your Account">-->
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="text-center login-footer-tab">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#login" role="tab"><i class="icofont icofont-lock"></i> LOGIN</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#register" role="tab"><i class="icofont icofont-pencil-alt-5"></i> REGISTER</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--========================================================-->
<div class="navbar-top bg-primary">
    <div class="container">
        <div class="row" >
            <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 text-left ">
                <p class="text-white">
                    Made with <span class="text-danger">&#10084;</span> in India
                </p>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 text-right text-white">
                <ul class="list-inline">
                    <!--<li class="list-inline-item">
                        <a href="#" class="text-white"><i class="icofont icofont-iphone"></i>My Account</a>
                    </li>-->
                    <li class="list-inline-item">
                        <a href="#" class="text-white"><i class="icofont icofont-headphone-alt"></i>Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--========================================================-->
<!-- navbar -->
<!--========================================================-->
<nav class="navbar navbar-light navbar-expand-lg bg-faded osahan-menu osahan-menu-top-5">
    <div class="container">
        <!-- side togle-->
        <button class="navbar-toggler "type="button" id="sidebarCollapse">
            <i class="fas fa-align-left"></i>
        </button>
        <!-- end side togle-->
        <a class="navbar-brand" href="index.php"> <img src="assets/images/<?PHP echo $site_row['logo']; ?>" alt="logo"> </a>
        <!--
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>-->
        <div class="navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                <div class="top-categories-search btn-radius">
                    <div class="input-group">
                        <span class="input-group-btn categories-dropdown">
                            <div class="dropdown">
                                <button class="btn bg-white dropdown-toggle" type="button" id="citysellectdropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All cities
                                </button>
                                <div class="dropdown-menu" aria-labelledby="citysellectdropdownMenuButton">
                                <?PHP 
                                    $select_cities="SELECT * FROM `cities` ORDER BY `cities`.`sno` ASC";
                                    $select_cities_result=mysqli_query($connect,$select_cities);
                                    while($cities_row=mysqli_fetch_array($select_cities_result)){ ?>
                                        <a class="dropdown-item" href="#">
                                            <input type="radio" name="cities" class="common_selector cities" value="<?PHP echo $cities_row['sno'] ?>" id="citiesCheck<?PHP echo $cities_row['sno'] ?>" style="display:none;">
                                            <label  for="citiesCheck<?PHP echo $cities_row['sno'] ?>" style="cursor: pointer;"><i class="fas fa-city"></i> <?PHP echo $cities_row['name'] ?></label>
                                        </a>
                                <?PHP }?> 
                                </div>
                            </div>
                        </span>
                        <input class="form-control" name="serchtext" id="search_text" placeholder="Search products &amp; brands" aria-label="Search products &amp; brands" type="text" >
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-radius" type="button" onclick="filter_data()"><i class="icofont icofont-search-alt-2"></i> Search</button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="my-2 my-lg-0">
                <ul class="list-inline main-nav-right">
                    <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-radius" href="#" data-toggle="modal" data-target="#FilterModal"><i class="fas fa-filter"></i> Filter</a>
                    </li>
                <?PHP if (isset($_SESSION['login'])) {?>
                    <!--<li class="list-inline-item dropdown osahan-top-dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle btn-radius" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icofont icofont-shopping-cart"></i> Cart <small class="cart-value">02</small>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right cart-dropdown">
                            <div class="dropdown-item">
                                <a class="pull-right" data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Remove">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                                <a href="#">
                                    <img class="img-fluid" src="images/all-products/small/1.jpg" alt="Product">
                                    <strong>Ipsums Dolors Untra </strong>
                                    <small>Color : Red | Size : M</small>
                                    <span class="product-desc-price">$529.99</span>
                                    <span class="product-price text-danger">$329.99</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                            <a class="pull-right" data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Remove">
                                <i class="fa fa-trash-o"></i>
                            </a>
                            <a href="#">
                                <img class="img-fluid" src="images/all-products/small/3.jpg" alt="Product">
                                <strong>Ipsums Dolors Untra </strong>
                                <small>Color : Black | Size : XL</small>
                                <span class="product-desc-price">$82.99</span>
                                <span class="product-price text-danger">$36.99</span>
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                            <div class="dropdown-cart-footer text-center">
                                <h4> <strong>Subtotal</strong>: $210 </h4>
                                <a class="btn btn-sm btn-danger" href="view-cart.html"> <i class="icofont icofont-shopping-cart"></i> VIEW
                                CART </a> <a href="cart_checkout.html" class="btn btn-sm btn-primary"> CHECKOUT </a>
                            </div>
                        </div>
                    </li>-->
            
                    <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-radius" href="#"data-toggle="modal" data-target="#logoutModal"><i class="icofont icofont-ui-user"></i> Logout</a>
                    </li>
                        <!-- Log out Modal -->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Log out</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure do you want to log out..?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a  href="logout.php" class="btn btn-primary" >Yes</a>
                            </div>
                            </div>
                        </div>
                        </div>
                    <?PHP }else{ ?>
                    <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-radius" data-toggle="modal" data-target="#bd-example-modal" href="#"><i class="icofont icofont-ui-user"></i> Sign In</a>
                    </li>
    
                    <?PHP } ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- Filter Modal -->
<div class="modal fade" id="FilterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> <i class="icofont icofont-filter"></i>Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <aside class="sidebar_widget">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#Categoriessidebar_widget" aria-expanded="false" aria-controls="collapseOne">
                                        Categories
                                        <span><i class="fa fa-plus-square-o"></i></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="Categoriessidebar_widget" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-block">
                                    <ul class="trends">
                                    <?PHP 
                                        $select_category="SELECT * FROM `categories` ORDER BY `categories`.`sno` ASC";
                                        $select_category_sql=mysqli_query($connect,$select_category);
                                        while ($select_category_row=mysqli_fetch_array($select_category_sql)) { ?>
                                            <li>
                                                <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                    <input type="checkbox" class="custom-control-input common_selector categories" value="<?PHP echo $select_category_row['sno'];?>" id="categoriesCheck<?PHP echo $select_category_row['sno'] ?>">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description" for="categoriesCheck<?PHP echo $select_category_row['sno'] ?>"><?PHP echo $select_category_row['name'];?></span>
                                                </label>
                                            </li>
                                        <?PHP } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <aside class="sidebar_widget">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#SubCategoriessidebar_widget" aria-expanded="false" aria-controls="collapseOne">
                                        Sub Categories
                                        <span><i class="fa fa-plus-square-o"></i></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="SubCategoriessidebar_widget" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-block">
                                    <ul class="trends ajax_filter_sub_category_data">
                                    
                                    </ul>    
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <aside class="sidebar_widget">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#materialsidebar_widget" aria-expanded="false" aria-controls="collapseOne">
                                        Material
                                        <span><i class="fa fa-plus-square-o"></i></span>
                                    </a>
                                </h5>
                            </div>
                            
                            <div id="materialsidebar_widget" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-block">
                                    <ul class="trends">
                                    <?PHP 
                                        $select_material="SELECT DISTINCT(`material`) FROM `products` ORDER BY `products`.`sno` ASC";
                                        $select_material_sql=mysqli_query($connect,$select_material);
                                        while ($select_material_row=mysqli_fetch_array($select_material_sql)) { ?>
                                            <li>
                                                <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                                    <input type="checkbox" class="custom-control-input common_selector material" value="<?PHP echo $select_material_row['material'];?>" id="materialCheck<?PHP echo $select_material_row['material'] ?>">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description" for="materialCheck<?PHP echo $select_material_row['material'] ?>"><?PHP echo $select_material_row['material'];?></span>
                                                </label>
                                            </li>
                                        <?PHP } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <aside class="sidebar_widget">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#gendersidebar_widget" aria-expanded="false" aria-controls="collapseOne">
                                        Gender
                                        <span><i class="fa fa-plus-square-o"></i></span>
                                    </a>
                                </h5>
                            </div>
                            <div id="gendersidebar_widget" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-block">
                                    <ul class="trends">
                                    <li>
                                        <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                            <input type="radio" name="gender" class="custom-control-input common_selector gender" value="Male" id="genderCheckMale">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description" for=genderCheckMale">Male</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                            <input type="radio" name="gender" class="custom-control-input common_selector gender" value="Female" id="genderCheckFemale">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description" for=genderCheckFemale">Female</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                            <input type="radio" name="gender" class="custom-control-input common_selector gender" value="Both" id="genderCheckBoth">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description" for=genderCheckBoth">Both</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                            <input type="radio" name="gender" class="custom-control-input common_selector gender" value="None" id="genderCheckNone">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description" for=genderCheckNone">None</span>
                                        </label>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">ok</button>
            </div>
        </div>
    </div>
</div>
<!--========================================================-->
<nav class="navbar navbar-expand-lg navbar-light bg-primary osahan-menu osahan-menu-2 pad-none-mobile">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mt-2 mt-lg-0 margin-auto">
                <li class="nav-item active Home">
                    <a class="nav-link" href="#" onclick="index_ajax_call()"> <i class="icofont icofont-ui-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>
                <?PHP if (isset($_SESSION['login'])) {?>
                <li class="nav-item My_Wishlist">
                    <a class="nav-link" href="#" onclick="Ajax_my_wishlist()"><i class="fas fa-heart"></i> My Wishlist</a>
                </li>
                <li class="nav-item My_Cart">
                    <a class="nav-link" href="#" onclick="Ajax_my_cart()"><i class="fas fa-shopping-cart"></i> My Cart</a>
                </li>
                <li class="nav-item My_Account">
                    <a class="nav-link" href="#"  onclick="Ajax_my_account()"><i class="fas fa-user"></i> My Account</a>
                </li>
                <li class="nav-item My_Orders">
                    <a class="nav-link" href="#"  onclick="Ajax_My_Orders()"><i class="fas fa-clipboard-list"></i> My Orders List</a>
                </li>
                <?PHP } ?>
                <li class="nav-item Terms_Conditions">
                    <a class="nav-link" href="#"  onclick="Ajax_Terms_Conditions()"><i class="fas fa-list-alt"></i> Terms Conditions</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--========================================================-->
<!-- Side navbar -->
<!--========================================================-->
<div class="wrapper">
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>
        
        <div class="sidebar-header">
            <h3 class="text-white"><?PHP echo $site_row['name']; ?></h3>
        </div>
            <ul class="list-unstyled components">
                <li class="nav-item active Home">
                    <a class="nav-link" href="#" onclick="index_ajax_call()"> <i class="icofont icofont-ui-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>
                <?PHP if (isset($_SESSION['login'])) {?>
                <li class="nav-item My_Wishlist">
                    <a class="nav-link" href="#" onclick="Ajax_my_wishlist()"><i class="fas fa-heart"></i> My Wishlist</a>
                </li>
                <li class="nav-item My_Cart">
                    <a class="nav-link" href="#" onclick="Ajax_my_cart()"><i class="fas fa-shopping-cart"></i> My Cart</a>
                </li>
                <li class="nav-item My_Account">
                    <a class="nav-link" href="#"  onclick="Ajax_my_account()"><i class="fas fa-user"></i> My Account</a>
                </li>
                <li class="nav-item My_Orders">
                    <a class="nav-link" href="#"  onclick="Ajax_My_Orders()"><i class="fas fa-clipboard-list"></i> My Orders List</a>
                </li>
                <?PHP } ?>
                <li class="nav-item Terms_Conditions">
                    <a class="nav-link" href="#"  onclick="Ajax_Terms_Conditions()"><i class="fas fa-list-alt"></i> Terms Conditions</a>
                </li>
            </ul>
    </nav>
</div>
<!--========================================================-->
<!-- end navbar -->
<!--========================================================-->
<!--========================================================-->
<div id="Ajax_Content_Display">

</div>

<!--========================================================-->
<!--========================================================-->
<section class="top-brands">
    <div class="container">
        <div class="section-header">
            <h5 class="heading-design-h5">Top Brands <!--<span class="badge badge-primary">200 Brands</span>--></h5>
        </div>
        <div class="row text-center">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <a href="#"><img class="img-responsive" src="assets/images/brands/1.jpg" alt=""></a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <a href="#"><img class="img-responsive" src="assets/images/brands/2.jpg" alt=""></a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <a href="#"><img class="img-responsive" src="assets/images/brands/3.jpg" alt=""></a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <a href="#"><img class="img-responsive" src="assets/images/brands/4.jpg" alt=""></a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <a href="#"><img class="img-responsive" src="assets/images/brands/5.jpg" alt=""></a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <a href="#"><img class="img-responsive" src="assets/images/brands/6.jpg" alt=""></a>
            </div>
        </div>
    </div>
</section>
<!--========================================================-->
<!-- footer -->
<!--========================================================-->
        <footer>
            <section class="footer-Content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="footer-widget">
                                <h3 class="block-title">About</h3>
                                <div class="textwidget">
                                    <p>E-commerce is also known as electronic commerce or internet commerce. ... Transaction of money, funds, and data are also considered as E-commerce. These business transactions can be done in four ways: Business to Business (B2B), Business to Customer (B2C), Customer to Customer (C2C), Customer to Business (C2B).</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="footer-widget">
                                <h3 class="block-title">Quick Links</h3>
                                <ul class="menu">
                                <li><a href="#" onclick="index_ajax_call()">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </footer>
        <!--========================================================-->
        <!-- end footer -->
        <!--========================================================-->
        <section class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="footer-logo pull-left hidden-xs">
                            <img alt="" src="assets/images/<?PHP echo $site_row['logo']; ?>" class="img-responsive">
                        </div>
                        <div class="footer-links">
                            <ul>
                                <li><a href="#"> </a></li>
                                <li><a href="#"> </a></li>
                                <li><a href="#"> </a></li>
                            </ul>
                        </div>
                        <div class="copyright">
                            <p>
                                © Copyright &nbsp; | &nbsp;Made with <i class="fa fa-heart"></i> by
                                <a target="_blank" href="#">
                                <strong>JAY</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                        <div class="social-icon">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--========================================================-->
        <!--<section class="footer-bottom">
        <div class="container">
            <div class="row">
            <div class="col-lg-6 col-md-6 text-left">
                <div class="payment-menthod">
                <img alt="" src="assets/images/payment_methods.png">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 text-right">
                <strong>Download App &nbsp; </strong>
                <a href="#"><img alt="" src="assets/images/app-store.png"></a>
                <a href="#"><img alt="" src="assets/images/google-play.png"></a>
            </div>
            </div>
        </div>
        </section>-->
        <!--========================================================-->
<!--========================================================-->
<script src="Back_Scripts.js" ></script>
<script src="https://kit.fontawesome.com/82b716bd33.js" crossorigin="anonymous"></script>
<script src="assets/js/jquery.min.js" type="d8dd7c58e1b80c256def9972-text/javascript"></script>
<script src="assets/js/popper.min.js" type="d8dd7c58e1b80c256def9972-text/javascript"></script>
<script src="assets/plugins/tether/tether.min.js" type="d8dd7c58e1b80c256def9972-text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="d8dd7c58e1b80c256def9972-text/javascript"></script>
<script src="assets/js/custom.js" type="d8dd7c58e1b80c256def9972-text/javascript"></script>
<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
<script src="assets/plugins/select2/js/select2.min.js" type="d8dd7c58e1b80c256def9972-text/javascript"></script>
<script src="assets/plugins/owl-carousel/owl.carousel.js" type="d8dd7c58e1b80c256def9972-text/javascript"></script>
<script src="assets/js/rocket-loader.min.js" data-cf-settings="d8dd7c58e1b80c256def9972-|49" defer=""></script>
<script defer src="assets/js/beacon.min.js" data-cf-beacon='{"rayId":"5da73774681006bd","r":1,"version":"2020.9.1","si":10}'></script>
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!--========================================================-->
<script type="text/javascript">

$(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });
    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});
</script>
</body>
</html>
