<?PHP 
include '../DB_Connection.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:../logout.php');
}
?>
    <!--==========================================-->
    <div class="row">
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Category</h4>
            </div>
            <div class="card-body">
            <form id="add_catogery_form">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" name="category" id="category" class="form-control border-primary" placeholder="Category Name" required/>
                        </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <p class="card-title Ajax_Add_Category_Responce text-info"></p>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="button" name="add_category_submit" value="Add" class="btn btn-info btn-block" onclick="add_category()" >
                            </div>
                        </div>
                    </div>
                </div>  
            </form>             
            </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Sub Category</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <select name="category_sno" id="category_sno" class="form-control border-primary" >
                                        <option value="">------ Select Catogery -----</option>
                                        <?PHP
                                            $categories_select="SELECT * FROM `categories`";
                                            $categories_sql=mysqli_query($connect,$categories_select);
                                            while ($categories_row=mysqli_fetch_array($categories_sql)) { ?>
                                                <option value='<?PHP echo $categories_row['sno'];?>'><?PHP echo $categories_row['name'];?></option>
                                            <?PHP } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="sub_category" id="sub_category"  class="form-control border-primary" placeholder="Sub category name" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <p class="card-title Ajax_Add_Sub_category_Responce text-info"></p>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="button" name="add_subcategory_submit" value="Add" class="btn btn-info btn-block" onclick="add_sub_category()" required/>
                                </div>
                            </div>
                        </div>
                    </div>  
                </form>  
            </div>
        </div>
        </div>
    </div>
    <!--==========================================-->