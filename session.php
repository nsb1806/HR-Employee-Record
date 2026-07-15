<?php 
    include("db.php");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user_id'])) {
        if (file_exists('index.php')) {
            header("Location: index.php");
        } else {
            header("Location: " . (file_exists('../index.php') ? "../index.php" : "../../index.php"));
        }
        exit();
    }
?>