<?php

// define some helper functions
function getPostData($name){
	$data = $_POST[$name];
	$data = trim($data);
	$data = htmlspecialchars($data);
	//var_dump($data);
	return $data;
}

function refresh($class, $name, $time, $number, $msg){
	$url = 'gym.php' . '?classSelected=' . $class . '&name_=' .  $name . '&timeSelected=' . $time .'&number_=' . $number . '&msg='. $msg;
	header("refresh: 0, url=$url");
	exit;
}

function validateName($name, $class, $time, $number){
	if (0 == strlen($name)){
		refresh($class, $name, $time, $number, '<font color="red">Book Failed: PLEASE input your name</font>');
		return false;
	}
	$regex = '/^[a-zA-Z]+[\-\']{0,1}[a-zA-Z]+$/x';
	$matches = array();
	if (preg_match($regex, $name, $matches)){
		return true;
	}else{
		refresh($class, $name, $time, $number, '<font color="red"> Error: username is not a valid name</font>');
		return false;
	}
}

function validateNumber($number, $name, $class, $time){
	if (0 == strlen($number)){
		refresh($class, $name, $time, $number, '<font color="red">Book Failed: PLEASE input your phone number</font>');
		return false;
	}
	$regex = '/0[0-9]{8,9}/';
	$matches = array();
	if (preg_match($regex, $number, $matches)){
		return true;
	}else{
		refresh($class, $name, $time, $number, '<font color="red"> Error: number is not a valid mobile number</font>');
		return false;
	}
}

// Get POST DATA
$class = getPostData('classSelected');
$time = getPostData('timeSelected');
$name = getPostData('name_');
$number = getPostData('number_');

//var_dump($class);
//var_dump($time);
//var_dump($name);
//var_dump($number);
//exit;

if (0 == strlen($class) || 0 == strlen($time)){
	refresh($class, $name, $time, $number, '<font color="red">Book Failed: PLEASE select CLASS or TIME</font>');
}

//validate username and moblie number
validateName($name, $class, $time, $number);
validateNumber($number, $name, $class, $time);

//echo "SELECT * FROM course WHERE left > 0 AND name = '$class' AND time = '$time'";
//echo "SELECT * FROM course WHERE `left` > 0 AND name = '$class' AND time = '$time'";
//echo "UPDATE course SET `left` = `left` - 1 WHERE `left` > 0 AND name = '$class' AND time = '$time'";
//echo "INSERT INTO booklog (`courseid`, `username`, `mobile`) VALUES ($row->id, '$name', '$number')";
//exit;

//book class
include 'config.php';
try {
	$dbh = new PDO('mysql:host=localhost;dbname=bc', USER, PASSWORD);
	$query = $dbh->prepare("SELECT * FROM course WHERE `left` > 0 AND name = '$class' AND time = '$time'");
	$query->execute();

	$row = $query->fetch(PDO::FETCH_OBJ);
	if ($row){
		$update = $dbh->prepare("UPDATE course SET `left` = `left` - 1 WHERE `left` > 0 AND name = '$class' AND time = '$time'");
		$update->execute();
		unset($update);

		$insert = $dbh->prepare("INSERT INTO booklog (`courseid`, `username`, `mobile`) VALUES ($row->id, \"$name\", '$number')");
		$insert->execute();
		unset($insert);
		
		refresh($class, $name, $time, $number, '<font color=\"red\">Book Success');
	}else{
		refresh($class, $name, $time, $number, '<font color=\"red\">Book Failed: NO place left</font>');
	}
	unset($dbh);
	unset($query);
} catch (PDOException $e){
	echo "Error:" . $e->getMessage(). "<br/>";
	die();
}
