<?php

// class
class dbConfig
{
	$ini = parse_ini_file('~/worldhosteling.ini',true);
	/* Database config*/
	$db_host		=$ini['hostedDB']['ip'];
	$db_user		=$ini['hostedDB']['user'];
	$db_pass		=$ini['hostedDB']['pass'];
	$db_database	=$ini['hostedDB']['db'];
	//private $_host = "$db_host";
	private $_host = "localhost";
	//private $_userame = "$db_user";
	private $_userame = "root";
	//private $_password = "$db_pass";
	private $_password = "";
	//private $_database = "$db_database";
	private $_database = "finalproject";
	
	protected $connection;
	
	public function __construct()
	{
		if(!isset($this->connection))
		{
			$this->connection = new MySQLi($this->_host,
										   $this->_userame,
										   $this->_password,
										   $this->_database);
			if(!$this->connection)
			{
				echo "Unable to connect to Database at this time.";
				exit;
			}
		}
		return $this->connection;
	}
}
