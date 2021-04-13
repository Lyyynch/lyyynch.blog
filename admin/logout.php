<?php
session_start();

session_unset();
session_destroy();

header("Location: /lyyynch.blog/admin/login.php");
exit;