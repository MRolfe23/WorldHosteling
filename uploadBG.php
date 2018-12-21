<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new crud();
$validation = new validation();

// file name
$filename = $_FILES['file']['name'];

// Location
$location = 'accountBackgroundImage/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("jpg","png","jpeg","gif");

$response = 0;
if(in_array($file_extension,$image_ext)){
	// Upload file
	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
		$response = $location;

		$acctID = $_SESSION['acctID'];
		$_SESSION['acctBG'] = $filename;

		// adding the rows to table
		$result = $db->prepare("UPDATE acct SET ACCT_profile = :file WHERE ACCT_ID = :id");
		$result->execute(array('file'=>$filename,'id'=>$acctID));
	}
}

echo $response;