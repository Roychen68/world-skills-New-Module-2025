<?php
/* @var PDO $pdo */
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case "station":
        $exist = $pdo->query("SELECT * FROM `station` WHERE `name` = '{$_POST['form']['name']}'")->fetchColumn();
        if ($exist) {
            echo "Station exist already!";
        } else {
            $pdo->query("INSERT INTO `station`(`name`) VALUES ('{$_POST['form']['name']}')");
            echo "Station just add successfully";
        }
        break;
    case "bus":
        $exist = $pdo->query("SELECT * FROM `bus` WHERE `plate` = '{$_POST['form']['plate']}'")->fetchColumn();
        if ($exist) {
            echo "Bus exist already!";
        } else {
            $pdo->query("INSERT INTO `bus`(`plate`,`route`,`time`) VALUES ('{$_POST['form']['plate']}','{$_POST['form']['route']}','{$_POST['form']['time']}')");
            echo "Bus just add successfully";
        }
        break;
    case "route":
        $exist = $pdo->query("SELECT * FROM `route` WHERE `name` = '{$_POST['form']['name']}'")->fetchColumn();
        if ($exist) {
            echo "Route exist already!";
        } else {
            $pdo->query("INSERT INTO `route`(`name`,`row`) VALUES ('{$_POST['form']['name']}','{$_POST['form']['row']}')");
            $route = $pdo->query("SELECT * FROM `route` WHERE `name` = '{$_POST['form']['name']}'")->fetchColumn();
            foreach ($_POST['stations'] as $station) {
                $pdo->query("INSERT INTO `route-station`(`station`, `need`, `stop`, `route`) VALUES ('{$station['station']}','{$station['need']}','{$station['stop']}','$route')");
            }
            echo "Route just add successfully";
        }
        break;
    case "response":
        $now = date("Y-m-d H:i:s");
        $basic = $pdo->query("SELECT `start`, `end`, `form` FROM `basic` WHERE 1")->fetch();
        $form = $basic['form'];
        $start = $basic['start'];
        $end = $basic['end'];
        if ($form == 0){
            echo "This form is currently not accepting responses";
            return;
        }
        if ($start < $now && $now > $end){
            echo "This form is currently not within the response period";
            return;
        }
        $pdo->query("INSERT INTO `response`(`route`, `name`, `mail`, `rate`, `feedback`) VALUES 
        ('{$_POST['form']['route']}','{$_POST['form']['name']}','{$_POST['form']['mail']}','{$_POST['form']['rate']}','{$_POST['form']['feedback']}')");
        echo "Response Submitted successfully";
        break;
}