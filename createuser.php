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

    <h1>Create new user</h1>

    <?php
        if (!isset($_POST['submit'])) {
    ?>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="username">Enter username:</label> <br>
        <input type="text" name ="userName" required> <br>

        <label for="password">Enter password:</label> <br>
        <input type="text" name ="passWord" required> <br>

        <input type="submit" name="submit">
    </form>

    <?php
    } else {
        try {
            $db = new PDO('sqlite:database.db');
            $insertUser = "INSERT INTO users (username, password) VALUES
            (:userName, :passWord)";
            $stmt = $db->prepare($insertUser);

            $username = filter_input(INPUT_POST, 'userName');
            $stmt->bindValue(':userName', $username, PDO::PARAM_STR);

            $password = filter_input(INPUT_POST, 'passWord');
            $stmt->bindValue(':passWord', $password, PDO::PARAM_STR);

            $success = $stmt->execute();
            if($success){
                echo "User created successfully.";
            } else {
                echo "Sorry, could not create user.";
            }
            $db = null;
        } catch (PDOException $e) {
            print "Encountered an error: " . $e->getMessage() . "<br>";
            die();
        }
    }
    ?>
</body>