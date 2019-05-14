<?php 
	session_start();
	require_once('dbconfig/config.php');
	
	if(!isset($_SESSION['student']) && empty($_SESSION['student'])) {
		header("Location: index.php");
	}
	if(!isset($_GET['subject']) && empty($_GET['subjet'])){
		header("Location: student.php");
	}
	
	$s_id = $_SESSION['student'];
	$enrollId = $_GET['subject'];
			
	$query = "SELECT * FROM students WHERE s_id = '$s_id'";	
	$query_run = mysqli_query($con,$query);
	
	if ($query_run) {
		$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
		
		$class = $row['s_class'];
		$section = $row['s_section'];
		$group  = $row['s_group'];
		$batch = $row['s_batch'];
	}
	
	$query = "SELECT * FROM enroll WHERE e_id = '$enrollId'";	
	$query_run = mysqli_query($con,$query);
	if ($query_run) {
		$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
		
		$subjec = $row['sub_name'];
	}
	
	$twelvemonths = array("text", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	
	
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
				<li><a href="student.php">Home</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="student.php"><?php echo $s_id; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <span style = "font-size:18px"> Logout<span> </a></li>
			</ul>
		</div>
	</nav>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="taken-cls">
				<table style="width:100%;margin-top:20px;">
						<tr>	
							<th>Subject</th>
							<th>Class</th>
							<th>Section</th>
							<th>Group</th>
						</tr>
						<tr>
						<?php 
						echo "<td>".$subjec."</td>
							 <td>".$class."</td>
							 <td>".$section."</td>
							 <td>".$group."</td>";
						?>
						</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="view-attendance">
				<table style="width:100%;margin-top:40px;">

				  <tr>	

						<th>Months</th>
						<th>01</th>
						<th>02</th>
						<th>03</th>
						<th>04</th>
						<th>05</th>
						<th>06</th>
						<th>07</th>
						<th>08</th>
						<th>09</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
						<th>14</th>
						<th>15</th>
						<th>16</th>
						<th>17</th>
						<th>18</th>
						<th>19</th>
						<th>20</th>
						<th>21</th>
						<th>22</th>
						<th>23</th>
						<th>24</th>
						<th>25</th>
						<th>26</th>
						<th>27</th>
						<th>28</th>
						<th>31</th>
						<th>30</th>
						<th>31</th>
						<th>Total Present</th>
				  </tr>
				
					<?php 
						$year = date("Y");
						for($month = 1; $month < 13; $month++){
							echo "<tr>";
							echo "<td>".$twelvemonths[$month]."</td>";
							$totalpresent = 0;
							for($i = 1; $i < 32; $i++){
								$query_run = mysqli_query($con,"SELECT * FROM attendance WHERE s_id = '$s_id' AND e_id = '$enrollId' AND date = '$i' AND month = '$month' AND year = '$year'");
								
								if($query_run){
									if(mysqli_num_rows($query_run)>0){
										
										$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
										if($row['status'] == 1){
											echo "<td>1</td>";
											$totalpresent++;
										}
										else{
											echo "<td>0</td>";
										}
									}
									else{
										echo "<td></td>";
									}
								}
							}
							echo "<td>".$totalpresent."</td>";
							echo "</tr>";
						}
					?>
				  
				</table>
			</div>
		</div>
	</div>
</div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>