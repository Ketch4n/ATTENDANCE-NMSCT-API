<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// header("Access-Control-Allow-Headers: X-Requested-With");
// header('X-Frame-Options: DENY');

$HostName = "localhost";
$DatabaseName = "attendance_monitoring";
$HostUser = "root";
$HostPass = "";

// $HostName = "localhost";
// $DatabaseName = "id21551497_attendance_nmscst";
// $HostUser = "id21551497_root";
// $HostPass = "1234@NMscST";

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
