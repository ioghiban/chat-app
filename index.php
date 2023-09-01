<?php
    session_start();
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
    <h1>Login</h1>

    <?php
        if (!isset($_POST['submit'])) {
    ?>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="username">Enter username:</label> <br>
        <input type="text" name ="userName" required> <br>

        <input type="submit" name ="submit">
    </form>

    <?php
    } else {
        try {
            $db = new PDO('sqlite:database.db');
            $query = "SELECT * FROM users WHERE username = :userName";
            $stmt = $db->prepare($query);
            $username = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $username = filter_input(INPUT_POST, 'userName');
            $stmt->bindValue(':userName', $username, PDO::PARAM_STR);

            $stmt->execute();
            $r = $stmt->fetch();

            if($r){
                session_unset();
                $_SESSION["username"] = $username;

                echo "Logged in as " . $username . "<br>";

                header("Location: http://localhost:3000/grouplist.php", TRUE, 301);
                exit();
            } else {
                echo "Sorry, could not find user." . "<br>";
                header("Location: http://localhost:3000/createuser.php", TRUE, 301);
                exit();
            }

            $db = null;

        } catch (PDOException $e) {
            print "Encountered an error: " . $e->getMessage() . "<br>";
            die();
        }
    }
    ?>
</body>