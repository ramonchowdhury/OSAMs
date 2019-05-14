<?php
	session_start();
	require_once('dbconfig/config.php');
	
	$message = "";
	if(isset($_SESSION['student']) && !empty($_SESSION['student'])) {
		header("Location: student.php");
	}
	elseif(isset($_SESSION['teacher']) && !empty($_SESSION['teacher'])) {
		header("Location: teacher.php");
	}	

	if(isset($_POST['login'])){
		
		$choice = $_POST['choice'];
		$userid = $_POST['userid'];
		$password = $_POST['password'];
		$message = "Failed"." ".$userid." ".$password." ".$choice;
		
		if($choice == 1){
			$query = "SELECT * FROM teachers WHERE t_id = '$userid' AND t_password = '$password'";
			$query_run = mysqli_query($con,$query);
			
			if($query_run){
				
				if(mysqli_num_rows($query_run)>0){
						
					$_SESSION['teacher'] = $userid;
					
					header("Location: teacher.php");
				}
				else{
					$message = "Teacher ID and Password Not Match";
				}
			}

		}
		elseif($choice == 2){
			
			$query = "SELECT * FROM students WHERE s_id = '$userid' AND s_password = '$password'";
			$query_run = mysqli_query($con,$query);
			
			if($query_run){
				
				if(mysqli_num_rows($query_run)>0){
						
					$_SESSION['student'] = $userid;
					
					header("Location: student.php");
				}
				else{
					$message ="Student ID and Password Not Match";
				}
			}
		}
		else{
			$message = "Select!";
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
				<form action="login.php" method = "POST">
					<div class="p15">
						<select name="choice" class="form-control">
							<option selected calss="default">Select</option>
							<option value="1">Teacher</option>
							<option value="2">Stuent</option>
						</select>
						<div class="form-group">
						   <label>UserID:</label>
						   <input type="text" name="userid" class="form-control">
						</div>
						<div class="form-group">
						   <label>Password:</label>
						   <input type="password" name="password" class="form-control">
						</div>
						<button type="submit" name="login" class="btn btn-default">Login</button>
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