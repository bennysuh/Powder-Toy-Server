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

function LogEvent($Event, $UserId, $Connection) { //Event is the log message. E.g. 
	if(!isset($Event)) return 0;
	if(!isset($UserId)) $UserId = 1;
	$Year = date("Y");
	$Month = date("F");
	$Day = date("l");
	mkdir("Logs");
	mkdir("Logs/".$Year);
	mkdir("Logs/".$Year."/".$Month);
	mkdir("Logs/".$Year."/".$Month."/".$Day);
	$FileName = "Logs/".$Year."/".$Month."/".$Day."/Cookie.jar";
	$FileHandle = fopen($FileName, 'a') or die("Can't open file!");
	$UserId = mysql_real_escape_string($UserId);
	$QueryData = mysql_query("SELECT name FROM users WHERE id = '".$UserID."';", $Connection);
	$Row = mysql_fetch_array($QueryData);
	$UserName = $Row["name"];
	mysql_free_result($QueryData);
	$LogData = date("d/m/Y h:i:s A")." | ".$UserName." ".$Event."\r\n";
	fwrite($FileHandle, $LogData);
	fclose($ourFileHandle);
}

function IdToName($Id, $Connection){
	$Row = mysql_fetch_array(mysql_query("SELECT name FROM users WHERE id = ".mysql_real_escape_string($Id).";", $Connection));
	return $Row["name"];
}

function CreateSessionId()
{
    return substr(uniqid("").uniqid("").uniqid(""),0,31);
}
?>