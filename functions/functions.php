<?php
// Establish Connection to Database
define("DB_HOST", "db");
define("DB_USER", "root");
define("DB_PASSWORD", "root_password");
define("DB_DATABASE", "mysqldb");

function connect() {
    static $conn;
    if ($conn === NULL){ 
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, 3306);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die("connection failed: " . $conn->connect_error);
        } else {
            echo "Connected to mysql server successfully!";
            // $sql = file_get_contents('database/DDL.sql');
            $create_users = "CREATE TABLE if not exists users (
                user_id             INT(11) NOT NULL AUTO_INCREMENT,
                user_firstname      VARCHAR(20) NOT NULL,  
                user_lastname       VARCHAR(20) NOT NULL,
                user_nickname       VARCHAR(20),
                user_password       VARCHAR(255) NOT NULL,
                user_email          VARCHAR(255) NOT NULL,
                user_gender         CHAR(1) NOT NULL,
                user_birthdate      DATE NOT NULL,    
                user_status         CHAR(1),
                user_about          TEXT,
                user_hometown       VARCHAR(255),
                PRIMARY KEY (user_id)
                );";

            $create_friendship = "CREATE TABLE if not exists friendship (
                user1_id            INT NOT NULL,
                user2_id            INT NOT NULL,
                friendship_status   INT NOT NULL,
                FOREIGN KEY (user1_id) REFERENCES users(user_id),
                FOREIGN KEY (user2_id) REFERENCES users(user_id)
                );";
            
            $create_posts = "CREATE TABLE if not exists posts (
                post_id             INT(11) NOT NULL AUTO_INCREMENT,
                post_caption        TEXT NOT NULL,
                post_time           TIMESTAMP NOT NULL, 
                post_public         CHAR(1) NOT NULL,
                post_by             INT NOT NULL,
                PRIMARY KEY (post_id),
                FOREIGN KEY (post_by) REFERENCES users(user_id)
                );
                ";
            $create_user_phone = "CREATE TABLE if not exists user_phone (
                user_id         INT,
                user_phone      INT,
                FOREIGN KEY (user_id) REFERENCES users(user_id)
                );";

            $res = mysqli_query($conn, $create_users);
            $res = mysqli_query($conn, $create_friendship);
            $res = mysqli_query($conn, $create_posts);
            $res = mysqli_query($conn, $create_user_phone);

            // For debug
            echo "res: " . ($res ? 'true' : 'false');
            echo "error: " . ($conn->error);
        }
    }
    return $conn;
}

?>