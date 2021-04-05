<?php

require "config/config.php";

// DB Connection.
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

$sql = "SELECT clothing_item.clothing_item_id as item_id, clothing_item.clothing_item_name AS name, retailer.retailer_website AS retail_site, clothing_type.clothing_type_id AS type_id, clothing_item.image_src AS image_src
FROM clothing_item
JOIN retailer
	ON clothing_item.retailer_id = retailer.retailer_id
JOIN clothing_type
	ON clothing_item.clothing_type_id = clothing_type.clothing_type_id
WHERE 1 = 1 AND ";


if($_GET["temp"] > 70) {
	$sql = $sql . "clothing_item.clothing_type_id = 4
		OR clothing_item.clothing_type_id = 5
		OR clothing_item.clothing_type_id = 6
		OR clothing_item.clothing_type_id = 8
		OR clothing_item.clothing_type_id = 10"; 
}

if($_GET["temp"] >= 62 && $_GET["temp"] <=70) {
	$sql = $sql . "clothing_item.clothing_type_id = 5
		OR clothing_item.clothing_type_id = 6
		OR clothing_item.clothing_type_id = 8
		OR clothing_item.clothing_type_id = 7
		OR clothing_item.clothing_type_id = 13
		OR clothing_item.clothing_type_id = 8
		OR clothing_item.clothing_type_id = 10"; 
}

if($_GET["temp"] < 62) {
	$sql = $sql . "clothing_item.clothing_type_id = 13
		OR clothing_item.clothing_type_id = 1
		OR clothing_item.clothing_type_id = 12
		OR clothing_item.clothing_type_id = 7
		OR clothing_item.clothing_type_id = 14
		OR clothing_item.clothing_type_id = 3
		OR clothing_item.clothing_type_id = 10"; 
}

if($_GET["temp"] < 56) {
	$sql = $sql . " OR clothing_item.clothing_type_id = 2
		OR clothing_item.clothing_type_id = 9
		OR clothing_item.clothing_type_id = 11"; 
}

$sql = $sql . ";";



$clothing_results = $mysqli->query($sql);
if( !$clothing_results) {
	echo $mysqli->error;
	exit();
} 

$results_array = [];

	while( $row = $clothing_results->fetch_assoc()) {
		array_push($results_array, $row);
	}

	// Convert the assoc array to json string
	echo json_encode($results_array);


	$mysqli->close();

?>
