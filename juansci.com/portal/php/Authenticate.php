<?php
	session_start();
	include '../../php/ConnectToDB.php';
	$username = $_POST['username'];
	$password = $_POST['pass'];
	$state = $_POST['state'];
	if($state == 'login'){
		$stmt = $db->prepare("SELECT * FROM access WHERE Username = ? AND Pass=ENCODE(?, 'secret')");
		// TeacherNum, Username, Password, AccessType, Access
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $password);

		$stmt->execute();
		$row = $stmt->fetch();
		$stmt->closeCursor();	

		if($row != null){
			if($row[4] == 1){
				$_SESSION['TeacherNum'] = $row[0];
				$_SESSION['AccessType'] = $row[3];
				// $_SESSION['access'] = $row[2];
				echo $row[3];
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
		$stmt = $db->prepare("UPDATE access SET pass = ENCODE(?, 'secret') WHERE username = ?");
		$stmt->bindValue(1, $password);
		$stmt->bindValue(2, $username);
		$stmt->execute();
		$stmt->closeCursor();
	}
	
?>