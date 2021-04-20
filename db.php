<?php

$mysqli = new mysqli(
    env('DB_HOST', '127.0.0.1'),
    env('DB_USER', 'root'),
    env('DB_PASS', ''),
    env('DB_NAME', 'blog')
);

if ($mysqli->connect_errno) {
    printf("connection failed: %s\n", $mysqli->connect_errno());
    exit();
}