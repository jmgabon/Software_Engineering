<?php
//REVISIONS WILL BE MADE
require "../../../php/ConnectToDB.php";
$columns = "";
$toBind = "";
$colVal = array();
$j = 0; 
$url = $_POST['url'];
$url = explode("/", $url);
$userType = $url[count($url)-2];
$table = $url[count($url)-1]; 

if(strpos($url[count($url)-1], "#") !== false){
	$table = explode("#", $table)[0];
}
$temp_table = strtolower("temp_".str_replace(".php", "", $table));
$main_table = str_replace("creation", "", $temp_table);
$main_table = str_replace("registration", "", $main_table);
// $request_table = strtolower("request_".str_replace(".php", "", $table));
// $table = strtolower("main_".str_replace(".php", "", $table));

$content = json_decode($_POST['content'], true);
$preparedStatement = "";

// echo count($content[0]);
$primary_key = array_keys($content)[0];
$primary_key_value = array_values($content)[0];

// echo $primary_key;
// echo $primary_key_value;
foreach($content as $key => $value){  //Loops for every key-value of $content

	if($value === ""){
		$value = NULL;
	}
	elseif($value === "false") {
		$value = false;
	}
	elseif($value === "true"){
		$value = true;
	}
	// if($key !== "User"){
	$columns .= $key . ",";
	$toBind .= "?,";	
	$colVal[$j] = $value;
	$j++;

	if($key === "Action_"){
		$Action_Val = $value;
	}
	// }
}
try{
	// echo $temp_table;
	$preparedStatement = "SELECT " . $primary_key . " FROM " . $temp_table . " WHERE ";
	$preparedStatement .= $primary_key . " = '" . $primary_key_value . "' AND Action_ = '";
	$preparedStatement .= $Action_Val . "'"; 
	$stmt = $db->prepare($preparedStatement);
	$stmt->execute();
	$row = $stmt->fetchAll();

	if(count($row) == 0 || $primary_key_value == NULL){
		$toBind = substr($toBind, 0, strlen($toBind)- 1);
		$columns = substr($columns, 0, strlen($columns)- 1);
		$preparedStatement = "INSERT INTO " . $temp_table . "(" . $columns . ") VALUES(" . $toBind . ")";
		
		$stmt = $db->prepare($preparedStatement);
		for($i = 1; $i < $j+1; $i++){
			$stmt->bindValue($i, $colVal[$i-1]);
		}
		$stmt->execute();
		
		$stmt->closeCursor();
		echo "Successful";
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
}
?>