<?php
include '../DB_Connection.php';
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin']['category'] != 4) {
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

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['city'])&& isset($_POST['password'])){
    if ($_POST['fname'] !="" && $_POST['lname'] !="" && $_POST['email'] !="" && $_POST['phone'] !="" && $_POST['address'] !="" && $_POST['city'] !=""&& $_POST['password'] !="") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $password = $_POST['password'];
        $city_user_inter="INSERT INTO `users`(`fname`, `lname`, `phone`, `email`, `address`, `category`, `password`, `otp`, `verified`) VALUES ('$fname','$lname','$phone','$email','$address','3','$password','0000','1')";
        $city_user_sql=mysqli_query($connect,$city_user_inter);
        if ($city_user_sql) {
            $user_query = "SELECT * FROM  `users` WHERE `email`='$email' AND `password`='$password'";
			$user_sql = mysqli_query($connect,$user_query);
			$user_row=mysqli_fetch_array($user_sql);
			$sno_num=$user_row['sno'];
            $city_insert="INSERT INTO `cities`(`name`, `admin`, `status`) VALUES ('$city','$sno_num','1')";
            $user_sql = mysqli_query($connect,$city_insert);
            if ($user_sql) {
                echo "City admin added successfully.";
            } else {
                $user_delete="DELETE FROM `users` WHERE `email`='$email' AND `password`='$password'";
                $user_delete = mysqli_query($connect,$user_delete);
                echo "Faild try again!!";
            }
        } else {
            echo "Faild try again!";
        }
    } else {
        echo "*All fields must be filed";
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

if (isset($_POST['cityId']) && isset($_POST['cityadminStatus'])) {
    if ($_POST['cityId'] !="" && $_POST['cityadminStatus'] !="") {
        $cityId  = $_POST['cityId'];
        $select_city= "SELECT * FROM  `cities` WHERE `cities`.`sno` = '$cityId '";
		$select_city_sql = mysqli_query($connect,$select_city);
        $select_city_row=mysqli_fetch_array($select_city_sql);
        $cityadmin_sno = $select_city_row['admin'];
        if ($select_city_row['status'] == 1) {
            $city_status= 0;
            $city_status_result="Disabled";
        }else {
            $city_status= 1;
            $city_status_result="Enabled ";
        }
            $city_status_update="UPDATE `cities` SET `cities`.`status` ='$city_status' WHERE `sno` = '$cityId'";
            $city_status_update = mysqli_query($connect,$city_status_update);
            $city_user_status_update="UPDATE `users` SET `users`.`verified` ='$city_status' WHERE `sno` = '$cityadmin_sno'";
            $city_user_status_update_sql = mysqli_query($connect,$city_user_status_update);
            if ($city_status_update || $city_user_status_update_sql) {
                $select_sellers= "SELECT * FROM  `sellers` WHERE `sellers`.`city` = '$cityId '";
                $select_sellers_sql = mysqli_query($connect,$select_sellers);
                while ($select_sellers_row=mysqli_fetch_array($select_sellers_sql)) {
                    $seller_no = $select_sellers_row['sno'];
                    $product_status_update="UPDATE `products` SET `status` ='$city_status' WHERE `seller` = '$seller_no'";
                    $product_status_update_sql = mysqli_query($connect,$product_status_update)or die(mysqli_error());
                    $user_sno=$select_sellers_row['name'];
                    $seller_status_update="UPDATE `sellers` SET `status` ='$city_status' WHERE `city` = '$cityId'";
                    $seller_status_update = mysqli_query($connect,$seller_status_update)or die(mysqli_error());
                    $user_status_update="UPDATE `users` SET `users`.`verified` ='$city_status' WHERE `sno` = '$user_sno'";
                    $user_status_update = mysqli_query($connect,$user_status_update)or die(mysqli_error());
                    if ($seller_status_update || $user_status_update) {
                        echo $city_status_result;
                    } else {
                        echo "Failed";
                    }   
                }
            } else {
                echo "Failed";
            }
    } else {
        echo "All fields must be filed";
    }
}

if (isset($_POST['cityId']) && isset($_POST['deltecity'])) {
    if ($_POST['cityId'] !="" && $_POST['deltecity'] !="") {
        $cityId  = $_POST['cityId'];
        $select_city= "SELECT * FROM  `cities` WHERE `cities`.`sno` = '$cityId '";
		$select_city_sql = mysqli_query($connect,$select_city);
        $select_city_row=mysqli_fetch_array($select_city_sql);
        $delete_products="DELETE FROM `cities` WHERE `cities`.`sno` = '$cityId'";
        $delete_products_sql = mysqli_query($connect,$delete_products);
        if ($delete_products_sql) {
            $city_admin_sno = $select_city_row['admin'];
            $city_user="DELETE FROM `users` WHERE `users`.`sno` = '$city_admin_sno'";
            $city_user_sql = mysqli_query($connect,$city_user);
            $select_sellers= "SELECT * FROM  `sellers` WHERE `sellers`.`city` = '$cityId '";
            $select_sellers_sql = mysqli_query($connect,$select_sellers)or die(mysqli_error());
            while ($select_sellers_row=mysqli_fetch_array($select_sellers_sql)) {
                $sellers_sno = $select_sellers_row['sno'];
                $select_products= "SELECT * FROM  `products` WHERE `products`.`seller` = '$sellers_sno";
                $select_products_sql = mysqli_query($connect,$select_products)or die(mysqli_error());
                while ($select_products_row=mysqli_fetch_array($select_products_sql)) {
                    $final_image = $select_products_row['image'];
                    $products_sno = $select_products_row['sno'];
                    unlink("../product_images/$final_image");
                    $delete_products="DELETE FROM `products` WHERE `sno` = '$products_sno'";
                    $delete_products_sql = mysqli_query($connect,$delete_products);
                }
                $sellers_name = $select_sellers_row['name'];
                $seller_user="DELETE FROM `users` WHERE `users`.`sno` = '$sellers_name'";
                $seller_user_sql = mysqli_query($connect,$seller_user);
                $delete_sellers="DELETE FROM `sellers` WHERE `sno` = '$sellers_sno'";
                $delete_sellers_sql = mysqli_query($connect,$delete_sellers);
            }
        } else {
            echo "Failed";
        }
    } else {
        echo "All fields must be filed";
    }
}
