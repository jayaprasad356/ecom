<?php
session_start();
include '../includes/crud.php';
include_once('../includes/variables.php');
include_once('../includes/custom-functions.php');


header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Kolkata');


$fn = new custom_functions;
include_once('../includes/functions.php');
$function = new functions;
include_once('verify-token.php');
$db = new Database();
$db->connect();
$response = array();

if (empty($_POST['business_type'])) {
    $response['success'] = false;
    $response['message'] = "Business Type is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['category_id'])) {
    $response['success'] = false;
    $response['message'] = "Category_id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['business_name'])) {
    $response['success'] = false;
    $response['message'] = "Business Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['pan_number'])) {
    $response['success'] = false;
    $response['message'] = "Pan Number is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['pin_code'])) {
    $response['success'] = false;
    $response['message'] = "Pin Code is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['city'])) {
    $response['success'] = false;
    $response['message'] = "City is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['state'])) {
    $response['success'] = false;
    $response['message'] = "State is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['name'])) {
    $response['success'] = false;
    $response['message'] = "Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['email'])) {
    $response['success'] = false;
    $response['message'] = "Email Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['mobile'])) {
    $response['success'] = false;
    $response['message'] = "Mobile Number is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['password'])) {
    $response['success'] = false;
    $response['message'] = "Password is Empty";
    print_r(json_encode($response));
    return false;
}
$business_type = $db->escapeString($_POST['business_type']);
$category_id = $db->escapeString($_POST['category_id']);
$business_name = $db->escapeString($_POST['business_name']);
$pan_number = $db->escapeString($_POST['pan_number']);
$gst_number = $db->escapeString($_POST['gst_number']);
$pin_code = $db->escapeString($_POST['pin_code']);
$city=$db->escapeString($_POST['city']);
$state=$db->escapeString($_POST['state']);
$name = $db->escapeString($_POST['name']);
$email=$db->escapeString($_POST['email']);
$mobile = $db->escapeString($_POST['mobile']);
$password = $db->escapeString($_POST['password']);


if (isset($_FILES['pan_card']) && !empty($_FILES['pan_card']) && $_FILES['pan_card']['error'] == 0 && $_FILES['pan_card']['size'] > 0) {
    if (!is_dir('../upload/documents/')) {
        mkdir('../upload/documents/', 0777, true);
    }
    $pan_card = $db->escapeString($fn->xss_clean($_FILES['pan_card']['name']));
    $extension = pathinfo($_FILES["pan_card"]["name"])['extension'];
    $result = $fn->validate_image($_FILES["pan_card"]);
    if (!$result) {
        $response["success"]   = false;
        $response["message"] = "Image type0 must jpg, jpeg, gif, or png!";
        print_r(json_encode($response));
        return false;
    }
    $filename = microtime(true) . '.' . strtolower($extension);
    $full_path = '../upload/documents/' . "" . $filename;
    if (!move_uploaded_file($_FILES["pan_card"]["tmp_name"], $full_path)) {
        $response["success"]   = false;
        $response["message"] = "Invalid directory to load image!";
        print_r(json_encode($response));
        return false;
    }
}
else{
    $response["success"]   = false;
    $response["message"] = "Pan Card parameter is missing.";

}
if (isset($_FILES['aadhaar_card']) && !empty($_FILES['aadhaar_card']) && $_FILES['aadhaar_card']['error'] == 0 && $_FILES['aadhaar_card']['size'] > 0) {
    if (!is_dir('../upload/documents/')) {
        mkdir('../upload/documents/', 0777, true);
    }
    $aadhaar_card = $db->escapeString($fn->xss_clean($_FILES['aadhaar_card']['name']));
    $extension = pathinfo($_FILES["aadhaar_card"]["name"])['extension'];
    $result = $fn->validate_image($_FILES["aadhaar_card"]);
    if (!$result) {
        $response["success"]   = false;
        $response["message"] = "Image type1 must jpg, jpeg, gif, or png!";
        print_r(json_encode($response));
        return false;
    }
    $filename1 = microtime(true) . '.' . strtolower($extension);
    $full_path = '../upload/documents/' . "" . $filename1;
    if (!move_uploaded_file($_FILES["aadhaar_card"]["tmp_name"], $full_path)) {
        $response["success"]   = false;
        $response["message"] = "Invalid directory to load image!";
        print_r(json_encode($response));
        return false;
    }
}
else{
    $response["success"]   = false;
    $response["message"] = "AadhaarCard parameter is missing.";

}
if (isset($_FILES['manufacturer_certificate']) && !empty($_FILES['manufacturer_certificate']) && $_FILES['manufacturer_certificate']['error'] == 0 && $_FILES['manufacturer_certificate']['size'] > 0) {
    if (!is_dir('../upload/documents/')) {
        mkdir('../upload/documents/', 0777, true);
    }
    $manufacturer_certificate = $db->escapeString($fn->xss_clean($_FILES['manufacturer_certificate']['name']));
    $extension = pathinfo($_FILES["manufacturer_certificate"]["name"])['extension'];
    $result = $fn->validate_image($_FILES["manufacturer_certificate"]);
    if (!$result) {
        $response["success"]   = false;
        $response["message"] = "Image type2 must jpg, jpeg, gif, or png!";
        print_r(json_encode($response));
        return false;
    }
    $filename2 = microtime(true) . '.' . strtolower($extension);
    $full_path = '../upload/documents/' . "" . $filename2;
    if (!move_uploaded_file($_FILES["manufacturer_certificate"]["tmp_name"], $full_path)) {
        $response["success"]   = false;
        $response["message"] = "Invalid directory to load image!";
        print_r(json_encode($response));
        return false;
    }
}
else{
    $response["success"]   = false;
    $response["message"] = "Manufacturer certificate parameter is missing.";

}
if (isset($_FILES['gu_anu_certificate']) && !empty($_FILES['gu_anu_certificate']) && $_FILES['gu_anu_certificate']['error'] == 0 && $_FILES['gu_anu_certificate']['size'] > 0) {
    if (!is_dir('../upload/documents/')) {
        mkdir('../upload/documents/', 0777, true);
    }
    $gu_anu_certificate = $db->escapeString($fn->xss_clean($_FILES['gu_anu_certificate']['name']));
    $extension = pathinfo($_FILES["gu_anu_certificate"]["name"])['extension'];
    $result = $fn->validate_image($_FILES["gu_anu_certificate"]);
    if (!$result) {
        $response["success"]   = false;
        $response["message"] = "Image type3 must jpg, jpeg, gif, or png!";
        print_r(json_encode($response));
        return false;
    }
    $filename3 = microtime(true) . '.' . strtolower($extension);
    $full_path = '../upload/documents/' . "" . $filename3;
    if (!move_uploaded_file($_FILES["gu_anu_certificate"]["tmp_name"], $full_path)) {
        $response["success"]   = false;
        $response["message"] = "Invalid directory to load image!";
        print_r(json_encode($response));
        return false;
    }
}
else{
    $response["success"]   = false;
    $response["message"] = "Gu_anu_ Certificate parameter is missing.";

}


$sql = "INSERT INTO bulkseller (`business_type`,`category_id`,`business_name`,`pan_number`,`gst_number`,`pin_code`,`city`,`state`,`name`,`email`,`mobile`,`password`,`pan_card`,`aadhaar_card`,`manufacturer_certificate`,`gu_anu_certificate`,`status`) VALUES ('$business_type','$category_id','$business_name','$pan_number','$gst_number','$pin_code','$city','$state','$name','$email','$mobile','$password','$filename','$filename1','$filename2','$filename3',0)";
$db->sql($sql);
$response["success"]   = true;
$response["message"] = "Registered Successfully";
print_r(json_encode($response));
return false;
?>