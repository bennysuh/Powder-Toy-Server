<?PHP
require_once("Global.php");
$Connection = StartDatabase();
$Headers = getallheaders();
$Name = $Headers["X-Auth-User"];
$Hash = $Headers["X-Auth-Hash"];
$Version = $Headers["X-Powder-Version"];
$Hash = mysql_real_escape_string($Hash);
$Name = mysql_real_escape_string($Name);
$Result = mysql_query("SELECT * FROM users WHERE passhash='".$Hash."' AND name='".$Name."';", $Connection);
if($Result) {
	$Row = mysql_fetch_array($QueryData);
	$SessionId = CreateSessionId();
	$UserId = $Row["id"];
	$Mode = $Row["mode"];
	$ExpireDate = time()+(60*60*24);
	mysql_query("INSERT INTO sessions (sessionid,userid,expiredate) VALUES ".$User["SessionId"].",".$User["Id"].",".$Settings["ExpireDate"]." ON DUPLICATE KEY UPDATE id=".$User["Id"].";", $Settings["Connection"]);
	echo "OK ".$User["Id"]." ".$SessionId." 0 ".$Mode;
	LogEvent("logged in. Version: ".$Version.", Session-Id: ".$SessionId"].".", $UserId, $Connection);
}
else {
	print "Username or Password incorrect.";
}
CloseDatabase($Connection);
?>