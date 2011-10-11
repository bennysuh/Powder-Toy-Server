<?php
require_once("Global.php");
require_once("Settings.php");
global $Database;
$con = StartDatabase();
$Query=file_get_contents("dump.sql");
$Result=mysql_query($Query,$con);
echo gettype($Result)."<br>";
if($Result)
    echo "sucessfull undump";
else
{
    echo "whoops! something went wrong.<br>mysql gave \"".mysql_error($con)."\"";
}
CloseDatabase($con);
?>
