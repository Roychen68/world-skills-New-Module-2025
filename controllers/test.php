<?php
/* @var PDO $pdo*/
include "db.php";
$contents = $pdo->query("SELECT `route`, `name`, `mail`, `rate`, `feedback` FROM `response`")->fetchAll();
$f = [];
$f[] = "route, name, mail, rate, feedback";
foreach ($contents as $item) {
    $f[] = implode(",",$item);
}
echo implode("\n",$f);