<?php
session_start();

function getGeneralRow($contest_name){
  $conn = new mysqli('localhost', 'root', '', 'registration_storage');
  $sql = "SELECT * FROM general WHERE contest_name = '$contest_name'";
  $result = mysqli_query($conn, $sql);
  return mysqli_fetch_array($result);
}



if(isset($_GET['contest_name'])){
      // $bool =  '<script> confirm("Are you sure you want to leave delete this contest?");</script>';

      // if($bool){
        // echo "YAY";
      // }
      // $bool = NULL;

      // die();

      $conn = new mysqli('localhost', 'root', '', 'registration_storage');
      $row = getGeneralRow($_GET['contest_name']);
      $contest_stage = $row['stage'];

      $sql ="DELETE FROM general WHERE contest_name = '$_GET[contest_name]' ";

      if (mysqli_query($conn, $sql) == true) {
          echo "GENERAL Records deleted successfully";
      } else {
          echo "Error editing general record: ";
      }

      $sql2 = NULL;
      if($contest_stage == "Early"){
        $sql2 ="DELETE FROM early_storage WHERE contest_name = '$_GET[contest_name]' ";

      }elseif ($contest_stage == "Mid") {
        $sql2 ="DELETE FROM mid_storage WHERE contest_name = '$_GET[contest_name]' ";
      }elseif ($contest_stage == "Completed") {
        $sql2 ="DELETE FROM completed_storage WHERE contest_name = '$_GET[contest_name]' ";
      }

      if (mysqli_query($conn, $sql2) == true) {
          echo $contest_stage. "Records deleted successfully";
      } else {
          echo "Error editing". $contest_stage.  "record: ";
      }

      $conn->close();
      header("Location: index.php#service");
      die();
}
