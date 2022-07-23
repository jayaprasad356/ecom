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

if (!isset($_POST['accesskey'])) {
    if (!isset($_GET['accesskey'])) {
        $response['error'] = true;
        $response['message'] = "Access key is invalid or not passed!";
        print_r(json_encode($response));
        return false;
    }
}

if (isset($_POST['accesskey'])) {
    $accesskey = $db->escapeString($fn->xss_clean($_POST['accesskey']));
} else {
    $accesskey = $db->escapeString($fn->xss_clean($_GET['accesskey']));
}

if ($access_key != $accesskey) {
    $response['error'] = true;
    $response['message'] = "invalid accesskey!";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['product_id'])) {
    $response['success'] = false;
    $response['message'] = "Product ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['ratings'])) {
    $response['success'] = false;
    $response['message'] = "Ratings is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$product_id = $db->escapeString($_POST['product_id']);
$ratings = $db->escapeString($_POST['ratings']);
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $sql = "SELECT * FROM products WHERE id = '" . $product_id . "'";
    $sql = "INSERT INTO ratings (`user_id`,`product_id`,`ratings`) VALUES ('$user_id','$product_id','$ratings')";
    $db->sql($sql);
    $sql = "UPDATE products SET `ratings`=ratings+$ratings  WHERE id= $product_id";
    $db->sql($sql);
    $sql = "SELECT * FROM products WHERE id = '" . $product_id . "'";
    $db->sql($sql);
    $res = $db->getResult();
    $response['success'] = true;
    $response['message'] = "Ratings Added Successfully";
    $response['data'] = $res;

}
else{
    $response['success'] = false;
    $response['message'] = "Product Not Found";
}

print_r(json_encode($response));
?>
