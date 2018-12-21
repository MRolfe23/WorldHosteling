<?php
session_start();
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new crud();
$validation = new validation();

if (!isset($_SESSION['currentPublicPageID'])) {
header("Location:account.php");
}

$specificFriend = $db->prepare("SELECT ACCT_fname,ACCT_lname,ACCT_profile,ACCT_background FROM acct WHERE ACCT_ID = :fid");
$specificFriend->execute(array('fid'=>$_SESSION['currentPublicPageID']));
foreach($specificFriend as $key => $friend) {
	$friendID = $_SESSION['currentPublicPageID'];
	$friendFN = $friend['ACCT_fname'];
	$friendLN = $friend['ACCT_lname'];
	$friendPR = $friend['ACCT_profile'];
	$friendBG = $friend['ACCT_background'];
}
?>
<!DOCTYPE html>
<html>
	<Head>
		<title>WorldHosteling</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="icons/whLogo.PNG" type="image">
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
		<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px"> 
			<img src="accountBackgroundImage/<?php echo "$friendBG"; ?>" alt="Background" style="width: 100%; height: 500px;margin-bottom: 10px;">
			<!-- The Grid -->
			<div class="w3-row">
				<!-- Left Column -->
				<div class="w3-col m3">
					<!-- Profile -->
					<div class="w3-card w3-round w3-white">
						<div class="friendnav"></div>
						<div class="w3-container">
							<h4 class="w3-center"><?php echo "$friendFN $friendLN"; ?></h4>
							<p class="w3-center"><img src="accountImage/<?php echo "$friendPR"; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
							
						</div>
					</div>
					<br>

					<!-- Accordion -->
					<div class="w3-card w3-round" style="margin-bottom: 25px;">
						<div class="w3-white">
							<button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> <?php echo "$friendFN's"; ?> Friends</button>
							<div id="Demo1" class="w3-hide w3-container">
								<?php
								$result = $db->prepare("SELECT * FROM acct WHERE ACCT_ID in (SELECT ACCT_FRIEND_ID FROM acct_friend WHERE ACCT_ID = :fid)");
								$result->execute(array('fid'=>$friendID));
								if ($result->rowCount() == 0) {
									echo "<h3>$friendFN must be new! Add her as a friend to share your adventures $friendFN! =]";
								} else {
									$friendCheck = $db->prepare("SELECT * FROM acct_friend WHERE (ACCT_ID = :id AND ACCT_FRIEND_ID =:fid) OR (ACCT_ID = :fid AND ACCT_FRIEND_ID =:id)");
									$friendCheck->execute(array('id'=>$_SESSION['acctID'],'fid'=>$friendID));
									if ($friendCheck->rowCount() == 0) {
										foreach($result as $key => $res) {
											echo "<form name=\"viewFriend\" action=\"viewFriendPage.php\" method=\"post\" class=\"viewFriend w3-container w3-card w3-white w3-round w3-margin\" role=\"document\"><br>";
											echo 	"<div class=\"viewFriend\" onClick=\"document.forms['friend'].submit();\">";
											echo 		"<img src=\"accountImage/".$res['ACCT_profile']."\" alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:60px\">";
											echo 		"<input name=\"friend\" class=\"friend\" type=\"hidden\" value=\"".$res['ACCT_ID']."\"";
											echo		"<p>".$res['ACCT_fname']." ".$res['ACCT_lname']."</p><br>";
											echo		"<hr class=\"w3-clear\">";
											echo	"</div>";
											echo "</form>";
										}
									} else {
											foreach($result as $key => $res) {
												echo "<form name=\"viewFriend\" action=\"viewFriendPage.php\" method=\"post\" class=\"viewFriend w3-container w3-card w3-white w3-round w3-margin\" role=\"document\"><br>";
												echo 	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$res['ACCT_ID']."\">";
												echo 		"<img src=\"accountImage/".$res['ACCT_profile']."\" alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:60px\">";
												echo 		"<input name=\"friend\" class=\"friend\" type=\"hidden\" value=\"".$res['ACCT_ID']."\"";
												echo		"<p>".$res['ACCT_fname']." ".$res['ACCT_lname']."</p><br>";
												echo		"<hr class=\"w3-clear\">";
												echo	"</a>";
												echo "</form>";
										}
									}
								}
								?>
							</div>

							<button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-home fa-fw w3-margin-right"></i> <?php echo "$friendFN's"; ?> Hostels</button>
							<div id="Demo3" class="w3-hide w3-container">
								<div class="w3-row-padding">
									<br>
									<?php
									$query = $db->prepare("select * from hostel where HOSTEL_ID in (select HOSTEL_ID from acct_hostel where ACCT_ID = :fid)");
									
									$query->execute(array('fid'=>$friendID));
									if($query->rowCount() == 0){
										echo "<h2>$friendFN has no saved hostels!</h2>";
									}else{
										$result = $db->prepare("select * from hostel where HOSTEL_ID in (select HOSTEL_ID from acct_hostel where ACCT_ID = :fid)");
										$result->execute(array('fid'=>$friendID));
										foreach($result as $key => $res)
										{
											// hold Location data to take from javascript to put into modal
											echo "<input name=\"hostelLat$res[HOSTEL_ID]\" id=\"hostelLat$res[HOSTEL_ID]\" value=\"$res[HOSTEL_latitude]\" type=\"hidden\">";
											echo "<input name=\"hostelLong$res[HOSTEL_ID]\" id=\"hostelLong$res[HOSTEL_ID]\" value=\"$res[HOSTEL_longitude]\" type=\"hidden\">";

											echo "<div class=\"w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom\">";
											echo "<br>";
											//echo 		"<div class=\"w3-half\">";
											echo 			"<img class=\"hostel\" style=\"width:100%\" src=\"hostelImage/$res[HOSTEL_pic1]\" data-toggle=\"modal\" data-target=\"#hostelInfo$res[HOSTEL_ID]\" alt=\"HostelName\" data-id=\"$res[HOSTEL_ID]\">";
											echo			"<div class=\"$res[HOSTEL_ID]\">";
											echo				"<h5>$res[HOSTEL_name]</h5>";
											echo				"<p>Rating: $res[HOSTEL_rating]</p>";
											echo			"</div>";
											//echo		"</div>";
											echo "</div>";
											
											// Generate new modal for each hostel based on search string
											echo "<div class=\"modal fade\" id=\"hostelInfo$res[HOSTEL_ID]\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLongTitle\" aria-hidden=\"true\" style=\"text-align: left;\">";
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
												$checkSaved = $crud->GetData("SELECT * FROM acct_hostel WHERE ACCT_ID = $_SESSION[acctID] AND HOSTEL_ID = $res[HOSTEL_ID]");
												if($checkSaved == false) {
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

					<?php
					$friendCheck = $db->prepare("SELECT * FROM acct_friend WHERE (ACCT_ID = :id AND ACCT_FRIEND_ID =:fid) OR (ACCT_ID = :fid AND ACCT_FRIEND_ID =:id)");
					$friendCheck->execute(array('id'=>$_SESSION['acctID'],'fid'=>$friendID));
					if ($friendCheck->rowCount() == 0) {
						echo "<div class=\"w3-container w3-card w3-white w3-round w3-margin\"><br>";
						echo 	"<h4>Add $friendFN as a friend!</h4><br>";
						echo 	"<hr class=\"w3-clear\">";
						echo	"<p>To be able to see what $friendFN is up to you'll need to add them as a friend! I bet $friendFN has some great travel tips to share with you!</p>";
						echo "</div>";
					} else {
						echo "<div class=\"w3-row-padding\">";
						echo	"<div class=\"w3-col m12\">";
						echo		"<div class=\"w3-card w3-round w3-white\">";
						echo			"<div class=\"friendnav\"></div>";
						echo			"<form name=\"addPOST\" action=\"addPOST.php\" method=\"post\" class=\"w3-container w3-padding\" role=\"document\">";
						echo				"<h6 class=\"w3-opacity\">Post something to $friendFN!</h6>";
						echo				"<div id=\"postFail\"></div>";
						echo				"<input type=\"hidden\" name=\"postACCTID\" id=\"postACCTID\" value=\"".$_SESSION['acctID']."\"/>";
						echo				"<input type=\"hidden\" name=\"postToACCTID\" id=\"postToACCTID\" value=\"$friendID\"/>";
						echo				"<input id=\"POST_comment\" name=\"POST_comment\" contenteditable=\"true\" class=\"w3-border w3-padding\" value=\"\" style=\"width:100%;\"/>";
						echo				"<br><br>";
						echo				"<button id=\"post\" name=\"post\" type=\"submit\" class=\"w3-button w3-theme\"><i class=\"fa fa-pencil\"></i>  Post</button>";
						echo			"</form>";
						echo		"</div>";
						echo	"</div>";
						echo "</div>";
						$friends = $db->prepare("SELECT * FROM post WHERE ACCT_ID = (:fid AND postTO = :fid) OR postTO =:fid ORDER BY POST_date DESC;");
						$friends->execute(array('fid'=>$friendID));
						// creates display of all comments
						foreach($friends as $key => $friend)
						{
							$poster = $db->prepare("SELECT ACCT_fname,ACCT_lname,ACCT_profile FROM acct WHERE ACCT_ID = :fid");
							$poster->execute(array('fid'=>$friend['ACCT_ID']));
							foreach($poster as $key => $pos) {
								echo "<div id=\"post".$friend['POST_ID']."\" class=\"w3-container w3-card w3-white w3-round w3-margin\"><br>";
								echo	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$friend['ACCT_ID']."\">";
								echo 	"<img src=\"accountImage/".$pos['ACCT_profile']."\" alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:50px; height: 50px;\">";
								echo	"</a>";
								echo	"<span class=\"w3-right w3-opacity\">".$friend['POST_date']."</span>";
								echo	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$friend['ACCT_ID']."\">";
								$postTO = $db->prepare("SELECT ACCT_ID,ACCT_fname,ACCT_lname FROM acct WHERE ACCT_ID =:pid");
								$postTO->execute(array('pid'=>$friend['postTO']));
								foreach($postTO as $key => $to) {
									echo	"<h4>".$pos['ACCT_fname']." ".$pos['ACCT_lname']."</h4></a><p>posted to:<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=".$to['ACCT_ID']."\"> ".$to['ACCT_fname']." ".$to['ACCT_lname']."</p></a><br>";
									echo	"<hr class=\"w3-clear\">";
									echo	"<p>".$friend['POST_comment']."</p>";
									echo		"<form name=\"addCOMMENT\" action=\"addCOMMENT.php\" method=\"post\" class=\"w3-container w3-padding\" role=\"document\">";
									echo			"<div id=\"commentFail\"></div>";
									echo			"<input type=\"hidden\" name=\"commentACCTID\" class=\"commentACCTID\" value=\"".$_SESSION['acctID']."\"/>";
									echo			"<input type=\"hidden\" name=\"commentTOPOSTID\" class=\"commentTOPOSTID\" value=\"".$friend['POST_ID']."\"/>";
									echo			"<input id=\"COMMENT_comment\" name=\"COMMENT_comment\" contenteditable=\"true\" class=\"COMMENT_comment w3-border w3-padding\" value=\"\" style=\"width:100%;\"/>";
									echo			"<br><br>";
									echo			"<button id=\"addCOMMENT\" name=\"addCOMMENT\" type=\"submit\" class=\"w3-button w3-theme-d2\"><i class=\"fa fa-comment\"></i>  Comment</button><br><br>";
									echo		"</form>";

									$comment = $db->prepare("SELECT * FROM comment WHERE POST_ID =:pid");
									$comment->execute(array('pid'=>$friend['POST_ID']));
									foreach($comment as $key => $com) {
										$commentor = $db->prepare("SELECT ACCT_ID,ACCT_fname,ACCT_lname,ACCT_profile FROM acct WHERE ACCT_ID =:cid");
										$commentor->execute(array('cid'=>$com['ACCT_ID']));
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
					}
					?>

				<!-- End Middle Column -->
				</div>

				<!-- Right Column -->
				<div class="w3-col m2">
					
					<div class="w3-card w3-round w3-white w3-center">
						<div class="friendnav"></div>
						<div class="w3-container">
							<p>Friend Status:</p>
							
							<?php
							$friendCheck = $db->prepare("SELECT * FROM acct_friend WHERE (ACCT_ID = :id AND ACCT_FRIEND_ID =:fid) OR (ACCT_ID = :fid AND ACCT_FRIEND_ID =:id)");
							$friendCheck->execute(array('id'=>$_SESSION['acctID'],'fid'=>$friendID));
							if ($friendCheck->rowCount() == 0) {
								echo "<span>You are currently not friends.<br>Click the green checkmark to add!</span>";
								echo "<form name=\"addFriend\" action=\"addFriend.php\" method=\"post\" class=\"w3-row w3-opacity\" role=\"document\">";
								echo		"<input type=\"hidden\" name=\"addID\" id=\"addID\" value=\"".$_SESSION['acctID']."\"/>";
								echo		"<input type=\"hidden\" name=\"addUSER\" id=\"addUSER\" value=\"$friendID\"/>";
								echo		"<button id=\"addFriend\" name=\"addFriend\" type=\"submit\" class=\"w3-button w3-block w3-green w3-section\" title=\"Add\" style=\"width:100%;\"><i class=\"fa fa-check\"></i></button>";
								echo "</form>";
							} else {
								echo "<span>You are currently friends!<br>Click the red X to remove.</span>";
								echo "<form name=\"deleteFriend\" action=\"deleteFriend.php\" method=\"post\" class=\"w3-row w3-opacity\" role=\"document\">";
								echo 	"<input type=\"hidden\" name=\"deleteID\" id=\"deleteID\" value=\"".$_SESSION['acctID']."\"/>";
								echo	"<input type=\"hidden\" name=\"deleteUSER\" id=\"deleteUSER\" value=\"$friendID\"/>";
								echo	"<button id=\"delFriend\" name=\"delFriend\" type=\"submit\" class=\"w3-button w3-block w3-red w3-section\" title=\"Remove\"><i class=\"fa fa-remove\"></i></button>";
								echo "</form>";
							}
							?>
							
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
		<div class="modal fade" id="hostelInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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

			var hostelLat=parseFloat($('#hostelLat'+id).val());
			var hostelLong=parseFloat($('#hostelLong'+id).val());
		});
			
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
