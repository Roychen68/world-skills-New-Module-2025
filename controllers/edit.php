<?php
/* @var PDO $pdo */
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case "station":
        $exist = $pdo->query("SELECT * FROM `station` WHERE `name` = '{$_POST['form']['name']}' AND `id` != '{$_POST['form']['id']}'")->fetchColumn();
        if ($exist) {
            echo "Station exist already!";
        } else {
            $pdo->query("UPDATE `station` SET `name`= '{$_POST['form']['name']}' WHERE `id` = '{$_POST['form']['id']}'");
            echo "Station just edit successfully";
        }
        break;
    case "bus":
            $pdo->query("UPDATE `bus` SET `time`= '{$_POST['form']['time']}' WHERE `id` = '{$_POST['form']['id']}'");
            echo "Bus just edit successfully";
        break;
    case "basic":
        if ($_POST['type'] == 'time') {
            $pdo->query("UPDATE `basic` SET `start`='{$_POST['form']['start']}',`end`='{$_POST['form']['end']}' WHERE 1");
        } else {
            $form = $pdo->query("SELECT `form` FROM `basic` WHERE 1")->fetchColumn();
            if ($form == 1) {
                $pdo->query("UPDATE `basic` SET `form`='0' WHERE 1");
            } else {
                $pdo->query("UPDATE `basic` SET `form`='1' WHERE 1");
            }
        }
        break;
    case "route":
        $exist = $pdo->query("SELECT * FROM `route` WHERE `name` = '{$_POST['form']['name']}' AND `id` != '{$_POST['form']['id']}'")->fetchColumn();
        if ($exist) {
            echo "Route exist already!";
        } else {
            $pdo->query("INSERT INTO `route`(`name`,`row`) VALUES ('{$_POST['form']['name']}','{$_POST['form']['row']}')");
            $pdo->query("DELETE FROM `route-station` WHERE `route` = '{$_POST['form']['id']}'");
            $pdo->query("DELETE FROM `route` WHERE `ID` = '{$_POST['form']['id']}'");
            $route = $pdo->query("SELECT * FROM `route` WHERE `name` = '{$_POST['form']['name']}'")->fetchColumn();
            foreach ($_POST['stations'] as $station) {
                $pdo->query("INSERT INTO `route-station`(`station`, `need`, `stop`, `route`) VALUES ('{$station['station']}','{$station['need']}','{$station['stop']}','$route')");
            }
            echo "Route just add successfully";
        }
        break;
}