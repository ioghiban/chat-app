<?php
    session_start();
    require_once 'includes/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the username already exists
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['error'] = "Username already exists. Please choose a different username.";
        } else {
            // Insert the new user into the database
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR); // Hash the password
            $stmt->execute();

            // Log in the user
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Sign up successful. You are now logged in.";
            header('Location: index.php'); // Redirect to the main page
            exit();
        }
    }
?>

<!DOCTYPE html>
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

            <?php
                if(isset($_SESSION['error'])){
            ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']?></div>
            <?php
                unset($_SESSION['error']);
                }
            ?>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required="required"/>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required="required"/>
            </div>

            <button name="register">Sign up</button>
        </form>	
    </body>
</html>
