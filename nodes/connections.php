<?php

function APW_Prepare_DB()
	{
	    //Opens the database and gets it ready for use
	    //Returns a mySQL database object
	    
	    $conn = mysql_connect("localhost","angelaj2_qrvoter","katPoop") or die(mysql_error()); 
	    mysql_select_db("angelaj2_qrvotes") or die(mysql_error());
	    
	    return $conn;
	}

?>