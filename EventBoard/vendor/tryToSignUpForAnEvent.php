<?php
require_once 'dbConnect.php';
session_start();

if (!$_SESSION['userId']){
	echo "0";
	exit();
}

$event = $_GET['q'];
$user = $_SESSION['userId'];

$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
$users_events_res = $users_events_res->fetch_assoc();
$users_on_event = $users_events_res["cnt"];

$user_on_event_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `user`='$user' AND `event`='$event'");
$user_on_event_res = $user_on_event_res->fetch_assoc();
$user_on_event = $user_on_event_res["cnt"];

if ($user_on_event == 1){
	$dbConnect->query("DELETE FROM `users_events` WHERE `user`='$user' AND `event`='$event'");

	$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
	$users_events_res = $users_events_res->fetch_assoc();
	$users_on_event = $users_events_res["cnt"];
	echo $users_on_event;
	exit();
}

$event_res = $dbConnect->query("SELECT * FROM `events` WHERE `id`='$event'");
$event_res = $event_res->fetch_assoc();
$event_max_visitors = $event_res["maxVisitors"];

if (($event_max_visitors > 0) AND ($event_max_visitors > $users_on_event)) {
	$dbConnect->query("INSERT INTO `users_events` (`user`, `event`) VALUES ('$user','$event')");

	$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
	$users_events_res = $users_events_res->fetch_assoc();
	$users_on_event = $users_events_res["cnt"];

	echo $users_on_event;
}
else {
	if ($event_max_visitors > 0){
		echo "Мест нет!";
	}
}

if ($event_max_visitors == 0) {
	$dbConnect->query("INSERT INTO `users_events` (`user`, `event`) VALUES ('$user','$event')");

	$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
	$users_events_res = $users_events_res->fetch_assoc();
	$users_on_event = $users_events_res["cnt"];
	echo $users_on_event;
}

?>