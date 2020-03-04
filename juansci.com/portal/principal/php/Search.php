<?php
require "../../../php/ConnectToDB.php";
session_start();
// echo $_SESSION['TeacherNum'];
$url = $_POST['url'];
$content = $_POST['content'];
$url = explode("/", $url);
$userType = $url[count($url)-2];
$table = $url[count($url)-1]; 
$columns = $_POST['content2'];
if($content != ""){
	$content = explode("=", $content);
	$content = " WHERE " . $content[0] . " LIKE '" . $content[1] . "%'";
}
if(strpos($url[count($url)-1], "#") !== false){
	$table = explode("#", $table)[0];
}

// if(strpos($table, "summary") === false){
// 	$table = "summary_" . $table;
// }
// $main_table = str_replace("masterlist", "main", $table);
$table = str_replace("requests_teacher", "summary_teacherregistration", $table);
$table = str_replace("regrequests_student", "summary_studentregistration", $table);
$table = str_replace("requests_room", "summary_roomcreation", $table);
$table = str_replace("requests_subjectcode", "summary_subjectcodecreation", $table);
$table = str_replace("requests_section", "summary_sectioncreation", $table);
$table = str_replace("masterlist_student", "main_student", $table);
// $table = str_replace("masterlist_section", "main_section", $table);
$table = str_replace("masterlist_room", "main_room", $table);
$table = str_replace("masterlist_subjectcode", "main_subjectcode", $table);
$table = str_replace("requests_schedule", "summary_schedulerequests", $table);
// $table = str_replace("stureg", "studentregistration", $table);
// $summary_table = strtolower(str_replace(".php", "", $table));
$table = strtolower(str_replace(".php", "", $table));
// $columns = "";
try{
	// $preparedStatement = "SELECT * FROM " . $summary_table . $content;
	// echo $preparedStatement;
	// if($_SESSION["AccessType"] !== "principal"){
	// 	$preparedStatement = "DESCRIBE " . $summary_table;
	// 	$stmt = $db->prepare($preparedStatement);
	// 	$stmt->execute();
	// 	$row = $stmt->fetchAll();
	// 	for ($i=0; $i < count($row); $i++) { 
	// 		$columns .= $row[$i][0] . ",";
	// 	}
	// 	$columns = substr($columns, 0, strlen($columns)- 1);
	// 	$columns = str_replace("CreatedBy,", "", $columns);
	// 	$columns = str_replace("RequestedBy,", "", $columns);
	// 	$preparedStatement = "SELECT " . $columns . " FROM " . $summary_table . $content;
	// }
	// else{
	if($columns == ""){
		$preparedStatement = "SELECT * FROM " . $table . $content;
	}
	else{
		$columns = substr($columns, 0, -1);
		$preparedStatement = "SELECT ". $columns . " FROM " . $table . $content;
	}
	// }
	$stmt = $db->prepare($preparedStatement);
	$stmt->execute();
	$row = $stmt->fetchAll();

	echo json_encode($row);
	// echo $preparedStatement;
}
catch(Exception $e){
	echo $e;
} 
?>