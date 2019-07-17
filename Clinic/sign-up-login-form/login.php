<?php

session_start();

//create connection
$conn = new mysqli('localhost', 'root', '', 'registration_storage');

if(isset($_POST['submit'])){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if(empty($email) || empty($password)){
    echo "make sure fields are not empty";
    exit();
  }

  $sql ="SELECT * FROM users WHERE user_email = '$email'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if($resultCheck != 1){ //check if user has been taken
    echo "error, login unsuccesful";
    exit();
  }
  //email has been found in the database
  if($row = mysqli_fetch_assoc($result)){
    //De hash PASSWORD
    $hashedPasswordCheck = password_verify($password, $row['user_pwd']);
    if($hashedPasswordCheck == false){
      echo "error, login unsuccesful";
      exit();
    }
    elseif ($hashedPasswordCheck == true) {
      //password is correct! Log the user in

      //echo $row['user_id'];
      $_SESSION['u_id'] = $row['user_id'];
      $_SESSION['u_first'] = $row['user_first'];
      $_SESSION['u_last'] = $row['user_last'];
      $_SESSION['u_country'] = $row['user_country'];
      $_SESSION['user_organization'] = $row['user_organization'];
      $_SESSION['u_email'] = $row['user_email'];
      $_SESSION['u_timestamp'] = $row['user_timestamp'];

      echo "Login succesful!";
      header("Location: user_landing/index.php");
      exit();
      // $_SESSION['u_id'] = $row['user_id'];
    }
  }

  echo "UNKNOWN ERROR";
  exit();

}
else{
  header("Location: index.html");
  exit();
}
