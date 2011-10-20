<?PHP
if(!isset($_GET['plugin']))
    return -1;
$plugin=$_GET['plugin'];
if(!isset($_GET['filename']))
	return -1;
$filename=$_GET['filename'];
$i=0;
$i+=substr_count($plugin,"/");
$i+=substr_count($filename,"\\");
if($i)
    die("I'm afraid that that isn't allowed. Not only is it against the TOS, it's against the law. Your IP has been logged and police have been contacted.");
$i=0;
$i+=substr_count($filename,"/");
$i+=substr_count($filename,"\\");
if($i)
    die("I'm afraid that that isn't allowed. Not only is it against the TOS, it's against the law. Your IP has been logged and police have been contacted.");
$scriptdir= substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], './'));
$incfile="$scriptdir/plugins/$plugin/$filename";
if(is_readable($incfile))
    require_once($incfile);
else
    header("HTTP/1.0 404 Not Found");
?>