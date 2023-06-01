<div class="bg-white-body br-10 d-flex flex-column w-75 my-4" style="max-width:1024px; min-height:500px">
	<div class="d-flex justify-content-around flex-wrap border-bottom border-4 border-dark">
        <?php
        	require './vendor/dbConnect.php';
        	$linkToCategory = './categoryPage.php?category=';

            $categories = $dbConnect->query("SELECT `categoryName` FROM `categories`");
            while($row = $categories->fetch_assoc()){
                ?>

                    <a  class="no-underline link-white my-2" href="<?=$linkToCategory . $row['categoryName']?>">
						<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:150px; height: 35px">
							<p class="mt-1">
								<?= $row["categoryName"]; ?>
							</p>
						</div>
					</a>
                <?
            }
        ?>
    </div>

    <div class="d-flex justify-content-around flex-wrap">
    	<div class="d-flex flex-column justify-content-start align-items-center" style="flex-grow:3">
    		<div class="my-2 rounded-pill bg-mainGreen text-white minh-50px minw-220px w-50 text-center"> <h5 class="mt-2 mx-2">Новые мероприятия</h5></div>
	    	<div class="d-flex flex-wrap justify-content-around">
	    		<?php
					$limit = 6;
					$date = date('Y-m-d H:i');
					$time = date('H:i');
					$city = $_SESSION["cityId"];
					$query = $dbConnect->query("SELECT * FROM `events` JOIN `images` ON events.id=images.event WHERE `mainImage`=1 AND `published`=1 AND `city`='$city' AND `date`+`time`>='$date' ORDER BY `editDate` DESC LIMIT	$limit");

					if ($query->num_rows == 0){
						if ($_SESSION["cityId"]==0){
							echo "<div class=\"d-flex justify-content-center align-items-center\" style=\"min-height:250px\"><h5 class=\"text-center\">Город не указан!</h5></div>";
						}
						else{
							echo "<div class=\"d-flex justify-content-center align-items-center\" style=\"min-height:250px\"><h5 class=\"text-center\">Нет мероприятий в указанном городе!</h5></div>";
						}
					}

					 if($query->num_rows > 0){
						$imgsPath = "../img/";
						?>
					    <div class="d-flex justify-content-around flex-wrap" style="max-width: 770px;">
					    <?php while($row = $query->fetch_assoc()){
					    	$image = $imgsPath . $row['id'] . "/" . $row['image'];
					    ?>
					        <div class="card d-flex my-2 mx-2 flex-column align-items-center justify-content-between bg-lightGreen" style="width: 235px; height: 360px;">
								<div class="mt-2 rounded img-fluid" style="width: 220px; height: 145px; background-image: url('<?php echo $image ?>'); background-position: center; background-repeat: no-repeat;  background-size: cover;"></div>
								<!-- <div class="card-body d-flex justify-content-center flex-column align-items-center"> -->
									<div class="d-flex justify-content-start w-100 px-2">
										<p class="card-text"><?= date("d.m.Y", strtotime(date($row["date"]))) . " " . mb_strcut($row["time"], 0, 5); ?></p>
									</div>

									<a class="no-underline mx-1 link-dark " href="<?="../eventPage.php" . "?event=" . $row["id"]?>"><h5 class="card-title"><?=$row["title"]?></h5></a>


									<p class="mx-1 my-0 card-text"><?= mb_substr($row["description"], 0, 50) . "..."; ?></p>

									<p class="mx-2 w-80 my-0 card-text"><?=$row["price"]?></p>

									<div class="d-flex justify-content-between w-100 px-2  mb-2">
										<a>
											<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:110px; height: 35px">
												<p class="mt-1">
													<?= $row["category"]; ?>
												</p>
											</div>
										</a>
										<div class=" d-flex justify-content-center text-white bg-mainGreen rounded-pill" style="width:85px; height: 35px"><p class="mt-1"><?php if ($row["maxVisitors"]>0) {
												$event = $row['id'];
												$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
												$users_events_res = $users_events_res->fetch_assoc();
												$users_on_event = $users_events_res["cnt"];
												echo $users_on_event . "/" . $row["maxVisitors"];
											}
														else {
															$event = $row['id'];
															$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
															$users_events_res = $users_events_res->fetch_assoc();
															$users_on_event = $users_events_res["cnt"];
															echo $users_on_event;
														}?></p></div>
									</div>
								<!-- </div> -->
							</div>
					    <?php
							}
						?>
					    </div>
					 <?php }?>

	    	</div>
    	</div>
    	<div class="d-flex flex-wrap flex-column justify-content-start align-items-center">

	    	<div class="d-flex align-items-center justify-content-center"><div class="my-2 rounded-pill bg-mainGreen text-white minh-50px minw-220px w-50 text-center"> <h5 class="mt-2 mx-2">Успей поучаствовать!</h5></div></div>

	    	<div class="d-flex flex-row flex-wrap align-items-center justify-content-center" id="flexTrouble" >
		    	<?php
					$query = $dbConnect->query("SELECT *, (SELECT COUNT(*) FROM `users_events`  WHERE `event`= events.`id`)/maxVisitors AS `prc` FROM `events` JOIN `images` ON events.id=images.event WHERE `mainImage`=1 AND `published`= 1 AND `date`+`time`>='$date' HAVING `prc`<1 ORDER BY `prc` DESC LIMIT 2");

					 if($query->num_rows > 0){
						$imgsPath = "../img/";
						?>
					    <div class="d-flex justify-content-around flex-wrap">
					    <?php while($row = $query->fetch_assoc()){
					    	$image = $imgsPath . $row['id'] . "/" . $row['image'];
					    ?>
					        <div class="card d-flex my-2 mx-2 flex-column align-items-center justify-content-between bg-admin-card" style="width: 235px; height: 360px;">
								<div class="mt-2 rounded img-fluid" style="width: 220px; height: 145px; background-image: url('<?php echo $image ?>'); background-position: center; background-repeat: no-repeat;  background-size: cover;"></div>
								<!-- <div class="card-body d-flex justify-content-center flex-column align-items-center"> -->
									<div class="d-flex justify-content-start w-100 px-2">
										<p class="card-text"><?= date("d.m.Y", strtotime(date($row["date"]))) . " " . mb_strcut($row["time"], 0, 5); ?></p>
									</div>

									<a class="no-underline mx-1 link-dark" href="<?="../eventPage.php" . "?event=" . $row["id"]?>"><h5 class="card-title"><?=$row["title"]?></h5></a>


									<p class="mx-1 my-0 card-text"><?= mb_substr($row["description"], 0, 50) . "..."; ?></p>

									<p class="mx-2 w-80 my-0 card-text"><?=$row["price"]?></p>

									<div class="d-flex justify-content-between w-100 px-2  mb-2">
										<a>
											<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:110px; height: 35px">
												<p class="mt-1">
													<?= $row["category"]; ?>
												</p>
											</div>
										</a>
										<div class=" d-flex justify-content-center text-white bg-mainGreen rounded-pill" style="width:85px; height: 35px"><p class="mt-1"><?php if ($row["maxVisitors"]>0) {
												$event = $row['id'];
												$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
												$users_events_res = $users_events_res->fetch_assoc();
												$users_on_event = $users_events_res["cnt"];
												echo $users_on_event . "/" . $row["maxVisitors"];
											}
														else {
															$event = $row['id'];
															$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
															$users_events_res = $users_events_res->fetch_assoc();
															$users_on_event = $users_events_res["cnt"];
															echo $users_on_event;
														}?></p></div>
									</div>
								<!-- </div> -->
							</div>
					    <?php
							}
						?>
					    </div>
					 <?php }?>
		    </div>

    	</div>


    </div>

</div>

<script>
			changeMaxWidth();
			window.onresize = changeMaxWidth;

</script>