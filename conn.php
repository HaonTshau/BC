<?php 
try {
	$dbh = new PDO('mysql:host=localhost;dbname=bookclass', 'root', '');
	foreach ($dbh->query('SELECT * FROM course') as $row){
		print_r($row);
	}
	$dbh = null;
} catch (PDOException $e){
	print "Error!:" . $e->getMessage(). "<br/>";
	die();
}
