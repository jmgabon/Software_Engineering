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

$uniqueID = uniqid();
try{
	//<<<<<<<<<<<<<INSERT requests_schedule
	// $preparedStatement = "INSERT INTO requests_schedule(SectionNum,CreatedBy,Action_,Status_) VALUES (?,?,?,?);";
	$preparedStatement = "INSERT INTO requests_schedule(ControlNum, SectionNum,CreatedBy,Action_,Status_) VALUES (?,?,?,?,?);";

	$stmt = $db->prepare($preparedStatement);
	$stmt->bindValue(1, $uniqueID); //Control Number
	$stmt->bindValue(2, $sectionNum); //Section Number
	$stmt->bindValue(3, $userID); //Author
	$stmt->bindValue(4, 'CREATE'); //INSERT CHANGE TO CREATE
	$stmt->bindValue(5, "PENDING"); //Status

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
	// echo "SUBJECT ID " . count($unique_SubjectCode);
	for($i = 0; $i < count($uniqueIndex); $i++){
		$subjectID = $SubjectCode[$uniqueIndex[$i]] . "-" .$sectionNum;
		$subjectID = preg_replace('/\s+/', '', $subjectID);
		// $preparedStatement = "INSERT INTO temp_subject(SubjectID, TeacherNum, SectionNum, SubjectCode, CreatedBy, Action_,Status_) VALUES (?,?,?,?,?,?,?)";
		// $preparedStatement = "INSERT INTO temp_subject(SubjectID, TeacherNum, SectionNum, SubjectCode) VALUES (?,?,?,?)"; //MARCH7
		$preparedStatement = "INSERT INTO temp_subject(ControlNum,RequestNum,SubjectID, TeacherNum, SectionNum, SubjectCode) VALUES (?,?,?,?,?,?)";
		$stmt = $db->prepare($preparedStatement);
		$stmt->bindValue(1, preg_replace('/\s+/', '', $uniqueID.$SubjectCode[$uniqueIndex[$i]])); //Control Number
		$stmt->bindValue(2, $uniqueID); //Request Number (PK of Control Number of Request)
		$stmt->bindValue(3, $subjectID); //
		$stmt->bindValue(4, $TeacherNum[$uniqueIndex[$i]]);
		$stmt->bindValue(5, $sectionNum);
		$stmt->bindValue(6, $SubjectCode[$uniqueIndex[$i]]);
		// $stmt->bindValue(5, $userID);
		// $stmt->bindValue(6, "INSERT");
		// $stmt->bindValue(7, "PENDING");
		$stmt->execute();
	}

	// $preparedStatement = "INSERT INTO temp_sched(SubjectID, SubjectDay, SubjectTime, CreatedBy, Action_, Status_) VALUES(?,?,?,?,?,?);";
	// $preparedStatement = "INSERT INTO temp_sched(SubjectID, SubjectDay, SubjectTime) VALUES(?,?,?);"; MARCH 7
	for($i = 0; $i < count($SubjectCode); $i++){
		// $subjectID = $SubjectCode[$i] . "-" .$sectionNum ."-". $userID;
		// $subjectID = preg_replace('/\s+/', '', $subjectID);

		$preparedStatement = "INSERT INTO temp_sched(SubjectNum, SubjectDay, SubjectTime) VALUES(?,?,?);";
		$stmt = $db->prepare($preparedStatement);
		// $stmt->bindValue(1, $subjectID."-".$i); //ID
		$stmt->bindValue(1, preg_replace('/\s+/', '', $uniqueID.$SubjectCode[$i]));
		$stmt->bindValue(2, $SubjectDay[$i]);
		$stmt->bindValue(3, $SubjectTime[$i]);
		// $stmt->bindValue(4, $userID);
		// $stmt->bindValue(5, "INSERT");
		// $stmt->bindValue(6, "PENDING");
		$stmt->execute();
	}
	// echo("Sched " . count($SubjectCode));
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