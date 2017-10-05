<?php
require 'connect.php';

$query = "SELECT DISTINCT regulation FROM course_master";
$result = mysqli_query($conn, $query);
$regulations = array();

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    array_push($regulations, $row["regulation"]);
  }
}

$jsonData = json_encode($regulations);
echo $jsonData;

mysqli_close($conn);
