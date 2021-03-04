<?php
include 'DB_Connection.php';
include 'components.php';
//------------ Login --------------------
if (isset($_POST['Email_Mobile']) && isset($_POST['Password'])) {
    if ($_POST['Email_Mobile'] !="" && $_POST['Password'] !="") {
        $Email_Mobile = $connect -> real_escape_string($_POST['Email_Mobile']);
        $Password = $connect -> real_escape_string($_POST['Password']);
        $user_details="SELECT * FROM `users` WHERE  `password` ='$Password' AND `email` ='$Email_Mobile' OR `phone` ='$Email_Mobile'";
        $user_details_sql=mysqli_query($connect,$user_details);
        if ($user_details_sql) {
            $user_num_rows=mysqli_num_rows($user_details_sql);
            if ($user_num_rows == 0) {
                echo "* Username or Password is incorrect.";
            }elseif ($user_num_rows > 1){
                echo "* you have multiple accounts.";
            }elseif ($user_num_rows == 1){
                $user_row=mysqli_fetch_array($user_details_sql);
                if ($user_row['category'] == 1) {
                    unset($_SESSION['admin']);
                    $_SESSION['login'] = array(
                        'sno' => $user_row['sno'],
                        'fname' => $user_row['fname'],
                        'lname' => $user_row['lname'],
                        'phone' => $user_row['phone'],
                        'email' => $user_row['email'],
                        'address' => $user_row['address'],
                        'category' => $user_row['category'],
                    );
                    echo "Coustomer";
                }else {
                    unset($_SESSION['login']);
                    echo "Try again";
                }
            }else {
                echo "* Uneven access.";
            }
        }else {
            echo "* Uneven access.";
        }
    }else {
        echo "* All fields must be filed!";
    }
}
//------------ End Login --------------
//------------ My account update --------------
if (isset($_SESSION['login']['sno']) && isset($_POST['my_account_update']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['pincode']) && isset($_POST['address']) ) {
    if ($_POST['my_account_update'] !="" && $_POST['fname'] !="" && $_POST['lname'] !="" && $_POST['phone'] !=""&& $_POST['email'] !="" ) {
        $customer_id = $_SESSION['login']['sno'];
        $fname = $connect -> real_escape_string($_POST['fname']);
        $lname = $connect -> real_escape_string($_POST['lname']);
        $phone = $connect -> real_escape_string($_POST['phone']);
        $email = $connect -> real_escape_string($_POST['email']);
        $update_profile ="UPDATE `users` SET `fname`='$fname',`lname`='$lname',`phone`='$phone',`email`='$email'
        ";
        if ($_POST['pincode'] !="") {
            $pincode = $_POST['pincode'];
            $update_profile .="
                ,`pincode`='$pincode'
            ";
        }
        if ($_POST['address'] !="") {
            $address = $_POST['address'];
            $update_profile .="
                ,`address`='$address'
            ";
        }
        if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
            if ($_POST['old_password'] !="" && $_POST['new_password'] !="" && $_POST['confirm_password'] !="") {
                $old_password = $connect -> real_escape_string($_POST['old_password']);
                $new_password = $connect -> real_escape_string($_POST['new_password']);
                $confirm_password = $connect -> real_escape_string($_POST['confirm_password']);
                if ($new_password != $confirm_password) {
                    echo "New password and confirm password should be same-";
                } else {
                    $select_user=mysqli_query($connect,"SELECT * FROM `users` WHERE `sno` = '$customer_id'");
                    $select_user_num_rows=mysqli_num_rows($select_user);
                    if ($select_user_num_rows == '1') {
                        $select_user_row=mysqli_fetch_array($select_user);
                        if ($old_password == $select_user_row['password']) {
                            $update_profile .="
                                ,`users`.`password`='$confirm_password'
                            ";
                        } else { 
                            echo "Old password is incorrect-";
                        }
                    }
                } 
            }
        }
        $update_profile .="WHERE `sno` = '$customer_id'
        ";
        $update_profile_sql = mysqli_query($connect,$update_profile);
        if ($update_profile_sql) {
            echo "Profile updated";
        } else {
            echo "failed!";
        }
    } else {
        echo "*all fields must be filled!";
    }
}
//------------ End My account update --------------
//------------ Register --------------
if (isset($_POST['username']) && isset($_POST['Password']) && isset($_POST['Confirm_Password']) && isset($_POST['Customer_Register'])) {
    if ($_POST['username'] != "" && $_POST['Password'] != "" && $_POST['Confirm_Password'] != "") {
        $username = $connect -> real_escape_string($_POST['username']);
        $Password = $connect -> real_escape_string($_POST['Password']);
        $Confirm_Password = $connect -> real_escape_string($_POST['Confirm_Password']);
        if ($Confirm_Password != $Password) {
            echo "password and confirm password should be same";
        }elseif (strlen($Password) < 8) {
            echo strlen($Password)."Password contains at least 8 distinct";
        }else {
            $select_users=mysqli_query($connect,"SELECT * FROM `users` WHERE `users`.`phone` = '$username' OR `users`.`email` = '$username'");
            $select_users_no_rows =  mysqli_num_rows($select_users);
            if ($select_users_no_rows == 0) {
                # OTP 
                $OTP = md5(time().$username);
                $insert_user = mysqli_query($connect,"INSERT INTO `users` (`phone`, `email`,`category`, `password`,`otp`, `verified`) VALUES ('$username','$username','1','$Password','$OTP','0')");
                if ($insert_user) {

                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        $to = $username;
                        $subject = 'Verification Email';
                        $from ='g.jayachandramohan@gmail.com';
                        // To send HTML mail, the Content-type header must be set
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        // Create email headers
                        $headers .= 'From: '.$from."\r\n".
                            'Reply-To: '.$from."\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                        // Compose a simple HTML email message
                        $body = account_activate_email_template($OTP);
                        if (mail($to,$subject,$body,$headers)) {
                            echo "you registered successfully,activation link will send to your email";
                        } else {
                            echo "Failed send verification email,Contact us";
                        }
                    } elseif (preg_match('/^[0-9]{3}[0-9]{3}[0-9]{4}$/',$username)) {
                        echo "phone number";
                    } else {
                        echo " Invalid email address or phone number";
                    }
                }else {
                    echo "Registration failed,try again";
                }
            }else {
                echo "You already have an account!";
            }
        }
    } else {
        echo "* All fields must be filed!";
    }
}
//------------ End Register --------------
//------------  Forgot Pass--------------
if (isset($_POST['Forgot_Email_Mobile'])) {
    if ($_POST['Forgot_Email_Mobile'] !="") {
        $username = $connect -> real_escape_string($_POST['Forgot_Email_Mobile']);        
        $select_users=mysqli_query($connect,"SELECT * FROM `users` WHERE `users`.`phone` = '$username' OR `users`.`email` = '$username'");
        $select_users_no_rows =  mysqli_num_rows($select_users);
        if ($select_users_no_rows != 0) {
            # OTP 
            $OTP = md5(time().$username);
            $insert_user = mysqli_query($connect,"UPDATE `users` SET `otp`='$OTP' WHERE `users`.`phone` = '$username' OR `users`.`email` = '$username'");
            if ($insert_user) {
                if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        $to = $username;
                        $subject = 'Forgot Password';
                        $from ='g.jayachandramohan@gmail.com';
                        // To send HTML mail, the Content-type header must be set
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        // Create email headers
                        $headers .= 'From: '.$from."\r\n".
                            'Reply-To: '.$from."\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                        // Compose a simple HTML email message
                        $body = forgot_pass_email_template($OTP);
                        if (mail($to,$subject,$body,$headers)) {
                            echo "Reset password link will send to your email";
                        } else {
                            echo "Failed send verification email,Contact us";
                        }
                } elseif (preg_match('/^[0-9]{3}[0-9]{3}[0-9]{4}$/', $username)) {
                    echo "phone number";
                } else {
                    echo "Invalid email address or phone number";
                }
            }else {
                    echo $connect->error."failed,try again";
            }
        }else{
            echo "Invalid email address or phone number";
        }
        
    } else {
        echo "Enter a valid email address or phone number";
    } 
}
//------------ End Forgot Pass --------------
if (isset($_POST['action'])) {
    $select_product ="SELECT * FROM `products` WHERE `products`.`status` = '1'";
    if (isset($_POST['cities'])) {
        $cities_filter=implode("','",$_POST['cities']);
        $select_product .="AND `city` IN(' ".$cities_filter." ')";
    }
    if (isset($_POST['categories'])) {
        $categories_filter=implode("','",$_POST['categories']);
        $select_product .="AND `category` IN(' ".$categories_filter." ')";
    }
    if (isset($_POST['gender'])) {
        $gender_filter=implode("','",$_POST['gender']);
        $select_product .="AND `products`.`gender` IN('".$gender_filter."')";
    }
    if (isset($_POST['material'])) {
        $material_filter=implode("','",$_POST['material']);
        $select_product .="AND `material` IN('".$material_filter."')";
    }
    if (isset($_POST['search_text']) && $_POST['search_text'] !="" ) {
        $search_text=$_POST['search_text'];
        $select_product  .=" AND `name` LIKE '%$search_text%' OR `description` LIKE '%$search_text%' OR  `material` LIKE '%$search_text%'  OR `gender` LIKE '%$search_text%'OR `size` LIKE '%$search_text%' ";
    }

    if (isset($_POST['low_hight_Price'])) {
        $low_hight_Price=implode("','",$_POST['low_hight_Price']);
        if ($low_hight_Price == "Low") {
            $select_product .=" ORDER BY `products`.`cost` ASC";
        }elseif($low_hight_Price == "High"){
            $select_product .="ORDER BY `products`.`cost` DESC";
        }
    }
    $output =" ";
    $select_product_result=mysqli_query($connect,$select_product);
    $num_row = mysqli_num_rows($select_product_result);
        if ($num_row > 0) {
            while ($product_row=mysqli_fetch_array($select_product_result)) {
            $output .=category_card();
        }
    }else{
        $output .="<h4 class='text-center text-danger'> <i class='fas fa-frown'></i>  No data found</h4>";
    }
    echo $output;
    exit;
}
if (isset($_POST['filter_sub_category'])) {
    $material_filter=implode("','",$_POST['filter_sub_category']);
    $select_category_sql=mysqli_query($connect,"SELECT * FROM `subcategories` WHERE `category` IN ('$material_filter') ORDER BY `subcategories`.`sno` ASC");
    while ($select_category_row=mysqli_fetch_array($select_category_sql)) { ?>
        <li>
            <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input type="checkbox" class="custom-control-input common_selector SubCategories" value="<?PHP echo $select_category_row['sno'];?>" id="SubCategoriesCheck<?PHP echo $select_category_row['sno'] ?>">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description" for="SubCategoriesCheck<?PHP echo $select_category_row['sno'] ?>"><?PHP echo $select_category_row['name'];?></span>
            </label>
        </li>
    <?PHP } 
}

if (isset($_POST['add_to_wishlist']) && isset($_POST['product_id'])) {
    if (isset($_SESSION['login']['sno'])) {
        if ($_POST['add_to_wishlist'] !="" && $_POST['product_id'] !="") {
            $product_id = $_POST['product_id'];
            $customer = $_SESSION['login']['sno'];
            $select_wl=mysqli_query($connect,"SELECT * FROM `wishlist` WHERE `product` = '$product_id' AND `customer` = '$customer'");
            if (mysqli_num_rows($select_wl) == 0) {
                $add_to_wl = mysqli_query($connect,"INSERT INTO `wishlist`(`product`, `customer`) VALUES ('$product_id','$customer')");
                if ($add_to_wl) {
                    echo "Product added to wishlist successfully";
                } else {
                    echo "Product added to wishlist faild";
                }
            }else {
                echo "Products already added to your wishlist";
            }
        } else {
            echo "All fields must be filled!";
        }
    } else {
        echo "*Please login first!";
    }   
}

if (isset($_POST['Ajax_my_wishlist_data_responce']) && isset($_SESSION['login']['sno'])) {
    $customer = $_SESSION['login']['sno'];
    $select_wl=mysqli_query($connect,"SELECT * FROM `wishlist` WHERE `customer` = '$customer' ");
    $select_wl_num_rows=mysqli_num_rows($select_wl);
    while ($select_wl_row=mysqli_fetch_array($select_wl)) { 
        $product = $select_wl_row['product'];
        $select_wl_product=mysqli_query($connect,"SELECT * FROM `products` WHERE `products`.`sno` = '$product'");
        $select_wl_product_row=mysqli_fetch_array($select_wl_product);
        $output = my_wishlist_Product_Card($select_wl_product_row['sno'],$select_wl_product_row['name'],$select_wl_product_row['cost'],$select_wl_product_row['image']);
        echo $output;
    } 
}
if (isset($_POST['remove_from_wishlist']) && isset($_POST['product_id'])) {
    if (isset($_SESSION['login']['sno'])) {
        if ($_POST['remove_from_wishlist'] !="" && $_POST['product_id'] !="") {
            $product_id = $_POST['product_id'];
            $customer = $_SESSION['login']['sno'];
                $add_to_wl = mysqli_query($connect,"DELETE FROM `wishlist`WHERE `product` = '$product_id' AND `customer` = '$customer'");
                if ($add_to_wl) {
                    echo "Product removed from wishlist";
                } else {
                    echo "Product not removed from wishlist";
                }
        } else {
            echo "all fields must be filled!";
        }
    } else {
        echo " Please login first!";
    }   
}
if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
    if (isset($_SESSION['login']['sno'])) {
        if ($_POST['add_to_cart'] !="" && $_POST['product_id'] !="") {
            $product_id = $_POST['product_id'];
            $customer = $_SESSION['login']['sno'];
            $select_cart=mysqli_query($connect,"SELECT * FROM `cart` WHERE `product` = '$product_id' AND `customer` = '$customer'");
            if (mysqli_num_rows($select_cart) == 0) {
                $add_to_cart = mysqli_query($connect,"INSERT INTO `cart`(`product`, `customer`,`quantity`) VALUES ('$product_id','$customer','1')");
                if ($add_to_cart) {
                    echo "Product added to cart successfully";
                } else {
                    echo "Product added to cart faild";
                }
            }else {
                echo "Products already added to your cart";
            }
        } else {
            echo "*All fields must be filled!";
        }
    } else {
        echo "Please login first!";
    }   
}

if (isset($_POST['Ajax_my_cart_data_responce']) && isset($_SESSION['login']['sno'])) {
    $customer = $_SESSION['login']['sno'];
    $select_cart=mysqli_query($connect,"SELECT * FROM `cart` WHERE `customer` = '$customer'");
    $select_cart_num_rows=mysqli_num_rows($select_cart);
    while ($select_cart_row=mysqli_fetch_array($select_cart)) { 
        $product = $select_cart_row['product'];
        $select_cart_product=mysqli_query($connect,"SELECT * FROM `products` WHERE `products`.`sno` = '$product'");
        $select_cart_product_row=mysqli_fetch_array($select_cart_product);
        $output = my_cart_Product_Card($select_cart_product_row['sno'],$select_cart_product_row['name'],$select_cart_product_row['cost'],$select_cart_product_row['image'],$select_cart_product_row['quantity'],$select_cart_row['sno'],$select_cart_row['quantity']);
        echo $output;
    } 
}

if (isset($_POST['remove_from_cart']) && isset($_POST['product_id'])) {
    if (isset($_SESSION['login']['sno'])) {
        if ($_POST['remove_from_cart'] !="" && $_POST['product_id'] !="") {
            $product_id = $_POST['product_id'];
            $customer = $_SESSION['login']['sno'];
                $add_to_wl = mysqli_query($connect,"DELETE FROM `cart` WHERE `product` = '$product_id' AND `customer` = '$customer'");
                if ($add_to_wl) {
                    echo "Product removed from cart";
                } else {
                    echo "Product not removed from cart";
                }
        } else {
            echo "*All fields must be filled!";
        }
    } else {
        echo "Please login first!";
    }   
}

if (isset($_POST['product_id']) && isset($_POST['product_details_data'])) {
    if ($_POST['product_id'] !="" && $_POST['product_details_data'] !="") {
        $product_id = $_POST['product_id'];
        $select_product = mysqli_query($connect,"SELECT * FROM `products` WHERE `sno` = '$product_id'");
        $select_product_row = mysqli_fetch_array($select_product);
        $category = $select_product_row['category'];
        $subCategory = $select_product_row['subCategory'];
        $select_category = mysqli_query($connect,"SELECT * FROM `categories` WHERE `categories`.`sno` = '$category'");
        $select_category_row = mysqli_fetch_array($select_category);
        $category_sno = $select_category_row['sno'];
        $select_subCategory = mysqli_query($connect,"SELECT * FROM `subcategories` WHERE`subcategories`.`category` AND `subcategories`.`sno` = '$product_id'");
        $select_subCategory_row = mysqli_fetch_array($select_subCategory);
        echo Product_details_Card($select_product_row['sno'],$select_product_row['name'],$select_product_row['description'],$select_product_row['cost'],$select_product_row['material'],$select_product_row['size'],$select_product_row['gender'],$select_product_row['image'],$select_product_row['quantity'],$select_category_row['name'],$select_subCategory_row['name']);
    } else {
        echo "all fields must be filled!";
    }
}
if (isset($_POST['cart_valu']) && isset($_POST['cart_id']) && isset($_SESSION['login']['sno'])) {
    $cart_valu = $_POST['cart_valu'];
    $cart_id = $_POST['cart_id'];
    if ($cart_valu <= 0) {
        $cart_valu =1;
    }
    $update_quantity = mysqli_query($connect,"UPDATE `cart` SET `quantity` = '$cart_valu' WHERE `sno` ='$cart_id'");
    if ($update_quantity) {
        echo "quantity updated";
    }else {
        echo "quantity update failed";
    }
}

if (isset($_POST['cart_id']) && isset($_POST['Ajax_Shipping_form']) && isset($_SESSION['login']['sno'])) {
    if ($_POST['cart_id'] !="") {
        $cart_id = $_POST['cart_id'];
        $user_id = $_SESSION['login']['sno'];
        $select_users=mysqli_query($connect,"SELECT * FROM `users` WHERE `users`.`sno` = '$user_id'");
        $select_users_row =  mysqli_fetch_array($select_users);
        echo shopping_details_Card($cart_id,$user_id,$select_users_row['fname'],$select_users_row['lname'],$select_users_row['phone'],$select_users_row['email'],$select_users_row['pincode'],$select_users_row['address']);
    } else {
        echo " All fields must be filled!";
    }
}
if (isset($_POST['cart_id']) && isset($_POST['user_id']) && isset($_SESSION['login']['sno']) && isset($_POST['first_name'])&& isset($_POST['last_name'])&& isset($_POST['phone'])&& isset($_POST['alternate_number'])&& isset($_POST['email'])&& isset($_POST['pincode'])&& isset($_POST['address']) && isset($_POST['Shipping_form_details'])  && isset($_POST['Area'])) {
    if ($_POST['cart_id'] != "" && $_POST['user_id'] != "" && $_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['phone'] != "" && $_POST['alternate_number'] != "" && $_POST['email'] != "" && $_POST['pincode'] != "" && $_POST['address'] != "" && $_POST['Shipping_form_details'] != "" && $_POST['Area'] != "") {
        $cart_id = $connect -> real_escape_string($_POST['cart_id']);   
        $user_id = $connect -> real_escape_string($_POST['user_id']);   
        $coustomer_id = $_SESSION['login']['sno'];
        $first_name = $connect -> real_escape_string($_POST['first_name']);   
        $last_name = $connect -> real_escape_string($_POST['last_name']);   
        $phone = $connect -> real_escape_string($_POST['phone']);   
        $alternate_number = $connect -> real_escape_string($_POST['alternate_number']);   
        $email = $connect -> real_escape_string($_POST['email']);   
        $pincode = $connect -> real_escape_string($_POST['pincode']);   
        $address = $connect -> real_escape_string($_POST['address']);   
        $address = $connect -> real_escape_string($_POST['address']); 
        $select_cart_details = mysqli_query($connect,"SELECT * FROM `cart` WHERE `sno` = '$cart_id'");
        $select_cart_details_row = mysqli_fetch_array($select_cart_details);
        $product_id = $select_cart_details_row['product'];
        $product_quantity = $select_cart_details_row['quantity'];
        $select_product_details = mysqli_query($connect,"SELECT * FROM `products` WHERE `sno` = '$product_id'");
        $select_product_details_row = mysqli_fetch_array($select_product_details);
        $product_cost = $select_product_details_row ['cost'];
        date_default_timezone_set('Asia/Kolkata');
        $order_date = date('Y-m-d H:i:s');
        $total_amount = 40 + ($product_cost * $product_quantity);
        $delivery_status = "PENDING";
        $product_insert = mysqli_query($connect,"INSERT INTO `orders`(`fname`, `lname`, `number`, `alt_number`, `email`, `pincode`, `address`, `coustomer_sno`, `product_sno`, `product_quantity`, `payment_method`, `payment_status`, `delivery_charges`, `total_amount`, `delivery_status`, `order_date`,`transaction_id`)  VALUES ('$first_name','$last_name','$phone','$alternate_number','$email','$pincode','$address','$coustomer_id','$product_id','$product_quantity','0','Pending','40','$total_amount','In Progress','$order_date','0000000000')");
        if ($product_insert) {
            $select_orders = mysqli_query($connect,"SELECT * FROM `orders` WHERE `coustomer_sno`= '$coustomer_id' AND `product_sno`= '$product_id' AND `order_date` = '$order_date'");
            $select_orders_rows = mysqli_fetch_array($select_orders);
            echo Payment_method_Card($select_orders_rows['sno']);
        } else {
            echo "try again";
        }
    } else {
        echo " All fields must be filled!";
    }
}

if (isset($_POST['Cash_on_Delivery']) && isset($_POST['orders_sno'])) {
    if ($_POST['Cash_on_Delivery'] !="" && $_POST['orders_sno'] != "") {
        $orders_sno  = $_POST['orders_sno'];
        $select_orders = mysqli_query($connect,"SELECT * FROM `orders` WHERE `sno`= '$orders_sno'");
        $select_orders_rows = mysqli_fetch_array($select_orders);
        if ($select_orders_rows['payment_method'] == 0) {
            $payment_method  = 1;
            $payment_method_responce = "COD selected";
        } else {
            $payment_method  = 0;
            $payment_method_responce = "COD deselected";
        }        
        $update_cod = mysqli_query($connect,"UPDATE `orders` SET `payment_method` = '$payment_method' WHERE `orders`.`sno` = '$orders_sno' ");
        if ($update_cod) {
            echo $payment_method_responce;
        } else {
            echo "try again";
        }
    } else {
        echo "All fields must be filled!";
    } 
}

if (isset($_POST['order_sno']) && isset($_POST['complete_Order'])) {
    if ($_POST['order_sno'] !="" && $_POST['complete_Order'] != "") {
        $orders_sno  = $_POST['order_sno'];
        $select_orders = mysqli_query($connect,"SELECT * FROM `orders` WHERE `sno`= '$orders_sno'");
        $select_orders_rows = mysqli_fetch_array($select_orders);
        $out_put = Order_Complete_Card($select_orders_rows['sno']);
        echo $out_put;
    } else {
        echo "All fields must be filled!";
    } 
}

if (isset($_POST['my_orders_data']) && isset($_SESSION['login']['sno'])) {
    if ($_SESSION['login']['sno'] !="") {
        $user_sno = $_SESSION['login']['sno'];
        $select_orders=mysqli_query($connect,"SELECT * FROM `orders` WHERE `coustomer_sno` = '$user_sno' AND `payment_method` != 0");
        while ($orders_row = mysqli_fetch_array($select_orders)) { ?>
            <tr>
                <td><?PHP echo date('Y').$orders_row['sno']; ?></td>
                <td><?PHP echo $orders_row['order_date']; ?></td>
                <td><?PHP echo $orders_row['delivery_status']; ?></td>
                <td><?PHP echo 	$orders_row['total_amount']; ?></td>
                <td><a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="View Detail" class="btn btn-theme-round btn-sm"><i class="icofont icofont-eye-alt"></i></a></td>
            </tr>
        <?PHP }
    } else {
        echo "All fields must be filled!";
    } 
}
