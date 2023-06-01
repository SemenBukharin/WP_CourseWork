<?php

session_start();

if (!$_SESSION['userId']) {
    header('Location: authorization.php');
}

$title = 'Главная страница';
require ('components/head.php');
require ('components/createEventForm.php');
require ('components/footer.php');