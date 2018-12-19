<?php
session_start();
include('class/crud.php');
include('class/validation.php');

$crud = new crud();
$validation = new validation();

if (!isset($_SESSION['acctID'])) {
header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
	<Head>
		<title>WorldHosteling</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="icons/whLogo.PNG" type="image">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<style>	
		<style>
			html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
			#map {
				height: 200px;
				width: 100%;
			}
			.hostel {
				cursor: pointer;			
				transition: box-shadow .3s;
			}
			.hostel:hover {
				box-shadow: 0 0 11px rgba(33,33,33,.3);
			}
			.friendnav {
				-moz-border-radius: 0px;
				-webkit-border-radius: 3px 3px 0px 0px;
				border-radius: 3px 3px 0px 0px;
				background-color: #7d97a5;
				height: 1.5em;
			}
			#myBtn {
				display: none;
			}
		</style>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</Head>

	<body id="myPage" class="w3-theme-l5">

		<!-- Navbar -->
		<div class="w3-top">
			<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
				<!--turn this into profile icon-->
				<a href="account.php" class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" title="My Account">
					<img src="accountImage/<?php echo $_SESSION['acctPR']; ?>" class="w3-circle" style="height:50px;width:50px" alt="Profile">
				</a>
				<a href="index.php" ><img src="icons/logo.png" alt="WorldHosteling"></a>
				<div class="w3-right">
					<a href="logout.php" title="logout">Logout <i class="fa fa-sign-out"></i></a>
					<a href="account.php" class="w3-bar-item w3-button w3-hide-small w3-right" title="My Account">
					<img src="accountImage/<?php echo $_SESSION['acctPR']; ?>" class="w3-circle" style="height:50px;width:50px" alt="Profile">
					</a>
				</div>				
			</div>
		</div>

		<!-- Page Container -->
		<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px;padding-top: 23px;">    
			<!-- The Grid -->
			<div class="w3-row">
				<!-- Left Column -->
				<div class="w3-col m3">
					<!-- Profile -->
					<div class="w3-card w3-round w3-white">
						<div class="friendnav"></div>
						<div class="w3-container">
							<h4 class="w3-center"><?php echo $_SESSION['acctFN']." ". $_SESSION['acctLN']; ?></h4>
							<p class="w3-center"><img src="accountImage/<?php echo $_SESSION['acctPR']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
							<hr>
							<button type="button" class="btn btn-sm btn-info w3-half" data-toggle="modal" data-target="#uploadProfileModal" style="margin-bottom: 5px;">Profile Picture <i class="fa fa-pencil"></i></button><button type="button" class="btn btn-sm btn-info w3-half" data-toggle="modal" data-target="#uploadBackgroundModal" style="margin-bottom: 15px;">Background Picture <i class="fa fa-pencil"></i></button><br><br>
						</div>
					</div>
					<br>

					<!-- Accordion -->
					<div class="w3-card w3-round">
						<div class="w3-white">
							<button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Friends</button>
							<div id="Demo1" class="w3-hide w3-container" >
								<?php
								$result = $crud->GetData("SELECT ACCT_ID, ACCT_fname, ACCT_lname, ACCT_profile FROM acct WHERE ACCT_ID in (SELECT ACCT_FRIEND_ID FROM acct_friend WHERE ACCT_ID =".$_SESSION['acctID'].")");
								if ($result == false) {
									echo "<h3>You must be new! Search for some friends to share your adventures with! =]";
								} else {
									foreach($result as $key => $res) {
										echo "<div class=\"viewFriend w3-container w3-card w3-white w3-round w3-margin\"><br>";
										echo 	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$res['ACCT_ID']."\">";
										echo 		"<img src=\"accountImage/".$res['ACCT_profile']."\" alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:60px\">";
										echo 		"<input name=\"friend\" class=\"friend\" type=\"hidden\" value=\"".$res['ACCT_ID']."\">";
										echo		"<p>".$res['ACCT_fname']." ".$res['ACCT_lname']."</p><br>";
										echo		"<hr class=\"w3-clear\">";
										echo	"</a>";
										echo "</div>";
									}
								}
								?>
							</div>
							<button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align" style="margin-bottom: 25px;"><i class="fa fa-home fa-fw w3-margin-right"></i> My hostels</button>
							<div id="Demo3" class="w3-hide w3-container">
								<div class="w3-row-padding">
									<br>
									<?php
									$query = $crud->GetData("select * from hostel where HOSTEL_ID in (select HOSTEL_ID from acct_hostel where ACCT_ID = ".$_SESSION['acctID'].")"); 


									if($query == false){
										echo "<h2>You have no saved hostels!</h2>";
									}else{
										$result = $crud->GetData("select * from hostel where HOSTEL_ID in (select HOSTEL_ID from acct_hostel where ACCT_ID = ".$_SESSION['acctID'].")");
										foreach($result as $key => $res)
										{

											// hold all data to take from javascript to put into modal
											echo "<input name=\"id$res[HOSTEL_ID]\" id=\"id$res[HOSTEL_ID]\" value=\"$res[HOSTEL_ID]\" type=\"hidden\">";
											echo "<input name=\"hostelName$res[HOSTEL_ID]\" id=\"hostelName$res[HOSTEL_ID]\" value=\"$res[HOSTEL_name]\" type=\"hidden\">";
											echo "<input name=\"hostelState$res[HOSTEL_ID]\" id=\"hostelState$res[HOSTEL_ID]\" value=\"$res[HOSTEL_state]\" type=\"hidden\">";
											echo "<input name=\"hostelCity$res[HOSTEL_ID]\" id=\"hostelCity$res[HOSTEL_ID]\" value=\"$res[HOSTEL_city]\" type=\"hidden\">";
											echo "<input name=\"hostelPrice$res[HOSTEL_ID]\" id=\"hostelPrice$res[HOSTEL_ID]\" value=\"$res[HOSTEL_price]\" type=\"hidden\">";
											echo "<input name=\"hostelDescription$res[HOSTEL_ID]\" id=\"hostelDescription$res[HOSTEL_ID]\" value=\"$res[HOSTEL_description]\" type=\"hidden\">";
											echo "<input name=\"hostelRating$res[HOSTEL_ID]\" id=\"hostelRating$res[HOSTEL_ID]\" value=\"$res[HOSTEL_rating]\" type=\"hidden\">";
											echo "<input name=\"hostelLat$res[HOSTEL_ID]\" id=\"hostelLat$res[HOSTEL_ID]\" value=\"$res[HOSTEL_latitude]\" type=\"hidden\">";
											echo "<input name=\"hostelLong$res[HOSTEL_ID]\" id=\"hostelLong$res[HOSTEL_ID]\" value=\"$res[HOSTEL_longitude]\" type=\"hidden\">";
											echo "<input name=\"hostelPic1$res[HOSTEL_ID]\" id=\"hostelPic1$res[HOSTEL_ID]\" value=\"$res[HOSTEL_pic1]\" type=\"hidden\">";
											echo "<input name=\"hostelPic2$res[HOSTEL_ID]\" id=\"hostelPic2$res[HOSTEL_ID]\" value=\"$res[HOSTEL_pic2]\" type=\"hidden\">";
											echo "<input name=\"hostelPic3$res[HOSTEL_ID]\" id=\"hostelPic3$res[HOSTEL_ID]\" value=\"$res[HOSTEL_pic3]\" type=\"hidden\">";
											echo "<input name=\"hostelUrl$res[HOSTEL_ID]\" id=\"hostelUrl$res[HOSTEL_ID]\" value=\"$res[HOSTEL_url]\" type=\"hidden\">";

											echo "<div class=\"w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom\">";
											//echo 		"<div class=\"w3-half\">";
											echo 			"<img class=\"hostel\" style=\"width:7%;float:right;\" src=\"icons/icons8-delete-16.png\" data-toggle=\"modal\" data-target=\"#delete\" alt=\"HostelName\" data-id=\"$res[HOSTEL_ID]\" data-id=\"$res[HOSTEL_ID]\">";
											echo 			"<img class=\"hostel\" style=\"width:100%\" src=\"hostelImage/$res[HOSTEL_pic1]\" data-toggle=\"modal\" data-target=\"#exampleModalLong\" alt=\"HostelName\" data-id=\"$res[HOSTEL_ID]\">";
											echo			"<div class=\"$res[HOSTEL_ID]\">";
											echo				"<h5>$res[HOSTEL_name]</h5>";
											echo				"<p>Rating: $res[HOSTEL_rating]</p>";
											echo			"</div>";
											//echo		"</div>";
											echo "</div>";
										}
									}
									?>
								</div>
							</div>
						</div>      
					</div>

				<!-- End Left Column -->
				</div>

				<!-- Middle Column -->
				<div class="w3-col m7">
					
					<div class="w3-row-padding">
						<div class="w3-col m12">
							<div class="w3-card w3-round w3-white">
								<div class="friendnav"></div>
								<form name="addPOST" action="addPOST.php" method="post" class="w3-container w3-padding" role="document">
									<h6 class="w3-opacity">Tell others about your adventures!</h6>
									<div id="postFail"></div>
									<input type="hidden" name="postACCTID" id="postACCTID" value="<?PHP echo $_SESSION['acctID']; ?>"/>
									<input type="hidden" name="postToACCTID" id="postToACCTID" value="<?PHP echo $_SESSION['acctID']; ?>"/>
									<input id="POST_comment" name="POST_comment" contenteditable="true" class="w3-border w3-padding" value="" style="width:100%;"/>
									<br><br>
									<button id="post" name="post" type="submit" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button> 
								</form>
							</div>
						</div>
					</div>
					
					<?php
					$friends = $crud->GetData("SELECT * FROM post WHERE ACCT_ID in (SELECT ACCT_FRIEND_ID FROM acct_friend WHERE ACCT_ID = $_SESSION[acctID]) ORDER BY POST_date DESC;");
					// creates display of all posts and comments
					foreach($friends as $key => $friend)
					{
						$poster = $crud->GetData("SELECT ACCT_fname,ACCT_lname,ACCT_profile FROM acct WHERE ACCT_ID =".$friend['ACCT_ID']);
						foreach($poster as $key => $pos) {
							echo "<div id=\"post".$friend['POST_ID']."\" class=\"w3-container w3-card w3-white w3-round w3-margin\"><br>";
							echo	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$friend['ACCT_ID']."\">";
							echo 	"<img src=\"accountImage/".$pos['ACCT_profile']."\" alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:50px; height: 50px;\">";
							echo	"</a>";
							echo	"<span class=\"w3-right w3-opacity\">".$friend['POST_date']."</span>";
							echo	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$friend['ACCT_ID']."\">";
							$postTO = $crud->GetData("SELECT ACCT_ID,ACCT_fname,ACCT_lname FROM acct WHERE ACCT_ID =".$friend['postTO']);
							foreach($postTO as $key => $to) {
								echo	"<h4>".$pos['ACCT_fname']." ".$pos['ACCT_lname']."</h4></a><p>posted to:<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$to['ACCT_ID']."\"> ".$to['ACCT_fname']." ".$to['ACCT_lname']."</p></a><br>";
								echo	"<hr class=\"w3-clear\">";
								echo	"<p>".$friend['POST_comment']."</p>";
								echo		"<form name=\"addCOMMENT\" action=\"addCOMMENT.php\" method=\"post\" class=\"w3-container w3-padding\" role=\"document\">";
								echo			"<div id=\"commentFail\"></div>";
								echo			"<input type=\"hidden\" id=\commentACCTID".$friend['POST_ID']."\" name=\"commentACCTID\" class=\"commentACCTID\" value=\"".$_SESSION['acctID']."\"/>";
								echo			"<input type=\"hidden\" id=\"commentTOPOSTID".$friend['POST_ID']."\" name=\"commentTOPOSTID\" class=\"commentTOPOSTID\" value=\"".$friend['POST_ID']."\"/>";
								echo			"<input id=\"COMMENT_comment".$friend['POST_ID']."\" name=\"COMMENT_comment\" contenteditable=\"true\" class=\"COMMENT_comment w3-border w3-padding\" value=\"\" style=\"width:100%;\"/>";
								echo			"<br><br>";
								echo			"<button id=\"addCOMMENT\" name=\"addCOMMENT\" data-id=\"".$friend['POST_ID']."\" type=\"submit\" class=\"w3-button w3-theme-d2\"><i class=\"fa fa-comment\"></i>  Comment</button><br><br>";
								echo		"</form>";
								$comment = $crud->GetData("SELECT * FROM comment WHERE POST_ID =".$friend['POST_ID']);
								foreach($comment as $key => $com) {
									$commentor = $crud->GetData("SELECT ACCT_ID,ACCT_fname,ACCT_lname,ACCT_profile FROM acct WHERE ACCT_ID =".$com['ACCT_ID']);
									foreach($commentor as $key => $coms) {
										//echo	"<hr class=\"w3-clear\">";
										echo	"<hr class=\"w3-clear\">";
										echo	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$coms['ACCT_ID']."\">";
										echo	"<img src=\"accountImage/".$coms['ACCT_profile']."\" alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:40px; height: 40px;\">";
										echo	"</a>";
										echo	"<span class=\"w3-right w3-opacity\">".$com['COMMENT_date']."</span>";
										echo	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$coms['ACCT_ID']."\">";
										echo	"<h5>".$coms['ACCT_fname']." ".$coms['ACCT_lname']."</h5><br>";
										echo	"</a>";
										echo	"<hr class=\"w3-clear\">";
										echo	"<p>".$com['COMMENT_comment']."</p>";
									}
								}
							}
						}
							
						echo "</div>";

					}
					?>

				<!-- End Middle Column -->
				</div>

				<!-- Right Column -->
				<div class="w3-col m2">
					
					<div class="w3-card w3-round w3-white w3-center">
						<div class="friendnav"></div>
						<div class="w3-container">
							<p>Search for your friends in the WorldHosteling community</p>
							<div id="main">
							<!-- Main Title -->
							<div class="icon"></div>

							<!-- Main Input -->
							<input type="text" id="search" style="width: 100%;" autocomplete="off">

							<!-- Show Results -->
							<p id="results-text">
								Results: <b id="search-string"></b>
							</p>
								<br><br>
							<ul id="results" style="margin-left: -49px; margin-right: -8px;"></ul>
						</div>
						</div>
					</div>

				<!-- End Right Column -->
				</div>

			<!-- End Grid -->
			</div>

		<!-- End Page Container -->
		</div>
		<br>

		<!-- Footer -->
		<footer class="w3-container w3-padding-16 w3-theme-d3 w3-center">
			<h4>Follow Us</h4>
			<a class="w3-button w3-large w3-teal" href="https://www.facebook.com/" title="Facebook"><i class="fa fa-facebook"></i></a>
			<a class="w3-button w3-large w3-teal" href="https://twitter.com/" title="Twitter"><i class="fa fa-twitter"></i></a>
			<a class="w3-button w3-large w3-teal" href="https://plus.google.com/discover" title="Google +"><i class="fa fa-google-plus"></i></a>
			<a class="w3-button w3-large w3-teal" href="https://www.instagram.com" title="Google +"><i class="fa fa-instagram"></i></a>
			<a class="w3-button w3-large w3-teal w3-hide-small" href="https://www.linkedin.com/feed/" title="Linkedin"><i class="fa fa-linkedin"></i></a>
			<p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>

			<div id="myBtn" style="position:fixed;bottom:0px;margin-left: 82%;" class="w3-tooltip w3-right">				  
				<a class="w3-button w3-theme" href="#myPage"><span class="w3-xlarge">
				<i class="fa fa-chevron-circle-up"></i></span></a>
			</div>
		</footer>
		
		<!-- Hostel Modal -->
		<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="name"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="map"></div>
						<div class="w3-container w3-padding-64 w3-center" id="team">
							<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img id="pic1" class="d-block w-100" src="hostelImage/NY-hi-nyc-gallery-01.jpg" alt="First slide">
										<div class="carousel-caption d-block d-md-block">
											<h5>Hostel 1</h5>
											<p>Great place</p>
										</div>
									</div>
									<div class="carousel-item">
										<img id="pic2" class="d-block w-100" src="hostelImage/yosemite-bug-rustic-mountain.jpg" alt="Second slide">
										<div class="carousel-caption d-block d-md-block">
											<h5>Hostel 2</h5>
											<p>Great place 2</p>
										</div>
									</div>
									<div class="carousel-item">
										<img id="pic3" class="d-block w-100" src="hostelImage/NY-hi-nyc-gallery-01.jpg" alt="Third slide">
										<div class="carousel-caption d-block d-md-block">
											<h5>Hostel 3</h5>
											<p>Great place 3</p>
										</div>
									</div>
								</div>
								<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">State</div>
								<div class="panel-body" id="state"></div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">City</div>
								<div class="panel-body" id="city"></div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">Price</div>
								<div class="panel-body" id="price"></div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">Description</div>
								<div class="panel-body" id="description"></div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">Rating</div>
								<div class="panel-body" id="rating"></div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<a type="button" class="btn btn-primary" id="url" href="" target="_blank">Go to Hostel Site</a>
					</div>
				</div>
			</div>
		</div>
		<!-- End Hostel Modal -->
		
		<!-- Delete confirmation modal -->
		<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<form action="delete.php" method="post" name="hostelDelete" class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Delete Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<img src="icons/icons8-foreclosure-64.png"> Delete!?
					<br><br>
					Are you sure you want to delete this hostel?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<input name="deleteID" id="deleteID" value="" type="hidden">
					<input name="deleteUSER" id="deleteUser" value="<?php echo "".$_SESSION['acctID'].""; ?>" type="hidden">
					<button type="submit" name="hostelDelete" id="hostelDelete" class="btn btn-primary">Delete</a>
					</div>
				</div>
			</form>
		</div>
		<!-- End of delete modal -->
		
		<!-- Upload Profile Modal -->
		<div id="uploadProfileModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<!-- Form -->
					<img src="icons/icons8-compact-camera-64.png" alt="Camera"/>   Say Cheeese!
					<form method='post' action='' enctype="multipart/form-data">
						Select a Profile picture: <input type='file' name='file' id='file' class='form-control' ><br>
						<input type='button' class='btn btn-info' value='Upload' id='upload'>
					</form>

					<!-- Preview-->
					<div id='preview'></div>
				</div>

			</div>

			</div>
		</div>
		<!-- End Upload Profile Modal -->
		
		<!-- Upload Background Modal -->
		<div id="uploadBackgroundModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<!-- Form -->
					<img src="icons/icons8-picture-64.png" alt="picture"/> Woooow, what a sight to see!
					<form method='post' action='' enctype="multipart/form-data">
						Select a Background picture: <input type='file' name='fileBG' id='fileBG' class='form-control' ><br>
						<input type='button' class='btn btn-info' value='Upload' id='uploadBG'>
					</form>

					<!-- Preview-->
					<div id='previewBG'></div>
				</div>

			</div>

			</div>
		</div>
		<!-- End Upload Background Modal -->

		<script>
			// Accordion
			function myFunction(id) {
				var x = document.getElementById(id);
				if (x.className.indexOf("w3-show") == -1) {
					x.className += " w3-show";
					x.previousElementSibling.className += " w3-theme-d1";
				} else { 
					x.className = x.className.replace("w3-show", "");
					x.previousElementSibling.className = 
					x.previousElementSibling.className.replace(" w3-theme-d1", "");
				}
			}
			
			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function() {scrollFunction()};
			function scrollFunction() {
			  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				document.getElementById("myBtn").style.display = "block";
			  } else {
				document.getElementById("myBtn").style.display = "none";
			  }
			}

			// Initialize and add the map
			function initMap(lat, long) {
			  // The location of Uluru
			  var uluru = {lat: lat, lng: long};
			  // The map, centered at Uluru
			  var map = new google.maps.Map(
				  document.getElementById('map'), {zoom: 4, center: uluru});
			  // The marker, positioned at Uluru
			  var marker = new google.maps.Marker({position: uluru, map: map});
			}

			$('.hostel').click(function(){
				//get specific id
				var id=$(this).data('id');

				// make variables from hidden inputs on load
				var hostelName=$('#hostelName'+id).val();
				var hostelState=$('#hostelState'+id).val();
				var hostelCity=$('#hostelCity'+id).val();
				var hostelPrice=$('#hostelPrice'+id).val();
				var hostelDescription=$('#hostelDescription'+id).val();
				var hostelRating=$('#hostelRating'+id).val();
				var hostelLat=parseFloat($('#hostelLat'+id).val());
				var hostelLong=parseFloat($('#hostelLong'+id).val());
				var hostelPic1=$('#hostelPic1'+id).val();
				var hostelPic2=$('#hostelPic2'+id).val();
				var hostelPic3=$('#hostelPic3'+id).val();
				var hostelUrl=$('#hostelUrl'+id).val();

				// call map function with specific lat and long params
				initMap(hostelLat, hostelLong);

				// display specific hostel information in Modal
				$('#name').text(hostelName);
				$('#state').text(hostelState);
				$('#city').text(hostelCity);
				$('#price').text(hostelPrice);
				$('#description').text(hostelDescription);
				$('#rating').text(hostelRating);
				document.getElementById("pic1").src="hostelImage/"+hostelPic1;
				document.getElementById("pic2").src="hostelImage/"+hostelPic2;
				document.getElementById("pic3").src="hostelImage/"+hostelPic3;
				document.getElementById("url").href=""+hostelUrl+"";
				document.getElementById("deleteID").value=id;

			});	
			
			// Live Search Script
			$(document).ready(function() {
	
				// Icon Click Fourm
				$('div.icon').click(function(){
					$('input#search').focus();
				});

				// Live Search
				// On Search, Submit and Get Results
				function search()
				{
					var query_value = $('input#search').val();
					$('b#search-string').text(query_value);
					if(query_value !== ''){
						$.ajax(
						{
							type: "POST",
							url: "livesearch.php",
							data: { query: query_value },
							cache: false,
							success: function(data)
								{
									$("ul#results").html(data);
								}
						}
						);
					}
					return false;
				}

				$("input#search").live("keyup", function(e) {

						// Set Timeout
						clearTimeout($.data(this, 'timer'));

						// Set Search String
						var search_string = $(this).val();

						// Do Search
						if (search_string == '') {
							$("ul#results").fadeOut();
							$('p#results-text').fadeOut();
						}else{
							$("ul#results").fadeIn();
							$('p#results-text').fadeIn();
							$(this).data('timer', setTimeout(search, 100));
						};
				});

			});
			
			// Profile picture upload
			$(document).ready(function(){
			$('#upload').click(function(){

					var fd = new FormData();
					var files = $('#file')[0].files[0];
					fd.append('file',files);

					// AJAX request
						$.ajax({
						url: 'upload.php',
						type: 'post',
						data: fd,
						contentType: false,
						processData: false,
						success: function(response){
							if(response != 0){
								// Show image preview
								$('#preview').append("<img src='"+response+"' width='100' height='100' style='display: inline-block;'>");
							}else{
								alert('file not uploaded, please select another picture');
							}
						}
					});
				});
			});
			
			// Background picture upload
			$(document).ready(function(){
			$('#uploadBG').click(function(){

					var fd = new FormData();
					var files = $('#fileBG')[0].files[0];
					fd.append('file',files);

					// AJAX request
						$.ajax({
						url: 'uploadBG.php',
						type: 'post',
						data: fd,
						contentType: false,
						processData: false,
						success: function(response){
							if(response != 0){
								// Show image preview
								$('#previewBG').append("<img src='"+response+"' width='100' height='100' style='display: inline-block;'>");
							}else{
								alert('file not uploaded');
							}
						}
					});
				});
			});
			
		</script>
		<!-- Live search JQuery -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<!-- Google maps Key -->
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmthmcfhIdRehicONQ1CBD8ai9QyWJVik&callback=initMap">
		</script>
	</body>
</html> 
