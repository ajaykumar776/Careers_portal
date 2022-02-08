<?php
$hostname="localhost";
$username="root";
$password="";
$database="redgates";
$con = mysqli_connect($hostname,$username,$password,$database);	
    if(!$con)
    {
        die("database is not connected");
    }

?>