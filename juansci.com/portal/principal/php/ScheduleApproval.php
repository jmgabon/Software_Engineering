<?php
require "../../../php/ConnectToDB.php";
$cnum = $_POST['cnum'];
$approval = $_POST['approval'];

// echo $cnum. "_" . $approval;

try{
	$preparedStatement = "SELECT SectionNum, CreatedBy FROM requests_schedule WHERE ControlNum = ".$cnum."";
	$stmt = $db->prepare($preparedStatement);
	$stmt->execute();
	// $preparedStatement = 
	$row = $stmt->fetch();
	// var_dump($row);
	$SectionNum = $row["SectionNum"];
	$Creator = $row["CreatedBy"];

	// $preparedStatement = "SELECT SubjectID FROM temp_subject WHERE CreatedBy = ".$Creator." AND SectionNum = ".$SectionNum."";
	$preparedStatement = "SELECT SubjectID FROM temp_subject WHERE SectionNum = ".$SectionNum."";
	$stmt = $db->prepare($preparedStatement);
	$stmt->execute();

	// $row = $stmt->fetchAll();
	while ($row = $stmt->fetch()) {
		// echo($SubjectID);
		// // $id[$index] = $row['Return_ID'];
		// // $index++;
		echo "Subject:" . $row['SubjectID'];

		$preparedStatement = "INSERT INTO main_subject(SubjectID, TeacherNum, SectionNum, SubjectCode, DateCreated) SELECT SubjectID, TeacherNum, SectionNum, SubjectCode, CURRENT_TIMESTAMP FROM temp_subject WHERE SubjectID = ?";
		$stmt0 = $db->prepare($preparedStatement);
		$stmt0->bindValue(1, $row['SubjectID']);
		$stmt0->execute();

		$preparedStatement = "SELECT SchedID FROM temp_sched WHERE SubjectID = '".$row['SubjectID']."'";
		$stmt1 = $db->prepare($preparedStatement);
		$stmt1->execute();

		while ($row1 = $stmt1->fetch()) {
			echo "Sched:" . $row1['SchedID'];
			$preparedStatement = "INSERT INTO main_sched(SchedID, SubjectID, SubjectDay, SubjectTime, DateCreated) SELECT SchedID, SubjectID, SubjectDay, SubjectTime, CURRENT_TIMESTAMP FROM temp_sched WHERE SchedID = ?";
			$stmt2 = $db->prepare($preparedStatement);
			$stmt2->bindValue(1, $row1['SchedID']);
			$stmt2->execute();
		}			
		// echo $preparedStatement;
	}
	// echo(json_encode($row));


}
catch(Exception $e){
	echo($e);
}
?>