<?php
require "../../../php/ConnectToDB.php";
session_start();
// echo $_SESSION['TeacherNum'];
$url = $_POST['url'];

$url = explode("/", $url);
$userType = $url[count($url)-2];
$table = $url[count($url)-1]; 
$subtable = "";

if(strpos($url[count($url)-1], "#") !== false){
	$subtable = explode("#", $table)[1];
	$table = explode("#", $table)[0];
}
if(strpos($table, "summary") === false){
	$table = "summary_" . $table;
}
$content = "";
$table = str_replace("teareg", "teacherregistration", $table);
$table = str_replace("stureg", "studentregistration", $table);

if(strpos($table, "SectionCreation") !== false){
	if($subtable == "Room"){
		$table = str_replace("SectionCreation", "availableclassroom", $table);
	}
	else if($subtable == "Teacher"){
		$table = str_replace("SectionCreation", "availableadviser", $table);	
	}
	else{
		
	}
	// echo($subtable);
	// $content = " WHERE ";
}
else if(strpos($table, "ScheduleCreation") !== false){
	if($subtable == "Section"){
		// $table = str_replace("ScheduleCreation", "sectioncreation", $table);
		$table = "masterlist_section_request"; //PRINCIPAL
		
		// $content = " WHERE (Status_ IS NULL OR Status_ = 'REJECTED') AND (CreatedBy IS NULL OR CreatedBy != ".$_SESSION['TeacherNum'].")" ;//MARCH 28
	}
	// (strpos($table, "SectionCreation") !== false)
	else if(strpos($subtable, "SubjectCode") !== false){
		if(strpos($subtable, "7") !== false){
			$grade = 7;
		}
		elseif(strpos($subtable, "8") !== false){
			$grade = 8;
		}
		elseif(strpos($subtable, "9") !== false){
			$grade = 9;
		}
		elseif(strpos($subtable, "10") !== false){
			$grade = 10;
		}
		else{

		}
		$table = "main_subjectcode"; //PRINCIPAL
		$content = " WHERE GradeLevel=" .$grade;
	}	
	elseif($subtable == "Teacher"){
		$table = "masterlist_teacher";
	}
	elseif($subtable == "Request"){
		$table = "requests_schedule";
		$content = " WHERE CreatedBy='" . $_SESSION['TeacherNum'] . "'";
	}
	else{
		
	}
}
else{
	// $content = " WHERE CreatedBy='" . $_SESSION['TeacherNum'] . "' AND ";
	$content = " WHERE CreatedBy='" . $_SESSION['TeacherNum'] . "'";
}	

if($_POST['content'] != ""){
	$handler = explode("=", $_POST['content']);
	// $content .= $handler[0] . " LIKE '" . $handler[1] . "%'";
	if($content != ""){
		$content = $content . " AND ";
	}
	else{
		$content = " WHERE ";
	}
	$content .= $handler[0] . " LIKE '" . $handler[1] . "%'";
}
// $table = str_replace("stureg", "studentregistration", $table);
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
	// echo $table;
	// echo strpos($table, "SectionCreation");
} 
?>