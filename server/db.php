<?php

    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbName = 'php_note';

    $conn = mysqli_connect($serverName, $userName, $password, $dbName);

    if (!$conn) {
        die("Database connection error!\n".mysqli_connect_error());
    }

?>