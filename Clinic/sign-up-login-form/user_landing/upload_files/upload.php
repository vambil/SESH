<?php
  session_start();

  function pre_r($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
  }

  $phpfileuploaderrors = array(
    0 => 'there is no error',
    1 => 'filesize too big',
    2 => 'filesize too big for HTML form',
    3 => 'file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing tmp folder',
    7 => 'Failed to write file to disk',
    8 => 'PHP extension stopped file upload',
  );

  function reArrayFiles($file_post){
     $file_ary = array();
     $file_count = count($file_post['name']);
     $file_keys = array_keys($file_post);
     for ($i = 0; $i < $file_count; $i++) {
         foreach ($file_keys as $key) {
             $file_ary[$i][$key] = $file_post[$key][$i];
         }
     }
     return $file_ary;
   }

  if(isset($_POST['submit'])){

    $file = $_FILES['file'];
    //
    $file_array = reArrayFiles($file);
    // echo count($file_array);

    for($i = 0; $i<count($file_array); $i++){
      $user_name = $_SESSION['u_last']."_".$_SESSION['u_first'];
      $user_id = $_SESSION['u_id'];
      $contest_name = $_POST['contest_name'];

      $fileName = $file_array[$i]['name'];
      $fileName = $file_array[$i]['name'];
      $fileType = $file_array[$i]['type'];
      $fileTmpName = $file_array[$i]['tmp_name'];
      $fileError = $file_array[$i]['error'];
      $fileSize = $file_array[$i]['size'];
      // echo $fileSize;
      // exit;
      // if (isset($_SERVER["CONTENT_LENGTH"])) {
      //     echo '<script> alert("Filesize exceeds 500KB"); window.location.href=\'index.php\'; </script>';
      // }

      if($fileSize > 50000000){ // throw error if filesize is > 50MB
        echo '<script> alert("Filesize exceeds 500KB"); window.location.href=\'index.php\'; </script>';
      }

      if($file_array[$i]['error']){
        echo '<script> alert("An unexpected error came with your file. Please check your filesize, extention, and name"); window.location.href=\'index.php\'; </script>';
        // echo "<script> alert(\"".$fileName. " - ". $phpfileuploaderrors[$fileError] "\"); window.location.href=\"index.php\"; </script>";
        exit;

      }
      else{
        $allowed = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'wmv', 'doc', 'docx', 'zip', 'csv', 'pptx', 'ppt', 'xls','xlsx','mp4','mp3','docx','txt');
        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));
        // echo $fileExt;
        if(!in_array($fileExt, $allowed)){
            echo '<script> alert("Invalid file extension. Accepted file extensions are: jpg, jpeg, gif, png, pdf, wmv, doc, zip, csv, pptx, ppt, xls, xlsx, mp4, mp3, docx, txt"); window.location.href=\'index.php\'; </script>';
            exit;
        }else {
          //add timestamp to $fileName
          $fileNameNew = $user_name ."-". $user_id. "-".uniqid('',true).".".$fileExt;

          if (!file_exists("user_uploads/$user_name-$user_id/$contest_name") ) {
            echo "no directory exists";
            $tmp = $user_name."-".$user_id;
            mkdir("user_uploads/".$tmp."/".$contest_name);
          }

          move_uploaded_file($fileTmpName, "user_uploads/".$user_name ."-". $user_id."/".$contest_name."/".$fileNameNew);
          // echo $fileTmpName;

        }
      }
    }

    echo "File(s) uploaded sucessfully";
    echo "<script>window.close();</script>";

    // $fileName = $_FILES['file']['name'];
    // $fileType = $_FILES['file']['type'];
    // $fileTmpName = $_FILES['file']['tmp_name'];
    // $fileError = $_FILES['file']['error'];
    // $fileSize = $_FILES['file']['size'];
    //
    // $fileExt = strtolower(end(explode('.', $fileName)));
    //
    // $allowed = array('jpg', jpeg)
    // echo "succesgul";
  }
  ?>
