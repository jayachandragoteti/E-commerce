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
                            $cityadmin_sno = $_SESSION['admin']['sno'];
                            $select_city="SELECT * FROM `cities` WHERE `cities`.`admin`='$cityadmin_sno'";
                            $select_city_sql=mysqli_query($connect,$select_city);
                            $select_city_row=mysqli_fetch_array($select_city_sql);
                            $city_sno = $select_city_row['sno'];
                            $sellers_details = "SELECT * FROM  `users` WHERE `users`.`sno` IN (SELECT `name` FROM `sellers` WHERE `sellers`.`city`='$city_sno')";
                            $sellers_details_sql=mysqli_query($connect,$sellers_details);
                            $i=1;
                            while ($sellers_details_row=mysqli_fetch_array($sellers_details_sql)) {?>
                            <tr>
                                <td>
                                    <?PHP echo $i; ?>
                                </td>
                                <td>
                                    <?PHP echo $sellers_details_row['fname']."  ".$sellers_details_row['lname']; ?>
                                </td>
                                <td>
                                    <?PHP echo $select_city_row['name']; ?>
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