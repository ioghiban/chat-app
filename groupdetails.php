<?php
    $db = new PDO('sqlite:database.db');

    try {
        $query = "SELECT * FROM groups WHERE id = :groupId";
        $stmt = $db->prepare($query);
        $id = filter_input(INPUT_GET, 'id');
        $stmt->bindValue(':groupId', $id, PDO::PARAM_INT);
        $stmt->execute();
        $r = $stmt->fetch();

        $stmt = $db->query("SELECT * FROM messages WHERE group_id = $id");
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null;

        if (!$r){
            echo "No group found.";
            exit();
        }

        if (!$messages){
            echo "No message found.";
            exit();
        }
        
    } catch (PDOException $e) {
        print "Encountered an error: " . $e->getMessage() . "<br>";
        die();
    }

?>

<h1><?php echo htmlspecialchars($r['id'] . " : " . $r['groupname'])?></h1>
    
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