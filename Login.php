<?PHP
require_once("Global.php");
$Settings["Connection"] = StartDatabase();
foreach(getallheaders() as $Name => $Value) {
	if($Name == "X-Auth-User"):
		$User["Name"] = $Value;
	elseif($Name == "X-Auth-Hash"):
		$User["Hash"] = $Value;
	elseif($Name == "X-Powder-Version"):
		$Settings["Version"] = $Value;
}
$Settings["Hash"] = mysql_real_escape_string($Settings["Hash"]);
$Settings["User"] = mysql_real_escape_string($Settings["User"]);
//$User["Hash"]="b3f15e8156c41b717074e384c92ec771";
//$User["Name"]="doxin";
$Result = mysql_query("SELECT * FROM users WHERE passhash='".$Settings["Hash"]."' AND name='".$User["Name"]."';", $Settings["Connection"]);
while($Row = mysql_fetch_array($QueryData)) {
	$User["SessionId"] = CreateSessionId();
	$User["Id"] = $Result["id"];
	$Settings["Mode"] = $Result["mode"];
	$Settings["ExpireDate"] = time()+(60*60*24);
	mysql_query("INSERT INTO sessions (sessionid,userid,expiredate) VALUES ".$User["SessionId"].",".$User["Id"].",".$Settings["ExpireDate"]." ON DUPLICATE KEY UPDATE id=".$User["Id"].";", $Settings["Connection"]);
	echo "OK ".$User["Id"]." ".$Settings["SessionId"]." 0 ".$Settings["Mode"];
	LogEvent(" logged in. Version: ".$Settings["Version"].", Session-Id: ".$User["SessionId"].".", $User["Id"], $Settings["Connection"]);
}
else {
	print "Username or Password incorrect.";
}
CloseDatabase($Settings["Connection"]);
?>
