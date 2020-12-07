<?PHP
include '../DB_Connection.php';
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin']['category'] != '3') {
  header('location:../logout.php');
}
$site="SELECT * FROM `site`";
$site_result=mysqli_query($connect,$site);
$site_row=mysqli_fetch_array($site_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/<?PHP echo $site_row['favicon']; ?>">
  <link rel="icon" type="image/png" href="../assets/images/<?PHP echo $site_row['favicon']; ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?PHP echo $site_row['name']; ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/admin_css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/admin_css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/admin_demo/demo.css" rel="stylesheet" />
  <!--   AJAX CALLS   -->
  <script src="Back_Acripts.js"></script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
         
        </a>
        <a href="#" class="simple-text logo-normal">
          <?PHP echo $site_row['name']; ?>
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <!------------------>
          <li class="active list_dashboard">
            <a href="#" onclick="Ajax_Dashboard()">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="list_products">
            <a href="#" onclick="Ajax_Products()">
              <i class="fas fa-shopping-bag"></i>
              <p>Products</p>
            </a>
          </li>
          <li class="list_sellers">
            <a href="#" onclick="Ajax_Sellers()">
            <i class="fas fa-users"></i>
              <p>Sellers</p>
            </a>
          </li>
          <li class="list_add_seller">
            <a href="#" onclick="Ajax_Add_Seller()">
              <i class="fas fa-user-plus"></i>
              <p>Add Seller</p>
            </a>
          </li>
          <!--<li class="dropdown">
            <a href="#" id="dropdownMenuLink" data-toggle="dropdown">
              <i class="fas fa-user-plus"></i>
              <p>Add User <small class="fas fa-angle-down"></small></p>
            </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#" onclick="Ajax_Add_City_Admin()">Add City Admin</a>
                <a class="dropdown-item" href="#" onclick="Ajax_Add_Seller()">Add Seller</a>
                <a class="dropdown-item" href="#" onclick="Ajax_Add_Coustomer()">Add Coustomer</a>
              </div>
          </li>-->
          <li class="list_add_category">
            <a href="#" onclick="Ajax_Add_Category()">
              <i class="fas fa-plus-square"></i>
              <p>Add Category</p>
            </a>
          </li>
          <!------------------>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"><i class="fas fa-globe"></i></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">User</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Update_profile_Modal"><i class="fas fa-user-circle"></i> Profile</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#change_password_Modal"><i class="fas fa-key"></i> Change Password</a>
                  <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
              </li>
              <li class="nav-item">
                
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
        <canvas ></canvas>
      </div>
      <div  class="content" id="Ajax_Content_Display">
          <!--------------------------->
          <!--------------------------->
        
      </div>
      <!-- change password Modal -->
      <div class="modal fade" id="change_password_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="change_password_form">
              <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                  <input type="text" name="Old_Password" id="Old_Password" class="form-control border-primary" placeholder="Old Password" required/>
                              </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                  <input type="text" name="New_Password" id="New_Password" class="form-control border-primary" placeholder="New Password" required/>
                              </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                  <input type="text" name="Confirm_Password" id="Confirm_Password" class="form-control border-primary" placeholder="Confirm Password" required/>
                              </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <p class="card-title Ajax_change_password_Responce text-info"></p>
                        </div>
                    </div>  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info"onclick="change_password()">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End change password Modal -->
      <!-- Update profile Modal -->
      <div class="modal fade" id="Update_profile_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="Update_profile_form">
              <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label>First Name</label>
                                  <input type="text" name="fname" id="fname" value="<?PHP echo $_SESSION['admin']['fname'];?>" class="form-control border-primary"  required/>
                              </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" name="lname" id="lname" value="<?PHP echo $_SESSION['admin']['lname'];?>"class="form-control border-primary"   required/>
                              </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label>Phone</label>
                                  <input type="text" name="phone" id="phone" value="<?PHP echo $_SESSION['admin']['phone'];?>" class="form-control border-primary"   required/>
                              </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label>Email</label>
                                  <input type="text" name="email" id="email" value="<?PHP echo $_SESSION['admin']['email'];?>"class="form-control border-primary"   required/>
                              </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label>Address</label>
                                  <input type="text" name="address" id="address" value="<?PHP echo $_SESSION['admin']['address'];?>"class="form-control border-primary" required/>
                              </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <p class="card-title Ajax_Update_profile_Responce text-info"></p>
                        </div>
                    </div>  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info"onclick="Update_profile()">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Update profile Modal -->
      <!--  footer -->
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="#">
                  About Us
                </a>
              </li>
              <li>
                <a href="#">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="#" target="_blank">Invision</a>. Coded by <a href="#" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
      <!-- End footer -->
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/82b716bd33.js" crossorigin="anonymous"></script>
  <script src="../assets/admin_js/core/jquery.min.js"></script>
  <script src="../assets/admin_js/core/popper.min.js"></script>
  <script src="../assets/admin_js/core/bootstrap.min.js"></script>
  <script src="../assets/admin_js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/admin_js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/admin_js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/admin_js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/admin_demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
    
    //============== AJAX PAGE CALLS ==============

function Ajax_Products(){
    $.ajax({
        url: "products.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            $(".list_dashboard,.list_add_seller,.list_sellers,.list_add_category").removeClass("active");
            $(".list_products").addClass("active");
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
function Ajax_Add_Seller(){
    $.ajax({
        url: "Add_Seller.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            $(".list_dashboard,.list_products,.list_sellers,.list_add_category").removeClass("active");
            $(".list_add_seller").addClass("active");
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
function Ajax_Add_Category(){
    $.ajax({
        url: "Add_Category.php",
        success: function (result) {
            $("#Ajax_Content_Display").html(result);
            $(".list_dashboard,.list_products,.list_sellers,.list_add_seller").removeClass("active");
            $(".list_add_category").addClass("active");
        // setInterval(function(){  filter_data() },5000).fadeoIn(1000);
        }
    });
}
//============ END AJAX PAGE CALLS ============
function change_password(){
    var formdata = {
      Old_Password : $("#Old_Password").val(),
      New_Password : $("#New_Password").val(),
      Confirm_Password : $("#Confirm_Password").val()
    }
    if (formdata.Confirm_Password !="" && formdata.Old_Password !="" && formdata.New_Password !="") {
      if (formdata.Confirm_Password == formdata.New_Password ) {
          $.ajax({
            type:"POST",
            url:"Back_Scripts.php",
            data:formdata,
            success:function (responce) {
              $('.Ajax_change_password_Responce').html(responce);
            }
          });
      } else {
        $('.Ajax_change_password_Responce').html('*New password and confirm password should be same');
      }
    }else{
      $('.Ajax_change_password_Responce').html('*All fields must be filed');
    }
}
function Update_profile() {
    var formdata = {
      update_fname: $("#fname").val(),
      update_lname: $("#lname").val(),
      update_email: $("#email").val(),
      update_phone: $("#phone").val(),
      update_address: $("#address").val()
    }
    debugger
    if ( formdata.update_fname !="" && formdata.update_lname !="" && formdata.update_email !="" && formdata.update_phone !="" && formdata.update_address !="") {
        $.ajax({
          type:"POST",
          url:"Back_Scripts.php",
          data:formdata,
          success:function (responce) {
            $('.Ajax_Update_profile_Responce').html(responce);
          }
        });
    }else{
      $('.Ajax_Update_profile_Responce').html('*All fields must be filed');
    }
}
function add_category() {
    var formdata = {
        category : $("#category").val()
    }
    if (formdata.category !="") {
      $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:formdata,
        success:function (responce) {
          $('.Ajax_Add_Category_Responce').html(responce);
        }
    });
    }else{
      $('.Ajax_Add_Category_Responce').html('*Enter category');
    }
}
function add_sub_category() {
    var formdata = {
      category : $("#category_sno").val(),
      sub_category: $("#sub_category").val()
    }
    if (formdata.category !="" && formdata.category !="") {
      $.ajax({
          type:"POST",
          url:"Back_Scripts.php",
          data:formdata,
          success:function (responce) {
            $('.Ajax_Add_Sub_category_Responce').html(responce);
          }
      });
    }else{
      $('.Ajax_Add_Sub_category_Responce').html('*Enter sub catogery');
    }
}

function adding_Seller() {
  var formdata = {
      fname : $("#fname").val(),
      lname : $("#lname").val(),
      email : $("#email").val(),
      phone : $("#phone").val(),
      password : $("#password").val(),
      address: $("#address").val()
  }
  
  if (formdata.fname !="" && formdata.lname !="" && formdata.email !="" && formdata.phone !="" && formdata.address !="" &&  formdata.password !="") {
    $.ajax({
          type:"POST",
          url:"Back_Scripts.php",
          data:formdata,
          success:function (responce) {
            $('.Ajax_cadd_seller_Responce').html(responce);
          }
      });
  } else {
    $('.Ajax_cadd_seller_Responce').html('*All fields must be filed');
  }
}
function changeProductStatus(productId) {
  var productId;
  var chageProductStatus="chageProductStatus";
      $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{productId,chageProductStatus},
        success:function (responce) {
          $('.ProductStatusResponce'+productId).html(responce);
        }
      });
}
function sellerStatus(sellerId) {
  var sellerId;
  var sellerStatus="sellerStatus";
  $.ajax({
        type:"POST",
        url:"Back_Scripts.php",
        data:{sellerId,sellerStatus},
        success:function (responce) {
          $('.sellerStatusResponce'+sellerId).html(responce);
        }
      });
}
  </script>
</body>

</html>