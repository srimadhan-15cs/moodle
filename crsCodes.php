<?php
require 'connect.php';

$query = "SELECT DISTINCT course_code FROM course_master";
$result = mysqli_query($conn, $query);
$crsCodes = array();

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    array_push($crsCodes, $row["course_code"]);
  }
}

$jsonData = json_encode($crsCodes);
echo $jsonData;

mysqli_close($conn);
