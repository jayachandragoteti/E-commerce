<!--==========================================-->
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Add Seller</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control border-primary"  required/>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control border-primary" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control border-primary" required/>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control border-primary" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control border-primary" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control border-primary" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <p class="card-title Ajax_cadd_seller_Responce text-info"></p>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <input type="button" name="add_city_admin_submit" value="Add" class="btn btn-info btn-block" onclick="adding_Seller()" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--==========================================-->