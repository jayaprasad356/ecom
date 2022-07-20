<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php
// $ID = (isset($_GET['id'])) ? $db->escapeString($fn->xss_clean($_GET['id'])) : "";
if (isset($_GET['id'])) {
    $ID = $db->escapeString($fn->xss_clean($_GET['id']));
} else {
    // $ID = "";
    return false;
    exit(0);
}
$bulkseller_data = array();
if (isset($_POST['btnEdit'])) {
	if (defined('ALLOW_MODIFICATION') && ALLOW_MODIFICATION == 0) {
		echo '<label class="alert alert-danger">This operation is not allowed in demo panel!.</label>';
		return false;
	}

		$business_type = $db->escapeString($fn->xss_clean($_POST['business_type']));
        $category_id = $db->escapeString($fn->xss_clean($_POST['category_id']));
        $business_name = $db->escapeString($fn->xss_clean($_POST['business_name']));	
		$pan_number = $db->escapeString($fn->xss_clean($_POST['pan_number']));
        $gst_number = $db->escapeString($fn->xss_clean($_POST['gst_number']));
		$pin_code = $db->escapeString($fn->xss_clean($_POST['pin_code']));
        $city = $db->escapeString($fn->xss_clean($_POST['city']));
        $state = $db->escapeString($fn->xss_clean($_POST['state']));
        $name = $db->escapeString($fn->xss_clean($_POST['name']));
		$email = $db->escapeString($fn->xss_clean($_POST['email']));
        $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
		$status = $db->escapeString($fn->xss_clean($_POST['status']));
		$error = array();

		if (empty($business_type)) {
            $error['business_type'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($category_id)) {
            $error['category_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($business_name)) {
            $error['business_name'] = " <span class='label label-danger'>Required!</span>";
        }
		if (empty($pan_number)) {
            $error['pan_number'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($gst_number)) {
            $error['gst_number'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($pin_code)) {
            $error['pin_code'] = " <span class='label label-danger'>Required!</span>";
        }
		if (empty($city)) {
            $error['city'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($state)) {
            $error['state'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($name)) {
            $error['name'] = " <span class='label label-danger'>Required!</span>";
        }
		if (empty($email)) {
            $error['email'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($mobile)) {
            $error['mobile'] = " <span class='label label-danger'>Required!</span>";
        }
		
if (!empty($business_type)&& !empty($category_id) && !empty($business_name) && !empty($pan_number) && !empty($gst_number) && !empty($pin_code) && !empty($city) && !empty($state) && !empty($name) && !empty($email) && !empty($mobile)) 
{
	//image1
	if ($_FILES['pan_card']['size'] != 0 && $_FILES['pan_card']['error'] == 0 && !empty($_FILES['pan_card']))
	{
		$old_image = $db->escapeString($_POST['old_image']);
		$extension = pathinfo($_FILES["pan_card"]["name"])['extension'];
		$new_image = $ID . "." . $extension;
		

		$result = $fn->validate_image($_FILES["pan_card"]);
		$target_path = 'upload/documents/';
		
		$filename1= microtime(true) . '.' . strtolower($extension);
		$full_path = $target_path . "" . $filename1;
		if (!move_uploaded_file($_FILES["pan_card"]["tmp_name"], $full_path)) {
			echo '<p class="alert alert-danger">Can not upload image.</p>';
			return false;
			exit();
		}
		if (!empty($old_image1)) {
			unlink( $old_image1);
		}
		$upload_image1 = 'upload/documents/' . $filename1;
		$sql = "UPDATE bulkseller SET pan_card='$filename1' WHERE id =  $ID";
		$db->sql($sql);
	}

//aadhaar card
	if ($_FILES['aadhaar_card']['size'] != 0 && $_FILES['aadhaar_card']['error'] == 0 && !empty($_FILES['aadhaar_card']))
	{
		$old_image = $db->escapeString($_POST['old_image']);
		$extension = pathinfo($_FILES["aadhaar_card"]["name"])['extension'];
		$new_image = $ID . "." . $extension;
		

		$result = $fn->validate_image($_FILES["aadhaar_card"]);
		$target_path = 'upload/documents/';
		
		$filename2 = microtime(true) . '.' . strtolower($extension);
		$full_path = $target_path . "" . $filename2;
		if (!move_uploaded_file($_FILES["aadhaar_card"]["tmp_name"], $full_path)) {
			echo '<p class="alert alert-danger">Can not upload image.</p>';
			return false;
			exit();
		}
		if (!empty($old_image2)) {
			unlink( $old_image2);
		}
		$upload_image2= 'upload/documents/' . $filename2;
		$sql = "UPDATE bulkseller SET aadhaar_card='$filename2' WHERE id =  $ID";
		$db->sql($sql);
	}

	//Manufacturer Certificate
	if ($_FILES['manufacturer_certificate']['size'] != 0 && $_FILES['manufacturer_certificate']['error'] == 0 && !empty($_FILES['manufacturer_certificate']))
	{
		$old_image = $db->escapeString($_POST['old_image']);
		$extension = pathinfo($_FILES["manufacturer_certificate"]["name"])['extension'];
		$new_image = $ID . "." . $extension;
		

		$result = $fn->validate_image($_FILES["manufacturer_certificate"]);
		$target_path = 'upload/documents/';
		
		$filename3 = microtime(true) . '.' . strtolower($extension);
		$full_path = $target_path . "" . $filename3;
		if (!move_uploaded_file($_FILES["manufacturer_certificate"]["tmp_name"], $full_path)) {
			echo '<p class="alert alert-danger">Can not upload image.</p>';
			return false;
			exit();
		}
		if (!empty($old_image3)) {
			unlink( $old_image3);
		}
		$upload_image3= 'upload/documents/' . $filename3;
		$sql = "UPDATE bulkseller SET manufacturer_certificate='$filename3' WHERE id =  $ID";
		$db->sql($sql);
	}

	//Manufacturer Certificate
	if ($_FILES['gu_anu_certificate']['size'] != 0 && $_FILES['gu_anu_certificate']['error'] == 0 && !empty($_FILES['gu_anu_certificate']))
	{
		$old_image = $db->escapeString($_POST['old_image']);
		$extension = pathinfo($_FILES["gu_anu_certificate"]["name"])['extension'];
		$new_image = $ID . "." . $extension;
		

		$result = $fn->validate_image($_FILES["gu_anu_certificate"]);
		$target_path = 'upload/documents/';
		
		$filename4 = microtime(true) . '.' . strtolower($extension);
		$full_path = $target_path . "" . $filename4;
		if (!move_uploaded_file($_FILES["gu_anu_certificate"]["tmp_name"], $full_path)) {
			echo '<p class="alert alert-danger">Can not upload image.</p>';
			return false;
			exit();
		}
		if (!empty($old_image4)) {
			unlink( $old_image);
		}
		$upload_image4= 'upload/documents/' . $filename4;
		$sql = "UPDATE bulkseller SET gu_anu_certificate='$filename4' WHERE id =  $ID";
		$db->sql($sql);
	}

	$sql = "UPDATE bulkseller SET business_type='$business_type',category_id='$category_id',business_name='$business_name',pan_number='$pan_number',gst_number='$gst_number',pin_code='$pin_code',city= '$city',state='$state',name='$name',email= '$email',mobile='$mobile',status='$status' WHERE id =  $ID";
	$db->sql($sql);
	$update_result = $db->getResult();
	if (!empty($update_result)) {
		$update_result = 0;
	} else {
		$update_result = 1;
	}
	   // check update result
	if ($update_result == 1) {
		$error['update_bulkseller'] = " <section class='content-header'><span class='label label-success'>Bulkseller updated Successfully</span></section>";
	} else {
		$error['update_bulkseller'] = " <span class='label label-danger'>Failed update Bulkseller</span>";
	}

} else {
	$error['check_permission'] = " <section class='content-header'><span class='label label-danger'>You have no permission to update bulkseller</span></section>";
}
}
	

// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM bulkseller WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();

if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "bulkseller.php";
	</script>
<?php } ?>


<section class="content-header">
	<h1>
		Edit Bulkseller<small><a href='bulkseller.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Bulkseller</a></small></h1>
	<small><?php echo isset($error['update_bulkseller']) ? $error['update_bulkseller'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Bulkseller</h3>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form id="edit_bulkseller_form" method="post" enctype="multipart/form-data">
				    <div class="box-body">
							<input type="hidden" id="old_image1" name="old_image"  value="<?= $res[0]['pan_card']; ?>">
							<input type="hidden" id="old_image2" name="old_image"  value="<?= $res[0]['aadhaar_card']; ?>">
							<input type="hidden" id="old_image3" name="old_image"  value="<?= $res[0]['manufacturer_certificate']; ?>">
							<input type="hidden" id="old_image4" name="old_image"  value="<?= $res[0]['gu_anu_certificate']; ?>">
						  
							<div class="row">
								<div class="form-group">
								<div class='col-md-3'>
										<label for="exampleInputEmail1">Business Type</label><?php echo isset($error['business_type']) ? $error['business_type'] : ''; ?>
										<input type="text" class="form-control" name="business_type" value="<?php echo $res[0]['business_type']; ?>">
									</div>
									<div class='col-md-3'>
										<label for="exampleInputEmail1">Category Id</label><?php echo isset($error['category_id']) ? $error['category_id'] : ''; ?>
										<input type="number" class="form-control" name="category_id" value="<?php echo $res[0]['category_id']; ?>">
									</div>
									<div class='col-md-3'>
										<label for="exampleInputEmail1">Business Name</label><?php echo isset($error['business_name']) ? $error['business_name'] : ''; ?>
										<input type="text" class="form-control" name="business_name" value="<?php echo $res[0]['business_name']; ?>">
									</div>
								</div>
                            </div>
                            <hr>
							<div class="row">
								<div class="form-group">
								<div class='col-md-4'>
										<label for="exampleInputEmail1">PAN Number</label><?php echo isset($error['pan_number']) ? $error['pan_number'] : ''; ?>
										<input type="text" class="form-control" name="pan_number" value="<?php echo $res[0]['pan_number']; ?>">
									</div>
									<div class='col-md-4'>
										<label for="exampleInputEmail1">GST Number</label><?php echo isset($error['gst_number']) ? $error['gst_number'] : ''; ?>
										<input type="text" class="form-control" name="gst_number" value="<?php echo $res[0]['gst_number']; ?>">
									</div>
								</div>
                            </div>
                            <hr>
							<div class="row">
								<div class="form-group">
								<div class='col-md-3'>
										<label for="exampleInputEmail1">PIN Code</label><?php echo isset($error['pin_code']) ? $error['pin_code'] : ''; ?>
										<input type="text" class="form-control" name="pin_code" value="<?php echo $res[0]['pin_code']; ?>">
									</div>
									<div class='col-md-3'>
										<label for="exampleInputEmail1">City</label><?php echo isset($error['city']) ? $error['city'] : ''; ?>
										<input type="text" class="form-control" name="city" value="<?php echo $res[0]['city']; ?>">
									</div>
									<div class='col-md-3'>
										<label for="exampleInputEmail1">State</label><?php echo isset($error['state']) ? $error['state'] : ''; ?>
										<input type="text" class="form-control" name="state" value="<?php echo $res[0]['state']; ?>">
									</div>
								</div>
                            </div>
                            <hr>
							<div class="row">
								<div class="form-group">
								<div class='col-md-3'>
										<label for="exampleInputEmail1">Name</label><?php echo isset($error['name']) ? $error['name'] : ''; ?>
										<input type="text" class="form-control" name="name" value="<?php echo $res[0]['name']; ?>">
									</div>
									<div class='col-md-3'>
										<label for="exampleInputEmail1">Email Id</label><?php echo isset($error['email']) ? $error['email'] : ''; ?>
										<input type="email" class="form-control" name="email" value="<?php echo $res[0]['email']; ?>">
									</div>
									<div class='col-md-3'>
										<label for="exampleInputEmail1">Mobile Number</label><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
										<input type="text" class="form-control" name="mobile" value="<?php echo $res[0]['mobile']; ?>">
									</div>
								</div>
                            </div>
                            <hr>
							<div class="row">
								<div class="form-group">
								   <div class='col-md-4'>
										<label for="exampleInputFile">Pan Card</label>
											
											<input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="pan_card" id="pan_card">
											<p class="help-block"><img id="blah" src="<?php echo DOMAIN_URL . 'upload/documents/'.$res[0]['pan_card']; ?>" style="max-width:100%" /></p>
									</div>
									<div class='col-md-4'>
										<label for="exampleInputFile">Aadhaar Card</label>
											
											<input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="aadhaar_card" id="aadhaar_card">
											<p class="help-block"><img id="blah" src="<?php echo DOMAIN_URL . 'upload/documents/'.$res[0]['aadhaar_card']; ?>" style="max-width:100%" /></p>
									</div>
								</div>

							</div>
							<hr>
							<div class="row">
								<div class="form-group">
								   <div class='col-md-4'>
										<label for="exampleInputFile">TM/R Certificate</label>
											
											<input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="manufacturer_certificate" id="manufacturer_certificate">
											<p class="help-block"><img id="blah" src="<?php echo DOMAIN_URL . 'upload/documents/'.$res[0]['manufacturer_certificate']; ?>" style="max-width:100%" /></p>
									</div>
									<div class='col-md-4'>
										<label for="exampleInputFile">Gumasta/Anugyapati Certificate</label>
											
											<input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="gu_anu_certificate" id="gu_anu_certificate">
											<p class="help-block"><img id="blah" src="<?php echo DOMAIN_URL . 'upload/documents/'.$res[0]['gu_anu_certificate']; ?>" style="max-width:100%" /></p>
									</div>
								</div>

							</div>
							<hr>
							<div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <div id="status" class="btn-group">
                                            <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="0" <?= ($res[0]['status'] == 0) ? 'checked' : ''; ?>> Not-Approved
                                            </label>
                                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="1" <?= ($res[0]['status'] == 1) ? 'checked' : ''; ?>> Approved
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="btnEdit">Update</button>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>

<div class="separator"> </div>
<?php $db->disconnect(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
</script>