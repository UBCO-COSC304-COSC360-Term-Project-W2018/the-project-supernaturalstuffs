<?php
        $user = "60186160";
        $pass = "Cosc360!";
        $db = "db_" . $user;
        $host = "localhost";
        $charset = "utf8";
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
        ];
?>
