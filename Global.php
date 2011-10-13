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

function HasPermission($safe_userid,$safe_permission,$Connection)
{
global $Database;
global $Connnection;
$res=mysql_query("SELECT * FROM `permissions<>users`,`permissions`
    WHERE `permissions`.name LIKE '$safe_permission'
    AND  `permissions<>users`.permissionid = `permissions`.id
    AND `permissions<>users`.userid = $safe_userid",$Connection);
if($res)
    if(mysql_fetch_array($res))
        return true;
    else
        return false;
else
    return false;
}

function Login($Name, $Hash, $Connection){
	if(!isset($Name)){
		echo "Username or Password incorrect.";
		return false;
	}
	if(!isset($Hash)) {
		echo "Username or Password incorrect.";
		return false;
	}
	$Hash = mysql_real_escape_string($Hash);
	$Name = mysql_real_escape_string($Name);
	$Result = mysql_query("SELECT * FROM users WHERE passhash='".$Hash."' AND name='".$Name."';", $Connection);
	if($Result) {
		$Row = mysql_fetch_array($Result);
		$SessionId = CreateSessionId();
		$UserId = $Row["id"];
		$Mode = $Row["mode"];
		$ExpireDate = time()+(60*60*24);
		mysql_query("INSERT INTO sessions (sessionid,userid,expiredate) VALUES ".$SessionId.",".$UserId.",".$ExpireDate." ON DUPLICATE KEY UPDATE id=".$UserId.";", $Connection);
		echo "OK ".$UserId." ".$SessionId." 0 ".$Mode;
		return true;
	}
	else {
		echo "Username or Password incorrect.";
		return false;
	}
}

function Search($Query, $Start, $Count, $Connection){
	$Query = mysql_real_escape_string($Query);
	$QueryData = mysql_query("SELECT saves.* FROM saves,tags WHERE saves.id = tags.id AND saves.name,tags.name LIKE '%".$Query."%' ORDER BY saves.votes;", $Connection);
	if(!$QueryData){
		echo "0 1 404 404 0 Error Save Doesn't Exist\r\n";
		return 0;
	}
	ob_start();
	for($i = $Start; ($Row = mysql_fetch_array($QueryData)) == true || $i<$Count; $i++) {
		echo $Row["saves.id"]." 1 ".$Row["saves.votes"]." ".$Row["upvotes"]." ".$Row["downvotes"]." ".$Row["author"]." ".$Row["name"]."\r\n";
	}
	ob_end_flush();
}
?>
