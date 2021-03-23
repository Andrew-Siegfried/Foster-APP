<?php

// Allow cross-domain scripting
header("Access-Control-Allow-Origin: *");      
header("Access-Control-Allow-Headers:
 {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$host = "localhost"; 
$user = "fish"; 
$password = "fish"; 
$dbname = "fish"; 

//$conn = mysqli_connect($host, $user, $password, $dbname);
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// show error reporting
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
 
// variables used for jwt
$key = "jwt_key";
$iss = "http://fish.org";
$aud = "http://fish.com";
$iat = 1356999524;
$nbf = 1357000000;

?>