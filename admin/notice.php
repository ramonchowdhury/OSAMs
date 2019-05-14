<?php
	session_start();
	require_once('dbconfig/config.php');

	if(!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
		header("Location: admin.php");
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
				<li ><a href="teachers.php">Teachers</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="enroll.php">Enrollment</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="subjects.php">Subjects</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li class="active"><a href="notice.php">Notice</a></li>
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
			<div class="notice-list">
				<h3>Notice</h3>
				<ul class="list-group">
					<?php 
						$query = "SELECT * FROM `notice` ";
						$query_run = mysqli_query($con,$query);
						if($query_run){
							if(mysqli_num_rows($query_run)>0){
								while($row = $query_run->fetch_assoc()){
		
									echo " <li class='list-group-item d-flex justify-content-between align-items-center' style='font-size:16px'>".$row['notice_title']."<span class='badge badge-primary badge-pill' style='color:#000'>".$row['date']."<a href='delete.php?noticeId=".$row['id']."'><span class ='glyphicon glyphicon-trash'></span></a></span></li>";
									
								}
							}
							else{
								echo "<h1 style='text-align:center'>Empty</h1>";
							}
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>

	
	
	
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>