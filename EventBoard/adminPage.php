<?php

session_start();

if ($_SESSION['userRoot']!=1){
	header('Location: userPage.php');
}

$title = 'Панель администратора';
require ('components/head.php');
require ('components/adminPageBody.php');
require ('components/footer.php');