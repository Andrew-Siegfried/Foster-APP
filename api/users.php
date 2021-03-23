<?php

require("./db.php");

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$input = json_decode(file_get_contents('php://input'),true);

switch ($method) {
    case 'GET':
      //$id = $_GET['id'];
      $sql = "select * from users"; 
      break;
    case 'POST':
      $username = $_POST["username"];
      $password = $_POST["password"];
      $email = $_POST["email"];
      $is_cw = $_POST["is_cw"];
      $is_admin = $_POST["is_admin"];

      $sql = "insert into users (username, password, email, is_cw, is_admin) 
        values ('$username', '$password', '$email', '$is_cw', '$is_admin')"; 
      
      break;
    case 'DELETE':
      $user_id=intval($_GET["user_id"]);
      $sql = "DELETE FROM users
      WHERE user_id = $user_id";
      break;
}

// run SQL statement
$result = mysqli_query($conn,$sql);

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
}

if ($method == 'GET') {
  echo '[';
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
  echo ']';
} elseif ($method == 'POST') {
  $sql2 = "SELECT * FROM users WHERE username='$username' ORDER BY user_id DESC LIMIT 1"; 
  $result2 = mysqli_query($conn,$sql2);
  for ($i=0 ; $i<mysqli_num_rows($result2) ; $i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result2));
  }
} else {
  echo '[';
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
  echo ']';
}

$conn->close();