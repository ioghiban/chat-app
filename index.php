<!DOCTYPE html>

<?php
    session_start();
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">  
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign up</title>
        <style>
            label, input{ display:block; }
            input{ padding:5px; }
        </style>
    </head>

    <body>

        <a href="login.php">Log in</a>

        <form method="POST" action="createuser.php">	

            <div class="alert alert-info">Sign up</div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required="required"/>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required="required"/>
            </div>

            <?php
                if(ISSET($_SESSION['success'])){
            ?>
            <?php echo $_SESSION['success']?>
            <?php
                unset($_SESSION['success']);
                }
            ?>
            <button name="register">Sign up</button>
        </form>	
    </body>
</html>