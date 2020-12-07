<?PHP
include '../DB_Connection.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:../logout.php');
}
?>
<!--==========================================-->
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Add Seller</h5>
            </div>
            <div class="card-body">
                <form metho="POST" id="add_product_form">
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control border-primary"  required/>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Cost</label>
                                <input type="number" min="0" name="cost" id="cost" class="form-control border-primary" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" id="description" class="form-control border-primary" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="Category" id="Category" class="form-control border-primary" required>
                                <option value="" >---------- Select Category ----------</option>
                                <?PHP 
                                    $select_category="SELECT * FROM `categories` ORDER BY `categories`.`sno` ASC";
                                    $select_category_sql=mysqli_query($connect,$select_category);
                                    while ($select_category_row=mysqli_fetch_array($select_category_sql)) { ?>
                                        <option value="<?PHP echo $select_category_row['sno'];?>" ><?PHP echo $select_category_row['name'];?></option>
                                    <?PHP } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Sub Category</label>
                                <select name="subCategory" id="subCategory" class="form-control border-primary" required>
                
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Material	</label>
                                <input type="text" name="material" id="material" class="form-control border-primary" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Size</label>
                                <input type="text" name="size" id="size" list="SizeList" value="None" class="form-control border-primary" required>
                                    <datalist id="SizeList">
                                        <option value="None">
                                    </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-control border-primary" required>
                                    <option value="">---------- Select Gender ----------<option>
                                    <option value="Female">Female<option>
                                    <option value="Male">Male<option>
                                    <option value="Both">Both<option>
                                    <option value="None">None<option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Qantity</label>
                                <input type="number" min="1" name="quantity" id="quantity"   class="form-control border-primary" required> 
                            </div>   
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <label>Image</label>
                            <input type="file" name="product_image" id="product_image" class="form-control border-primary" accept="image/png, image/jpeg">    
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <p class="card-title Ajax_add_product_Responce text-info"></p>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <input type="button" name="add_product_submit" value="Add" class="btn btn-info btn-block" onclick="add_product()" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!--==========================================-->
<script>
    $('#Category').on('change', function() {
			var category_id = $("#Category").val();
			$.ajax({
				url: "Back_Scripts.php",
				type: "POST",
				data: {
                    category_id: category_id,
                    filter_sub_category:"filter_sub_category"
				},
				cache: false,
				success: function(dataResult){
					$("#subCategory").html(dataResult);
				}
			});
	});
</script>