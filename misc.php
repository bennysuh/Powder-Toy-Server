<?PHP 
require_once("settings.php");
$db_error="";
function db_connect()
{
    $con=mysql_connect(DB_HOST,DB_USER,DB_PASS);
    mysql_select_db("tpt_server",$con);
    return $con;
}

function db_close($con)
{
    mysql_close($con);
}

function db_sql($con,$sql)
{
    $result=mysql_query($sql,$con);
    if($result)
    {
        return mysql_fetch_array($result);
    }
    else
    {
    //$db_error=$db_error."<br>".mysql_error($con);
    return false;
    }
}

function session_newid()
{
    return substr(uniqid("").uniqid("").uniqid(""),0,31);
}
?>
