<?php 
	session_start();
	require_once('dbconfig/config.php');
	
	$message="";
	
	if(!isset($_SESSION['teacher']) && empty($_SESSION['teacher'])) {
		header("Location: index.php");
	}
	
	$t_id = $_SESSION['teacher'];
	
	if(isset($_POST['viewattendance'])){
		$month = $_POST['month'];
		$enrollId = $_POST['enroll_id'];
		
		if($month == "Months"){
			$message = "Select Correctly";
		}
		else{
			
			$enrollmentArray = array("$month", "$enrollId");
			$_SESSION['attendanceandinfowithenrollid'] = $enrollmentArray;
			
			header("Location: monthly-attendance.php");
		}

	}
	elseif(isset($_POST['publishedresult'])){
		$term = $_POST['term'];
		$enrollId = $_POST['enroll_id'];
		
		if($term == "Select Term"){
			$message = "Select Correctly";
		}
		else{
			
			$termandenroll = array("$term", "$enrollId");
			$_SESSION['publishedresult'] = $termandenroll;
			
			header("Location: result-add.php");
		}

	}
	elseif(isset($_POST['viewresult_'])){
		$term = $_POST['term'];
		$enrollId = $_POST['enroll_id'];
		
		if($term == "Select Term"){
			$message = "Select Correctly";
		}

		else{
			
			$termandenroll = array("$term", "$enrollId");
			$_SESSION['viewresult'] = $termandenroll;
			
			header("Location: result.php");
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
			<div class="navbar-header">
			  <li class="navbar-brand" style="list-style:none">School Web</li>
			</div>
			<ul class="nav navbar-nav">
				<li class= "active"><a href="teacher.php">Home</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="teacher.php"><?php echo $_SESSION['teacher']; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <span style = "font-size:18px"> Logout<span> </a></li>
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
			<div class="teacherinfo">
				<h3>Teacher Information</h3>
				<ul class="list-group">
				<?php 
					
					$query = "SELECT * FROM teachers WHERE t_id = '$t_id'";	
					$query_run = mysqli_query($con,$query);
					if ($query_run) {
						$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
				
						echo "<li class='list-group-item'>ID: <span>".$row['t_id']."</span></li>";
						echo "<li class='list-group-item'>Name: <span>".$row['t_name']."</span></li>";
						echo "<li class='list-group-item'>Phone: <span>".$row['t_phone']."</span></li>";
						echo "<li class='list-group-item'>Email: <span>".$row['t_email']."</span></li>";
					}
				?>
				</ul>
			</div>
		</div>
		<div class="col-md-12">
			<div class="taken-cls">
				<h3>Class</h3>
				<table style="width:100%">
						<tr>	
							<th>Subject</th>
							<th>Class</th>
							<th>Section</th>
							<th>Group</th>
							<th colspan="2">Attendance</th>
							<th colspan="2">Result</th>
						</tr>
						
						<?php 
							$row1 = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM teachers WHERE t_id = '$t_id'"),MYSQLI_ASSOC);
							$teacher = $row1['id'];
							
							$query = "SELECT * FROM enroll WHERE t_id = '$teacher'";
							$query_run = mysqli_query($con,$query);
							
							if ($query_run) {
								if(mysqli_num_rows($query_run)>0){

								   while($row = $query_run->fetch_assoc()){
									   
									echo "<tr>
											<td>".$row['sub_name']."</td>
											<td>".$row['class']."</td>
											<td>".$row['section']."</td>
											<td>".$row['d_group']."</td>
											<td class='pnt' id=".$row['e_id']." data-toggle='modal' data-target='#selectmonth' onclick='fnc(this.id)'>View</td>
											<td><a href='attendance.php?enrollId=".$row['e_id']."'>Roll Call</a></td>
											<td class='pnt' id=".$row['e_id']." data-toggle='modal' data-target='#viewresult' onclick='fnc2(this.id)'>View</td>
											<td class='pnt' id=".$row['e_id']." data-toggle='modal' data-target='#addresult' onclick='fnc3(this.id)'>Published</td>
										  </tr>";
									}
								}
							}
						?>
						
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="selectmonth" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body" style="border:none">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<form action="teacher.php" method="POST" style="border:none">
					<input type="hidden" name="enroll_id" value="" id="enrollId"/>
					<label class="col-form-label">Select Month</label>
						<select name = "month" class="form-control">
							<option selected calss="default">Months</option>
							<option value="1">January</option>
							<option value="2">February</option>
							<option value="3">March</option>
							<option value="4">April</option>
							<option value="5">May</option>
							<option value="6">June</option>
							<option value="7">July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
					<button type="submit" name="viewattendance" class="btn btn-primary" style="margin-top:20px">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewresult" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body" style="border:none">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<form action="teacher.php" method="POST" style="border:none">
					<input type="hidden" name="enroll_id" value="" id="enrollId2"/>
					<label class="col-form-label">View Result</label>
						<select name = "term" class="form-control">
							<option selected calss="default">Select Term</option>
							<option value="1">1st Term</option>
							<option value="2">2nd Term</option>
							<option value="3">3rd Term</option>
						</select>
					<button type="submit" name="viewresult_" class="btn btn-primary" style="margin-top:20px">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="addresult" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body" style="border:none">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<form action="teacher.php" method="POST" style="border:none">
					<input type="hidden" name="enroll_id" value="" id="enrollId3"/>
					<label class="col-form-label">Published Result</label>
						<select name = "term" class="form-control">
							<option selected calss="default">Select Term</option>
							<option value="1">1st Term</option>
							<option value="2">2nd Term</option>
							<option value="3">3rd Term</option>
						</select>
					<button type="submit" name="publishedresult" class="btn btn-primary" style="margin-top:20px">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>



<script>
function fnc(id) {
   document.getElementById("enrollId").value = id;
}
function fnc2(id) {
   document.getElementById("enrollId2").value = id;
}
function fnc3(id) {
   document.getElementById("enrollId3").value = id;
}
</script>
	
	
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>