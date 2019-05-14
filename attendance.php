<?php
	session_start();
	require_once('dbconfig/config.php');

	if(!isset($_SESSION['teacher']) && empty($_SESSION['teacher'])) {
		header("Location: index.php");
	}
	if(!isset($_GET['enrollId']) && empty($_GET['enrollId'])){
		header("Location: teacher.php");
	}
	
	$year = date("Y");
	$month = date("m");
	$date = date("d");
	
	
	if(isset($_GET['enrollId'])){
		$enrollId = $_GET['enrollId'];
		
		$row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM enroll WHERE e_id = '$enrollId'"),MYSQLI_ASSOC);
		
		$subject = $row['sub_name'];
		$class = $row['class'];
		$section = $row['section'];
		$group = $row['d_group'];
		$batch = $row['batchnumber'];
		
	}
	if(isset($_POST['attendancesubmit'])){
		
		$count = 0;
		
		$query = "SELECT * FROM `students` WHERE `s_class` = '$class' AND `s_group` = '$group' AND `s_section` = '$section' AND `s_batch` = '$batch'";
		$query_run = mysqli_query($con,$query);
		
		if($query_run){
			if(mysqli_num_rows($query_run)>0){
				while($row = $query_run->fetch_assoc()){
					
					$selected = $row['s_id'];
					
					if(isset($_POST['attendance'][$count]) && $_POST['attendance'][$count] == $selected){
						$count++;
						$query = "INSERT INTO `attendance` (`id`, `s_id`, `e_id`, `status`, `date`, `month`, `year`) VALUES (NULL, '$selected', '$enrollId', '1', '$date', '$month', '$year')";
					}
					else{
						$query = "INSERT INTO `attendance` (`id`, `s_id`, `e_id`, `status`, `date`, `month`, `year`) VALUES (NULL, '$selected', '$enrollId', '0', '$date', '$month', '$year')";
					}
					mysqli_query($con,$query);
					
				}
			}
		}
		header("Location: teacher.php");
	}
?>
<!DOCTYPE html>
<html>
<head>


    <title> </title>
    <link rel="stylesheet" href="css/font-awesome.min.css" >
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/style.css">
<style>

</style>

</head>

<body>

<div class="container-fluid">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
			  <li class="navbar-brand" style="list-style:none">School Web</li>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="teacher.php">Home</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="teacher.php"><?php echo $_SESSION['teacher']; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <span style = "font-size:18px"> Logout<span> </a></li>
			</ul>
		</div>
	</nav>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="taken-cls">
				<table style="width:100%;margin-top:20px;">
						<tr>	
							<th>Subject</th>
							<th>Class</th>
							<th>Section</th>
							<th>Group</th>
						</tr>
						<tr>
						<?php 
						echo "<td>".$subject."</td>
							  <td>".$class."</td>
							  <td>".$section."</td>
							  <td>".$group."</td>"
						?>
						</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="attendance-sheet">
				<h3>Attendance Sheet</h3>
				<form action="attendance.php?enrollId=<?php echo $enrollId;?>" method="POST">
					<table style="width:100%">
						<tr>	
							<th colspan = "3" style="padding:10px;font-size:18px">Date: <?php echo $year.".".$month.".".$date; ?></th>

						</tr>
						<tr>	
							<th>Student Id</th>
							<th>Student name</th>
							<th>Prestnt / Absent </th>

						</tr>
						
						<?php

							$query = "SELECT * FROM `students` WHERE `s_class` = '$class' AND `s_group` = '$group' AND `s_section` = '$section' AND `s_batch` = '$batch'";
							$query_run = mysqli_query($con,$query);
							if($query_run){
								if(mysqli_num_rows($query_run)>0){
									while($row = $query_run->fetch_assoc()){
										echo "<tr>
												<td>".$row['s_id']."</td>
												<td>".$row['s_name']."</td>
												<td> <input type='checkbox' name='attendance[]' value='".$row['s_id']."'></td>
											  </tr>";
									}
								}
							}
							
						?>
					</table>
					<button type="submit" name="attendancesubmit">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
	
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>