<?php

session_start();

if ($_SESSION['userId']){
	header('Location: userPage.php');
}

$title = 'Регистрация';
require ('components/head.php');
require ('components/authFormBody.php');
require ('components/footer.php');