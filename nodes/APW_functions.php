<?php

function APW_Close_DB($connection)
{
    include "Configuration.php";
    if(isset($connection))
    {
        mysql_close($connection);
    }
}

function APW_Run_SQL_Statement($inSQL)
{
    //Take in the SQL statement and execute it against the database.  DOES NOT return anything because this function is oriented around non-SELECT statements.
    $db_result = mysql_query($inSQL) or die(mysql_error() . "Bad Sql = $inSQL");
}
[12/8/12 3:34:30 PM] Michael Ogren: 
function APW_DB_Prepare_String($inString)
{
    //Take in a string and double up the single quote characters so it enters the database properly
    $freshString = stripslashes($inString);
    $newString = str_replace("'", "''", $freshString);
    $string2 = str_replace("~FLD~", "", $newString);
    $string3 = str_replace("~DAT~", "", $string2);
    $string4 = str_replace("~REC~", "", $string3);
    $string5 = str_replace("~^~", "", $string4);
    return $string5; 
}
?>