<?php
include 'header.php';

// $HostName = "localhost";
// $DatabaseName = "attendance_monitoring";
// $HostUser = "root";
// $HostPass = "";

$HostName = "localhost";
$DatabaseName = "id21551497_attendance_nmscst";
$HostUser = "id21551497_root";
$HostPass = "1234@NMscST";

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
