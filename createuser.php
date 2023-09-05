<?php
	session_start();

	require_once 'includes/config.php';
	
	if(ISSET($_POST['register'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "INSERT INTO `users` (username, password) VALUES(:username, :password)";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		
		if($stmt->execute()){
			$_SESSION['success'] = "Successfully created an account";

			header('location: index.php');
		}
	}
?>
