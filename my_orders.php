<?PHP 
include 'DB_Connection.php';
session_start();
?>
<section class="shopping_cart_page">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-8 col-sm-7">
                <div class="widget">
                    <div class="section-header">
                        <h5 class="heading-design-h5">
                        Order List
                        </h5>
                    </div>
                    <div class="order-list-tabel-main">
                        <table class="datatabel table table-striped table-bordered order-list-tabel table-responsive" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date Purchased</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="Ajax_my_orders_data_responce">
                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>