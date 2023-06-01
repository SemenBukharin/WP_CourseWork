<?php

session_start();
require_once 'vendor/dbConnect.php';

if (!$_SESSION['userId']) {
    header('Location: authorization.php');
}

$id = $_SESSION['userId'];
$res = $dbConnect->query("SELECT `firstName`, `secondName`, `patronymic`, `phoneNumber`, `email`, `root` FROM `users` WHERE `id` = '$id'");
$res = $res->fetch_assoc();
$name = $res['firstName'];
$surname = $res['secondName'];
$patronymic = $res['patronymic'];
$phone = $res['phoneNumber'];
$email = $res['email'];
$root = $res['root'];

$user = $surname . ' ' . $name . ' ' . $patronymic;

$title = 'Личный кабинет';
require ('components/head.php');
require ('components/editUserForm.php');
require ('components/footer.php');