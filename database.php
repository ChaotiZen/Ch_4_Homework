<?php
    $dsn = 'mysql:host=localhost;dbname=chapter_4_homework';
    $username = 'root';
    //$password = 'pa55word';

    try {
        $db = new PDO($dsn, $username);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>