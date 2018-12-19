<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');

$crud = new Crud();
$validation = new Validation();

if(isset($_POST['addHostel']))
{
	$hostelID= $crud->escape_string($_POST['id']);
	$acctID = $_SESSION['acctID'];
	echo "$hostelID";
	echo "$acctID";
	$savedValidation = $crud->GetData("SELECT * FROM acct_hostel WHERE HOSTEL_ID = $hostelID AND ACCT_ID = $acctID");
	if($savedValidation == true) {
		header("location:javascript://history.go(-1)");
	} else {
		$crud->execute("INSERT INTO acct_hostel(HOSTEL_ID,ACCT_ID) VALUES('$hostelID','$acctID')");
		header("location:javascript://history.go(-1)");
	}
}