<?php
require "../../../php/ConnectToDB.php";
session_start();
// echo $_SESSION['TeacherNum'];
$url = $_POST['url'];
$content = " WHERE CreatedBy='" . $_SESSION['TeacherNum'] . "'";
$url = explode("/", $url);
$userType = $url[count($url)-2];
$table = $url[count($url)-1]; 

if($_POST['content'] != ""){
	$handler = explode("=", $_POST['content']);
	$content .= " AND " . $handler[0] . " LIKE '" . $handler[1] . "%'";
}

if(strpos($url[count($url)-1], "#") !== false){
	$table = explode("#", $table)[0];
}
if(strpos($table, "summary") === false){
	$table = "summary_" . $table;
}
$table = str_replace("teareg", "teacherregistration", $table);
$table = str_replace("stureg", "studentregistration", $table);
$summary_table = strtolower(str_replace(".php", "", $table));
$columns = "";
try{
	// $preparedStatement = "SELECT * FROM " . $summary_table . $content;
	// echo $preparedStatement;
	//COMMENTED
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
	$preparedStatement = "SELECT * FROM " . $summary_table . $content;
	// }
	$stmt = $db->prepare($preparedStatement);
	$stmt->execute();
	$row = $stmt->fetchAll();

	echo json_encode($row);
	// echo $preparedStatement;
}
catch(Exception $e){
	echo $preparedStatement;
} 
?>