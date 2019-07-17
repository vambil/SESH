<?php

session_start();

function getRow($contest_name){
  $conn = new mysqli('localhost', 'root', '', 'registration_storage');
  $sql = "SELECT * FROM general WHERE contest_name = '$contest_name'";
  $result = mysqli_query($conn, $sql);
  $general_row = mysqli_fetch_array($result);

  $stage = $general_row['stage'];

  if($stage == "Early"){
    $sql = "SELECT * FROM early_storage where contest_name = '$contest_name'";
  }elseif ($stage == "Mid") {
    $sql = "SELECT * FROM mid_storage where contest_name = '$contest_name'";
  }elseif ($stage == "Completed") {
    $sql = "SELECT * FROM completed_storage where contest_name = '$contest_name'";
  }else{
    echo "ERROR, Contest is not found";
  }
  $result = mysqli_query($conn, $sql);

  return mysqli_fetch_array($result);
}


if(isset($_POST['search'])){
  // echo "hELO";
  $_SESSION['search_stage'] = $_POST['search_stage'];
  $_SESSION['search_contest_type'] = $_POST['search_contest_type'];
  $_SESSION['search_field'] = $_POST['search_field'];
  $_SESSION['search_text'] = $_POST['search_text'];

  $_SESSION['search_storage'] = array();
  // echo $_SESSION['search_text'];

  $conn = new mysqli('localhost', 'root', '', 'registration_storage');

  $sql = NULL;
  if($_SESSION['search_stage'] == "all"){
    //look through early,mid, and complete
    $sql ="SELECT * FROM general";
  }else {
    $sql ="SELECT * FROM general WHERE stage = '$_SESSION[search_stage]' ";
  }
  // echo $_SESSION['search_field'];

  $result = mysqli_query($conn, $sql);
  $_SESSION['numRows'] = mysqli_num_rows($result);

  //go through all the contests
  for ($i = 0; $i < $_SESSION['numRows']; $i++) {
      $cur_contest_name = mysqli_fetch_array($result)['contest_name'];
      //echo $cur_contest_name. "  --> () ";
      $cur_row = getRow($cur_contest_name);

      // echo $_SESSION['search_contest_type']. "  VS   ". $cur_row['contest_type']. "       |||  ";

      if($_SESSION['search_contest_type'] != "all"){
          if($cur_row['contest_type'] != $_SESSION['search_contest_type']){
            // echo "failed contest_type    ]]]";
            continue;
          }
      }
      if($_SESSION['search_field'] != "all"){
        if($cur_row['field'] != $_SESSION['search_field']){
          // echo "failed field    ]]]";
          continue;
        }
      }
      //check search text here

      //at this point, $cur_row is part of the search result, so you can display the card below
      echo $cur_contest_name. " -->   (SELECTED)    ";
      array_push($_SESSION['search_storage'],$cur_contest_name);
  }

  header("Location: index.php#work");


}
