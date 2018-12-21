<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['post']))
{
	
	$POST_comment =  $crud->escape_string(htmlspecialchars($_POST['POST_comment'], ENT_QUOTES, 'UTF-8'));
	$ACCT_ID = $crud->escape_string($_SESSION['acctID']);
	$postTO = $crud->escape_string($_POST['postToACCTID']);
	
	$msg = $validation->check_empty($_POST, array("'POST_comment','ACCT_ID','postTO'"));
	
	echo "$POST_comment<br>";
	echo "$ACCT_ID<br>";
	echo "$postTO<br>";
	
	// checking for empty field
	if($POST_comment != "")
	{
		// all fields are filled
		// insert into db
		$result = $db->prepare("INSERT INTO post(POST_comment,ACCT_ID,postTO) VALUES(:post,:id,:pid)");
		$result->execute(array('post'=>$POST_comment,'id'=>$ACCT_ID,'pid'=>$postTO));
		if ($ACCT_ID == $postTO) {
			header('Location: ' . $_SERVER["HTTP_REFERER"] );
			exit;
		} else {
			header('Location: ' . $_SERVER["HTTP_REFERER"] );
			exit;
		}
	} else {
		header('Location: ' . $_SERVER["HTTP_REFERER"] );
		exit;
	}
}