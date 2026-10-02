<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function wajibLogin()
{
    if (!isset($_SESSION['user'])) {
        header("Location: /perpus/auth/login.php");
        exit;
    }
}

function isAdmin()
{
    return isset($_SESSION['user']) &&
        in_array(
            $_SESSION['user']['role'],
            ['admin', 'petugas']
        );
}