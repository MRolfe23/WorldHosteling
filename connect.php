<?php
$ini = parse_ini_file('~/worldhosteling.ini',true);
/* Database config*/
$db_host		=$ini['hostedDB']['ip'];
$db_user		=$ini['hostedDB']['user'];
$db_pass		=$ini['hostedDB']['pass'];
$db_database	=$ini['hostedDB']['db'];

$db_host = "$db_host";
$db_user = "$db_user";
$db_pass = "$db_pass";
$db_database = "$db_database";
/* End Config*/
$db = new PDO('mysql:host='.$db_host.'; dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!$db){
	echo "Unable to connect to database";
}
