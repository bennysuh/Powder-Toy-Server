<?php
require_once("Global.php");
require_once("Settings.php");
global $Database;
$con = StartDatabase();
$Queries=explode(file_get_contents("dump.sql"), ";");
array_pop($Queries);
$good=True;
foreach($Queries as $Query)
{
    $Result=mysql_query($Query,$con);
    if($result)
        echo "";
    else
        {
        echo mysql_error()."<br>";
        $good=false;
        }
    
}
if($good)
    echo "sucessfull undump";
else
{
    echo "whoops! something went wrong.";
}
CloseDatabase($con);
?>
