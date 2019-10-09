<!-- //MY FILE -->
<?php
    session_start();
    
    function getGeneralRow($contest_name){
      $conn = mysqli_connect("mysql.hostinger.com", "u612084811_root", "SESHllc2019", "u612084811_reg_storage");
      $sql = "SELECT * FROM general WHERE contest_name = '$contest_name'";
      $result = mysqli_query($conn, $sql);
      return mysqli_fetch_array($result);
    }
    function getUserRow($id){
      $conn = mysqli_connect("mysql.hostinger.com", "u612084811_root", "SESHllc2019", "u612084811_reg_storage");
      $sql = "SELECT * FROM users WHERE user_id = '$id'";
      $result = mysqli_query($conn, $sql);
      return mysqli_fetch_array($result);
    }
    
    function getRow($contest_name){
      $conn = mysqli_connect("mysql.hostinger.com", "u612084811_root", "SESHllc2019", "u612084811_reg_storage");
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
        echo '<script language="javascript">';
        echo 'alert("ERROR, Contest is not found -- getRow()")';
        echo '</script>';
      }
      $result = mysqli_query($conn, $sql);
    
      return mysqli_fetch_array($result);
    }
    
    // DELETE ALL ZIP FILES
    array_map('unlink', glob( "*.zip"));
    $conn = mysqli_connect("mysql.hostinger.com", "u612084811_root", "SESHllc2019", "u612084811_reg_storage");
      
    $general_row = getGeneralRow($_GET['contest_name']);
    $row = getRow($_GET['contest_name']);
    $stage = $general_row['stage'];
    $contest_name = $_GET['contest_name'];
    

    if($stage == "Early"){
        $sql = "SELECT * FROM early_storage WHERE contest_name = '$contest_name'";
        $result = mysqli_query($conn, $sql);
        $early = mysqli_fetch_array($result);
        
        echo 
        '<table class="GeneratedTable" id="customers">
                <thead>
                  <tr>
                    <th><b>Early Questions</b></th>
                    <th><b>Answers</b></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Goal of the Contest</td>
                    <td>'.$early['goal'].'</td>
                  </tr>
                  <tr>
                    <td>Contest Type</td>
                    <td>'.$early['field'].'</td>
                  </tr>
                  <tr>
                    <td>Online?</td>
                    <td>'.$early['online'].'</td>
                  </tr>
                  <tr>
                    <td><b>Comments</b></td>
                    <td>'.$early['comments'].'</td>
                  </tr>
                </tbody>
              </table>
            </body>
        </html>';
        
    }else if($stage == "Mid"){
        $sql = "SELECT * FROM mid_storage WHERE contest_name = '$contest_name'";
        $result = mysqli_query($conn, $sql);
        $mid = mysqli_fetch_array($result);
        
        echo '<table class="GeneratedTable" id="customers">
                <thead>
                  <tr>
                    <th><b>Mid Questions</b></th>
                    <th><b>Answers</b></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Goal of the Contest</td>
                    <td>'.$mid['goal'].'</td>
                  </tr>
                  <tr>
                    <td>Contest Type</td>
                    <td>'.$mid['contest_type'].'</td>
                  </tr>
                  <tr>
                    <td>Field</td>
                    <td>'.$mid['field'].'</td>
                  </tr>
                  <tr>
                    <td>Online?</td>
                    <td>'.$mid['online'].'</td>
                  </tr>
                  <tr>
                    <td>Target Audience</td>
                    <td>'.$mid['target'].'</td>
                  </tr>
                  <tr>
                    <td>Tupe of Entries</td>
                    <td>'.$mid['entry_type'].'</td>
                  </tr>
                  <tr>
                    <td>Promotional Strategy</td>
                    <td>'.$mid['promotion_strategy'].'</td>
                  </tr>
                  <tr>
                    <td>Team Size</td>
                    <td>'.$mid['team_size'].'</td>
                  </tr>
                  <tr>
                    <td>Partner Organizations</td>
                    <td>'.$mid['partners'].'</td>
                  </tr>
                  <tr>
                    <td>Contest Date</td>
                    <td>'.$mid['contest_date'].'</td>
                  </tr>
                  <tr>
                    <td><b>Comments</b></td>
                    <td>'.$mid['comments'].'</td>
                  </tr>
                </tbody>
              </table>
            </body>
        </html>';
        
        
    }else if($stage == "Completed"){
        $sql = "SELECT * FROM completed_storage WHERE contest_name = '$contest_name'";
        $result = mysqli_query($conn, $sql);
        $completed = mysqli_fetch_array($result);
        
        
        echo
          '<table class="GeneratedTable" id="customers">
                <thead>
                  <tr>
                    <th><b>Completed Questions</b></th>
                    <th><b>Answers</b></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Goal of the Contest</td>
                    <td>'.$completed['goal'].'</td>
                  </tr>
                  <tr>
                    <td>Contest Type</td>
                    <td>'.$completed['contest_type'].'</td>
                  </tr>
                  <tr>
                    <td>Field</td>
                    <td>'.$completed['field'].'</td>
                  </tr>
                  <tr>
                    <td>Online?</td>
                    <td>'.$completed['online'].'</td>
                  </tr>
                  <tr>
                    <td>Target Audience</td>
                    <td>'.$completed['target'].'</td>
                  </tr>
                  <tr>
                    <td>Tupe of Entries</td>
                    <td>'.$completed['entry_type'].'</td>
                  </tr>
                  <tr>
                    <td>Promotional Strategy</td>
                    <td>'.$completed['promotion_strategy'].'</td>
                  </tr>
                  <tr>
                    <td>Team Size</td>
                    <td>'.$completed['team_size'].'</td>
                  </tr>
                  <tr>
                    <td>Partner Organizations</td>
                    <td>'.$completed['partners'].'</td>
                  </tr>
                  <tr>
                    <td>Contest Date</td>
                    <td>'.$completed['contest_date'].'</td>
                  </tr>
                  <tr>
                    <td>Number of Submissions</td>
                    <td>'.$completed['num_submissions'].'</td>
                  </tr>
                  <tr>
                    <td>Contest Summary</td>
                    <td>'.$completed['contest_summary'].'</td>
                  </tr>
                  <tr>
                    <td>Contest Sharing</td>
                    <td>'.$completed['contest_sharing'].'</td>
                  </tr>
                  <tr>
                    <td>Shared Links</td>
                    <td>'.$completed['shared_links'].'</td>
                  </tr>
                  <tr>
                    <td><b>Comments</b></td>
                    <td>'.$completed['comments'].'</td>
                  </tr>
                </tbody>
              </table>
            </body>
        </html>';
    }
    
?>

<!doctype html>
<html lang="en">
<head>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>

</html>
