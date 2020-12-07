<?PHP 
include 'DB_Connection.php';
session_start();
$site="SELECT * FROM `site`";
$site_result=mysqli_query($connect,$site);
$site_row=mysqli_fetch_array($site_result);
$error ="";
$msg ="";
if(isset($_GET['coustomer_forgot_password_verification']) || isset($_SESSION['coustomer_forgot_password_verification'])){
    $OTP = $_SESSION['coustomer_forgot_password_verification'] = $_GET['coustomer_forgot_password_verification'];
    if (isset($_POST['updated_password'])) {
        if ($_POST['new_password'] !="" && $_POST['confirm_password'] !="") {
            if ($_POST['new_password'] == $_POST['confirm_password']) {
                $new_password = $connect -> real_escape_string($_POST['new_password']);
                $confirm_password = $connect -> real_escape_string($_POST['confirm_password']);
                $update_password=mysqli_query($connect,"UPDATE `users` SET `password` = '$confirm_password' WHERE `otp`='$OTP'");
                if ($update_password) {
                    $msg ="Password changed successfully";
                } else {
                    $error = "failed try again!";
                }
            } else {
                $error ="New password and confirm password should be same!";
            }
        } else {
            $error = "* All fields must be filed!";
        } 
    }
}else {
    $error ="invalid Access";
    header('location:index.php');
}
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
<meta name="description" content="Osahan Fashion - Bootstrap 4 E-Commerce Theme">
<meta name="keywords" content="Osahan, fashion, Bootstrap4, shop, e-commerce, modern, flat style, responsive, online store, business, mobile, blog, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
<meta name="author" content="Askbootstrap">
<title><?PHP echo $site_row['name']; ?></title>

<link rel="apple-touch-icon" sizes="76x76" href="assets/images/apple-icon.png">
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
<br><br><br><br>
<div class="col-lg-6 col-md-6 mx-auto">
    <div class="widget">
        <div class="login-modal-right">
            <div class="tab-content">
                <div class="tab-pane active" id="login" role="tabpanel">
                    <h5 class="heading-design-h5">Forgot Password</h5>
                    <?php if($error !=""){?><strong> <div class="text-danger"><i class='far fa-times-circle'></i> <?php echo htmlentities($error); ?>  </strong></div><?php } 
                    else if($msg !=""){?><strong><div class="text-success"><i class="far fa-check-circle"></i><?php echo htmlentities($msg); ?></strong> </div><?php }
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                            <fieldset class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="+91 123 456 7890">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="********">
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="submit" class="btn btn-lg btn-theme-round btn-block" name="updated_password" value='SUBMIT'>
                            </fieldset>
                    <form> 
                </div>
            </div>
        </div>
    </div>
</div>
<!--========================================================-->
<!--========================================================-->
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
