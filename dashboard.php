<?php

require_once __DIR__ . '/Config/database.php';
require_once __DIR__ . '/Includes/auth.php';

wajibLogin();

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>

<h1>Dashboard Perpustakaan</h1>

<p>
    Selamat datang,
    <b><?= e($_SESSION['user']['username']) ?></b>
</p>

<p>
    Role:
    <b><?= e($_SESSION['user']['role']) ?></b>
</p>

<p>
    <a href="/perpus/auth/logout.php">
        Logout
    </a>
</p>

</body>
</html>