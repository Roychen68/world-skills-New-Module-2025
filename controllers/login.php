<?php
/* @var PDO $pdo */
include "db.php";
session_start();
$login = $pdo->query("SELECT COUNT(*) FROM `admin` WHERE `username` = '{$_POST['form']['username']}' AND  `password` = '{$_POST['form']['password']}'")->fetchColumn();
if ($login) {
    $_SESSION['admin'] = true;
    echo true;
} else {
    echo false;
}