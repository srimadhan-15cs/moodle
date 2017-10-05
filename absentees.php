<?php
require 'connect.php';

$temp = explode('/', $_POST["date"]);
$date = $temp[2].'-'.$temp[0].'-'.$temp[1];
$user_id = $_SESSION["user_id"];
$semester = $_POST["semester"];
$regulation = $_POST["regulation"];
$course_code = $_POST["course_code"];

$query = "SELECT stud_fname, stud_lname, stud_initials, rollno, regno
FROM admission_master AS am
WHERE am.rollno = 
  (SELECT DISTINCT rollno
   FROM class_stud_mapping AS csm
   WHERE csm.acad_id, csm.pgm_id, csm.cls_id, csm.semester
   NOT IN
    (SELECT DISTINCT acad_id, pgm_id, cls_id, semester
     FROM academic_attendance AS aa
     WHERE aa.date = $date
     AND aa.fid = $user_id
     AND aa.semester = $semester
     AND aa.crs_id =
      (SELECT DISTINCT crs_id
       FROM course_master AS cm
       WHERE cm.regulation = $regulation
       AND cm.semester = $semester
       AND cm.course_code = $course_code
      )
    )
  )";

$result = mysqli_query($conn, $query);
$rollnos = array();

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    array_push($rollnos, $row);
  }
}

$jsonData =  json_encode($rollnos);
echo $jsonData;

mysqli_close($conn);
