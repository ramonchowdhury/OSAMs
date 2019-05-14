<?php
	session_start();
	require_once('dbconfig/config.php');

	if(isset($_GET['enrollId'])){
		 $id = $_GET['enrollId'];
		 $query = "DELETE FROM enroll WHERE e_id = '$id'";
		 $query_run = mysqli_query($con,$query);
		 if($query_run){
			header("Location: enroll.php");	
		}
		else{
			header("Location: 404.php");
		}
	}
	if(isset($_GET['studentId'])){
		 $id = $_GET['studentId'];
		 $query = "DELETE FROM students WHERE id = '$id'";
		 $query_run = mysqli_query($con,$query);
		 if($query_run){
			header("Location: students.php");	
		}
		else{
			header("Location: 404.php");
		}
	}
	if(isset($_GET['subjectId'])){
		 $id = $_GET['subjectId'];
		 $query = "DELETE FROM subject WHERE id = '$id'";
		 $query_run = mysqli_query($con,$query);
		 if($query_run){
			header("Location: subjects.php");	
		}
		else{
			header("Location: 404.php");
		}
	}
	if(isset($_GET['slideId'])){
		$id = $_GET['slideId'];
		 $query = "DELETE FROM slide WHERE id = '$id'";
		 $query_run = mysqli_query($con,$query);
		 if($query_run){
			header("Location: index.php");	
		}
		else{
			header("Location: 404.php");
		}
	}
	if(isset($_GET['noticeId'])){
		 $id = $_GET['noticeId'];
		 $query = "DELETE FROM notice WHERE id = '$id'";
		 $query_run = mysqli_query($con,$query);
		 if($query_run){
			header("Location: notice.php");	
		}
		else{
			header("Location: 404.php");
		}
	}
?>