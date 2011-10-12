<?php
require_once("Global.php");
require_once("Settings.php");
global $Database;
global $Connnection;
$Connection = StartDatabase();
$Queries=explode(file_get_contents("dump.sql"), ";");
array_pop($Queries);
$Good=True;
foreach($Queries as $Query)
{
    $Result=mysql_query($Query,$Connection);
    if($Result)
        echo "";
    else
        {
            echo mysql_error()."<br>";
        	$Good=false;
        }
    
}

if($Good)
    echo "Successfully Loaded Database!";
else
{
    echo "Whoops! Something went wrong. Make sure you have the dump.sql file in this folder.";
}
CloseDatabase($Connection);
?>
