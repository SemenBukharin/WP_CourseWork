<div class="bg-white-body br-10 d-flex flex-column w-75 my-4" style="max-width:720px">
	<form enctype="multipart/form-data" id="form" class="m-3 p-0" action="./vendor/editEventAttempt.php" method="post"">

            <div class="d-flex justify-content-center">
                <div class="my-2 rounded-pill bg-mainGreen text-white minh-50px minw-220px text-center"> <h4 class="mt-2 mx-2">Предварительный просмотр мероприятия</h4></div>
            </div>

            <div class="d-flex w-100 justify-content-start flex-wrap">
                <a  class="no-underline link-white my-2 mx-3" href="./index.php">
                    <div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:150px; height: 35px">
                        <p class="mt-1">
                            Главная
                        </p>
                    </div>
                </a>
                <div class="d-flex my-2 justify-content-center text-dark" style="width:2rem; height: 35px">
                    <h4 class="mt-1">-></h4>
                </div>
                <a  class="no-underline link-white my-2 mx-3" href="userPage.php">
                    <div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:150px; height: 35px">
                        <p class="mt-1">
                            Личный кабинет
                        </p>
                    </div>
                </a>
                <div class="d-flex my-2 justify-content-center text-dark" style="width:2rem; height: 35px">
                    <h4 class="mt-1">-></h4>
                </div>
                <a  class="no-underline link-white my-2 mx-3" href="./adminPage.php">
                    <div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:180px; height: 35px">
                        <p class="mt-1">
                            Панель администратора
                        </p>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <label for="inputTitle" class="form-label text-dark"><b>Название*</b></label>
                <input type="text" maxlength="50" class="form-control border-4 br-0 border-mainGreen" id="inputTitle" name="title" aria-describedby="titleHelp" required autocomplete="off"
                value="<?=$res['title']?>"
                >
            </div>

            <div class="mb-3 d-flex justify-content-around flex-wrap">
                <div>
                    <label for="categorySelect" class="form-label text-dark"><b>Категория*</b></label>
                    <select name="category" id="categorySelect" class="form-select form-control border-4 br-0 border-mainGreen minw-220px" style="min-width: 254px;">
                        <option value="0">Выберите категорию</option>
                        <?php
                            //require_once './vendor/dbConnect.php';

                            $categories = $dbConnect->query("SELECT `categoryName` FROM `categories`");
                            while($row = $categories->fetch_assoc()){
                                ?>
                                    <option value="<?=$row['categoryName']?>"
                                    <?php
                                        if ($row['categoryName'] == $res['category']) {
                                            echo "selected";
                                        }
                                    ?>
                                    ><?=$row['categoryName']?></option>
                                <?
                            }
                        ?>
                    </select>
                    <?php
                    if ($_SESSION['editEventCategoryError']) {
                            echo '<div id="editEventCategoryError" class="form-text text-danger">' . $_SESSION['editEventCategoryError'] . '</div>';
                        }
                        unset($_SESSION['editEventCategoryError']);
                    ?>
                </div>
                <div>
                    <label for="citySelect" class="form-label text-dark"><b>Город*</b></label>
                    <select name="city" id="citySelect" class="form-select form-control border-4 br-0 border-mainGreen minw-220px" style="min-width: 254px;">
                        <option value="0">Выберите город</option>
                        <?php
                            require_once './vendor/dbConnect.php';

                            $cities = $dbConnect->query("select `id`, `city` from `cities`");
                            while($row = $cities->fetch_assoc()){
                                ?>
                                    <option value="<?=$row['id']?>"
                                    <?php
                                    if ($row['id'] == $res['city']) {
                                            echo "selected";
                                        }
                                    ?>
                                    ><?=$row['city']?></option>
                                <?
                            }
                        ?>
                    </select>
                    <?php
                    if ($_SESSION['editEventCityError']) {
                            echo '<div id="editEventCityError" class="form-text text-danger">' . $_SESSION['editEventCityError'] . '</div>';
                        }
                        unset($_SESSION['editEventCityError']);
                    ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="inputAddress" class="form-label text-dark"><b>Адрес*</b></label>
                <input type="text" maxlength="500" class="form-control border-4 br-0 border-mainGreen" id="inputAddress" name="address" aria-describedby="titleHelp" required autocomplete="off"
                value="<?=$res['address']?>"
                >
                <?php
                    if ($_SESSION['editEventAddressError']) {
                        echo '<div id="editEventAddressError" class="form-text text-danger">' . $_SESSION['editEventAddressError'] . '</div>';
                    }
                    unset($_SESSION['editEventAddressError']);
                ?>
            </div>

            <div class="mb-3">
                <label for="inputDescription" class="form-label text-dark"><b>Описание (до 500 символов)*</b></label>
                <textarea rows="8" maxlength="500" class="form-control border-4 br-0 border-mainGreen minh-200px" id="inputDescription" name="description" aria-describedby="descriptionHelp" required autocomplete="off"><?php echo $res['description'];?></textarea>
                <?php
                    if ($_SESSION['eventDescriptionError']) {
                        echo '<div id="eventDescriptionError" class="form-text text-danger">' . $_SESSION['eventDescriptionError'] . '</div>';
                    }
                    unset($_SESSION['eventDescriptionError']);
                ?>
            </div>

            <div class="mb-3">
                <label for="inputMaxVisitors" class="form-label text-dark"><b>Максимальное число участников (0 - без ограничений)*</b></label>
                <input type="number" min="0" class="form-control border-4 br-0 border-mainGreen" id="inputMaxVisitors" name="maxVisitors" aria-describedby="titleHelp" required autocomplete="off"
                value="<?=$res['maxVisitors']?>"
                >
                <?php
                    if ($_SESSION['eventVisitorsError']) {
                        echo '<div id="eventVisitorsError" class="form-text text-danger">' . $_SESSION['eventVisitorsError'] . '</div>';
                    }
                    unset($_SESSION['eventVisitorsError']);
                ?>
            </div>

            <div class="mb-3 d-flex justify-content-around flex-wrap">
                <div>
                    <label for="startDate"><b>Дата проведения*</b></label>
                    <input id="startDate" class="form-control border-4 br-0 border-mainGreen minw-220px" name="date" type="date" required
                    <?php
                        echo 'value='  . $res['date'];
                    ?>
                    />
                    <?php
                        if ($_SESSION['editEventDateError']) {
                            echo '<div id="editEventDateError" class="form-text text-danger">' . $_SESSION['editEventDateError'] . '</div>';
                        }
                        unset($_SESSION['editEventDateError']);
                    ?>
                </div>

                <div>
                    <label for="startTime"><b>Время проведения*</b></label>
                    <input type="time" id="startTime" class="form-control border-4 br-0 border-mainGreen  minw-220px" name="time" required
                    <?php
                        echo 'value='  . $res['time'];
                    ?>
                    />
                    <?php
                        if ($_SESSION['editEventTimeError']) {
                            echo '<div id="editEventTimeError" class="form-text text-danger">' . $_SESSION['editEventTimeError'] . '</div>';
                        }
                        unset($_SESSION['editEventTimeError']);
                    ?>
                </div>
            </div>

            <div class="d-flex w-100 justify-content-center">
                <div id="carouselExampleIndicators" class="  carousel mx-0 slide w-100" style="max-width: 1200px;" data-bs-ride="carousel">

                    <div class="carousel-inner">

                        <?php
                            $eventId = $_GET['event'];
                            $result = $dbConnect->query("SELECT * FROM `images` WHERE `event`=$eventId ORDER BY `mainImage` DESC");
                            $imgNum=1;
                            $active="active";
                            while ($imgs = $result->fetch_assoc()){
                                $imgPath = "./img/" . $eventId . "/" . $imgs['image'];
                                echo "<div class=\"border-4 green-border border mt-2 w-100 rounded img-fluid carousel-item $active w-100\" style=\" height: 45vh; background-image: url('$imgPath'); background-position: center; background-repeat: no-repeat;  background-size: cover;\"><h5 class=\"bg-mainGreen  border border-4 text-center rounded-pill \" style=\"width:2rem; height:2rem\">$imgNum</h5></div>";
                                $active="";
                                $imgNum+=1;
                            }
                        ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Предыдущий</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Следующий</span>
                    </button>
                </div>
            </div>




            <!-- <div class="mb-3">
                <fieldset>
                    <legend>Отметьте картинки, не прошедшие проверку:</legend>

                    <?php
                    echo $imgNum;
                        for($i=1;$i<$imgNum;$i++){
                            echo "<div>
                                  <input type=\"checkbox\" id=\"$i\" name=\"$i\">
                                  <label for=\"$i\">$i</label>
                                </div>";
                        }
                    ?>

                    <div>
                      <input type="checkbox" id="scales" name="scales" class="form-check-input" style="color:green;" checked>
                      <label for="scales">Scales</label>
                    </div>

                </fieldset>
            </div> -->

            <div class="mb-3">
                <label for="inputPrice" class="form-label text-dark"><b>Стоимость посещения*</b></label>
                <input type="text" maxlength="25" class="form-control border-4 br-0 border-mainGreen" id="inputPrice" name="price" aria-describedby="priceHelp" required autocomplete="off"
                value="<?=$res['price']?>"
                >
                <?php
                    if ($_SESSION['editEventPriceError']) {
                        echo '<div id="editEventPriceError" class="form-text text-danger">' . $_SESSION['editEventPriceError'] . '</div>';
                    }
                    unset($_SESSION['eventPriceError']);
                ?>
            </div>

            <div>
                <h6><b>

                    <?php
                        if ($_SESSION['createEventStatus']) {
                            echo $_SESSION['createEventStatus'];
                            unset($_SESSION['createEventStatus']);
                        }
                    ?>

                </b></h6>
            </div>

            <div>
                <h6>Обязательные поля отмечены звёздочкой - *</h6>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label text-dark"><b>Телефон организатора</b></label>
                <input type="text" maxlength="25" class="form-control  border-4 br-0 border-mainGreen" id="phone" name="phone" aria-describedby="phoneHelp" required autocomplete="off"
                value="<?=$res['phoneNumber']?>" disabled
                >
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label text-dark"><b>Email организатора</b></label>
                <input type="text" maxlength="25" class="form-control  border-4 br-0 border-mainGreen" id="email" name="phone" aria-describedby="phoneHelp" required autocomplete="off"
                value="<?=$res['email']?>" disabled
                >
            </div>

            <div class="d-flex justify-content-around flex-wrap">
                <button id="submitBtn" type="submit" class="minh-42px btn minw-220px border-mainGreen border-4 bg-lightGreen text-dark rounded-pill text-center my-1">
                    <h6>Опубликовать!</h6>
                </button>
            </div>



        </form>
</div>