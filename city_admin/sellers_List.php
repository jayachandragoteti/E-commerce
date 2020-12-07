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
                                <th scope="col"><small><b>Sno</b></small></th>
                                <th scope="col"><small><b>Name</b></small></th>
                                <th scope="col"><small><b>City</b></small></th>
                                <th scope="col"><small><b>View</b></small></th>
                                <th scope="col"><small><b>Remove</b></small></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP 
                            $cityadmin_sno = $_SESSION['admin']['sno'];
                            $select_city="SELECT * FROM `cities` WHERE `cities`.`admin`='$cityadmin_sno'";
                            $select_city_sql=mysqli_query($connect,$select_city);
                            $select_city_row=mysqli_fetch_array($select_city_sql);
                            $city_sno = $select_city_row['sno'];
                            $select_seller="SELECT * FROM `sellers` WHERE `sellers`.`city`='$city_sno'";
                            $select_seller_sql=mysqli_query($connect,$select_seller);
                            $select_seller_row=mysqli_fetch_array($select_seller_sql);
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
                                    <i class="fas fa-user-edit text-info" data-toggle="modal" data-target="#sellerID<?PHP echo $sellers_details_row['sno'];?>" style="cursor: pointer;"></i>
                                </td>
                                <td>
                                    <i class="fas fa-trash text-danger" data-toggle="modal" data-target="#deltesellerID<?PHP echo $sellers_details_row['sno'];?>" style="cursor: pointer;"></i>
                                </td>
                            </tr>
                            <!-- View Modal -->
                            <div class="modal fade" id="sellerID<?PHP echo $sellers_details_row['sno'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title text-info text-uppercase" id="exampleModalLabel">Seller Id : <?PHP echo $select_seller_row['sno'];?>  &nbsp </h6>
                                        <?PHP 
                                            if ($select_seller_row['status'] == 1 ) { ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="sellerId<?PHP echo $select_seller_row['sno'];?>" onclick="sellerStatus('<?PHP echo $select_seller_row['sno'];?>')" checked>
                                                    <label class="custom-control-label text-danger" for="sellerId<?PHP echo $select_seller_row['sno'];?>"><samll><sub class="sellerStatusResponce<?PHP echo $select_seller_row['sno'];?>"></sub></samll></label>
                                                </div>
                                            <?PHP }else{ ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="sellerId<?PHP echo $select_seller_row['sno'];?>" onclick="sellerStatus('<?PHP echo $select_seller_row['sno'];?>')">
                                                    <label class="custom-control-label text-success" for="sellerId<?PHP echo $select_seller_row['sno'];?>"><samll><sub class="sellerStatusResponce<?PHP echo $select_seller_row['sno'];?>"></sub></samll></label>
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
                                                            <input type="text" name="" id="" value="<?PHP echo $sellers_details_row['fname'];?>" class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Last Name</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $sellers_details_row['lname'];?>"  class="form-control border-primary" required disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Address</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $sellers_details_row['address'];?>"  class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Phone</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $sellers_details_row['phone'];?>"  class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $sellers_details_row['email'];?>"  class="form-control border-primary" required disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">City</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $select_city_row['name'];?>"  class="form-control border-primary"  required disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Seller Id</label>
                                                            <input type="text" name="" id="" value="<?PHP echo $select_seller_row['sno'];?>"  class="form-control border-primary"  required disabled/>
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
                            <div class="modal fade" id="deltesellerID<?PHP echo $sellers_details_row['sno'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Seller</h5>
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