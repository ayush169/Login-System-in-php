<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "users20";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("failed to connect to the database " .mysqli_connect_error());
}
?>