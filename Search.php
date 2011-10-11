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
foreach(getallheaders() as $Name => $Value) {
	if($Name == "X-Auth-User-Id"):
		$User["ID"] = $Value;
	elseif($Name == "X-Auth-Session-Key"):
		$User["Session"] = $Value;
	elseif($Name == "X-Powder-Version"):
		$User["Version"] = $Value;
}
$Settings["Connection"] = StartDatabase();
LogEvent("searched ".$Settings["Query"], $Settings["ID"], $Settings["Connection"]);
$Settings["Query"] = mysql_real_escape_string($Settings["Query"]);
$QueryData = mysql_query("SELECT saves.* FROM saves,tags WHERE saves.id = tags.id AND saves.name,tags.name LIKE '%".$Settings["Query"]."%' ORDER BY saves.votes;", $Settings["Connection"]);
for($i = 0; ($Row = mysql_fetch_array($QueryData)) == true || $i<$Settings["Count"]; $i++) {
	echo $Row["saves.id"]." 1 ".$Row["saves.votes"]." ".$Row["upvotes"]." ".$Row["downvotes"]." ".$Row["author"]." ".$Row["name"]."\r\n";
}
CloseDatabase($Settings["Connection"]);
?>
