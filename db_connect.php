<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";
// Create connection
$connect = new mysqli($servername, $username, $password, $database);
@session_start();
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

   
   