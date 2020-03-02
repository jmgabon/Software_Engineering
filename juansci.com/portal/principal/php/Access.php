<?php
require "../../../php/ConnectToDB.php";
$key = $_POST['key'];
$value = $_POST['value'];
$userID = $_POST['user'];
$message = "";
try{
	if($key == "Type"){
		if($value == "coordinator"){
			$preparedStatement = "UPDATE access SET AccessType = '' WHERE TeacherNum = ?";
			$message = "Privileges are removed";
		}
		else{
			$preparedStatement = "UPDATE access SET AccessType = 'coordinator' WHERE TeacherNum = ?";
			$message = "Privileges are granted";
			// echo $message;
		}
	}	
	else if($key == "Access"){
		// echo "Access";
		if($value == 1){
			$preparedStatement = "UPDATE access SET Access = 0 WHERE TeacherNum = ?";
			$message = "Blocked";
		}
		else{
			$preparedStatement = "UPDATE access SET Access = 1 WHERE TeacherNum = ?";
			$message = "Unblocked";
		}	
	}
	$stmt = $db->prepare($preparedStatement);
	$stmt->bindValue(1, $userID);
	$stmt->execute();
	$stmt->closeCursor();
	echo($message);
	// echo $key;
}
catch(Exception $e){

}
?>