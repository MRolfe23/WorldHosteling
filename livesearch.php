<?php

// Database connection

// Credentials
$dbhost = "localhost";
$dbname = "finalproject";
$dbuser = "root";
$dbpass = "";

// connection
global $db;

$db= new mysqli();
$db->connect($dbhost, $dbuser, $dbpass, $dbname);
$db->set_charset("utf8");

// check connection
if ($db->connect_errno)
{	
	printf("Connect failed: %s\n", $db->connect_error);
	exit();
}

// Define output html formatting
/*$html = '';
$html .= '<li class="result">';
$html .= '<a target="_blank" href="urlString">';
$html .= '<h3>nameString</h3>';
$html .= '<h4>functionString</h4>';
$html .= '</a>';
$html .= '</li>';*/

// my definittion of output
$html = '';
$html .= "<div class=\"viewFriend w3-container w3-card w3-white w3-round w3-margin\"><br>";
$html .= 	"<a name=\"viewFriend\" class=\"viewFriend\" href=\"viewFriendPage.php?id=idString\">";
$html .= 		"<img src=\"accountImage/profileString\" alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:60px\">";
$html .= 		"<input name=\"friend\" class=\"friend\" type=\"hidden\" value=\"idString\">";
$html .=		"<p>fnameString lnameString</p><br>";
$html .=		"<hr class=\"w3-clear\">";
$html .=	"</a>";
$html .= "</div>";

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $db->real_escape_string($search_string);

// Check length more than one character
if (strlen($search_string) >= 1 && $search_string !== ' ')
{
	// Build Query
	$query = 'SELECT ACCT_ID, ACCT_fname, ACCT_lname, ACCT_profile FROM acct WHERE ACCT_fname LIKE "%'.$search_string.'%" OR ACCT_lname LIKE "%'.$search_string.'%"';
	
	// Do Search
	$result = $db->query($query);
	while($results = $result->fetch_array())
	{
		$result_array[] = $results;
	}
	// make that empty results empty or not idk yet
	// Check if we have results
	if (isset($result_array))
	{
		foreach ($result_array as $result)
		{
			// Format output strings and highlight matches
			$display_fname= preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['ACCT_fname']);
			
			$display_lname = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['ACCT_lname']);
			
			$display_id = $result['ACCT_ID'];
			
			$display_profile = $result['ACCT_profile'];
			
			// insert furmatted data to the output
			
			// Insert name
			$output = str_replace('fnameString', $display_fname, $html);
			
			// insert function
			$output = str_replace('lnameString', $display_lname, $output);
			
			// insert url
			$output = str_replace('idString', $display_id, $output);
			
			// insert profile pic
			$output = str_replace('profileString', $display_profile, $output);
			
			// output
			echo($output);
		}
	}
	else
	{
		// format no result output
		$output = str_replace('idString', '', $html);
		$output = str_replace('lnameString', '<b>No Results Found.</b>', $output);
		$output = str_replace('fnameString', 'Sorry :(', $output);
		
		// output
		echo($output);
	}
	
}