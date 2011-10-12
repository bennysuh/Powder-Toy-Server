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
Search($Query, $Start, $Count, $Connection);
CloseDatabase($Connection);
?>
