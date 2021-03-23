<?php

require("./db.php");

include_once './libs/php-jwt-master/src/BeforeValidException.php';
include_once './libs/php-jwt-master/src/ExpiredException.php';
include_once './libs/php-jwt-master/src/SignatureInvalidException.php';
include_once './libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

// get json data
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;

if(verifyUserData($username, $password, $conn)){

    $userData = getUserData($username, $conn);
 
    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "id" => $userData["user_id"],
           "username" => $userData["username"],
           "email" => $userData["email"]
       )
    );
 
    // set response code
    http_response_code(200);
 
    // generate jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );
 
}// login failed
else{
    // set response code
    http_response_code(401);
    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}

function verifyUserData($user, $pass, $conn){
    $sql = "SELECT password FROM users WHERE username='$user'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();

    if($pass == $row["password"]){
        return true;
    } else {
        return false;
    }
}

function getUserData($user, $conn){
    $sql = "SELECT * FROM users WHERE username = '$user'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();

    if($result){
        return $row;
    } else {
        return false;
    }
}
?>