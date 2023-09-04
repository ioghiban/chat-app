<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All groups</title>
	</head>
<body>
    <?php
        session_start();
        require_once 'conn.php';

        $stmt = $conn->query("SELECT * FROM groups");
        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<ul>";
        foreach($groups as $row => $group){
            echo "<li><a href=\"groupdetails.php?id=" . $group["id"] . "\">" . htmlspecialchars ( $group['groupname']) . "</a></li>";
        }
        echo "</ul>";
    ?>
    <form method="POST" action="creategroup.php">
    <div class="form-group">
        <input type="text" name ="groupname" class='form-control' required="required"/>
        </div>
        <button name="submit">Create</button>
    </form>	
</body>
</html>