<?php
    if(!is_file('database.db')){
		file_put_contents('database.db', null);
	}

	$db = new PDO('sqlite:database.db');

	//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	define('APP_NAME', 'CHAT-APP');

	$query = "CREATE TABLE IF NOT EXISTS users
        (username TEXT PRIMARY KEY,
        password TEXT NOT NULL)";

	$db->exec($query);
?>
