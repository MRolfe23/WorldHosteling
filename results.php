<?php
session_start();
?>
<!DOCTYPE html>
<?php
	include('class/crud.php');
	include('class/validation.php');
	include('connect.php');
	
	$crud = new crud();
	$validation = new validation();
?>
<html>
	<head>
		<title>WorldHosteling</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="icon" href="icons/whLogo.PNG" type="image">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
		html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
		</style>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<style>			

			.search {
				width: 50%;
				margin-left: 25%;
				margin-bottom: 15%;
			}
			.adventureCont {
				height: 23em;
    			padding-top: 5em;
			}
			.hostelResult {

				margin: 1%;
			}
			.hostelResult {
				cursor: pointer;			
				transition: box-shadow .3s;
			}
			.hostelResult:hover {
				box-shadow: 0 0 11px rgba(33,33,33,.3);
			}
		</style>
	</head>
	<body id="myPage">

		<!-- Navbar -->
		<div class="w3-top">
			<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
				<!--turn this into profile icon-->
				<?php
				if(isset($_SESSION['acctID'])) {
					echo "<a href=\"account.php\" class=\"w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2\" title=\"My Account\">";
					echo	"<img src=\"accountImage/".$_SESSION['acctPR']."\" class=\"w3-circle\" style=\"height:50px;width:50px\" alt=\"Profile\">";
					echo "</a>";
				}
				
				?>
				<a href="index.php" ><img src="icons/logo.png" alt="WorldHosteling"></a>
				<?php
				if(isset($_SESSION['acctID'])) {
					echo "<div class=\"w3-right\">";
					echo 	"<a href=\"logout.php\" title=\"logout\">Logout <i class=\"fa fa-sign-out\"></i></a>";
					echo 	"<a href=\"account.php\" class=\"w3-bar-item w3-button w3-hide-small w3-right\" title=\"My Account\">";
					echo 	"<img src=\"accountImage/".$_SESSION['acctPR']."\" class=\"w3-circle\" style=\"height:50px;width:50px\" alt=\"Profile\">";
					echo 	"</a>";
					echo "</div>";
				} else {
					echo "<div class=\"w3-right\">";
					echo "<a href=\"#\" class=\"w3-bar-item w3-button w3-right\">";
					echo 	"<i class=\"w3-hide-small\">Login / Sign up </i><img src=\"icons/icons8-id-verified-64.png\" data-toggle=\"modal\" data-target=\"#modalLRForm\"></img>";
					echo "</a>";
					echo "</div>";
				}
				?>				
			</div>
		</div>

		<!-- Image Header -->
		<div class="w3-display-container w3-animate-opacity w3-center">
			<img src="pexels-photo-mountain.jpeg" alt="adventure" style="width:100%;min-height:350px;max-height:600px;">
			<form class="w3-container w3-display-bottomleft w3-center search" action="results.php" method="post">
				<input class="form-control header" name="searchHostel" type="text" placeholder="Hostel name or locations...">
				<br>
				<input class="btn btn-dark header" name="submitHostel" type="submit" value="Find it!">
			</form>
		</div>

		<!-- Results Container -->
		<div class="w3-center">
			<!--<div class="row">-->
				<?php
				$count = 4;
				if(isset($_POST['submitHostel'])){
					if($_POST['searchHostel'] != "") {
						$search = $crud->escape_string(htmlspecialchars($_POST['searchHostel'], ENT_QUOTES, 'UTF-8'));
						$query = $db->prepare("SELECT * FROM hostel WHERE HOSTEL_name LIKE ? OR HOSTEL_city LIKE ? OR HOSTEL_state LIKE ?");
						$query->bindValue(1, "%$search%");
						$query->bindValue(2, "%$search%");
						$query->bindValue(3, "%$search%");

						$query->execute();
						if($query->rowCount() == 0) {
							echo "<h2>No result found!</h2>";
						} else {
							$result = $db->prepare("SELECT * FROM hostel WHERE HOSTEL_name LIKE ? OR HOSTEL_city LIKE ? OR HOSTEL_state LIKE ?");
							$result->bindValue(1, "%$search%");
							$result->bindValue(2, "%$search%");
							$result->bindValue(3, "%$search%");
							$result->execute();
							foreach($result as $key => $res)
							{
								if($count == 4){
									echo "<div class=\"row\">";
									$count = 0;
								}

								// Generate new modal for each hostel based on search string
								echo "<div class=\"modal fade\" id=\"exampleModalLong$res[HOSTEL_ID]\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLongTitle\" aria-hidden=\"true\" style=\"text-align: left;\">";
								echo	"<form action=\"saveHostel.php\" method=\"post\" class=\"modal-dialog\" role=\"document\">";
								echo		"<div class=\"modal-content\">";
								echo			"<div class=\"modal-header\">";
								echo				"<h5 class=\"modal-title\">$res[HOSTEL_name]</h5>";
								echo				"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">";
								echo					"<span aria-hidden=\"true\">&times;</span>";
								echo				"</button>";
								echo			"</div>";
								echo			"<div class=\"modal-body\">";
								echo				"<div id=\"map$res[HOSTEL_ID]\" style=\"height: 200px; width: 100%;\"></div>";
								echo				"<div class=\"w3-container w3-padding-64 w3-center\" id=\"team\">";
								echo					"<div id=\"carouselExampleIndicators$res[HOSTEL_ID]\" class=\"carousel slide\" data-ride=\"carousel\">";
								echo						"<ol class=\"carousel-indicators\">";
								echo							"<li data-target=\"#carouselExampleIndicators$res[HOSTEL_ID]\" data-slide-to=\"0\" class=\"active\"></li>";
								echo							"<li data-target=\"#carouselExampleIndicators$res[HOSTEL_ID]\" data-slide-to=\"1\"></li>";
								echo							"<li data-target=\"#carouselExampleIndicators$res[HOSTEL_ID]\" data-slide-to=\"2\"></li>";
								echo						"</ol>";
								echo						"<div class=\"carousel-inner\">";
								echo							"<div class=\"carousel-item active\">";
								echo								"<img class=\"d-block w-100\" src=\"hostelImage/$res[HOSTEL_pic1]\" alt=\"First slide\">";
								echo								"<div class=\"carousel-caption d-block d-md-block\">";
								echo									"<h5>Hostel 1</h5>";
								echo									"<p>Great place</p>";
								echo								"</div>";
								echo							"</div>";
								echo							"<div class=\"carousel-item\">";
								echo								"<img class=\"d-block w-100\" src=\"hostelImage/$res[HOSTEL_pic2]\" alt=\"Second slide\">";
								echo								"<div class=\"carousel-caption d-block d-md-block\">";
								echo									"<h5>Hostel 2</h5>";
								echo									"<p>Great place 2</p>";
								echo								"</div>";
								echo							"</div>";
								echo							"<div class=\"carousel-item\">";
								echo								"<img class=\"d-block w-100\" src=\"hostelImage/$res[HOSTEL_pic3]\" alt=\"Third slide\">";
								echo								"<div class=\"carousel-caption d-block d-md-block\">";
								echo									"<h5>Hostel 3</h5>";
								echo									"<p>Great place 3</p>";
								echo								"</div>";
								echo							"</div>";
								echo						"</div>";
								echo						"<a class=\"carousel-control-prev\" href=\"#carouselExampleIndicators$res[HOSTEL_ID]\" role=\"button\" data-slide=\"prev\">";
								echo							"<span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>";
								echo							"<span class=\"sr-only\">Previous</span>";
								echo						"</a>";
								echo						"<a class=\"carousel-control-next\" href=\"#carouselExampleIndicators$res[HOSTEL_ID]\" role=\"button\" data-slide=\"next\">";
								echo							"<span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>";
								echo							"<span class=\"sr-only\">Next</span>";
								echo						"</a>";
								echo					"</div>";
								echo				"</div>";
								echo				"<div class=\"panel-group\">";
								echo					"<div class=\"panel panel-default\">";
								echo						"<div class=\"panel-heading\">State</div>";
								echo						"<div class=\"panel-body\">$res[HOSTEL_state]</div>";
								echo					"</div>";
								echo					"<div class=\"panel panel-default\">";
								echo						"<div class=\"panel-heading\">City</div>";
								echo						"<div class=\"panel-body\">$res[HOSTEL_city]</div>";
								echo					"</div>";
								echo					"<div class=\"panel panel-default\">";
								echo						"<div class=\"panel-heading\">Price</div>";
								echo						"<div class=\"panel-body\">$res[HOSTEL_price]</div>";
								echo					"</div>";
								echo					"<div class=\"panel panel-default\">";
								echo						"<div class=\"panel-heading\">Description</div>";
								echo						"<div class=\"panel-body\">$res[HOSTEL_description]</div>";
								echo					"</div>";
								echo					"<div class=\"panel panel-default\">";
								echo						"<div class=\"panel-heading\">Rating</div>";
								echo						"<div class=\"panel-body\">$res[HOSTEL_rating]</div>";
								echo					"</div>";
								echo				"</div>";
								echo			"</div>";
								echo			"<div class=\"modal-footer\">";
								echo				"<input name=\"id\" id=\"id$res[HOSTEL_ID]\" value=\"$res[HOSTEL_ID]\" type=\"hidden\">";
								echo				"<input name=\"acctid\" id=\"acctid$res[HOSTEL_ID]\" value=\"\" type=\"hidden\">";

								// displays button based on current session status and acct_hostel table
								if(!isset($_SESSION['acctID'])) {
									echo "<a href=\"#\" class=\"w3-bar-item w3-button w3-right\" data-dismiss=\"modal\">";
									echo 	"<i class=\"w3-hide-small\">Login/Sign up to save hostels </i><img src=\"icons/icons8-id-verified-64.png\" data-toggle=\"modal\" data-target=\"#modalLRForm\"></img>";
									echo "</a>";
								} else {
									$checkSaved = $db->prepare("SELECT * FROM acct_hostel WHERE ACCT_ID = :id AND HOSTEL_ID = :hid");
									$checkSaved->execute(array('id'=>$_SESSION['acctID'],'hid'=>$res['HOSTEL_ID']));
									if($checkSaved->rowCount() == 0) {
										echo "<button data-id=\"addHostel$res[HOSTEL_ID]\" name=\"addHostel\" id=\"addHostel$res[HOSTEL_ID]\" type=\"submit\" class=\"add btn btn-info\">Save hostel<i class=\"fa fa-plus ml-1\"></i></button>";
									} else {
										echo "<div class=\"btn btn-success\" disabled>Saved<i class=\"fa fa-check ml-1\"></i></div>";
									}
								}

								echo				"<a type=\"button\" class=\"btn btn-info\" id=\"url\" href=\"$res[HOSTEL_url]\" target=\"_blank\">Go to Hostel Site</a>";
								echo			"</div>";
								echo		"</div>";
								echo	"</form>";
								echo "</div>";

								// hold location data for javascript to put into modal
								echo "<input name=\"hostelLat$res[HOSTEL_ID]\" id=\"hostelLat$res[HOSTEL_ID]\" value=\"$res[HOSTEL_latitude]\" type=\"hidden\">";
								echo "<input name=\"hostelLong$res[HOSTEL_ID]\" id=\"hostelLong$res[HOSTEL_ID]\" value=\"$res[HOSTEL_longitude]\" type=\"hidden\">";

								
								// display picture1, name and rating of hostel
								echo 	"<div class=\"col w3-container w3-display-container w3-round w3-border w3-theme-border w3-margin-bottom hostelResult\" style=\"width: 169px;height: 18em;\"><br>";
								echo 		"<img class=\"hostel\" src=\"hostelImage/$res[HOSTEL_pic1]\" data-toggle=\"modal\" data-target=\"#exampleModalLong$res[HOSTEL_ID]\" alt=\"HostelName\" data-id=\"$res[HOSTEL_ID]\" style=\"width: 160px;height: 7em;\"><hr>";
								echo		"<div class=\"$res[HOSTEL_ID]\">";
								echo			"<h5>$res[HOSTEL_name]</h5>";
								echo			"<p>Rating: $res[HOSTEL_rating]</p>";
								echo		"</div>";
								echo	"</div>";
								$count ++;
								if($count == 4){
									echo "</div>";
								}
							}
						}
					} else {
						echo "<h2>No result found!</h2>";
					}	
				}
				?>
			<!--</div>-->
		</div>

		<!-- Footer -->
		<footer class="w3-container w3-padding-16 w3-theme-d3 w3-center">
			<h4>Follow Us</h4>
			<a class="w3-button w3-large w3-teal" href="https://www.facebook.com/" title="Facebook"><i class="fa fa-facebook"></i></a>
			<a class="w3-button w3-large w3-teal" href="https://twitter.com/" title="Twitter"><i class="fa fa-twitter"></i></a>
			<a class="w3-button w3-large w3-teal" href="https://plus.google.com/discover" title="Google +"><i class="fa fa-google-plus"></i></a>
			<a class="w3-button w3-large w3-teal" href="https://www.instagram.com" title="Google +"><i class="fa fa-instagram"></i></a>
			<a class="w3-button w3-large w3-teal w3-hide-small" href="https://www.linkedin.com/feed/" title="Linkedin"><i class="fa fa-linkedin"></i></a>
			<p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>

			<div style="position:relative;bottom:100px;z-index:1;" class="w3-tooltip w3-right">
				<span class="w3-text3-padding w3-teal w3-hide-small">Go To Top</span>   
				<a class="w3-button w3-theme" href="#myPage"><span class="w3-xlarge">
				<i class="fa fa-chevron-circle-up"></i></span></a>
			</div>
		</footer>
		
		<!--Modal: Login / Register Form-->
		<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog cascading-modal" role="document">
				<!--Content-->
				<div class="modal-content">

					<!--Modal cascading tabs-->
					<div class="modal-c-tabs">

						<!-- Nav tabs -->
						<ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
						<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i>
									  Login</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fa fa-user-plus mr-1"></i>
									  Register</a>
						</li>
						</ul>

						<!-- Tab panels -->
						<div class="tab-content">
							<!--Panel 7-->
							<div class="tab-pane fade in show active" id="panel7" role="tabpanel">

								<!--Login Body-->
								<form action="signinACCT.php" method="post" name="signin" class="modal-body mb-1">
									<div class="md-form form-sm mb-5">
										<i class="fa fa-envelope prefix"></i>
										<input name="signinemail" type="email" id="modalLRInput10" class="form-control form-control-sm validate" required>
										<label data-error="wrong" data-success="right" for="modalLRInput10">Your email</label>
									</div>

									<div class="md-form form-sm mb-4">
										<i class="fa fa-lock prefix"></i>
										<input name="signinpass" type="password" id="modalLRInput11" class="form-control form-control-sm validate" required>
										<label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
									</div>
									<div class="text-center mt-2">
										<button name="signinACCT" type="submit" class="btn btn-info">Log in <i class="fa fa-sign-in ml-1"></i></button>
									</div>
								</form>
								<!--Footer-->
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
								</div>

							</div>
							<!--/.Panel 7-->

							<!--Panel 8-->
							<div class="tab-pane fade" id="panel8" role="tabpanel">

								<!--Sign up Body-->
								<form action="addACCT.php" method="post" name="signup" class="modal-body">
								
									<div class="md-form form-sm">
										<i class="fa fa-user prefix"></i>
										<input name="ACCT_fname" type="text" id="signupfname" class="form-control form-control-sm validate" required>
										<label data-error="wrong" data-success="right" for="modalLRInput15">Your first name</label>
									</div>				
									<div class="md-form form-sm">
										<i class="fa fa-user prefix"></i>
										<input name="ACCT_lname" type="text" id="signuplname" class="form-control form-control-sm validate" required>
										<label data-error="wrong" data-success="right" for="modalLRInput16">Your last name</label>
									</div>

									<div class="md-form form-sm">
										<i class="fa fa-envelope prefix"></i>
										<input name="ACCT_email" type="email" id="signupemail" class="form-control form-control-sm validate" required>
										<label data-error="wrong" data-success="right" for="modalLRInput12">Your email</label>
									</div>

									<div class="md-form form-sm">
										<i class="fa fa-lock prefix"></i>
										<input name="ACCT_pass" type="password" id="signuppassword" class="form-control form-control-sm validate" onkeyup='check();' required>
										<label data-error="wrong" data-success="right" for="modalLRInput13">Your password</label>
									</div>

									<div class="md-form form-sm">
										<i class="fa fa-lock prefix"></i>
										<input name="ACCT_pass2" type="password" id="confirmpassword" class="form-control form-control-sm validate" onkeyup='check();' required>
										<label data-error="wrong" data-success="right" for="modalLRInput14">Confirm password</label>
										<span id='message'></span>
									</div>

									<div class="text-center form-sm">
										<button name="addACCT" type="submit" class="btn btn-info">Sign up <i class="fa fa-sign-in ml-1"></i></button>
									</div>

								</form>
								<!--Footer-->
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
								</div>
							</div>
						<!--/.Panel 8-->
						</div>

					</div>
				</div>
			<!--/.Content-->
			</div>
		</div>
		<!--Modal: Login / Register Form-->

		<script>
			
			// Initialize and add the map
			function initMap(lat, long, loc) {
			  // The location of Uluru
			  var uluru = {lat: lat, lng: long};
			  // The map, centered at Uluru
			  var map = new google.maps.Map(
				  document.getElementById(loc), {zoom: 4, center: uluru});
			  // The marker, positioned at Uluru
			  var marker = new google.maps.Marker({position: uluru, map: map});
			}
			
			$('.hostel').click(function(){
				//get specific id
				var id=$(this).data('id');

				// make variables from hidden inputs on load
				var hostelLat=parseFloat($('#hostelLat'+id).val());
				var hostelLong=parseFloat($('#hostelLong'+id).val());
				var mapLoc='map'+id;

				// call map function with specific lat and long params
				initMap(hostelLat, hostelLong, mapLoc);

			});	
			
			$(document).ready(function(){
				$('.add').click(function(){
					//get specific id
					var id=$(this).data('id');
					
					document.getElementById(id).innerHTML="Saving...";
					document.getElementById(id).style.backgroundColor = "green";
					function timeout(){
						document.getElementById(id).disabled = true;
						document.getElementById(id).innerHTML="Saved<i class=\"fa fa-check ml-1\">";
					};
					setTimeout(timeout, 1000);
					
				});
			});

		</script>
		
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmthmcfhIdRehicONQ1CBD8ai9QyWJVik&callback=initMap">
		</script>
	</body>
</html>
