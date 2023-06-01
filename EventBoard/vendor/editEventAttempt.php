<?php
    session_start();
    require_once 'dbConnect.php';

    $eventId=$_SESSION['eventEdited'];
    $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
    $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
    $maxVisitors = filter_var(trim($_POST['maxVisitors']), FILTER_SANITIZE_STRING);
    $date = filter_var(trim($_POST['date']), FILTER_SANITIZE_STRING);
    $time = filter_var(trim($_POST['time']), FILTER_SANITIZE_STRING);
    $price = filter_var(trim($_POST['price']), FILTER_SANITIZE_STRING);
    $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
    $city = filter_var(trim($_POST['city']), FILTER_SANITIZE_STRING);
    $category = filter_var(trim($_POST['category']), FILTER_SANITIZE_STRING);

    $_SESSION['titleEvent'] = $title;
    $_SESSION['descriptionEvent'] = $description;
    $_SESSION['maxVisitorsEvent'] = $maxVisitors;
    $_SESSION['dateEvent'] = $date;
    $_SESSION['timeEvent'] = $time;
    $_SESSION['priceEvent'] = $price;
    $_SESSION['addressEvent'] = $address;
    $_SESSION['cityEvent'] = $city;
    $_SESSION['categoryEvent'] = $category;

    // echo $title . $description . $maxVisitors;
    // echo $date;
    // echo $time;
    //


    $errorsCount = 0;
    if (mb_strlen($title) < 1 || mb_strlen($name) > 50) {
        $_SESSION['editEventTitleError'] = "Введите название в указанном формате!";
        $errorsCount++;
    }
    if (mb_strlen($description) < 1 || mb_strlen($description) > 500) {
        $_SESSION['editEventDescriptionError'] = "Введите описание в указанном формате!";
        $errorsCount++;
    }
    if (mb_strlen($address) < 1 || mb_strlen($address) > 500) {
        $_SESSION['editEventAddressError'] = "Введите адрес в указанном формате!";
        $errorsCount++;
    }
    if ($maxVisitors < 0) {
        $_SESSION['editEventVisitorsError'] = "Некорректное число участников";
        $errorsCount++;
    }
    if ($date<date("Y-m-d")) {
        $_SESSION['editEventDateError'] = "Некорректная дата мероприятия";
        $errorsCount++;
    }
    if (mb_strlen($price) < 1 || mb_strlen($price) > 25) {
        $_SESSION['editEventPriceError'] = "Некорректная стоимость участия";
        $errorsCount++;
    }

    $res = $dbConnect->query("SELECT `id` FROM `cities` WHERE `id` = '$city'");
    $res = $res->fetch_assoc();
    $cityId = $res['id'];

    if ($city == 0 || !$cityId) {
        $_SESSION['editEventCityError'] = "Город не выбран!";
        echo "Город не выбран!";
        $errorsCount++;
    }

    $res = $dbConnect->query("SELECT `categoryName` FROM `categories` WHERE `categoryName` = '$category'");
    $res = $res->fetch_assoc();
    $catName = $res['categoryName'];

    if ($category == "0" || !$catName) {
        $_SESSION['editEventCategoryError'] = "Категория не выбрана!";
        echo "Категория не выбрана!";
        echo $category;
        if ($catName) {echo "true";}
        $errorsCount++;
    }

    echo $errorsCount;

    if ($errorsCount==0){
        $dbConnect->query("UPDATE `events` SET `title`='$title', `category`='$category', `city`='$city', `address`='$address', `description`='$description', `date`='$date', `time`='$time', `price`='$price', `maxVisitors`='$maxVisitors', `published`='1', `editDate`=NOW() WHERE `id`=$eventId");


        $_SESSION['createEventStatus'] = "Мероприятие успешно опубликовано!";
        unset($_SESSION['titleEvent']);
        unset($_SESSION['descriptionEvent']);
        unset($_SESSION['maxVisitorsEvent']);
        unset($_SESSION['dateEvent']);
        unset($_SESSION['timeEvent']);
        unset($_SESSION['priceEvent']);
        unset($_SESSION['addressEvent']);
        unset($_SESSION['cityEvent']);
        unset($_SESSION['categoryEvent']);
        unset($_SESSION['eventEdited']);
        header('Location: ../adminPage.php');
    }

    header('Location: ../adminPage.php');

// echo 'Некоторая отладочная информация:';
// print_r($_FILES);

// print "</pre>";

?>