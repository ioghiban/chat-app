<?php

    session_start();
    require_once 'includes/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $content = $_POST['content'];
        $username = $_SESSION['username'];
        $groupid = $_SESSION['group_id'];

        try {
            $query = "INSERT INTO messages (user_name, group_id, content) VALUES (:username, :groupid, :content)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);
            $stmt->bindValue(':content', $content, PDO::PARAM_STR);
            $stmt->execute();

            // Redirect back to the same page after sending the message
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (PDOException $e) {
            print "Encountered an error: " . $e->getMessage() . "<br>";
            die();
        }
    }
?>
