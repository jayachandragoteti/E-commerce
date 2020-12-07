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
                <h4 class="card-title">Coustomers</h4>
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
                            $cosutomers_admin = "SELECT * FROM  `users` WHERE `users`.`category` ='1'";
                            $cosutomers_admin_sql = mysqli_query($connect,$cosutomers_admin);
                            $i=1;
                            while ($cosutomers_admin_row=mysqli_fetch_array($cosutomers_admin_sql)) {
                                $cosutomersadmin=$cosutomers_admin_row['sno'];
                                $cosutomers_select="SELECT * FROM `cities` WHERE `cities`.`admin`='$cosutomersadmin'";
                                $cosutomers_sql=mysqli_query($connect,$cosutomers_select);
                                $cosutomers_row=mysqli_fetch_array($cosutomers_sql);
                            ?>
                            <tr>
                                <td>
                                    <?PHP echo $i; ?>
                                </td>
                                <td>
                                    <?PHP echo $cosutomers_admin_row['fname']." ".$cosutomers_admin_row['lname']; ?>
                                </td>
                                <td>
                                    <?PHP echo $cosutomers_row['name']; ?>
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