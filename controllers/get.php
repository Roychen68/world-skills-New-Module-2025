<?php
/* @var PDO $pdo */
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case "route":
        $data = $pdo->query("SELECT * FROM `route`")->fetchAll(2);

        $results = [];
        for ($i = 0; $i < count($data); $i++) {
            $results[] = [
            "name" => $data[$i]['name'],
            "id" => $data[$i]['id'],
            "row" => $data[$i]['row'],
            "stations" => $pdo->query("SELECT COUNT(*) FROM `route-station` WHERE `route` = '{$data[$i]['id']}'")->fetchColumn(),
            ];
        }
        echo json_encode($results);
        break;
    case "bus":
        $results = $pdo->query("SELECT * FROM `bus`
        JOIN `route` ON `route`.`id` = `bus`.`route`")->fetchAll();
        echo json_encode($results);
        break;
    case "route-station":
        $results = $pdo->query("SELECT * FROM `route-station` WHERE `route` = '{$_POST['route']}'")->fetchAll(2);
        echo json_encode($results);
        break;
    case "map":
        $stations = $pdo->query("SELECT * FROM `route-station`
        JOIN `route` ON `route-station`.`route` = `route`.`id`
        JOIN `station` ON `route-station`.`station` = `station`.`id`
        WHERE `route-station`.`route` = '{$_POST['route']}'")->fetchAll();
        foreach ($stations as $key => $station) {
            $prev = $pdo->query("SELECT SUM(`need` + `stop`) FROM `route-station` WHERE `route` = '{$_POST['route']}' AND `station` < '{$station['station']}'")->fetchColumn();
            $leave = $prev + $station['need'];
            $arrive = $leave + $station['stop'];
            $bus = $pdo->query("SELECT * FROM `bus` WHERE `route` = '{$_POST['route']}' AND `time` <= '$leave' ORDER BY `time` DESC")->fetch();
            if (!empty($bus)) {
                if ($bus['time'] < $arrive) {
                    $station['class'] = '';
                    $station['bus'] = $bus['plate'] ."<br> 將在".($arrive - $bus['time'])."分鐘到站";
                } else {
                    $station['class'] = "text-danger";
                    $station['bus'] = "<br>已到站";
                }
            } else {
                $station['class'] = "text-secondary";
                $station['bus'] = "<br>未發車";
            }
            $stations[$key] = $station;
        }
        echo json_encode($stations);
        break;
    case "response":
        break;
    default:
        $results = $pdo->query("SELECT * FROM `$action`")->fetchAll(2);
        echo json_encode($results);
        break;
}