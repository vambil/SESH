<?php
  session_start();

      $conn = new mysqli('localhost', 'root', '', 'registration_storage');

      $sql ="DELETE FROM general WHERE contest_name = '$_SESSION[cur_contest]' ";

      if (mysqli_query($conn, $sql) == true) {
          echo "GENERAL Records deleted successfully";
      } else {
          echo "Error editing general record: ";
      }

      $sql2 = NULL;
      if($_SESSION['cur_type'] == "Early"){
        $sql2 ="DELETE FROM early_storage WHERE contest_name = '$_SESSION[cur_contest]' ";

      }elseif ($_SESSION['cur_type'] == "Mid") {
        $sql2 ="DELETE FROM mid_storage WHERE contest_name = '$_SESSION[cur_contest]' ";
      }elseif ($_SESSION['cur_type'] == "Completed") {
        $sql2 ="DELETE FROM completed_storage WHERE contest_name = '$_SESSION[cur_contest]' ";
      }

      if (mysqli_query($conn, $sql2) == true) {
          echo $_SESSION['cur_type']. "Records deleted successfully";
      } else {
          echo "Error editing". $_SESSION['cur_type'].  "record: ";
      }

      $conn->close();
      header("Location: index.php");
      die();
