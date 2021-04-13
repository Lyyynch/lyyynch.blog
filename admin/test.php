<?php
    session_start();

    if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
        header("Location: /lyyynch.blog/admin/login.php");
        exit;
    }
?>

<h1>hey</h1>