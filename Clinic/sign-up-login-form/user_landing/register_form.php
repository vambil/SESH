

<html>
	<head>
		<!--JavaScript and CSS -->
    <?php
      session_start();

      function getRow($contest_name){
        $conn = new mysqli('localhost', 'root', '', 'registration_storage');
        $sql = "SELECT * FROM general WHERE contest_name = '$contest_name'";
        $result = mysqli_query($conn, $sql);
        $general_row = mysqli_fetch_array($result);

        $stage = $general_row['stage'];

        if($stage == "Early"){
          $sql2 = "SELECT * FROM early_storage where contest_name = '$contest_name'";
        }elseif ($stage == "Mid") {
          $sql2 = "SELECT * FROM mid_storage where contest_name = '$contest_name'";
        }elseif ($stage == "Completed") {
          $sql2 = "SELECT * FROM completed_storage where contest_name = '$contest_name'";
        }else{
          echo '<script language="javascript">';
          echo 'alert("ERROR, Contest is not found -- getRow()")';
          echo '</script>';
        }
        $result2 = mysqli_query($conn, $sql2);

        return mysqli_fetch_array($result2);
      }

      function getGeneralRow($contest_name){
        $conn = new mysqli('localhost', 'root', '', 'registration_storage');
        $sql = "SELECT * FROM general WHERE contest_name = '$contest_name'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_array($result);
      }

      if($_GET['contest_name'] != "new") {
        $_SESSION['new_contest'] = false;
        $_SESSION['cur_row'] = getRow($_GET['contest_name']);
        $_SESSION['general_row'] = getGeneralRow($_GET['contest_name']);
        $_SESSION['cur_stage'] = $_SESSION['general_row']['stage'];


        // echo '<h1>';
        // echo "contest name == ". $_SESSION['new_contest'];
        // echo '</h1>';
              //general_row = $_SESSION['general_row']
              // the contest stage = $_SESSION['cur_stage'];

      }else {
        $_SESSION['new_contest'] = true;
      }
        // echo "<a href=\"index.php?contest_name=". $row['contest_name']. " \">edit</a>";

    ?>




		<script src="jquery.min.js"></script>
		<script src="conditional.js"></script>
		<link rel="stylesheet" href="bootstrap-iso.css" /> <!-- https://formden.com/blog/isolate-bootstrap -->
				<script>

				function early(){
					setAllEarly();
					removeAllMid();
					removeAllComplete();
				}
				function mid(){
					setAllMid();
					removeAllEarly();
					removeAllComplete();
				}
				function completed(){
					setAllComplete();
					removeAllEarly();
					removeAllMid();
				}


				// function removeEarlyReq(){
					//alert("Hello! I am an alert box!!");
				// 	 document.getElementById("early_questions").removeAttribute("required");
				// }

				function removeAllEarly(){
					// document.getElementById("early_questions").required = false;
					document.getElementById("early_questions").removeAttribute("required");
					document.getElementById("early_online1").removeAttribute("required");
				}
				function setAllEarly(){
					document.getElementById("early_questions").required = true;
					document.getElementById("early_online1").required = true;
					//document.getElementByName("early_online").required = true;
					//document.getElementById("early_online").setAttribute("required",null);
				}


				function removeAllMid(){
					document.getElementById("mid_questions").removeAttribute("required");
					document.getElementById("mid_online2").removeAttribute("required");
					document.getElementById("mid_target").removeAttribute("required");
					document.getElementById("mid_entry_type").removeAttribute("required");
					document.getElementById("mid_partners").removeAttribute("required");
				}
				function setAllMid(){
					document.getElementById("mid_questions").required = true;
					document.getElementById("mid_online2").required = true;
					document.getElementById("mid_target").required = true;
					document.getElementById("mid_entry_type").required = true;
					document.getElementById("mid_partners").required = true;
				}

				function removeAllComplete(){
					document.getElementById("completed_questions").removeAttribute("required");
					document.getElementById("completed_online3").removeAttribute("required");
					document.getElementById("completed_target").removeAttribute("required");
					document.getElementById("completed_entry_type").removeAttribute("required");
					document.getElementById("completed_partners").removeAttribute("required");

					document.getElementById("completed_num_submissions").removeAttribute("required");
					document.getElementById("completed_contest_summary").removeAttribute("required");
				}
				function setAllComplete(){
					document.getElementById("completed_questions").required = true;
					document.getElementById("completed_online3").required = true;
					document.getElementById("completed_target").required = true;
					document.getElementById("completed_entry_type").required = true;
					document.getElementById("completed_partners").required = true;

					document.getElementById("completed_num_submissions").required = true;
					document.getElementById("completed_contest_summary").required = true;
				}

		    </script>
				<style>
					p.ex1 {
					  margin-left: 300px;
					}
				</style>

	</head>
	<body>

		<!-- <center><h1>Registration Form</h1></center> -->

<!-- GENERAL QUESTIONS-->
	<div class="bootstrap-iso">
		<center><h1><b>Registration Form
      <?php
        if(!$_SESSION['new_contest']){
          echo " - Editable Version";
        }
       ?>
      <b></h1></center>

		<div class="container-fluid">
			<div class="row">
				<div style="margin-left:150px;"class="col-sm-8" >
					<!-- <p class="ex1"> -->
					<h4>
						We would like to thank you for your interest in using crowdsourcing methods for your project!</br></br>
						In order for SESH to give you the best feedback/resources on your contest, we need to get some background information. For this reason we ask that you complete the registration form below.
						This information will be used to help SESH give you the best resources. In addition, your contest will be part of the Crowdsourcing Clinic contest network!
				</h4>
				<script>
				function submitConfirm(c){
					if(c == true){
						alert('Thank you for registering your contest! Our team will be in touch with you shortly!');
						return true;
					}
					return false;
				}
				</script>
					<form onsubmit="return submitConfirm(confirm('Are you sure you want to submit?'));" action="insert.php"  method="post" id="live_form" >

						<!-- <div class="form-group ">
              <label class="control-label requiredField" for="name">
              Full Name
              <span class="asteriskField">
              *
              </span>
              </label>
            <input class="form-control" id="name" name="name" type="text" required/>
            </div>

            <div class="form-group ">
            <label class="control-label requiredField" for="email">
             Email
             <span class="asteriskField">
              *
             </span>

            </label>
            <input class="form-control" id="email" name="email" type="text" required/>
						<span class="help-block">
						 Please use the same email that you used to sign up!
						</span>
           </div> -->


					 <div class="form-group ">
					 	<label class="control-label " for="text">
						</br>Name of Contest
					 	</label>
					 	<input class="form-control" id="contest_name" name="contest_name" type="text"

            value="<?php
                  if(!$_SESSION['new_contest']){
                    echo $_SESSION['cur_row']['contest_name'];
                  }
            ?>"

            <?php
                  if(!$_SESSION['new_contest']){
                    echo "disabled";
                  }
            ?>

            />
					  </div>
					  <span class="help-block">
					 	Please choose a unique contest name.
					  </span>


           <div class="form-group ">
            <label class="control-label " for="select">
             Country of the contest (if online, choose Other)
            </label>
            <select id="country" name="country" class="form-control" value="<?php
                  if(!$_SESSION['new_contest']){
                    echo $_SESSION['general_row']['country'];
                  }
            ?>"

            >
                <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
								<option value="Other">Other</option>

            </select>
           </div>

<!--
					 <input id="searchMapInput" class="mapControls" type="text" placeholder="Enter a location">
					 <ul id="geoData">
					     <li>Full Address: <span id="location-snap"></span></li>
					     <li>Latitude: <span id="lat-span"></span></li>
					     <li>Longitude: <span id="lon-span"></span></li>
					 </ul>

					 <script>
								function initMap() {
								    var input = document.getElementById('searchMapInput');

								    var autocomplete = new google.maps.places.Autocomplete(input);

								    autocomplete.addListener('place_changed', function() {
								        var place = autocomplete.getPlace();
								        document.getElementById('location-snap').innerHTML = place.formatted_address;
								        document.getElementById('lat-span').innerHTML = place.geometry.location.lat();
								        document.getElementById('lon-span').innerHTML = place.geometry.location.lng();
								    });
								}
					</script>
					<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap" async defer></script> -->






           <div class="form-group ">
             <label class="control-label " for="text">
              Name of Institution/Organization affiliated with the contest
             </label>
             <input class="form-control" id="organization" name="organization" type="text" value="<?php
                   if(!$_SESSION['new_contest']){
                     echo $_SESSION['general_row']['organization'];
                   }
             ?>" required/>
            </div>
<!--
						<div class="form-group ">
              <label class="control-label " for="text">
               Name of Contest
              </label>
              <input class="form-control" id="contest_name" name="contest_name" type="text" required/>
             </div>
						 <span class="help-block">
              Please choose a unique contest name.
             </span> -->




					 <div class="form-group" name="stage">
					  <label class="control-label ">
					   What stage is your contest in?
					  </label>
						 <div class="">

					   <div class="radio">
						<label class="radio">


						 <input name="stage" type="radio" value="Early" onclick="early()"


             required />
						 Early
						</label>
					   </div>

					   <div class="radio">
						<label class="radio">
						 <input name="stage" type="radio" value="Mid" onclick="mid()"


             />
						 Mid
						</label>
					   </div>

					   <div class="radio">
						<label class="radio">
						 <input name="stage" type="radio" value="Completed" onclick="completed()"


              />
						 Completed
						</label>
					   </div>

					  </div>


					 </div>

  <!-- EARLY STAGE QUESTIONS -->

					 <div class="form-group hidden">
						<label class="control-label" for="early_questions">
              What is the goal of your challenge?
					  </label>
						<textarea class="form-control" cols="40" id="early_questions" name="early_questions" rows="3"><?php
                    if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early"){
                      echo $_SESSION['cur_row']['goal'];
                    }
              ?>
            </textarea>

						<label class="control-label " for="select2">
             <br> What type of challenge are you planning on hosting?
            </label>
            <select class="select form-control" id="early_contest_type" name="early_contest_type">
             <option value="Hackathon" <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['contest_type'] == "Hackathon"){
                       echo "selected";
                     }
               ?>>
              Hackathon
             </option>
             <option value="Innovation Challenge"  <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['contest_type'] == "Innovation Challenge"){
                       echo "selected";
                     }
               ?>>
              Innovation Challenge
             </option>
             <option value="Online Event" <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['contest_type'] == "Online Event"){
                       echo "selected";
                     }
               ?>>
              Online Event
             </option>
						 <option value="Other" <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['contest_type'] == "Other"){
                       echo "selected";
                     }
               ?>>
              Other
             </option>
            </select>

            <span class="help-block">
							Click <a href="https://peerj.com/articles/6762/#table-1">here</a> to learn more about the types of challenges
            </span>

						<label class="control-label " for="select2">
             <br> What general feild is your contest in?
            </label>
            <select class="select form-control" id="early_field" name="early_field">
             <option value="Arts" <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['field'] == "Arts"){
                       echo "selected";
                     }
               ?>>
              Arts
             </option>
             <option value="Social Science" <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['field'] == "Social Science"){
                       echo "selected";
                     }
               ?>>
              Social Science
             </option>
             <option value="Healthcare" <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['field'] == "Healthcare"){
                       echo "selected";
                     }
               ?>>
              Public Health or Medicine
             </option>
             <option value="Engineering" <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['field'] == "Engineering"){
                       echo "selected";
                     }
               ?>>
              Engineering
             </option>
             <option value="Other" <?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['field'] == "Other"){
                       echo "selected";
                     }
               ?>>
              Other
             </option>
            </select>


						<div name="early_online" class="form-group ">
            <label class="control-label requiredField">
             <br>Is your challenge an online event?
             <span class="asteriskField">
              *
             </span>
            </label>
            <div class="">
             <div class="radio">
              <label class="radio">
               <input name="early_online" id = "early_online1" type="radio" value="Yes" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['online'] == "Yes"){
                         echo "checked";
                       }
                 ?>
                 />
               Yes
              </label>
             </div>
             <div class="radio">
              <label class="radio">
               <input name="early_online" id = "early_online" type="radio" value="No" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early" && $_SESSION['cur_row']['online'] == "No"){
                         echo "checked";
                       }
                 ?>
                 />
               No
              </label>
             </div>
            </div>
           </div>

					 <label class="control-label" for="early_questions">
				 	 What type of help do you need? (Ex: creating a steering committee, promoting a contest, sharing results, other)
				 	</label>
				 	<textarea class="form-control" cols="40" id="early_questions" name="early_comments" rows="10"><?php
                    if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Early"){
                      echo $_SESSION['cur_row']['comments'];
                    }
              ?>
          </textarea>



					 </div>



  <!-- MID STAGE QUESTIONS -->
					 <div class="form-group hidden">
             <label class="control-label" for="mid_questions">
               What is the goal of your challenge?
             </label>
             <textarea class="form-control" cols="40" id="mid_questions" name="mid_questions" rows="3" ><?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid"){
                       echo $_SESSION['cur_row']['goal'];
                     }
               ?>
             </textarea>

						 <label class="control-label " for="select2">
              <br> What type of challenge are you planning on hosting?
             </label>
             <select class="select form-control" id="mid_contest_type" name="mid_contest_type">
              <option value="Hackathon" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['contest_type'] == "Hackathon"){
                        echo "selected";
                      }
                ?>>
               Hackathon
              </option>
              <option value="Innovation Challenge" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['contest_type'] == "Innovation Challenge"){
                        echo "selected";
                      }
                ?>>
               Innovation Challenge
              </option>
              <option value="Online Event" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['contest_type'] == "Online Event"){
                        echo "selected";
                      }
                ?>>
               Online Event
              </option>
							<option value="Other" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['contest_type'] == "Other"){
                        echo "selected";
                      }
                ?>>
               Other
              </option>
             </select>
             <span class="help-block">
              Click <a href="https://peerj.com/articles/6762/#table-1">here</a> to learn more about the types of challenges
             </span>

 						<label class="control-label " for="select2">
              <br> What general feild is your contest in?
             </label>
             <select class="select form-control" id="mid_field" name="mid_field">
              <option value="Arts" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['field'] == "Arts"){
                        echo "selected";
                      }
                ?>>
               Arts
              </option>
              <option value="Social Science" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['field'] == "Social Science"){
                        echo "selected";
                      }
                ?>>
               Social Science
              </option>
              <option value="Healthcare" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['field'] == "Healthcare"){
                        echo "selected";
                      }
                ?>>
               Public Health or Medicine
              </option>
              <option value="Engineering" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['field'] == "Engineering"){
                        echo "selected";
                      }
                ?>>
               Engineering
              </option>
              <option value="Other" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['field'] == "Other"){
                        echo "selected";
                      }
                ?>>
               Other
              </option>
             </select>


 						<div name="mid_online" class="form-group ">
             <label class="control-label requiredField">
              <br>Is your challenge an online event?
              <span class="asteriskField">
               *
              </span>
             </label>
             <div class="">
              <div class="radio">
               <label class="radio">
                <input name="mid_online" id="mid_online2" type="radio" value="Yes" <?php
                        if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['online'] == "Yes"){
                          echo "checked";
                        }
                        ?>
                        />
                Yes
               </label>
              </div>
              <div class="radio">
               <label class="radio">
                <input name="mid_online" type="radio" value="No" <?php
                        if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['online'] == "No"){
                          echo "checked";
                        }
                        ?>
                        />
                No
               </label>
              </div>
             </div>
            </div>


						<div class="form-group ">
						<label class="control-label requiredField" for="text1">
						 Who is your target audience?
						 <span class="asteriskField">
							*
						 </span>
						</label>
						<input class="form-control" id="mid_target" name="mid_target" type="text" value="<?php
                    if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid"){
                      echo $_SESSION['cur_row']['target'];
                    }
            ?>
            "/>
						<span class="help-block" id="hint_text1">
						 Briefly explain who the contest is geared towards.
						</span>
						</div>


						<div class="form-group ">
						<label class="control-label requiredField" for="text2">
						What type of entries will your challenge collect?
						<span class="asteriskField">
						 *
						</span>
						</label>
						<input class="form-control" id="mid_entry_type" name="mid_entry_type" type="text" value="<?php
                    if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid"){
                      echo $_SESSION['cur_row']['entry_type'];
                    }
            ?>
            "/>
						<span class="help-block" id="hint_text2">
						Proposals, Presentations,  etc.
						</span>
						</div>


						<label class="control-label" for="mid_questions">
						 Do you have any promotional strategies?
						</label>
						<textarea class="form-control form-control" cols="40" id="mid_questions" name="mid_promotion_strategy" rows="10"><?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid"){
                        echo $_SESSION['cur_row']['promotion_strategy'];
                      }
              ?>

            </textarea>
						<span class="help-block" id="hint_text2">
							Ideas on how to spread the word about your challenge? (Ex. Social Media, Flyers, etc.)
						</span>


						<div name ="mid_team_size" class="form-group ">
						<label class="control-label ">
						 How big is your organizing team?
						</label>
						<div class="">
						 <div class="radio">
							<label class="radio">
							 <input name="mid_team_size" type="radio" value="0" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['team_size'] == "0"){
                         echo "checked";
                       }
                 ?>/>
							 0
							</label>
						 </div>
						 <div class="radio">
							<label class="radio">
							 <input name="mid_team_size" type="radio" value="1-5" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['team_size'] == "1-5"){
                         echo "checked";
                       }
                 ?>/>
							 1-5
							</label>
						 </div>
						 <div class="radio">
							<label class="radio">
							 <input name="mid_team_size" type="radio" value="6-10" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['team_size'] == "6-10"){
                         echo "checked";
                       }
                 ?>/>
							 6-10
							</label>
						 </div>
						 <div class="radio">
							<label class="radio">
							 <input name="mid_team_size" type="radio" value="11-20" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['team_size'] == "11-20"){
                         echo "checked";
                       }
                 ?>/>
							 11-20
							</label>
						 </div>
						 <div class="radio">
							<label class="radio">
							 <input name="mid_team_size" type="radio" value="20+" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid" && $_SESSION['cur_row']['team_size'] == "20+"){
                         echo "checked";
                       }
                 ?>/>
							 20+
							</label>
						 </div>
						</div>
						</div>

						<div name="mid_partners" class="form-group ">
						<label class="control-label requiredField" for="text2">
						Are you affiliated with any organizations? If so, include their website/contact.
						<span class="asteriskField">
						 *
						</span>
						</label>
						<input class="form-control" id="mid_partners" name="mid_partners" type="text" value="<?php
                    if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid"){
                      echo $_SESSION['cur_row']['partners'];
                    }
            ?>"/>
						</div>

						<label for="start">When do you plan to host your challenge?</label>
						<input type="date" id="start" name="mid_contest_date" min="2010-01-01" max="2030-12-31" value="<?php
                    if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid"){
                      echo $_SESSION['cur_row']['contest_date'];
                    }
            ?>">
						<span class="help-block" id="hint_text2">
						If not decided, choose the 1st of your selected month.
						</span>





 					 <label class="control-label" for="mid_questions">
						 What type of help do you need? (Ex: creating a steering committee, promoting a contest, sharing results, other)
					 </label>
 				 	<textarea class="form-control" cols="40" id="mid_questions" name="mid_comments" rows="10"><?php
                    if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Mid"){
                      echo $_SESSION['cur_row']['comments'];
                    }
              ?>
          </textarea>


			 </div>

  <!-- COMPLETED STAGE QUESTIONS -->

					 <div class="form-group hidden">

             <label class="control-label" for="completed_questions">
               What was the goal of your challenge?
             </label>
             <textarea class="form-control" cols="40" id="completed_questions" name="completed_questions" rows="3"><?php
                     if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                       echo $_SESSION['cur_row']['goal'];
                     }
               ?></textarea>


						 <label class="control-label " for="select2">
              <br> What type of challenge did you host?
             </label>
             <select class="select form-control" id="completed_contest_type" name="completed_contest_type">
              <option value="Hackathon" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['contest_type'] == "Hackathon"){
                        echo "selected";
                      }
                ?>>
               Hackathon
              </option>
              <option value="Innovation Challenge" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['contest_type'] == "Innovation Challenge"){
                        echo "selected";
                      }
                ?>>
               Innovation Challenge
              </option>
              <option value="Online Event" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['contest_type'] == "Online Event"){
                        echo "selected";
                      }
                ?>>
               Online Event
              </option>
							<option value="Other" <?php
											if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['contest_type'] == "Other"){
												echo "selected";
											}
								?>>
							 Other
							</option>
							</select>
							<span class="help-block">
							Click <a href="https://peerj.com/articles/6762/#table-1">here</a> to learn more about the types of challenges
							</span>


             <label class="control-label " for="select2">
              <br> What general feild was your contest in?
             </label>
             <select class="select form-control" id="completed_field" name="completed_field">
              <option value="Arts" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['field'] == "Arts"){
                        echo "selected";
                      }
                ?>>
               Arts
              </option>
              <option value="Social Science" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['field'] == "Social Science"){
                        echo "selected";
                      }
                ?>>
               Social Science
              </option>
              <option value="Healthcare" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['field'] == "Healthcare"){
                        echo "selected";
                      }
                ?>>
	              Public Health or Medicine
              </option>
              <option value="Engineering" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['field'] == "Engineering"){
                        echo "selected";
                      }
                ?>>
               Engineering
              </option>
              <option value="Other" <?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['field'] == "Other"){
                        echo "selected";
                      }
                ?>>
               Other
              </option>
             </select>

             <div class="form-group ">
             <label class="control-label requiredField">
              <br>Was your challenge an online event?
              <span class="asteriskField">
               *
              </span>
             </label>
             <div name="completed_online" class="">
              <div class="radio">
               <label class="radio">
                <input name="completed_online" id="completed_online3" type="radio" value="Yes" <?php
                        if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['online'] == "Yes"){
                          echo "checked";
                        }
                        ?>/>
                Yes
               </label>
              </div>
              <div class="radio">
               <label class="radio">
                <input name="completed_online" type="radio" value="No" <?php
                        if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['online'] == "No"){
                          echo "checked";
                        }
                        ?>/>
                No
               </label>
              </div>
             </div>
            </div>

            <div class="form-group ">
            <label class="control-label requiredField" for="text1">
             Who is was the target audience of the challenge?
             <span class="asteriskField">
              *
             </span>
            </label>
            <input class="form-control" id="completed_target" name="completed_target" type="text" value="<?php
                    if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                      echo $_SESSION['cur_row']['target'];
                    }
            ?>
            "/>
            <span class="help-block" id="hint_text1">
             Briefly explain who the contest is geared towards.
            </span>
           </div>


           <div class="form-group ">
           <label class="control-label requiredField" for="text2">
            What type of entries did you collect?
            <span class="asteriskField">
             *
            </span>
           </label>
           <input class="form-control" id="completed_entry_type" name="completed_entry_type" type="text" value="<?php
                   if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                     echo $_SESSION['cur_row']['entry_type'];
                   }
           ?>
           "/>
           <span class="help-block" id="hint_text2">
            Proposals, Presentations,  etc.
           </span>
          </div>


					  <label class="control-label">
					   What promotional strategies did you use?
					  </label>
					  <textarea class="form-control form-control" cols="40" id="completed_promotion_strategy" name="completed_promotion_strategy" rows="10"><?php
                      if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                        echo $_SESSION['cur_row']['promotion_strategy'];
                      }
              ?></textarea>
            <span class="help-block" id="hint_text2">
              Ideas on how to spread the word about your challenge? (Ex. Social Media, Flyers, etc.)
            </span>


            <div class="form-group ">
            <label class="control-label ">
             How big was the organizing team?
            </label>
            <div name = "completed_team_size" class="">
             <div class="radio">
              <label class="radio">
               <input name="completed_team_size" type="radio" value="1-5" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['team_size'] == "1-5"){
                         echo "checked";
                       }
                 ?>/>
               1-5
              </label>
             </div>
             <div class="radio">
              <label class="radio">
               <input name="completed_team_size" type="radio" value="6-10" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['team_size'] == "6-10"){
                         echo "checked";
                       }
                 ?>/>
               6-10
              </label>
             </div>
             <div class="radio">
              <label class="radio">
               <input name="completed_team_size" type="radio" value="11-20" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['team_size'] == "11-20"){
                         echo "checked";
                       }
                 ?>/>
               11-20
              </label>
             </div>
             <div class="radio">
              <label class="radio">
               <input name="completed_team_size" type="radio" value="20+" <?php
                       if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed" && $_SESSION['cur_row']['team_size'] == "20+"){
                         echo "checked";
                       }
                 ?>/>
               20+
              </label>
             </div>
            </div>
           </div>

           <div class="form-group ">
           <label class="control-label requiredField" for="text2">
            Was the contest affiliated with any organizations? If so, include their website/contact.
            <span class="asteriskField">
             *
            </span>
           </label>
           <input class="form-control" id="completed_partners" name="completed_partners" type="text" value="<?php
                   if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                     echo $_SESSION['cur_row']['partners'];
                   }
           ?>"/>
          </div>

          <label for="start">When did the contest occur?</label>
          <input type="date" id="completed_contest_date" name="completed_contest_date" min="2000-01-01" max="2020-12-31" value="<?php
                  if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                    echo $_SESSION['cur_row']['contest_date'];
                  }
          ?>">


          <div class="form-group ">
          <label class="control-label " for="number1">
           <br>How many submissions did you receive?
          </label>
          <input class="form-control" id="completed_num_submissions" name="completed_num_submissions" placeholder="0" type="number" value="<?php
                  if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                    echo $_SESSION['cur_row']['num_submissions'];
                  }
          ?>"/>
         </div>

         <label class="control-label " >
           <br>Give a brief summary of the outcome(s) of your challenge
         </label>
         <textarea class="form-control" id="completed_contest_summary" name = "completed_contest_summary" cols="40" rows="10"><?php
                   if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                     echo $_SESSION['cur_row']['contest_summary'];
                   }
             ?></textarea>

         <label class="control-label " >
           <br>What are your plans for sharing the contest results?
         </label>
         <textarea class="form-control" name = "completed_contest_sharing" cols="40" rows="5"><?php
                   if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                     echo $_SESSION['cur_row']['contest_sharing'];
                   }
             ?></textarea>
         <span class="help-block" id="hint_text2">
           Ex. Posting on social media, publishing journal article, etc.
         </span>

         <label class="control-label " >
           <br>Have the results of the contest been shared anywhere?
         </label>
         <textarea class="form-control" name = "completed_shared_links" cols="40" rows="1"><?php
                   if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                     echo $_SESSION['cur_row']['shared_links'];
                   }
             ?></textarea>
         <span class="help-block" id="hint_text2">
           If so, include the link below
         </span>




         <!--
         <div class="form-group ">
           <div class="file-uploader__message-area">
              <p>Select a file to upload</p>
            </div>
            <div class="file-chooser">
              <input class="file-chooser__input" type="file">
            </div>
            <input class="file-uploader__submit-button" type="submit" value="Upload">
         </div> -->

			  <label class="control-label ">
					<br>What type of help do you need? (Ex: creating a steering committee, promoting a contest, sharing results, other)
			  </label>
			  <textarea class="form-control" name = "completed_comments" cols="40" rows="10"><?php
                  if(!$_SESSION['new_contest'] && $_SESSION['cur_stage'] == "Completed"){
                    echo $_SESSION['cur_row']['comments'];
                  }
            ?></textarea>

  </div>

  <!-- SUBMIT -->
					<div class="form-group ">

						<!-- <button name="upload" href="/sign-up-login-form/user_landing/upload_files/upload.html" >Click here to begin uploads</button> -->
						<label for="start"><br>
							Attach any documents/materials that you used in organizing the challenge? Any other contest related documents are acceptable.
						</label>

						<a href="sign-up-login-form/user_landing/upload_files/index.php" target="_blank">Click here to go to the Upload Portal</a>
							<!-- <input type="file" name = "completed_attachments" multiple> -->

						<!-- <span class="help-block" id="hint_text2">
							To attach multiple files, select more than one file when browsing for files.
						</span> -->
					</div>

					 <div class="form-group">
					   <button class="btn btn-primary "  name="submit" type="submit">
						Submit
					   </button>

						 <button class="btn" onclick="leaveConfirm()" name="cancel" type="cancel">
						Cancel
					   </button>
					 </div>

           <script>
            function leaveConfirm() {
              if(confirm("Are you sure you want to leave this page?")){
								window.location.href = 'sign-up-login-form/user_landing/index.php#service';
							}
            }
          </script>
          					 <!-- <tr>
						 <td><input type = "submit" value = "SUBMIT"></td>
					 </tr> -->

					</form>
				</div>
			</div>
	</div>
	</div>
	</body>
</html>
