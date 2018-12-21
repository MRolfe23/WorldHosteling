<?php
//$ini = parse_ini_file('~/worldhosteling.ini',true);
/* Database config*/
/*$db_host		=$ini['hostedDB']['userIP'];
$db_user		=$ini['hostedDB']['userID'];
$db_pass		=$ini['hostedDB']['userPass'];
$db_database	=$ini['hostedDB']['userDB'];*/
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_database = "finalproject";
/* End Config*/
$db = new PDO('mysql:host='.$db_host.'; dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!$db){
	echo "Unable to connect to database";
}