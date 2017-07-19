<?php
include 'readConfig.php';
$host = trim($config['host']);
$uname = trim($config['username']);
$passwd = trim($config['password']);
$dbname = trim($config['db']);
$mysqli=new mysqli($host,$uname,$passwd,$dbname);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$charset = array('latin1', 'utf8');

