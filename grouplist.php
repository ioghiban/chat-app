<?php
    include("creategroup.php");
?>

<?php
    $db = new PDO('sqlite:database.db');
    $stmt = $db->query("SELECT * FROM groups");
    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach($groups as $row => $group){
        echo "<li><a href=\"groupdetails.php?id=" . $group["id"] . "\">" . htmlspecialchars ( $group['groupname']) . "</a></li>";
    }
    echo "</ul>";
?>