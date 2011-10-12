<?php
require_once("Global.php");

if(isset($_GET["Query"])){
	$Settings["Query"] = $_GET["Query"];
}
if(isset($_GET["ShowVotes"])){
	$Settings["ShowVotes"] = $_GET["ShowVotes"];
}
$Setting["Start"] = 0;
if(isset($_GET["Start"])){
	$Settings["Start"] = $_GET["Start"];
}
if(!isset($_GET["Count"])){
	return 0;
}
else{
	$Settings["Count"] = $_GET["Count"];
}
$Headers = getallheaders();
$User["ID"] = $Headers["X-Auth-User-Id"];
if($User["ID"] == NULL) $User["ID"] = 0;
$User["Session"] = $Headers["X-Auth-Session-Key"];
if($User["Session"] == NULL) $User["Session"] = 0;
$User["Version"] = $Headers["X-Powder-Version"];
if($User["Version"] == NULL) $User["Version"] = 0;
$Settings["Connection"] = StartDatabase();
LogEvent("searched ".$Settings["Query"], $Settings["ID"], $Settings["Connection"]);
$Settings["Query"] = mysql_real_escape_string($Settings["Query"]);
$QueryData = mysql_query("SELECT saves.* FROM saves,tags WHERE saves.id = tags.id AND saves.name,tags.name LIKE '%".$Settings["Query"]."%' ORDER BY saves.votes;", $Settings["Connection"]);
ob_start();
for($i = 0; ($Row = mysql_fetch_array($QueryData)) == true || $i<$Settings["Count"]; $i++) {
	echo $Row["saves.id"]." 1 ".$Row["saves.votes"]." ".$Row["upvotes"]." ".$Row["downvotes"]." ".$Row["author"]." ".$Row["name"]."\r\n";
}
ob_end_flush();
CloseDatabase($Settings["Connection"]);
?>