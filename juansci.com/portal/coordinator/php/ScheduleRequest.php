<?php
require "../../../php/ConnectToDB.php";
session_start();
$cnum = $_POST['cnum'];
// $_SESSION['TeacherNum']
try{
	$preparedStatement = "SELECT SectionNum, SectionName, GradeLevel, Adviser, SubjectCode, SubjectDay, SubjectTime, CreatedBy, Creator FROM summary_schedule WHERE CreatedBy='" . $_SESSION['TeacherNum']."' AND ControlNum ='". $cnum ."'";
	$stmt = $db->prepare($preparedStatement);

	$stmt->execute();
	$row = $stmt->fetchAll();
	echo(json_encode($row));
}
catch(Exception $e){
	echo($preparedStatement);
}
?>