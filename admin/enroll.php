<?php
	session_start();
	require_once('dbconfig/config.php');
	
	if(!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
		header("Location: admin.php");
	}
	
	$message = "";
	if(isset($_POST['changeteacher'])){

		$teacherid = $_POST['teacherid'];
		$e_id = $_POST['enroll_id'];

		$query = "UPDATE `enroll` SET `t_id` = '$teacherid' WHERE `enroll`.`e_id` = '$e_id'";
		
		$query_run = mysqli_query($con,$query);
		
			if($query_run){
				
				$message = "Teacher Changed Sucessfully";
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
				<li class="active"><a href="enroll.php">Enrollment</a></li>
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
						<th>Teacher</th>
						<th>Subject</th>
						<th>Class</th>
						<th>Section</th>
						<th>group</th>
						<th>Edit</th>
						<th>Delete</th>
				  </tr>	
					<?php 
						$query = "SELECT * FROM enroll";	
						$query_run = mysqli_query($con,$query);
						if ($query_run) {
						   while($row = $query_run->fetch_assoc()){
							   
								$teacherId = $row['t_id'];
								$row1 = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM teachers WHERE id = '$teacherId'"),MYSQLI_ASSOC);
								$teacher = $row1['t_name'];
							   
							echo "<tr>
									<td>".$teacher."</td>
									<td>".$row['sub_name']."</td>
									<td>".$row['class']."</td>
									<td>".$row['section']."</td>
									<td>".$row['d_group']."</td>
									<td class='pnt' id = ".$row['e_id']." data-toggle='modal' data-target='#update' onclick='fnc(this.id)'><span class='glyphicon glyphicon-edit'></span></td>
									<td><a href='delete.php?enrollId=".$row['e_id']."'> <span class ='glyphicon glyphicon-trash'></span></a></td>
								  </tr>";

							}
						}
					?>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="update" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Subject</h4>
			</div>
			<div class="modal-body">
				<form action="enroll.php" method="POST">
					<div class="form-group plrb">
						<label for="recipient-name" class="control-label" style="margin-bottom:12px">Change Teacher:</label>
						<input type="hidden" name = "enroll_id" value = "" id="enrollId"/>
						<select name = "teacherid" class="form-control">
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
					<div class="p15">
						<button type="submit" name = "changeteacher" class="btn btn-primary">Change</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
function fnc(id) {
   document.getElementById("enrollId").value = id;
}
</script>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>