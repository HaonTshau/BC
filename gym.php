<?php
include 'config.php';
try{
	$bc = new PDO('mysql:host=localhost;dbname=bc', USER, PASSWORD);
	$bc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$bc->exec("SET CHARACTER SET utf8");
}catch(PDOException$e){
	print"Error!:".$e->getMessage()."<br/>";
	die();
}
//////////////////////////////////////////
//global var
$classSelected = isset($_GET['classSelected']) ? $_GET['classSelected'] : '';
$timeSelected = isset($_GET['timeSelected']) ? $_GET['timeSelected'] : '';
$name = isset($_GET['name_']) ? $_GET['name_'] : '';
$number = isset($_GET['number_']) ? $_GET['number_'] : '';
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
/////////////////////////////////////////
//any way , get classes
$Class_ = '<option value=""></option>';    //default ,  select nothing
//$sql_getClass = "select *  from `course` where `left` > 0 group by `name` having `left`>0 order by `name`";
$sql_getClass = "select * from `course` where `left` > 0 order by `name` asc";
$result = $bc->query($sql_getClass);
$tempArray = array();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
	if(!in_array($row['name'],$tempArray,true)){
		array_push($tempArray,$row['name']);
		if(in_array($classSelected,$tempArray,true)){
			$Class_ = $Class_.'<option value="'.$row['name'].'" selected="selected">'.$row['name'].'</option>';
		}
		else{
			$Class_ = $Class_.'<option value="'.$row['name'].'">'.$row['name'].'</option>';
		}
	}
}
unset($tempArray);
///////////////////////////////////////////////
//get time list,according to class
$sql_getTime = "select * from `course` where `name`='$classSelected' and `left`>0";
$result = $bc->query($sql_getTime);
$tempArray = array();
$Time_ = '<option value=""></option>';
while($row = $result->fetch(PDO::FETCH_ASSOC)){
		array_push($tempArray,$row['time']);
		if(in_array($timeSelected,$tempArray,true)){
			$Time_ = $Time_.'<option value="'.$row['time'].'" selected="selected">'.$row['time'].'</option>';
		}
		else{
			$Time_ = $Time_.'<option value="'.$row['time'].'">'.$row['time'].'</option>';
		}
}
unset($tempArray);
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Class</title>
<meta charset="utf-8" />
<script>
function getTimeList(){
var url = '?classSelected='+document.bookclass.classSelected.value+'&name_='+document.bookclass.name_.value+'&number_='+document.bookclass.number_.value;
window.location.href = url;
}
</script>
</head>
<body>
<div style="width:51%;height:320px;margin:0 auto;padding:0;">
	<img style="margin-left: 25px;" src="class.png" />
</div>
<div style="width:911px;height:320px;margin:0 auto;padding:0;margin-top:30px;">
	<form name="bookclass" action="bookclass.php" method="post">
		<table border=1 cellpadding="" style="border-color:black;width:100%;">
			<tr>
				<td>Class</td>
				<td>
					<select id="classSelected" name="classSelected" style="width:300px;" onchange="getTimeList()">
						<?php echo $Class_?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Times</td>
				<td>
					<select id="timeSelected" name="timeSelected" style="width:300px;">
						<?php echo $Time_?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Name</td>
				<td>
					<input id="name" style="width:300px;" type="text" name="name_" value="<?php echo $name?>" />
				</td>
			</tr>
			<tr>
				<td>Phone or mobile number</td>
				<td>
					<input id="number" style="width:300px;" type="text" name="number_" value="<?php echo $number?>" /><br />
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button id="submit_" type="submit" style="width:100px;height:35px;" value="submit">Submit</button>
					<?php echo $msg?>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
