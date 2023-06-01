<?php
    session_start();
    require_once 'dbConnect.php';

    $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
    $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
    $maxVisitors = filter_var(trim($_POST['maxVisitors']), FILTER_SANITIZE_STRING);
    $date = filter_var(trim($_POST['date']), FILTER_SANITIZE_STRING);
    $time = filter_var(trim($_POST['time']), FILTER_SANITIZE_STRING);
    $price = filter_var(trim($_POST['price']), FILTER_SANITIZE_STRING);
    $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
    $organizer = $_SESSION['userId'];
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
        $_SESSION['eventTitleError'] = "Введите название в указанном формате!";
        $errorsCount++;
    }
    if (mb_strlen($description) < 1 || mb_strlen($description) > 500) {
        $_SESSION['eventDescriptionError'] = "Введите описание в указанном формате!";
        $errorsCount++;
    }
    if (mb_strlen($address) < 1 || mb_strlen($address) > 500) {
        $_SESSION['eventAddressError'] = "Введите адрес в указанном формате!";
        $errorsCount++;
    }
    if ($maxVisitors < 0) {
        $_SESSION['eventVisitorsError'] = "Некорректное число участников";
        $errorsCount++;
    }
    if ($date<date("Y-m-d")) {
        $_SESSION['eventDateError'] = "Некорректная дата мероприятия";
        $errorsCount++;
    }
    if (mb_strlen($price) < 1 || mb_strlen($price) > 25) {
        $_SESSION['eventPriceError'] = "Некорректная стоимость участия";
        $errorsCount++;
    }

    $res = $dbConnect->query("SELECT `id` FROM `cities` WHERE `id` = '$city'");
    $res = $res->fetch_assoc();
    $cityId = $res['id'];

    if ($city == 0 || !$cityId) {
        $_SESSION['eventCityError'] = "Город не выбран!";
        echo "Город не выбран!";
        $errorsCount++;
    }

    $res = $dbConnect->query("SELECT `categoryName` FROM `categories` WHERE `categoryName` = '$category'");
    $res = $res->fetch_assoc();
    $catName = $res['categoryName'];

    if ($category == "0" || !$catName) {
        $_SESSION['eventCategoryError'] = "Категория не выбрана!";
        echo "Категория не выбрана!";
        echo $category;
        if ($catName) {echo "true";}
        $errorsCount++;
    }

    echo $errorsCount;

    if ($errorsCount==0){
        $dbConnect->query("INSERT INTO `events` (`title`, `category`, `city`, `address`, `description`, `date`, `time`, `organizer`, `price`, `maxVisitors`) VALUES('$title', '$category', '$city', '$address', '$description', '$date', '$time', '$organizer', '$price', '$maxVisitors')");

        $res = $dbConnect->query("SELECT MAX(`id`) AS 'id' FROM `events`");
        $res = $res->fetch_assoc();
        $eventId = $res['id'];
        echo $eventId;

        $imgsPath = '../img/' . $eventId . "/";
        mkdir($imgsPath);

        $uploaddir = $imgsPath;

        if ($_FILES['main_img']['size']>0 && ($_FILES['main_img']['type']=="image/png" || $_FILES['main_img']['type']=="image/jpeg")) {
            $uploadfile = $uploaddir . basename($_FILES['main_img']['name']);
            if (move_uploaded_file($_FILES['main_img']['tmp_name'], $uploadfile)) {
                $name = $_FILES['main_img']['name'];
                $dbConnect->query("INSERT INTO `images` (`event`, `image`, `mainImage`) VALUES('$eventId', '$name', '1')");
            }
        }

        if ($_FILES['image1']['size']>0 && ($_FILES['image1']['type']=="image/png" || $_FILES['image1']['type']=="image/jpeg")) {
            $uploadfile = $uploaddir . basename($_FILES['image1']['name']);
            if (move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile)) {
                $name = $_FILES['image1']['name'];
                $dbConnect->query("INSERT INTO `images` (`event`, `image`) VALUES('$eventId', '$name')");
            }
        }

        if ($_FILES['image2']['size']>0 && ($_FILES['image2']['type']=="image/png" || $_FILES['image2']['type']=="image/jpeg")) {
            $uploadfile = $uploaddir . basename($_FILES['image2']['name']);
            if (move_uploaded_file($_FILES['image2']['tmp_name'], $uploadfile)) {
                $name = $_FILES['image2']['name'];
               $dbConnect->query("INSERT INTO `images` (`event`, `image`) VALUES('$eventId', '$name')");
            }
        }

        $_SESSION['createEventStatus'] = "Мероприятие успешно предложено. Ожидайте публикации администратором!";
        unset($_SESSION['titleEvent']);
        unset($_SESSION['descriptionEvent']);
        unset($_SESSION['maxVisitorsEvent']);
        unset($_SESSION['dateEvent']);
        unset($_SESSION['timeEvent']);
        unset($_SESSION['priceEvent']);
        unset($_SESSION['addressEvent']);
        unset($_SESSION['cityEvent']);
        unset($_SESSION['categoryEvent']);
    }

    header('Location: ../createEvent.php');

// echo 'Некоторая отладочная информация:';
// print_r($_FILES);

// print "</pre>";

?>