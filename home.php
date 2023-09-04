<!DOCTYPE html>

<?php
    session_start();
?>

<html lang="en">
	<head>
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        label, input{ display:block; }
        input{ padding:5px; }
    </style>
</head>
<body>
	</head>
<body>
    <a href="login.php">Logout</a>
    <h1>Welcome User!</h1>
    <?php echo "Logged in as: " .$_SESSION['username'] . "<br>"; ?>
    <a href="grouplist.php">Go to groups</a>
</body>
</html>