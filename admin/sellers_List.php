<?PHP 
include '../DB_Connection.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:../logout.php');
}
?>
<!--==========================================-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sellers</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-info">
                            <tr>
                                <th>Sno</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP 
                            $seller_select="SELECT * FROM `sellers`";
                            $seller_sql=mysqli_query($connect,$seller_select);
                            $i=1;
                            while ($seller_row=mysqli_fetch_array($seller_sql)) {
                                $seller_sno = $seller_row['name'];
                                $seller_admin = "SELECT * FROM  `users` WHERE `users`.`sno` ='$seller_sno' AND `users`.`category` ='2'";
                                $seller_admin_sql = mysqli_query($connect,$seller_admin);
                                $seller_admin_row=mysqli_fetch_array($seller_admin_sql);
                                $cityadmin = $seller_row['city'];
                                $city_select="SELECT * FROM `cities` WHERE `cities`.`sno`='$cityadmin'";
                                $city_sql=mysqli_query($connect,$city_select);
                                $city_row=mysqli_fetch_array($city_sql);
                            ?>
                            <tr>
                                <td>
                                    <?PHP echo $i; ?>
                                </td>
                                <td>
                                    <?PHP echo $seller_admin_row['fname']." ".$seller_admin_row['lname']; ?>
                                </td>
                                <td>
                                    <?PHP echo $city_row['name']; ?>
                                </td>
                                <td>
                                    <i class="fas fa-user-edit text-info"></i>
                                </td>
                            </tr>
                        <?PHP $i++; } ?>   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--==========================================-->