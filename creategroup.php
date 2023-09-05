<?php

    session_start();
    require_once 'includes/config.php';

    if (ISSET($_POST['submit'])) {
        try {
            $query = "INSERT INTO groups (id, groupname) VALUES
            (:groupid, :groupname)";
            $stmt = $db->prepare($query);

            $groupid = uniqid();
            $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);

            $groupname = filter_input(INPUT_POST, 'groupname');
            $stmt->bindValue(':groupname', $groupname, PDO::PARAM_STR);

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
