<?PHP
//check user credentials
/*X-Auth-User-Id: 1327
  X-Auth-Session-Key: <snip>*/
require_once("Global.php");
$headers=getallheaders();
$safe_userid=mysql_real_escape($headers["X-Auth-User-Id"])
$safe_session=mysql_real_escape($headers["X-Auth-Session-key"])
$Connection = StartDatabase();
$Result=mysql_query("SELECT * FROM `sessions` WHERE ")
CloseDatabase($Connection);
?>
