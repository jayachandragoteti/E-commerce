<?PHP 
include 'DB_Connection.php';
session_start();
if (isset($_POST['submit'])) {
    $Email_Mobile = $connect -> real_escape_string($_POST['username']);
    $Password =$connect -> real_escape_string($_POST['password']);
    $user_details="SELECT * FROM `users` WHERE  `password` ='$Password' AND `email` ='$Email_Mobile' OR `phone` ='$Email_Mobile'";
    $user_details_sql=mysqli_query($connect,$user_details);
    $user_row=mysqli_fetch_array($user_details_sql);
    $_SESSION['admin'] = array(
        'sno' => $user_row['sno'],
        'fname' => $user_row['fname'],
        'lname' => $user_row['lname'],
        'phone' => $user_row['phone'],
        'email' => $user_row['email'],
        'address' => $user_row['address'],
        'category' => $user_row['category'],
    );
    if ($user_row['category'] == 4) {
        header('location:admin/dashboard.php');
    }elseif($user_row['category'] == 3) {
        header('location:city_admin/dashboard.php');
    }elseif($user_row['category'] == 2) {
        header('location:seller/dashboard.php');
    }
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
                    <h5 class="heading-design-h5">Login to your account</h5>
                        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                            <fieldset class="form-group">
                                <label for="formGroupExampleInput">Enter Email/Mobile number</label>
                                <input type="text" class="form-control" name="username" id="formGroupExampleInput" placeholder="+91 123 456 7890">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="formGroupExampleInput2">Enter Password</label>
                                <input type="password" class="form-control" name="password"id="formGroupExampleInput2" placeholder="********">
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="submit" class="btn btn-lg btn-theme-round btn-block" name="submit" value='SUBMIT'>
                            </fieldset>
                        <form> 
                    </div>
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
