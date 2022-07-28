<?php
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');


include('../includes/crud.php');
include('../includes/custom-functions.php');
include('verify-token.php');
$fn = new custom_functions();
$db = new Database();
$db->connect();

$config = $fn->get_configurations();
$time_slot_config = $fn->time_slot_config();
if (isset($config['system_timezone']) && isset($config['system_timezone_gmt'])) {
    date_default_timezone_set($config['system_timezone']);
    $db->sql("SET `time_zone` = '" . $config['system_timezone_gmt'] . "'");
} else {
    date_default_timezone_set('Asia/Kolkata');
    $db->sql("SET `time_zone` = '+05:30'");
}
include('../includes/variables.php');

/* 
-------------------------------------------
APIs for Multi Vendor
-------------------------------------------
1. login
-------------------------------------------

-------------------------------------------
*/

if (!verify_token()) {
    return false;
}


if (!isset($_POST['accesskey'])  || trim($_POST['accesskey']) != $access_key) {
    $response['error'] = true;
    $response['message'] = "No Accsess key found!";
    print_r(json_encode($response));
    return false;
}

if (isset($_POST['login']) && $_POST['login'] == 1) {
    /* 
    1.login
        accesskey:90336
        mobile:9876543210
        password:12345678
        fcm_id:YOUR_FCM_ID
        login:1
    */

    if (empty($_POST['mobile'])) {
        $response['error'] = true;
        $response['message'] = "Mobile should be filled!";
        print_r(json_encode($response));
        return false;
    }
    if (empty($_POST['password'])) {
        $response['error'] = true;
        $response['message'] = "Password should be filled!";
        print_r(json_encode($response));
        return false;
    }

    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
    $password =$db->escapeString($fn->xss_clean($_POST['password']));
    $mobile = $db->escapeString($_POST['mobile']);
    $sql = "SELECT * FROM bulkseller WHERE mobile = '" . $mobile . "' AND password = '" . $password . "'";
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
        if ($num == 1) {
            $response['success'] = true;
            $response['message'] = "Login Successfully";
            $response['data'] = $res;
            print_r(json_encode($response));
    
        }
        else{
            $response['success'] = false;
            $response['message'] = "Invalid Credentials";
            print_r(json_encode($response));
    
        }
    }
?>