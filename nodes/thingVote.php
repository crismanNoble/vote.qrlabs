<?php
//connect to database
//include_once 'APW_functions.php';
include_once 'connections.php';
//$connection = APW_Prepare_DB();

//Grab thing
$thing = $_GET["thing"];
//grab thing direction

//grab info about the user?
$user = $_SERVER['HTTP_USER_AGENT'];
$user = $user.$_SERVER['REMOTE_ADDR'];

//add vote into votes table
$sql = "INSERT INTO `angelaj2_qrvotes`.`votes` (`thing`, `user`) VALUES ('$thing', '$user');";
//$sql = APW_DB_Prepare_String($sql);
$query = mysql_query($sql) or die(mysql_error());

$result = mysql_query("SELECT * FROM `votes` WHERE `thing` = '$thing'") or die(mysql_error());
$count = mysql_numrows($result);

//APW_Close_DB($connection);

//change count in things table for given thing id

//return thank you message
print $thing;
print ' has ';
print $count;
print ' total votes share this link to rack up the votes.';

?>