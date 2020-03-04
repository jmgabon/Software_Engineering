<?php
	session_start();
	include '../../php/ConnectToDB.php';
	$username = $_POST['username'];
	$password = $_POST['pass'];
	$state = $_POST['state'];
	if($state == 'login'){
		$stmt = $db->prepare("SELECT * FROM student_access WHERE LRNNum = ? AND Pass=ENCODE(?, 'secret')");
		// TeacherNum, Username, Password, AccessType, Access
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $password);

		$stmt->execute();
		$row = $stmt->fetch();
		$stmt->closeCursor();	

		if($row != null){
			if($row[2] == 1){
				// if($row[2] == 'student'){
				$_SESSION['LRNNum'] = $row[0];
				// }
				// echo $row[2];
			}
			else{
				echo "BLOCKED";
			}
		}
		else{
			echo "failed";
		}
	}
	else{
		$stmt = $db->prepare("UPDATE student_access SET pass = ENCODE(?, 'secret') WHERE LRNNum = ?");
		$stmt->bindValue(1, $password);
		$stmt->bindValue(2, $username);
		$stmt->execute();
		$stmt->closeCursor();
	}
	
?>