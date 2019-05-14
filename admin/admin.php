<?php
	session_start();
	
	$message = "";
	if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
		header("Location: index.php");
	}	

		
	if(isset($_POST['loginadmin'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		if($username == "admin" && $password == "admin"){
		
			$_SESSION['admin'] = "admin";
			header( "Location: index.php");
		}
		else{
			$message = "Username and Password not match";
		}
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
    <link rel="stylesheet" href="css/font-awesome.min.css" >
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/style.css">
	
	
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php echo " <p class='p15s'>$message</p> "; $message = ""; ?>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="login-form">
				<form action="admin.php" method = "POST">
					<div class="p15">
						<div class="form-group">
						   <label>Username:</label>
						   <input type="text" name="username" class="form-control" required>
						</div>
						<div class="form-group">
						   <label>Password:</label>
						   <input type="password" name = "password" class="form-control" required>
						</div>
						<button type="submit" name="loginadmin" class="btn btn-default">Login</button>
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