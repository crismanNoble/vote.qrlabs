<?php
//connect to database
include_once 'connections.php';

//Grab things
$thing = $_GET["thing"];

//determine number of votes for the things.
$result = mysql_query("SELECT * FROM `votes` WHERE `thing` = '$thing'") or die(mysql_error());

$count = mysql_numrows($result);

print $count;

?>