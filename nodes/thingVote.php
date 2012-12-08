<?php
//connect to database
include 'connections.php';

//Grab thing
$thing = $_GET["thing"];
//grab thing direction

//grab info about the user?
$user = $_SERVER['HTTP_USER_AGENT'];

//add vote into votes table
$sql = "INSERT INTO `angelaj2_qrvotes`.`votes` (`id`, `thing`, `time`, `user`) VALUES (NULL, ".$thing." , CURRENT_TIMESTAMP, ".$user.");";
mysql_query($sql);

//change count in things table for given thing id

//return thank you message
print $thing;
print '<br/>';
print $user;
?>