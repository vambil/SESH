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
    
    $user_row = getUserRow($_GET["userId"]);
    
    $conn = mysqli_connect("mysql.hostinger.com", "u612084811_root", "SESHllc2019", "u612084811_reg_storage");
    $sql ="SELECT * FROM general WHERE email = '$user_row[user_email]' ";
    
    $general_row = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($general_row);
    
    
    // $all_early = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM early_storage"));
    // $all_mid = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mid_storage"));
    // $all_completed = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM completed_storage"));
    
    // $all_contests = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM general"));

?>

<!doctype html>
<html lang="en">

<head>
    
    <!-- Hotjar Tracking Code for http://crowdsourcingclinic.org -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1443129,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title><?php echo $user_row['user_first']; ?> - Crowdsourcing Profile</title>

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
        //see if there are any contests under this user
        

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
                                    <li class="nav-item"><a class="page-scroll" href="#about">About</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="#service">Contests</a></li>
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
                            <!--<h4 class="sub-title">Welcome</h4>-->
                            <h1 class="title"><?php echo "{$user_row['user_first']}" ?> <?php echo $user_row['user_last']; ?></h1>
                            <a class="main-btn" href="#service">View Contests</a>
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
                        <h2 class="title">About <?php echo $user_row['user_first']; ?></h2>
                        <!-- <p>Nunc id dui at sapien faucibus fermentum ut vel diam. Nullam tempus, nunc id efficitur sagittis, urna est ultricies eros, ac porta sem turpis quis leo.</p> -->
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content mt-50">
                        <h5 class="about-title"><?php echo $user_row["user_first"]; ?>  <?php echo $user_row["user_last"]; ?></h5>
                        <!-- <p>Lo  rem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
                        <ul class="clearfix">
                            <li>
                                <div class="single-info d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="lni-calendar"></i>
                                    </div>
                                    <div class="info-text">
                                          <p><span>Joined the SESH Clinic:</span> </br><?php
                                            $datestring =  $user_row["user_timestamp"];
                                            $pieces = explode(" ", $datestring);
                                            echo $pieces[0];
                                          ?></p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                            <li>
                                <div class="single-info d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="lni-envelope"></i>
                                    </div>
                                    <div class="info-text">
                                        <p><span>Email:</span> <?php echo $user_row["user_email"]; ?></p>
                                    </div>
                                </div> <!-- single info -->
                            </li>

                            <li>
                                <div class="single-info d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="lni-map-marker"></i>
                                    </div>
                                    <div class="info-text">
                                        <p><span>Location:</span> <?php echo $user_row["user_country"]; ?></p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                        </ul>
                    </div> <!-- about content -->
                </div>
                <?php
                    $earlyCount = 0;
                    $midCount = 0;
                    $completeCount = 0;
                    while($row = mysqli_fetch_array($general_row)){
                      $stage = $row['stage'];
                      if($stage == 'Early'){
                          $earlyCount++;
                      }elseif ($stage == 'Mid') {
                          $midCount++;// code...
                      }elseif ($stage == 'Completed') {
                          $completeCount++;// code...
                      }
                    }
                    // echo $numRows;

                  ?>

                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <div class="about-skills pt-25">
                        <div class="skill-item mt-25">
                            <div class="skill-header">
                                <h6 class="skill-title">Early</h6>
                                <div class="skill-percentage">
                                    <div class="count-box counted">
                                        <span class="counter"><?php if($numRows > 0){echo round($earlyCount*100/$numRows);}else{echo "0";} ?></span>
                                    </div>
                                    %
                                </div>
                            </div>
                            <div class="skill-bar">
                                <div class="bar-inner">
                                    <div class="bar progress-line" data-width="<?php if($numRows > 0){echo round($earlyCount*100/$numRows);}else{echo "0";} ?>"></div>
                                </div>
                            </div>
                        </div> <!-- skill item -->
                        <div class="skill-item mt-25">
                            <div class="skill-header">
                                <h6 class="skill-title">Mid</h6>
                                <div class="skill-percentage">
                                    <div class="count-box counted">
                                        <span class="counter"><?php if($numRows > 0){echo round($midCount*100/$numRows);}else{echo "0";} ?></span>
                                    </div>
                                    %
                                </div>
                            </div>
                            <div class="skill-bar">
                                <div class="bar-inner">
                                    <div class="bar progress-line" data-width="<?php if($numRows > 0){echo round($midCount*100/$numRows);}else{echo "0";} ?>"></div>
                                </div>
                            </div>
                        </div> <!-- skill item -->
                        <div class="skill-item mt-25">
                            <div class="skill-header">
                                <h6 class="skill-title">Complete</h6>
                                <div class="skill-percentage">
                                    <div class="count-box counted">
                                        <span class="counter"><?php if($numRows > 0){echo round($completeCount*100/$numRows);}else{echo "0";} ?></span>
                                    </div>
                                    %
                                </div>
                            </div>
                            <div class="skill-bar">
                                <div class="bar-inner">
                                    <div class="bar progress-line" data-width="<?php if($numRows > 0){echo round($completeCount*100/$numRows);}else{echo "0";} ?>"></div>
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
                        <h2 class="title"><?php echo $user_row['user_first']; ?>'s Contests</h2>

                        <?php

                          $conn = mysqli_connect("mysql.hostinger.com", "u612084811_root", "SESHllc2019", "u612084811_reg_storage");
                          $sql ="SELECT * FROM general WHERE email = '$user_row[user_email]' ";

                          $result = mysqli_query($conn, $sql);
                          $numRows = mysqli_num_rows($result);
                          //see if there are any contests under this user
                          if($numRows > 0){
                            echo "<p>". $user_row['user_first']. " has created <b>". $numRows. "</b> challenge(s).</br></a>.</p>";
                          }
                          else{
                            echo "<p>". $user_row['user_first']. " has not yet created a contest. </br></a>.</p>";
                          }
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
        ?>

        <!-- <h3>   <?php //echo $row['contest_name']; ?></br></h3> -->


            <!-- <a href="../../../register_form2.html"> -->
          <a href="contest_info.php?contest_name=<?php echo $row['contest_name'];?>" target="_blank">
              <div class="col-md-4 mt-5">
                    <div class="card text-center">
                      <div class="card-body">
                        <h5 class="card-title"> <?php echo $row['stage']. ": ". $row['contest_name']; ?> </h5>
                        <p><?php
                          echo "<b>Goal: </b>". $this_row['goal'];
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
                          
                          <div class="col">
                            <?php
                              echo "<a href=\"download.php?contest_name=". $row['contest_name']. "&user_id=". $_SESSION['u_id'] ." \"><font color=\"green\">download</font></a>";
                            ?>
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

    <!--====== MY CONTESTS PART ENDS ======-->

    <!--====== CALL TO ACTION PART START ======-->

    <section  id="call-to-action" class="call-to-action pt-125 pb-130 bg_cover" height = "30px" style="background-image: url(../../Images/Home-img.jpg)">
        <div height="10px" class="container">
            <div class="row justify-content-center">
                <div class="col-xl-14 col-lg-12">
                    <div class="call-action-content text-center">
                        <h3 class="action-title">Learn more about Crowdsourcing.</h3>
                        <p>
                          

                          <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua nostrud. -->
                        </p>
                        <ul>
                            <!-- <li><a class="main-btn custom" href="#">download cv</a></li> -->
                            <li><a class="main-btn custom-2" href="http://crowdsourcingclinic.org">Get Connected</a></li>
                        </ul>
                    </div> <!-- call action content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CALL TO ACTION PART ENDS ======-->

    <!--====== WORK PART START ======-->

    
    <!--====== CONTACT PART START ======-->

    <section id="contact" class="contact-area pt-125 pb-130 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-25">
                        <h2 class="title">Get In Touch</h2>
                        <p>Feel free to reach out to the SESH team at any point! We are here to help you</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="contact-box text-center mt-30">
                        <div class="contact-icon">
                            <i class="lni-map-marker"></i>
                        </div>
                        <div class="contact-content">
                            <h6 class="contact-title">Address</h6>
                            <p>Guangzhou, China</p>
                        </div>
                    </div> <!-- contact box -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="contact-box text-center mt-30">
                        <div class="contact-icon">
                            <i class="lni-phone"></i>
                        </div>
                        <div class="contact-content">
                            <h6 class="contact-title">Phone</h6>
                            <p>020 7636 8636</p>
                        </div>
                    </div> <!-- contact box -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="contact-box text-center mt-30">
                        <div class="contact-icon">
                            <i class="lni-envelope"></i>
                        </div>
                        <div class="contact-content">
                            <h6 class="contact-title">Email</h6>
                            <p>clinic@seshglobal.org</p>
                        </div>
                    </div> <!-- contact box -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-form pt-30">
                        <form id="contact-form" action="mailto:clinic@seshglobal.org" method="post" >
                            <div class="single-form">
                                <input type="text" name="name" value = <?php echo $_SESSION['u_first']." ".$_SESSION['u_last']. ""; ?> placeholder="Name">
                            </div> <!-- single form -->
                            <div class="single-form">
                                <input type="email" name="email" value = <?php echo $_SESSION['u_email']; ?> placeholder="Email">
                            </div> <!-- single form -->
                            <div class="single-form">
                                <textarea name="message" placeholder="Message"></textarea>
                            </div> <!-- single form -->
                            <p class="form-message"></p>
                            <div class="single-form">
                                <button class="main-btn" type="submit">Send Message</button>
                            </div> <!-- single form -->
                        </form>
                    </div> <!-- contact form -->
                </div>
                <div class="col-lg-6">
                    <div class="contact-map mt-60">
                        <div class="gmap_canvas">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9930.324421317933!2d-0.1302803!3d51.5209007!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8089d33bffbf9f00!2sLondon+School+of+Hygiene+%26+Tropical+Medicine!5e0!3m2!1sen!2suk!4v1562344053597!5m2!1sen!2suk" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                          <!--
                            <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Mission%20District%2C%20San%20Francisco%2C%20CA%2C%20USA&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> -->
                        </div>
                    </div> <!-- contact map -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->

    <!--====== FOOTER PART START ======-->

    <footer id="footer" class="footer-area">
        <div class="footer-widget pt-130 pb-130">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-15">
                        <div class="footer-content text-center">
                            <a href="index.php">
                                <img src="assets/images/SESH_long.jpg" alt="Logo">
                            </a>
                            <p class="mt-">
                              The SESH (Social Entrepreneurship to Spur Health) project is a partnership joining individuals from the Southern Medical University Dermatology Hospital and the University of North Carolina-Project China. The main goal of this project is to create more creative, equitable, and effective health services using crowdsourcing contests and other social entrepreneurship tools. Crowdsourcing is the process of having a group solve a problem and then sharing that solution widely with the public.
                            </p>
                            <!-- <ul>
                                <li><a href="https://www.facebook.com/seshglobal/"><i class="lni-facebook-filled"></i></a></li>
                                <li><a href="https://twitter.com/sesh_global"><i class="lni-twitter-original"></i></a></li>
                            </ul> -->
                        </div> <!-- footer content -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer widget -->

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
