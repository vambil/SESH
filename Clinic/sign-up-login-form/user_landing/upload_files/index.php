<?php
  session_start();

 ?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title><?php echo $_SESSION['u_first']; ?> - Upload Portal</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


      <link rel="stylesheet" href="./style.css">


</head>

<body>

  <form method="post" class="file-uploader" action="upload.php" enctype="multipart/form-data">
  <div class="file-uploader__message-area">
    <h2><b>Select file(s) to upload</b></h2>
  </div>
  <label for="contest_name"><center>Enter the contest name <b>EXACTLY</b> as it appears on your registration form.</center></label>
  <center><input type="text" name="contest_name" required></center>

  <div class="file-chooser">
    <input class="file-chooser__input" type="file" name = "file[]" multiple>
  </div>
  <span class="help-block" id="hint_text2">
    <center><i>To attach multiple files, select more than one file when browsing for files.</i></center>
  </span>

  <button type="submit" name="submit" class="file-uploader__submit-button" >UPLOAD</button>
  <!-- <input class="file-uploader__submit-button" name="sumbit" type="submit" value="Upload"> -->
</form>
  <!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->



    <script  src="./script.js"></script>




</body>

</html>
