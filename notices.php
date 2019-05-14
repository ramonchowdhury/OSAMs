<?php
	require_once('dbconfig/config.php');
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
				<li><a href="index.php">Home</a></li>
				<li><a href="teachers.php">Teacher</a></li>
				<li class="active"><a href="notices.php">Notice</a></li>
			</ul>
		</div>
	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="notice-board">
				<h3>NOTICE BOARD</h3>
				<div class="list-group">
					<?php 
						$query = "SELECT * FROM `notice` ";
						$query_run = mysqli_query($con,$query);
						if($query_run){
							while($row = $query_run->fetch_assoc()){
							echo "<li class='list-group-item d-flex justify-content-between align-items-center' style='font-size:16px'><a href='notice.php?notice=".$row['id']."' class='list-group-item'>".$row['notice_title']."</a><span class='badge badge-primary badge-pill' style='color:#000'>".$row['date']."</span></li>";
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>