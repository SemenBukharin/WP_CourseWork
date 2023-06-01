<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ru" class="min-vh-100">
    <head>

        <title> <?= $title; ?> - EventBoard</title>

        <!-- Bootstrap CSS (jsDelivr CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link href="css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <script src="../js/scripts.js"></script>
        <link rel="icon" type="image/x-icon" href="../favicon.ico">

    </head>
    <body class="bg-main min-vh-100 d-flex flex-column justify-content-between">
            <nav class="navbar  bg-mainGreen  sticky-top-large border-bottom border-4 border-dark px-4 d-flex justify-content-around" style="min-height: 10vh;">
                    <a href="index.php" class="no-underline navbar-brand m-0">
                        <div class="d-flex justify-content-center align-items-center">
                            <div>
                                <h1 class="my-0"><span class="text-light">EVENT</span><span class="text-danger">BOARD</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 32 32"><path fill="white" d="M26 14h-2v2h2a3.003 3.003 0 0 1 3 3v4h2v-4a5.006 5.006 0 0 0-5-5zM24 4a3 3 0 1 1-3 3a3 3 0 0 1 3-3m0-2a5 5 0 1 0 5 5a5 5 0 0 0-5-5zm-1 28h-2v-2a3.003 3.003 0 0 0-3-3h-4a3.003 3.003 0 0 0-3 3v2H9v-2a5.006 5.006 0 0 1 5-5h4a5.006 5.006 0 0 1 5 5zm-7-17a3 3 0 1 1-3 3a3 3 0 0 1 3-3m0-2a5 5 0 1 0 5 5a5 5 0 0 0-5-5zm-8 3H6a5.006 5.006 0 0 0-5 5v4h2v-4a3.003 3.003 0 0 1 3-3h2zM8 4a3 3 0 1 1-3 3a3 3 0 0 1 3-3m0-2a5 5 0 1 0 5 5a5 5 0 0 0-5-5z"/></svg>
                                </h1>
                            </div>
                        </div>
                    </a>

                    <div class="d-flex justify-content-center flex-wrap align-items-center min-h-50">
                        <div class="d-flex justify-content-center  align-items-center mt-1">
                            <select name="city" onchange="setCity()" id="selectedCity" class="form-select form-select-lg rounded-pill" style="min-width: 254px;">
                                <option value="0">Выберите город</option>
                                <?php
                                    require_once './vendor/dbConnect.php';

                                    $cities = $dbConnect->query("select `id`, `city` from `cities`");
                                    while($row = $cities->fetch_assoc()){
                                        ?>
                                            <option value="<?=$row['id']?>" <?php if ($_SESSION['cityId'] == $row['id']) {echo "selected";} ?> ><?=$row['city']?></option>
                                        <?
                                    }
                                ?>

                            </select>

                        </div>

                        <div class="d-flex justify-content-center align-items-center mx-2 mt-1">
                        <a href="../createEvent.php" class="no-underline px-0"><div class="form-select form-select-lg rounded-pill px-1 text-no-wrap" style="background-image: none; min-width: 254px;"> <p class="m-0"> Предложить мероприятие </p> </div></a>
                        </div>

                        <a href="./authorization.php" class="mx-2 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24"><path fill="white" d="M12 19.2c-2.5 0-4.71-1.28-6-3.2c.03-2 4-3.1 6-3.1s5.97 1.1 6 3.1a7.232 7.232 0 0 1-6 3.2M12 5a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-3A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10c0-5.53-4.5-10-10-10Z"/></svg>
                        </a>

                    </div>
            </nav>
            <div class="d-flex flex-column justify-content-center align-items-center">

