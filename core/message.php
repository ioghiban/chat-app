<?php
class Message{
    //db
    private $conn;
    private $table = 'messages';

    //message props
    public $id;
    public $username;
    public $groupid;
    public $content;

    //constructor with db connection
    public function __construct($db) {
        $this->conn = $db;
    }

    //getting messages from database
    public function read(){
        //create query
        $query = 'SELECT
            g.id as groupid,
            m.id,
            m.user_name,
            m.content
            FROM
            ' . $this->table . ' m
            LEFT JOIN
                groups g ON m.group_id = g.id
                ORDER BY m.id DESC';
    
    //prepare stmt
    $stmt = $this->conn->prepare($query);
    //execute query
    $stmt->execute();

    return $stmt;
    }
    public function read_single(){
        $query = 'SELECT
            g.id as groupid,
            m.id,
            m.user_name,
            m.content
            FROM
            ' . $this->table . ' m
            LEFT JOIN
                groups g ON m.group_id = g.id
                WHERE m.id = ? LIMIT 1';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //bind param
        $stmt->bindParam(1, $this->id);
        //execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $row['user_name'];
        $this->groupid = $row['group_id'];
        $this->content = $row['content'];
    }
    public function create(){
        //creatrre query
        $query = 'INSERT INTO' . $this->table . 'SET user_name = :username, group_id = :groupid, content = :content';
        //prepare stmt
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->groupid  = htmlspecialchars(strip_tags($this->groupid));
        $this->content  = htmlspecialchars(strip_tags($this->content));
        //bind params
        $stmt -> bindParam(':username', $this->username);
        $stmt -> bindParam(':groupid', $this->groupid);
        $stmt -> bindParam(':content', $this->content);
        //execute query
        if($stmt->execute()){
            return true;
        }
        //print error
        printf("Error %s. \n", $stmt->error);
        return false;
    }

}