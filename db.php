<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'blog');

if ($mysqli->connect_errno) {
    printf("connection failed: %s\n", $mysqli->connect_errno());
    exit();
}