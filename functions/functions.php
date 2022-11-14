<?php
// Establish Connection to Database
define("DB_HOST", "db");
define("DB_USER", "mysql_user");
define("DB_PASSWORD", "");
define("DB_DATABASE", "mysqldb");

function connect() {
    static $conn;
    if ($conn === NULL){ 
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, 9906);
        if ($conn->connect_error) {
            die("connection failed: " . $conn->connect_error);
        } else {
            echo "Connected to mysql server successfully!";
        }
    }
    return $conn;
}

?>