<?php
include '../DB_Connection.php';
session_start();
if (!isset($_SESSION['admin']) && $_SESSION['admin']['category'] != 2) {
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

if (isset($_SESSION['admin']['sno']) && isset($_POST['name']) && isset($_POST['cost']) && isset($_POST['description'])&& isset($_POST['Category'])&& isset($_POST['subCategory']) && isset($_POST['material']) && isset($_POST['size']) && isset($_POST['gender']) && $_FILES['product_image'] &&  isset($_POST['quantity'])) {
    if ($_POST['name'] !="" && $_POST['cost'] !="" && $_POST['description'] !="" && $_POST['Category'] !="" && $_POST['subCategory'] !="" && $_POST['material'] !="" && $_POST['gender'] !="" && $_POST['size'] !="" && $_POST['quantity'] !="") {
        $name = $_POST['name'];
        $cost = $_POST['cost'];
        $description = $_POST['description'];
        $Category = $_POST['Category'];
        $subCategory = $_POST['subCategory'];
        $material = $_POST['material'];
        $size = $_POST['size'];
        $gender = $_POST['gender'];
        $quantity = $_POST['quantity'];
        $img = $_FILES['product_image']['name'];
		$tmp = $_FILES['product_image']['tmp_name'];
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif');
        $path = '../product_images/';
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
		$final_image = strtolower($name.rand(1000,1000000).".".$ext);
        $path = $path.($final_image);
        if(!in_array($ext, $valid_extensions)){
			echo"You images extension must be jpg,jpeg,png,jfif.";
		}elseif ($_FILES['product_image']['size'] > 2097152) {
			echo"Image size must be excately 2 MB or below.";
		}elseif (move_uploaded_file($tmp,$path)) {
            $user_sno = $_SESSION['admin']['sno'];
            $select_seller="SELECT * FROM `sellers` WHERE `name` = '$user_sno'";
            $select_seller_sql=mysqli_query($connect,$select_seller);
            $select_seller_row=mysqli_fetch_array($select_seller_sql);
            $seller_sno=$select_seller_row['sno'];
            $select_city="SELECT * FROM `cities` WHERE `sno` IN (SELECT `city` FROM `sellers` WHERE `name` = '$user_sno')";
            $select_city_sql=mysqli_query($connect,$select_city);
            $select_city_row=mysqli_fetch_array($select_city_sql);
            $city_sno=$select_city_row['sno'];
            $insert_product="INSERT INTO `products`(`name`, `description`, `cost`, `material`, `category`, `subCategory`, `size`, `gender`, `image`, `status`, `seller`, `city`, `quantity`) VALUES ('$name','$description','$cost','$material','$Category','$subCategory','$size','$gender','$final_image','1','$seller_sno','$city_sno','$quantity')";
            $insert_product_sql=mysqli_query($connect,$insert_product);
            if ($insert_product_sql) {
                echo "Product added successfully.";
            } else {
                unlink("../product_images/$final_image");
				echo "Request Faild try again!";
            }
        }else {
			echo "failed please try again!";
        }
    } else {
        echo "All fields must be filled!";
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

if (isset($_POST['category_id']) && isset($_POST['filter_sub_category'])) {
    if ($_POST['category_id'] != "" && $_POST['filter_sub_category'] != "") {
        $category_id=$_POST["category_id"];
        $result =mysqli_query($connect,"SELECT * FROM `subcategories` WHERE `category`=$category_id");
        ?>
        <option value="">---------- Select SubCategory ----------</option>
        <?php
        while($row = mysqli_fetch_array($result)) {
        ?>
            <option value="<?php echo $row["sno"];?>"><?php echo $row["name"];?></option>
        <?php
        }
    }else {
        echo "*All fields must be filed";
    }
}