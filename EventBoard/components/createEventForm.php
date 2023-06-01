<div class="bg-white-body br-10 d-flex flex-column w-75 my-4" style="max-width:720px">
	<form enctype="multipart/form-data" id="form" class="m-3 p-0" action="./vendor/createEventAttempt.php" method="post"">

            <div class="d-flex justify-content-center">
                <div class="my-2 rounded-pill bg-mainGreen text-white minh-50px minw-220px text-center"> <h4 class="mt-2 mx-2">Создание мероприятия</h4></div>
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
                <a  class="no-underline link-white my-2 mx-3" href="">
                    <div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:180px; height: 35px">
                        <p class="mt-1">
                            Создание мероприятия
                        </p>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <label for="inputTitle" class="form-label text-dark"><b>Название*</b></label>
                <input type="text" maxlength="50" class="form-control border-4 br-0 border-mainGreen" id="inputTitle" name="title" aria-describedby="titleHelp" required autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['titleEvent'];
                    unset($_SESSION['titleEvent']);
                ?>
                >
            </div>

            <div class="mb-3 d-flex justify-content-around flex-wrap">
                <div>
                    <label for="categorySelect" class="form-label text-dark"><b>Категория*</b></label>
                    <select name="category" id="categorySelect" class="form-select form-control border-4 br-0 border-mainGreen minw-220px" style="min-width: 254px;">
                        <option value="0">Выберите категорию</option>
                        <?php
                            require_once './vendor/dbConnect.php';

                            $categories = $dbConnect->query("SELECT `categoryName` FROM `categories`");
                            while($row = $categories->fetch_assoc()){
                                ?>
                                    <option value="<?=$row['categoryName']?>"
                                    <?php
                                        if ($row['categoryName'] == $_SESSION['categoryEvent']) {
                                            echo "selected";
                                           unset($_SESSION['categoryEvent']);
                                        }
                                    ?>
                                    ><?=$row['categoryName']?></option>
                                <?
                            }
                        ?>
                    </select>
                    <?php
                    if ($_SESSION['eventCategoryError']) {
                            echo '<div id="eventCategoryError" class="form-text text-danger">' . $_SESSION['eventCategoryError'] . '</div>';
                        }
                        unset($_SESSION['eventCategoryError']);
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
                                    if ($row['id'] == $_SESSION['cityEvent']) {
                                        echo "selected";
                                        unset($_SESSION['cityEvent']);
                                        }
                                    ?>
                                    ><?=$row['city']?></option>
                                <?
                            }
                        ?>
                    </select>
                    <?php
                    if ($_SESSION['eventCityError']) {
                            echo '<div id="eventCityError" class="form-text text-danger">' . $_SESSION['eventCityError'] . '</div>';
                        }
                        unset($_SESSION['eventCityError']);
                    ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="inputAddress" class="form-label text-dark"><b>Адрес*</b></label>
                <input type="text" maxlength="500" class="form-control border-4 br-0 border-mainGreen" id="inputAddress" name="address" aria-describedby="titleHelp" required autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['addressEvent'];
                    unset($_SESSION['addressEvent']);
                ?>
                >
                <?php
                    if ($_SESSION['eventAddressError']) {
                        echo '<div id="eventAddressError" class="form-text text-danger">' . $_SESSION['eventAddressError'] . '</div>';
                    }
                    unset($_SESSION['eventAddressError']);
                ?>
            </div>

            <div class="mb-3">
                <label for="inputDescription" class="form-label text-dark"><b>Описание (до 500 символов)*</b></label>
                <textarea rows="8" maxlength="500" class="form-control border-4 br-0 border-mainGreen minh-200px" id="inputDescription" name="description" aria-describedby="descriptionHelp" required autocomplete="off"><?php
                        echo $_SESSION['descriptionEvent'];
                        unset($_SESSION['descriptionEvent']);
                    ?></textarea>
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
                <?php
                    echo 'value='  . $_SESSION['maxVisitorsEvent'];
                    unset($_SESSION['maxVisitorsEvent']);
                ?>
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
                        echo 'value='  . $_SESSION['dateEvent'];
                        unset($_SESSION['dateEvent']);
                    ?>
                    />
                    <?php
                        if ($_SESSION['eventDateError']) {
                            echo '<div id="eventDateError" class="form-text text-danger">' . $_SESSION['eventDateError'] . '</div>';
                        }
                        unset($_SESSION['eventDateError']);
                    ?>
                </div>

                <div>
                    <label for="startTime"><b>Время проведения*</b></label>
                    <input type="time" id="startTime" class="form-control border-4 br-0 border-mainGreen  minw-220px" name="time" required
                    <?php
                        echo 'value='  . $_SESSION['timeEvent'];
                        unset($_SESSION['timeEvent']);
                    ?>
                    />
                    <?php
                        if ($_SESSION['eventTimeError']) {
                            echo '<div id="eventTimeError" class="form-text text-danger">' . $_SESSION['eventTimeError'] . '</div>';
                        }
                        unset($_SESSION['eventTimeError']);
                    ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="mainImage"><b>Главное изображение*</b></label>
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <div class="d-flex flex-wrap justify-content-start align-items-center">
                    <input type="file" onchange="unlockDeleteImageBtn(this)" class="form-control w-80 border-4 br-0 border-mainGreen" value="10:05 AM"  id="mainImage" name="main_img" accept="image/png, image/jpeg" style="min-width:225px;" required>
                    <button class="bg-white-body v-hidden" type="button" onclick="clearInput(this)" style="border:none; width:35px"><img height="35px" width="35px" src="../cross.png"></button>
                </div>
            </div>

            <div class="mb-3">
                <label for="image1"><b>Дополнительное изображение 1</b></label>
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <div class="d-flex flex-wrap justify-content-start align-items-center">
                    <input type="file" onchange="unlockDeleteImageBtn(this)" class="form-control w-80 border-4 br-0 border-mainGreen"  id="image1" name="image1" accept="image/png, image/jpeg" style="min-width:225px;">
                    <button class="bg-white-body v-hidden" type="button" onclick="clearInput(this)" style="border:none; width:35px"><img height="35px" width="35px" src="../cross.png"></button>
                </div>
            </div>

            <div class="mb-3">
                <label for="image2"><b>Дополнительное изображение 2</b></label>
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                <div class="d-flex flex-wrap justify-content-start align-items-center">
                    <input type="file" onchange="unlockDeleteImageBtn(this)" class="form-control w-80 border-4 br-0 border-mainGreen"  id="image2" name="image2" accept="image/png, image/jpeg" style="min-width:225px; ">
                    <button class="bg-white-body v-hidden" type="button" onclick="clearInput(this)" style="border:none; width:35px"><img height="35px" width="35px" src="../cross.png"></button>
                </div>
            </div>

            <div class="mb-3">
                <label for="inputPrice" class="form-label text-dark"><b>Стоимость посещения*</b></label>
                <input type="text" maxlength="25" class="form-control border-4 br-0 border-mainGreen" id="inputPrice" name="price" aria-describedby="priceHelp" required autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['priceEvent'];
                    unset($_SESSION['priceEvent']);
                ?>
                >
                <?php
                    if ($_SESSION['eventPriceError']) {
                        echo '<div id="eventPriceError" class="form-text text-danger">' . $_SESSION['eventPriceError'] . '</div>';
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

            <div class="d-flex justify-content-around flex-wrap">
                <button id="submitBtn" type="submit" class="minh-42px btn minw-220px border-mainGreen border-4 bg-lightGreen text-dark rounded-pill text-center my-1">
                    <h6>Создать!</h6>
                </button>
            </div>



        </form>
</div>