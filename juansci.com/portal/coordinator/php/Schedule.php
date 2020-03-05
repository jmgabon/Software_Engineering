<?php
require "../../../php/ConnectToDB.php";
$content = json_decode($_POST['content']);
$userID = $_POST['userID'];

$sectionNum = $_POST['section'];
foreach ($content as $value){ 
    $SubjectCode[] = $value->SubjectCode;
	$SubjectDay[] = $value->Day;
	$SubjectTime[] = $value->Time;
	$TeacherNum[] = $value->Teacher;
}

try{
	//<<<<<<<<<<<<<INSERT requests_schedule
	$preparedStatement = "INSERT INTO requests_schedule(SectionNum,CreatedBy,Action_,Status_) VALUES (?,?,?,?);";

	$stmt = $db->prepare($preparedStatement);
	$stmt->bindValue(1, $sectionNum);
	$stmt->bindValue(2, $userID);
	$stmt->bindValue(3, 'INSERT');
	$stmt->bindValue(4, "PENDING");

	$stmt->execute();
	//>>>>>>>>>>>>>>>>>

	//<<<<<<<<<<<< INSERT Subject ID
	$unique_Teacher = array();
	$unique_SubjectCode = array_unique($SubjectCode);
	$uniqueIndex = array_keys($unique_SubjectCode);
	

	for($i = 0; $i < count($uniqueIndex); $i++){
		array_push($unique_Teacher, $TeacherNum[$uniqueIndex[$i]]);
	}

	// var_dump($unique_Teacher);
	//<<<<<<<<<<CREATE UNIQUE Subject ID
	// echo(array_keys($unique_SubjectCode));
	for($i = 0; $i < count($uniqueIndex); $i++){
		$subjectID = $SubjectCode[$i] . "-" .$sectionNum ."-". $userID;
		$subjectID = preg_replace('/\s+/', '', $subjectID);
		$preparedStatement = "INSERT INTO temp_subject(SubjectID, TeacherNum, SectionNum, SubjectCode, CreatedBy, Action_,Status_) VALUES (?,?,?,?,?,?,?)";
		$stmt = $db->prepare($preparedStatement);
		$stmt->bindValue(1, $subjectID);
		$stmt->bindValue(2, $TeacherNum[$uniqueIndex[$i]]);
		$stmt->bindValue(3, $sectionNum);
		$stmt->bindValue(4, $SubjectCode[$uniqueIndex[$i]]);
		$stmt->bindValue(5, $userID);
		$stmt->bindValue(6, "INSERT");
		$stmt->bindValue(7, "PENDING");
		$stmt->execute();
	}

	$preparedStatement = "INSERT INTO temp_sched(SubjectID, SubjectDay, SubjectTime, CreatedBy, Action_, Status_) VALUES(?,?,?,?,?,?);";
	for($i = 0; $i < count($SubjectCode); $i++){
		$subjectID = $SubjectCode[$i] . "-" .$sectionNum ."-". $userID;
		$subjectID = preg_replace('/\s+/', '', $subjectID);
		$stmt = $db->prepare($preparedStatement);
		// $stmt->bindValue(1, $subjectID."-".$i); //ID
		$stmt->bindValue(1, $subjectID);
		
		$stmt->bindValue(2, $SubjectDay[$i]);
		$stmt->bindValue(3, $SubjectTime[$i]);
		$stmt->bindValue(4, $userID);
		$stmt->bindValue(5, "INSERT");
		$stmt->bindValue(6, "PENDING");
		$stmt->execute();
	}
	//>>>>>>>>>>>>>>>>>>>
	echo "Successful";
}
catch(Exception $e){
	echo $e;
}
// print_r($array[0]);

// echo($userID);
// echo($sectionNum);


	// echo $Time[0];
?>