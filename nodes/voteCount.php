<?php
//connect to database
include_once 'connections.php';

//Grab things
$thing1 = $_GET["thing1"];
$thing2 = $_GET["thing2"];
//determine count of thing from the things table
$result1 = mysql_query("SELECT * FROM `votes` WHERE `thing` = $thing1");
$result2 = mysql_query("SELECT * FROM `votes` WHERE `thing` = $thing2");

$count1 = mysql_numrows($result1);
$count2 = mysql_numrows($result2);

print $thing1.":".$count1;
print "<br/>";
print $thing2.":".$count2;

//return count of thing

?>