<!DOCTYPE html>

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
    <h1>You are not part of this group yet, would you like to join?</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div>
            <label for="agree"> <input type="checkbox" name="agree" value="yes" id="agree" /></label>
            <small class="error"><?php echo $errors['agree'] ?? '' ?>
            </small>
        </div>

        <div>
            <button type="submit">Join group</button>
        </div>
    </form>

    <?php
        session_start();
        require_once 'conn.php';

        $agree = filter_input(INPUT_POST, 'agree', FILTER_SANITIZE_STRING);

        // check against the valid value
        
        if (ISSET($_POST['submit'])) {
            if ($agree) {
    
                try {
                    $query = "INSERT INTO userGroup (user_name, group_name) VALUES
                    (:username, :groupname)";
                    $stmt = $conn->prepare($query);

                    $username = $_SESSION['username'];
                    $stmt->bindValue(':usrname', $username, PDO::PARAM_STR);

                    $groupid = $_SESSION['group_id'];
                    $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);

                    $success = $stmt->execute();

                    if($success){
                        echo "Group created successfully.";
                    } else {
                        echo "Sorry, could not add group.";
                    }

                    $conn = null;
                } catch (PDOException $e) {
                    print "Encountered an error: " . $e->getMessage() . "<br>";
                    die();
                }
            }
        }
    ?>
</body>
</html>