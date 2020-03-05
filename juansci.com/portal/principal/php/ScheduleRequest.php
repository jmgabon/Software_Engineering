<?php
require "../../../php/ConnectToDB.php";
session_start();
$cnum = $_POST['cnum'];
// $_SESSION['TeacherNum']
try{
	$preparedStatement = "SELECT SectionNum, SectionName, GradeLevel, Adviser, SubjectCode, SubjectDay, SubjectTime, CreatedBy, Creator FROM summary_schedule WHERE ControlNum ='". $cnum ."'";
	$stmt = $db->prepare($preparedStatement);
	// echo $preparedStatement;
	$stmt->execute();
	$row = $stmt->fetchAll();
	echo(json_encode($row));
	// echo("AA");
}
catch(Exception $e){
	echo($preparedStatement);
}
?>