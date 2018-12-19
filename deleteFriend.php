<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['delFriend']))
{
	// gets id of the data from the url
	$acctID = $_POST['deleteID'];
	$acctfriendID = $_POST['deleteUSER'];

	// deleting the row from table
	$result = $crud->execute("DELETE FROM acct_friend WHERE (ACCT_ID = $acctID AND ACCT_FRIEND_ID =$acctfriendID) OR (ACCT_ID = $acctfriendID AND ACCT_FRIEND_ID =$acctID)");
	
	//header('Location:account.php');
	header('Location: ' . $_SERVER["HTTP_REFERER"] );
			exit;
}