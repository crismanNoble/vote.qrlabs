<?php
//connect to database
include_once 'connections.php';

//Grab things
$thing = $_GET["thing1"];

//determine number of votes for the things.
$result = mysql_query("SELECT * FROM `votes` WHERE `thing` = '$thing1'") or die(mysql_error());

$count = mysql_numrows($result);

print $count;

?>