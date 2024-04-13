<?php
    class MyDB extends SQLite3 {
        function __construct() {
        $this->open('database.db');
        }
    }
    $db = new MyDB();

    if(!$db) {
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully <br>";
    }

    // 'username' instead of just 'name' otherwise SQLite/PHP gets confused

    $createUsersTable =<<<EOF
        CREATE TABLE IF NOT EXISTS users 
        (username TEXT PRIMARY KEY,
        password TEXT NOT NULL)
    EOF;

    $retUsers = $db->exec($createUsersTable);
    if(!$retUsers){
        echo $db->lastErrorMsg();
    } else {
        echo "Users table created successfully <br>";
    }

    $insertUser1 =<<<EOF
        INSERT INTO users VALUES ('alice', 'ilikemushrooms10');
    EOF;

    $retUser1 = $db->exec($insertUser1);
    if(!$retUser1) {
        echo $db->lastErrorMsg();
    } else {
        echo "User1 created successfully <br>";
    }

    $insertUser2 =<<<EOF
        INSERT INTO users VALUES ('bob', 'idontlikemushrooms13');
    EOF;

    $retUser2 = $db->exec($insertUser2);
    if(!$retUser2) {
        echo $db->lastErrorMsg();
    } else {
        echo "User2 created successfully <br>";
    }

    // 'groupname' instead of just 'name' otherwise SQLite/PHP gets confused

    $createGroupsTable =<<<EOF
        CREATE TABLE IF NOT EXISTS groups 
        (id INTEGER PRIMARY KEY,
        groupname TEXT NOT NULL)
    EOF;

    $retGroups = $db->exec($createGroupsTable);
    if(!$retGroups){
        echo $db->lastErrorMsg();
    } else {
        echo "Groups table created successfully <br>";
    }

    $insertGroup1 =<<<EOF
        INSERT INTO groups VALUES ('1', 'friends');
    EOF;

    $retGroup1 = $db->exec($insertGroup1);
    if(!$retGroup1){
        echo $db->lastErrorMsg();
    } else {
        echo "Group1 created successfully <br>";
    }

    $createMessagesTable =<<<EOF
        CREATE TABLE IF NOT EXISTS messages (
            id INTEGER PRIMARY KEY,
            user_name TEXT NOT NULL,
            group_id INTEGER NOT NULL,
            content TEXT NOT NULL,
            FOREIGN KEY (user_name) REFERENCES users(username),
            FOREIGN KEY (group_id) REFERENCES groups(id)
        )
    EOF;

    $retMessages = $db->exec($createMessagesTable);
    if(!$retMessages){
        echo $db->lastErrorMsg();
    } else {
        echo "Messages table created successfully <br>";
    }

    $insertMessage1 =<<<EOF
        INSERT INTO messages VALUES ('1', 'alice', '1', 'hi!')
    EOF;
    
    $retMessage1 = $db->exec($insertMessage1);
    if(!$retMessage1){
        echo $db->lastErrorMsg();
    } else {
        echo "Message1 created successfully <br>";
    }

    $insertMessage2 =<<<EOF
        INSERT INTO messages VALUES ('2', 'alice', '1', 'wassup')
    EOF;

    $retMessage2 = $db->exec($insertMessage2);
    if(!$retMessage2){
        echo $db->lastErrorMsg();
    } else {
        echo "Message2 created successfully <br>";
    }

    $insertMessage3 =<<<EOF
        INSERT INTO messages VALUES ('3', 'bob', '1', 'im fine, you?')
    EOF;

    $retMessage3 = $db->exec($insertMessage3);
    if(!$retMessage3){
        echo $db->lastErrorMsg();
    } else {
        echo "Message3 created successfully <br>";
    }

    $createUserGroupTable =<<<EOF
        CREATE TABLE IF NOT EXISTS userGroup (
            user_name TEXT NOT NULL,
            group_id INTEGER NOT NULL,
            FOREIGN KEY (user_name) REFERENCES users(username),
            FOREIGN KEY (group_id) REFERENCES groups(id)
        )
    EOF;

    $retUserGroup = $db->exec($createUserGroupTable);
    if(!$retUserGroup){
        echo $db->lastErrorMsg();
    } else {
        echo "User-Group table created successfully <br>";
    }

    $insertUser1Group1 =<<<EOF
        INSERT INTO userGroup VALUES ('alice', '1')
    EOF;

    $retUser1Group1 = $db->exec($insertUser1Group1);
    if(!$retUser1Group1){
        echo $db->lastErrorMsg();
    } else {
        echo "User1-Group1 created successfully <br>";
    }

    $insertUser2Group1 =<<<EOF
        INSERT INTO userGroup VALUES ('bob', '1')
    EOF;

    $retUser2Group1 = $db->exec($insertUser2Group1);
    if(!$retUser2Group1){
        echo $db->lastErrorMsg();
    } else {
        echo "User2-Group1 created successfully <br>";
    }

    $db->close();
