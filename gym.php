<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<script>
function _submit(){
		var coursename = document.gym.course.value;
		var username = document.gym.username.value;
		var userphone = document.gym.userphone.value;
		var url = 'gym.php?course='+coursename+'&username='+username+'&userphone='+userphone;
		location.replace(url);
}

</script>
<style>
.table-bordered th,  
  .table-bordered td {  
    border: 1px solid #000 !important;  
  }  

body,form,div,label,h3{margin:0;padding:0;}
label{width:160px;}
#container{width:60%;height:auto;background-color:#00FF7F;
margin:0 auto;
}
h3{color:red;font-size:28px;text-align:center;}
</style>
</head>
<body>

<div class="bootstrap-table"><div class="fixed-table-toolbar"><div class="bs-bars pull-left"></div></div><div class="fixed-table-container" style="padding-bottom: 0px;"><div class="fixed-table-header" style="display: none;"><table></table></div><div class="fixed-table-body"><div class="fixed-table-loading" style="top: 83px; display: none;"></div><table id="tradeList" data-classes="table table-hover table-bordered" class="table table-hover table-bordered table-striped">

<thead><tr><th style="text-align: center; " colspan="6" tabindex="0"><div class="th-inner ">timetables</div><div class="fht-cell"></div></th></tr><tr><th style="" data-field="time" tabindex="0"><div class="th-inner "> </div><div class="fht-cell"></div></th><th style="text-align: center; " data-field="mon" tabindex="0"><div class="th-inner ">Monday</div><div class="fht-cell"></div></th><th style="text-align: center; " data-field="tue" tabindex="0"><div class="th-inner ">Tuesday</div><div class="fht-cell"></div></th><th style="text-align: center; " data-field="wed" tabindex="0"><div class="th-inner ">Wednesday</div><div class="fht-cell"></div></th><th style="text-align: center; " data-field="thu" tabindex="0"><div class="th-inner ">Thursday</div><div class="fht-cell"></div></th><th style="text-align: center; " data-field="fri" tabindex="0"><div class="th-inner ">Friday</div><div class="fht-cell"></div></th></tr></thead><tbody><tr data-index="0"><td style="">9:00</td><td style="text-align: center; ">Boot Camp(2)</td><td style="text-align: center; ">Boot Camp(2)</td><td style="text-align: center; ">Boot Camp(2)</td><td style="text-align: center; "> </td><td style="text-align: center; "> </td></tr><tr data-index="1"><td style="">10:00</td><td style="text-align: center; "> </td><td style="text-align: center; "> </td><td style="text-align: center; "> </td><td style="text-align: center; ">Boxercise(4)</td><td style="text-align: center; ">Boxercise(4)</td></tr><tr data-index="2"><td style="">11:00</td><td style="text-align: center; ">Pilates(3)</td><td style="text-align: center; "> </td><td style="text-align: center; ">Pilates(3)</td><td style="text-align: center; "> </td><td style="text-align: center; "> </td></tr><tr data-index="3"><td style="">13:00</td><td style="text-align: center; "> </td><td style="text-align: center; ">Yoga(2)</td><td style="text-align: center; ">Yoga(2)</td><td style="text-align: center; "> </td><td style="text-align: center; "> </td></tr><tr data-index="4"><td style="">14:00</td><td style="text-align: center; "> </td><td style="text-align: center; "> </td><td style="text-align: center; "> </td><td style="text-align: center; "> </td><td style="text-align: center; ">Zumba(2)</td></tr></tbody></table></div><div class="fixed-table-footer" style="display: none;"><table><tbody><tr></tr></tbody></table></div><div class="fixed-table-pagination" style="display: none;"></div></div></div>


<?php
include 'config.php';
try{
$dbh = new PDO('mysql:host=localhost;dbname=bookclass', MYSQLUSER, MYSQLPASS);
 $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 $dbh->exec("SET CHARACTER SET utf8");
 $dbh->exec("SET GLOBAL sql_mode = ''");
 }catch(PDOException$e){
 print"Error!:".$e->getMessage()."<br/>";
 die();
}
$coursenameList='';
$coursetimeList='';
$coursename = !empty($_GET['course']) ? $_GET['course'] : '';
$coursetime = !empty($_GET['time']) ? $_GET['time'] : '';
$username = !empty($_GET['username']) ? $_GET['username'] : '';
$userphone = !empty($_GET['userphone']) ? $_GET['userphone'] : '';
$globalflag = false;
if(empty($coursename)){  // no course has been selected
	$sql = "select id,coursename from `course` where `remain` > 0 group by coursename order by `coursename` asc";
	$sth = $dbh->query($sql);
	if($sth->rowCount()){    //class that has places
		$coursenameList = '<option value ="0"></option>';  //coursename list (select option),default value 0
		while($row = $sth->fetch(PDO::FETCH_ASSOC)){
			$coursenameList = $coursenameList.'<option value="'.$row['coursename'].'">'.$row['coursename'].'</option>';
		}
	}
	// none class left
	else{
		$coursenameList = '<option value ="0"></option>';
		$globalflag = true;   //true : none class left
	}
}
else {     //class is selected  or   ?course=classname   
	if(empty($coursetime)){     //someone is selected   
		$sql = "select id,coursename from `course` where `remain` > 0 group by coursename order by `coursename` asc";
		$sth = $dbh->query($sql);
		if($sth->rowCount()){    //class that has places
			//$coursenameList = '<option value ="0" selected="selected"></option>';  //coursename list (select option),default value 0
			$coursenameList = '<option value ="0"></option>';  //coursename list (select option),default value 0
			while($row = $sth->fetch(PDO::FETCH_ASSOC)){
				if($coursename === $row['coursename']){
					$coursenameList = $coursenameList.'<option value="'.$row['coursename'].'" selected="selected">'.$row['coursename'].'</option>';
				}
				else{
				$coursenameList = $coursenameList.'<option value="'.$row['coursename'].'">'.$row['coursename'].'</option>';
				}
			}
		}
	
	
	
	
	
	
	////////////////////////////////////////////
		$sql = "select id,coursename,coursetime,remain from `course` where `coursename` = '$coursename' and `remain` > 0 order by `coursename` asc";
		$sth = $dbh->query($sql);
		//$coursetimeList = '<option value ="0" selected="selected"></option>';  //coursetime list (select option),default value 0
		$coursetimeList = '<option value ="0"></option>';  //coursetime list (select option),default value 0
		//$cousetimelistarray = array();
		while($row = $sth->fetch(PDO::FETCH_ASSOC)){
				$coursetimeList = $coursetimeList.'<option value="'.$row['coursetime'].'">'.$row['coursetime'].'</option>';
				//echo $coursetimeList;
				//print_r($row);
				//array_push($cousetimelistarray,$row['coursetime']);
		}
		
		//////////////////////////////////////////////////////////

		//echo $coursetimeList;
		//print_r($cousetimelistarray);
		//echo json_encode($cousetimelistarray);
		//exit;
	}
	else{        //?course=classname    

	
	////////////////////
		
			$sql = "select id,coursename from `course` where `remain` > 0 group by coursename order by `coursename` asc";
		$sth = $dbh->query($sql);
		$flag = false;   
		if($sth->rowCount()){    //class that has places
			//$coursenameList = '<option value ="0" selected="selected"></option>';  //coursename list (select option),default value 0
			$coursenameList = '<option value ="0"></option>';  //coursename list (select option),default value 0
			while($row = $sth->fetch(PDO::FETCH_ASSOC)){
				if($coursename === $row['coursename']){
					$coursenameList = $coursenameList.'<option value="'.$row['coursename'].'" selected="selected">'.$row['coursename'].'</option>';
				}
				else{
				$coursenameList = $coursenameList.'<option value="'.$row['coursename'].'">'.$row['coursename'].'</option>';
				}
			}
		}
	///////////////////
	
			$sql = "select id,coursename,coursetime,remain from `course` where `coursename` = '$coursename' and `remain` > 0 order by `coursename` asc";
		$sth = $dbh->query($sql);
		//$coursetimeList = '<option value ="0" selected="selected"></option>';  //coursetime list (select option),default value 0
		$coursetimeList = '<option value ="0"></option>';  //coursetime list (select option),default value 0
		//$cousetimelistarray = array();
		while($row = $sth->fetch(PDO::FETCH_ASSOC)){
			if($coursetime === $row['coursetime']){
				$coursetimeList = $coursetimeList.'<option value="'.$row['coursetime'].'" selected="selected">'.$row['coursetime'].'</option>';
			}
			else{
				$coursetimeList = $coursetimeList.'<option value="'.$row['coursetime'].'">'.$row['coursetime'].'</option>';
			}
				
				//echo $coursetimeList;
				//print_r($row);
				//array_push($cousetimelistarray,$row['coursetime']);
		}
	
	
	
	}
}


?>
<?php
if($globalflag)
	echo '<h3>Sorry!None of the classes at any date and time has places left!</h3>'
?>



<div id="container">
<form name="gym" action="back.php" method="post">


<fieldset>
    <legend>book class</legend>
	<label for="course" class="dispear">Class</label>
		<select id="course" name="course" style="width:300px;" onchange="_submit()">
		<?php if(!empty($coursenameList)) echo $coursenameList?>
		</select>
		<br />
		<label for="time">Times</label>
		<select id="time" name="time" style="width:300px;">
		<?php if(!empty($coursetimeList)) echo $coursetimeList?>
		</select><br />
    <label for="username">Your name</label>
	<?php
		if(!$globalflag)
	     echo '<input id="username" style="width:300px;" type="text" placeholder="Your name" name="username" value="'.$username.'" /><br />';
	
	?>
	<label for="userphone" class="dispear">phone/mobile number</label>
	<?php
	if(!$globalflag)
	echo '<input id="userphone" style="width:300px;" type="text" placeholder="phone/mobile number" name="userphone" value="'.$userphone.'" /><br />';
	?>
	<input id="submit_" type="submit" style="width:100px;height:35px;" value="submit" />
	

</fieldset>


</form>
</div>

</body>
</html>

