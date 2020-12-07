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
                <h4 class="card-title">City Admins</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-info">
                            <tr>
                                <th scope="col"><small><b>Sno</b></small></th>
                                <th scope="col"><small><b>Name</b></small></th>
                                <th scope="col"><small><b>City</b></small></th>
                                <th scope="col"><small><b>View</b></small></th>
                                <th scope="col"><small><b>Remove</b></small></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP 
                            $city_admin = "SELECT * FROM  `users` WHERE `users`.`category` ='3'";
                            $city_admin_sql = mysqli_query($connect,$city_admin);
                            $i=1;
                            while ($city_admin_row=mysqli_fetch_array($city_admin_sql)) {
                                $cityadmin=$city_admin_row['sno'];
                                $city_select="SELECT * FROM `cities` WHERE `cities`.`admin`='$cityadmin'";
                                $city_sql=mysqli_query($connect,$city_select);
                                $city_row=mysqli_fetch_array($city_sql);
                            ?>
                            <tr>
                                <td>
                                    <?PHP echo $i; ?>
                                </td>
                                <td>
                                    <?PHP echo $city_admin_row['fname']." ".$city_admin_row['lname']; ?>
                                </td>
                                <td>
                                    <?PHP echo $city_row['name']; ?>
                                </td>
                                <td>
                                    <i class="fas fa-user-edit text-info" data-toggle="modal" data-target="#cityadminID<?PHP echo $cityadmin;?>" style="cursor: pointer;"></i>
                                </td>
                                <td>
                                    <i class="fas fa-trash text-danger" data-toggle="modal" data-target="#deltecityadminID<?PHP echo $cityadmin;?>" style="cursor: pointer;"></i>
                                </td>
                            </tr>
                            <!-- View Modal -->
                            <div class="modal fade" id="cityadminID<?PHP echo $cityadmin;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title text-info text-uppercase" id="exampleModalLabel">City Id : <?PHP echo $city_row['sno'];?> &nbsp </h6>
                                        <?PHP 
                                            if ($city_row['status'] == 1 ) { ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="ProductId<?PHP echo $city_row['sno'];?>" onclick="CityStatus('<?PHP echo $city_row['sno'];?>')" checked>
                                                    <label class="custom-control-label text-danger" for="ProductId<?PHP echo $city_row['sno']; ?>"><samll><sub class="cityadminStatusResponce<?PHP echo $city_row['sno'];?>"></sub></samll></label>
                                                </div>
                                            <?PHP }else{ ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="ProductId<?PHP echo $city_row['sno'];?>" onclick="CityStatus('<?PHP echo $city_row['sno'];?>')">
                                                    <label class="custom-control-label text-success" for="ProductId<?PHP echo $city_row['sno']; ?>"><samll><sub class="cityadminStatusResponce<?PHP echo $city_row['sno'];?>"></sub></samll></label>
                                                </div>
                                        <?PHP } ?>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form>
                                            <div class="modal-body">
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">First Name</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $city_admin_row['fname'];?>" class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Last Name</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $city_admin_row['lname'];?>"  class="form-control border-primary" required disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Address</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $city_admin_row['address'];?>"  class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Phone</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $city_admin_row['phone'];?>"  class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $city_admin_row['email'];?>"  class="form-control border-primary" required disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">City</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $city_row['name'];?>"  class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">City Id</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $city_row['sno'];?>"  class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Detele city Modal -->
                            <div class="modal fade" id="deltecityadminID<?PHP echo $cityadmin;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete City</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body deltecityResponce">
                                            Are you sure,do you want to delete..?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" class="btn btn-danger" onclick="deltecity('<?PHP echo $city_row['sno'];?>')" data-dismiss="modal">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?PHP $i++; } ?>   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--==========================================-->