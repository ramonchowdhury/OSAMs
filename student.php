<?php 
	session_start();
	require_once('dbconfig/config.php');
	
	if(!isset($_SESSION['student']) && empty($_SESSION['student'])) {
		header("Location: index.php");
	}
	$s_id = $_SESSION['student'];
?>
<!DOCTYPE html>
<html>
<head>


    <title> </title>
    <link rel="stylesheet" href="css/font-awesome.min.css" >
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container-fluid">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
			  <li class="navbar-brand" style="list-style:none">School Web</li>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="student.php">Home</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="student.php"><?php echo $s_id; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <span style = "font-size:18px"> Logout<span> </a></li>
			</ul>
		</div>
	</nav>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="studentinfo">
				<h3>Student Information</h3>
				<ul class="list-group">
				<?php 
					
					$query = "SELECT * FROM students WHERE s_id = '$s_id'";	
					$query_run = mysqli_query($con,$query);
					if ($query_run) {
						$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
						
						$class = $row['s_class'];
						$section = $row['s_section'];
						$group  = $row['s_group'];
						$batch = $row['s_batch'];
						
						echo "<li class='list-group-item'>Name: <span>".$row['s_name']."</span></li>";
						echo "<li class='list-group-item'>ID: <span>".$s_id."</span></li>";
						echo "<li class='list-group-item'>Class: <span>".$class."</span></li>";
						echo "<li class='list-group-item'>Section: <span>".$section."</span></li>";
						echo "<li class='list-group-item'>Group: <span>".$group."</span></li>";
					}
				?>					
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="student-enroll">
				<h3>Enroll Subject and Result</h3>
				<table style="width:100%">
						<tr>	
							<th>Subject</th>
							<th>Attendance</th>
							<th  colspan="2">1st Term</th>
							<th  colspan="2">2nd Term</th>
							<th colspan="2">3rd Term</th>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>Mark</td>
							<td>Grade</td>
							<td>Mark</td>
							<td>Grade</td>
							<td>Mark</td>
							<td>Grade</td>
						</tr>

					<?php
						$query = "SELECT * FROM enroll WHERE class = '$class' AND section = '$section' AND d_group = '$group' AND batchnumber = '$batch'";
						$query_run = mysqli_query($con,$query);
						if ($query_run) {
							if(mysqli_num_rows($query_run)>0){
								while($row = $query_run->fetch_assoc()){
									echo "<tr>";
									echo "<td>".$row['sub_name']."</td>";
									echo "<td><a href='indivudiual-attendance.php?subject=".$row['e_id']."'>View</a></td>";

									$enrollId = $row['e_id'];
									for($i = 1;$i < 4;$i++){

										$query_run2 = mysqli_query($con,"SELECT * FROM result WHERE enroll_id = '$enrollId' AND student_id = '$s_id' AND term = '$i'");
										if($query_run2){

											if(mysqli_num_rows($query_run2)>0){

												$row2 = mysqli_fetch_array($query_run2,MYSQLI_ASSOC);

												echo "<td>".$row2['mark']."</td>";
												echo "<td>".$row2['grade']."</td>";
											}
											else{
												echo "<td> </td>";
												echo "<td> </td>";
											}
										}
									} 
									echo "</tr>";
								}
							}
						}
					?>
				</table>
			</div>
		</div>
	</div>
</div>

	
	
	
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>