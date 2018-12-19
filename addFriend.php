<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['addFriend']))
{
	// gets id from form
	$acctID = $crud->escape_string($_POST['addID']);
	$acctfriendID = $crud->escape_string($_POST['addUSER']);
	
	if ($acctID == $acctfriendID) {
		$crud->execute("INSERT INTO acct_friend(ACCT_ID,ACCT_FRIEND_ID) VALUES('$acctID','$acctfriendID')");
	} else {
		// adding the rows to table
		$crud->execute("INSERT INTO acct_friend(ACCT_ID,ACCT_FRIEND_ID) VALUES('$acctID','$acctfriendID'), ('$acctfriendID','$acctID')");
	}
	
	
	//reloads previous page
	header('Location: ' . $_SERVER["HTTP_REFERER"] );
			exit;
}