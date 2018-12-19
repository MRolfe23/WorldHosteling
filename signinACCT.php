<?php
session_start();

include('class/crud.php');
include('class/validation.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['signinACCT']))
{
	$ACCT_email = $crud->escape_string(strtolower($_POST['signinemail']));
	$ACCT_pass = $crud->escape_string(crypt($_POST['signinpass'], '$2a$07$YourSaltIsA22ChrString$'));
	
	$msg = $validation->check_empty($_POST, array('ACCT_email','ACCT_pass'));
	
	// checking for empty fields
	if($msg = null)
	{
		header("Location:index.php");
	} else {
		
		$result = $crud->GetData("SELECT * FROM acct WHERE ACCT_email = '$ACCT_email'");
		foreach($result as $res)
		{
			$id = $res['ACCT_ID'];
			$fname = $res['ACCT_fname'];
			$lname = $res['ACCT_lname'];
			$email = $res['ACCT_email'];
			$password = $res['ACCT_pass'];
			$profile = $res['ACCT_profile'];
			$background = $res['ACCT_background'];
		}
		if ($email == $ACCT_email && $password == $ACCT_pass) 
		{
			$_SESSION['acctID'] = $id;
			$_SESSION['acctFN'] = $fname;
			$_SESSION['acctLN'] = $lname;
			$_SESSION['acctEM'] = $email;
			$_SESSION['acctPR'] = $profile;
			$_SESSION['acctBG'] = $background;
			$_SESSION['currentPublicPageID'];
			echo "$ACCT_email<br>";
			echo "$ACCT_pass<br>";
			echo "<br>";
			echo "<br>";
			header("Location:account.php");
		} else {
			header("Location:index.php");
		}
	}
}
