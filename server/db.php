<?php

    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbName = 'php_note';

    // $serverName = 'localhost';
    // $userName = 'iamhalim_iamhalim';
    // $password = '2qt,mk_!g!n!';
    // $dbName = 'iamhalim_php_note';

    $conn = mysqli_connect($serverName, $userName, $password, $dbName);

    if (!$conn) {
        die("Database connection error!\n".mysqli_connect_error());
    }

?>