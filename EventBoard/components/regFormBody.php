<div class="bg-white-body br-10 d-flex flex-column w-75 my-4" style="max-width:720px">
	<form id="form" class="m-3 p-0" action="./vendor/attemptRegister.php" method="post" onsubmit="return passwordCheck()">

            <div class="d-flex justify-content-center">
                <div class="my-2 rounded-pill bg-mainGreen text-white minh-50px minw-220px text-center"> <h4 class="mt-2">Регистрация</h4></div>
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
                            Регистрация
                        </p>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <label for="inputSurname" class="form-label text-dark"><b>Фамилия*</b></label>
                <input type="text" class="form-control border-4 br-0 border-mainGreen" id="inputSurname" name="surname" aria-describedby="surnameHelp" required minlength="2" maxlength="15" pattern="[A-Za-zА-ЯЁа-яё]{2,15}" autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['surname'];
                    unset($_SESSION['surname']);
                ?>
                >
                <div id="surnameHelp" class="form-text text-secondary">Текст 2-15 символов.</div>
                <?php
                    if ($_SESSION['surnameError']) {
                        echo '<div id="surnameError" class="form-text text-danger">' . $_SESSION['surnameError'] . '</div>';
                    }
                    unset($_SESSION['surnameError']);
                ?>
            </div>
            <div class="mb-3">
                <label for="inputName" class="form-label text-dark"><b>Имя*</b></label>
                <input type="text" class="form-control border-4 br-0 border-mainGreen" id="inputName" name="name" aria-describedby="nameHelp" required minlength="2" maxlength="15" pattern="[A-Za-zА-ЯЁа-яё]{2,15}" autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['name'];
                    unset($_SESSION['name']);
                ?>
                >
                <div id="nameHelp" class="form-text text-secondary">Текст 2-15 символов.</div>
                <?php
                    if ($_SESSION['nameError']) {
                        echo '<div id="nameError" class="form-text text-danger">' . $_SESSION['nameError'] . '</div>';
                    }
                    unset($_SESSION['nameError']);
                ?>
            </div>
            <div class="mb-3">
                <label for="inputSurname" class="form-label text-dark"><b>Отчество</b></label>
                <input type="text" class="form-control border-4 br-0 border-mainGreen" id="inputPatronymic" name="patronymic" aria-describedby="patronymicHelp" required minlength="2" maxlength="15" pattern="[A-Za-zА-ЯЁа-яё]{2,15}" autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['patronymic'];
                    unset($_SESSION['patronymic']);
                ?>
                >
                <div id="patronymicHelp" class="form-text text-secondary">Текст 2-15 символов.</div>
                <?php
                    if ($_SESSION['patronymicError']) {
                        echo '<div id="patronymicError" class="form-text text-danger">' . $_SESSION['patronymicError'] . '</div>';
                    }
                    unset($_SESSION['patronymicError']);
                ?>
            </div>
            <div class="mb-3">
                <label for="inputSurname" class="form-label text-dark"><b>Номер телефона*</b></label>
                <input type="text" class="form-control border-4 br-0 border-mainGreen" id="inputPhone" name="phone" aria-describedby="phoneHelp" required minlength="6" maxlength="12" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$" autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['phone'];
                    unset($_SESSION['phone']);
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
                <label for="inputEmail1" class="form-label text-dark"><b>Email адрес*</b></label>
                <input type="email" class="form-control border-4 br-0 border-mainGreen" id="inputEmail1" name="email" aria-describedby="emailHelp" required autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['email'];
                    unset($_SESSION['email']);
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
                <label for="inputPassword" class="form-label text-dark"><b>Введите пароль*</b></label>
                <input type="password" class="form-control border-4 br-0 border-mainGreen" id="inputPassword" name="password" onkeyup="passwordCheck()" aria-describedby="passwordHelp" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" minlength="8" maxlength="15">
                <div id="passwordHelp"  class="form-text text-secondary">Не менее 8 символов, обязательно совместное использование прописных, строчных латинских букв, цифр, символов.</div>
                <?php
                    if ($_SESSION['passwordError']) {
                        echo '<div id="passwordError" class="form-text text-danger">' . $_SESSION['passwordError'] . '</div>';
                    }
                    unset($_SESSION['passwordError']);
                ?>
            </div>
            <div class="mb-3">
                <label for="repeatPassword" class="form-label text-dark"><b>Повторите пароль*</b></label>
                <input type="password" class="form-control border-4 br-0 border-mainGreen" id="repeatPassword" onkeyup="passwordCheck()" aria-describedby="passwordCheck" required>
                <div id="passwordCheck" style="max-width: 300px" class="form-text text-danger"></div>
            </div>

            <div>
                <h6>Обязательные поля отмечены звёздочкой - *</h6>
            </div>

            <div class="d-flex justify-content-around flex-wrap">
                <a href="../authorization.php" class="no-underline minh-42px"><div  class="minh-42px minw-220px bg-mainGreen text-white rounded-pill p-2 text-center my-1"><h6>У меня есть аккаунт</h6></div></a>
                <button id="submitBtn" type="submit" class="minh-42px minw-220px bg-mainGreen text-white rounded-pill border-0 text-center my-1"><h6>Зарегистрироваться</h6></button>
            </div>


        </form>
</div>