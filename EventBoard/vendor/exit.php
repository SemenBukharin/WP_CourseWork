<?php
	session_start();
	unset($_SESSION['userId']);
	unset($_SESSION['userId']);
	unset($_SESSION['userRoot']);
	unset($_SESSION['name']);
	unset($_SESSION['surname']);
	unset($_SESSION['patronymic']);
	unset($_SESSION['phone']);
	unset($_SESSION['email']);
	unset($_SESSION['loggedUser']);
	header('Location: ../authorization.php');
?>