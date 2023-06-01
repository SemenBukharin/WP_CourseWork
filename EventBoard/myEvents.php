<?php

session_start();

if (!$_SESSION['userId']){
	header('Location: authorization.php');
}

$title = 'Я участвую!';
require ('components/head.php');
require ('components/myEventsBody.php');
require ('components/footer.php');