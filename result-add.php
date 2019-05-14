<?php
	session_start();
	require_once('dbconfig/config.php');

	if(!isset($_SESSION['teacher']) && empty($_SESSION['teacher'])) {
		header("Location: index.php");
	}
	if(!isset($_SESSION['publishedresult']) && empty($_SESSION['publishedresult'])){
		header("Location: teacher.php");
	}
	
	$term = $_SESSION['publishedresult'][0];
	$enrollId = $_SESSION['publishedresult'][1];

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

	if(isset($_POST['submitresult'])){
		
		$query = "SELECT * FROM `students` WHERE `s_class` = '$class' AND `s_group` = '$group' AND `s_section` = '$section' AND `s_batch` = '$batch'";
		$query_run = mysqli_query($con,$query);
		
		if($query_run){

			while($row = $query_run->fetch_assoc()){
				
				$id = $row['id'];
				$studentId = $row['s_id'];
				
				if(isset($_POST['result'][$id])){
					
					$result = $_POST['result'][$id];
					
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
				}
				else{
					$result = 0;
					$grade = "F";
				}
				
				$query = "INSERT INTO `result` (`id`, `enroll_id`, `student_id`, `term`, `mark`, `grade`) VALUES (NULL, '$enrollId', '$studentId', '$term', '$result', '$grade')";
				
				mysqli_query($con,$query);
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
			<div class="result" style="margin-top:50px">
				<form action="result-add.php" method="POST">
					<table style="width:100%">
					  <tr>	
							<th  colspan="34" style="padding:10px"><?php echo $term; if($term==1){echo "st";}elseif($term=="2"){ echo "nd";}else{ echo "rd";}?> Term</th>
					  </tr>
					  <tr>	
							<th>Student ID</th>
							<th>Student Name</th>
							<th>Mark</th>
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
											<td> <input type='text' name='result[".$row['id']."]' value=''></td>
										  </tr>";
								}
							}
						}
						
					?>
					</table>
					<button type="submit" name="submitresult">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>