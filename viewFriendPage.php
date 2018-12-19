<?php

session_start();
// include the database and validation files
include('class/crud.php');
include('class/validation.php');

unset($_SESSION['currentPublicPageID']);

$_SESSION['currentPublicPageID'] = $_GET['id'];
echo "".$_GET['id']." this is friend id";
header("Location:accountPublic.php");

?>