<?php
$connect = mysql_connect('localhost', 'root', 'bitnami');
if (!$connect) 
{
     //echo 'error!';
     die(mysql_error());
}
else
{
    //echo 'Successful Connection!';
}
$db_connect = mysql_select_db('geekster_db', $connect);
if (!$db_connect)
{
    //echo 'Error';
    die(mysql_error());
}
?>
