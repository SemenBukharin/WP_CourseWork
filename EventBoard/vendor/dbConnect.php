<?php
	$dbConnect = mysqli_connect('localhost', 'root', '', 'EventBoardDB');

	if (!$dbConnect){
		die('DB connection error!');
	}