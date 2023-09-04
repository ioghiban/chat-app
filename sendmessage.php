<?php

    session_start();
    require_once 'conn.php';

    if (ISSET($_POST['submit'])) {
        $content = $_POST['content'];

        $query = "INSERT INTO messages (id, user_name, group_id, content) VALUES
        (:msgid, :username, :groupid, :content)";
        $stmt = $conn->prepare($query);

        $msgid = uniqid();
        $stmt->bindValue(':msgid', $msgid, PDO::PARAM_INT);
        
        $username = $_SESSION['username'];
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $groupid = $_SESSION['group_id'];
        $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);

        $content = filter_input(INPUT_POST, 'content');
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);

        $success = $stmt->execute();
        if($success){
            echo "Message sent successfully.";
        } else {
            echo "Sorry, could not send message.";
        }
    }
?>