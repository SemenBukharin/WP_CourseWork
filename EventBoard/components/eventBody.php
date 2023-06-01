<div class="bg-white-body br-10 d-flex flex-column w-75 my-4" style="max-width:1024px">



		<div class="d-flex justify-content-center">
            <div class="my-2 w-75 rounded-pill bg-mainGreen text-white minh-50px minw-220px text-center">
            	<h4 class="mt-2 mx-2">
            		<?php echo $title ?>
            	</h4>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center">

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
        		<a  class="no-underline link-white my-2 mx-3" href="<?="categoryPage.php?category=" . $category?>">
					<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:150px; height: 35px">
						<p class="mt-1">
							<?=$category?>
						</p>
					</div>
				</a>
				<div class="d-flex my-2 justify-content-center text-dark" style="width:2rem; height: 35px">
					<h4 class="mt-1">-></h4>
				</div>
        		<a  class="no-underline link-white my-2 mx-3" href="">
					<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="height: 35px">
						<p class=" mx-1 mt-1">
							<?=$title?>
						</p>
					</div>
				</a>
        	</div>

			<div class="d-flex w-100 flex-row justify-content-evenly flex-wrap">

	                <div id="carouselExampleIndicators" class="carousel mx-2 slide w-100" style="max-width: 500px; min-width: 250px" data-bs-ride="carousel">

	                    <div class="carousel-inner">

	                        <?php
	                            $eventId = $_GET['event'];
	                            $result = $dbConnect->query("SELECT * FROM `images` WHERE `event`=$eventId ORDER BY `mainImage` DESC");
	                            $imgNum=1;
	                            $active="active";
	                            while ($imgs = $result->fetch_assoc()){
	                                $imgPath = "./img/" . $eventId . "/" . $imgs['image'];
	                                echo "<div class=\"border-4 green-border border mt-2 w-100 rounded img-fluid carousel-item $active w-100\" style=\" height: 35vh; background-image: url('$imgPath'); background-position: center; background-repeat: no-repeat;  background-size: cover;\"><h5 class=\"bg-mainGreen  border border-4 text-center rounded-pill \" style=\"width:2rem; height:2rem\">$imgNum</h5></div>";
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


				<div class="mx-2 d-flex flex-column justify-content-evenly align-items-start">

					<div class="d-flex justify-content-evenly align-items-center my-1">
						<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:120px; height: 35px">
							<p class="mt-1">
								Где?
							</p>
						</div>
						<div class="d-flex justify-content-center" style="height: 50px">
							<p class=" mx-1 my-1">

								<?php
									$res1 = $dbConnect->query("SELECT * FROM `cities` WHERE `id` = '$cityId'");
									$res1 = $res1->fetch_assoc();
									$cityName = $res1["city"];
									echo $cityName . ", " .$address
								?>
							</p>
						</div>
					</div>

					<div class="d-flex justify-content-evenly align-items-center my-1">
						<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:120px; height: 35px">
							<p class="mt-1">
								Когда?
							</p>
						</div>
						<div class="d-flex justify-content-center" style="width:150px; height: 35px">
							<p class="mt-1">
								<?=date("d.m.Y", strtotime($date)) . " " . mb_strcut($time, 0, 5);?>
							</p>
						</div>
					</div>

					<div class="d-flex justify-content-evenly align-items-center my-1">
						<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:120px; height: 35px">
							<p class="mt-1">
								Стоимость
							</p>
						</div>
						<div class="d-flex justify-content-center" style="width:150px; height: 35px">
							<p class="mt-1">
								<?=$price?>
							</p>
						</div>
					</div>

					<div class="d-flex justify-content-evenly align-items-center my-1">
						<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:120px; height: 35px">
							<p class="mt-1">
								Сколько мест?
							</p>
						</div>
						<div class="d-flex justify-content-center" style="width:150px; height: 35px">
							<p class="mt-1">
								<?=$visitorsMax?>
							</p>
						</div>
					</div>

					<div class="d-flex flex-column justify-content-evenly align-items-center my-1">
						<h6 id="placesCount" class="mx-1"> Число участников:
							<?php
								require_once './vendor/dbConnect.php';
								session_start();

								$event = $_GET['event'];
								$user = $_SESSION['userId'];

								$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
								$users_events_res = $users_events_res->fetch_assoc();
								$users_on_event = $users_events_res["cnt"];

								echo ($users_on_event);
							?>
						</h6>
						<button onclick="tryToSignUpForAnEvent()" class="minh-42px btn minw-220px border-mainGreen border-4 bg-lightGreen text-dark rounded-pill text-center my-1">
	                    	<h6 id="btnText"><?php
	                    		$user_on_event_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `user`='$user' AND `event`='$event'");
								$user_on_event_res = $user_on_event_res->fetch_assoc();
								$user_on_event = $user_on_event_res["cnt"];

								if ($user_on_event == 1){echo ("Отменить участие.");}
								else {echo ("Участвовать!");}
	                    	?></h6>
	                	</button>
                	</div>

				</div>
			</div>

			<p class="mt-2 mx-2"><?=$description?></p>

		</div>



</div>