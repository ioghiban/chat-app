<?php
    session_start();
    require_once 'includes/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_group'])) {
        $groupid = filter_input(INPUT_POST, 'groupid', FILTER_SANITIZE_NUMBER_INT);

        try {
            // Delete messages associated with the group
            $query = "DELETE FROM messages WHERE group_id = :groupid";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);
            $stmt->execute();

            // Delete group membership entries
            $query = "DELETE FROM userGroup WHERE group_id = :groupid";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);
            $stmt->execute();

            // Delete the group
            $query = "DELETE FROM groups WHERE id = :groupid";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':groupid', $groupid, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect to a page after successful deletion
            header('Location: grouplist.php');
            exit();
        } catch (PDOException $e) {
            print "Encountered an error: " . $e->getMessage() . "<br>";
            die();
        }
    }
?>
