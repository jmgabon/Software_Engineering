<?php
	session_start();
	include 'ConnectToDB.php';
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
			if($row[3] == 1){
				if($row[2] == 'student'){
					$_SESSION['id'] = $row[0];
				}
				else{
					$_SESSION['id'] = explode("-", $row[0])[0];
				}
				$_SESSION['access'] = $row[2];
				echo $row[2];
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