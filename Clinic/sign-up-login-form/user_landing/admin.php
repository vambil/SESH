<!-- //MY FILE -->
<?php
  session_start();
  // echo $_SESSION['u_first'];

?>

<!doctype html>
<html lang="en">

<head>


    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Admin Portal</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/SESH_logo.jpeg" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/style.css">

    <link href="search/search.css" rel="stylesheet" />

    <?php
        $conn = new mysqli('localhost', 'root', '', 'registration_storage');
        $sql ="SELECT * FROM general";

        $result = mysqli_query($conn, $sql);
        $all_contests = mysqli_num_rows($result);

        $all_early = 0;
        $all_mid = 0;
        $all_completed = 0;

        while($row = mysqli_fetch_array($result)){
          $stage = $row['stage'];
          if($stage == 'Early'){
              $all_early++;
          }elseif ($stage == 'Mid') {
              $all_mid++;// code...
          }elseif ($stage == 'Completed') {
              $all_completed++;// code...
          }
        }

        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        $all_users = mysqli_num_rows($result);


        function getGeneralRow($contest_name){
          $conn = new mysqli('localhost', 'root', '', 'registration_storage');
          $sql = "SELECT * FROM general WHERE contest_name = '$contest_name'";
          $result = mysqli_query($conn, $sql);
          return mysqli_fetch_array($result);
        }
        function getUserRow($email){
          $conn = new mysqli('localhost', 'root', '', 'registration_storage');
          $sql = "SELECT * FROM users WHERE user_email = '$email'";
          $result = mysqli_query($conn, $sql);
          return mysqli_fetch_array($result);
        }

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
            echo '<script language="javascript">';
            echo 'alert("ERROR, Contest is not found -- getRow()")';
            echo '</script>';
          }
          $result = mysqli_query($conn, $sql);

          return mysqli_fetch_array($result);
        }

        // DELETE ALL ZIP FILES
        array_map('unlink', glob( "*.zip"));

      ?>

      <style>
          hr {
            border-top: 1px solid #007bff;
            width:70%;
          }

          a {color: #000;}


          .card{
            background-color: #FFFFFF;
            padding:0;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius:4px;
            box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);
          }


          .card:hover{
            box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3);
            color:black;
          }

          address{
          margin-bottom: 0px;
          }




          #author a{
          color: #fff;
          text-decoration: none;

          }
      </style>

</head>

<body>

    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader_34">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER ENDS START ======-->

    <!--====== HEADER PART START ======-->

    <header id="home" class="header-area">
        <div class="navigation fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.php">
                                <img src="assets/images/SESH_logo.jpeg" alt="Logo" width="100" height="100">
                            </a> <!-- Logo -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active"><a class="page-scroll" href="#home">Home</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="#about">Statistics</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="#service">Contests</a></li>
                                    <!-- <li class="nav-item"><a class="page-scroll" href="#work">Search</a></li> -->
                                    <li class="nav-item"><a class="page-scroll" href="#pricing">Users</a></li>
                                    <!-- <li class="nav-item"><a class="page-scroll" href="#contact">Contact</a></li> -->
                                    <li class="nav-item"><a class="page-scroll" href="logout.php"><font color="red"><b>Logout</b></font> </a></li>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navigation -->

        <div id="parallax" class="header-content d-flex align-items-center">
            <div class="header-shape shape-one layer" data-depth="0.10">
                <img src="assets/images/banner/shape/shape-1.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-tow layer" data-depth="0.30">
                <img src="assets/images/banner/shape/shape-2.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-three layer" data-depth="0.40">
                <img src="assets/images/banner/shape/shape-3.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-fore layer" data-depth="0.60">
                <img src="assets/images/banner/shape/shape-2.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-five layer" data-depth="0.20">
                <img src="assets/images/banner/shape/shape-1.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-six layer" data-depth="0.15">
                <img src="assets/images/banner/shape/shape-4.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-seven layer" data-depth="0.50">
                <img src="assets/images/banner/shape/shape-5.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-eight layer" data-depth="0.40">
                <img src="assets/images/banner/shape/shape-3.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-nine layer" data-depth="0.20">
                <img src="assets/images/banner/shape/shape-6.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="header-shape shape-ten layer" data-depth="0.30">
                <img src="assets/images/banner/shape/shape-3.png" alt="Shape">
            </div> <!-- header shape -->
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="header-content-right">
                            <h4 class="sub-title">Crowdsourcing Clinic</h4>
                            <h1 class="title">ADMIN PORTAL</h1>
                            <a class="main-btn" href="#about">Overview</a>
                        </div> <!-- header content right -->
                    </div>
                    <div class="col-lg-6 offset-xl-1">
                        <div class="header-image d-none d-lg-block">
                            <img src="assets/images/banner/hero2.png" alt="hero">
                        </div> <!-- header image -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <!-- <div class="header-social">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-social-icon">
                                <ul>
                                    <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                                    <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                                    <li><a href="#"><i class="lni-behance-original"></i></a></li>
                                    <li><a href="#"><i class="lni-linkedin-original"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  -->

        </div> <!-- header content -->
    </header>

    <!--====== HEADER PART ENDS ======-->

    <!--====== ABOUT ME PART START ======-->

    <section id="about" class="about-area pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2 class="title">General Statistics</h2>
                        <!-- <p>Nunc id dui at sapien faucibus fermentum ut vel diam. Nullam tempus, nunc id efficitur sagittis, urna est ultricies eros, ac porta sem turpis quis leo.</p> -->
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content mt-50">
                        <h5 class="about-title"><?php echo $_SESSION['u_first']. " ". $_SESSION['u_last']; ?> </h5>
                        <!-- <p>Lo  rem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
                        <ul class="clearfix">
                            <li>
                                <div class="single-info d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="lni-calendar"></i>
                                    </div>
                                    <div class="info-text">
                                          <p><b><?php echo $all_contests ?> total contests</b></p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                            <li>
                                <div class="single-info d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="lni-envelope"></i>
                                    </div>
                                    <div class="info-text">
                                        <p><span></span><b> <?php echo $all_users; ?> total users</b></p>
                                    </div>
                                </div> <!-- single info -->
                            </li>

                            <!-- <li>
                                <div class="single-info d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="lni-map-marker"></i>
                                    </div>
                                    <div class="info-text">
                                        <p><span>Location:</span> <?php //echo $_SESSION["u_country"]; ?></p>
                                    </div>
                                </div>
                            </li> -->
                        </ul>
                    </div> <!-- about content -->
                </div>


                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <div class="about-skills pt-25">
                        <div class="skill-item mt-25">
                            <div class="skill-header">
                                <h6 class="skill-title">(<?php echo $all_early; ?>) Early</h6>
                                <div class="skill-percentage">
                                    <div class="count-box counted">
                                        <span class="counter"><?php if($all_early > 0){echo round($all_early*100/$all_contests);}else{echo "0";} ?></span>
                                    </div>
                                    %
                                </div>
                            </div>
                            <div class="skill-bar">
                                <div class="bar-inner">
                                    <div class="bar progress-line" data-width="<?php if($all_early > 0){echo round($all_early*100/$all_contests);}else{echo "0";} ?>"></div>
                                </div>
                            </div>
                        </div> <!-- skill item -->
                        <div class="skill-item mt-25">
                            <div class="skill-header">
                                <h6 class="skill-title">(<?php echo $all_mid; ?>) Mid</h6>
                                <div class="skill-percentage">
                                    <div class="count-box counted">
                                        <span class="counter"><?php if($all_mid > 0){echo round($all_mid*100/$all_contests);}else{echo "0";} ?></span>
                                    </div>
                                    %
                                </div>
                            </div>
                            <div class="skill-bar">
                                <div class="bar-inner">
                                    <div class="bar progress-line" data-width="<?php if($all_mid > 0){echo round($all_mid*100/$all_contests);}else{echo "0";} ?>"></div>
                                </div>
                            </div>
                        </div> <!-- skill item -->
                        <div class="skill-item mt-25">
                            <div class="skill-header">
                                <h6 class="skill-title">(<?php echo $all_completed; ?>) Complete</h6>
                                <div class="skill-percentage">
                                    <div class="count-box counted">
                                        <span class="counter"><?php if($all_completed > 0){echo round($all_completed*100/$all_contests);}else{echo "0";} ?></span>
                                    </div>
                                    %
                                </div>
                            </div>
                            <div class="skill-bar">
                                <div class="bar-inner">
                                    <div class="bar progress-line" data-width="<?php if($all_completed > 0){echo round($all_completed*100/$all_contests);}else{echo "0";} ?>"></div>
                                </div>
                            </div>
                        </div> <!-- skill item -->
                        <!-- <div class="skill-item mt-25">
                            <div class="skill-header">
                                <h6 class="skill-title">Sketch</h6>
                                <div class="skill-percentage">
                                    <div class="count-box counted">
                                        <span class="counter">90</span>
                                    </div>
                                    %
                                </div>
                            </div>
                            <div class="skill-bar">
                                <div class="bar-inner">
                                    <div class="bar progress-line" data-width="90"></div>
                                </div>
                            </div>
                        </div> -->
                         <!-- skill item -->
                    </div> <!-- about skills -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->

    <!--====== MY CONTESTS PART START ======-->

    <section id="service" class="services-area gray-bg pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-30">
                        <h2 class="title">All Contests</h2>

                        <?php

                          $conn = new mysqli('localhost', 'root', '', 'registration_storage');
                          $sql ="SELECT * FROM general ";

                          $result = mysqli_query($conn, $sql);
                          $numRows = mysqli_num_rows($result);
                          //see if there are any contests under this user
                          if($all_contests > 0){
                            echo "<p>There are <b>". $all_contests. "</b> contests registered. To create a new contest, click below! </br></a>.</p>";
                          }
                          else{
                            echo "<p>There are no contests that have beenr registered! </br></a>.</p>";
                          }
                          ?>
                          <?php
                              // $_SESSION['cur_contest'] = "new";
                              // $_SESSION['new_contest'] = true;
                              echo " <a class=\"main-btn\" href=\"register_form.php?contest_name=new\">New Contest</a> ";
                           ?>

                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->



<!-- HTML CODE displays only if there are contests available-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
      <div class="container-fluid">
        <div class="row">

        <?php
            for ($x = 0; $x < $numRows; $x++) {

              $row = mysqli_fetch_array($result);
              $this_row = getRow($row['contest_name']);
              $user_row = getUserRow($row['email']);
        ?>

            <!-- <a href="../../../register_form2.html"> -->
              <div class="col-md-4 mt-5">
                    <div class="card text-center">
                      <div class="card-body">
                        <h4> <?php echo $user_row['user_first']; ?> </h4>
                        <h5 class="card-title"> </br><?php echo $row['stage']. " | ". $row['contest_name']; ?> </h5>
                        <p><?php
                          echo "<b>Comments: </b>".$this_row['comments'];
                         ?></p>
                        <center><hr> </center>
                        <p><?php
                          echo "<b>Goal: </b>".$this_row['goal'];
                        ?></p>
                        <center><hr> </center>
                        <p>
                          <?php
                            echo "<b>Field: </b>". $this_row['field'];
                           ?>
                        </p>
                        <center><hr> </center>
                        <p>
                          <?php
                            echo "<b>Contest type: </b>". $this_row['contest_type'];
                           ?>
                       </p>
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11880.492291371422!2d12.4922309!3d41.8902102!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1524815927977" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                        <!-- <a href="https://goo.gl/maps/drPW7JdCdy62"><address class="font-italic">Piazza del Colosseo, 1, 00184 Roma RM</address></a> -->
                      </div>
                      <div class="card-footer text-muted">
                        <div class="row">
                          <!-- <div class="col">
                            <?php
                              // echo "<a href=\"register_form.php?contest_name=". $row['contest_name']. " \"><font color=\"blue\">edit</font></a>";
                            ?>

                          </div> -->
                          <div class="col">
                            <?php
                              echo "<a href=\"download.php?contest_name=". $row['contest_name']. "&user_id=". $user_row['user_id'] ." \"><font color=\"green\">download</font></a>";
                            ?>
                          </div>
                          <div class="col">

                            <?php
                              echo "<a href=\"delete_contest.php?contest_name=". $row['contest_name']. "&admin=true \"><font color=\"red\">delete</font></a>";
                            ?>

                            <!-- <a href="delete_contest.php?contest_name="><font color="red">delete</font></a> -->
                            <!-- <a><font color="red">delete</font></a> -->
                            <!-- <?php //echo "<a href=\"mailto:" . $_SESSION["u_email"] . "\"";?>><i class="fas fa-envelope"></i></a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </a>

          <?php
              // echo "The number is: $x <br>";
            }
          ?>

           </div>
         </div>






            <!-- <div class="col s12 m7">
              <div class="card horizontal">
                <div class="card-image">
                  <img src="https://lorempixel.com/100/190/nature/6">
                </div>
                <div class="card-stacked">
                  <div class="card-content">
                    <p>I am a very simple card. I am good at containing small bits of information.</p>
                  </div>
                  <div class="card-action">
                    <a href="#">This is a link</a>
                  </div>
                </div>
              </div>
            </div> -->



            <!-- row -->


        </div> <!-- container -->
    </section>

    <!--====== PRICING PART START ======-->


    <!-- <section id="about" class="about-area pt-125 pb-130"> -->
    <section id="pricing" class="about-area pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-25">
                        <h2 class="title">All Users</h2>
                        <p>Below are all the registered users! </p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->

            <div class="row justify-content-center">


              <?php
                  $conn = new mysqli('localhost', 'root', '', 'registration_storage');
                  $sql ="SELECT * FROM users";

                  $result = mysqli_query($conn, $sql);
                  $numRows = mysqli_num_rows($result);

                  for ($x = 0; $x < $numRows; $x++) {

                    $this_user = mysqli_fetch_array($result);

                    $sql2 = "SELECT * FROM general WHERE email = '$this_user[user_email]' ";
                    $result2 = mysqli_query($conn, $sql2);
                    $num_contests = mysqli_num_rows($result2);
              ?>

                <div class="col-lg-4 col-md-8 col-sm-9">
                    <div class="single-pricing text-center mt-30">
                        <div class="pricing-package">
                            <h4 class="package-title"><?php echo $this_user['user_first']. " ".$this_user['user_last'];  ?></h4>
                        </div>
                        <div class="pricing-body">
                            <div class="pricing-text">
                              <table align = "left" style="width:100%" >
                                <tr>
                                  <td>User id</td>
                                  <td><?php echo $this_user['user_id'];?></td>
                                </tr>
                                <tr>
                                  <td>Country</td>
                                  <td><?php echo $this_user['user_country'];?></td>
                                </tr>
                                <tr>
                                  <td>Organization</td>
                                  <td><?php echo $this_user['user_organization'];?></td>
                                </tr>
                                <tr>
                                  <td>Email</td>
                                  <td><?php echo $this_user['user_email'];?></td>
                                </tr>
                                <tr>
                                  <td>Joined</td>
                                  <td><?php echo $this_user['user_timestamp'];?></td>
                                </tr>
                              </table>

                                <span class="price"><?php echo $num_contests; ?>

                                   <?php if($num_contests == 1){
                                     echo "contest";
                                   }else {
                                     echo "contests";
                                   }?>

                                 </span>

                                 <h7>
                                 </br>
                                 </br>
                                 <div class="row">
                                   <div class="col">
                                     <?php
                                       echo "<a href=\"../index.php?user_id=". $this_user['user_id']. " \"><font color=\"blue\">edit</font></a>";
                                     ?>
                                   </div>
                                   <!-- <div class="col">
                                     <?php
                                     //echo "<a href=\"delete_user.php?user_id=". $this_user['user_id']. " \"><font color=\"green\">password</font></a>";
                                     ?>
                                   </div> -->
                                   <?php
                                    if($this_user['user_email'] != "clinic@seshglobal.org"){
                                      ?>
                                   <div class="col">
                                     <?php
                                        echo "<a href=\"delete_user.php?user_id=". $this_user['user_id']. " \"><font color=\"red\">delete</font></a>";
                                     ?>
                                   </div>
                                 <?php
                                   }
                                 ?>
                                 </div>
                               </h7>
                            </div>

                        </div>
                    </div> <!-- single pricing -->
                </div>
                <?php
                }
                 ?>


              </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PRICING PART ENDS ======-->

    <!--====== BLOG PART START ======-->


    <!--====== BLOG PART ENDS ======-->

    <!--====== CONTACT PART START ======-->


    <!--====== CONTACT PART ENDS ======-->

    <!--====== FOOTER PART START ======-->

    <footer id="footer" class="footer-area">


        <div class="footer-copyright pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text text-center pt-20">
                            <p>Copyright © 2022.  <a  rel="nofollow">UIdeck</a></p>
                        </div> <!-- copyright text -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer widget -->

    </footer>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->







    <!--====== jquery js ======-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>

    <!--====== Parallax js ======-->
    <script src="assets/js/parallax.min.js"></script>

    <!--====== Counter Up js ======-->
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>


    <!--====== Appear js ======-->
    <script src="assets/js/jquery.appear.min.js"></script>

    <!--====== Scrolling js ======-->
    <script src="assets/js/scrolling-nav.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>


    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>

</body>

</html>
