<?php
    if(!is_file('database.db')){
		file_put_contents('database.db', null);
	}

	$conn = new PDO('sqlite:database.db');

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = "CREATE TABLE IF NOT EXISTS users
        (username TEXT PRIMARY KEY,
        password TEXT NOT NULL)";

	$conn->exec($query);
?>
