<?php

require("../models/ck_database.php");
require("../models/ck_workschedule.php");

session_start();

$work = new WorkSchedule();

$userId = isset($_SESSION['idNumber']) ? $_SESSION['idNumber'] : '';

if (isset($_POST['search'])) {
    $value = $_POST['value'];
    $workSched = $work->getTable($value, $userId);
} else {
    $workSched = $work->getTable("", $userId);
}

echo $workSched;
