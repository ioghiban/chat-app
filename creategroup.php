<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create group</title>
    <style>
        label, input{ display:block; }
        input{ padding:5px; }
    </style>
</head>
<body>

    <h1>Add a new group</h1>

    <?php
        if (!isset($_POST['submit'])) {
    ?>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="groupname">Group name:</label> <br>
        <input type="text" name ="groupName" required> <br>

        <input type="submit" name="submit">
    </form>

    <?php
    } else {
        try {
            $db = new PDO('sqlite:database.db');
            //if (':groupId' != '' and 'groupName' != '') {
            $insertGroup = "INSERT INTO groups (id, groupname) VALUES
            (:groupId, :groupName)";
            $stmt = $db->prepare($insertGroup);

            $groupid = uniqid();
            $stmt->bindValue(':groupId', $groupid, PDO::PARAM_INT);


            $groupname = filter_input(INPUT_POST, 'groupName');
            $stmt->bindValue(':groupName', $groupname, PDO::PARAM_STR);

            $success = $stmt->execute();
            if($success){
                echo "Group created successfully.";
            } else {
                echo "Sorry, could not add group.";
            }

            $db = null;
        } catch (PDOException $e) {
            print "Encountered an error: " . $e->getMessage() . "<br>";
            die();
        }
    }
    ?>
</body>
</html>