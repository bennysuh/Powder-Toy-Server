<?php
require_once("Global.php");
$Settings["Connection"] = StartDatabase();
$Query=file_get_contents("dump.sql");
$Result=mysql_query($Query);
if($Result)
    echo "sucessfull undump";
else
{
    echo "whoops! something went wrong.<br>".mysql_error();
}
?>
