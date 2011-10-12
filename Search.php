<?php
require_once("Global.php");

if(isset($_GET["Query"])){
	$Query = $_GET["Query"];
}
if(isset($_GET["ShowVotes"])){
	$ShowVotes = $_GET["ShowVotes"];
}
$Start = 0;
if(isset($_GET["Start"])){
	$Start = $_GET["Start"];
}
if(!isset($_GET["Count"])){
	return 0;
}
else{
	$Count = $_GET["Count"];
}
$Headers = getallheaders();
$User["ID"] = $Headers["X-Auth-User-Id"];
if($UserId == NULL) $User["ID"] = 0;
$Session = $Headers["X-Auth-Session-Key"];
if($Session == NULL) $Session = 0;
$Version = $Headers["X-Powder-Version"];
if($Version == NULL) $Version = 0;
$Connection = StartDatabase();
$Query = mysql_real_escape_string($Query);
$QueryData = mysql_query("SELECT saves.* FROM saves,tags WHERE saves.id = tags.id AND saves.name,tags.name LIKE '%".$Query."%' ORDER BY saves.votes;", $Connection);
ob_start();
for($i = $Start; ($Row = mysql_fetch_array($QueryData)) == true || $i<$Count; $i++) {
	echo $Row["saves.id"]." 1 ".$Row["saves.votes"]." ".$Row["upvotes"]." ".$Row["downvotes"]." ".$Row["author"]." ".$Row["name"]."\r\n";
}
ob_end_flush();
CloseDatabase($Connection);
?>