<?PHP 
include 'DB_Connection.php';
session_start();

/* function pproduct_card(){ ob_start(); ?> <?PHP return ob_get_clean(); } ?> */
function Product_Card($sno,$name,$cost,$image){ ob_start(); ?>
<div class="col-lg-3 col-md-3 col-sm-6 mt-2">
    <div class="h-100">
        <div class="product-item">
            <div class="product-item-image">
                <span class="like-icon"><a class="" href="#" onclick="add_to_wishlist('<?PHP echo $sno; ?>')"> <i class="icofont icofont-heart"></i></a></span>
                <a href="#"onclick="product_details('<?PHP echo $sno; ?>')"><img class="card-img-top img-fluid" src="product_images/<?PHP echo $image;?>" alt="" style="height:18.5rem;"></a>
            </div>
            <a href="">
            <div class="product-item-body">
                <span class="product_responce<?PHP echo $sno;?> text-primary"></span>
                <div class="product-item-action">
                    <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-theme-round btn-sm" href="#" data-original-title="Add To Cart" onclick="add_to_cart('<?PHP echo $sno; ?>')"><i class="icofont icofont-shopping-cart"></i></a>
                    <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-theme-round btn-sm" href="#" data-original-title="View Detail" onclick="product_details('<?PHP echo $sno; ?>')"><i class="icofont icofont-search-alt-2"></i></a>
                </div>
                <h4 class="card-title"><a href="#"><?PHP echo $name;?></a></h4>
                <h5>
                    <span class="product-desc-price"><i class="fas fa-rupee-sign"></i><?PHP echo $cost*10;?></span>
                    <span class="product-price"><i class="fas fa-rupee-sign"></i><?PHP echo $cost;?></span>
                    <!--<span class="product-discount">10% Off</span>-->
                </h5>
            </div>
            </a>
            <div class="product-item-footer">
                <!--<div class="product-item-size">
                    <strong>Size</strong> <span>S</span> <span>M</span> <span>L</span> <span> XL</span> <span> 2XL</span>
                </div>
                
                <div class="stars-rating">
                    <i class="icofont icofont-star active"></i>
                    <i class="icofont icofont-star active"></i>
                    <i class="icofont icofont-star"></i>
                    <i class="icofont icofont-star"></i>
                    <i class="icofont icofont-star"></i> 
                </div>-->
            </div>
        </div>
    </div>
</div>
<?PHP return ob_get_clean(); } 

function my_wishlist_Product_Card($sno,$name,$cost,$image){ ob_start(); ?>
<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="h-100">
        <div class="product-item">
            <div class="product-item-image">
                <span class="like-icon"><a href="#" onclick="remove_from_wishlist('<?PHP echo $sno; ?>')"> <i class="icofont icofont-close-circled"></i></a></span>
                <a href="#" onclick="product_details('<?PHP echo $sno; ?>')"><img class="card-img-top img-fluid" src="product_images/<?PHP echo $image;?>" alt="" style="height:18.5rem;"></a>
            </div>
            <div class="product-item-body">
                <h4 class="card-title"><a href="#"><?PHP echo $name;?></a></h4>
                <h5>
                <span class="product-desc-price"><i class="fas fa-rupee-sign"></i><?PHP echo $cost*5;?></span>
                    <span class="product-price"><i class="fas fa-rupee-sign"></i><?PHP echo $cost;?></span>
                </h5>
                <p>
                    <span class="product_responce<?PHP echo $sno;?> text-primary"></span>
                </p>
                <p>
                    <a class="btn btn-success" href="#" onclick="add_to_cart('<?PHP echo $sno; ?>')"><i class="icofont icofont-shopping-cart"></i> Add To Cart</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?PHP return ob_get_clean(); }
function my_cart_Product_Card($sno,$name,$cost,$image,$quantity,$cart_sno,$cart_quantity){ ob_start(); ?>
    <tr>
        <td class="cart_product">
            <a href="#" onclick="product_details('<?PHP echo $sno; ?>')"><img class="img-fluid" src="product_images/<?PHP echo $image;?>" alt="Product"></a>
        </td>
        <td class="cart_description">
            <p class="product-name"><?PHP echo $name;?></p>
        </td>
        <td class="availability in-stock">
            <?PHP if ($quantity == 0) {
                echo '<span class="badge badge-danger">Our of stock</span>';
            }else {
                echo '<span class="badge badge-success">In stock</span>';
            }?>
        </td>
        <td class="price"><span><?PHP echo $cost;?></span></td>
        <?PHP if ($quantity != 0) { ?>
        <td class="qty">
            <div class="input-group">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-theme-round btn-number"  data-type="minus" data-field="cart_quantity[<?PHP echo $sno;?>]" onclick="Ajax_cart_quantity('<?PHP echo $cart_sno;?>','<?php echo $cart_quantity;?>','minus')">
                        <span class="fa fa-minus"></span>
                    </button>
                </span>
                <input type="text" name="cart_quantity[<?PHP echo $sno;?>]"  id="cart_quantity" class="form-control border-form-control form-control-sm input-number" value="<?php echo $cart_quantity;?>" min="1"  onkeyup="Ajax_cart_quantity('<?PHP echo $cart_sno;?>','<?php echo $cart_quantity;?>','input_value')">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-theme-round btn-number" data-type="plus" data-field="cart_quantity[<?PHP echo $sno;?>]" onclick="Ajax_cart_quantity('<?PHP echo $cart_sno;?>','<?php echo $cart_quantity;?>','plus')">
                        <span class="fa fa-plus"></span>
                    </button>
                </span>
                <!--<span class="Ajax_cart_quantity_responce<?PHP echo $cart_sno;?>"></span>-->
            </div>
        </td>
        <td class="price"><span><?PHP echo $total_cost = $cost * $cart_quantity;?></span></td>
        <td class="price">
            <a data-toggle="tooltip" data-placement="top" title="" href="#"   onclick="Ajax_Shipping(<?PHP echo $cart_sno;?>)"><i class="fas fa-credit-card fa-2x"></i></a>
        </td>
        <?PHP }else{ ?>
            <td class="price"><span class="badge badge-danger">Our of stock</span></td>
            <td class="price"><span class="badge badge-danger">Our of stock</span></td>
            <td class="price"><span class="badge badge-danger">Our of stock</span></td>
        <?PHP }?>
        <td class="action">
            <a data-toggle="tooltip" data-placement="top" title="" href="#"   onclick="remove_from_cart('<?PHP echo $sno; ?>')"><i class="fa fa-trash-o"></i></a>
        </td>
    </tr>

<?PHP return ob_get_clean(); }


function Product_details_Card($sno,$name,$description,$cost,$material,$size,$gender,$image,$quantity,$category,$subCategory){ ob_start(); ?>
<div class="widget ">
    <div class="section-header">
        <h5 class="heading-design-h5">
            <?PHP echo $name;?>
        </h5>
    </div>
    <figure class="figure" style="width:100%;">
        <img src="product_images/<?PHP echo $image;?>" class="figure-img img-fluid rounded" alt="<?PHP echo $name;?>">
        <figcaption class="figure-caption" style="width:100%;"><b>Description : <?PHP echo $description;?></b></figcaption>
        <h5 class="heading-design-h5">Cost: <small><i class="fas fa-rupee-sign"></i> <?PHP echo $cost;?></small></h5>
        <h5 class="heading-design-h5">Material : <small> <?PHP echo $material;?></small></h5>
        <h5 class="heading-design-h5">Size :<small><?PHP echo $size;?></small></h5>
        <h5 class="heading-design-h5">Gender : <small> <?PHP echo $gender;?></small></h5>
        <h5 class="heading-design-h5">Category : <small> <?PHP echo $category;?></small></h5>
        <h5 class="heading-design-h5">Sub Category : <small> <?PHP echo $subCategory;?></small></h5>
    </figure>
    <p>
        <span class="product_responce<?PHP echo $sno;?> text-primary"></span>
    </p>
    <div class=" justify-content-md-center list-product-item-action __web-inspector-hide-shortcut__ ">
        <a class="btn btn-theme-round" href="#" onclick="add_to_cart('<?PHP echo $sno; ?>')"><i class="icofont icofont-shopping-cart"></i> Add To Cart</a>
        <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-danger" href="#" data-original-title="SAVE" onclick="add_to_wishlist('<?PHP echo $sno; ?>')"><i class="icofont icofont-heart"></i></a>
    </div>
</div>
<?PHP return ob_get_clean(); }


function account_activate_email_template($otp){ ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>WELCOME</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
        <meta name="format-detection" content="telephone=no" />
        <!--[if !mso]><!-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!--<![endif]-->
        <style type="text/css">
        body {
        -webkit-text-size-adjust: 100% !important;
        -ms-text-size-adjust: 100% !important;
        -webkit-font-smoothing: antialiased !important;
        }
        img {
        border: 0 !important;
        outline: none !important;
        }
        p {
        Margin: 0px !important;
        Padding: 0px !important;
        }
        table {
        border-collapse: collapse;
        mso-table-lspace: 0px;
        mso-table-rspace: 0px;
        }
        td, a, span {
        border-collapse: collapse;
        mso-line-height-rule: exactly;
        }
        .ExternalClass * {
        line-height: 100%;
        }
        span.MsoHyperlink {
        mso-style-priority:99;
        color:inherit;}
        span.MsoHyperlinkFollowed {
        mso-style-priority:99;
        color:inherit;}
        </style>
        <style media="only screen and (min-width:481px) and (max-width:599px)" type="text/css">
        @media only screen and (min-width:481px) and (max-width:599px) {
        table[class=em_main_table] {
        width: 100% !important;
        }
        table[class=em_wrapper] {
        width: 100% !important;
        }
        td[class=em_hide], br[class=em_hide] {
        display: none !important;
        }
        img[class=em_full_img] {
        width: 100% !important;
        height: auto !important;
        }
        td[class=em_align_cent] {
        text-align: center !important;
        }
        td[class=em_aside]{
        padding-left:10px !important;
        padding-right:10px !important;
        }
        td[class=em_height]{
        height: 20px !important;
        }
        td[class=em_font]{
        font-size:14px !important;	
        }
        td[class=em_align_cent1] {
        text-align: center !important;
        padding-bottom: 10px !important;
        }
        }
        </style>
        <style media="only screen and (max-width:480px)" type="text/css">
        @media only screen and (max-width:480px) {
        table[class=em_main_table] {
        width: 100% !important;
        }
        table[class=em_wrapper] {
        width: 100% !important;
        }
        td[class=em_hide], br[class=em_hide], span[class=em_hide] {
        display: none !important;
        }
        img[class=em_full_img] {
        width: 100% !important;
        height: auto !important;
        }
        td[class=em_align_cent] {
        text-align: center !important;
        }
        td[class=em_align_cent1] {
        text-align: center !important;
        padding-bottom: 10px !important;
        }
        td[class=em_height]{
        height: 20px !important;
        }
        td[class=em_aside]{
        padding-left:10px !important;
        padding-right:10px !important;
        } 
        td[class=em_font]{
        font-size:14px !important;
        line-height:28px !important;
        }
        span[class=em_br]{
        display:block !important;
        }
        }
        </style>
    </head>
    <body style="margin:0px; padding:0px;" bgcolor="#ffffff">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <!-- === BODY SECTION=== --> 
        <tr>
            <td align="center" valign="top"  bgcolor="#ffffff">
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;">
                <!-- === LOGO SECTION === -->
                <tr>
                <td height="40" class="em_height">&nbsp;</td>
                </tr>
                <tr>
                <td align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://caveshopping.000webhostapp.com/assets/images/logo.png" width="230" height="80" style="display:block;font-family: Arial, sans-serif; font-size:15px; line-height:18px; color:#30373b;  font-weight:bold;" border="0" /></a></td>
                </tr>
                <tr>
                <td height="30" class="em_height">&nbsp;</td>
                </tr>
                
                    <tr>
                        <td height="1" bgcolor="#d8e4f0" style="font-size:0px;line-height:0px;"><hr></td>
                    </tr>
                <!-- === //LOGO SECTION === -->
                <!-- === NEVIGATION SECTION === -->
                <!-- === //NEVIGATION SECTION === -->
                <!-- === IMG WITH TEXT AND COUPEN CODE SECTION === -->
                <tr>
                <td valign="top" class="em_aside">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td height="36" class="em_height">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="middle" align="center"><img src="https://caveshopping.000webhostapp.com/assets/images/activate_account.png" width="333" height="303" alt="WELCOME" style="display:block; font-family:Arial, sans-serif; font-size:25px; line-height:303px; color:#c27cbb;max-width:333px;" class="em_full_img" border="0" /></td>
                    </tr>
                    <tr>
                        <td height="41" class="em_height">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="top" align="center">
                        <table width="210" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                            <td valign="middle" align="center" height="45" bgcolor="#007BFF" style="font-family:'Open Sans', Arial, sans-serif; font-size:17px; font-weight:bold; color:#ffffff; text-transform:uppercase;"><a href="https://caveshopping.000webhostapp.com/coustomer_email_verification.php?coustomer_email_verification=<?PHP echo $otp; ?>" style="color:white;text-decoration:none;">Activate</a></td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="34" class="em_height">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="31" class="em_height">&nbsp;</td>
                    </tr>
                    </table>
                </td>
                </tr>
                <!-- === //IMG WITH TEXT AND COUPEN CODE SECTION === -->
            </table>
            </td>
        </tr>
        <!-- === //BODY SECTION=== -->
        <!-- === FOOTER SECTION ===
        <tr>
            <td align="center" valign="top"  bgcolor="#30373b" class="em_aside">
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;">
                <tr>
                <td height="35" class="em_height">&nbsp;</td>
                </tr>
                <tr>
                <td valign="top" align="center">
                    <table border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/fb.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Fb" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/tw.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Tw" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/pint.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="pint" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/google.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="G+" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/insta.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Insta" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/yt.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Yt" /></a></td>
                    </tr>
                    </table>
                </td>
                </tr>
                <tr>
                <td height="22" class="em_height">&nbsp;</td>
                </tr>
                <tr>
                <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789; text-transform:uppercase;">
                <span style="text-decoration:underline;"><a href="#" target="_blank" style="text-decoration:underline; color:#848789;">PRIVACY STATEMENT</a></span> &nbsp;&nbsp;|&nbsp;&nbsp; <span style="text-decoration:underline;"><a href="#" target="_blank" style="text-decoration:underline; color:#848789;">TERMS OF SERVICE</a></span><span class="em_hide"> &nbsp;&nbsp;|&nbsp;&nbsp; </span><span class="em_br"></span><span style="text-decoration:underline;"><a href="#" target="_blank" style="text-decoration:underline; color:#848789;">RETURNS</a></span>
                </td>
                </tr>
                <tr>
                <td height="10" style="font-size:1px; line-height:1px;">&nbsp;</td>
                </tr>
                <tr>
                <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789;text-transform:uppercase;">
                    &copy;2&zwnj;016 company name. All Rights Reserved.
                </td>
                </tr>
                <tr>
                <td height="10" style="font-size:1px; line-height:1px;">&nbsp;</td>
                </tr>
                <tr>
                <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789;text-transform:uppercase;">
                    If you do not wish to receive any further emails from us, please  <span style="text-decoration:underline;"><a href="#" target="_blank" style="text-decoration:underline; color:#848789;">unsubscribe</a></span>
                </td>
                </tr>
                <tr>
                <td height="35" class="em_height">&nbsp;</td>
                </tr>
            </table>
            </td>
        </tr> -->
        <!-- === //FOOTER SECTION === -->
        </table>
        <div style="display:none; white-space:nowrap; font:20px courier; color:#ffffff; background-color:#ffffff;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
    </body>
    </html>
<?PHP return ob_get_clean(); }

function forgot_pass_email_template($otp){ ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>WELCOME</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
        <meta name="format-detection" content="telephone=no" />
        <!--[if !mso]><!-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!--<![endif]-->
        <style type="text/css">
        body {
        -webkit-text-size-adjust: 100% !important;
        -ms-text-size-adjust: 100% !important;
        -webkit-font-smoothing: antialiased !important;
        }
        img {
        border: 0 !important;
        outline: none !important;
        }
        p {
        Margin: 0px !important;
        Padding: 0px !important;
        }
        table {
        border-collapse: collapse;
        mso-table-lspace: 0px;
        mso-table-rspace: 0px;
        }
        td, a, span {
        border-collapse: collapse;
        mso-line-height-rule: exactly;
        }
        .ExternalClass * {
        line-height: 100%;
        }
        span.MsoHyperlink {
        mso-style-priority:99;
        color:inherit;}
        span.MsoHyperlinkFollowed {
        mso-style-priority:99;
        color:inherit;}
        </style>
        <style media="only screen and (min-width:481px) and (max-width:599px)" type="text/css">
        @media only screen and (min-width:481px) and (max-width:599px) {
        table[class=em_main_table] {
        width: 100% !important;
        }
        table[class=em_wrapper] {
        width: 100% !important;
        }
        td[class=em_hide], br[class=em_hide] {
        display: none !important;
        }
        img[class=em_full_img] {
        width: 100% !important;
        height: auto !important;
        }
        td[class=em_align_cent] {
        text-align: center !important;
        }
        td[class=em_aside]{
        padding-left:10px !important;
        padding-right:10px !important;
        }
        td[class=em_height]{
        height: 20px !important;
        }
        td[class=em_font]{
        font-size:14px !important;	
        }
        td[class=em_align_cent1] {
        text-align: center !important;
        padding-bottom: 10px !important;
        }
        }
        </style>
        <style media="only screen and (max-width:480px)" type="text/css">
        @media only screen and (max-width:480px) {
        table[class=em_main_table] {
        width: 100% !important;
        }
        table[class=em_wrapper] {
        width: 100% !important;
        }
        td[class=em_hide], br[class=em_hide], span[class=em_hide] {
        display: none !important;
        }
        img[class=em_full_img] {
        width: 100% !important;
        height: auto !important;
        }
        td[class=em_align_cent] {
        text-align: center !important;
        }
        td[class=em_align_cent1] {
        text-align: center !important;
        padding-bottom: 10px !important;
        }
        td[class=em_height]{
        height: 20px !important;
        }
        td[class=em_aside]{
        padding-left:10px !important;
        padding-right:10px !important;
        } 
        td[class=em_font]{
        font-size:14px !important;
        line-height:28px !important;
        }
        span[class=em_br]{
        display:block !important;
        }
        }
        </style>
    </head>
    <body style="margin:0px; padding:0px;" bgcolor="#ffffff">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <!-- === BODY SECTION=== --> 
        <tr>
            <td align="center" valign="top"  bgcolor="#ffffff">
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;">
                <!-- === LOGO SECTION === -->
                <tr>
                <td height="40" class="em_height">&nbsp;</td>
                </tr>
                <tr>
                <td align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://caveshopping.000webhostapp.com/assets/images/logo.png" width="230" height="80" style="display:block;font-family: Arial, sans-serif; font-size:15px; line-height:18px; color:#30373b;  font-weight:bold;" border="0" /></a></td>
                </tr>
                <tr>
                <td height="30" class="em_height">&nbsp;</td>
                </tr>
                
                    <tr>
                        <td height="1" bgcolor="#d8e4f0" style="font-size:0px;line-height:0px;"><hr></td>
                    </tr>
                <!-- === //LOGO SECTION === -->
                <!-- === NEVIGATION SECTION === -->
                <!-- === //NEVIGATION SECTION === -->
                <!-- === IMG WITH TEXT AND COUPEN CODE SECTION === -->
                <tr>
                <td valign="top" class="em_aside">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td height="36" class="em_height">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="middle" align="center"><img src="https://caveshopping.000webhostapp.com/assets/images/reset_password.png" width="333" height="303" alt="WELCOME" style="display:block; font-family:Arial, sans-serif; font-size:25px; line-height:303px; color:#c27cbb;max-width:333px;" class="em_full_img" border="0" /></td>
                    </tr>
                    <tr>
                        <td height="41" class="em_height">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="top" align="center">
                        <table width="210" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                            <td valign="middle" align="center" height="45" bgcolor="#007BFF" style="font-family:'Open Sans', Arial, sans-serif; font-size:17px; font-weight:bold; color:#ffffff; text-transform:uppercase;"><a href="https://caveshopping.000webhostapp.com/coustomer_forgot_password_verification.php?coustomer_forgot_password_verification=<?PHP echo $otp; ?>" style="color:white;text-decoration:none;">Reset password</a></td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="34" class="em_height">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="31" class="em_height">&nbsp;</td>
                    </tr>
                    </table>
                </td>
                </tr>
                <!-- === //IMG WITH TEXT AND COUPEN CODE SECTION === -->
            </table>
            </td>
        </tr>
        <!-- === //BODY SECTION=== -->
        <!-- === FOOTER SECTION ===
        <tr>
            <td align="center" valign="top"  bgcolor="#30373b" class="em_aside">
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;">
                <tr>
                <td height="35" class="em_height">&nbsp;</td>
                </tr>
                <tr>
                <td valign="top" align="center">
                    <table border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/fb.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Fb" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/tw.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Tw" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/pint.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="pint" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/google.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="G+" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/insta.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Insta" /></a></td>
                        <td width="7">&nbsp;</td>
                        <td valign="top"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/yt.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Yt" /></a></td>
                    </tr>
                    </table>
                </td>
                </tr>
                <tr>
                <td height="22" class="em_height">&nbsp;</td>
                </tr>
                <tr>
                <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789; text-transform:uppercase;">
                <span style="text-decoration:underline;"><a href="#" target="_blank" style="text-decoration:underline; color:#848789;">PRIVACY STATEMENT</a></span> &nbsp;&nbsp;|&nbsp;&nbsp; <span style="text-decoration:underline;"><a href="#" target="_blank" style="text-decoration:underline; color:#848789;">TERMS OF SERVICE</a></span><span class="em_hide"> &nbsp;&nbsp;|&nbsp;&nbsp; </span><span class="em_br"></span><span style="text-decoration:underline;"><a href="#" target="_blank" style="text-decoration:underline; color:#848789;">RETURNS</a></span>
                </td>
                </tr>
                <tr>
                <td height="10" style="font-size:1px; line-height:1px;">&nbsp;</td>
                </tr>
                <tr>
                <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789;text-transform:uppercase;">
                    &copy;2&zwnj;016 company name. All Rights Reserved.
                </td>
                </tr>
                <tr>
                <td height="10" style="font-size:1px; line-height:1px;">&nbsp;</td>
                </tr>
                <tr>
                <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789;text-transform:uppercase;">
                    If you do not wish to receive any further emails from us, please  <span style="text-decoration:underline;"><a href="#" target="_blank" style="text-decoration:underline; color:#848789;">unsubscribe</a></span>
                </td>
                </tr>
                <tr>
                <td height="35" class="em_height">&nbsp;</td>
                </tr>
            </table>
            </td>
        </tr> -->
        <!-- === //FOOTER SECTION === -->
        </table>
        <div style="display:none; white-space:nowrap; font:20px courier; color:#ffffff; background-color:#ffffff;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
    </body>
    </html>
    <?PHP return ob_get_clean(); }

function shopping_details_Card($cart_id,$user_id,$fname,$lname,$phone,$email,$pinCode,$address){ ob_start(); ?>
<div class="col-lg-12 col-md-12">
                <div class="checkout-step mb-40">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="step">
                                    <div class="line"></div>
                                    <div class="circle">1</div>
                                </div>
                                <span>Order Overview</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                            <div class="step">
                                <div class="line"></div>
                                <div class="circle">2</div>
                            </div>
                            <span>Shipping</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="step">
                                    <div class="line"></div>
                                    <div class="circle">3</div>
                                </div>
                                <span>Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="step">
                                    <div class="line"></div>
                                    <div class="circle">4</div>
                                </div>
                                <span>Order Complete</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 mx-auto">
                <div class="widget">
                    <div class="section-header section-header-center text-center">
                        <h3 class="heading-design-center-h3">
                            Please fill up your Shipping details
                        </h3>
                    </div>
                    <div class="heading-part">
                        <h3 class="sub-heading">Shipping Address</h3>
                    </div>
                    <hr>
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">First Name <span class="required">*</span></label>
                                    <input type="text" name="first_name" value="<?PHP echo $fname; ?>" id="first_name"  class="form-control border-form-control" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name <span class="required">*</span></label>
                                    <input type="text" name="last_name" value<?PHP echo $lname; ?> id="last_name"  class="form-control border-form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Number<span class="required">*</span></label>
                                    <input type="tel" name="phone" value="<?PHP echo $phone; ?>" id="phone"  class="form-control border-form-control" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Alternate Number<span class="required">*</span></label>
                                    <input type="tel" name="alternate_number" value="<?PHP echo $phone; ?>" id="alternate_number"  class="form-control border-form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Email Address <span class="required">*</span></label>
                                    <input type="email" name="email" value="<?PHP echo $email; ?>" id="email"  class="form-control border-form-control" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Pin Code <span class="required">*</span></label>
                                    <input type="number" name="pincode"  min="5" value="<?PHP echo $pinCode; ?>" id="pincode"  class="form-control border-form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Area<span class="required">*</span></label>
                                    <select name="Area" id="Area" class="form-control border-form-control" >
                                        <option value ='null'>------------ Select Area ----------</option>
                                        <?PHP 
                                            $select_areas = "SELECT * FROM `areas`";
                                            $select_areas_sql = mysqli_query($connect,$select_areas);
                                            
                                            while ($areas_row=mysqli_fetch_array($select_areas_sql)) {
                                                echo '<option value ="'.areas_row['name'].'">'.areas_row['name'].'</option>';
                                            }
                                            
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Shipping Address <span class="required">*</span></label>
                                    <input type="text" name="address" value="<?PHP echo $address; ?>" id="address" style="height:5rem;"  class="form-control border-form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="shipping_errors"></p>
                            </div>
                        </div>
                        <input type="button" class="btn btn-theme-round btn-lg pull-right" onclick="Shipping_form_details_submit('<?PHP echo $cart_id; ?>','<?PHP echo $user_id; ?>')" value="NEXT">
                    </form>
                </div>
            </div>
                    
    <?PHP return ob_get_clean(); }

function Payment_method_Card($orders_sno){ ob_start(); ?>
<section class="shopping_cart_page __web-inspector-hide-shortcut__">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="checkout-step mb-40">
                <ul>
                    <li>
                        <a href="#">
                            <div class="step">
                            <div class="line"></div>
                            <div class="circle">1</div>
                            </div>
                            <span>Order Overview</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="step">
                            <div class="line"></div>
                            <div class="circle">2</div>
                            </div>
                            <span>Shipping</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <div class="step">
                            <div class="line"></div>
                            <div class="circle">3</div>
                            </div>
                            <span>Payment</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="step">
                            <div class="line"></div>
                            <div class="circle">4</div>
                            </div>
                            <span>Order Complete</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 mx-auto">
            <div class="widget">
                <div class="section-header section-header-center text-center">
                    <h3 class="heading-design-center-h3">
                    Select a payment method
                    </h3>
                </div>
                <form class="col-lg-8 col-md-8 mx-auto">
                    <div class="payment-menthod text-center">
                        <ul>
                            <li><a class="active" href="#"><i class="icofont icofont-paypal-alt"></i></a>
                            </li>
                            <li><a href="#"><i class="icofont icofont-visa-alt"></i></a>
                            </li>
                            <li><a href="#"><i class="icofont icofont-mastercard-alt"></i></a>
                            </li>
                            <li><a href="#"><i class="icofont icofont-google-wallet-alt-1"></i></a>
                            </li>
                            <li><a href="#"><i class="icofont icofont-american-express-alt"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Card Number</label>
                        <input class="form-control border-form-control" value="" placeholder="0000 0000 0000 0000" type="text">
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Month</label>
                                <input class="form-control border-form-control" value="" placeholder="01" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Year</label>
                                <input class="form-control border-form-control" value="" placeholder="15" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">CVV</label>
                                <input class="form-control border-form-control" value="" placeholder="135" type="text">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label class="custom-control custom-radio">
                        <input id="radioStacked3" name="Cash_on_Delivery" id="Cash_on_Delivery" class="custom-control-input" type="checkbox" onclick="cash_on_delivery('<?PHP echo $orders_sno;?>')">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><strong>Would you like to pay by Cash on Delivery?</strong><p class="Cash_on_Delivery_responce text-primary"></p></span>
                    </label>
                    <input type="button" class="btn btn-theme-round btn-lg pull-right" onclick="Order_complete('<?PHP echo $orders_sno;?>')" value="NEXT">
                </form>
            </div>
        </div>
    </div>
</div>
</section>        
<?PHP return ob_get_clean(); }

function Order_Complete_Card($order_sno){ ob_start(); ?>
<section class="shopping_cart_page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="checkout-step mb-40">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="step">
                                <div class="line"></div>
                                <div class="circle">2</div>
                                </div>
                                <span>Order Overview</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="step">
                                <div class="line"></div>
                                <div class="circle">1</div>
                                </div>
                                <span>Shipping</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="step">
                                <div class="line"></div>
                                <div class="circle">3</div>
                                </div>
                                <span>Payment</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                                <div class="step">
                                <div class="line"></div>
                                <div class="circle">4</div>
                                </div>
                                <span>Order Complete</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 mx-auto">
                <div class="widget">
                    <div class="order-detail-form text-center">
                        <div class="col-lg-10 col-md-10 mx-auto order-done">
                            <i class="icofont icofont-check-circled"></i>
                            <h2 class="text-success">Congrats! Your Order has been Accepted.. (Order No : <?PHP echo $order_sno;?>)<br />
                                Transaction Id :<?PHP echo $order_sno;?>
                            </h2>
                            <p>
                            </p>
                        </div>
                        <div class="cart_navigation text-center">
                            <a href="index.php" class="btn btn-theme-round">Return to store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>      
    <?PHP return ob_get_clean(); }
