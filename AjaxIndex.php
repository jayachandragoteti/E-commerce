<section class="deals-of-the-day"> 
    <div class="container">
        <div class="dropdown pull-right">
            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icofont icofont-filter"></i> Sort by
            </button>
            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                <div class="form-group form-check dropdown-item">
                    <i class="fa fa-angle-right" aria-hidden="true" sytle="cursor:pointer;"></i>    
                    <input type="radio" class="form-check-input  common_selector low_hight_Prices" name="low_hight_Price" value="Low" id="Price_Low_to_High" style="display:none;cursor:pointer;">
                    <label class="form-check-label" for="Price_Low_to_High" sytle="cursor:pointer;">Price: Low to High </label>
                </div>
                <div class="dropdown-divider"></div>
                <div class="form-group form-check dropdown-item">
                    <i class="fa fa-angle-right " aria-hidden="true" sytle="cursor:pointer;"></i>    
                    <input type="radio" class="form-check-input common_selector low_hight_Prices" name="low_hight_Price" value="High" id="Price_High_to_Low" style="display:none;cursor:pointer;">
                    <label class="form-check-label" for="Price_High_to_Low" sytle="cursor:pointer;">Price: High to Low  </label>
                </div>
            </div>
            
        </div> 
        <input type="hidden" id="Price_order">
        <div class="section-header">
            <h5 class="heading-design-h5">
                <i class="fab fa-shopify"></i> Products
                <div class="pull-right" id="countdown"></div>
            </h5>
        </div>
        <div class="row ajax_filter_products_data">
                    
        </div>
    </div>
</section>
<script>
$('.common_selector').click(function(){
        filter_data();
    });
</script>