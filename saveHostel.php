<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new Crud();
$validation = new Validation();

if(isset($_POST['addHostel']))
{
	$hostelID= $crud->escape_string($_POST['id']);
	$acctID = $_SESSION['acctID'];
	echo "$hostelID";
	echo "$acctID";
	$savedValidation = $db->prepare("SELECT * FROM acct_hostel WHERE HOSTEL_ID = :hid AND ACCT_ID = :id");
	$savedValidation->execute(array('hid'=>$hostelID,'id'=>$acctID));
	if($savedValidation->rowCount() > 0) {
		header("location:javascript://history.go(-1)");
	} else {
		$result = $db->prepare("INSERT INTO acct_hostel(HOSTEL_ID,ACCT_ID) VALUES(:hid,:id)");
		$result->execute(array('hid'=>$hostelID,'id'=>$acctID));
		header("location:javascript://history.go(-1)");
	}
}