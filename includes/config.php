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

	$query = "CREATE TABLE IF NOT EXISTS groups 
		(id INTEGER PRIMARY KEY AUTOINCREMENT,
		groupname TEXT NOT NULL)";

	$db->exec($query);

	$query = "CREATE TABLE IF NOT EXISTS userGroup 
		(user_name TEXT NOT NULL,
		group_id INTEGER NOT NULL,
		FOREIGN KEY (user_name) REFERENCES users(username),
		FOREIGN KEY (group_id) REFERENCES groups(id))";

	$db->exec($query);

	$query = "CREATE TABLE IF NOT EXISTS messages
		(id INTEGER PRIMARY KEY AUTOINCREMENT,
		user_name TEXT NOT NULL,
		group_id INTEGER NOT NULL,
		content TEXT NOT NULL,
		FOREIGN KEY (user_name) REFERENCES users(username),
		FOREIGN KEY (group_id) REFERENCES groups(id))";

	$db->exec($query);
?>
