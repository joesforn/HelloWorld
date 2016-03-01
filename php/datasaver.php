<?
	/* DataSaver.php - used to send data to the database, also info back to JS via AJAX */
	include_once("db_control.php");
	$db = new DB_Control();
	
	//Obtain all data!
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$address1 = $_POST["address1"];
	$address2 = $_POST["address2"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	$country = $_POST["country"];
	
	//check if this user isn't already in the database!
	$return = $db->query("SELECT * FROM `User` WHERE (`fname`='$fname' AND `lname`='$lname' AND `address1`='$address1' AND 
				`city`='$city' AND `state`='$state' AND `zip`='$zip' AND `country`='$country');",true);
	if(count($return[0]) > 0)
		die(json_encode(array("error"=>"This user already exists in the database!")));
		
	//Save the data up!
	$db->insert("User",array("fname"=>$fname,"lname"=>$lname,"address1"=>$address1,"address2"=>$address2,"city"=>$city,
				"state"=>$state,"zip"=>$zip,"country"=>$country));
	die(json_encode(array("success"=>"success")));
?>