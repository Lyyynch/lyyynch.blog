<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/lyyynch.blog/db.php';

$rowsQuery = "SELECT blog_posts.*, CONCAT(users.first_name, ' ', users.last_name) AS user_name
            FROM blog_posts
            INNER JOIN users ON blog_posts.author_id = users.id
            ORDER BY created_at DESC";
$rowsResult = $mysqli->query($rowsQuery);

$perPage = 4;
if (!empty($_GET) && $_GET['page']) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$totalRows = $rowsResult->num_rows;

$lastPage = ceil($totalRows / $perPage);
$validPage = min($lastPage, $page);
$offset = ($validPage - 1) * $perPage;

$postsPageQuery = "SELECT blog_posts.*, CONCAT(users.first_name, ' ', users.last_name) AS user_name
                FROM blog_posts
                INNER JOIN users ON blog_posts.author_id = users.id
                ORDER BY created_at DESC
                LIMIT $perPage OFFSET ".$offset;
$postsPageResults = $mysqli->query($postsPageQuery);




$homePageQuery = "SELECT blog_posts.*, CONCAT(users.first_name, ' ', users.last_name) AS user_name
                FROM blog_posts
                INNER JOIN users ON blog_posts.author_id = users.id
                ORDER BY created_at DESC
                LIMIT 3";
$homePageResults = $mysqli->query($homePageQuery);