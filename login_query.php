<?php
	session_start();
	require_once 'includes/config.php';
	
	if(ISSET($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$_SESSION['username'] = $username;
		
		$query = "SELECT COUNT(*) as count FROM `users` 
		WHERE `username` = :username AND `password` = :password";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		$row = $stmt->fetch();
		
		$count = $row['count'];
		
		if($count > 0){
			header('location:home.php');
		}else{
			$_SESSION['error'] = "Invalid username or password";
			header('location:login.php');
		}
	}
?>
