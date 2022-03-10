<?php

$host  ='localhost';
$username = 'root';
$password ='';
$database ='onlinebabybeurs';

$db = mysqli_connect($host, $username, $password, $database);

if (!$db){
    die("Connectie failed:" .mysqli_connect_error());
}




?>