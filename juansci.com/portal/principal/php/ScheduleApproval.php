<?php
require "../../../php/ConnectToDB.php";
session_start();
$cnum = $_POST['cnum'];
$approval = $_POST['approval'];

// echo $cnum. "_" . $approval;
if($approval == 1){
	try{
		$preparedStatement = "SELECT SectionNum, CreatedBy FROM requests_schedule WHERE ControlNum = '".$cnum."'";
		$stmt = $db->prepare($preparedStatement);
		$stmt->execute();
		$row = $stmt->fetch();
		$SectionNum = $row["SectionNum"];
		$preparedStatement = "SELECT COUNT(SectionNum) AS CheckSection FROM main_subject WHERE SectionNum = ?";

		$stmt = $db->prepare($preparedStatement);
		$stmt->bindValue(1, $SectionNum);
		$stmt->execute();
		$row = $stmt->fetch();
		if ($row['CheckSection'] == 0){
			$preparedStatement = "UPDATE requests_schedule SET  Status_ = ?, ApprovedBy = ?, ApprovalDate = CURRENT_TIMESTAMP, Remarks = ? WHERE ControlNum = ?";
			$stmt = $db->prepare($preparedStatement);
			$stmt->bindValue(1, "APPROVED");
			$stmt->bindValue(2, $_SESSION['TeacherNum']);
			$stmt->bindValue(3, null);
			$stmt->bindValue(4, $cnum);
			$stmt->execute();
			
			$preparedStatement = "INSERT INTO main_subject(SubjectID, TeacherNum, SectionNum, SubjectCode, DateCreated) SELECT SubjectID, TeacherNum, SectionNum, SubjectCode, CURRENT_TIMESTAMP FROM temp_subject WHERE RequestNum = ?";
			$stmt = $db->prepare($preparedStatement);
			$stmt->bindValue(1, $cnum);
			$stmt->execute();

			$preparedStatement = "INSERT INTO main_sched(SchedID, SubjectID, SubjectDay, SubjectTime, DateCreated) SELECT SchedID, temp_subject.SubjectID, SubjectDay, SubjectTime, CURRENT_TIMESTAMP FROM temp_sched INNER JOIN temp_subject ON temp_subject.ControlNum = temp_sched.SubjectNum WHERE temp_subject.RequestNum = ?";
			$stmt = $db->prepare($preparedStatement);
			$stmt->bindValue(1, $cnum);
			$stmt->execute();

			echo "Approved";
		}
		else{
			echo "This section has a schedule already!";
		}
	}
	catch(Exception $e){
		echo($e);
	}
}
else if($approval == 0){
	$preparedStatement = "UPDATE requests_schedule SET  Status_ = ?, ApprovedBy = ?, ApprovalDate = CURRENT_TIMESTAMP, Remarks = ? WHERE ControlNum = ?";
	$stmt = $db->prepare($preparedStatement);
	$stmt->bindValue(1, "REJECTED");
	$stmt->bindValue(2, $_SESSION['TeacherNum']);
	$stmt->bindValue(3, null);
	$stmt->bindValue(4, $cnum);
	$stmt->execute();
	echo "Rejected";
}
?>