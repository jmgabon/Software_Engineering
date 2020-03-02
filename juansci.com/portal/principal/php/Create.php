<?php
//REVISIONS WILL BE MADE
require "../../../php/ConnectToDB.php";
// $columns = "";
// $toBind = "";
// $colVal = array();
// $j = 0;
session_start();

$remarks = $_POST['remarks'];
$decision = $_POST['decision'];
$controlNum = $_POST['value'];
$columns = "";
$url = $_POST['url'];
$url = explode("/", $url);
$userType = $url[count($url)-2];
$table = $url[count($url)-1]; 

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
}
if($table == "requests_subjectcode"){
	$main_table = "main_subjectcode";
	$temp_table = "temp_subjectcodecreation";
}
if($remarks == ""){
	$remarks = NULL;
}
// echo($temp_table);
try{
		$preparedStatement = "UPDATE " .$temp_table. " SET  Status_ = ?, ApprovedBy = ?, ApprovalDate = CURRENT_TIMESTAMP, Remarks = ? WHERE ControlNum = ?";
		$stmt = $db->prepare($preparedStatement);
		// $stmt->bindValue(1, $temp_table);
		$stmt->bindValue(1, $decision);
		$stmt->bindValue(2, $_SESSION['TeacherNum']);
		$stmt->bindValue(3, $remarks);
		$stmt->bindValue(4, $controlNum);

		$stmt->execute();
		// $stmt->closeCursor();
	if($decision == "REJECTED"){
		echo("Request No. ". $controlNum . " is REJECTED");
	}
	else if($decision == "APPROVED"){
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
			if(!($row[$i][0] == "DateCreated" || $row[$i][0] == "TeacherNum")){
				$columns .= $row[$i][0] . ",";
			}
		}
		$columns = substr($columns, 0, -1);
		$preparedStatement = "INSERT INTO ".$main_table."(".$columns.") SELECT " . $columns . " FROM ".$temp_table." WHERE ControlNum = ?";
		$stmt = $db->prepare($preparedStatement);
		$stmt->bindValue(1, $controlNum);
		$stmt->execute();
		$stmt->closeCursor();
		echo("Request No. ". $controlNum . " is APPROVED");
		// echo($preparedStatement);
	}

}
catch(Exception $e){
	echo $preparedStatement;
}

/*try{
	// echo $temp_table;
	$preparedStatement = "SELECT " . $primary_key . " FROM " . $temp_table . " WHERE ";
	$preparedStatement .= $primary_key . " = '" . $primary_key_value . "' AND Action_ = '";
	$preparedStatement .= $Action_Val . "'"; 
	$stmt = $db->prepare($preparedStatement);
	$stmt->execute();
	$row = $stmt->fetchAll();

	if(count($row) == 0){
		$toBind = substr($toBind, 0, strlen($toBind)- 1);
		$columns = substr($columns, 0, strlen($columns)- 1);
		$preparedStatement = "INSERT INTO " . $temp_table . "(" . $columns . ") VALUES(" . $toBind . ")";
		
		$stmt = $db->prepare($preparedStatement);
		for($i = 1; $i < $j+1; $i++){
			$stmt->bindValue($i, $colVal[$i-1]);
		}
		$stmt->execute();
		echo "Successful";
		$stmt->closeCursor();
		// echo $preparedStatement;
	}
	else{
		echo "Duplicate Request";
	}
// 	MAKE TIMESTAMP WORKS ON CREATE
// ALTER TABLE `mytable`
// CHANGE `mydatefield` `mydatefield`
// TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
}
catch(Exception $e){
	echo $e;
}*/
?>