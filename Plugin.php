<?PHP
$plugin=$_GET['plugin'];
$filename=$_GET['filename'];
$i=0;
$i+=substr_count($plugin,"/");
$i+=substr_count($filename,"\\");
if($i)
    die("i'm afraid that that isn't allowed. not only is it against the TOS it's against the law. your ip is logged and a local police team dispatched to your location.");
$i=0;
$i+=substr_count($filename,"/");
$i+=substr_count($filename,"\\");
if($i)
    die("i'm afraid that that isn't allowed. not only is it against the TOS it's against the law. your ip is logged and a local police team dispatched to your location.");
$scriptdir= substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], '/'));
$incfile="$scriptdir/plugins/$plugin/$filename";
if(is_readable($incfile))
    require_once($incfile);
else
    header("HTTP/1.0 404 Not Found");
?>
