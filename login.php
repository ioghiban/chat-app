<!DOCTYPE html>
<?php 
    session_start();
?>
<html lang="en">
	<head>
        <meta charset="UTF-8">  
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
<body>
    <a href="index.php">Sign up</a>
        <form method="POST" action="login_query.php">	
            <div class="alert alert-info">Login</div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required="required"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required="required"/>
            </div>
            <?php
                if(ISSET($_SESSION['error'])){
            ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']?></div>
            <?php
                session_unset($_SESSION['error']);
                }
            ?>
            <button name="login">Login</button>
        </form>	
</body>
</html>
