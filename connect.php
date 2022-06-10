<?php
date_default_timezone_set('Africa/Cairo');

$serverName = "DESKTOP-IG3FK75";  
$connectionInfo = array( "Database"=>"airlineresvervationsystem");  
$db = sqlsrv_connect( $serverName, $connectionInfo);  
  
if( !$db )  
{  
     echo "Connection could not be established"."<br>";  
     die( print_r( sqlsrv_errors()."<br>", true));  
}  
   

?>  
