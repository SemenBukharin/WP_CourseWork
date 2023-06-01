<div class="bg-white-body br-10 d-flex flex-column w-75 my-4" style="max-width:720px">
	<form id="form" class="m-3 p-0" action="./vendor/attemptEditUser.php" method="post" onsubmit="return passwordCheck()">

            <div class="d-flex justify-content-center">
                <div class="my-2 rounded-pill bg-mainGreen text-white minh-50px minw-220px text-center"> <h4 class="mt-2">Личный кабинет</h4></div>
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
                    <div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:150px; height: 35px">
                        <p class="mt-1">
                            Личный кабинет
                        </p>
                    </div>
                </a>
            </div>

            <div class="d-flex justify-content-center">
                <h5 class="mt-2"><?= $_SESSION['updateStatus']; unset($_SESSION['updateStatus']); ?></h5>
            </div>

            <h5 class="mb-2 mt-1"><?=$user;?></h5>

            <div class="d-flex justify-content-center flex-wrap">

                <?php
                    if ($root==1) {
                        echo " <a href=\"../adminPage.php\" class=\"no-underline minh-42px\"><div  class=\"minh-42px minw-220px bg-mainGreen text-white rounded-pill p-2 text-center my-1 mx-5\"><h6>Панель администратора</h6></div></a>";
                    }
                ?>
                <a href="../myEvents.php" class="no-underline minh-42px"><div  class="minh-42px minw-220px bg-mainGreen text-white rounded-pill p-2 text-center my-1 mx-5"><h6>Мои мероприятия</h6></div></a>
            </div>


            <!-- <?php
                echo "<div class=\"d-flex justify-content-between flex-wrap\">
                                <h5 class=\"mt-2\">$user</h5>";
                    if ($root==1) {
                        echo " <a href=\"../registration.php\" class=\"no-underline minh-42px\"><div  class=\"minh-42px minw-220px bg-mainGreen text-white rounded-pill p-2 text-center my-1 mx-5\"><h6>Панель администратора</h6></div></a>";
                    }
                    echo "</div>";
            ?> -->

            <div class="d-flex justify-content-around">
                <h5></h5>
            </div>

            <div class="mb-3">
                <label for="inputSurname" class="form-label text-dark"><b>Контактный телефон</b></label>
                <input type="text" class="form-control border-4 br-0 border-mainGreen" id="inputPhone" name="phone" aria-describedby="phoneHelp" required minlength="6" maxlength="12" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$" autocomplete="off"
                <?php
                    if ($_SESSION['phone']) {
                    echo 'value='  . $_SESSION['phone'];
                    unset($_SESSION['phone']);
                    }
                    else {
                        echo 'value=' . $phone;
                    }
                ?>

                >
                <div id="phoneHelp" class="form-text text-secondary">В любом формате.</div>
                <?php
                    if ($_SESSION['phoneError']) {
                        echo '<div id="phoneError" class="form-text text-danger">' . $_SESSION['phoneError'] . '</div>';
                    }
                    unset($_SESSION['phoneError']);
                ?>
            </div>
            <div class="mb-3">
                <label for="inputEmail1" class="form-label text-dark"><b>Email адрес</b></label>
                <input type="email" class="form-control border-4 br-0 border-mainGreen" id="inputEmail1" name="email" aria-describedby="emailHelp" required autocomplete="off"
                <?php
                    if ($_SESSION['email']) {
                    echo 'value='  . $_SESSION['email'];
                    unset($_SESSION['phone']);
                    }
                    else {
                        echo 'value=' . $email;
                    }
                ?>
                >
                <?php
                    if ($_SESSION['emailStatus']) {
                        echo '<div id="emailStatus" class="form-text text-danger">' . $_SESSION['emailStatus'] . '</div>';
                    }
                    unset($_SESSION['emailStatus']);
                ?>
                <!-- <div id="emailHelp" class="form-text text-secondary">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label text-dark"><b>Новый пароль</b></label>
                <input type="password" class="form-control border-4 br-0 border-mainGreen" id="inputPassword" name="password" onkeyup="passwordCheck()" aria-describedby="passwordHelp"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" minlength="8" maxlength="15">
                <div id="passwordHelp"  class="form-text text-secondary">Не менее 8 символов, обязательно совместное использование прописных, строчных латинских букв, цифр, символов.</div>
                <?php
                    if ($_SESSION['passwordError']) {
                        echo '<div id="passwordError" class="form-text text-danger">' . $_SESSION['passwordError'] . '</div>';
                    }
                    unset($_SESSION['passwordError']);
                ?>
            </div>
            <div class="mb-3">
                <label for="repeatPassword" class="form-label text-dark"><b>Повторите новый пароль</b></label>
                <input type="password" class="form-control border-4 br-0 border-mainGreen" id="repeatPassword" onkeyup="passwordCheck()" aria-describedby="passwordCheck">
                <div id="passwordCheck" style="max-width: 300px" class="form-text text-danger"></div>
            </div>

            <div class="d-flex justify-content-around flex-wrap">
                <button id="submitBtn" type="submit" class="minh-42px minw-220px bg-mainGreen text-white rounded-pill border-0 text-center my-1">
                    <h6>Сохранить изменения</h6>
                </button>
            </div>


        </form>

        <div class="d-flex justify-content-around flex-wrap mb-2">
            <button onclick="document.location='../vendor/exit.php'" class="minh-42px minw-220px bg-mainGreen text-white rounded-pill border-0 text-center my-1">
                <h6>Выйти</h6>
            </button>
        </div>
</div>