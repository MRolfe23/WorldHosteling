<?php

include('dbconfig.php');

class crud extends dbConfig
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function GetData($query)
	{
		$result = $this->connection->query($query);
		
		if($result == false)
		{
			return false;
		}
		
		$rows = array();
		
		while($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		return $rows;
	}
	
	public function execute($query)
	{
		$result = $this->connection->query($query);
		
		if($result == false)
		{
			echo "Error: cannot execute the command";
			return false;
		} else {
			return true;
		}
	}
	
	public function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}
	
	public function delete($id, $table)
	{
		$query = "DELETE FROM $table WHERE id = $id";
		
		$result = $this->connection->query($query);
		
		if ($result == false)
		{
			return false;
		} else {
			return true;	
		}
	}
}