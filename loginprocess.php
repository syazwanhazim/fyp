<?php
	session_start();
	include 'dbconnect.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");

	$row = mysqli_fetch_array($query);

	if($username == $row['username'] && $password == $row['password']){ // admin
		$query2 = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");
		$row2 = mysqli_fetch_array($query2);
		$role = $row2['role'];
		if ($role=="admin")
		{
			header('refresh:2, admin.php');
			$_SESSION['adminloggedin'] = $row['userId'];
			echo "Logging in as admin. You will be redirected in a second";
			exit;
		}
	}
	else{
		header('refresh:2, index.php');
		echo "Login failed. You will be redirect in a second";
		exit;
	}
	
	if($username == $row['username'] && $password == $row['password']){
		header('refresh:2, user.php');
		$_SESSION['userloggedin'] = $row['userId'];
		echo "Login successful. You will be redirect in a second";
		exit;
	}
	
	
?>
