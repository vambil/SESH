<?php
session_start();
//create connection
$conn = new mysqli('localhost', 'root', '', 'registration_storage');

if(isset($_POST['submit'])){
  $first = mysqli_real_escape_string($conn, $_POST['first']);
  $last = mysqli_real_escape_string($conn, $_POST['last']);
  $country = $_POST['country'];
  $organization = mysqli_real_escape_string($conn, $_POST['organization']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if(empty($first) || empty($last) || empty($country) || empty($organization) ||empty($email) || empty($password)){
    echo "make sure fields are not empty";
    exit();
  }

    // $sql ="SELECT * FROM users WHERE user_email = '$email'";
    // $result = mysqli_num_rows(mysqli_query($conn, $sql));
    // $row = mysqli_fetch_assoc($result);

    $sql ="SELECT * FROM users WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck != 0){ //check if user has been taken
      echo "error, this email already has been registered";
      exit();
    }
    //hash Password
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_first, user_last, user_country, user_organization, user_email, user_pwd) VALUES ('$first', '$last', '$country', '$organization', '$email', '$hashedPass');";
    mysqli_query($conn, $sql);


        $sql ="SELECT * FROM users WHERE user_email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $_SESSION['u_id'] = $row['user_id'];

    $_SESSION['u_first'] = $first;
    $_SESSION['u_last'] = $last;
    $_SESSION['u_country'] = $country;
    $_SESSION['user_organization'] = $organization;
    $_SESSION['u_email'] = $email;
    $_SESSION['u_timestamp'] = $row['user_timestamp'];
    echo "Login succesful!";

    header("Location: user_landing/index.php");
    exit();

}
else{
  header("Location: index.html");
}
