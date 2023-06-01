<?php

session_start();
$t = $_GET['category'];

$title = $t;
$category= $t;
require ('components/head.php');
require ('components/categoryPageBody.php');
require ('components/footer.php');