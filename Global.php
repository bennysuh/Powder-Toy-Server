<?php
require_once("Settings.php");
global $Database;
function StartDatabase(){
    global $Database;
	$Connection = mysql_connect($Database["Host"],$Database["Username"], $Database["Password"]);
	mysql_select_db($Database["Database"]);
	return $Connection;
}

function CloseDatabase($Connection){
	mysql_close($Connection);
}

/*function LogEvent($Event, $UserId, $Connection) { //Event is the log message. E.g. 
	$Year = date("Y");
	$Month = date("F");
	$Day = date("l");
	mkdir("./Logs/".$Year."/".$Month."/".$Day);
	$FileName = "Cookie.jar";
	$FileHandle = fopen($FileName, 'a') or die("Can't open file!");
	$UserId = mysql_real_escape_string($UserId);
	$QueryData = mysql_query("SELECT name FROM users WHERE id = '".$UserID."';", $Connection);
    $Result = mysql_fetch_array($QueryData)
	$UserName = $Result["name"];
	mysql_free_result($QueryData);
	$LogData = date("d/m/Y h:i:s A")." | ".$UserName." ".$Event."\n";
	fwrite($FileHandle, $LogData);
	fclose($ourFileHandle);
}*/

/*function IdToName($Id, $Connection){
	return mysql_fetch_array(mysql_query("SELECT name FROM users WHERE id = ".mysql_real_escape_string($Id).";", $Connection))["name"];
}*/

function CreateSessionId()
{
    return substr(uniqid("").uniqid("").uniqid(""),0,31);
}
?>
