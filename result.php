<?php
	session_start();
	require_once('dbconfig/config.php');

	if(!isset($_SESSION['teacher']) && empty($_SESSION['teacher'])) {
		header("Location: index.php");
	}
	if(!isset($_SESSION['viewresult']) && empty($_SESSION['viewresult'])){
		header("Location: teacher.php");
	}
	
	$message = "";
	
	$term = $_SESSION['viewresult'][0];
	$enrollId = $_SESSION['viewresult'][1];

	$query = "SELECT * FROM enroll WHERE e_id = '$enrollId'";	
	$query_run = mysqli_query($con,$query);
	
	if ($query_run) {
		$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
			
		$subject = $row['sub_name'];	
		$class = $row['class'];
		$section = $row['section'];
		$group = $row['d_group'];
		$batch = $row['batchnumber'];

	}
	if(isset($_POST['updateresult'])){
		$resultid = $_POST['resultId'];
		$result = $_POST['result'];

		if($result < 33){
			$grade = "F";
		}
		elseif($result > 32 && $result < 40){
			$grade = "D";
		}
		elseif($result > 39 && $result < 50){
			$grade = "C";
		}
		elseif($result > 49 && $result < 60){
			$grade = "B";
		}
		elseif($result > 59 && $result < 70){
			$grade = "A-";
		}
		elseif($result > 69 && $result < 80){
			$grade = "A";
		}
		else{
			$grade = "A+";
		}
		
		$query = "UPDATE `result` SET `mark` = '$result', `grade` = '$grade'  WHERE `result`.`id` = '$resultid'";
		$query_run = mysqli_query($con,$query);
		if($query_run){
			$message = "Update Sucessfully";
		}
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
			<?php echo " <p class='p15s'>$message</p> "; $message = ""; ?>
		</div>
	</div>
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
							 <td>".$group."</td>";
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
			<div class="resultview" style="margin-top:50px">
				<table style="width:100%">
				  <tr>	
						<th  colspan="34" style="padding:8px"><?php echo $term; if($term==1){echo "st";}elseif($term=="2"){ echo "nd";}else{ echo "rd";}?> Term</th>
				  </tr>
				  <tr>	
						<th>Student ID</th>
						<th>Student Name</th>
						<th>Mark</th>
						<th>Grade</th>
				  </tr>					
				<?php

					$query = "SELECT * FROM `result` WHERE `enroll_id` = '$enrollId' AND `term` = '$term'";
					$query_run = mysqli_query($con,$query);
					if($query_run){
						if(mysqli_num_rows($query_run)>0){
							while($row = $query_run->fetch_assoc()){
								
								$studentId = $row['student_id'];
								
								$query_run2 = mysqli_query($con,"SELECT * FROM students WHERE s_id = '$studentId'");
								$row2 = mysqli_fetch_array($query_run2,MYSQLI_ASSOC);
								echo "<tr>
										<td>".$studentId."</td>
										<td>".$row2['s_name']."</td>
										<td class='pnt' id = '".$row['id']."' data-toggle='modal' data-target='#update' onclick='fnc(this.id)'>".$row['mark']."</td>
										<td>".$row['grade']."</td>
									  </tr>";
							}
						}
					}
				?>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body" style="border:none">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<form action="result.php" method="POST" style="border:none">
					<input type="hidden" name="resultId" value = "" id = "studentId"/>
					<label  class="col-form-label">Update Mark</label>
					<input type="text" name="result" class="form-control" style="margin-bottom:20px">
					<button type="submit" name="updateresult" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
function fnc(id) {
   document.getElementById("studentId").value = id;
}
</script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>