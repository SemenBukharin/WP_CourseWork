<?php
	session_start();
	require_once 'dbConnect.php';

	$id = $_SESSION['userId'];
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
	$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);

	$_SESSION['email'] = $email;
	$_SESSION['phone'] = $phone;

	$password_pattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}/";
	$phone_pattern = "/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/";

	$errorsCount = 0;

	if (! preg_match($password_pattern, $password) && $password) {
		$_SESSION['passwordError'] = "Введите пароль в указанном формате!";
		$errorsCount++;
	}
	if (! preg_match($phone_pattern, $phone)) {
		$_SESSION['phoneError'] = "Номер телефона не распознан!";
		$errorsCount++;
	}

	echo $errorsCount;

	if ($errorsCount==0){

		$user_exist = $dbConnect->query("SELECT `id` FROM `users` WHERE `email` = '$email'");

		$user_exist = $user_exist->fetch_assoc();
		if ($user_exist && $id!=$user_exist['id']){
			$_SESSION['emailStatus'] = "E-mail уже используется!";
			echo "email in use";
			$errorsCount++;
		}

		if ($errorsCount==0){

			if ($password) {
				$password = password_hash($password, PASSWORD_DEFAULT);
				$dbConnect->query("UPDATE `users` SET `password` = '$password', `email` = '$email', `phoneNumber` = '$phone' WHERE `id` = '$id'");
			}
			else {
				$dbConnect->query("UPDATE `users` SET `email` = '$email', `phoneNumber` = '$phone' WHERE `id` = '$id'");
			}


			$dbConnect->query("INSERT INTO `users` (`firstName`, `secondName`, `patronymic`, `phoneNumber`, `email`, `password`) VALUES('$name', '$surname', '$patronymic', '$phone', '$email', '$password')");
			// echo $name;
			// echo $surname;
			// echo $patronymic;
			// echo $phone;
			// echo $email;
			// echo $password;

			unset($_SESSION['phone']);
			unset($_SESSION['email']);
			$_SESSION['updateStatus'] = "Обновление данных прошло успешно!";
			header('Location: ../userPage.php');
		}
		else {
			header('Location: ../userPage.php');
		}


		//$_SESSION['loggedUser'] = $name . ' ' . $surname;



		//header('Location: /');
		//
	}
?>
