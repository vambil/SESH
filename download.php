<?php
session_start();

function getUserRow($id){
  $conn = mysqli_connect("mysql.hostinger.com", "u612084811_root", "SESHllc2019", "u612084811_reg_storage");
  $sql = "SELECT * FROM users WHERE user_id = '$id'";
  $result = mysqli_query($conn, $sql);
  return mysqli_fetch_array($result);
}

if($_GET['user_id'] == $_SESSION['u_id']){
  $first = $_SESSION['u_first'];
  $last = $_SESSION['u_last'];
}else {
  $user_row = getUserRow($_GET['user_id']);
  $first = $user_row['user_first'];
  $last = $user_row['user_last'];
}

$folder_name = $last. "_". $first."-".$_GET['user_id'];
$folder_path = "upload_files/user_uploads/".$folder_name."/".$_GET['contest_name'];

if(!file_exists($folder_path)){
  if($_SESSION['u_email'] == "clinic@seshglobal.org"){
    echo '<script> alert("There are no files uploaded for this contest"); window.location.href=\'admin.php\'; </script>';
    exit();
  }else {
    echo '<script> alert("There are no files uploaded for this contest"); window.location.href=\'index.php\'; </script>';
    exit;
  }
  // header("Location: index.php#service");
}

//   echo '<script> alert("You have not uploaded any files for this contest");</script>';
// if(chdir($folder_path)){
// }else {
// echo '<script> alert("You have not uploaded any files for this contest");</script>';
// }




$zipname = $_GET['contest_name'].'.zip';

$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);

// $zip->addFile('upload_files/user_uploads/Tucker_Joe-1/Early_test_01/Tucker_Joe-1-5d2c9442a07b51.26992416.txt');

$files = scandir($folder_path);
foreach ($files as $file) {
  if ('.' === $file) continue;
  if ('..' === $file) continue;

  $file_path = $folder_path."/".$file;
  // echo "<p>".$file_path. "</br></p>";
  $zip->addFile($file_path, $file);
  // header('Content-Type: application/zip');
  // header('Content-disposition: attachment; filename='.$zipname);
}
$zip->close();
header('Content-Type: application/zip');
header("Content-Disposition: attachment; filename=' " .basename($zipname). "'");
// header('Content-Length: ' . filesize($zipname));
header("Location: ". $zipname);
readfile($zipname);

exit;

?>
