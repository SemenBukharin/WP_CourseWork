<?php
	session_start();
	require_once 'dbConnect.php';

	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

	$_SESSION['authEmail'] = $email;

	//$mysql = new  mysqli('localhost', 'root', '', 'RegAuth');

	$result = $dbConnect->query("SELECT * FROM `users` WHERE `email` = '$email'");

	$result = $result->fetch_assoc();

	password_verify($password, $result['password']);

	if (count($result) == 0 || !password_verify($password, $result['password'])) {
		$_SESSION['authorizationError'] = "Неверно указана почта или пароль!";
		header('Location: ../authorization.php');
		exit();
	}

	$name = $result['name'] . " " . $result['surname'];
	$_SESSION['userFullName'] = $name;

	$res = $dbConnect->query("SELECT `id`, `root` FROM `users` WHERE `email` = '$email'");
	$res = $res->fetch_assoc();
	$id = $res['id'];
	$root = $res['root'];
	$_SESSION['userId'] = $id;
	$_SESSION['userRoot'] = $root;

	unset($_SESSION['authEmail']);

	header('Location: ../userPage.php');
?>