<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        label,
        input {
            display: block;
        }

        input {
            padding: 5px;
        }
    </style>
</head>
<body>
<h1>You are not part of this group yet, would you like to join?</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <div>
        <button type="submit" name="join_group">Join group</button>
    </div>
</form>

<?php
session_start();
require_once 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['join_group'])) {
    try {
        $query = "INSERT INTO userGroup (user_name, group_id) VALUES (:username, :groupname)";
        $stmt = $db->prepare($query);

        $username = $_SESSION['username'];
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $groupid = $_SESSION['group_id'];
        $stmt->bindValue(':groupname', $groupid, PDO::PARAM_INT);

        $success = $stmt->execute();

        if ($success) {
            // Redirect to the groupdetails.php page after joining the group
            header('Location: groupdetails.php?id=' . $groupid);
            exit();
        } else {
            echo "Sorry, could not join group.";
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