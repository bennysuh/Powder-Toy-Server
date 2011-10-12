<?PHP
require_once("Global.php");
$Connection = StartDatabase();
$Headers = getallheaders();
$Name = $Headers["X-Auth-User"];
$Hash = $Headers["X-Auth-Hash"];
$Version = $Headers["X-Powder-Version"];
Login($Name, $Hash, $Connection);
CloseDatabase($Connection);
?>