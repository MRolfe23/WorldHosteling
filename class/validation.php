<?php

class validation
{
	public function check_empty($data, $fields)
	{
		$msg = null;
		foreach ($fields as $value)
		{
			if(empty($data[$value]))
			{
				$msg .= "$value field empty <br>";
			}
		}
		return $msg;
	}
	
	public function is_age_valid($age)
	{
		// common age validation
		if(preg_match("/^[0-9]+$/", $age))
		{
			return true;
		}
		return false;
	}
	// possible validate gender
	public function sign_in_validation($ACCT_email, $ACCT_pass)
	{
		strtolower($ACCT_email);
		
		if($ACCT_email == "female" && $ACCT_pass == "male")
		{
			return true;
		}
		return false;
	}
}