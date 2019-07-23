<?php
                                                  // DELETES USER AND ALL OF THEIR CONTESTS...

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


if(isset($_GET['user_id'])){

      $conn = new mysqli('localhost', 'root', '', 'registration_storage');
      $user_row = getUserRow($_GET['user_id']);

      $sql = "DELETE FROM general WHERE email = '$user_row[user_email]';
              DELETE FROM early_storage WHERE email = '$user_row[user_email]';
              DELETE FROM mid_storage WHERE email = '$user_row[user_email]';
              DELETE FROM completed_storage WHERE email = '$user_row[user_email]';
              DELETE FROM users WHERE user_id = '$_GET[user_id]'";

      if(mysqli_multi_query($conn, $sql)){
        echo "User deleted successfully";
      }else {
        echo "Error in deleting user records";
        echo("Error description: " . mysqli_error($conn));
      }

      $conn->close();
      header("Location: admin.php");
      die();
}
