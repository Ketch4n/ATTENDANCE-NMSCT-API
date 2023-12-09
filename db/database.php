<?php
header("Access-Control-Allow-Origin", "*");
header("Access-Control-Allow-Methods", "GET,PUT,PATCH,POST,DELETE");
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

// $HostName = "localhost";
// $DatabaseName = "attendance_monitoring";
// $HostUser = "root";
// $HostPass = "";

$HostName = "localhost";
$DatabaseName = "id21551497_attendance_nmscst";
$HostUser = "id21551497_root";
$HostPass = "1234@NMscST";

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
