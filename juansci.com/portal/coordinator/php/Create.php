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
// $request_table = strtolower("request_".str_replace(".php", "", $table));
// $table = strtolower("main_".str_replace(".php", "", $table));

$content = json_decode($_POST['content'], true);
$preparedStatement = "";

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
	if($key !== "User"){
		$columns .= $key . ",";
		$toBind .= "?,";	
		$colVal[$j] = $value;
		$j++;
	}
}
try{
	// echo $temp_table;
	$toBind = substr($toBind, 0, strlen($toBind)- 1);
	$columns = substr($columns, 0, strlen($columns)- 1);
	$preparedStatement = "INSERT INTO " . $temp_table . "(" . $columns . ") VALUES(" . $toBind . ")";
	// echo $preparedStatement;
	$stmt = $db->prepare($preparedStatement);
	for($i = 1; $i < $j+1; $i++){
		$stmt->bindValue($i, $colVal[$i-1]);
		// echo $colVal[$i-1] . "<br/>";
	}
	$stmt->execute();
	echo "Successful";
	$stmt->closeCursor();
// 	MAKE TIMESTAMP WORKS ON CREATE
// ALTER TABLE `mytable`
// CHANGE `mydatefield` `mydatefield`
// TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
}
catch(Exception $e){
	echo $e;
}
?>