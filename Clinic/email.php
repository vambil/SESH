<?php
session_start();

$to = 'chessboy17@gmail.com';


$subject = "Shufang, ". $_SESSION['u_first']. " ". $_SESSION['u_last']. " has registered a new contest!";

$htmlContent = "here is some content!";
$headers = "From: vibhu.ambil@gmail.com";

if(mail($to,$subject,$htmlContent,$headers)){
  echo "sucessfully";
}else {
  echo "unsuccesful";
}

 ?>
