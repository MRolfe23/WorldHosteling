<?php

// class
class dbConfig
{
	//private $_host = "198.71.231.3";
	private $_host = "localhost";
	//private $_userame = "publicMike";
	private $_userame = "root";
	//private $_password = "zdk~kZs]]@#H";
	private $_password = "";
	//private $_database = "worldhosteling";
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