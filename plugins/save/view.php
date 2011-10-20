<?PHP
require_once("../../Global.php");
$PerPage=6;

if (!(isset($_GET['page']))) 
    $pagenum = 1;
else
    $pagenum=intval($_GET['page']);

$Connection = StartDatabase();
$Result = mysql_query("SELECT count(*) FROM saves") or die(mysql_error()); 
if($Result)
    {
    $Rows = mysql_fetch_array($Result);//amount of results
    $ItemCount=$Rows["count(*)"];
    }
else
    header("HTTP/1.1 500 Internal Server Error");
$PageCount=ceil($ItemCount/$PerPage);
if($PageCount<1)
    $PageCount=1;
$Limit = 'LIMIT ' .($PageCount - 1) * $ItemCount .',' .$ItemCount; 
$Result=mysql_query("SELECT * FROM saves $max");
$Content="";
while($Row=mysql_fetch_array($Result))
{   
    $UpVotes=$Row["upvotes"];
    $DownVotes=$Row["downvotes"];
    $Score=$UpVotes+$DownVotes;
    $UpPerc=intval(($UpVotes/$Score*204)-3);
    $DownPerc=intval((204-$UpPerc)-3);
    $Content=$Content."<div class=savebox><img src='http://dummyimage.com/204x128'><div class=scorebarwrapper><div class=upbar style='width:$UpPerc px'></div><div class=downbar style='width:$DownPerc px'></div></div></div>";
}
require_once("template/main.php");
CloseDatabase($Connection);
?>
