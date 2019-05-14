<?php
	session_start();
	require_once('dbconfig/config.php');
	
	if(!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
		header("Location: admin.php");
	}	
	
	$message = "";
	$temp = "";
	$query = "";
	
	if(isset($_POST['updatestudent'])){
		
		$student_id = $_POST['student_id'];
		$name = $_POST['student_name'];
		$password = $_POST['student_password'];
		
		if(empty($_POST['student_name']) || empty($_POST['student_password'])){
			if(empty($_POST['student_name']) && empty($_POST['student_password'])){
				$message = "All The filed are empty";
			}
			elseif(!empty($_POST['student_name'])){
				$temp = "Name";
				$query = "UPDATE `students` SET `s_name` = '$name' WHERE `students`.`id` = '$student_id'";
			}
			elseif(!empty($_POST['student_password'])){
				$temp = "Password";
				$query = "UPDATE `students` SET `s_password` = '$password' WHERE `students`.`id` = '$student_id'";
			}
		}
		else{
			$temp = "Name and Password";
			$query = "UPDATE `students` SET `s_name` = '$name',`s_password` = '$password' WHERE `students`.`id` = '$student_id'";
		}
		
		if($query != ''){
			$query_run = mysqli_query($con,$query);
		
			if($query_run){
				
				$message = $temp." Changed Sucessfully";
			}	
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
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="teachers.php">Teachers</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li class ="active"><a href="teachers.php">Students</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="enroll.php">Enrollment</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="subjects.php">Subjects</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="notice.php">Notice</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <span style = "font-size:16px"> Logout<span> </a></li>
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
			<div class="studentlist-info">
				<table style="width:100%;margin-top:20px;">
						<tr>	
							<th>Batch</th>
							<th>Class</th>
							<th>Group</th>
							<th>Section</th>
						</tr>
						<tr>
							<?php
								if(isset($_SESSION['studentbatchinfo']) && !empty($_SESSION['studentbatchinfo'])) { 
									foreach($_SESSION['studentbatchinfo'] as $key=>$value){
										echo "<td>".$value."</td>";
									}
								}
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
			<div class="studentlist-info">
				<table style="width:100%;margin-top:50px;">
						<tr>	
							<th colspan="5" style ="padding:10px">Student Information</th>
						</tr>
						<tr>	
							<th>ID</th>
							<th>Name</th>
							<th>Password</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
						<?php
							if(isset($_SESSION['studentbatchinfo']) && !empty($_SESSION['studentbatchinfo'])) { 
							
								$class = $_SESSION['studentbatchinfo'][0];
								$group = $_SESSION['studentbatchinfo'][1];
								$section = $_SESSION['studentbatchinfo'][2];
								$batch = $_SESSION['studentbatchinfo'][3];
								
								$query = "SELECT * FROM `students` WHERE `s_class` = '$class' AND `s_group` = '$group' AND `s_section` = '$section' AND `s_batch` = '$batch'";
								$query_run = mysqli_query($con,$query);
								if($query_run){
									if(mysqli_num_rows($query_run)>0){
										while($row = $query_run->fetch_assoc()){
											echo "<tr>
													<td>".$row['s_id']."</td>
													<td>".$row['s_name']."</td>
													<td>********</td>
													<td class='pnt' id = ".$row['id']." data-toggle='modal' data-target='#update' onclick='fnc(this.id)'><span class='glyphicon glyphicon-edit'></span></td>
													<td><a href='delete.php?studentId=".$row['id']."'> <span class ='glyphicon glyphicon-trash'></span></a></td>
												  </tr>";
										}
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
				<form action="students.php" method="POST" style="border:none">
					<input type="hidden" name ="student_id" value="" id="studentId"/>
					<label  class="col-form-label">Update Name</label>
					<input type="text" name="student_name" class="form-control">
					<label  class="col-form-label">Update Password</label>
					<input type="text" name="student_password" class="form-control">
					<button type="submit" name="updatestudent" class="btn btn-primary">Save</button>
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