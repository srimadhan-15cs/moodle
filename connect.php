<?php
$servername = "host";
$username = "username";
$password = "password";
$dbname = "dbname";

// Establish connection with MySql
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check db connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
