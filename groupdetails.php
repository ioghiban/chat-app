<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group details</title>
	</head>
    <body>

    <?php
        session_start();
	    require_once 'includes/config.php';

        try {
            $query = "SELECT * FROM groups WHERE id = :groupid";
            $stmt = $db->prepare($query);
            $groupid = filter_input(INPUT_GET, 'id');
            $_SESSION['group_id'] = $groupid;
            $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);
            $stmt->execute();
            $r = $stmt->fetch();

            if ($r) {
                $username = $_SESSION['username'];

                $query = "SELECT COUNT(*) as count FROM `userGroup` 
                WHERE `group_id` = :groupid AND `user_name` = :username";
                $stmt = $db->prepare($query);
                $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);
                $stmt->bindValue(':username', $username, PDO::PARAM_STR);

                $stmt->execute();
                $row = $stmt->fetch();
                
                $count = $row['count'];
                if($count > 0){
                    $stmt = $db->query("SELECT * FROM messages WHERE group_id = $groupid");
                    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $db = null;
                } else {
                    header('location:joingroup.php');
                }

                if (!$messages){
                    echo "No message found.";
                    exit();
                }
            } else {
                echo "No group found.";
                exit();
            }
            
        } catch (PDOException $e) {
            print "Encountered an error: " . $e->getMessage() . "<br>";
            die();
        }

    ?>
    <a href="grouplist.php">Back to all groups...</a>

    <h1><?php echo htmlspecialchars( "Messages in: " . $r['groupname'])?></h1>
        
    <?php
        echo "<table border=1>";

        echo "<tr>";
            echo "<td>Sender</td>";
            echo "<td>Message</td>";
        echo "</tr>";

        foreach($messages as $row => $message){
            echo "<tr>";
                echo "<td>" . $message['user_name'] . "</td>";
                echo "<td>" . $message['content'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
    <form method="POST" action="sendmessage.php">	
        <div class="form-group">
            <input type="text" name="content" class="form-control" required="required"/>
        </div>
        <button name="submit">Send</button>
    </form>	
</body>
</html>