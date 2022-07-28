<?php
    include_once('includes/functions.php'); 
    ?>
<section class="content-header">
    <h1>Bulk Seller /<small><a href="home.php"><i class="fa fa-home"></i> Home</a></small></h1>
    <!-- <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-subcategory.php"><i class="fa fa-plus-square"></i> Add New Sub Category</a>
    </ol> -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                        <h3 class="box-title">Bulk Seller</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover" data-toggle="table" 
						data-url="api-firebase/get-bootstrap-table-data.php?table=bulkseller"
						data-page-list="[5, 10, 20, 50, 100, 200]"
						data-show-refresh="true" data-show-columns="true"
						data-side-pagination="server" data-pagination="true"
						data-search="true" data-trim-on-search="false"
						data-sort-name="id" data-sort-order="desc">
                        <thead>
                        <tr>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="business_type" data-sortable="true">Business Type</th>
                            <th data-field="category_id" data-sortable="true">Category Id</th>
                            <th data-field="business_name" data-sortable="true">Business Name</th>
                            <th data-field="pan_number" data-sortable="true">Pan Number</th>
                            <th data-field="gst_number" data-sortable="true">GST Number</th>
                            <th data-field="pin_code" data-sortable="true">Pin Code</th>
                            <th data-field="city" data-sortable="true">City</th>
                            <th data-field="state" data-sortable="true">State</th>
                            <th data-field="name" data-sortable="true">Name</th>
                            <th data-field="email" data-sortable="true">Email</th>
                            <th data-field="mobile" data-sortable="true">Mobile</th>
                            <th data-field="pan_card">Pan Card</th>
                            <th data-field="aadhaar_card">Aadhaar Card</th>
                            <th data-field="manufacturer_certificate">Manufacturer Certificate</th>
                            <th data-field="gu_anu_certificate">Gumasta/Anugyapati Certificate</th>
                            <th data-field="status" data-sortable="true">Status</th>
                            <th data-field="operate">Action</th>
                        </tr>
						</thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="separator"> </div>
    </div>
</section>
<?php include"footer.php";?>
