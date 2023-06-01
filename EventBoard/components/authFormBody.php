<div class="bg-white-body br-10 d-flex flex-column w-75 my-4" style="max-width:720px">
	<form id="form" class="m-3 p-0" action="./vendor/attemptAuthorize.php" method="post" onsubmit="return passwordCheck()">
            <div class="d-flex justify-content-center">
                <div class="my-2 rounded-pill bg-mainGreen text-white minh-50px minw-220px text-center"> <h4 class="mt-2">Авторизация</h4></div>
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
                            Авторизация
                        </p>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <label for="inputEmail1" class="form-label text-dark"><b>Email адрес</b></label>
                <input type="text" class="form-control border-4 br-0 border-mainGreen" id="inputEmail1" name="email" aria-describedby="emailHelp" required autocomplete="off"
                <?php
                    echo 'value='  . $_SESSION['authEmail'];
                    unset($_SESSION['authEmail']);
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
                <label for="inputPassword" class="form-label text-dark"><b>Пароль</b></label>
                <input type="password" class="form-control border-4 br-0 border-mainGreen" id="inputPassword" name="password" onkeyup="passwordCheck()" aria-describedby="passwordHelp" required>
                <div id="passwordHelp" style="max-width: 300px" class="form-text text-danger">
                <?php
                    if ($_SESSION['authorizationError']){
                        echo $_SESSION['authorizationError'];
                        unset($_SESSION['authorizationError']);
                    }
                ?>
                </div>
            </div>

            <div class="d-flex justify-content-around flex-wrap">
                <a href="../registration.php" class="no-underline minh-42px"><div  class="minh-42px minw-220px bg-mainGreen text-white rounded-pill p-2 text-center my-1"><h6>У меня нет аккаунта</h6></div></a>
                <button id="submitBtn" type="submit" class="minh-42px minw-220px bg-mainGreen text-white rounded-pill border-0 text-center my-1"><h6>Войти</h6></button>
            </div>


        </form>
</div>