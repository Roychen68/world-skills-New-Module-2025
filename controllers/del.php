<?php
/* @var PDO $pdo */
include "db.php";

$action = $_POST['action'];
switch ($action) {
//    case "route":
//        $data = $pdo->query("")->fetchAll();
//        break;
    default:
        $pdo->query("DELETE FROM `$action` WHERE `id` = '{$_POST['id']}'")->fetchAll(2);
        break;
}