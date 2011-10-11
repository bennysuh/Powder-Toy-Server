<?PHP
require_once("misc.php");
$con=db_connect();
$headers=getallheaders();
$safe_passhash=mysql_real_escape_string($headers["X-Auth-Hash"]);
$safe_name=mysql_real_escape_string($headers["X-Auth-User"]);
//$safe_passhash="b3f15e8156c41b717074e384c92ec771";
//$safe_name="doxin";
$result=db_sql($con,"SELECT * FROM users WHERE passhash='$safe_passhash' AND name='$safe_name'");
if($result)
{
$safe_sesid=session_newid();
$safe_uid=$result["id"];
$safe_mode=$result["mode"];
$safe_expiredate=time()+(60*60*24);
db_sql($con,"INSERT INTO sessions (sessionid,userid,expiredate) VALUES $safe_sesid,$safe_uid,$safe_expiredate
            ON DUPLICATE KEY UPDATE id=$safe_uid");
print "OK $safe_uid $safe_sesid 0 $safe_mode";
}
else
{
print "Username or Password incorrect.";
}
db_close($con);
?>
