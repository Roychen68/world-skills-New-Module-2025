<?php
/* @var PDO $pdo */
include "db.php";

$data = $pdo->query("SELECT * FROM `route`")->fetchAll(2);

$results = [];
for ($i = 0; $i < count($data); $i++) {
    $results["routes"][] = [
        "name" => $data[$i]['name'],
        "stations" => $pdo->query("SELECT COUNT(*) FROM `route-station` WHERE `route` = '{$data[$i]['id']}'")->fetchColumn(),
    ];
}
echo json_encode($results);