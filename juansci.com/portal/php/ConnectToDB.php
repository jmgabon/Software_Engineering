<?php

// $dsn = 'mysql:dbname=juanscic_MIS;host=juansci.com';//
// $username = 'juanscic_rtucpe';
// $password = 'Ju@nsci2020';
$dsn = 'mysql:dbname=MIS;host=localhost;port=3306';//
$username = 'root';
$password = '';
try { //UNBUFFERED
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // also allows an extra parameter of configuration
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //BUFFERED
} 
catch(PDOException $e) {
    // die('Could not connect to the database:<br/>' . $e);
    echo('Could not connect to the database:<br/>' . $e);
}
?>
