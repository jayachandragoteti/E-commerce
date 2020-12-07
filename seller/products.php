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
        <?PHP 
            $seller_user_sno = $_SESSION['admin']['sno'];
            $select_seller="SELECT * FROM `sellers` WHERE `sellers`.`name` = '$seller_user_sno'";
            $select_seller_result=mysqli_query($connect,$select_seller);
            $select_seller_row=mysqli_fetch_array($select_seller_result);
            $seller_sno=$select_seller_row['sno'];
            $select_product="SELECT * FROM `products` WHERE `seller` = '$seller_sno' ";
            $select_product_sql = mysqli_query($connect,$select_product);
            while ($select_product_row=mysqli_fetch_array($select_product_sql)) {
                $Category = $select_product_row['category'];
                $SubCategory = $select_product_row['subCategory'];
                $Category_select="SELECT * FROM `categories` WHERE `sno`= '$Category'";
                $Category_select_result=mysqli_query($connect,$Category_select);
                $Category_select_row=mysqli_fetch_array($Category_select_result);
                $select_subcat="SELECT * FROM `subcategories` WHERE `sno`= '$SubCategory'";
                $select_subcat_result=mysqli_query($connect, $select_subcat);
                $select_subcat_row=mysqli_fetch_array( $select_subcat_result);
            ?>
                <div class="card" style="width:18rem;">
                    <img class="card-img-top" src="../product_images/<?PHP echo $select_product_row['image']; ?>" alt="Card image cap" style="height:18rem;">
                    <div class="card-body">
                        <h6 class="card-title text-info ">Name : <?PHP echo $select_product_row['name']; ?></h6>
                        <p class="card-text font-weight-bold text-info">Cost : <i class="fas fa-rupee-sign">&nbsp</i><?PHP echo $select_product_row['cost']; ?></p>
                        <p class="card-text font-weight-bold text-info">Category : <?PHP echo $Category_select_row['name']."-".$select_subcat_row['name']; ?></p>
                        <h4 class="card-text text-info float-lg-right" data-toggle="modal" data-target="#ProductModal<?PHP echo $select_product_row['sno'];?>" style="cursor: pointer;"><i class="fas fa-eye"></i></h4>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="ProductModal<?PHP echo $select_product_row['sno'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title text-info text-uppercase" id="exampleModalLabel">Product Id : <?PHP echo $select_product_row['sno']; ?> &nbsp </h6>
                                <?PHP 
                                    if ($select_product_row['status'] == 1 ) { ?>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="ProductId<?PHP echo $select_product_row['sno'];?>" onclick="changeProductStatus('<?PHP echo $select_product_row['sno'];?>')" checked>
                                            <label class="custom-control-label text-danger" for="ProductId<?PHP echo $select_product_row['sno']; ?>"><samll><sub class="ProductStatusResponce<?PHP echo $select_product_row['sno'];?>"></sub></samll></label>
                                        </div>
                                    <?PHP }else{ ?>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="ProductId<?PHP echo $select_product_row['sno'];?>" onclick="changeProductStatus('<?PHP echo $select_product_row['sno'];?>')">
                                            <label class="custom-control-label text-success" for="ProductId<?PHP echo $select_product_row['sno']; ?>"><samll><sub class="ProductStatusResponce<?PHP echo $select_product_row['sno'];?>"></sub></samll></label>
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
                                                <label for="">Name</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['name'];?>" class="form-control border-primary"  required disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cost</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['cost'];?>"  class="form-control border-primary" required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['description'];?>"  class="form-control border-primary"  required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Material</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['material'];?>"  class="form-control border-primary"  required disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['gender'];?>"  class="form-control border-primary" required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['category'];?>"  class="form-control border-primary"  required disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Sub Category</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['subCategory'];?>"  class="form-control border-primary" required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Quantity</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['quantity'];?>"  class="form-control border-primary"  required disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Size</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['size'];?>"  class="form-control border-primary" required disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">City</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['city'];?>"  class="form-control border-primary"  required disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Seller</label>
                                                <input type="text" name="" id="" value="<?PHP echo $select_product_row['seller'];?>"  class="form-control border-primary" required disabled/>
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
        <?PHP  }?>
    </div>
</div>
<!--==========================================-->