<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['hostelDelete']))
{
	// gets id of the data from the url
	$id = $_POST['deleteID'];
	$user = $_POST['deleteUSER'];
	echo "Hostel to delete ID: $id <br>";
	echo "Current user deleting hostel: $user <---";
	// deleting the row from table
	$result = $db->prepare("DELETE FROM acct_hostel WHERE HOSTEL_ID = :id AND ACCT_ID = :user");
	$result->execute(array('id'=>$id,'user'=>$user));
	
	header("location:account.php");
}