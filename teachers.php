<?php 
	session_start();
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
				<li class="active"><a href="teachers.php">Teacher</a></li>
				<li><a href="notices.php">Notice</a></li>
			</ul>
		</div>
	</nav>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-12" style = "margin-top:20px;">
			<?php 
				$query = "SELECT * FROM teachers";
				$query_run = mysqli_query($con,$query);
				if ($query_run) {	
					if(mysqli_num_rows($query_run)>0){

					   while($row = $query_run->fetch_assoc()){
						echo "
							<div class='teacher-info'>
								<ul>
									<li><img src='upload/".$row['t_image']."'/></li>
									<li><h5>Name: <span>".$row['t_name']."</span></h5></li>
									<li><h5>Email: <span>".$row['t_email']."</span></h5></li>
									<li><h5>Phone: <span>+88".$row['t_phone']."</span></h5></li>
								</ul>
							</div>
						";
					   }
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