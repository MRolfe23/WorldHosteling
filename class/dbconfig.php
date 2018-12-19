<?php

// class
class dbConfig
{
	//private $_host = "************";
	private $_host = "localhost";
	//private $_userame = "************";
	private $_userame = "root";
	//private $_password = "************";
	private $_password = "";
	//private $_database = "************";
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
