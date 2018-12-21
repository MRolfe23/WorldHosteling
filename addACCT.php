<?php
session_start();

// include the database and validation files
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['addACCT']))
{
	$ACCT_fname = $crud->escape_string($_POST['ACCT_fname']);
	$ACCT_lname = $crud->escape_string($_POST['ACCT_lname']);
	$ACCT_email = $crud->escape_string(strtolower($_POST['ACCT_email']));
	$ACCT_pass = $crud->escape_string($_POST['ACCT_pass']);
	$ACCT_pass2 = $crud->escape_string($_POST['ACCT_pass2']);
	$ACCT_profile = "icons8-customer-filled-52.png";
	$email = "";
	
	$msg = $validation->check_empty($_POST, array('ACCT_fname','ACCT_lname','ACCT_email','ACCT_pass','ACCT_pass2'));

	
	$result = $db->prepare("SELECT ACCT_email FROM acct WHERE ACCT_email = :email");
	$result->execute(array('email'=>$ACCT_email));
	foreach($result as $res)
	{
		$email = $res['ACCT_email'];
	}
	if ($email == $ACCT_email || $ACCT_pass <> $ACCT_pass2) 
	{
		header("Location:index.php");
	} else {
		$ACCT_pass = crypt($_POST['ACCT_pass'], '$2a$07$YourSaltIsA22ChrString$');
		
		$result = $db->prepare("INSERT INTO acct (ACCT_fname,ACCT_lname,ACCT_email,ACCT_pass,ACCT_profile) VALUES(:fname,:lname,:email,:pass,:prof)");
		$result->execute(array('fname'=>$ACCT_fname,'lname'=>$ACCT_lname,'email'=>$ACCT_email,'pass'=>$ACCT_pass,'prof'=>$ACCT_profile));
		
		
		$result = $db->prepare("SELECT * FROM acct WHERE ACCT_email = :email");
		$result->execute(array('email'=>$ACCT_email));
		foreach($result as $res)
		{
			$_SESSION['acctID'] = $res[ACCT_ID];
			$_SESSION['acctFN'] = $res[ACCT_fname];
			$_SESSION['acctLN'] = $res[ACCT_lname];
			$_SESSION['acctEM'] = $res[ACCT_email];
			$_SESSION['acctPR'] = $res[ACCT_profile];
			$_SESSION['acctBG'] = $res[ACCT_background];
		}
		$result = $db->prepare("INSERT INTO acct_friend(ACCT_ID,ACCT_FRIEND_ID) VALUES(:id1, :id2)");
		$result->execute(array('id1'=>$_SESSION['acctID'],'id2'=>$_SESSION['acctID']));
		header("Location:account.php");

	}
}