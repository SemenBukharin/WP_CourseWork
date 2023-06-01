<?php
	session_start();
	require_once 'dbConnect.php';

	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
	$patronymic = filter_var(trim($_POST['patronymic']), FILTER_SANITIZE_STRING);
	$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

	$_SESSION['name'] = $name;
	$_SESSION['surname'] = $surname;
	$_SESSION['patronymic'] = $surname;
	$_SESSION['email'] = $email;
	$_SESSION['phone'] = $phone;

	$password_pattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}/";
	$phone_pattern = "/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/";
	// Зеленый свет для:
	// +79261234567
	// 89261234567
	// 79261234567
	// +7 926 123 45 67
	// 8(926)123-45-67
	// 123-45-67
	// 9261234567
	// 79261234567
	// (495)1234567
	// (495) 123 45 67
	// 89261234567
	// 8-926-123-45-67
	// 8 927 1234 234
	// 8 927 12 12 888
	// 8 927 12 555 12
	// 8 927 123 8 123

	$errorsCount = 0;
	if (mb_strlen($name) < 2 || mb_strlen($name) > 15) {
		$_SESSION['nameError'] = "Введите имя в указанном формате!";
		$errorsCount++;
	}
	if (mb_strlen($surname) < 2 || mb_strlen($surname) > 15) {
		$_SESSION['surnameError'] = "Введите фамилию в указанном формате!";
		$errorsCount++;
	}
	if ((mb_strlen($patronymic) < 2 || mb_strlen($patronymic) > 15) && mb_strlen($patronymic)!=0) {
		$_SESSION['patronymicError'] = "Введите отчество в указанном формате!";
		$errorsCount++;
	}
	if (! preg_match($password_pattern, $password)) {
		$_SESSION['passwordError'] = "Введите пароль в указанном формате!";
		$errorsCount++;
	}
	if (! preg_match($phone_pattern, $phone)) {
		$_SESSION['phoneError'] = "Номер телефона не распознан!";
		$errorsCount++;
	}
	//todo номер телефона

	echo $errorsCount;

	if ($errorsCount==0){
		$password = password_hash($password, PASSWORD_DEFAULT);

		$user_exist = $dbConnect->query("SELECT * FROM `users` WHERE `email` = '$email'");

		$user_exist = $user_exist->fetch_assoc();
		if ($user_exist){
			$_SESSION['emailStatus'] = "E-mail уже используется!";
			echo "email in use";
			$errorsCount++;
		}

		if ($errorsCount==0){
			$dbConnect->query("INSERT INTO `users` (`firstName`, `secondName`, `patronymic`, `phoneNumber`, `email`, `password`) VALUES('$name', '$surname', '$patronymic', '$phone', '$email', '$password')");
			// echo $name;
			// echo $surname;
			// echo $patronymic;
			// echo $phone;
			// echo $email;
			// echo $password;

			unset($_SESSION['name']);
			unset($_SESSION['surname']);
			unset($_SESSION['patronymic']);
			unset($_SESSION['phone']);
			unset($_SESSION['email']);
			header('Location: ../registration.php');
		}
		else {

		}


		$_SESSION['loggedUser'] = $name . ' ' . $surname;



		//header('Location: /');
		//
	}

	//header('Location: ../authorization.php');

		// unset($_SESSION['name']);
		// unset($_SESSION['surname']);
		// unset($_SESSION['login']);
		// unset($_SESSION['email']);
		// unset($_SESSION['adult']);
		// unset($_SESSION['sex']);

?>