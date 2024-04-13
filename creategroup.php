<?php

    session_start();
    require_once 'includes/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        try {
            $query = "INSERT INTO groups (groupname) VALUES
            (:groupname)";
            $stmt = $db->prepare($query);

            $groupname = filter_input(INPUT_POST, 'groupname');
            $stmt->bindValue(':groupname', $groupname, PDO::PARAM_STR);

            $success = $stmt->execute();
            
        } catch (PDOException $e) {
            print "Encountered an error: " . $e->getMessage() . "<br>";
            die();
        }

        if ($success) {
            // Redirect to the groupdetails.php page after joining the group
            $query = "INSERT INTO userGroup (user_name, group_id) VALUES (:username, :groupid)";
            $stmt = $db->prepare($query);

            $username = $_SESSION['username'];
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);

            $groupid = $db->lastInsertId();
            $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);

            $success = $stmt->execute();

            if ($success) {
                // Redirect to the groupdetails.php page after joining the group
                header('Location: groupdetails.php?id=' . $groupid);
                exit();
            } else {
                echo "Sorry, could not join group.";
            }

            $db = null;
        }
    }
?>
