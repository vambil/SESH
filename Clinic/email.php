<?php
session_start();

$to = 'vibhu.ambil@gmail.com';


$subject = "Shufang,";

$htmlContent = "here is some content!";
$headers = "From: vibhu.ambil@gmail.com";

if(mail($to,$subject,$htmlContent)){
  echo "sucessfully";
}else {
  echo "unsuccesful";
}

 ?>
