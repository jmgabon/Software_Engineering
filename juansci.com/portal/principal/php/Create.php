<?php
//REVISIONS WILL BE MADE
require "../../../php/ConnectToDB.php";
// $columns = "";
// $toBind = "";
// $colVal = array();
// $j = 0;
session_start();
$executeQuery = 1;
$remarks = $_POST['remarks'];
$decision = $_POST['decision'];
$controlNum = $_POST['value'];
$columns = "";
$url = $_POST['url'];
$url = explode("/", $url);
$userType = $url[count($url)-2];
$table = $url[count($url)-1]; 
// $primary_key = "";
if(strpos($url[count($url)-1], "#") !== false){
	$table = explode("#", $table)[0];
}
$table = strtolower(str_replace(".php", "", $table));
//LINK 1
$main_table = "";
$temp_table = "";
if($table == "requests_teacher"){
	$main_table = "main_teacher";
	$temp_table = "temp_teacherregistration";
}
if($table == "regrequests_student"){
	$main_table = "main_student";
	$temp_table = "temp_studentregistration";
}
if($table == "requests_room"){
	$main_table = "main_room";
	$temp_table = "temp_roomcreation";
	// $primary_key = "RoomNum";
}
if($table == "requests_subjectcode"){
	$main_table = "main_subjectcode";
	$temp_table = "temp_subjectcodecreation";
}
if($table == "requests_section"){
	$main_table = "main_section";
	$temp_table = "temp_sectioncreation";
	$preparedStatement = "SELECT COUNT(main_section.SectionNum) AS CheckAdviser FROM `main_section` JOIN temp_sectioncreation ON temp_sectioncreation.Adviser = main_section.Adviser WHERE temp_sectioncreation.ControlNum = ?";
	$stmt = $db->prepare($preparedStatement);
	$stmt->bindValue(1, $controlNum);
	$stmt->execute();
	$row = $stmt->fetch();
	$CheckAdviser = $row['CheckAdviser'];

	$preparedStatement = "SELECT COUNT(main_section.RoomNum) AS CheckRoom FROM `main_section` JOIN temp_sectioncreation ON temp_sectioncreation.RoomNum = main_section.RoomNum WHERE temp_sectioncreation.ControlNum = ?";
	$stmt = $db->prepare($preparedStatement);
	$stmt->bindValue(1, $controlNum);
	$stmt->execute();
	$row = $stmt->fetch();
	$CheckRoom = $row['CheckRoom'];
	// echo $row['CheckAdviser'];
	if($CheckAdviser > 0){
		$executeQuery = 0;
		echo "Adviser is not available ";
	}
	if($CheckRoom > 0){
		$executeQuery = 0;
		echo "Room is not available ";
	}
	// var_dump($row);
	// echo("GAGO");
}
if($remarks == ""){
	$remarks = NULL;
}
try{
	// $preparedStatement = "SELECT ".$primary_key." FROM ".$temp_table." WHERE ControlNum = ?";
	// $stmt = $db->prepare($preparedStatement);
	// $stmt->bindValue(1, $controlNum);
	// $stmt->execute();

	// $row = $stmt->fetchAll();

	// $preparedStatement = "SELECT COUNT(".$primary_key.") AS CheckNum FROM ".$main_table." WHERE ".$primary_key."=?";
	// $stmt = $db->prepare($preparedStatement);
	// $stmt->bindValue(1, $row[$primary_key]);

	// $row = $stmt->fetchAll();
	
	//QUERY
	if($decision == "REJECTED"){
		$message = "Request No. ". $controlNum . " is REJECTED";
		UpdateRequest();
	}
	else{
		if($executeQuery == 1){
			$preparedStatement = "SELECT column_name
			FROM information_schema.columns
			WHERE table_schema = 'mis'
			AND table_name = ?;";
			// $preparedStatement = "DESCRIBE " . $main_table;
			$stmt = $db->prepare($preparedStatement);
			$stmt->bindValue(1, $main_table);
			$stmt->execute();
			$row = $stmt->fetchAll();
			for ($i=0; $i < count($row); $i++) { 
			# code...
				if(!($row[$i][0] == "DateCreated" || $row[$i][0] == "TeacherNum" || $row[$i][0] == "SectionNum")){
					$columns .= $row[$i][0] . ",";
				}
			}
			// $columns = substr($columns, 0, -1);
			$preparedStatement = "INSERT INTO ".$main_table."(".$columns."DateCreated) SELECT " . $columns . "ApprovalDate FROM ".$temp_table." WHERE ControlNum = ?";
			$stmt = $db->prepare($preparedStatement);
			$stmt->bindValue(1, $controlNum);
			$stmt->execute();
			$stmt->closeCursor();
			$message = "Request No. ". $controlNum . " is APPROVED";

			UpdateRequest();
		}
	}
}
catch(Exception $e){
	// echo($e);
	if(strpos($e, "'PRIMARY'") !== false){
		echo "Request No. ". $controlNum. " cannot be granted! Check for duplicates";
	}
	else{
		echo($e);
	}
	// echo $preparedStatement;
	// echo($message);
}

function UpdateRequest(){
	$preparedStatement = "UPDATE " .$GLOBALS['temp_table']. " SET  Status_ = ?, ApprovedBy = ?, ApprovalDate = CURRENT_TIMESTAMP, Remarks = ? WHERE ControlNum = ?";
	$stmt = $GLOBALS['db']->prepare($preparedStatement);
	$stmt->bindValue(1, $GLOBALS['decision']);
	$stmt->bindValue(2, $_SESSION['TeacherNum']);
	$stmt->bindValue(3, $GLOBALS['remarks']);
	$stmt->bindValue(4, $GLOBALS['controlNum']);

	$stmt->execute();
	// 
	echo $GLOBALS['message'];
}
?>