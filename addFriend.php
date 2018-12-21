<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['addFriend']))
{
	// gets id from form
	$acctID = $crud->escape_string($_POST['addID']);
	$acctfriendID = $crud->escape_string($_POST['addUSER']);
	
	if ($acctID == $acctfriendID) {
		$friend=$db->prepare("INSERT INTO acct_friend(ACCT_ID,ACCT_FRIEND_ID) VALUES(:id,:fid)");
		$friend->execute(array('id'=>$acctID,'fid'=>$acctfriendID));
	} else {
		// adding the rows to table
		$friend = $db->prepare("INSERT INTO acct_friend(ACCT_ID,ACCT_FRIEND_ID) VALUES(:id,:fid), (:fid,:id)");
		$friend->execute(array('id'=>$acctID,'fid'=>$acctfriendID));
	}
	
	
	//reloads previous page
	header('Location: ' . $_SERVER["HTTP_REFERER"] );
			exit;
}