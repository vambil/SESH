<?php
session_start();
//HELPER FUNCTIONS
function getGeneralRow($contest_name){
  $conn = new mysqli('localhost', 'root', '', 'registration_storage');
  $sql = "SELECT * FROM general WHERE contest_name = '$contest_name'";
  $result = mysqli_query($conn, $sql);
  return mysqli_fetch_array($result);
}

function getUserRow($id){
  $conn = new mysqli('localhost', 'root', '', 'registration_storage');
  $sql = "SELECT * FROM users WHERE user_id = '$id'";
  $result = mysqli_query($conn, $sql);
  return mysqli_fetch_array($result);
}

//create connection
$conn = new mysqli('localhost', 'root', '', 'registration_storage');

if(isset($_POST['submit']) && isset($_GET['user_id'])){

  $first = mysqli_real_escape_string($conn, $_POST['first']);
  $last = mysqli_real_escape_string($conn, $_POST['last']);
  $country = $_POST['country'];
  $organization = mysqli_real_escape_string($conn, $_POST['organization']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);



  if(empty($first) || empty($last) || empty($country) || empty($organization) ||empty($email)){
    echo '<script> alert("Please fill out all the required fields"); window.location.href=\'index.php\'; </script>';
    exit();
  }

  $sql ="SELECT * FROM users WHERE user_id = '$_GET[user_id]'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck == 0){ //check if user has been taken
    echo '<script> alert("Error, you are trying to edit a user that does not exist"); window.location.href=\'index.php\'; </script>';
    exit();
  }

  $old_user_row = getUserRow($_GET['user_id']);
  $old_email = $old_user_row['user_email'];

  $sql = "UPDATE users
      SET user_first = '$first',
          user_last = '$last',
          user_country = '$country',
          user_organization = '$organization',
          user_email = '$email'
  WHERE user_id = '$_GET[user_id]' ";

  if(mysqli_query($conn, $sql)){
    echo "user records updated";
  }else {
    echo "USER ERROR";
  }

  $sql = "UPDATE general
      SET email = '$email'
  WHERE email = '$old_email' ";
  if(mysqli_query($conn, $sql)){
    echo "general records updated";
  }else {
    echo "GENERAL ERROR";
  }

  $sql = "UPDATE early_storage
      SET email = '$email'
  WHERE email = '$old_email' ";
  if(mysqli_query($conn, $sql)){
    echo "early records updated";
  }else {
    echo "Early ERROR";
  }

  $sql = "UPDATE mid_storage
      SET email = '$email'
  WHERE email = '$old_email' ";
  if(mysqli_query($conn, $sql)){
    echo "mid records updated";
  }else {
    echo "MID ERROR";
  }

  $sql = "UPDATE completed_storage
      SET email = '$email'
  WHERE email = '$old_email' ";
  if(mysqli_query($conn, $sql)){
    echo "completed records updated";
  }else {
    echo "COMPLETED ERROR";
  }
  echo "Update succesful!";

  header("Location: user_landing/admin.php#pricing");
  exit();

}
else{
  header("Location: index.php");
}
