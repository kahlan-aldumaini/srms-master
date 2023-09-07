<?php
       $GLOBALSDB_HOST = "localhost";
	$GLOBALSDB_USER = "root";
	$GLOBALSDB_PASS = "root";
        $GLOBALSDB_NAME="srms";

	$conn = mysqli_connect($GLOBALSDB_HOST, $GLOBALSDB_USER, $GLOBALSDB_PASS);
	$db = mysqli_select_db($conn,$GLOBALSDB_NAME);
        try
{
$dbh = new PDO("mysql:host=".$GLOBALSDB_HOST.";dbname=".$GLOBALSDB_NAME,$GLOBALSDB_USER, $GLOBALSDB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
} 


?>