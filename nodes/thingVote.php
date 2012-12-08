<?php
//connect to database
include_once 'APW_functions.php';
include_once 'connections.php';
$connection = APW_Prepare_DB();

//Grab thing
$thing = $_GET["thing"];
//grab thing direction

//grab info about the user?
$user = $_SERVER['HTTP_USER_AGENT'];

//add vote into votes table
$sql = "INSERT INTO `angelaj2_qrvotes`.`votes` (`thing`, `user`) VALUES ('$thing', '$user');";
$sql = APW_DB_Prepare_String($sql);

$query = mysql_query($sql) or die(mysql_error());

APW_Close_DB($connection);

//change count in things table for given thing id

//return thank you message
print $thing;
print '<br/>';
print $user;
print '<br/>';
print $query;

?>