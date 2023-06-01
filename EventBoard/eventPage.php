<?php

session_start();
require_once 'vendor/dbConnect.php';

$eventId = $_GET['event'];

$eventId = $_GET['event'];
$res = $dbConnect->query("SELECT * FROM `events` WHERE events.`id` = '$eventId' AND `published`=1");
$res = $res->fetch_assoc();

$category = $res["category"];
$title = $res['title'];
$price = $res['price'];
$address = $res['address'];
$date = $res['date'];
$time = $res['time'];
$cityId = $res['city'];
$visitorsMax = $res['maxVisitors'];
if ($visitorsMax==0){
	$visitorsMax = "∞";
}

$description = $res['description'];
require ('components/head.php');
require ('components/eventBody.php');
require ('components/footer.php');