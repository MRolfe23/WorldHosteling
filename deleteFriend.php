<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['delFriend']))
{
	// gets id of the data from the url
	$acctID = $_POST['deleteID'];
	$acctfriendID = $_POST['deleteUSER'];

	// deleting the row from table
	$result = $db->prepare("DELETE FROM acct_friend WHERE (ACCT_ID = :id AND ACCT_FRIEND_ID =:fid) OR (ACCT_ID = :fid AND ACCT_FRIEND_ID =:id)");
	$result->execute(array('id'=>$acctID,'fid'=>$acctfriendID));
	
	//header('Location:account.php');
	header('Location: ' . $_SERVER["HTTP_REFERER"] );
			exit;
}