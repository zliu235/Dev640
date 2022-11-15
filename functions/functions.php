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
            $sql = file_get_contents('database/DDL.sql');
            $res = mysqli_query($conn, $sql);

            echo "res: " . ($res ? 'true' : 'false');
            echo "error: " . ($conn->error);
        }
    }
    return $conn;
}

?>