<?php
require "../../../php/ConnectToDB.php";
$subjDay = $_POST['subjDay'];
$subjTime = $_POST['subjTime'];
$content = "";
$handler = "";
if($_POST['content'] != ""){
	// if($content != ""){
	// 	$content = $content . " AND ";
	// }
	// else{
	// 	$content = " WHERE ";
	// }
	$handler = explode("=", $_POST['content']);
	$content .= $handler[0] . " LIKE '" . $handler[1] . "%'";
}
// else{
// }

try{
	$preparedStatement = "SELECT TeacherNum, LastName, ExtendedName, FirstName, MiddleName, Shift, Major FROM main_teacher
	WHERE TeacherNum NOT IN (SELECT summary_schedule.TeacherNum FROM summary_schedule WHERE summary_schedule.SubjectDay = ? AND summary_schedule.SubjectTime = ?) ".$content;
	// // }
	$stmt = $db->prepare($preparedStatement);

	$stmt->bindValue(1, $subjDay);
	$stmt->bindValue(2, $subjTime);
	$stmt->execute();
	$row = $stmt->fetchAll();

	echo json_encode($row);
	// echo($preparedStatement);
}
catch(Exception $e){
	echo $e;
}
?>