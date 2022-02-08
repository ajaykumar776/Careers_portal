<?php
$hostname="localhost";
$username="tapemyca_admin";
$password="Redgates@01";
$database="tapemyca_careers";
$con = mysqli_connect($hostname,$username,$password,$database);	
    if(!$con)
    {
        die("database is not connected");
    }

?>