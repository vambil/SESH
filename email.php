<?php
session_start();


$servername = "mysql.hostinger.com";
$database = "u612084811_reg_storage";
$username = "u612084811_root";
$password = "SESHllc2019";

$conn = mysqli_connect("mysql.hostinger.com", "u612084811_root", "SESHllc2019", "u612084811_reg_storage");

// $conn = new mysqli('localhost', 'root', '', 'registration_storage');


// if ($conn) {
//   echo 'connected';
// } else {
//   echo 'not connected';
// }

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_fetch_array($result);
echo $result2['user_first'];




// $to = 'vibhu.ambil@gmail.com';


// $subject = "This is a test message";

// $htmlContent = "here is some content!";
// $headers = "From: vibhu.ambil@gmail.com";

// if(mail($to,$subject,$htmlContent)){
//   echo "sucessfully";
// }else {
//   echo "unsuccesful";
// }

 ?>
