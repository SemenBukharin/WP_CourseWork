<?php

session_start();
require_once 'vendor/dbConnect.php';

if (!$_SESSION['userId']) {
    header('Location: authorization.php');
}


$eventId = $_GET['event'];
$res = $dbConnect->query("SELECT * FROM `events`JOIN `users` ON users.id = events.organizer WHERE events.`id` = '$eventId' AND `published`=0");
$res = $res->fetch_assoc();

$_SESSION['eventEdited'] = $eventId;

$title = 'Предпросмотр ' . $res['title'];
require ('components/head.php');
require ('components/editEventForm.php');
require ('components/footer.php');