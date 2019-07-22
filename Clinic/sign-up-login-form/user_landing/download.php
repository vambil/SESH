<?php
session_start();


$folder_name = $_SESSION['u_last']. "_". $_SESSION['u_first']."-".$_SESSION['u_id'];
$folder_path = "upload_files/user_uploads/".$folder_name."/".$_GET['contest_name'];

if(!file_exists($folder_path)){
  if($_SESSION['u_email'] == "clinic@seshglobal.org"){
    echo '<script> alert("There are no files uploaded for this contest"); window.location.href=\'admin.php\'; </script>';
    exit();
  }else {
    echo '<script> alert("There are no files uploaded for this contest"); window.location.href=\'index.php#work\'; </script>';
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

// header("Location: index.php#service");
exit;


// header('Content-Length: ' . filesize($zipname));
// readfile($zipname);



// foreach($files as $file) {
//   if ('.' === $file) continue;
//   if ('..' === $file) continue;
//   // if($file == 'Tucker_Joe-1-5d2c93d8d6c595.07083044.gif') continue;
//   $file_path = $folder_path. "/". $file;
//
//   // echo "<p>".$file_path. "</br></p>";
//   header("Cache-Control: public");
//   header("Content-Description: File Transfer");
//   header("Content-Disposition: attachment; filename=$file");
//   header("Content-Type: application/zip");
//   header("Content-Transfer-Encoding: binary");
//   readfile($file_path);
//   exit;
// }



?>
