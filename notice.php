<?php
	require_once('dbconfig/config.php');
	if(isset($_GET['notice'])){
		$id = $_GET['notice'];
	}
	else{
		header("Location: index.php");
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
		<div class="notice">
					<?php 
						$query = "SELECT * FROM `notice` WHERE id = '$id'";
						$query_run = mysqli_query($con,$query);
						if($query_run){
							while($row = $query_run->fetch_assoc()){
								echo "<h2 style ='text-align:center'>".$row['notice_title']."</h2>";
								echo "<img src='upload/notice/".$row['notice']."' class='img-thumbnail' height='100%'>"; 
							}
						}
					?>
		</div>
	</div>
</div>

<div class="footer" style="height:50px;background:#4CAF50;margin-top:30px">
	<p class="text-center" style="font-size:16px;color:white;padding:10px"><?php echo date("Y"); ?></p>
</div>


	
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>