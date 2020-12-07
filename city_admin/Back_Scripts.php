<?php
include '../DB_Connection.php';
session_start();
if (!isset($_SESSION['admin']) && $_SESSION['admin']['category'] != 3) {
    header('location:../logout.php');
}

if(isset($_SESSION['admin']['sno']) && isset($_POST['update_fname']) && isset($_POST['update_lname']) && isset($_POST['update_email']) && isset($_POST['update_phone']) && isset($_POST['update_address'])){
    if ($_POST['update_fname'] !="" && $_POST['update_lname'] !="" && $_POST['update_email'] !="" && $_POST['update_phone'] !="" && $_POST['update_address'] !="") {
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_phone = $_POST['update_phone'];
        $update_address = $_POST['update_address'];
        $user_sno= $_SESSION['admin']['sno'];
        $user_details="SELECT * FROM `users` WHERE `sno` = '$user_sno'";
        $user_details_sql=mysqli_query($connect,$user_details);
        $user_row=mysqli_fetch_array($user_details_sql);
        $update_user="UPDATE `users` SET `fname`='$update_fname',`lname`='$update_lname',`phone`='$update_phone',`email`='$update_email',`address`='$update_address' WHERE `users`.`sno` ='$user_sno'";
        $update_user_sql=mysqli_query($connect,$update_user);
        if ($update_user_sql) {
            $_SESSION['admin'] = array(
                'sno' => $user_row['sno'],
                'fname' => $update_fname,
                'lname' => $update_lname,
                'phone' => $update_phone,
                'email' => $update_email,
                'address' => $update_address,
                'category' => $user_row['category'],
            );
            echo "User details updated successfully.";
        } else {
            echo " Faild try again!";
        }
    } else {
        echo " Enter category";
    }
}
if(isset($_POST['Old_Password']) && isset($_POST['New_Password']) && isset($_POST['Confirm_Password']) && isset($_SESSION['admin'])){
    if ($_POST['Old_Password'] !="" && $_POST['New_Password'] !="" && $_POST['Confirm_Password'] !="" ) {
        $Old_Password = $_POST['Old_Password'];
        $New_Password = $_POST['New_Password'];
        $Confirm_Password = $_POST['Confirm_Password'];
        if ($New_Password == $Confirm_Password) {
            $user_sno=$_SESSION['admin']['sno'];
            $admin = "SELECT * FROM  `users` WHERE `users`.`sno` ='$user_sno'";
            $admin_sql = mysqli_query($connect,$admin);
            $admin_row=mysqli_fetch_array($admin_sql);
            if ($Old_Password == $admin_row['password']) {
                $update_password="UPDATE `users` SET `password`='$Confirm_Password' WHERE `users`.`sno` ='$user_sno'";
                $update_password_sql=mysqli_query($connect,$update_password);
                if ($update_password_sql) {
                    echo "Password updated successfully.";
                } else {
                    echo "*Faild try again!";
                }
            }else {
                echo "Old password is incorrect!";
            }
        } else {
            echo "New password and confirm password should be same";
        }
    } else {
        echo "Enter category";
    }
}

if(isset($_POST['category']) && !isset($_POST['sub_category'])){
    if ($_POST['category'] !="") {
        $category = $_POST['category'];
        $categories_select="SELECT * FROM `categories` WHERE `name` = '$category'";
        $categories_sql=mysqli_query($connect,$categories_select);
        $categories_num_row=mysqli_num_rows($categories_sql);
        if ($categories_num_row >=1) {
            echo "Category already exists";
        } else {
            $category_inter="INSERT INTO `categories`(`name`) VALUES ('$category')";
            $category_sql=mysqli_query($connect,$category_inter);
            if ($category_sql) {
                echo "category added successfully.";
            } else {
                echo "*Faild try again!";
            }
        }
    } else {
        echo "Enter category";
    }
}
if(isset($_POST['category']) && isset($_POST['sub_category'])){
    if ($_POST['category'] !="" && $_POST['sub_category'] !="") {
        $category = $_POST['category'];
        $sub_category = $_POST['sub_category'];
        $categories_select="SELECT * FROM `subcategories` WHERE `name` = '$sub_category' AND `category` = '$category' ";
        $categories_sql=mysqli_query($connect,$categories_select);
        $categories_num_row=mysqli_num_rows($categories_sql);
        if ($categories_num_row >= 1) {
            echo "Sub Category already exists";
        } else {
            $category_inter="INSERT INTO `subcategories` (`name`, `category`) VALUES ('$sub_category','$category')";
            $category_sql=mysqli_query($connect,$category_inter);
            if ($category_sql) {
                echo "Sub category added successfully.";
            } else {
                echo " Faild try again!";
            }
        }
    } else {
        echo "Enter Sub category";
    }
}
if (isset($_SESSION['admin']['sno']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['address']) ) {
    if ($_POST['fname'] !="" && $_POST['lname'] !="" && $_POST['email'] !="" && $_POST['phone'] !="" && $_POST['password'] !="" && $_POST['address'] !="")  {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $user_city_sno  = $_SESSION['admin']['sno'];
        $select_city = "SELECT * FROM `cities` WHERE `admin` = '$user_city_sno '";
        $select_city_sql=mysqli_query($connect,$select_city);
        $select_city_row=mysqli_fetch_array($select_city_sql);
        $select_city_num_row=mysqli_num_rows($select_city_sql);
        if($select_city_num_row == 1 ){
            $seller_dt_ins="INSERT INTO `users`(`fname`, `lname`, `phone`, `email`, `address`, `category`, `password`, `otp`, `verified`) VALUES ('$fname','$lname','$phone','$email','$address','2','$password','0000','1')";
            $seller_dt_ins_sql=mysqli_query($connect,$seller_dt_ins);
            if ($seller_dt_ins_sql) {
                $user_query = "SELECT * FROM  `users` WHERE `email`='$email' AND `password`='$password'";
                $user_sql = mysqli_query($connect,$user_query);
                $user_row=mysqli_fetch_array($user_sql);
                $sno_num=$user_row['sno'];
                $city_sno =$select_city_row['sno'];
                $seller_insert="INSERT INTO `sellers`(`name`, `city`,`status`) VALUES ('$sno_num','$city_sno','1')";
                $seller_insert_sql=mysqli_query($connect,$seller_insert);
                if ($seller_insert_sql) {
                    echo "Seller added successfully.";
                } else {
                    echo "Faild try again!";
                }
                
            } else {
                echo "Faild try again!";
            }
        }else {
            echo "City Admin Error!";
        }  
    } else {
        echo "All fields must be filed";
    }
}
if (isset($_POST['chageProductStatus']) && isset($_POST['productId'])) {
    if ($_POST['productId'] !="" && $_POST['chageProductStatus'] !="") {
        $productId = $_POST['productId'];
        $select_product= "SELECT * FROM  `products` WHERE `products`.`sno` = '$productId'";
		$select_product_sql = mysqli_query($connect,$select_product);
        $select_product_row=mysqli_fetch_array($select_product_sql);
        if ($select_product_row['status'] == 1) {
            $product_statu=0;
            $product_statu_result="Disabled";
        } else {
            $product_statu=1;
            $product_statu_result="Enabled ";
        }
        $update_product_status="UPDATE `products` SET `status` ='$product_statu' WHERE `products`.`sno` = '$productId'";
        $update_product_status_sql = mysqli_query($connect,$update_product_status);
        if ($update_product_status_sql) {
            echo $product_statu_result;
        }else {
            echo "Failed";
        }
    } else {
        echo "*All fields must be filed";
    }
}

if (isset($_POST['sellerId']) && isset($_POST['sellerStatus'])) {
    if ($_POST['sellerId'] !="" && $_POST['sellerStatus'] !="") {
        $sellerId = $_POST['sellerId'];
        $select_seller= "SELECT * FROM  `sellers` WHERE `sellers`.`sno` = '$sellerId'";
		$select_seller_sql = mysqli_query($connect,$select_seller);
        $select_seller_row=mysqli_fetch_array($select_seller_sql);
        $seller_sno = $select_seller_row['name'];
        if ($select_seller_row['status'] == 1) {
            $seller_status= 0;
            $seller_status_result="Disabled";
        }else {
            $seller_status= 1;
            $seller_status_result="Enabled ";
        }
        $seller_status_update="UPDATE `sellers` SET `sellers`.`status` ='$seller_status' WHERE `sno` = '$sellerId'";
        $seller_status_update = mysqli_query($connect,$seller_status_update);
        $seller_user_status_update="UPDATE `users` SET `users`.`verified` ='$seller_status' WHERE `sno` = '$seller_sno'";
        $seller_user_status_update_sql = mysqli_query($connect,$seller_user_status_update);
        if ($seller_status_update || $seller_user_status_update_sql) {
            $product_status_update="UPDATE `products` SET `status` ='$seller_status' WHERE `seller` = '$sellerId'";
            $product_status_update_sql = mysqli_query($connect,$product_status_update)or die(mysqli_error());
            echo"$seller_status_result";
        }
    } else {
        echo "*All fields must be filed";
    }
}