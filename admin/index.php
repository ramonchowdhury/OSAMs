<?php
	session_start();
	require_once('dbconfig/config.php');

	if(!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
		header("Location: admin.php");
	}
	
	$message  = "";
	
	if(isset($_POST['addteacher'])){
		$name = $_POST['name'];
		$id = $_POST['id'];
		$profile_pic  = $_FILES['profile_pic']['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$query = "SELECT * FROM teachers WHERE t_id = '$id'";
		
		$query_run = mysqli_query($con,$query);
		
		if($query_run){
			
			if(mysqli_num_rows($query_run)>0){
				$message = "This Teacher ID is already exist in Database";
			}
			else{
				$image = "../upload/".basename($profile_pic);
				move_uploaded_file($_FILES['profile_pic']['tmp_name'], $image);
				
				$query = "INSERT INTO `teachers` (`id`, `t_name`, `t_image`, `t_email`, `t_phone`, `t_id`, `t_password`) VALUES (NULL, '$name', '$profile_pic', '$email', '$phone', '$id', '$password')";
				
				$query_run = mysqli_query($con,$query);
				
					if($query_run){
						
						$message = "Teacher Added Sucessfully";
					}				
			}
		}
	}
	elseif(isset($_POST['addstudent'])){
		$name = $_POST['name'];
		$id = $_POST['id'];
		$password = $_POST['password'];
		$class = $_POST['class'];
		$group = $_POST['group'];
		$section = $_POST['section'];
		$batch = date("Y");
		$query = "SELECT * FROM students WHERE s_id = '$id'";
		
		$query_run = mysqli_query($con,$query);
		
		if($query_run){
			
			if(mysqli_num_rows($query_run)>0){
				$message = "This Student ID is already exist in Database";
			}
			else{
				$query = "INSERT INTO `students` (`id`, `s_id`, `s_name`, `s_password`, `s_class`, `s_group`, `s_section`, `s_batch`) VALUES (NULL, '$id', '$name', '$password', '$class', '$group', '$section', '$batch')";
				
				$query_run = mysqli_query($con,$query);
				
					if($query_run){
						
						$message = "Student Added Sucessfully";
					}				
			}
		}

	}
	elseif(isset($_POST['addbatch'])){
		$batch = $_POST['batchnumber'];
		
		$query = "INSERT INTO `batch` (`id`, `batchnumber`) VALUES (NULL, '$batch')";
		
		$query_run = mysqli_query($con,$query);
		
			if($query_run){
				
				$message = "New Batch Added Sucessfully";
			}
	}
	elseif(isset($_POST['addsubject'])){
		$sub_name = $_POST['sub-name'];
		$sub_class = $_POST['class'];
		
		$query = "INSERT INTO `subject` (`id`, `sub_name`, `sub_class`) VALUES (NULL, '$sub_name', '$sub_class')";
		
		$query_run = mysqli_query($con,$query);
		
			if($query_run){
				
				$message = "New Subject Added Sucessfully";
			}
	}
	elseif(isset($_POST['enroll'])){
		
		$teacher = $_POST['teacher'];
		$subject = $_POST['subject'];
		$class = $_POST['class'];
		$section = $_POST['section'];
		$group = $_POST['group'];
		$batch = $_POST['batch'];
		
		$query = "INSERT INTO `enroll` (`e_id`, `t_id`, `sub_name`, `class`, `section`, `d_group`, `batchnumber`) VALUES (NULL, '$teacher', '$subject', '$class', '$section', '$group', '$batch')";
		
		$query_run = mysqli_query($con,$query);
		
			if($query_run){
				
				$message = "Enroll Done!";
			}
	}
	elseif(isset($_POST['see_students'])){
		
		$class = $_POST['class'];
		$group = $_POST['group'];
		$section = $_POST['section'];
		$batch = $_POST['batch'];
		$query = "SELECT * FROM `students` WHERE `s_class` = '$class' AND `s_group` = '$group' AND `s_section` = '$section' AND `s_batch` = '$batch'";
		
		$query_run = mysqli_query($con,$query);
		if($query_run){
			if(mysqli_num_rows($query_run)>0){
				$studentArray=array("$class", "$group", "$section", "$batch");
				$_SESSION['studentbatchinfo'] = $studentArray;
				header("Location: students.php");
			}
			else{
				$message = "Students Not Found";
			}
		}
	}
	elseif(isset($_POST['addnotice'])){
		$notice_title = $_POST['notice_title'];
		$notice  = $_FILES['notice_image']['name'];

		$image = "../upload/notice/".basename($notice);
		move_uploaded_file($_FILES['notice_image']['tmp_name'], $image);
		
		$query = "INSERT INTO `notice` (`id`, `notice_title`, `notice`, `date`) VALUES (NULL, '$notice_title', '$notice', CURRENT_TIMESTAMP)";
		
		$query_run = mysqli_query($con,$query);
		
			if($query_run){
				
				$message = "Notice Added Sucessfully";
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


</head>

<body>

<div class="container-fluid">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li class ="active"><a href="index.php">Home</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="teachers.php">Teachers</a></li>
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
		<div class="col-md-3">
			<div class="panel-body">
				<div class="btn-group" style="width: 100%;">
				  <a href="teachers.php" class="btn btn-info btn-title">Teachers</a>
				   <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#addteacher"><i style="vertical-align: bottom;" class="glyphicon glyphicon-plus"></i></button>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel-body">
				<div class="btn-group" style="width: 100%;">
				   <button class="btn btn-info btn-title" data-toggle="modal" data-target="#student">Students</button>
				  <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#addstudent"><i style="vertical-align: bottom;" class="glyphicon glyphicon-plus"></i></button>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel-body">
				<div class="btn-group" style="width: 100%;"> </a>
				   <a href="subjects.php" class="btn btn-info btn-title">Subject</a>
				   <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#addsubject"><i style="vertical-align: bottom;" class="glyphicon glyphicon-plus"></i></button>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel-body">
				<div class="btn-group" style="width: 100%;">
				   <a href="enroll.php" class="btn btn-info btn-title">Enroll</a>
				   <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#enroll"><i style="vertical-align: bottom;" class="glyphicon glyphicon-plus"></i></button>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel-body">
				<div class="btn-group" style="width: 100%;">
				   <a href="notice.php" class="btn btn-info btn-title">Add Notice</a>
				   <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#notice"><i style="vertical-align: bottom;" class="glyphicon glyphicon-plus"></i></button>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel-body">
				<div class="btn-group" style="width: 100%;">
				   <button type="button" class="btn btn-primary btn-icon btn-batch" data-toggle="modal" data-target="#addbatch">Batch<i style="margin-left:16px" class="glyphicon glyphicon-plus"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- -->
<div class="modal fade" id="addteacher" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Teacher</h4>
			</div>
			<div class="modal-body">
				<form action="index.php" method="POST"  enctype="multipart/form-data">
					<div class="form-group plrb">
						<label class="control-label">Name:</label>
						<input type="text" name ="name" class="form-control" required>
					</div>
					<div class="form-group plrb">
						<label class="control-label">ID:</label>
						<input type="text" name ="id" class="form-control" required>
					</div>		
					<div class="form-group plrb">
						<label class="control-label">Profile Picture:</label>
						<input type="file" name="profile_pic" class="form-control" required>
					</div>	
					<div class="form-group plrb">
						<label class="control-label">Phone:</label>
						<input type="text" name ="phone" class="form-control" required>
					</div>						
					<div class="form-group plrb">
						<label class="control-label">Email:</label>
						<input type="email" name ="email" class="form-control" required>
					</div>	
					<div class="form-group plrb">
						<label class="control-label">Password:</label>
						<input type="text" name = "password" class="form-control" required>
					</div>						
					<div class="p15">
						<button type="submit" name="addteacher" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="addstudent" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Stuent</h4>
			</div>
			<div class="modal-body">
				<form action="index.php" method="POST">
					<div class="form-group plrb">
						<label class="control-label">Name:</label>
						<input type="text" name = "name" class="form-control" required>
					</div>
					<div class="form-group plrb">
						<label class="control-label">ID:</label>
						<input type="text" name = "id" class="form-control" required>
					</div>
					<div class="form-group plrb">
						<label class="control-label">Password:</label>
						<input type="text" name="password" class="form-control" required>
					</div>	
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Class:</label>
						<select name="class" class="form-control">
							<option selected calss="default">Select Class</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
						</select>
					</div>	
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Group:</label>
						<select name="group" class="form-control">
							<option selected calss="default">Select Group</option>
							<option>Science</option>
							<option>Commerce</option>
							<option>Arts</option>
							<option>General</option>
						</select>
					</div>					
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Section:</label>
						<select name="section" class="form-control">
							<option selected calss="default">Select Section</option>
							<option>A</option>
							<option>B</option>
							<option>C</option>
							<option>D</option>
							<option>E</option>
							<option>F</option>
							<option>G</option>
						</select>
					</div>
					<div class="p15">
						<button type="submit" name="addstudent" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="addsubject" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Subject</h4>
			</div>
			<div class="modal-body">
				<form action="index.php" method="POST">
					<div class="form-group p15">
						<label class="control-label">Name:</label>
						<input type="text" name="sub-name" class="form-control" required>
					</div>
					<div class="form-group plrb">
						<label for="recipient-name" class="control-label" style="margin-bottom:12px">Class:</label>
						<select name="class" class="form-control">
							<option selected calss="default">Select Class</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
						</select>
					</div>	
					<div class="p15">
						<button type="submit" name="addsubject" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addbatch" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Batch</h4>
			</div>
			<div class="modal-body">
				<form action="index.php" method="POST">
					<div class="form-group p15">
						<label class="control-label">Batch No:</label>
						<input type="text" name = "batchnumber" class="form-control" required>
					</div>
					<div class="p15">
						<button type="submit" name ="addbatch" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="enroll" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Enrollment</h4>
			</div>
			<div class="modal-body">
				<form action="index.php" method="POST">
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Teacher:</label>
						<select name = "teacher" class="form-control">
							<option selected calss="default">Select Teacher</option>
								<?php 
									$query = "SELECT * FROM teachers";	
									$query_run = mysqli_query($con,$query);
									if ($query_run) {
									   while($row = $query_run->fetch_assoc()){
								
											echo "<option value = ".$row['id'].">".$row['t_name']."</option>";

										}
									}
								?>
						</select>
					</div>

					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Subject:</label>
						<select name = "subject" class="form-control">
							<option selected calss="default">Select Subject</option>
								<?php 
									$query = "SELECT * FROM subject";	
									$query_run = mysqli_query($con,$query);
									if ($query_run) {
									   while($row = $query_run->fetch_assoc()){
								
											echo "<option>".$row['sub_name']."</option>";

										}
									}
								?>
						</select>
					</div>
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Class:</label>
						<select name = "class" class="form-control">
							<option selected calss="default">Select Class</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
						</select>
					</div>	
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Section:</label>
						<select name = "section" class="form-control">
							<option selected calss="default">Select Section</option>
							<option>A</option>
							<option>B</option>
							<option>C</option>
							<option>D</option>
							<option>E</option>
						</select>
					</div>
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Group:</label>
						<select name = "group" class="form-control">
							<option selected calss="default">Select Group</option>
							<option>Science</option>
							<option>Arts</option>
							<option>Commerce</option>
							<option>General</option>
						</select>
					</div>					
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Batch:</label>
						<select name = "batch" class="form-control">
							<option selected calss="default">Select Batch</option>
								<?php 
									$query = "SELECT * FROM batch";	
									$query_run = mysqli_query($con,$query);
									if ($query_run) {
									   while($row = $query_run->fetch_assoc()){
								
											echo "<option>".$row['batchnumber']."</option>";

										}
									}
								?>
						</select>
					</div>
					<div class="p15">
						<button type="submit" name = "enroll" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="student" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Student Info</h4>
			</div>
			<div class="modal-body">
				<form action="index.php" method="POST">
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Class:</label>
						<select name="class" class="form-control">
							<option selected calss="default">Select Class</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
						</select>
					</div>					
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Group:</label>
						<select name="group" class="form-control">
							<option selected calss="default">Select Group</option>
							<option>Science</option>
							<option>Commerce</option>
							<option>Arts</option>
							<option>General</option>
						</select>
					</div>	
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Section:</label>
						<select name="section" class="form-control">
							<option selected calss="default">Select Section</option>
							<option>A</option>
							<option>B</option>
							<option>C</option>
							<option>D</option>
							<option>E</option>
							<option>F</option>
						</select>
					</div>						
					<div class="form-group plrb">
						<label class="control-label" style="margin-bottom:12px">Batch:</label>
						<select name="batch" class="form-control">
							<option selected calss="default">Select Batch</option>
							<?php 
								$query = "SELECT * FROM batch";	
								$query_run = mysqli_query($con,$query);
								if ($query_run) {
								   while($row = $query_run->fetch_assoc()){
							
										echo "<option>".$row['batchnumber']."</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="p15">
						<button type="submit" name="see_students" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="notice" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Notice</h4>
			</div>
			<div class="modal-body">
				<form action="index.php" method="POST" enctype="multipart/form-data">
					<div class="form-group p15">
						<label class="control-label">Notice Title</label>
						<input type="text" name = "notice_title" class="form-control" required>
					</div>
					<div class="form-group p15">
						<label class="control-label">Notice</label>
						<input type="file" name = "notice_image" class="form-control" required>
					</div>
					<div class="p15">
						<button type="submit" name="addnotice" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


	
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>