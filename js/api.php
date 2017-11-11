<?php

function connect_db() {
    $database = "geekster_db";
    $connect = mysql_connect('localhost', 'root', 'bitnami');
    if (!$connect) {
        echo 'mur';
        die(mysql_error());
    }
    else
    {
        echo 'Successful Connection!! ';
    }
    $db_connect = mysql_select_db($database, $connect);
    if (!$db_connect) {
        echo 'Error';
        die(mysql_error());
    }
}

function getUser() {
    global $current_user;
    return $current_user->id;
}
?>
