<?php
session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');
include('connect.php');

$crud = new crud();
$validation = new validation();

if(isset($_POST['addCOMMENT']))
{
	
	$COMMENT_comment = $crud->escape_string(htmlspecialchars($_POST['COMMENT_comment'], ENT_QUOTES, 'UTF-8'));
	$ACCT_ID = $crud->escape_string($_POST['commentACCTID']);
	$POST_ID = $crud->escape_string($_POST['commentTOPOSTID']);
	echo "$COMMENT_comment<br>$ACCT_ID<br>$POST_ID";
	// checking for empty fields
	if($COMMENT_comment != "")
	{
		// all fields are filled
		// insert into db
								
		$result = $db->prepare("INSERT INTO comment(COMMENT_comment,POST_ID,ACCT_ID) VALUES(:comment,:pid,:id)");
		$result->execute(array('comment'=>$COMMENT_comment,'pid'=>$POST_ID,'id'=>$ACCT_ID));
		header('Location: ' . $_SERVER["HTTP_REFERER"] .'#post'.$POST_ID);
		exit;
	} else {
		header("location:javascript://history.go(-1)");
	}
}