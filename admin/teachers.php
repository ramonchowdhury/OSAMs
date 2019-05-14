<?php
	session_start();
	require_once('dbconfig/config.php');
	
	if(!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
		header("Location: admin.php");
	}	
	
	$message = "";
	$temp = "";
	$query = "";
	
	if(isset($_POST['updateteachers'])){

		$teacherid = $_POST['teacher_id'];
		$email_ = $_POST['email_'];
		$phone_ = $_POST['phone_'];
		$password_ = $_POST['password_'];
		
		if(empty($_POST['phone_']) || empty($_POST['email_']) || empty($_POST['password_'])){
			if(empty($_POST['phone_']) && empty($_POST['email_']) && empty($_POST['password_'])){
				$message = "All The filed are empty";
			}
			elseif(!empty($_POST['phone_']) && !empty($_POST['email_'])){
				$temp = "Email and Phone";
				$query = "UPDATE `teachers` SET `t_email` = '$email_', `t_phone` = '$phone_' WHERE `teachers`.`id` = '$teacherid'";
			}
			elseif(!empty($_POST['phone_']) && !empty($_POST['password_'])){
				$temp = "Phone and Password";
				$query = "UPDATE `teachers` SET `t_phone` = '$phone_', `t_password` = '$password_' WHERE `teachers`.`id` = '$teacherid'";
			}
			elseif(!empty($_POST['email_']) && !empty($_POST['password_'])){
				$temp = "Email and Password";
				$query = "UPDATE `teachers` SET `t_email` = '$email_', `t_password` = '$password_' WHERE `teachers`.`id` = '$teacherid'";
			}
			elseif(!empty($_POST['phone_'])){
				$temp = "Phone";
				$query = "UPDATE `teachers` SET `t_phone` = '$phone_' WHERE `teachers`.`id` = '$teacherid'";
			}
			elseif(!empty($_POST['email_'])){
				$temp = "Email";
				$query = "UPDATE `teachers` SET `t_email` = '$email_' WHERE `teachers`.`id` = '$teacherid'";
			}
			elseif(!empty($_POST['password_'])){
				$temp = "Password";
				$query = "UPDATE `teachers` SET `t_password` = '$password_' WHERE `teachers`.`id` = '$teacherid'";
			}

		}
		else{
			$temp  = "Email, Phone and Password";
			$query = "UPDATE `teachers` SET `t_email` = '$email_', `t_phone` = '$phone_', `t_password` = '$password_' WHERE `teachers`.`id` = '$teacherid'";
		}	

		if($query != ''){
			$query_run = mysqli_query($con,$query);
		
			if($query_run){
				
				$message = $temp." Changed Sucessfully";
			}	
		} 	
	}
?>
<!DOCTYPE HTML>

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
				<li class="active"><a href="teachers.php">Teachers</a></li>
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
			<div class="teacherlist" style="margin-top:30px">
				<table style="width:100%">
				  <tr>	
						<th colspan="6" style = "padding:10px">Teacher's Information</th>
				  </tr>
				  <tr>	
						<th>ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Password</th>
						<th>Edit</th>
				  </tr>

					<?php 
						$query = "SELECT * FROM teachers";	
						$query_run = mysqli_query($con,$query);
						if ($query_run) {
						   while($row = $query_run->fetch_assoc()){
							   
							echo "<tr>
									<td>".$row['t_id']."</td>
									<td>".$row['t_name']."</td>
									<td>".$row['t_phone']."</td>
									<td>".$row['t_email']."</td>
									<td>********</td>
									<td class='pnt' id = ".$row['id']." data-toggle='modal' data-target='#update' onclick='fnc(this.id)'><span class='glyphicon glyphicon-edit'></span></td>
								  </tr>";

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
				<form action="teachers.php" method="POST" style="border:none">
					<input type="hidden" name="teacher_id" value="" id="teacherId"/>
					<label class="col-form-label">Update Email</label>
					<input type="text" name="email_" class="form-control">
					<label class="col-form-label">Update Phone</label>
					<input type="text" name="phone_" class="form-control">
					<label class="col-form-label">Update Password</label>
					<input type="text" name="password_" class="form-control">
					<button type="submit" name="updateteachers" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
function fnc(id) {
   document.getElementById("teacherId").value = id;
}
</script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>